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

class SendhelpSeekerInfoToLogisticPartner implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $help_provider;
    public $main_request;
    public $request_owner;
    public $logistic_partner;
    public $request_bidding_record;
      /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $help_provider, LockdownRequest $main_request, User $request_owner, User $logistic_partner,RequestBidders   $request_bidding_record)
    {
        $this->help_provider = $help_provider;
        $this->main_request = $main_request;
        $this->request_owner = $request_owner;
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
         Mail::send('emails.sendhelpSeekerInfoToLogisticPartner', ['help_provider' => $this->help_provider,'main_request'=>$this->main_request, 'request_owner'=>$this->request_owner, 'logistic_partner'=>$this->logistic_partner, 'request_bidding_record'=>$this->request_bidding_record], function ($message) {

    $message->subject('Request to deliver goods');
    $message->from('noreply@myhelperapp.com', 'MyHelperApp');
    $message->to($this->logistic_partner->email);
  });
    }
}
