<div role="main" class="main shop main-product">
    <!-- <hr class="shorter"> -->
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <h2 class="shorter"><strong>{{$title->name}}</strong></h2>
                    @if(isset($products))
                        <p>Showing {{ $products->getFrom() }} – {{ $products->getTo() }} of {{ $products->getTotal() }} results.</p>
                    @else
                        <p>Showing 0 of 0 results.</p>
                    @endif

                    <strong>* harga dan stock dapat berubah sewaktu-waktu</strong>
                    <div class="well well-sm">
                        <div class="btn-group">
                            <a href="#" id="list" class="active btn btn-default btn-lg">
                                <span class="icon icon-list"></span>
                            </a> 
                            <a href="#" id="grid" class="btn btn-default btn-lg">
                                <span class="icon icon-th"></span></a>
                        </div>
                    </div>
                    <div style="font-size:18px">{{$title->description}}</div>
                    
                    <div id = "products-grid" class="row" style="display:none;">
                        <ul class="products product-thumb-info-list">
                        @if(isset($products[0]))
                          @foreach($products as $product)
                            <li class="col-md-4 col-sm-4 col-xs-8 product">
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
                                                        <div class="ellipsis-2">{{ $product->short_description }}</div>
                                                    <span class="price">
                                                        @if($product->base_price !="")
                                                            <span class="amount">{{$product->base_price}}</span>
                                                            <br/>
                                                        @endif
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
                                                        <div class="ellipsis-2">{{ $product->short_description }}</div>
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
                                                        <div class="ellipsis-2">{{ $product->short_description }}</div>
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
                        @else
                          <li class="col-md-4 product">
                            No Result
                          </li>
                        @endif
                        </ul>
                    </div>

                    <div id = "products-list">
                        <div class="featured-box featured-box-secundary featured-box-cart">
                            <div class="box-content">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">
                                                &nbsp;
                                            </th>
                                            <th class="product-name">
                                                Product
                                            </th>
                                            <th class="product-thumbnail visible-lg visible-md visible-sm">
                                                &nbsp;
                                            </th>
                                            <th class="product-thumbnail visible-lg visible-md visible-sm">
                                                &nbsp;
                                            </th>
                                            <th class="product-price" style ="text-align:right">
                                                Price
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($products[0]))
                                            @foreach($products as $product)
                                                @if($product->streak_price == "call")
                                                    <tr class="cart_table_item">
                                                        <td class="product-thumbnail">
                                                            @if(isset($product->productImage[0]))
                                                                <a class="lightbox pull-left" href="{{ $product->productImage[0]->image_path }}" data-plugin-options='{"type":"image"}'>
                                                                    <img style="width:26px;height:26px" class="img-circle" src="{{ $product->productImage[0]->image_path }}" alt ="{{ $product->name }}">
                                                                </a>
                                                            @else
                                                                <img style="width:26px;height:26px" alt="" class="img-circle" src="/assets/userweb/images/no_product_image.jpg">
                                                            @endif
                                                        </td>
                                                        <td class="product-name" class="flow">
                                                            <a class="product-list-name" href="/product/detail/{{ $product->permalink }}">{{ $product->name }}</a>
                                                            <br/><div class="custom-font-size">{{ $product->short_description }}</div>
                                                        </td>
                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
                                                        </td>
                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
                                                        </td>
                                                        <td class="product-price" style ="text-align:right">
                                                            <span class="amount">
                                                                <a href="tel:02136202123">
                                                                    CALL
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @elseif($product->streak_price == "Call For Best Price")
                                                    <tr class="cart_table_item">
                                                        <td class="product-thumbnail">
                                                            @if(isset($product->productImage[0]))
                                                                <a class="lightbox pull-left" href="{{ $product->productImage[0]->image_path }}" data-plugin-options='{"type":"image"}'>
                                                                    <img style="width:26px;height:26px" class="img-circle" src="{{ $product->productImage[0]->image_path }}" alt="{{ $product->name }}">
                                                                </a>
                                                            @else
                                                                <img style="width:26px;height:26px" alt="" class="img-circle" src="/assets/userweb/images/no_product_image.jpg">
                                                            @endif
                                                        </td>
                                                        <td class="product-name" class="flow">
                                                            <a class="product-list-name" href="/product/detail/{{ $product->permalink }}">{{ $product->name }}</a>
                                                            <br/><div class="custom-font-size">{{ $product->short_description }}</div>
                                                        </td>
                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
                                                            @if($product->is_sale != 0)
                                                                <a href="/product/detail/{{ $product->permalink }}">
                                                                    <span class="onsale">Sale!</span>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
                                                        </td>
                                                        <td class="product-price" style ="text-align:right">
                                                            @if($product->base_price !="")
                                                                <span class="amount">{{$product->base_price}}</span>
                                                                <br/>
                                                            @endif
                                                            <span class="amount">
                                                                <a href="tel:02136202123">
                                                                    Call For Best Price
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr class="cart_table_item">
                                                        <td class="product-thumbnail">
                                                            @if(isset($product->productImage[0]))
                                                                <a class="lightbox pull-left" href="{{ $product->productImage[0]->image_path }}" data-plugin-options='{"type":"image"}'>
                                                                    <img style="width:26px;height:26px" class="img-circle" src="{{ $product->productImage[0]->image_path }}" alt="{{ $product->name }}">
                                                                </a>
                                                            @else
                                                                <img style="width:26px;height:26px" alt="" class="img-circle" src="/assets/userweb/images/no_product_image.jpg">
                                                            @endif
                                                        </td>
                                                        <td class="product-name" class="flow">
                                                            <a class="product-list-name" href="/product/detail/{{ $product->permalink }}">{{ $product->name }}</a>
                                                            <br/><div class="custom-font-size">{{ $product->short_description }}</div>
                                                        </td>
                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
                                                            @if($product->is_sale != 0)
                                                                <a href="/product/detail/{{ $product->permalink }}">
                                                                    <span class="onsale">Sale!</span>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
                                                            @if(isset($product->discount))
                                                                <span class="discount-list">{{$product->discount}}</span>
                                                            @endif
                                                        </td>
                                                        <td class="product-price" style ="text-align:right">
                                                            @if($product->is_sale != 0 && $product->streak_price !="")
                                                                <del><span class="amount">{{$product->streak_price}}</span></del>
                                                                <br/>
                                                            @endif
                                                            <span class="amount">{{$product->base_price}}</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                        <tr class="cart_table_item">
                                                <td colspan="5">
                                                    No Result
                                                </td>
                                            </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <ul class="pagination pull-right">                    
                        @if(isset($products))
                            <li>{{$products->links()}}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>