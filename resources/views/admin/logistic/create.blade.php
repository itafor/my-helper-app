
@extends('admin.layouts.master',['pageSlug' => 'logistic'])



@section('title')

Admin | Logistic Agents

@endsection

@section('content')

  <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title float-left">Logistics Agents: Add New</h5>
                <h5 class="title float-right">
                </h5>
              </div>
              <br>
              <br>
              <div class="card-body">
                <form class="form" method="post" action="{{ route('admin.logistic.agent.store') }}">
                    @csrf

                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Company Name </label>
                        <input type="text" name="company_name" class="form-control"  placeholder="Company">
                         @error('company_name')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        
                    @error('username')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                      </div>
                        @error('email')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="Company phone">
                        @error('phone')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                   
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Password">
                          @error('password')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                     <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="text" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                         @error('password_confirmation')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                  </div>
                
                  <div class="row">

                     <div class="col-md-4 px-1">
                      <div class="form-group">
                         <label>Country</label>
                          <select name="country_id" id="country_id" class="form-control" placeholder="{{ __('Country') }}" value="{{ old('country_id') }}" required >
                                        <option value="">Select a country</option>
                                        @foreach(getCountries() as $country)
                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                     @error('country_id')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                     <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>State</label>
                        <select name="state_id" id="state_id" class="form-control" placeholder="{{ __('State') }}" value="{{ old('state') }}" required >
                                        <option value="">Select State</option>
                                    </select>
                                    @error('state_id')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>City</label>
                        <select name="city_id" id="city_id" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="{{ __('City') }}" value="{{ old('street') }}" required >
                                        <option value="">Select City</option>
                                    </select>
                                   @error('city_id')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                    
                  </div>
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="street" class="form-control" placeholder="Street Address">
                          @error('street')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       <div class="card-footer text-center mb-20">
                        <button type="submit" class="btn btn-round btn-lg btn-lg-pd btn-custom">{{ _('Submit') }}</button>
                    </div>
                       
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
         
        </div>
      </div>

@endsection


@section('scripts')


@endsection