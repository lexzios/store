@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12" style="margin:10px">
          <a href="/admin/distributor/{{$room_id}}/product/new">
            <div class="icons" style="float:left">
              <i class="fa fa-plus"></i>
            </div>
            &nbsp New Distributor Product
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="fa fa-list"></i>
              </div>
              <h5>Distributor Detail</h5>
            </header>
            <div class="body">
              <div class="form-horizontal">
                @include('admin.distributor._form_disable', array('distributor' => $distributor))
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/distributor/{{$distributor->id}}/edit">Edit</a> |
                  <a href="/admin/distributor">Back to Distributor List</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="glyphicon glyphicon-search"></i>
              </div>
              <h5>Search Product</h5>
            </header>
            <div class="body">
              {{ Form::open(array('action' => array('admin\DistributorProductController@search', $room_id), 'class' => 'form-horizontal')) }}
                <?php
                  if(!isset($search))
                  {
                    $search = "";
                  }
                ?>
                @include('admin.distributor_product._form_search', array('search' => $search))
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="fa fa-list"></i>
              </div>
              <h5>Listing Distributor Product</h5>
            </header>
            <div class="body">
              <table class="table">
              <thead>
                <tr>
                  <th>Distributor Product Name</th>
                  <th style ="text-align:left">Product Name</th>
                  <th style ="text-align:right">Product Price</th>
                  <th colspan="3"></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($distributorProducts[0]))
                  @foreach($distributorProducts as $distributorProduct)
                    <tr>
                      <td>{{$distributorProduct->name}}</td>
                      <td style ="text-align:left">
                        @if($distributorProduct->product_id == 0)
                          -
                        @elseif(isset($distributorProduct->productName->name))
                          <a href="/admin/products/{{$distributorProduct->productName->id}}">{{$distributorProduct->productName->name}}</a>
                        @else
                          Deleted product
                        @endif
                      </td>
                      <td style ="text-align:right">{{ $distributorProduct->distributor_product_price }}</td>
                      <td style ="text-align:center"><a href="/admin/distributor/{{$room_id}}/product/{{$distributorProduct->id}}">Show</a></td>
                      <td style ="text-align:center"><a href="/admin/distributor/{{$room_id}}/product/{{$distributorProduct->id}}/edit">Edit</a></td>
                      <td style ="text-align:center">
                        {{ Form::open(array('action' => array('admin\DistributorProductController@destroy', $room_id, $distributorProduct->id), 'method' => 'delete')) }}
                          {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                        {{ Form::close() }}
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="5">No Result</td>
                  </tr>
                @endif
                <!-- <tr>
                  <td>D1PO001</td>
                  <td>PO001</td>
                  <td>Rp 1.990.000</td>
                  <td><a href="/admin/distributor/product/1/room/{{$room_id}}/edit">Edit</a></td>
                  <td>
                    {{ Form::open(array('action' => array('admin\DistributorProductController@destroy', 2, $room_id), 'method' => 'delete')) }}
                      {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                    {{ Form::close() }}
                  </td>
                </tr>
                <tr>
                  <td>D1PO002</td>
                  <td>PO002</td>
                  <td>Rp 1.000.000</td>
                  <td><a href="/admin/distributor/product/1/room/{{$room_id}}/edit">Edit</a></td>
                  <td>
                    {{ Form::open(array('action' => array('admin\DistributorProductController@destroy', 1, $room_id), 'method' => 'delete')) }}
                      {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                    {{ Form::close() }}
                  </td>
                </tr> -->

              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
