@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="fa fa-plus-square-o"></i>
              </div>
              <h5>Edit Product Image</h5>
            </header>
            <div class="body">
              {{ Form::open(array('action' => array('admin\ProductImageController@update', $productId, $image->id), 'files'=>true, 'method' => 'patch', 'class' => 'form-horizontal')) }}
                @include('admin.product_image._form', array('image' => $image, 'productId' => $productId))
              {{ Form::close() }}

              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/products/{{$productId}}">Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
