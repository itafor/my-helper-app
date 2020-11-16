@extends('layouts.app', ['pageSlug' => ''])

@section('content')
<div class="image-container set-full-height" style="background-image: url('assets/img/wizard.jpg')">
    
    <!--   Big container   -->
    <div class="container">
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <!--      Wizard container        -->
            <div class="wizard-container">

                <div class="card wizard-card" data-color="blue" id="wizardProfile">
                    <form action="{{ url('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->
                    <input type="hidden" name="request_type" value="2">
                        <div class="wizard-header">
                            <h3>
                               What do you want to provide <br />for the <b>Lock down</b> ? <br>
                               <!-- <small>This information will let us know more about you.</small> -->
                            </h3>
                        </div>

                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#account" data-toggle="tab">Requests</a></li>
                                <li><a href="#address" data-toggle="tab">Location</a></li>
                                <li><a href="#about" data-toggle="tab">Personal Info</a></li>
                            </ul>

                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="info-text"> Basic information</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group radio-group">
                                            <label>Individual</label>
                                            <input class="select_individual" name="user_type" type="radio" class="form-control" value="1" required>
                                        </div>
                                    </div>   
                                    <div class="col-sm-6">
                                        <div class="form-group radio-group">
                                            <label>Corporate
                                                <input class="select_corporate" name="user_type" type="radio" class="form-control" value="2" required>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="individual">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First Name <small>(required)</small></label>
                                                <input name="name" type="text" class="form-control" placeholder="Andrew..." required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Last Name <small>(required)</small></label>
                                                <input name="last_name" type="text" class="form-control" placeholder="Smith..." required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <div class="form-group">
                                                <label>Email <small>(required)</small></label>
                                                <a href="{{ route('login') }}" class="loginLink"><span><small >Click here to login</small></span></a>
                                                <input name="email" type="email" class="form-control" placeholder="johndoe@email.com" onblur="duplicateEmail(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Phone <small>(required)</small></label>
                                                <input name="phone" type="tel" class="form-control" placeholder="Phone No." required>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12">     
                                            <div class="form-group">
                                                <label>Username <small>(required)</small></label>
                                                <input name="username" type="text" class="form-control" placeholder="Username" onblur="duplicateUserName(this)" class="username" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Password <small>(required)</small></label>
                                                <input name="password" type="password" class="form-control" placeholder="Password..." required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Confirm Password <small>(required)</small></label>
                                                <input name="password_confirmation" type="password" class="form-control" placeholder="Smith..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="corporate">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Company Name <small>(required)</small></label>
                                                <input name="company_name" type="text" class="form-control" placeholder="John Doe Ltd..." required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Company Website <small>(required)</small></label>
                                                <input name="website" type="text" class="form-control form-control-alternative{{ $errors->has('website') ? ' is-invalid' : '' }}" placeholder="https://www.example.com">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Contact First Name <small>(required)</small></label>
                                                <input name="name" type="text" class="form-control" placeholder="Andrew..." required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Contact Last Name <small>(required)</small></label>
                                                <input name="last_name" type="text" class="form-control" placeholder="Smith..." required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <div class="form-group">
                                                <label>Contact Email <small>(required)</small></label>
                                                <a href="{{ route('login') }}" class="loginLink"><span><small >Click here to login</small></span></a>
                                                <input name="email" type="email" class="form-control" placeholder="johndoe@email.com" onblur="duplicateEmail(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Phone <small>(required)</small></label>
                                                <input name="phone" type="tel" class="form-control" placeholder="Phone" required>
                                            </div>
                                        </div>
                                      
                                        <div class="col-sm-12">     
                                            <div class="form-group">
                                                <label>Username <small>(required)</small></label>
                                                <input name="username" type="text" class="form-control" placeholder="Username" class="username" onblur="duplicateUserName(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Password <small>(required)</small></label>
                                                <input name="password" type="password" class="form-control" placeholder="Password" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Confirm Password <small>(required)</small></label>
                                                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="account">
                                <div class="row">

                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Category</label><br>
                                                    <select name="category_id" class="form-control" required>
                                                @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>        
                                                @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                     
                                      
                                      
                                        <div class="tab-pane" id="description">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea name="description" class="form-control" placeholder="" rows="9" required></textarea>
                                                    </div>
                                                </div>

                                     <h4>Item Size In Weight <small>(and Pickup/delivery price)</small>
                                     </h4>

                                                 <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('show_address') ? ' has-danger' : '' }}">
                                                <input class="form-check-input" type="radio" name="weight" id="weight1" value="3.5" style="margin-left: 5px;" required>
                                            <label class="form-check-label" for="weight1" style="margin-left: 20px;"><b>SMALL (3.5 kg)</b>
                                            <br>
                                            N800
                                            <br>
                                              </label>
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                             <input class="form-check-input" type="radio" name="weight" id="weight2" value="7.5" style="margin-left: 5px;" required>
                                                <label class="form-check-label" for="weight2" style="margin-left: 20px;"><b>MEDIUM (7.5.0 kg)</b>
                                                 <br>
                                          N1,500
                                            <br>
                                              </label>
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('delivery_cost_payer') ? ' has-danger' : '' }}">
                                               <input class="form-check-input" type="radio" name="weight" id="weight3" value="10.0" style="margin-left: 5px;" required>
                                            <label class="form-check-label" for="weight3" style="margin-left: 20px;"><b>LARGE (10.0 kg)</b>
                                             <br>
                                           N2,000
                                            <br>
                                            </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                       <label> <small>Please note that pickup or delivery in outskirt locations will attract extral charges</small> </label>
                                    </div>
                                    
                                     <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('delivery_cost_payer') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="delivery_cost_payer"><strong>{{ __('Who will pay delivery cost') }}</strong></label>
                                                <select name="delivery_cost_payer" id="delivery_cost_payer" class="form-control" required>
                                                    <option value="">Select delivey fee payer</option>
                                                    @foreach(payment_types() as $paymentype)
                                                        <option  value="{{ $paymentype['PaymentType'] }}">{{ $paymentype['PaymentType'] =='pay on delivery' ? 'Receiver will pay for shipping cost':'Sender will pay for shipping cost' }}</option>
                                                    @endforeach
                                                </select>
                                               
                                            </div>
                                        </div>


     
                                <div class="col-md-12">
                                    <label class="form-control-label" for="input-property_type">{{ __('Photos') }} (Optional)</label>
                                    <input type="file" name="photos[112211][image_url]"  class="form-control">
                                </div>
                            
                                  <div style="clear:both"></div>
                                <div id="photoContainer" class="col-md-12">
                                </div>   
                                  <div style="clear:both"></div>

                                     <div class="form-group">
                                    <button type="button" id="addMorePhoto" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i>  Add more photo</button>
                                </div>

                                </div>
                                        </div>
                                    </div>

                            




                            </div>
                            <div class="tab-pane" id="address">
                                <div class="row">
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label>State</label><br>
                                               <select name="api_state" id="api_state_id" class="form-control" placeholder="{{ __('api_state') }}" value="{{ old('api_state') }}" required >
                                                    <option value="">Select a state</option>
                                                    @foreach(clickship_states() as $state)
                                                        <option  value="{{ $state['StateName'] }}">{{ $state['StateName'] }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label>City</label><br>
                                              <select name="api_city" id="api_city_id" class="form-control form-control-alternative{{ $errors->has('api_city_id') ? ' is-invalid' : '' }}" placeholder="{{ __('api_city_id') }}" value="{{ old('api_city_id') }}" required >
                                                    <option value="">Select City</option>
                                                   
                                                </select>
                                          </div>
                                    </div>
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label>Delivery Town</label><br>
                                              <select name="api_onforwarding_town_id" id="api_onforwarding_town_id" class="form-control form-control-alternative{{ $errors->has('api_onforwarding_town_id') ? ' is-invalid' : '' }}" placeholder="{{ __('api_onforwarding_town_id') }}" value="{{ old('street') }}">
                                                    <option value="">Select Town</option>
                                                </select>
                                          </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                         <div class="form-group">
                                            <label>Street Name</label>
                                            <input type="text" name="street" class="form-control" placeholder="16 Maitama Avenue" required>
                                          </div>
                                    </div>
                                  
                                </div>

                                    <input type="hidden" name="api_delivery_town_id" id="api_delivery_town_id">


                            </div>
                        </div>
                        <div class="wizard-footer height-wizard">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm btn-custom' name='next' value='Next' />
                                <input type='submit' id="finish" class='btn btn-finish btn-fill btn-warning btn-wd btn-sm btn-custom'/>

                            </div>

                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm btn-custom' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </form>
                </div>
                <div class="col-sm-6 loginLink">
                    <h2>
                        <b>
                            Please Login <a href="{{ route('login') }}">here</a> 
                        </b>
                    </h2>

                </div>
            </div> <!-- wizard container -->
            
        </div>
        </div><!-- end row -->
    </div> <!--  big container -->

    <!-- <div class="footer">
        <div class="container">
             Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/bootstrap-wizard">here.</a>
        </div>
    </div> -->

</div>

@endsection