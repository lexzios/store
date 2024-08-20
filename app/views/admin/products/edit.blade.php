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
                <i class="fa fa-edit"></i>
              </div>
              <h5>Edit Product</h5>
            </header>
            <div class="body">
              {{ Form::open(array('action' => array('admin\ProductsController@update', $product->id), 'method' => 'patch', 'class' => 'form-horizontal')) }}
                @include('admin.products._form_edit', array('product' => $product, 'category' => $category, 'currency' => $currency, 'markup' => $markup))
              {{ Form::close() }}

              <div class="row">
                <div class="col-lg-12">
                  <a href="javascript:history.go(-1)">Cancel</a>
                </div>
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
