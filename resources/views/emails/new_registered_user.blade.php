<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Welcome Email</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="fonts/stylesheet.css">

  <style>
      *{
          font-family: 'Facebook Reader', sans-serif;
      }
      .welcome-message-body{
          width: 80%;
          text-align: center;
          margin: 0px auto;
          line-height: 160%;
          color: #444;
      }
      .welcome-user-fullname{
        text-align: center;
          margin: 0px auto;
          color: rgb(102,95,226);
          font-size: 22px;
      }
      .button{
        background: #54AB68;
        border-radius: 5px;
          padding: 14px 38px;
          color: #fff;
          text-decoration: none;
          font-size: 18px;
          display: inline-block;
          margin: 0px auto !important;
          text-align: center !important;
      }
      .message-body, .message-salutation{
          line-height: 160%;
          color: #444;
      }
      .message-title{
          color: #54AB68;
          font-size: 20px;
      }
      .highlite{
          color: rgb(102,95,226);
          font-weight: 500;
      }
      .cell-title{
          font-size: 14px;
          margin-bottom: 0px !important;
          color: #666;
      }
      .cell-value{
          font-size: 18px;
          margin-top: 5px !important;
          color: #293737;
          font-weight: 500;
      }
      .currency{
          font-size: 12px;
      }
      .amount{
          font-size: 20px;
      }

      .unsubscribe{
          text-decoration: none;
          color: #fafafa;
      }
      .transaction-details{
          width: 100%;
          background: #fafafa;
          padding: 10px 20px;
      }

      .txn-row{
          border: 1px solid #222 !important;
      }
      ul{
        list-style-type: none;
  margin: 0;
  padding: 0;
      }
      li{
        display: inline-block; margin-right: 5px;
      }
      .tiny-text{
          font-size: 12px;
      }
  </style>
</head>

<body style="margin: 0; padding: 0; background: #efefef;">
    <table cellpadding="0" cellspacing="0" width="600" style="margin:200px auto;">
        <tr>
         <td style="background: #fff; text-align: center; padding: 0px !important;">
         <img src="{{ asset('white/img/lc_logo.png') }}" class="logo" alt="MyHelperApp Logo">
         </td>
        </tr>

        <tr>
            <td style="background: #ffffff;">
                <div style="padding: 20px 40px 40px 40px; text-align: center;">


                    <p class="welcome-message-body">
                        Welcome to MyHelperApp,
                    </p>
                    <br>
                    <!-- User's name -->
                    <h3 class="welcome-user-fullname">{{$user->name}}</h3>
                    <br>
                    <p class="welcome-message-body">Thank you for signing up with us.</p>
                    {{-- <p class="welcome-message-body">Thank you for creating your account on MyHelperApp. To activate your account, please click the button below within the next 60 days:</p> --}}
                    {{-- <br>
                    <a href="#" class="button">Activate Account</a>
                   <br> --}}
                   <br>
                </div>
            </td>
        </tr>


        <!-- <tr>
         <td style="background: #41747A; border-radius: 0px 0px 10px 10px; color: #ffffff; text-align: left; padding: 40px !important;">
                <table width="100%">
                    <tr style="border-bottom: 1px solid #ffffff !important;">
                        <td width="50%" style="align-self: center;">
                            <a href="https://www.crowdyvest.com/?utm_source=txn_email&utm_medium=logo&utm_campaign=track_txn_email">
                                <img src="img/cv_logo_white.svg" alt="" srcset="" style="height: 60px; width: auto;">
                            </a>

                        </td>
                        <td width="50%" style="text-align: right !important;">
                            <p style=" font-size: 12px;">Download our mobile app</p>
                            <a href="https://play.google.com/store/apps/details?id=com.farmcrowdyapp"><img src="{{asset('img/btn-android.svg')}}" style="display: inline-block; width: 120px; height: auto;"></a>
                            <a href="https://itunes.apple.com/us/app/farmcrowdy/id1316416568?mt=8&ign-mpt=uo%3D2"><img src="{{asset('img/btn-ios.svg')}}" style="display: inline-block; width: 120px; height: auto;"></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr color="#558489">
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ffffff !important">
                        <td width="50%" style="text-align: left; color: #fff;">
                            <div style="width: 100%; padding-right: 10px; border-right: 1px solid #558489;">
                                <h3 style="margin-bottom:0px !important; color: #C0D271; font-size: 14px;">Head office:</h3>
                            <p style="font-size: 14px; line-height: 140%; margin-top: 0px;">
                                2 Opeyemisi Bamidele Crescent, off Freedom Way, Lekki Phase 1, Lagos, Nigeria.
                            </p>

                            <h3 style="color: #C0D271; margin-bottom:3px !important; font-size: 14px;">Abuja office:</h3>
                            <p style="font-size: 14px; line-height: 140%; margin-top: 0px;">
                                3rd Floor, Sinoki House, Plot 770, off Samuel Ademulegun Avenue, CBD, Abuja, Nigeria.
                            </p>
                            </div>


                        </td>
                        <td width="50%" style="vertical-align: top; padding-left:40px; text-align: left !important; color: #ffffff;">
                            <h3 style="color: #C0D271; font-size: 14px; margin-bottom:3px !important;">Phone:</h3>
                            <p style="font-size: 14px; line-height: 140%; margin-top: 0px;">
                                +234 909 999 9830
                            </p>
                            <h3 style="color: #C0D271; font-size: 14px; margin-bottom:3px !important;">Email:</h3>
                            <p style="font-size: 14px;line-height: 140%; margin-top: 0px;">
                               info@crowdyvest.com
                            </p>

                            <br>
                            <ul style="text-align:left !important; display:block; margin-left:0px !important;">
                                <li>
                                    <a href="https://www.facebook.com/Crowdyvest-632071023946281/">
                                        <img src="{{asset('img/facebook.svg')}}" alt="" srcset="">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/crowdyvestng">
                                        <img src="{{asset('img/twitter.svg')}}" alt="" srcset="">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/crowdyvestng/">
                                        <img src="{{asset('img/instagram.svg')}}" alt="" srcset="">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/company/crowdyvest/about/">
                                        <img src="{{asset('img/linkedin.svg')}}" alt="" srcset="">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('img/youtube.svg')}}" alt="" srcset="">
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr color="#558489">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                           <p style="font-size: 14px;">Do good... Earn well. </p>
                        </td>
                        <td width="50%" style="text-align: right;">
                            <a class="unsubscribe" style="font-size: 14px;" href="#">unsubscribe </a>
                         </td>
                    </tr>
                </table>
            </td>
        </tr> -->
       </table>
   </body>



</html>
