<?php

namespace App\Http\Controllers;

use App\Models\FreelancerJobOffer;
use App\Models\FreelancerJobWorker;
use App\Models\Job;
use App\Models\User;
use App\Notifications\OfferAccept;
use App\Notifications\SendOffer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function send(Request $request)
    {
        if (!$request->slug) return abort(404);
        else $request['slug'] = $request->slug;
        $this->validate($request, [
            'price' => 'required|integer|numeric|min:10',
            'slug' => 'required|exists:users,slug',
            'job' => 'required|exists:jobs,slug',
        ]);

        $job = Job::where('slug', $request->job)->where('user_id', auth()->id())->firstOrFail();
        $freelancer_user = User::where('slug', $request->slug)->firstOrFail();

        $oldOffer = $freelancer_user->freelancer->offers()->findMany($job)->where('pivot.status', 'in_processing')->first();
        if ($oldOffer) {
            $oldOffer->pivot->status = 'canceled';
            $oldOffer->pivot->save();
        }
        $offer = $freelancer_user->freelancer->offers()->attach($job->id, [
            'budget' => $request->price,
            'status' => 'in_processing'
        ]);

        $freelancer_user->notify(new SendOffer($offer));
        return response()->json([
            'ok' => true,
            'message' => 'Your offer has been sent successfully.'
        ]);

    }

    public function accept(FreelancerJobOffer $freelancerJobOffer)
    {
        if (auth()->user()->can('accept-offer', $freelancerJobOffer) && auth()->user()->can('toHireJob', $freelancerJobOffer->job)) {
            $freelancerJobOffer->status = 'accepted';
            $freelancerJobOffer->save();

            $freelancerJobOffer->job->status = 'on_development';
            $freelancerJobOffer->job->save();
            $worker = new FreelancerJobWorker();

            $worker->job_id = $freelancerJobOffer->job->id;
            $worker->freelancer_id = auth()->user()->freelancer->id;
            $worker->budget = $freelancerJobOffer->budget;
            $worker->save();

            $freelancerJobOffer->job->user->notify(new  OfferAccept($freelancerJobOffer));

            return response()->json([
                'success' => true,
                'message' => 'You have confirmed this offer.',
                'accept' => 'accepted'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'It is not possible to accept this job.',
            'accept' => 'impossible'
        ]);

    }

    public function cancel(FreelancerJobOffer $freelancerJobOffer)
    {
        if ((auth()->user()->hasRole('freelancer') && $freelancerJobOffer->freelancer_id == auth()->user()->freelancer->id) || ($freelancerJobOffer->job->user->id == auth()->id())) {
            $freelancerJobOffer->status = 'canceled';
            $freelancerJobOffer->save();

            return response()->json([
                'success' => true,
                'message' => 'You have canceled this offer.',
                'accept' => 'canceled'
            ]);
        }

        return abort(403);
    }
}
