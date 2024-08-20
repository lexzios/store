<div role="main" class="main shop main-product">
    <!-- <hr class="shorter"> -->
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <h2 class="shorter"><strong>{{$title->name}}</strong></h2>
                    <br/><strong>* harga dan stock dapat berubah sewaktu-waktu</strong>
                    <div class="well well-sm">
                        <div class="btn-group">
                            <a href="#" id="list" class="active btn btn-default btn-lg">
                                <span class="icon icon-list"></span>
                            </a> 
                            <a href="#" id="grid" class="btn btn-default btn-lg">
                                <span class="icon icon-th"></span></a>
                        </div>
                    </div>
                    <div id = "products-grid" class="row" style="display:none;">
                    	<?php $flagResult=0; ?>
                    	@if(isset($products[0]))
	                    	@foreach($products as $mainProduct)
	                    		@if(isset($mainProduct->product[0]))
	                    			<?php $flagResult=1; ?>
	                    			<div class="col-md-12">
		                    			<div class="grid-header well well-sm">
		                    				{{$mainProduct->name}}
		                    			</div>
	                    			</div>
		                    		<ul class="products product-thumb-info-list">
				                        <?php
		                            		for($i=0;$i<count($mainProduct->product);$i++)
		                            		{
		                            	?>
		                            		<li class="col-md-4 col-sm-4 col-xs-8 product">
				                                @if($mainProduct->product[$i]->streak_price == "Call For Best Price")
				                                	@if($mainProduct->product[$i]->is_sale != 0)
				                                        <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
				                                            <span class="onsale">Sale!</span>
				                                        </a>
				                                    @endif
				                                    <span class="product-thumb-info">
				                                        <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
				                                            <span class="product-thumb-info-image">
				                                                <span class="product-thumb-info-act">
				                                                    <span class="product-thumb-info-act-left"><em>View</em></span>
				                                                    <span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Details</em></span>
				                                                </span>
				                                                @if(isset($mainProduct->product[$i]->productImage[0]))
				                                                    <img style="width:100%" alt="{{ $mainProduct->product[$i]->name }}" class="img-responsive" src="{{ $mainProduct->product[$i]->productImage[0]->image_path }}">
				                                                @else
				                                                    <img style="width:100%" alt="" class="img-responsive" src="/assets/userweb/images/no_product_image.jpg">
				                                                @endif
				                                            </span>
				                                        </a>
				                                            <span class="product-thumb-info-content">
				                                                <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
				                                                        <h4 class="flow">{{ $mainProduct->product[$i]->name }}</h4>
				                                                        <div class="ellipsis-2">{{ $mainProduct->product[$i]->short_description }}</div>
				                                                    <span class="price">
				                                                        @if($mainProduct->product[$i]->base_price !="")
				                                                            <span class="amount">{{$mainProduct->product[$i]->base_price}}</span>
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
				                                @elseif($mainProduct->product[$i]->streak_price == "call")
				                                    <span class="product-thumb-info">
				                                        <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
				                                            <span class="product-thumb-info-image">
				                                                <span class="product-thumb-info-act">
				                                                    <span class="product-thumb-info-act-left"><em>View</em></span>
				                                                    <span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Details</em></span>
				                                                </span>
				                                                @if(isset($mainProduct->product[$i]->productImage[0]))
				                                                    <img style="width:100%" alt="{{ $mainProduct->product[$i]->name }}" class="img-responsive" src="{{ $mainProduct->product[$i]->productImage[0]->image_path }}">
				                                                @else
				                                                    <img style="width:100%" alt="" class="img-responsive" src="/assets/userweb/images/no_product_image.jpg">
				                                                @endif
				                                            </span>
				                                        </a>
				                                            <span class="product-thumb-info-content">
				                                                <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
				                                                        <h4 class="flow">{{ $mainProduct->product[$i]->name }}</h4>
				                                                        <div class="ellipsis-2">{{ $mainProduct->product[$i]->short_description }}</div>
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
				                                    @if(isset($mainProduct->product[$i]->discount))
				                                            <span class="onDiscount-grid">{{$mainProduct->product[$i]->discount}}</span>
				                                    @endif
				                                    @if($mainProduct->product[$i]->is_sale != 0)
				                                        <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
				                                            <span class="onsale">Sale!</span>
				                                        </a>
				                                    @endif

				                                    <span class="product-thumb-info">
				                                        <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
				                                            <span class="product-thumb-info-image">
				                                                <span class="product-thumb-info-act">
				                                                    <span class="product-thumb-info-act-left"><em>View</em></span>
				                                                    <span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Details</em></span>
				                                                </span>
				                                                @if(isset($mainProduct->product[$i]->productImage[0]))
				                                                    <img style="width:100%" alt="{{ $mainProduct->product[$i]->name }}" class="img-responsive" src="{{ $mainProduct->product[$i]->productImage[0]->image_path }}">
				                                                @else
				                                                    <img style="width:100%" alt="" class="img-responsive" src="/assets/userweb/images/no_product_image.jpg">
				                                                @endif
				                                            </span>
				                                        </a>
				                                            <span class="product-thumb-info-content">
				                                                <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
				                                                        <h4 class="flow">{{ $mainProduct->product[$i]->name }}</h4>
				                                                        <div class="ellipsis-2">{{ $mainProduct->product[$i]->short_description }}</div>
				                                                    <span class="price">
				                                                        @if($mainProduct->product[$i]->is_sale != 0 && $mainProduct->product[$i]->streak_price !="")
				                                                            <del><span class="amount">{{$mainProduct->product[$i]->streak_price}}</span></del>
				                                                            @if(isset($mainProduct->product[$i]->discount))
				                                                                <ins><span class="amount" style="visibility:hidden">{{$mainProduct->product[$i]->discount}}</span></ins>
				                                                            @else
				                                                                <ins><span class="amount" style="visibility:hidden">0%</span></ins>
				                                                            @endif
				                                                            <br/>
				                                                            <ins><span class="amount">{{$mainProduct->product[$i]->base_price}}</span></ins>
				                                                        @else
				                                                            <ins><span class="amount">{{$mainProduct->product[$i]->base_price}}</span></ins>
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
		                            	<?php
		                            		}
		                            	?>
				                    </ul>  
	                    		@endif
	                    	@endforeach
                    	@endif
                    	@if($flagResult == 0)
                    		<ul class="products product-thumb-info-list">
                    			<li class="col-md-4 product">
	                            No Result
	                          </li>
	                        </ul> 
                    	@endif
                    </div>

                    <div id = "products-list">
                        <div class="featured-box featured-box-secundary featured-box-cart">
                            <div class="box-content">
                                <table cellspacing="0" class="shop_table cart">
                                    
                                    <tbody>
                                    	<?php $flagResult=0; ?>
                                        @if(isset($products[0]))
                                        	@foreach($products as $mainProduct)
                                        		@if(isset($mainProduct->product[0]))
                                        			<tr>
		                                        		<th colspan="5" class="list-header">{{$mainProduct->name}}</th>
		                                        	</tr>
		                                        	@if(isset($mainProduct->product[0]))
		                                        	<?php
			                                        	$flagResult=1;
		                                        		for($i=0;$i<count($mainProduct->product);$i++)
		                                        		{
		                                        	?>
		                                        			@if($mainProduct->product[$i]->streak_price == "call")
			                                                    <tr class="cart_table_item">
			                                                        <td class="product-thumbnail">
			                                                            @if(isset($mainProduct->product[$i]->productImage[0]))
			                                                                <a class="lightbox pull-left" href="{{ $mainProduct->product[$i]->productImage[0]->image_path }}" data-plugin-options='{"type":"image"}'>
			                                                                    <img style="width:26px;height:26px" class="img-circle" src="{{ $mainProduct->product[$i]->productImage[0]->image_path }}" alt="{{ $mainProduct->product[$i]->name }}">
			                                                                </a>
			                                                            @else
			                                                                <img style="width:26px;height:26px" alt="" class="img-circle" src="/assets/userweb/images/no_product_image.jpg">
			                                                            @endif
			                                                        </td>
			                                                        <td class="product-name" class="flow">
			                                                            <a class="product-list-name" href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">{{ $mainProduct->product[$i]->name }}</a>
			                                                            <br/><div class="custom-font-size">{{ $mainProduct->product[$i]->short_description }}</div>
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
			                                                        </td>
			                                                    </tr>
			                                                @elseif($mainProduct->product[$i]->streak_price == "Call For Best Price")
			                                                    <tr class="cart_table_item">
			                                                        <td class="product-thumbnail">
			                                                            @if(isset($mainProduct->product[$i]->productImage[0]))
			                                                                <a class="lightbox pull-left" href="{{ $mainProduct->product[$i]->productImage[0]->image_path }}" data-plugin-options='{"type":"image"}'>
			                                                                    <img style="width:26px;height:26px" class="img-circle" src="{{ $mainProduct->product[$i]->productImage[0]->image_path }}" alt="{{ $mainProduct->product[$i]->name }}">
			                                                                </a>
			                                                            @else
			                                                                <img style="width:26px;height:26px" alt="" class="img-circle" src="/assets/userweb/images/no_product_image.jpg">
			                                                            @endif
			                                                        </td>
			                                                        <td class="product-name" class="flow">
			                                                            <a class="product-list-name" href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">{{ $mainProduct->product[$i]->name }}</a>
			                                                        	<br/><div class="custom-font-size">{{ $mainProduct->product[$i]->short_description }}</div>
			                                                        </td>
			                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
			                                                        	@if($mainProduct->product[$i]->is_sale != 0)
			                                                                <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
			                                                                    <span class="onsale">Sale!</span>
			                                                                </a>
			                                                            @endif
			                                                        </td>
			                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
			                                                        </td>
			                                                        <td class="product-price" style ="text-align:right">
			                                                            @if($mainProduct->product[$i]->base_price !="")
				                                                            <span class="amount">{{$mainProduct->product[$i]->base_price}}</span>
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
			                                                            @if(isset($mainProduct->product[$i]->productImage[0]))
			                                                                <a class="lightbox pull-left" href="{{ $mainProduct->product[$i]->productImage[0]->image_path }}" data-plugin-options='{"type":"image"}'>
			                                                                    <img style="width:26px;height:26px" class="img-circle" src="{{ $mainProduct->product[$i]->productImage[0]->image_path }}" alt="{{ $mainProduct->product[$i]->name }}">
			                                                                </a>
			                                                            @else
			                                                                <img style="width:26px;height:26px" alt="" class="img-circle" src="/assets/userweb/images/no_product_image.jpg">
			                                                            @endif
			                                                        </td>
			                                                        <td class="product-name" class="flow">
			                                                            <a class="product-list-name" href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">{{ $mainProduct->product[$i]->name }}</a>
			                                                        	<br/><div class="custom-font-size">{{ $mainProduct->product[$i]->short_description }}</div>
			                                                        </td>
			                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
			                                                            @if($mainProduct->product[$i]->is_sale != 0)
			                                                                <a href="/product/detail/{{ $mainProduct->product[$i]->permalink }}">
			                                                                    <span class="onsale">Sale!</span>
			                                                                </a>
			                                                            @endif
			                                                        </td>
			                                                        <td class="product-thumbnail visible-lg visible-md visible-sm">
			                                                            @if(isset($mainProduct->product[$i]->discount))
			                                                                <span class="discount-list">{{$mainProduct->product[$i]->discount}}</span>
			                                                            @endif
			                                                        </td>
			                                                        <td class="product-price" style ="text-align:right">
			                                                            @if($mainProduct->product[$i]->is_sale != 0 && $mainProduct->product[$i]->streak_price !="")
			                                                                <del><span class="amount">{{$mainProduct->product[$i]->streak_price}}</span></del>
			                                                                <br/>
			                                                            @endif
			                                                            <span class="amount">{{$mainProduct->product[$i]->base_price}}</span>
			                                                        </td>
			                                                    </tr>
			                                                @endif
		                                        	<?php
		                                        		}
		                                        	?>
		                                        	@else
		                                        	<tr class="cart_table_item">
		                                                <td colspan="5">
		                                                    No Result
		                                                </td>
		                                            </tr>
		                                        	@endif
                                        		@endif
	                                        @endforeach
                                        @endif
                                        @if($flagResult == 0)
                                            <td colspan="5" style="border-top:0px">
	                                            No Result
	                                        </td>
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