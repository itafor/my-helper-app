
@extends('admin.layouts.master',['pageSlug' => 'item_category'])



@section('title')

Admin | Items

@endsection

@section('content')

  <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title float-left">Item: Add New</h5>
                <h5 class="title float-right">
                </h5>
              </div>
              <br>
              <br>
              <div class="card-body">
                <form class="form" method="post" action="{{ route('admin.item.Subcategory.store') }}">
                    @csrf

                      <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Item Category</label>
                        <select name="category_id" class="form-control" required>
                          <option>Select a Item category</option>
                          @foreach($items as $item)
                          <option value="{{$item->id}}">{{$item->title}}</option>
                          @endforeach
                        </select>
                          @error('title')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                  </div>
              

                 <div class="col-md-12">
                  <label class="form-control-label" for="input-property_type">{{ __('Item') }}</label>
                  <input type="text" name="subcategories[112211][name]"  class="form-control" required>
                </div>

                <div style="clear:both"></div>
                <div id="subcaegoryContainer" class="col-md-12">
                </div>   
                <div style="clear:both"></div>

                   <div class="form-group">
                  <button type="button" id="addMoreSubcategory" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i>  Add more items</button>
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