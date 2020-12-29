
@extends('admin.layouts.master', ['pageSlug' => 'products_services'])



@section('title')

Admin | Logistic Agents

@endsection

@section('content')

  <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left"> Item Details</h4>

                <h4 class="card-title float-right">
                  <a href="{{route('admin.product.index')}}">
                  <button class="btn btn-primary btn-sm">
              Back to List
              </button> 
              </a>
            </h4>
              </div>
              <div class="card-body">
               
                <div class="table-responsive">
                  <span style="font-size: 20px;">Item Category Name:</span> <strong>{{$item->title}}</strong>
                  <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> Items </th>
                      <th colspan="2"> </th>
                        </tr>
                     
                    </thead>
                    @if($item->item_subcategory)
                    <tbody>
                      @foreach($item->item_subcategory as $subcat)
                      <tr>


                        <td>{{$subcat->name}} </td>
                        
                    
                       
                      </tr>
                     @endforeach
                    </tbody>
                    @else
                    <span>No Item subcategory found</span>
                    @endif
                  </table>
                </div>
              </div>
            </div>
          </div>
        
        </div>

@endsection


@section('scripts')


@endsection