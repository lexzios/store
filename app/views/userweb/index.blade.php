@extends('layouts.userweb.application')

@section('body')
  <section class="page-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Product</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h2>Product</h2>
          </div>
        </div>
      </div>
  </section>

  <!-- <hr class="shorter"> -->
	<div class="container">
    <div class="col-md-3 row">
		  @include('userweb._sidebar')
    </div>
		<div class="main col-md-9" role="main">
			@include('userweb._main_banner', array('categories' => $categories, 'mainBanners' => $mainBanners, 'banners' => $banners))
    </div>
	</div>

<hr class="tall">
<div class="container">
  <div class="row center">
    <div class="col-md-12">
      <h2 class="short word-rotator-title">
        Central PC menyediakan
        <strong class="inverted">
          <span class="word-rotate">
            <span class="word-rotate-items">
              <span>Product</span>
              <span>Service</span>
              <span>Opsi</span>
            </span>
          </span>
        </strong>
        terbaik dan terpercaya.
      </h2>
      <p class="featured lead">
        Central PC berlokasi di pusat penjualan electronic Harco Mangga Dua. Kami bergerak di bidang penjualan hardware computer, server, notebook, gadget, software serta networking. Selain penjualan kami juga menyediakan Service Komputer maupun Notebook sebagai bentuk peningkatan pelayanan bagi customer. Kepercayaan, kepuasan serta pengalaman berbelanja yang menyenangkan bagi customer menjadi tujuan utama kami.

      </p>
    </div>
  </div>

</div>

<div class="home-concept">
  <div class="container">

    <div class="row center">
      <span class="sun"></span>
      <span class="cloud"></span>
      <div class="col-md-2 col-md-offset-1">
        <div class="process-image" data-appear-animation="bounceIn">
          <img src="assets/userweb/images/search_price.png" alt="komputer murah, harga komputer murah, toko komputer rakitan, toko central pc" />
          <strong>Cari Produk</strong>
        </div>
      </div>
      <div class="col-md-2">
        <div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="200">
          <img src="assets/userweb/images/contact_us.png" alt="komputer murah jakarta, komputer mangga dua, komputer harco, komputer rakitan harco, toko harco" />
          <strong>Hubungi Kami</strong>
        </div>
      </div>
      <div class="col-md-2">
        <div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="400">
          <img src="assets/userweb/images/transaction.png" alt="beli komputer murah, beli komputer rakitan, komputer harco murah, laptop murah, toko laptop murah" />
          <strong>Melakukan Transaksi</strong>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-1">
        <div class="project-image">
          <div id="fcSlideshow" class="fc-slideshow">
            <ul class="fc-slides">
              <li><img class="img-responsive" src="assets/userweb/images/our-services-1.png" /></li>
              <li><img class="img-responsive" src="assets/userweb/images/our-services-2.png" /></li>
              <li><img class="img-responsive" src="assets/userweb/images/our-services-3.png" /></li>
              <li><img class="img-responsive" src="assets/userweb/images/our-services-4.png" /></li>
            </ul>
          </div>
          <strong class="our-work">Pelayanan Kami</strong>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="container">
  @include('userweb._editor_pick', array('products'=> $products))
  <div class="row center">
    <div class="col-md-12">
      <hr class="tall" />
      <h2 class="short word-rotator-title">
        We want our Customers to be
        <strong>
          <span class="word-rotate">
            <span class="word-rotate-items">
              <span>Satisfied</span>
              <span>Happy</span>
              <span>Pleased</span>
            </span>
          </span>
        </strong>
        with our product and service
      </h2>
      <h4 class="lead tall">Thank you for choosing and giving us opportunity to serve your company. We look forward to serving you for many more years...</h4>
    </div>
  </div>
  <div class="row center"  id="company-logo">
    <div class="owl-carousel" data-plugin-options='{"items": 6, "singleItem": false, "autoPlay": true}'>
      <div>
        <img class="img-responsive" src="themes/userweb/img/logos/buzoo.png" alt="Buzoo">
      </div>
      <div>
        <img class="img-responsive" src="themes/userweb/img/logos/altavindo.png" alt="Altavindo">
      </div>
      <div>
        <img class="img-responsive" src="themes/userweb/img/logos/epp.png" alt="PT. Ekatama Putra Perkasa">
      </div>
      <div>
        <img class="img-responsive" src="themes/userweb/img/logos/wkp.png" alt="PT. Wirya Krenindo Perkasa">
      </div>
      <div>
        <img class="img-responsive" src="themes/userweb/img/logos/agung_sedayu_group.png" alt="Agung Sedayu Group">
      </div>
      <div>
        <img class="img-responsive" src="themes/userweb/img/logos/naga_semut.png" alt="PT. Naga Semut">
      </div>
      <div>
        <img class="img-responsive" src="themes/userweb/img/logos/prima_logistic.png" alt="Prima Logistic">
      </div>
    </div>
  </div>

</div>

<div class="map-section">
  <section class="featured footer map">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="recent-posts push-bottom">
            <h2>Latest <strong>Blog</strong> Posts</h2>
            <div class="row">
              <div id="recent-blog">
                  <div class="overlay">
                      <img src="/assets/userweb/images/ajax-loader.gif"></img>
                      <p>Fetching blog post ...</p>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <h2><strong>What</strong> Client’s Say</h2>
          <div class="row">
            <div class="owl-carousel push-bottom" data-plugin-options='{"items": 1, "autoHeight": true}'>
              @if(isset($testimonials[0]))
                @foreach($testimonials as $testimonial)
                  <div>
                    <div class="col-md-12">
                      <blockquote class="testimonial">
                      <p>{{$testimonial->testimonial}}</p>
                      </blockquote>
                      <div class="testimonial-arrow-down"></div>
                      <div class="testimonial-author">
                        <div class="img-thumbnail img-thumbnail-small">
                          <img src="/assets/userweb/images/default-avatar.png" alt="">
                        </div>
                        <p><strong>{{$testimonial->name}}</strong><span>{{$testimonial->country}}</span></p>
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <div>
                    <div class="col-md-12">
                      <blockquote class="testimonial">
                      <p>Pelayanannya oke banget deh. Tinggal pesan!barang sampai depan rumah.</p>
                      </blockquote>
                      <div class="testimonial-arrow-down"></div>
                      <div class="testimonial-author">
                        <div class="img-thumbnail img-thumbnail-small">
                          <img src="/assets/userweb/images/default-avatar.png" alt="">
                        </div>
                        <p><strong>Lexy</strong><span>Binus</span></p>
                      </div>
                    </div>
                  </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="tall">
    <div class="container">
      <div class="row">
        <div class="center">
          <h3>Pesan <strong>Produk-produk kami</strong> langsung
            <a href="/cara-order" target="_blank" class="btn btn-lg btn-primary" data-appear-animation="bounceIn" style="margin-left:10px">
              Cara Order!
            </a>
            <span class="arrow hlb hidden-xs hidden-sm hidden-md" data-appear-animation="rotateInUpLeft" style="top:-22px;">
           </span>
          </h3>
       </div>
      </div>
    </div>
  </section>
</div>

<script src="/assets/userweb/javascripts/noframework.waypoints.min.js"></script>
<script src="/assets/userweb/javascripts/blog.js"></script>
@stop
