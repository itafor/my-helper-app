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

class SendRequestToGetHelp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request_bidder;
    public $user_request;
    public $help_provider;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $request_bidder, LockdownRequest $user_request, User $help_provider)
    {
        $this->request_bidder = $request_bidder;
        $this->user_request = $user_request;
        $this->help_provider = $help_provider;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
          Mail::send('emails.send_request_to_get_help', ['request_bidder' => $this->request_bidder,'user_request'=>$this->user_request, 'help_provider'=>$this->help_provider], function ($message) {
            
    $message->from('itaforfrancis@gmail.com', 'MyHelperApp');

    $message->to($this->help_provider->email)->cc('admin@myhelperapp.com');
  });
    }
}
