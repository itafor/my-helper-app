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
                <h4 class="card-title float-left"> Request to get help approval notice</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
<p>
                    Dear <strong>{{$request_bidder->name}}</strong>,<br><br>

 We wish to notify you that your application to get help from the following help provider has been approved. A logistic delivery partner has been assigned to deliver the following goods to you any moment from now. please be informed that, you are to pay for delivery cost. <br>
 Please find below the provider and logistic delivery partner information. Thanks<br><br>

Confirmation code: <b>{{$request_bidding_record->confirmation_code}}</b> <br>
 Note: You are expected to provide the above <b>code</b> to the logistic delivery partner to confirm that the goods has been received and in good condition.<br><br>

 Goods: {{$main_request->category ? $main_request->category->title : 'N/A' }} <br>
 Description: {{$main_request->description }}<br><br>

 Delivery Cost: &#8358; {{number_format($request_bidding_record->delievery_cost,2)}}<br><br>
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
                     <td class="rent_title">Country</td>
                     <td>
    {{$help_provider->country ? $help_provider->country->country_name : 'N/A'}}
                     </td>
                   </tr>

                    <tr>
                     <td class="rent_title">State</td>
                <td>
    {{$help_provider->state ? $help_provider->state->name : 'N/A'}}
                </td>           
              </tr>

                 <tr>
                     <td class="rent_title">City</td>
                     <td>
    {{$help_provider->city ? $help_provider->city->name : 'N/A'}}
                     </td>
                </tr>

                 <tr>
                     <td class="rent_title">Street Address</td>
                     <td>
                      
                    {{$help_provider ? $help_provider->street: 'N/A'}}
                    
                    </td>
                </tr>
               
       </tbody>
                  </table>
<hr>

<h3>Logistic Partner details</h3>

 <table class="table table-bordered" id="rental_table">
           
                    <tbody>

                   <tr>
                     <td class="rent_title">Comany Name</td>
                     <td> 
                        {{$logistic_partner ? $logistic_partner->company_name : 'N/A'}} 
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Phone Number</td>
                     <td>  
                {{$logistic_partner ? $logistic_partner->phone : 'N/A'}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Email</td>
                     <td> {{$logistic_partner ? $logistic_partner->email : 'N/A'}}</td>
                   </tr>

                     <tr>
                     <td class="rent_title">Country</td>
                     <td>
    {{$logistic_partner->country ? $logistic_partner->country->country_name : 'N/A'}}
                     </td>
                   </tr>

                    <tr>
                     <td class="rent_title">State</td>
                <td>
    {{$logistic_partner->state ? $logistic_partner->state->name : 'N/A'}}
                </td>           
              </tr>

                 <tr>
                     <td class="rent_title">City</td>
                     <td>
    {{$logistic_partner->city ? $logistic_partner->city->name : 'N/A'}}
                     </td>
                </tr>

                 <tr>
                     <td class="rent_title">Street Address</td>
                     <td>
                      
                    {{$logistic_partner ? $logistic_partner->street: 'N/A'}}
                    
                    </td>
                </tr>
               
       </tbody>
                  </table>

  

      <!--  help_provider: {{$help_provider}}<br>
       main_request : {{$main_request}}<br>
       request_bidder: {{$request_bidder}}<br> 
       logistic_partner: {{$logistic_partner}}<br> 
       request_bidding_record: {{$request_bidding_record}}<br> -->
               
                </div>
              </div>
            </div>
          </div>
        
        </div>

       
        
    </div>
</body>
</html>