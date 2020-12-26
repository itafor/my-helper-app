@extends('layouts.app-blue', ['pageSlug' => 'calculate_deliveryfee'])

@section('content')
    <div class="page-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-10 page-auto">
                    <div class="form-wrap mt-20 mb-20">
                      <div id="card" class="card">
                          <div class="card-header text-center">
                              <h2>Delivery Fee Calculator</h2>
                          </div>
                          <div class="card-body">
                              <form action="{{ route('pickupRequest.calculate.deliveryfeeOperation') }}" method="post">
                                  @csrf

                                  <div class="row">
                                      <div class="col-sm-6">
                                        <label for="inputweight">Origin City</label>
                                          <select name="Origin" id="Origin" class="form-control" required >
                                              <option value="">Select Origin City</option>
                                              @foreach(clickship_cities() as $city)
                                              <option  value="{{ $city['CityName'] }}">{{ $city['CityName'] }}</option>
                                              @endforeach
                                          </select>
                                      </div>

                                      <div class="col-sm-6">
                                          <label for="inputweight">Destination City</label>
                                          <select name="Destination" id="RecipientCity" class="form-control" required >
                                              <option value="">Select Destination City</option>
                                              @foreach(clickship_cities() as $city)
                                            <!--  @Francis, do you intend tp use CityCode here or CityName?
                                              <option  value="{{ $city['CityCode'] }}">{{ $city['CityName'] }}</option>-->
                                              <option  value="{{ $city['CityName'] }}">{{ $city['CityName'] }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <label for="inputweight">OnforwardingTownID (Optional)</label>
                                          <select name="OnforwardingTownID" id="RecipientTownID" class="form-control" >
                                              <option value="">Select Delivery Town ID</option>
                                          </select>
                                      </div>

                                      <div class="col-sm-6">
                                          <label for="Weight">Item Size</label>
                                          <select name="Weight" class="form-control" required>
                                              <option value="">Select Item Size</option>
                                              <option value="1">Small</option>
                                              <option value="2">Medium</option>
                                              <option value="4">Large</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="card-footer text-center mb-20">
                                    <button type="submit" class="btn btn_simple btn_transparent btn_ggPrimary2">{{ _('Calculate') }}</button>
                                  </div>
                              </form>
                              @if(isset($deliveryFee)) 
                              @php                              
                              $del_city = strtolower($_REQUEST['Destination']);
                              $org_city = strtolower($_REQUEST['Origin']);
                              @endphp
                              <hr>
                              <h3 class="block-span">Delivery Fee Details <span>From ( {{ $org_city }} ) To ( {{ $del_city }} )</span></h3>
                              @foreach($deliveryFee as $fee)
                              <table class="table table-bordered" id="rental_table">
                                  <tbody>
                                      <tr>
                                          <td class="rent_title">Delivery Fee</td>
                                          <td>&#8358;{{$fee['DeliveryFee']}}</td> 
                                      </tr>
                                      <tr>
                                          <td class="rent_title">Vat Amount</td>
                                          <td>&#8358;{{$fee['VatAmount']}}</td> 
                                      </tr>
                                      <tr>
                                          <td class="rent_title">Total Amount</td>
                                          <td>&#8358;{{$fee['TotalAmount']}}</td> 
                                      </tr>
                                  </tbody>
                              </table>                              
                              @endforeach
                              @endif
                          </div>
        
                      </div>
                  </div>
              </div>
        </div>
    </div>
</div>
    
@endsection
