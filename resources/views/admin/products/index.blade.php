
@extends('admin.layouts.master', ['pageSlug' => 'products_services'])



@section('title')

Admin | Logistic Agents

@endsection

@section('content')

  <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left"> Products and Services</h4>

                <h4 class="card-title float-right">
                  <a href="{{route('admin.product.create')}}">
                  <button class="btn btn-primary btn-sm">
                  <i class="fa fa-plus"></i>
                Add new product
              </button> 
              </a>
            </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> Products and Services </th>
                      <th> Actions </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                      @foreach($products as $product)
                      <tr>
                        <td>{{$product->title}} </td>
                        
                        <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteItems('Products',{{ $product->id  }})"><i class="fa fa-trash" title="Delete"></i></button>

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