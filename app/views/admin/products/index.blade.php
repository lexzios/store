@extends('layouts.admin.application')

@section('content')

<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12" style="margin:10px">
          <a href="/admin/products/new">
            <div class="icons" style="float:left">
              <i class="fa fa-plus"></i>
            </div>
            &nbsp New Product
          </a>
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
              {{ Form::open(array('url' => '/admin/products/search', 'method' => 'GET', 'class' => 'form-horizontal')) }}
                <?php
                  if(!isset($search))
                  {
                    $search = "";
                  }
                  if(!isset($category_choosen))
                  {
                    $category_choosen = 0;
                  }
                ?>
                @include('admin.products._form_search', array('search' => $search, 'category' => $category, 'category_choosen' => $category_choosen))
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
              <h5>Listing Products</h5>
            </header>
            <div class="body">
              <table class="table">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th style ="text-align:right">Base Price</th>
                  <th style ="text-align:center">Formula</th>
                  <th style ="text-align:right">Sale Price</th>
                  <th style ="text-align:center">Distributor Name</th>
                  <th colspan="3"></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($products[0]))
                  @foreach($products as $product)
                    <tr>
                      <td><p class="flow block">{{$product->name}}</p></td>
                      <td style ="text-align:right">
                        {{$product->first_base_price}}
                      </td>
                      <td style ="text-align:center">
                        @if(isset($product->productFormula->name))
                          {{$product->productFormula->name}}
                        @else
                          -
                        @endif
                      </td>
                      <td style ="text-align:right">
                        @if($product->is_call_for_best_price != 0)
                          {{$product->base_price}}
                          <br/>
                          Call For Best Price
                        @else
                          {{$product->base_price}}
                        @endif
                      </td>
                      <td style ="text-align:center">
                        @if(isset($product->distributor))
                          {{$product->distributor}}
                        @else
                          -
                        @endif
                      </td>
                      <td style ="text-align:center"><a href="/admin/products/{{$product->id}}">Show</a></td>
                      <td style ="text-align:center"><a href="/admin/products/{{$product->id}}/edit">Edit</a></td>
                      <td style ="text-align:center">
                        {{ Form::open(array('action' => array('admin\ProductsController@destroy', $product->id), 'method' => 'delete')) }}
                          {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                        {{ Form::close() }}
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="6">No Result</td>
                  </tr>
                @endif
              </tbody>
              </table>
              <div class="row">
                <div class="col-md-12">
                    <ul class="pagination pull-right">                    
                        @if(isset($products))
                            <li>{{$products->appends(array('search'=> $search, 'category'=> $category_choosen))->links()}}</li>
                        @endif
                    </ul>
                </div>
              </div>
<!-- 
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/users/new">New User</a>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
