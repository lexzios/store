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
              {{ Form::open(array('action' => array('admin\DistributorProductController@update', $room_id, $distributorProduct->id), 'method' => 'patch', 'class' => 'form-horizontal')) }}
                @include('admin.distributor_product._form', array('distributorProduct' => $distributorProduct, 'room_id' => $room_id, 'products' => $products, 'currency' => $currency))
              {{ Form::close() }}

              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/distributor/{{$room_id}}/product/{{$distributorProduct->id}}">Cancel</a>
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
