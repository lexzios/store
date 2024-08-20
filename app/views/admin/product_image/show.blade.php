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
                <i class="fa fa-user"></i>
              </div>
              <h5>Show Product Image</h5>
            </header>
            <div class="body">
              <div class="row">
                <div class="col-lg-4">
                  <strong>Image:</strong>
                </div>
                <div class="col-lg-3">
                  <img src="{{$image->image_path}}" class="img-responsive"">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/product/{{$productId}}/image/{{$image->id}}/edit">Edit</a> |
                  <a href="/admin/products/{{$productId}}">Back</a>
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

