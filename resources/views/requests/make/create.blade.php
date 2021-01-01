@extends('layouts.app-blue', ['pageSlug' => ''])

@section('content')

 <div class="page-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8 request-panel">
                
                <!--  Wizard container  -->
                <div class="wizard-container">

                    <div class="card wizard-card" data-color="blue" id="wizardProfile">
                        <form action="{{ url('register') }}" method="POST" autocomplete="off">
                        @csrf
                    
                            <input type="hidden" name="request_type" value="1">
                            <div class="card-header wizard-header text-center">
                                <h2>
                                   Get Help
                                </h2>
                            </div>

                            <div class="card-body">
                                <div class="wizard-navigation">
                                    <ul>
                                        <li><a href="#account" data-toggle="tab">Requests</a></li>
                                        <li><a href="#address" data-toggle="tab">Location</a></li>
                                        <li><a href="#about" data-toggle="tab">Personal Info</a></li>
                                    </ul>

                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane" id="about">
                                        <div class="row group-wrap">
                                           <div class="col-md-12">
                                                <h4 class="info-text"> Basic information</h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group radio-group">
                                                    <label for="user_type_ind">Individual</label>
                                                    <input class="select_individual" name="user_type" id="user_type_ind" type="radio" class="form-control" value="1" required/>
                                                </div>
                                            </div>   
                                            <div class="col-sm-6">
                                                <div class="form-group radio-group">
                                                    <label for="user_type_cor">Corporate</label>
                                                    <input class="select_individual" name="user_type" id="user_type_cor" type="radio" class="form-control" value="2" required=""/>                                                
                                                </div>
                                            </div> 


                                            <div class="row individual">
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
                                                        <a href="{{ route('login') }}" class="loginLink"><span><small class="loginText" >Click here to login</small></span></a>
                                                        <input name="email" type="email" class="form-control" placeholder="johndoe@email.com" onblur="duplicateEmail(this)" required>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                    </div> -->
                                                </div>
                                                <div class="col-sm-6">     
                                                    <div class="form-group">
                                                        <label>Phone <small>(required)</small></label>
                                                        <input name="phone" type="tel" class="form-control" placeholder="Phone No." required>
                                                    </div>
                                                </div>
                                               <!--  <div class="col-sm-6">     
                                                    <div class="form-group">
                                                        <label>Show Phone Number<small>(If No, you would be contacted via mail)</small></label>
                                                        <select name="show_phone" class="form-control">
                                                            <option value="0"> No </option>
                                                            <option value="1">Yes</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="col-sm-12">     
                                                    <div class="form-group">
                                                        <label>Username <small>(required)</small></label>

                                                        <!-- this input was disabled for testing purposes and should be enabled later. The next input be deleted.

                                                        <input name="username" type="text" class="form-control" placeholder="Username" onblur="duplicateUserName(this)" class="username" required>-->
                                                        <input name="username" type="text" class="form-control" placeholder="Username"  class="username" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">     
                                                    <div class="form-group">
                                                        <label>Password <small>(required)</small></label>
                                                        <input name="password" type="password" class="form-control" placeholder="Password" id="password" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">     
                                                    <div class="form-group">
                                                        <label>Confirm Password <small>(required)</small></label>
                                                        <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password." id="password_confirmation" required>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row corporate">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Company Name <small>(required)</small></label>
                                                        <input name="company_name" type="text" class="form-control" placeholder="John Doe Ltd..." required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">     
                                                    <div class="form-group">
                                                        <label>Company Website <small>(required)</small></label>
                                                        <input name="website" type="text" class="form-control" placeholder="https://www.example.com">
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
                                                <!-- <div class="col-sm-6">     
                                                    <div class="form-group">
                                                        <label>Show Phone Number<small>(If No, you would be contacted via mail)</small></label>
                                                        <select name="show_phone" class="form-control">
                                                            <option value="0"> No </option>
                                                            <option value="1">Yes</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="col-sm-12">     
                                                    <div class="form-group">
                                                        <label>Username <small>(required)</small></label>
                                                        <input name="username" type="text" class="form-control" placeholder="Username" onblur="duplicateUserName(this)" required>
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
                                                        <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required>
                                                    </div>
                                                </div>
                                            </div> 
                                            
                                        </div>
                                    </div>


                                    <div class="tab-pane" id="account">
                                        <div class="row group-wrap">

                                            <div class="col-md-12">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Item Category</label><br>
                                                        <select  name="category_id" id="category_id" class="form-control" required>
                                                            
                                                <option value="">Select Item Category</option>

                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                             <div class="col-sm-12">
                                    <div class="form-group">
                                        <label id="itemlabel"></label><br>
                                        <div id="multipleItem"></div>
                                    </div>
                                </div>
                                              
                                                <div class="tab-pane" id="description">
                                                    
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea name="description" class="form-control" placeholder="" rows="5" required></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="address">
                                        <div class="row group-wrap">
                                            
                                            <div class="col-sm-6">
                                                 <div class="form-group">
                                                    <label>State</label><br>
                                                    <select name="api_state" id="api_state_id" class="form-control form-control-alternative{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ __('Country') }}" value="{{ old('country') }}" required >
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
                                                      <select name="api_onforwarding_town_id" id="api_onforwarding_town_id" class="form-control form-control-alternative{{ $errors->has('api_onforwarding_town_id') ? ' is-invalid' : '' }}" placeholder="{{ __('api_onforwarding_town_id') }}" value="{{ old('street') }}" required>
                                                            <option value="">Select Town</option>
                                                        </select>
                                                  </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                 <div class="form-group">
                                                    <label>Street Name</label>
                                                    <input type="text" name="street" class="form-control" placeholder="16 Maitama Avenue " required>
                                                  </div>
                                            </div>
                                         
                                        </div>
                                            <input type="hidden" name="api_delivery_town_id" id="api_delivery_town_id">

                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer card-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm btn-custom' name='next' value='Next' />
                                    <input type='submit' id="finish" class='btn btn-finish btn-fill btn-warning btn-wd btn-sm btn-custom'/>

                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-primary btn-wd btn-sm btn-custom' name='previous' value='Previous' />
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </form>
                        
                    </div>
                    <!-- <div class="col-sm-6 loginLink">
                        <h2>
                            <b>
                                Please Login <a href="{{ route('login') }}">here</a> 
                            </b>
                        </h2>

                    </div> -->
                </div> <!-- wizard container -->
                
            </div>
        </div><!-- end row -->
    </div> <!--  big container -->

</div>
@endsection
