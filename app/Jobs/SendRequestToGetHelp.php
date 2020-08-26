<?php

namespace App\Jobs;

use App\LockdownRequest;
use App\RequestBidders;
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
    public $request_bidders;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $request_bidder, LockdownRequest $user_request, User $help_provider, RequestBidders $request_bidders)
    {
        $this->request_bidder = $request_bidder;
        $this->user_request = $user_request;
        $this->help_provider = $help_provider;
        $this->request_bidders = $request_bidders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
          Mail::send('emails.send_request_to_get_help', ['request_bidder' => $this->request_bidder,'user_request'=>$this->user_request, 'help_provider'=>$this->help_provider, 'request_bidders'=>$this->request_bidders], function ($message) {

    $message->subject('Indication of interest to get help');

    $message->from('noreply@myhelperapp.com', 'MyHelperApp');

    $message->to($this->help_provider->email)->cc('admin@myhelperapp.com');
  });
    }
}
