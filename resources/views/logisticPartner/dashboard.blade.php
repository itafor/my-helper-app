@extends('logisticPartner.layouts.master',['pageSlug' => 'logisticPartner_dashboard'])


@section('title')

logistic Partner | Dashboard

@endsection

@section('content')

        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Total Requests (<strong>{{$count_all_request}}</strong>)</h5>
                <h4 class="card-title">All Requests</h4>
              <!--   <div class="dropdown">
                  <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                    <i class="now-ui-icons loader_gear"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <a class="dropdown-item text-danger" href="#">Remove Data</a>
                  </div>
                </div> -->
              </div>
              <div class="card-body">
                 <div class="table-responsive">
                <table class="table tablesorter" id="requests#" style="width: 100px;">
                   @if($count_all_request >=1)
                    <thead class=" text-primary">
                       <tr>
                      <th> Details </th>
                      <th> Status </th>
                      <th> Actions </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                       @php
                          $i = 1;
                      @endphp
                      @foreach($all_requests as $req)
                      <tr>

                        <td>{{ Str::limit($req->request->description, 10) }}</td>
                       
                        <td>
                            @if($req->status == 'Approved')
                           <span style="color: green; font-size: 14px;">{{$req->status}}</span>  
                            @elseif($req->status =='Pending')
                           <span style="color: brown; font-size: 14px;">{{$req->status}}</span>
                           @elseif($req->status == 'Delivered')
                           <span style="color: blue; font-size: 14px;">{{$req->status}}</span>  
                            @elseif($req->status == 'Rejected')
                           <span style="color: red; font-size: 14px;">{{$req->status}}</span>  
                           @endif

                        </td>
                     
                     <td>
                     <a href="{{route('logistic_partner.request.initialconfirmation',[$req->id])}}">
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                          </a>
                        </td>
                       
                      </tr>
                       @php
                       $i++;
                    @endphp  
                     @endforeach
                    </tbody>
                      @else
                     <tr>
                     <span style="margin-left: 20px;">No request found</span>
                     </tr>
                     @endif
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Confirmed Requests (<strong>{{$count_confirmed_requests}}</strong>)</h5>
                <h4 class="card-title">Confirmed requests</h4>
               <!--  <div class="dropdown">
                  <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                    <i class="now-ui-icons loader_gear"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <a class="dropdown-item text-danger" href="#">Remove Data</a>
                  </div>
                </div> -->
              </div>
              <div class="card-body">
                 <div class="table-responsive">
                <table class="table tablesorter" id="requests#" style="width: 100px;">
                   @if($count_confirmed_requests >=1)
                    <thead class=" text-primary">
                       <tr>
                      <th> Details </th>
                      <th> Status </th>
                      <th> Actions </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                       @php
                          $i = 1;
                      @endphp
                      @foreach($confirmed_requests as $req)
                      <tr>

                        <td>{{ Str::limit($req->request->description, 10) }}</td>
                       
                        <td>
                            @if($req->status == 'Approved')
                           <span style="color: green; font-size: 14px;">{{$req->status}}</span>  
                            @elseif($req->status =='Pending')
                           <span style="color: brown; font-size: 14px;">{{$req->status}}</span>
                           @elseif($req->status == 'Delivered')
                           <span style="color: blue; font-size: 14px;">{{$req->status}}</span>  
                            @elseif($req->status == 'Rejected')
                           <span style="color: red; font-size: 14px;">{{$req->status}}</span>  
                           @endif

                        </td>
                     
                     <td>
                     <a href="{{route('logistic_partner.request.initialconfirmation',[$req->id])}}">
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                          </a>
                        </td>
                       
                      </tr>
                       @php
                       $i++;
                    @endphp  
                     @endforeach
                    </tbody>
                     @else
                     <tr>
                     <span style="margin-left: 20px;">No confirmed request found</span>
                     </tr>
                     @endif
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Unconfirmed Requests (<strong>{{$count_unconfirmed_requests}}</strong>)</h5>
                <h4 class="card-title">Unconfirmed requests</h4>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <div class="table-responsive">
                <table class="table tablesorter" id="requests#" style="width: 100px;">
                  @if($count_unconfirmed_requests >=1)
                    <thead class=" text-primary">
                       <tr>
                      <th> Details </th>
                      <th> Status </th>
                      <th> Actions </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                       @php
                          $i = 1;
                      @endphp
                      
                      @foreach($unconfirmed_requests as $req)
                      <tr>

                        <td>{{ Str::limit($req->request->description, 10) }}</td>
                       
                        <td>
                            @if($req->status == 'Approved')
                           <span style="color: green; font-size: 14px;">{{$req->status}}</span>  
                            @elseif($req->status =='Pending')
                           <span style="color: brown; font-size: 14px;">{{$req->status}}</span>
                           @elseif($req->status == 'Delivered')
                           <span style="color: blue; font-size: 14px;">{{$req->status}}</span>  
                            @elseif($req->status == 'Rejected')
                           <span style="color: red; font-size: 14px;">{{$req->status}}</span>  
                           @endif

                        </td>
                     
                     <td>
                     <a href="{{route('logistic_partner.request.initialconfirmation',[$req->id])}}">
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                          </a>
                        </td>
                       
                      </tr>
                       @php
                       $i++;
                    @endphp  
                     @endforeach
                     @else
                     <tr>
                     <span style="margin-left: 20px;">No unconfirmed request found</span>
                     </tr>
                     @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons ui-2_time-alarm"></i> Just Updated
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-md-6">
            <div class="card  card-tasks">
              <div class="card-header ">
                <h5 class="card-category">Backend development</h5>
                <h4 class="card-title">Tasks</h4>
              </div>
              <div class="card-body ">
                <div class="table-full-width table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" checked>
                              <span class="form-check-sign"></span>
                            </label>
                          </div>
                        </td>
                        <td class="text-left">Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                          </button>
                          <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox">
                              <span class="form-check-sign"></span>
                            </label>
                          </div>
                        </td>
                        <td class="text-left">Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                          </button>
                          <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" checked>
                              <span class="form-check-sign"></span>
                            </label>
                          </div>
                        </td>
                        <td class="text-left">Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                          </button>
                          <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">All Persons List</h5>
                <h4 class="card-title"> Employees Stats</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Name
                      </th>
                      <th>
                        Country
                      </th>
                      <th>
                        City
                      </th>
                      <th class="text-right">
                        Salary
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          Dakota Rice
                        </td>
                        <td>
                          Niger
                        </td>
                        <td>
                          Oud-Turnhout
                        </td>
                        <td class="text-right">
                          $36,738
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Minerva Hooper
                        </td>
                        <td>
                          Curaçao
                        </td>
                        <td>
                          Sinaai-Waas
                        </td>
                        <td class="text-right">
                          $23,789
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Sage Rodriguez
                        </td>
                        <td>
                          Netherlands
                        </td>
                        <td>
                          Baileux
                        </td>
                        <td class="text-right">
                          $56,142
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Doris Greene
                        </td>
                        <td>
                          Malawi
                        </td>
                        <td>
                          Feldkirchen in Kärnten
                        </td>
                        <td class="text-right">
                          $63,542
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Mason Porter
                        </td>
                        <td>
                          Chile
                        </td>
                        <td>
                          Gloucester
                        </td>
                        <td class="text-right">
                          $78,615
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> -->
@endsection


@section('scripts')


@endsection