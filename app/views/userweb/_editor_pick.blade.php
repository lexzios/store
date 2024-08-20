@if(isset($products[0]))
  <hr class="tall" />
  <div role="main" class="main shop">
      <div class="col-md-12">
        <h4 class="black-colour"><strong>Editor's Picks</strong></h4>
        <h2><strong>Computer and Office</strong></h2>
          <div class="row">
            <ul class="products product-thumb-info-list">
              @foreach($products as $product)
                <li class="col-md-3 col-sm-4 col-xs-8 product">
                    @if($product->streak_price == "Call For Best Price")
                        @if($product->is_sale != 0)
                            <a href="/product/detail/{{ $product->permalink }}">
                                <span class="onsale">Sale!</span>
                            </a>
                        @endif
                        <span class="product-thumb-info">
                            <a href="/product/detail/{{ $product->permalink }}">
                                <span class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <span class="product-thumb-info-act-left"><em>View</em></span>
                                        <span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Details</em></span>
                                    </span>
                                    @if(isset($product->productImage[0]))
                                        <img style="width:100%" alt="{{ $product->name }}" class="img-responsive" src="{{ $product->productImage[0]->image_path }}">
                                    @else
                                        <img style="width:100%" alt="" class="img-responsive" src="/assets/userweb/images/no_product_image.jpg">
                                    @endif
                                </span>
                            </a>
                                <span class="product-thumb-info-content">
                                    <a href="/product/detail/{{ $product->permalink }}">
                                            <h4 class="flow">{{ $product->name }}</h4>
                                            <div class="ellipsis-2">{{ strip_tags($product->short_description) }}</div>
                                        <span class="price">
                                            <span class="amount">{{$product->base_price}}</span>
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
                    @elseif($product->streak_price == "call")
                        <span class="product-thumb-info">
                            <a href="/product/detail/{{ $product->permalink }}">
                                <span class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <span class="product-thumb-info-act-left"><em>View</em></span>
                                        <span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Details</em></span>
                                    </span>
                                    @if(isset($product->productImage[0]))
                                        <img style="width:100%" alt="{{ $product->name }}" class="img-responsive" src="{{ $product->productImage[0]->image_path }}">
                                    @else
                                        <img style="width:100%" alt="" class="img-responsive" src="/assets/userweb/images/no_product_image.jpg">
                                    @endif
                                </span>
                            </a>
                                <span class="product-thumb-info-content">
                                    <a href="/product/detail/{{ $product->permalink }}">
                                            <h4 class="flow">{{ $product->name }}</h4>
                                            <div class="ellipsis-2">{{ strip_tags($product->short_description) }}</div>
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
                        @if(isset($product->discount))
                                <span class="onDiscount-grid">{{$product->discount}}</span>
                        @endif
                        @if($product->is_sale != 0)
                            <a href="/product/detail/{{ $product->permalink }}">
                                <span class="onsale">Sale!</span>
                            </a>
                        @endif

                        <span class="product-thumb-info">
                            <a href="/product/detail/{{ $product->permalink }}">
                                <span class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <span class="product-thumb-info-act-left"><em>View</em></span>
                                        <span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Details</em></span>
                                    </span>
                                    @if(isset($product->productImage[0]))
                                        <img style="width:100%" alt="{{ $product->name }}" class="img-responsive" src="{{ $product->productImage[0]->image_path }}">
                                    @else
                                        <img style="width:100%" alt="" class="img-responsive" src="/assets/userweb/images/no_product_image.jpg">
                                    @endif
                                </span>
                            </a>
                                <span class="product-thumb-info-content">
                                    <a href="/product/detail/{{ $product->permalink }}">
                                            <h4 class="flow">{{ $product->name }}</h4>
                                            <div class="ellipsis-2">{{ strip_tags($product->short_description) }}</div>
                                        <span class="price">
                                            @if($product->is_sale != 0 && $product->streak_price !="")
                                                <del><span class="amount">{{$product->streak_price}}</span></del>
                                                @if(isset($product->discount))
                                                    <ins><span class="amount" style="visibility:hidden">{{$product->discount}}</span></ins>
                                                @else
                                                    <ins><span class="amount" style="visibility:hidden">0%</span></ins>
                                                @endif
                                                <br/>
                                                <ins><span class="amount">{{$product->base_price}}</span></ins>
                                            @else
                                                <ins><span class="amount">{{$product->base_price}}</span></ins>
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
      </div>
    </div>
    
  @endif