<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Lockdown Clerk</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Vaani:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

	<!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/css/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body class="white-content">
<script>
    var baseUrl = '{{url("/")}}';
</script>
<div class="image-container set-full-height" style="background-image: url('assets/img/wizard.jpg')">
    <!--   Creative Tim Branding   -->
    <!-- <a href="http://creative-tim.com">
         <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('assets/img/new_logo.png')}}">
            </div>
            <div class="brand">
                Creative Tim
            </div>
        </div>
    </a> -->

	<!--  Made With Get Shit Done Kit  -->
		<!-- <a href="http://demos.creative-tim.com/get-shit-done/index.html?ref=get-shit-done-bootstrap-wizard" class="made-with-mk">
			<div class="brand">GK</div>
			<div class="made-with">Made with <strong>GSDK</strong></div>
		</a> -->

    <!--   Big container   -->
    <div class="container">
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
                
            <!--      Wizard container        -->
            <div class="wizard-container">

                <div class="card wizard-card" data-color="blue" id="wizardProfile">
                    <form action="{{ url('register') }}" method="POST">
                    @csrf
                <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->
                    <input type="hidden" name="request_type" value="1">
                    	<div class="wizard-header">
                        	<h3>
                        	   Let us get to know <b>you</b> <br>
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
                                    <h4 class="info-text"> Basic information</h4>
                                    <div class="col-sm-6">
                                        <div class="form-group radio-group">
                                            <label>Individual</label>
                                            <input class="select_individual" name="user_type" type="radio" class="form-control" value="1" 
                                                required/>
                                        </div>
                                    </div>   
                                    <div class="col-sm-6">
                                        <div class="form-group radio-group">
                                            <label>Corporate
                                                <input name="user_type" type="radio" class="form-control" value="2" 
                                                    required=""/>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="individual">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First Name <small>(required)</small></label>
                                                <input name="name" type="text" class="form-control" placeholder="Andrew...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Last Name <small>(required)</small></label>
                                                <input name="last_name" type="text" class="form-control" placeholder="Smith...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <div class="form-group">
                                                <label>Email <small>(required)</small></label>
                                                <a href="{{ route('login') }}" class="loginLink"><span><small >Click here to login</small></span></a>
                                                <input name="email" type="email" class="form-control" placeholder="johndoe@email.com" onblur="duplicateEmail(this)">
                                            </div>
                                            <!-- <div class="form-group">
                                            </div> -->
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Phone <small>(required)</small></label>
                                                <input name="phone" type="tel" class="form-control" placeholder="Phone No.">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Show Phone Number<small>(If No, you would be contacted via mail)</small></label>
                                                <select name="show_phone" class="form-control">
                                                    <option value="0"> No </option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Username <small>(required)</small></label>
                                                <input name="username" type="text" class="form-control" placeholder="Username" onblur="duplicateUserName(this)" class="username">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Password <small>(required)</small></label>
                                                <input name="password" type="password" class="form-control" placeholder="Password" id="password">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Confirm Password <small>(required)</small></label>
                                                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password." id="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="corporate">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Company Name <small>(required)</small></label>
                                                <input name="company_name" type="text" class="form-control" placeholder="John Doe Ltd...">
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
                                                <input name="name" type="text" class="form-control" placeholder="Andrew...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Contact Last Name <small>(required)</small></label>
                                                <input name="last_name" type="text" class="form-control" placeholder="Smith...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <div class="form-group">
                                                <label>Contact Email <small>(required)</small></label>
                                                <a href="{{ route('login') }}" class="loginLink"><span><small >Click here to login</small></span></a>
                                                <input name="email" type="email" class="form-control" placeholder="johndoe@email.com" onblur="duplicateEmail(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Phone <small>(required)</small></label>
                                                <input name="phone" type="tel" class="form-control" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Show Phone Number<small>(If No, you would be contacted via mail)</small></label>
                                                <select name="show_phone" class="form-control">
                                                    <option value="0"> No </option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Username <small>(required)</small></label>
                                                <input name="username" type="text" class="form-control" placeholder="Username" onblur="duplicateUserName(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Password <small>(required)</small></label>
                                                <input name="password" type="password" class="form-control" placeholder="Password...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">     
                                            <div class="form-group">
                                                <label>Confirm Password <small>(required)</small></label>
                                                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                    </div> 
                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="account">
                                <div class="row">

                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Category</label><br>
                                                    <select name="category_id" class="form-control">
                                                @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>        
                                                @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Type</label><br>
                                                <select name="type" class="form-control">
                                                    <option value=""> Type </option>
                                                    <option value="Free">Free</option>
                                                    <option value="Paid">Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>How would you like to be contacted?</label><br>
                                                <select name="mode_of_contact" class="form-control">
                                                    <option value="Email">Email</option>
                                                    <option value="Phone">Phone</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="tab-pane" id="description">
                                            <!-- <div class="row"> -->
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea name="description" class="form-control" placeholder="" rows="9"></textarea>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="address">
                                <div class="row">
                                    
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label>Country</label><br>
                                             <select name="country_id" class="form-control" id="country_id">
                                                <option value=""> Please Select a Country </option>
                                                @foreach($countries as $country)
                                                    <option {{ $country->sortname == $location ? "selected" : "" }} value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label>State</label><br>
                                             <select name="state_id" class="form-control" id="state_id" required>
                                                <option value=""> Select a State </option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label>City</label><br>
                                             <select name="city_id" class="form-control" id="city_id" required>
                                                <option value="">Select a city</option>
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                         <div class="form-group">
                                            <label>Street Name</label>
                                            <input type="text" name="street" class="form-control" placeholder="16 Maitama Avenue ">
                                          </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Show Street Address</label><br>
                                             <select name="show_address" class="form-control" id="show_address">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer height-wizard">
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

    <!-- <div class="footer">
        <div class="container">
             Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/bootstrap-wizard">here.</a>
        </div>
    </div> -->

</div>

</body>

	<!--   Core JS Files   -->
    <script src="{{ asset('white') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('white') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('white') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('assets/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="{{ asset('assets/js/gsdk-bootstrap-wizard.js')}}"></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>

</html>
