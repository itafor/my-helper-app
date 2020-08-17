@extends('layouts.app', ['pageSlug' => 'Requests'])
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
  Pickup Request Details
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
       <table class="table table-bordered" id="rental_table">
           
                    <tbody>

                   <tr>
                     <td class="rent_title">Transaction Status</td>
                     <td> 
                        {{$get_pickup_request->TransStatus}} 
                       
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Transaction Status Details</td>
                     <td>  
                {{$get_pickup_request->TransStatusDetails}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Order No.</td>
                     <td>
                {{$get_pickup_request->OrderNo}}
                     </td>
                   </tr>

                     <tr>
                     <td class="rent_title">Way Bill Number</td>
                     <td>
                {{$get_pickup_request->WaybillNumber}}
 
                     </td>
                   </tr>

                    <tr>
                     <td class="rent_title">Delivery Fee</td>
                <td>
                &#8358;{{$get_pickup_request->DeliveryFee}}
                </td>           
              </tr>

                 <tr>
                     <td class="rent_title">Vat Amount</td>
                     <td>
                 &#8358;{{$get_pickup_request->VatAmount}}
                     </td>
                </tr>

                 <tr>
                     <td class="rent_title">Total Amount</td>
                     <td>
                 &#8358;{{$get_pickup_request->TotalAmount}}
                    
                    </td>
                </tr>

                <tr>
                     <td class="rent_title">Description</td>
                     <td>
                 {{$get_pickup_request->Description}}
                    
                    </td>
                </tr>

                  <tr>
                     <td class="rent_title">Weight</td>
                     <td>
                 {{$get_pickup_request->Weight}}
                    
                    </td>
                </tr>

                  <tr>
                     <td class="rent_title">Sender Name</td>
                     <td>
                 {{$get_pickup_request->SenderName}}
                    
                    </td>
                </tr>

                  <tr>
                     <td class="rent_title">Sender City</td>
                     <td>
                 {{$get_pickup_request->SenderCity}}
                    
                    </td>
                </tr>

                  <tr>
                     <td class="rent_title">Sender Town ID</td>
                     <td>
                 {{$get_pickup_request->SenderTownID}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Sender Address</td>
                     <td>
                 {{$get_pickup_request->SenderAddress}}
                    
                    </td>
                </tr>


                 <tr>
                     <td class="rent_title">Sender Phone</td>
                     <td>
                 {{$get_pickup_request->SenderPhone}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Sender Email</td>
                     <td>
                 {{$get_pickup_request->SenderEmail}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Recipient Name</td>
                     <td>
                 {{$get_pickup_request->RecipientName}}
                    
                    </td>
                </tr>

                <tr>
                     <td class="rent_title">Recipient City</td>
                     <td>
                 {{$get_pickup_request->RecipientCity}}
                    
                    </td>
                </tr>

                <tr>
                     <td class="rent_title">Recipient Town ID</td>
                     <td>
                 {{$get_pickup_request->RecipientTownID}}
                    
                    </td>
                </tr>

                <tr>
                     <td class="rent_title">Recipient Address</td>
                     <td>
                 {{$get_pickup_request->RecipientAddress}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">RecipientPhone</td>
                     <td>
                 {{$get_pickup_request->RecipientPhone}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Recipient Address</td>
                     <td>
                 {{$get_pickup_request->RecipientAddress}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Recipient Address</td>
                     <td>
                 {{$get_pickup_request->RecipientAddress}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Recipient Address</td>
                     <td>
                 {{$get_pickup_request->RecipientAddress}}
                    
                    </td>
                </tr>
               
       </tbody>
                  </table>
    
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
        </div>
    </div>
    
@endsection
