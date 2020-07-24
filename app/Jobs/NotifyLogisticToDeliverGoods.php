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

class NotifyLogisticToDeliverGoods implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $help_provider;
    public $main_request;
    public $request_bidder;
    public $logistic_partner;
    public $request_bidding_record;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $help_provider, LockdownRequest $main_request, User $request_bidder, User $logistic_partner,RequestBidders   $request_bidding_record)
    {
        $this->help_provider = $help_provider;
        $this->main_request = $main_request;
        $this->request_bidder = $request_bidder;
        $this->logistic_partner = $logistic_partner;
        $this->request_bidding_record = $request_bidding_record;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
                Mail::send('emails.notify_logistic_to_deliver_goods', ['help_provider' => $this->help_provider,'main_request'=>$this->main_request, 'request_bidder'=>$this->request_bidder, 'logistic_partner'=>$this->logistic_partner, 'request_bidding_record'=>$this->request_bidding_record], function ($message) {

    $message->subject('Request to deliver goods');
    $message->from('itaforfrancis@gmail.com', 'MyHelperApp');
    $message->to($this->logistic_partner->email)->cc($this->help_provider->email);
  });

    }
}
