
@extends('admin.layouts.master', ['pageSlug' => 'items'])



@section('title')

Admin | Items

@endsection

@section('content')

  <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left"> Items</h4>

                <h4 class="card-title float-right">
                  <a href="{{route('admin.item.subcategory.create')}}">
                  <button class="btn btn-primary btn-sm">
                  <i class="fa fa-plus"></i>
                Add new Item 
              </button> 
              </a>
            </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> Items </th>
                      <th> Item Categories </th>
                      <th colspan="2"> Actions </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                      @foreach($items as $item)
                      <tr>
                        <td>{{$item->name}} </td>
                        <td>{{$item->item_category ? $item->item_category->title : "N/A"}} </td>
                    
                       
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