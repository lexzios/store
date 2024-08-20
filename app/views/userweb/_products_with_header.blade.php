<div role="main" class="main shop main-product">
    <!-- <hr class="shorter"> -->
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <h2 class="shorter"><strong>{{$title->name}}</strong></h2>
                    <br/><strong>* harga dan stock dapat berubah sewaktu-waktu</strong>
                    @if(isset($title->file_path) && $title->file_path != "")
	                    <div class="well well-sm">
	                        <div>
	                            <a href="#" id="list-none" class="btn btn-default btn-lg visible-none">
	                                <span class="icon icon-list"></span>
	                            </a> 
	                            <a href="#" id="grid-none" class="btn btn-default btn-lg visible-none">
	                                <span class="icon icon-th"></span>
	                            </a>
	                            <a href="/download-price-list{{$title->file_path}}" id="download" class="btn btn-default btn-lg">
	                                <span>Download List Harga</span>
	                            </a>
	                        </div>
	                    </div>
	                @endif

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
			                                                            <br/><div class="custom-font-size">{{ strip_tags($mainProduct->product[$i]->short_description) }}</div>
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
			                                                        	<br/><div class="custom-font-size">{{ strip_tags($mainProduct->product[$i]->short_description) }}</div>
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
			                                                        	<br/><div class="custom-font-size">{{ strip_tags($mainProduct->product[$i]->short_description) }}</div>
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