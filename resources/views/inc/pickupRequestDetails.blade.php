 @if($get_pickup_request)

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
                               <td class="rent_title">Payment Reference</td>
                               <td>
                           {{$get_pickup_request->PaymentRef ? $get_pickup_request->PaymentRef : 'N/A'}}
                              
                              </td>
                          </tr>
                           <tr>
                               <td class="rent_title">Payment Status</td>
                               <td>
                           {{$get_pickup_request->PaymentRef ? paymentStatus($get_pickup_request->PaymentRef) : 'N/A'}}
                              
                              </td>
                          </tr>

                          <tr>
                               <td class="rent_title">Description</td>
                               <td>
                           {{$get_pickup_request->Description}}
                              
                              </td>
                          </tr>

                            <tr>
                               <td class="rent_title">Item Size</td>
                               <td>
                           {{itemSize($get_pickup_request->Weight)}}
                              
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
                               <td class="rent_title">Recipient Email</td>
                               <td>
                           {{$get_pickup_request->RecipientEmail}}
                              
                              </td>
                          </tr>

                           <tr>
                               <td class="rent_title">Payment Type</td>
                               <td>
                           {{$get_pickup_request->PaymentType}}
                              
                              </td>
                          </tr>

                           <tr>
                               <td class="rent_title">DeliveryType</td>
                               <td>
                           {{$get_pickup_request->DeliveryType}}
                              
                              </td>
                          </tr>
                         
                          </tbody>
                        </table>
                  @else
                  <span>Pickup request not yet submitted</span>
                  @endif
