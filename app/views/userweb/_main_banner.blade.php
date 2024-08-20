<h4 style="visibility:hidden">Banner</h4>
<div class="slider-container">
	<div class="slider" id="revolutionSlider">
		<ul>
			@foreach($mainBanners as $mainBanner)
			<li data-transition="random" data-slotamount="1" data-masterspeed="500" >
				<img src="{{ $mainBanner->image_path }}" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
				<a href="{{ $mainBanner->action_url }}">
					<div class="tp-caption sft stb"
						 data-x="0"
						 data-y="0"
						 data-speed="300"
						 data-start="1000"
						 data-easing="easeOutExpo">
					</div>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
</div>

<div class="owl-carousel owl-carousel-spaced" data-plugin-options='{"items": 4, "singleItem": false, "autoHeight": true, "autoPlay":true}'>
	@if(count($banners) < 7)
		@foreach($banners as $banner)
			<div class="product">
				<span class="onSale-grid">Sale</span>
				<span class="product-thumb-info">
					<a href="/product/detail/{{ $banner->permalink }}">
						<span class="product-thumb-info-image">
							<span class="product-thumb-info-act">
								<span class="product-thumb-info-act-center"><em>{{$banner->name}}</em></span>
							</span>
							@if(isset($banner->productImage[0]))
								<img class="img-responsive" src="{{ $banner->productImage[0]->image_path }}" alt="{{ $banner->name }}">
							@else
								<img class="img-responsive" src="/assets/userweb/images/no_product_image.jpg" alt="">
							@endif
						</span>
					</a>
				</span>
			</div>
		@endforeach
	@else
		<?php
			for($i=0;$i<count($banners);$i++)
			{
				if(isset($banners[$i]))
				{
		?>
					<div>
						<div class="product">
							<span class="onSale-grid">Sale</span>
							<span class="product-thumb-info">
								<a href="/product/detail/{{ $banners[$i]->permalink }}">
									<span class="product-thumb-info-image">
										<span class="product-thumb-info-act">
											<span class="product-thumb-info-act-center"><em>{{$banners[$i]->name}}</em></span>
										</span>
										@if(isset($banners[$i]->productImage[0]))
											<img class="img-responsive" src="{{ $banners[$i]->productImage[0]->image_path }}" alt="{{ $banners[$i]->name }}">
										@else
											<img class="img-responsive" src="/assets/userweb/images/no_product_image.jpg" alt="">
										@endif
									</span>
								</a>
							</span>
						</div>
		<?php
					if(isset($banners[$i+1]))
					{
						$i++;
		?>
						<div class="product">
							<span class="onSale-grid-2">Sale</span>
							<span class="product-thumb-info">
								<a href="/product/detail/{{ $banners[$i]->permalink }}">
									<span class="product-thumb-info-image">
										<span class="product-thumb-info-act">
											<span class="product-thumb-info-act-center"><em>{{$banners[$i]->name}}</em></span>
										</span>
										@if(isset($banners[$i]->productImage[0]))
											<img class="img-responsive" src="{{ $banners[$i]->productImage[0]->image_path }}" alt="{{ $banners[$i]->name }}">
										@else
											<img class="img-responsive" src="/assets/userweb/images/no_product_image.jpg" alt="">
										@endif
									</span>
								</a>
							</span>
						</div>
		<?php
					}
		?>
					</div>
		<?php
				}
			}
		?>
	@endif
</div>