<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <!--<a href="#" class="simple-text logo-mini">{{ _('LC') }}</a>-->
            <a href="#" class="simple-text logo-normal">{{ _('Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'Requests') class="active " @endif>
                <a href="{{ route('requests') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ _('All Requests') }}</p>
                </a>
            </li>
              <li @if ($pageSlug == 'user_requests') class="active " @endif>
                <a href="{{ route('user.request') }}">
                   <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <p>{{ _('My Requests') }}</p>
                </a>
            </li>

            <li @if ($pageSlug == 'shipment_tracker') class="active " @endif>
                <a href="{{ route('pickupRequest.shipmenttracker') }}">
                   <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <p>{{ _('Shipments Tracker') }}</p>
                </a>
            </li>

             <li @if ($pageSlug == 'check_payment_status') class="active " @endif>
                <a href="{{ route('check.payment.status.form') }}">
                   <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <p>{{ _('Payment Status') }}</p>
                </a>
            </li>

             <li @if ($pageSlug == 'calculate_deliveryfee') class="active " @endif>
                <a href="{{ route('pickupRequest.calculate.deliveryfee') }}">
                   <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <p>{{ _('Calculate Delivery Fee') }}</p>
                </a>
            </li>

            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('profile.edit')  }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ _('User Profile') }}</p>
                </a>
            </li>

      
        
        </ul>
    </div>
</div>
