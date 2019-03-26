<?php

namespace App\Http\Controllers;

use App\Models\FreelancerJobWorker;
use App\Models\FreelancerJobWorkerHistory;
use App\Notifications\EmployerAcceptFinished;
use App\Notifications\RequestForCompletion;
use App\Repositories\MessangerRepository;
use App\Services\PayPal;
use Bnb\Laravel\Attachments\Attachment;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function sendFinishedJob(FreelancerJobWorker $contract, Request $request)
    {
        if (auth()->user()->freelancer->id == $contract->freelancer->id) {
            $messageRepository = new MessangerRepository(auth()->id());
            $history = new FreelancerJobWorkerHistory();
            $history->text = $request->message;


            $message = 'Freelancer ' . auth()->user()->name . ' has applied for completion ' . $contract->job->title . '<br> <a href="' . route('employer.job.show', ['slug' => $contract->job->slug]) . '">open page work and answer</a><br>';

            if ($request->message) {
                $message = $message . ' Freelancer wrote the text : ' . $request->message;
            }

            if (count($request->message_files) > 0) {
                $message = $message . ' Attachment files ';

            }
            $contract->status = 'on_waiting';
            $contract->save();
            $request['withId'] = $contract->job->user->id;
            $request['message'] = $message;
            if ($messageRepository->send($request->all())->status() == 200) {

                $history->status = 'finished';
                $history->author = 'freelancer';
                $history->freelancer_job_worker_id = $contract->id;
                $history->save();
                if (count($request->message_files) > 0) {
                    foreach ($request->message_files as $uuid) {
                        $attachment = Attachment::where('uuid', $uuid)->first();
                        $history->attach(storage_path('app/' . $attachment->filepath),
                            [
                                'group' => $attachment->filename
                            ]);
                    }
                }

                $contract->job->user->notify(new RequestForCompletion($contract));
            }
            return response()->json(['ok' => 'ok'], 200);
        } else {
            return abort(403);
        }

    }

    public function showContractCancelModal(Request $request)
    {

        $contract = FreelancerJobWorker::findOrFail($request->contract);
        $from = $request->from;
        $html = view('contracts.cancel-contract-modal', compact('contract', 'from'))->render();
        return response()->json(['html' => $html], 200);
    }


    public function sendCancelContract(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string|nullable'
        ]);
        $contract = FreelancerJobWorker::findOrFail($request->contract);
        if (($request->from == 'employer' && $contract->job->user->id != auth()->id()) || ($request->from == 'freelancer' && $contract->freelancer->id != auth()->user()->freelancer->id)) return abort(403);
        $history = new FreelancerJobWorkerHistory();
        $close_message =  $message = $request->message;

        $history->text = $close_message;


        $messageRepository = new MessangerRepository(auth()->id());

        $history = new FreelancerJobWorkerHistory();
        $history->text = $request->message;

        if ($request->from == 'employer'){
            $request['message'] = '<b>The employer canceled the contract due to </b> : ' . $close_message . '<a href="'.route('freelancer.contracts', ['status' => 'close']).'">open canceled contracts</a>';
            $request['withId'] = $contract->freelancer->user->id;
        }elseif ($request->from == 'freelancer'){
            $request['message'] = '<b>Freelancer canceled the contract with the text </b> : ' . $close_message . '<a href="'.route('employer.contracts', ['status' => 'close']).'">open canceled contracts</a>';
            $request['withId'] = $contract->job->user->id;
        }


        $contract->status = 'canceled';
        $contract->save();


        if ($messageRepository->send($request->all())->status() == 200) {

            $history->status = 'canceled';
            $history->author = $request->from;
            $history->freelancer_job_worker_id = $contract->id;
            $history->save();

        }

        toastr()->success('Contract canceled successfully');

        return back();


    }

    public function sendNoCommentJob(FreelancerJobWorker $contract, Request $request)
    {
        $history = new FreelancerJobWorkerHistory();
        $history->text = $request->message;
        if (auth()->id() == $contract->job->user->id) {
            $messageRepository = new MessangerRepository(auth()->id());
            $history = new FreelancerJobWorkerHistory();
            $history->text = $request->message;
            $message = 'Employer ' . auth()->user()->name . ' do not accept your application for completion on work : ' . $contract->job->title . '<br> <a href="' . route('job.index', ['slug' => $contract->job->slug]) . '">open page work and answer</a><br>';
            if ($request->message) {
                $message = $message . ' Employer wrote the text : ' . $request->message;
            }
            $contract->status = 'on_development';
            $contract->save();
            $request['withId'] = $contract->freelancer->user->id;
            $request['message'] = $message;

            if ($messageRepository->send($request->all())->status() == 200) {

                $history->status = 'not_accept';
                $history->author = 'employer';
                $history->freelancer_job_worker_id = $contract->id;
                $history->save();

            }
            return response()->json(['ok' => 'ok'], 200);

        } else {
            return abort(403);
        }
    }

    public function getHistory(FreelancerJobWorker $contract)
    {
        $view = view('jobs.partials.contract-history', ['histories' => $contract->histories])->render();
        return response()->json(['html' => $view]);
    }


    public function sendCommentJob(FreelancerJobWorker $contract, Request $request)
    {


        if (auth()->id() == $contract->job->user->id) {


            $invoice = new PayPal();
            $employer = $contract->job->user->employer;
            $invoice = $invoice->createAndSendInvoice($contract->job, (int)$contract->budget);

            if ($invoice['success']) {
                $contract->job->status = 'completed';
                $contract->job->save();

                $contract->status = 'completed';
                $contract->save();

                $history = new FreelancerJobWorkerHistory();
                $history->status = 'completed';
                $history->author = 'employer';
                $history->freelancer_job_worker_id = $contract->id;
                $history->save();

                $myInvoice = \App\Models\Invoice::create([
                    'job_id' => $contract->job->id,
                    'employer_id' => $employer->id,
                    'freelancer_id' => $contract->freelancer->id,
                    'invoice_id' => $invoice['invoice']->getId(),
                    'status' => 'SENT',
                ]);
                $freelancer = $contract->freelancer;
                $job = $contract->job;
                if (!$freelancer->getContractByJob($job->id)) {
                    $freelancer->workHistories()->create([
                        'job_id' => $job->id,
                        'work_history' => $job->title,
                        'work_date' => date("F Y"),
                        'earned' => $contract->budget,
                    ]);
                    $freelancer->increment('jobs', 1);
                    $freelancer->increment('total_earned', (int)$contract->budget);
                }
                $contract->freelancer->user->notify(new EmployerAcceptFinished($contract));
                return response()->json(['success' => true, 'url' => route('contract.feedback.create',
                    [
                        'recipient' => 'freelancer',
                        'contract' => $contract
                    ])
                ]);
            } else {
                return response()->json(['message' => $invoice['message']], 403);
            }

        }
        return response()->json(['message' => 'Forbidden'], 403);
    }

    public function createFeedback(FreelancerJobWorker $contract, Request $request)
    {
        $recipient = $request->recipient;
        $job = $contract->job;
        if ($request->recipient == 'freelancer') {
            $feedback = $contract->freelancer->getContractByJob($job->id);
        } elseif ($request->recipient == 'employer') {
            $feedback = $contract->job->user->employer->getContractByJob($job->id);
            if (!$feedback) {
                $feedback = $contract->job->user->employer->feedbacks()->create([
                    'job_id' => $job->id,
                    'freelancer_id' => auth()->id(),
                ]);
            }
        }
        return view('contracts.feedback', compact('contract', 'recipient', 'feedback'));

    }

    public function storeFeedback(FreelancerJobWorker $contract, Request $request)
    {
        $job = $contract->job;

        $contract->freelancer->getContractByJob($job->id)->update($request->only(['feedback', 'star']));
        return back();
    }

}
