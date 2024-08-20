@extends('layouts.userweb.application')

@section('body')

<section class="page-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">
                @if(isset($category[0]))
                    <a href="../{{$category[0]->permalink}}">{{$category[0]->name}}</a>
                @else
                  Product Detail
                @endif
              </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h2>Product Detail</h2>
          </div>
        </div>
      </div>
  </section>

<div role="main" class="main shop">
        <div class="container">

          <hr class="shorter">

          <div class="row" itemscope itemtype="http://schema.org/Product">
            <div class="col-md-5 col-sm-5">
              <div id ="divImagePrev">
                <?php
                  if(isset($product->productImage[0])) {
                    for($i=0;$i<count($product->productImage);$i++) {
                ?>
                      <input type="hidden" name="image_{{$i}}_prev"  id="image_{{$i}}_prev" value="{{$product->productImage[$i]->image_path}}" >
                <?php
                    }
                  }
                ?>
                @if(isset($product->productImage[0]))
                  <a id="myImagePrevShow" class="lightbox pull-left" href="{{ $product->productImage[0]->image_path }}" data-plugin-options='{"type":"image"}'>
                    <img itemprop="image" id="myImagePrev" alt="{{ $product->name }}" class="img-responsive img-rounded" src="{{ $product->productImage[0]->image_path }}">
                  </a>
                @else
                  <img itemprop="image" id="myImagePrev" alt="" class="img-responsive img-rounded" src="/assets/userweb/images/no_product_image.jpg">
                @endif
              </div>
            </div>

            <div class="col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1">
              <div class="summary entry-summary">
                <h2 class="shorter" style="float:left;"><span itemprop="name"><strong>{{ $product->name }}</strong></span></h2>
                @if($product->streak_price == "Call For Best Price")
                  <ul class="products product-thumb-info-list">
                    <li class="col-md-1 col-sm-1 col-xs-1 product">
                      @if($product->is_sale != 0)
                        <span class="onsaleInDetail">Sale!</span>
                      @endif
                    </li>
                  </ul>

                  <div class="review_num" style="opacity:0.2">
                    <span class="count" itemprop="ratingCount">2</span> reviews
                  </div>

                  <div title="Rated 5.00 out of 5" class="star-rating"  style="opacity:0.2">
                    <span style="width:100%"><strong class="rating">5.00</strong> out of 5</span>
                  </div>
                    <p class="price">
                      <span class="amount">{{ $product->base_price }}</span>
                    </p>
                    
                  <p class="price">
                      <span class="amount">
                        <a href="tel:02136202123">
                            Call For Best Price
                        </a>
                      </span>
                  </p>
                @elseif($product->streak_price == "call")
                  <ul class="products product-thumb-info-list">
                    <li class="col-md-1 col-sm-1 col-xs-1 product">
                    </li>
                  </ul>
                  <div class="review_num" style="opacity:0.2">
                    <span class="count" itemprop="ratingCount">2</span> reviews
                  </div>

                  <div title="Rated 5.00 out of 5" class="star-rating"  style="opacity:0.2">
                    <span style="width:100%"><strong class="rating">5.00</strong> out of 5</span>
                  </div>
                  <p class="price">
                      <span class="amount">
                        <a href="tel:02136202123">
                            CALL
                        </a>
                      </span>
                  </p>
                @else
                  <ul class="products product-thumb-info-list">
                    <li class="col-md-1 col-sm-1 col-xs-1 product">
                      @if($product->is_sale != 0)
                        <span class="onsale">Sale!</span>
                      @endif
                    </li>
                  </ul>

                  <div class="review_num" style="opacity:0.2">
                    <span class="count" itemprop="ratingCount">2</span> reviews
                  </div>

                  <div title="Rated 5.00 out of 5" class="star-rating"  style="opacity:0.2">
                    <span style="width:100%"><strong class="rating">5.00</strong> out of 5</span>
                  </div>
                  @if($product->is_sale != 0 && $product->streak_price != "")
                    <del><span class="amount">{{ $product->streak_price }}</span></del>
                  @endif
                  <p class="price">
                      <span class="amount">{{ $product->base_price }}</span>
                      @if(isset($product->discount))
                      <ul class="products product-thumb-info-list">
                        <li class="col-md-1 col-sm-1 col-xs-1 product">
                          <span class="discount">{{$product->discount}}</span>
                        </li>
                      </ul>
                    @endif
                  </p>
                @endif

                <span itemprop="description">
                  <p class="taller">{{ strip_tags($product->short_description) }}</p>
                </span>
                <?php
                  if(isset($product->productImage[0])) {
                    for($i=0;$i<count($product->productImage);$i++) {
                ?>
                      <div>
                        <img alt="{{ $product->name }}" class="img-responsive img-rounded" style="height:75px;width:75px;margin:3px;float:left" src="{{ $product->productImage[$i]->image_path }}" onclick="imagePreviewClick('image_{{$i}}')">
                      </div>
                <?php
                    }
                  }
                ?>     
                <form enctype="multipart/form-data" method="post" class="cart" style="visibility:hidden">
                  <div class="quantity">
                    <input type="button" class="minus" value="-">
                    <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                    <input type="button" class="plus" value="+">
                  </div>
                  <button href="#" class="btn btn-primary btn-icon">Add to cart</button>
                </form>

                <div class="product_meta">
                  @if(isset($category[0]))
                    <span class="posted_in">Categories: <a rel="tag" href="../{{$category[0]->permalink}}">{{$category[0]->name}}</a>.</span>
                  @endif
                </div>

              </div>


            </div>
            <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" style="display:none">
                <meta itemprop="priceCurrency" content="IDR" />
                <span itemprop="price">{{ $product->base_price }}</span>
            </span>
          </div>
          <div class="row">
            <strong>* harga dan stock dapat berubah sewaktu-waktu</strong>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="tabs tabs-product">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#productDescription" data-toggle="tab">Description</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="productDescription">
                    <p>{{ $product->long_description }}</p>
                  </div>
                  <div class="tab-pane" id="productInfo">
                    <table class="table table-striped push-top">
                      <tbody>
                        <tr>
                          <th>
                            Size:
                          </th>
                          <td>
                            Unique
                          </td>
                        </tr>
                        <tr>
                          <th>
                            Colors
                          </th>
                          <td>
                            Red, Blue
                          </td>
                        </tr>
                        <tr>
                          <th>
                            Material
                          </th>
                          <td>
                            100% Leather
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="productReviews">
                    <ul class="comments">
                      <li>
                        <div class="comment">
                          <div class="img-thumbnail">
                            <img class="avatar" alt="" src="">
                          </div>
                          <div class="comment-block">
                            <div class="comment-arrow"></div>
                            <span class="comment-by">
                              <strong>John Doe</strong>
                              <span class="pull-right">
                                <div title="Rated 5.00 out of 5" class="star-rating">
                                  <span style="width:100%"><strong class="rating">5.00</strong> out of 5</span>
                                </div>
                              </span>
                            </span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.</p>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <hr class="tall">
                    <h4>Add a review</h4>
                    <div class="row">
                      <div class="col-md-12">

                        <form action="" id="submitReview" type="post">
                          <div class="row">
                            <div class="form-group">
                              <div class="col-md-6">
                                <label>Your name *</label>
                                <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name">
                              </div>
                              <div class="col-md-6">
                                <label>Your email address *</label>
                                <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group">
                              <div class="col-md-12">
                                <label>Review *</label>
                                <textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <input type="submit" value="Submit Review" class="btn btn-primary" data-loading-text="Loading...">
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @if(isset($random_product[0]))
            <hr class="tall" />
            <div class="row">
              <div class="col-md-12">
                <h2>Related <strong>Products</strong></h2>
              </div>
              <ul class="products product-thumb-info-list">
                @foreach($random_product as $random)
                  <li class="col-md-3 col-sm-4 col-xs-8 product">
                    @if($random->streak_price == "Call For Best Price")
                      @if($random->is_sale != 0)
                        <a href="/product/detail/{{ $random->permalink }}">
                            <span class="onsale">Sale!</span>
                        </a>
                      @endif
                      <span class="product-thumb-info">
                          <a href="/product/detail/{{ $random->permalink }}">
                              <span class="product-thumb-info-image">
                                  <span class="product-thumb-info-act">
                                      <span class="product-thumb-info-act-left"><em>View</em></span>
                                      <span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Details</em></span>
                                  </span>
                                  @if(isset($random->productImage[0]))
                                      <img style="width:100%" alt="{{ $random->name }}" class="img-responsive" src="{{ $random->productImage[0]->image_path }}">
                                  @else
                                      <img style="width:100%" alt="" class="img-responsive" src="/assets/userweb/images/no_product_image.jpg">
                                  @endif
                              </span>
                          </a>
                              <span class="product-thumb-info-content">
                                  <a href="/product/detail/{{ $random->permalink }}">
                                          <h4 class="flow">{{ $random->name }}</h4>
                                          <div class="ellipsis-2">{{ strip_tags($random->short_description) }}</div>
                                      <span class="price">
                                          <span class="amount">{{$random->base_price}}</span>
                                          <br/>
                                          <ins><span class="amount">
                                              <a class="telp" href="tel:02136202123">
                                                  Call For Best Price
                                              </a>
                                          </span></ins>
                                      </span>
                                  </a>
                              </span>
                      </span>
                    @elseif($random->streak_price == "call")
                        <span class="product-thumb-info">
                            <a href="/product/detail/{{ $random->permalink }}">
                                <span class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <span class="product-thumb-info-act-left"><em>View</em></span>
                                        <span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Details</em></span>
                                    </span>
                                    @if(isset($random->productImage[0]))
                                        <img style="width:100%" alt="{{ $random->name }}" class="img-responsive" src="{{ $random->productImage[0]->image_path }}">
                                    @else
                                        <img style="width:100%" alt="" class="img-responsive" src="/assets/userweb/images/no_product_image.jpg">
                                    @endif
                                </span>
                            </a>
                                <span class="product-thumb-info-content">
                                    <a href="/product/detail/{{ $random->permalink }}">
                                            <h4 class="flow">{{ $random->name }}</h4>
                                            <div class="ellipsis-2">{{ strip_tags($random->short_description) }}</div>
                                        <span class="price">
                                            <ins><span class="amount">
                                                <a class="telp" href="tel:02136202123">
                                                    CALL
                                                </a>
                                            </span></ins>
                                        </span>
                                    </a>
                                </span>
                        </span>
                    @else
                        @if(isset($random->discount))
                                <span class="onDiscount-grid">{{$random->discount}}</span>
                        @endif
                        @if($random->is_sale != 0)
                            <a href="/product/detail/{{ $random->permalink }}">
                                <span class="onsale">Sale!</span>
                            </a>
                        @endif

                        <span class="product-thumb-info">
                            <a href="/product/detail/{{ $random->permalink }}">
                                <span class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <span class="product-thumb-info-act-left"><em>View</em></span>
                                        <span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Details</em></span>
                                    </span>
                                    @if(isset($random->productImage[0]))
                                        <img style="width:100%" alt="{{ $random->name }}" class="img-responsive" src="{{ $random->productImage[0]->image_path }}">
                                    @else
                                        <img style="width:100%" alt="" class="img-responsive" src="/assets/userweb/images/no_product_image.jpg">
                                    @endif
                                </span>
                            </a>
                                <span class="product-thumb-info-content">
                                    <a href="/product/detail/{{ $random->permalink }}">
                                            <h4 class="flow">{{ $random->name }}</h4>
                                            <div class="ellipsis-2">{{ strip_tags($random->short_description) }}</div>
                                        <span class="price">
                                            @if($random->is_sale != 0 && $random->streak_price !="")
                                                <del><span class="amount">{{$random->streak_price}}</span></del>
                                                @if(isset($random->discount))
                                                    <ins><span class="amount" style="visibility:hidden">{{$random->discount}}</span></ins>
                                                @else
                                                    <ins><span class="amount" style="visibility:hidden">0%</span></ins>
                                                @endif
                                                <br/>
                                                <ins><span class="amount">{{$random->base_price}}</span></ins>
                                            @else
                                                <ins><span class="amount">{{$random->base_price}}</span></ins>
                                                <br/>
                                                <del><span class="amount" style="visibility:hidden">0,00</span></del>
                                                <ins><span class="amount" style="visibility:hidden">0%</span></ins>
                                            @endif    
                                        </span>
                                    </a>
                                </span>
                        </span>
                    @endif
                  </li>
                @endforeach
              </ul>
            </div>      
          @endif

        </div>

      </div>


@stop
