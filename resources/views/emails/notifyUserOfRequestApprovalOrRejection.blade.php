<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Rental | Asset Clerk</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
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

/* The grid: Four equal columns that floats next to each other */
.column {
  float: left;
  width: 20%;
  padding: 10px;
}

/* Style the images inside the grid */
.column img {
  opacity: 0.8;
  cursor: pointer;
}

.column img:hover {
  opacity: 1;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* The expanding image container (positioning is needed to position the close button and the text) */
.container {
  position: relative;
  /*display: none;*/
}

/* Expanding image text */
#imgtext {
  position: absolute;
  bottom: 15px;
  left: 15px;
  color: white;
  font-size: 20px;
}

/* Closable button inside the image */
.closebtn {
  position: absolute;
  top: 10px;
  right: 15px;
  color: red;
  font-size: 35px;
  cursor: pointer;
}

#sample_photos{
    width: 100px;
    height: 100px;
}
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left">{{$request_bidding_record->status == 'Approved' ? 'Request Acceptance Notification':'Request Rejection Notification'}} </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
<p>
                    Dear <strong>{{$help_provider->name}} {{$help_provider->last_name}}</strong>,<br><br>
        
         @if($request_bidding_record->status == 'Approved')

 We wish to notify you that your request to provide help on <a href="{{url('/')}}">Myhelperapp.com</a> have been <b>accepted</b> by the receiver, and pickup request has been sent to Red Star Express (RSE) Delivery Service.<br>

 Items Category : {{$main_request->category ? $main_request->category->title : 'N/A' }} <br>
 Items Description: {{$main_request->description }}<br><br>

 Items Weight (kg): {{$main_request->weight ? $main_request->weight : 'N/A' }} <br>

   @foreach(deliveryFee($main_request->api_city,providerDetail($main_request->id,$help_provider->id)['api_city'],$main_request->weight,providerDetail($main_request->id,$help_provider->id)['api_delivery_town_id']) as $fee)
            <table class="table table-bordered" id="rental_table">
           
                    <tbody>
                      <br>
                      <h5>Delivery fee detail</h5>
                   <tr>
                     <td class="rent_title">Delivery Fee</td>
                     <td> 
                  &#8358;{{number_format($fee['DeliveryFee'],2)}} 
                       
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Vat Amount</td>
                     <td>  
                 &#8358;{{number_format($fee['VatAmount'],2)}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Total Amount</td>
                     <td>
                 &#8358;{{number_format($fee['TotalAmount'],2)}}
                     </td>
                   </tr>
</tbody>
</table>
                          @endforeach
<br>
  Delivery Fee Payer: <strong class="text-danger">{{$main_request->delivery_cost_payer =='prepaid' ? 'Sender will pay for Shipping cost':'Receiver will pay for Shipping cost'}}</strong><br>

   
 <p>Receiver Comment: {{$request_bidding_record->comment ? $request_bidding_record->comment : 'N/A'}}</p><br>
Please find the receiver details below.

  <a href="{{route('auth_view.make.request',[$main_request->id])}}">View Request Details</a>

 @else

We wish to notify you that your request to provide help on <a href="{{url('/')}}">Myhelperapp.com</a> have been <b>rejected</b> by the receiver.<br>

Items Category:: {{$main_request->category ? $main_request->category->title : 'N/A' }} <br>
Items Description: {{$main_request->description }}<br><br>

  <a href="{{route('auth_view.make.request',[$main_request->id])}}">View Request Details</a>

 @endif
</p>

<br>
<br>

<hr>

<h3>Help Receiver details</h3>

 <table class="table table-bordered" id="rental_table">
           
                    <tbody>

                   <tr>
                     <td class="rent_title">Full Name</td>
                     <td> 
                        {{$request_owner ? $request_owner->name : 'N/A'}} 
                        {{$request_owner ? $request_owner->last_name : 'N/A'}}
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Phone Number</td>
                     <td>  
                {{$request_owner ? $request_owner->phone : 'N/A'}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Email</td>
                     <td> {{$request_owner ? $request_owner->email : 'N/A'}}</td>
                   </tr>

                    <tr>
                     <td class="rent_title">State</td>
                <td>
    {{$main_request->api_state ? $main_request->api_state : 'N/A'}}
                </td>           
              </tr>

                 <tr>
                     <td class="rent_title">City</td>
                     <td>
    {{$main_request->api_city ? $main_request->api_city : 'N/A'}}
                     </td>
                </tr>

                <tr>
                     <td class="rent_title">OnforwardingTownId</td>
                     <td>
    {{$main_request->api_delivery_town_id ? $main_request->api_delivery_town_id : 'N/A'}}
                     </td>
                </tr>

                 <tr>
                     <td class="rent_title">Street Address</td>
                     <td>
                      
                    {{$main_request ? $main_request->street: 'N/A'}}
                    
                    </td>
                </tr>
               
       </tbody>
                  </table>
                  <br>
<hr>

             

               
                </div>
              </div>
            </div>
          </div>
        
        </div>


    </div>
     <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>



