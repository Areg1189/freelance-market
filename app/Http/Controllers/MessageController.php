<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\MessangerRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use wDevStudio\LaravelMessenger\Models\Conversation;

class MessageController extends Controller
{
    private $repository;


    /**
     * Create a new controller instance.
     *
     * MessageController constructor.
     */
    public function __construct()
    {
        $this->middleware(['web', 'auth']);
        $this->middleware(function ($request, $next) {
            $this->repository = new MessangerRepository(Auth::id());
            return $next($request);
        });

    }


    /**
     * Get Messages list.
     *
     * @param string|null $slug
     * @return view()|void
     */
    public function laravelMessenger(string $slug = null)
    {
        if ($slug && auth()->user()->hasRole('freelancer')) {
            $converceUserId = User::select('id')->where('slug', $slug)->first();
            if (!Conversation::where([
                'user_one' => auth()->user()->id,
                'user_two' => $converceUserId->id,
            ])->orWhere([
                'user_one' => $converceUserId->id,
                'user_two' => auth()->user()->id,
            ])->first()
            ) {
                return abort(403);
            }

        }
        $data = $this->repository->messenger($slug);
        if ($data['redirect']) {
            return redirect()->route('messenger', ['slug' => $data['slug']]);
        }
        return view('messenger.messenger', $data);
    }


    /**
     * Send a new message.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'conversation_id' => 'integer',
            'withId' => 'required|integer', // message reciever.
            'message' => 'required_without:message_files|string|nullable',
            'is_seen' => 'boolean',
            'deleted_from_sender' => 'boolean',
            'deleted_from_receiver' => 'boolean'
        ]);

        $data = $this->repository->send($request->all());
        return $data;

    }


    /**
     * Load threads view.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|back()
     * @throws \Throwable
     */
    public function loadThreads(Request $request)
    {
        if ($request->ajax()) {
            $view = view('messenger.partials.threads', $this->repository->loadThreads($request->all()))->render();
            return response()->json($view, 200);
        }
        return back();
    }


    /**
     * Load more messages.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function moreMessages(Request $request)
    {
        $this->validate($request, ['withId' => 'required|integer']);

        if ($request->ajax()) {

            $messages = $this->repository->moreMessages($request->all());

            $view = view('messenger.partials.messages', compact('messages'))->render();

            return response()->json([
                'view' => $view,
                'messagesCount' => $messages->count()
            ], 200);
        }
    }


    /**
     *  Make a message seen.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function makeSeen(Request $request)
    {
        if ($this->repository->makeSeen($request->all())) {
            return response()->json(['success' => true], 200);
        }
        return response()->json(['error' => true], 500);
    }


}
