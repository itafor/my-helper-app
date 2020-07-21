
@extends('admin.layouts.master',['pageSlug' => 'products_services'])



@section('title')

Admin | Logistic Agents

@endsection

@section('content')

  <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title float-left">Product and Services: Add New</h5>
                <h5 class="title float-right">
                </h5>
              </div>
              <br>
              <br>
              <div class="card-body">
                <form class="form" method="post" action="{{ route('admin.product.store') }}">
                    @csrf

                      <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Product</label>
                        <input type="text" name="title" class="form-control" placeholder="Product name">
                          @error('title')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                  </div>
              
                   
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Product description</label>
                        <textarea type="text" name="description" class="form-control" placeholder="Product description"></textarea>
                          @error('description')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       <div class="card-footer text-center mb-20">
                        <button type="submit" class="btn btn-round btn-lg btn-lg-pd btn-custom">{{ _('Submit') }}</button>
                    </div>
                       
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
         
        </div>
      </div>

@endsection


@section('scripts')


@endsection