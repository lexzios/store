<div role="main" class="main shop main-product">
    <!-- <hr class="shorter"> -->
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">

                    <h2 class="shorter"><strong>Search Results: “{{$name}}”</strong></h2>
                    @if(isset($products))
                        <p>Showing {{ $products->getFrom() }} – {{ $products->getTo() }} of {{ $products->getTotal() }} results.</p>
                    @else
                        <p>Showing 0 of 0 results.</p>
                    @endif
                    <strong>* harga dan stock dapat berubah sewaktu-waktu</strong>

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
                                                                    <img style="width:26px;height:26px" class="img-circle" src="{{ $product->productImage[0]->image_path }}" alt="{{ $product->name }}">
                                                                </a>
                                                            @else
                                                                <img style="width:26px;height:26px" alt="" class="img-circle" src="/assets/userweb/images/no_product_image.jpg">
                                                            @endif
                                                        </td>
                                                        <td class="product-name" class="flow">
                                                            <a class="product-list-name" href="/product/detail/{{ $product->permalink }}">{{ $product->name }}</a>
                                                            <br/><div class="custom-font-size">{{ strip_tags($product->short_description) }}</div>
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
                                                            <br/><div class="custom-font-size">{{ strip_tags($product->short_description) }}</div>
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
                                                            <br/><div class="custom-font-size">{{ strip_tags($product->short_description) }}</div>
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
                                                <td colspan="4">
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
                            <li>{{$products->appends(array('name'=> $name))->links()}}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>