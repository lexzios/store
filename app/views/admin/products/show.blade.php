@extends('layouts.admin.application')

@section('content')
<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">

        <div class="col-lg-12">
          <div class="box inverse"><!-- inverse-box -->
              <header>
              <div class="icons">
                <i class="fa fa-user"></i>
              </div>
              <h5>Product Detail</h5>
            </header>
            <div class="body">
              @if(isset($product))
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Permalink:</strong>
                  </div>
                  <div class="col-lg-10">
                    <p class="newline">{{$product->permalink}}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Product Name:</strong>
                  </div>
                  <div class="col-lg-10">
                    <p class="newline">{{$product->name}}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Category:</strong>
                  </div>
                  <div class="col-lg-10">
                    @if(isset($product->productCategory->name))
                      {{$product->productCategory->name}}
                    @else
                      -
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Formula:</strong>
                  </div>
                  <div class="col-lg-10">
                    @if(isset($product->productFormula->name))
                      {{$product->productFormula->name}}
                    @else
                      -
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Short Description:</strong>
                  </div>
                  <div class="col-lg-10">
                      {{$product->short_description}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Long Description:</strong>
                  </div>
                  <div class="col-lg-10">
                      {{$product->long_description}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Currency:</strong>
                  </div>
                  <div class="col-lg-10">
                    @if(isset($product->currency_code))
                      {{$product->currency_code}}
                    @else
                      -
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Base Price:</strong>
                  </div>
                  <div class="col-lg-10">
                    {{$product->base_price}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>On Sale:</strong>
                  </div>
                  <div class="col-lg-10">
                    @if($product->is_sale == 1)
                      Yes
                    @else
                      No
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Editor Pick:</strong>
                  </div>
                  <div class="col-lg-10">
                    @if($product->is_in_editor_pick == 1)
                      Yes
                    @else
                      No
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Streak Price:</strong>
                  </div>
                  <div class="col-lg-10">
                    {{$product->streak_price}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Call For Best Price:</strong>
                  </div>
                  <div class="col-lg-10">
                    @if($product->is_call_for_best_price == 1)
                      Yes
                    @else
                      No
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <br/>
                    <strong>SEO</strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Title SEO:</strong>
                  </div>
                  <div class="col-lg-10">
                    @if(isset($product->title_seo) && strlen($product->title_seo) != 0)
                      {{$product->title_seo}}
                    @else
                      -
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Description SEO:</strong>
                  </div>
                  <div class="col-lg-10">
                    @if(isset($product->description_seo) && strlen($product->description_seo) != 0)
                      {{$product->description_seo}}
                    @else
                      -
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Keyword SEO:</strong>
                  </div>
                  <div class="col-lg-10">
                    @if(isset($product->keyword_seo) && strlen($product->keyword_seo) != 0)
                      {{$product->keyword_seo}}
                    @else
                      -
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/products/{{$product->id}}/edit">Edit</a> |
                  @if(\Illuminate\Support\Facades\Session::has('list_url'))
                  <a href="{{\Illuminate\Support\Facades\Session::get('list_url')}}">Back to product list</a>
                  @else
                  <a href="/admin/products">Back to product list</a>
                  @endif
                </div>
              </div>
              @endif
          </div><!-- Inverse-box -->
        </div>

        <div class="col-lg-12">
          <div class="box inverse"><!-- inverse-box -->
            <header>
                <div class="icons">
                  <i class="fa fa-list"></i>
                </div>
                <h5>Listing Distributor Product</h5>
              </header>
              <div class="body">
                <table class="table" style="text-align:center">
                <thead>
                  <tr>
                    <th>Distributor Name</th>
                    <th>Distributor Product Name</th>
                    <th style="text-align:right">Product Price</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if(isset($distributorProducts[0]))
                  {
                    for($i=0;$i<count($distributorProducts);$i++)
                    {
                ?>
                      <tr>  
                        <td style="text-align:left">
                          {{$distributorProducts[$i]->distributor->name}}
                        </td>
                        <td style="text-align:left">
                          {{$distributorProducts[$i]->name}}
                        </td>
                        <td style="text-align:right">
                          {{$distributorProducts[$i]->distributor_product_price}}
                        </td>
                      </tr>
                <?php
                    }
                  }
                  else
                  {
                ?>
                    <tr>
                      <td colspan="4" style="text-align:left">No Distributor</td>
                    </tr>
                <?php
                  }
                ?>              
                </tbody>
                </table>
              </div>
          </div><!-- Inverse-box -->
        </div>

        <div class="col-lg-12">
          <div class="box inverse"><!-- inverse-box -->
            <header>
                <div class="icons">
                  <i class="fa fa-list"></i>
                </div>
                <h5>Listing Pictures</h5>
              </header>
              <div class="body">
                <table class="table" style="text-align:center">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th colspan="3"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if(isset($product->productImage[0]))
                  {
                    for($i=0;$i<count($product->productImage);$i++)
                    {
                ?>
                      <tr>  
                        <td style="text-align:left"><img width="75" height="75" alt="" src="{{$product->productImage[$i]->image_path}}"></td>
                        <td><a href="/admin/product/{{$product->id}}/image/{{$product->productImage[$i]->id}}">Show</a></td>
                        <td><a href="/admin/product/{{$product->id}}/image/{{$product->productImage[$i]->id}}/edit">Edit</a></td>
                        <td>
                          {{ Form::open(array('action' => array('admin\ProductImageController@destroy', $product->id, $product->productImage[$i]->id), 'method' => 'delete')) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                          {{ Form::close() }}
                        </td>
                      </tr>
                <?php
                    }
                  }
                  else
                  {
                ?>
                    <tr>
                      <td colspan="4" style="text-align:left">No Product Image</td>
                    </tr>
                <?php
                  }
                ?>              
                </tbody>
                </table>
                <a href="/admin/product/{{$product->id}}/image/new">
                  <div class="icons" style="float:left">
                    <i class="fa fa-plus"></i>
                  </div>
                  &nbsp New Image
                </a>
              </div>
          </div><!-- Inverse-box -->
        </div>

      </div>
    </div>
  </div>
</div>
@stop