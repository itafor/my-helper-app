
@extends('admin.layouts.master', ['pageSlug' => 'logistic'])



@section('title')

Admin | Logistic Agents

@endsection

@section('content')

  <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left"> Logistics Agents</h4>

                <h4 class="card-title float-right">
                  <a href="{{route('admin.logistic.agent.add')}}">
                  <button class="btn btn-primary btn-sm">
                  <i class="fa fa-plus"></i>
                Add new
              </button> 
              </a>
            </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> Company </th>
                      <th> Phone </th>
                      <th> Email </th>
                      
                      <th> Actions </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                      @foreach($logistics as $agent)
                      <tr>
                        <td>{{$agent->company_name}} </td>
                        <td>{{$agent->phone}} </td>
                        <td>{{$agent->email}} </td>
                       <!--  <td>
                          {{ \Illuminate\Support\Str::limit($agent->street, 10, $end='...') }}</td> -->
                       <!--  <td>{{$agent->country->country_name}} </td>
                        <td>{{$agent->state->name}} </td>
                        <td>{{$agent->city->name}} </td> -->
                        <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteItems('LogisticAgent',{{ $agent->id  }})"><i class="fa fa-trash" title="Delete"></i></button>
                          
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                          <button class="btn btn-sm btn-primary"><i class="fa fa-edit" title="Edit"></i></button>

                        </td>
                       
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        
        </div>

@endsection


@section('scripts')


@endsection