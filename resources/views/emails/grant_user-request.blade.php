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
                <h4 class="card-title float-left"> Reject or Accept Request</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
<p>
                    Dear <strong>{{$request_owner->name}}</strong>,<br><br>

 We wish to notify you that <strong>{{$help_provider ? $help_provider->name : 'N/A'}}  {{$help_provider ? $help_provider->last_name : 'N/A'}}</strong> has indicated interest to provide the help you requested on <a href="{{url('/')}}">myhelperapp</a> .

 <br>

After you have accepted the request, Red Star Express  Allied Services Ltd. will be contacted to deliver the product. <br>

 Product Category: {{$main_request->category ? $main_request->category->title : 'N/A' }} <br>
 Product Description: {{$main_request->description }}<br>

 Product Weight (kg): {{$main_request->weight ? $main_request->weight : 'N/A' }} <br>


  Delivery Fee Payer: <strong class="text-danger">{{$main_request->delivery_cost_payer =='prepaid' ? 'Sender will pay for Shipping cost':'Receiver will pay for Shipping cost'}}</strong><br>


   <p> Helper Comment: {{$request_bidding_record->comment ? $request_bidding_record->comment : 'N/A'}} </p><br>

  Please find below the provider information. Thanks<br>

  Click <a href="{{route('request.approve_or_reject',[$request_bidding_record->id])}}">HERE</a> to Accept or Reject the request.

<br>
</p>

<h3>Help Provider details</h3>

 <table class="table table-bordered" id="rental_table">
           
                    <tbody>

                   <tr>
                     <td class="rent_title">Full Name</td>
                     <td> 
                        {{$help_provider ? $help_provider->name : 'N/A'}} 
                        {{$help_provider ? $help_provider->last_name : 'N/A'}}
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Phone Number</td>
                     <td>  
                {{$help_provider ? $help_provider->phone : 'N/A'}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Email</td>
                     <td> {{$help_provider ? $help_provider->email : 'N/A'}}</td>
                   </tr>
                    <tr>
                     <td class="rent_title">State</td>
                <td>
    {{providerDetail($main_request->id,$help_provider->id)['api_state']}}
                </td>           
              </tr>

                 <tr>
                     <td class="rent_title">City</td>
                     <td>
    {{providerDetail($main_request->id,$help_provider->id)['api_city']}}
    
                     </td>
                </tr>

                 <tr>
                     <td class="rent_title">Street Address</td>
                     <td>
    {{providerDetail($main_request->id,$help_provider->id)['providerAddress']}}
                      
                    </td>
                </tr>
               
       </tbody>
                  </table>
<hr>

               
                </div>
              </div>
            </div>
          </div>
        
        </div>

       
        
    </div>
</body>
</html>



