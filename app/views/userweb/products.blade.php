@extends('layouts.userweb.application')

@section('body')
<section class="page-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Product</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h2>Product</h2>
          </div>
        </div>
      </div>
  </section>

	<div class="container">
    <div class="col-md-3 row">
		  @include('userweb._sidebar', array('categories' => $categories))
		</div>
    <div class="main col-md-8 col-md-offset-1 col-sm-12" role="main">
      @if(isset($is_has_header))
        @include('userweb._products_with_header', array('products' => $products))
      @else
        @include('userweb._products', array('products' => $products))
      @endif
    </div>
	</div>

@stop
