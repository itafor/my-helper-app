<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Request Received</title>
    
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
                <!-- <h4 class="card-title float-left">Request Received</h4> -->
              </div>
              <div class="card-body">
                <div class="table-responsive">
<p>
                    Dear <strong>{{$user->name}} {{$user->last_name}},</strong><br>

@if($main_request->request_type == 2)

 Thank you.  Your offer to provide help was received.<br>

 <a href="{{route('auth_view.provide.request',[$main_request->id])}}"> View Request</a> 

@elseif($main_request->request_type == 1)

 Thank you.  Your request to get help was received.<br><br>
 <a href="{{route('auth_view.make.request',[$main_request->id])}}">View Request</a>
@else

@endif
 <br>
</p>
                </div>
              </div>
            </div>
          </div>
        
        </div>


    </div>
     <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>



