@extends('layouts.app-blue', ['pageSlug' => 'check_payment_status'])

@section('content')
    <div class="page-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-10 page-auto">
                    <div class="form-wrap mt-20 mb-20">
                      <div id="card" class="card">
                          <div class="card-header text-center">
                              <h2>Check Payment Status</h2>
                          </div>
                          <div class="card-body">
                              <form action="{{ route('check.payment.status') }}" method="post">
                                  @csrf

                             
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <label for="inputweight">Payment Reference</label>
                                          <input name="paymentRef" id="paymentRef" class="form-control" required="required" placeholder="Enter your payment reference">
                                      </div>
                                     
                                  </div>

                                  <div class="card-footer ">
                                    <button type="submit" class="btn btn_simple btn_transparent btn_ggPrimary2">{{ _('Check Payment Status') }}</button>
                                  </div>
                              </form>
                         
                          </div>
        
                      </div>
                  </div>
              </div>
        </div>
    </div>
</div>
    
@endsection
