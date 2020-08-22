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

         <li @if ($pageSlug == 'productServices') class="active " @endif>
                <a href="{{ route('user.product.services')  }}">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                    <p>{{ _('Products & Services') }}</p>
                </a>
            </li>
            <!-- <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('Laravel Examples') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ _('User Profile') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('User Management') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->
            
        </ul>
    </div>
</div>
