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
                <h4 class="card-title float-left"> Request to get help approval notice</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
<p>
                    Dear <strong>{{$request_bidder->name}}</strong>,<br><br>

 We wish to notify you that your application to get help from the following help provider has been approved. A logistic delivery partner has been assigned to deliver the following goods to you any moment from now. <br>
 Please find below the provider information. Thanks<br><br>

 <br>

 Goods: {{$main_request->category ? $main_request->category->title : 'N/A' }} <br>
 Description: {{$main_request->description }}<br><br>

</p>
 <br>

    @if($main_request->delivery_cost_payer == 'pay on delivery')
           @if($main_request->weight == 3.5)
                                       Item Size: Small, Weight:{{$main_request->weight}}
                                    @elseif($main_request->weight == 7.5)
                                       Item Size: Medium, Weight:{{$main_request->weight}}
                                    @else
                                       Item Size: Large, Weight:{{$main_request->weight}}
                                    @endif
                                        <p><a href="{{route('pickupRequest.calculate.deliveryfee')}}" target="_blank">Delivery fee</a> payment type : {{$main_request->delivery_cost_payer}} <br>
                                          </p>
    @elseif($main_request->delivery_cost_payer == 'prepaid')
            @if($main_request->weight == 3.5)
                                       Item Size: Small, Weight:{{$main_request->weight}}
                                    @elseif($main_request->weight == 7.5)
                                       Item Size: Medium, Weight:{{$main_request->weight}}
                                    @else
                                       Item Size: Large, Weight:{{$main_request->weight}}
                                    @endif
                                        <p> <a href="{{route('pickupRequest.calculate.deliveryfee')}}" target="_blank">Delivery fee</a> payment type : {{$main_request->delivery_cost_payer}}<br>
                                        </p>
        @else

    @endif


    @if(isset($main_request) && $main_request->requestPhotos !='')
                <h3>Sample Photos</h3>
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
                     <td class="rent_title">State</td>
                <td>
    {{$help_provider->api_state ? $help_provider->api_state : 'N/A'}}
                </td>           
              </tr>

                 <tr>
                     <td class="rent_title">City</td>
                     <td>
    {{$help_provider->api_city ? $help_provider->api_city : 'N/A'}}
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
               
                </div>
              </div>
            </div>
          </div>
        
        </div>

       
        
    </div>
        <script type="text/javascript">
                function myFunction(imgs) {
  // Get the expanded image
  var expandImg = document.getElementById("expandedImg");
  // Get the image text
  var imgText = document.getElementById("imgtext");
  // Use the same src in the expanded image as the image being clicked on from the grid
  expandImg.src = imgs.src;
  // Use the value of the alt attribute of the clickable image as text inside the expanded image
  imgText.innerHTML = imgs.alt;
  // Show the container element (hidden with CSS)
  expandImg.parentElement.style.display = "block";
}
    </script>
</body>
</html>