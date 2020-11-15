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

class sendConfirmationCodeToReceiver implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $help_provider;
    public $main_request;
    public $request_bidder;
    public $request_bidding_record;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $help_provider, LockdownRequest $main_request, User $request_bidder,RequestBidders   $request_bidding_record)
    {
        $this->help_provider = $help_provider;
        $this->main_request = $main_request;
        $this->request_bidder = $request_bidder;
        $this->request_bidding_record = $request_bidding_record;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.send_confirmation_code_to_receiver', ['help_provider' => $this->help_provider,'main_request'=>$this->main_request, 'request_bidder'=>$this->request_bidder,'request_bidding_record'=>$this->request_bidding_record], function ($message) {

    $message->subject('Request Approval and shipment Notification');
    $message->from('noreply@myhelperapp.com', 'MyHelperApp');
    $message->to($this->request_bidder->email);
  });

    }
}
