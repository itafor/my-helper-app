@extends('layouts.app', ['pageSlug' => 'calculate_deliveryfee'])
<style type="text/css">
      #rental_table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}

#rental_table td{
  border: 1px solid #ddd;
  padding: 8px;
}
#rental_table .rent_title{
  width: 150px;
}
</style>
@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
               <div class="card">
  <div class="card-header">
  Delivery Fee Calculator
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
                                                        <option  value="{{ $city['CityCode'] }}">{{ $city['CityName'] }}</option>
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
                            <label for="Weight">Weight</label>
                              <input type="text" name="Weight" class="form-control" required>
                            </div>
                           
                          </div>
        <div class="card-footer text-center mb-20">
                        <button type="submit" class="btn btn-round btn-lg btn-lg-pd btn-custom">{{ _('Calculate') }}</button>
                    </div>
    </form>

@if(isset($deliveryFee))
<hr>
    <h3>Delivery Fee details </h3>
@foreach($deliveryFee as $fee)
 <table class="table table-bordered" id="rental_table">
           
                    <tbody>
                   <tr>
                     <td class="rent_title">Delivery Fee</td>
                     <td> 
                         &#8358;{{$fee['DeliveryFee']}} 
                       
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Vat Amount</td>
                     <td>  
                 &#8358;{{$fee['VatAmount']}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Total Amount</td>
                     <td>
                 &#8358;{{$fee['TotalAmount']}}
                     </td>
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
    
@endsection
