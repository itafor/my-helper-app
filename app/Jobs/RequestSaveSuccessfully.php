<?php

namespace App\Jobs;

use App\LockdownRequest;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RequestSaveSuccessfully implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

public $main_request;
public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(LockdownRequest $req, User $req_owner)
    {
        $this->main_request = $req;
        $this->user = $req_owner;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
     Mail::send('emails.requestSavedSuccessfully', ['main_request' => $this->main_request,'user'=>$this->user], function ($message) {

    $message->subject('Request Received!!');
    $message->from('noreply@myhelperapp.com', 'MyHelperApp');
    $message->to($this->user->email);
  });
    }
}
