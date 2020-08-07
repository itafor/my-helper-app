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

#sample_photos{
    width: 100px;
    height: 100px;
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
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left"> Goods delivery notice</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
<p>
                    Dear <strong>{{$logistic_partner->company_name}}</strong>,<br><br>

 We wish to notify you that the following goods will be taken from the provider to the receiver. Please find the provider and receiver information below. Thanks<br><br>

 Note: You are expected to receive a confirmation code from the receiver then proceed to your   <a href="{{url('/')}}">myhelperapp.com</a> to confirm that the goods have been delivered.<br><br>

Product Category: {{$main_request->category ? $main_request->category->title : 'N/A' }} <br>
 Description: {{$main_request->description }}<br><br>

 Delivery Cost: &#8358; {{number_format($request_bidding_record->delievery_cost,2)}}<br><br>
</p>

         @if(isset($main_request) && $main_request->requestPhotos !='')
                <!-- <h3>Sample Photos</h3> -->
                <!--Tab Gallery: The expanding image container -->
                  <div class="container" style="display: none;">
                    <!-- Close the image -->
                    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

                    <!-- Expanded image -->
                    <img id="expandedImg" style="width:100%; height: 500px;">

                    <!-- Image text -->
                    <div id="imgtext"></div>
                  </div>
                                @foreach($main_request->requestPhotos as $photo)

                    <!-- The grid:-->
                    <div class="column">
                     <!--  <img src="img_nature.jpg" alt="Nature" > -->
                      <img src="{{$photo->image_url}}" onclick="myFunction(this);" alt="Sample image" id="sample_photos">
                    </div>
                    
                    @endforeach
                  
               @endif

<br>
<br>

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

<h3>Help Receiver details</h3>

 <table class="table table-bordered" id="rental_table">
           
                    <tbody>

                   <tr>
                     <td class="rent_title">Full Name</td>
                     <td> 
                        {{$request_bidder ? $request_bidder->name : 'N/A'}} 
                        {{$request_bidder ? $request_bidder->last_name : 'N/A'}}
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Phone Number</td>
                     <td>  
                {{$request_bidder ? $request_bidder->phone : 'N/A'}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Email</td>
                     <td> {{$request_bidder ? $request_bidder->email : 'N/A'}}</td>
                   </tr>

                     <tr>
                     <td class="rent_title">Country</td>
                     <td>
    {{$request_bidder->country ? $request_bidder->country->country_name : 'N/A'}}
                     </td>
                   </tr>

                    <tr>
                     <td class="rent_title">State</td>
                <td>
    {{$request_bidder->state ? $request_bidder->state->name : 'N/A'}}
                </td>           
              </tr>

                 <tr>
                     <td class="rent_title">City</td>
                     <td>
    {{$request_bidder->city ? $request_bidder->city->name : 'N/A'}}
                     </td>
                </tr>

                 <tr>
                     <td class="rent_title">Street Address</td>
                     <td>
                      
                    {{$request_bidder ? $request_bidder->street: 'N/A'}}
                    
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
 <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>