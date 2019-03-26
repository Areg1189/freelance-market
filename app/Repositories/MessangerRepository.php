<?php
/**
 * Created by PhpStorm.
 * User: Maximum Code
 * Date: 01.02.2019
 * Time: 13:53
 */

namespace App\Repositories;


use App\Models\User;
use Bnb\Laravel\Attachments\Attachment;
use Pusher\Pusher;
use Pusher\PusherException;
use wDevStudio\LaravelMessenger\Facades\Messenger;

class MessangerRepository
{
    private $authId;
    private $pusher;

    /**
     * MessangerRepository constructor.
     * @param int|null $id
     */
    public function __construct(int $id = null)
    {
        $this->authId = $id;

        try {
            $this->pusher = new Pusher(
                config('messenger.pusher.app_key'),
                config('messenger.pusher.app_secret'),
                config('messenger.pusher.app_id'),
                [
                    'cluster' => config('messenger.pusher.options.cluster')
                ]
            );
        } catch (PusherException $e) {
            return response()->json('error', $e->getMessage());
        }
    }


    /**
     * Get Messages list.
     *
     * @param string|null $slug
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function messenger(string $slug = null)
    {
        $data = [];
        $data['redirect'] = false;
        $threads = Messenger::threads($this->authId);
        if (!$slug) {
            $slug = $threads[0]->withUser->slug ?? false;
            if ($slug) {
                $data['redirect'] = true;
            }
        }
        if ($slug) {
            $withId = User::where('slug', $slug)->firstOrFail()->id;
            Messenger::makeSeen($this->authId, $withId);
            $withUser = config('messenger.user.model', 'App\User')::findOrFail($withId);
            $messages = Messenger::messagesWith($this->authId, $withUser->id);

        } else {
            $withUser = false;
        }
        $data['slug'] = $slug;
        $data['withUser'] = $withUser??null;
        $data['messages'] = $messages??null;
        $data['threads'] = $threads??null;

        return $data;
    }

    /**
     * Send a new message.
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function send($data)
    {
        $conversation = $this->getConversation($data);
        $message = Messenger::newMessage($conversation->id, $this->authId, $data['message']);

        if (isset($data['message_files']) && is_array($data['message_files'])) {
            foreach ($data['message_files'] as $file) {
                Attachment::attach($file, $message);
            }
        }
        $files_html = view('messenger.partials.files', compact('message'))->render();

        try {
            $this->pusher->trigger('messenger-channel', 'messenger-event', [
                'message' => $message,
                'senderId' => $this->authId,
                'withId' => $data['withId'],
                'files_html' => $files_html,
                'avatar' => asset('storage/'.auth()->user()->avatar)
            ]);
        } catch (PusherException $e) {
            return response()->json('error', $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'files_html' => $files_html,
            'avatar' => asset('storage/'.auth()->user()->avatar)
        ], 200);

    }


    /**
     *  Load threads data.
     *
     * @param array $data
     * @return array
     */
    public function loadThreads(array $data)
    {
        return [
            'withUser' => config('messenger.user.model', 'App\User')::findOrFail($data['withId']),
            'threads' => Messenger::threads($this->authId)
        ];
    }

    /**
     * Load more data.
     *
     * @param array $data
     * @return mixed
     */
    public function moreMessages(array $data)
    {
        $messages = Messenger::messagesWith(
            $this->authId,
            $data['withId'],
            $data['take']
        );
        return $messages;
    }

    /**
     * Make a message seen.
     *
     * @param array $data
     * @return bool
     */
    public function makeSeen(array $data)
    {
        try {
            Messenger::makeSeen($data['authId'], $data['withId']);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    /**
     * Return conversation row
     *
     * @param $data
     * @return mixed
     */
    private function getConversation($data)
    {
        $withId = $data['withId'];
        $conversation = Messenger::getConversation($this->authId, $withId);

        if (!$conversation) {
            $conversation = Messenger::newConversation($this->authId, $withId);
        }
        return $conversation;
    }

}