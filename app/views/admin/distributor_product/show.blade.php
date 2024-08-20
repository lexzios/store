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
              <h5>Show Admin</h5>
            </header>
            <div class="body">
              <div class="form-horizontal">
                @include('admin.distributor_product._form_disable', array('distributorProduct' => $distributorProduct, 'products' => $products, 'currency' => $currency))
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/distributor/{{$room_id}}/product/{{$distributorProduct->id}}/edit">Edit</a> |
                  <a href="/admin/distributor/{{$room_id}}/product">Back to Distributor</a>
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

