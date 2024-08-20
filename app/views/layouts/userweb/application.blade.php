<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		
    @section('head')
      <link rel="shortcut icon" href="/assets/userweb/images/favicon.png" />
      <!-- SEO -->
      <?php
        if(Request::segment(1) == NULL)
        {
      ?>
          <title>Toko Komputer Rakitan Central PC Harco - Mangga Dua | Harga Jual Komputer Termurah</title>
          <!-- <meta name="keywords" content="harga jual komputer, harga komputer rakitan, toko komputer, toko komputer harco, harco komputer, komputer jakarta, harga komputer, komputer murah, komputer rakitan, komputer game" /> -->
          <meta name="description" content="Toko kami di pusat komputer terbesar harco mangga dua. Menjual komputer branded dan komputer rakitan, hardware, laptop, aksesoris dll, harga murah, kami juga menerima jasa service. Harga jual komputer termurah." />
          <meta name="keywords" content="harga jual komputer, harga komputer rakitan, harga laptop murah, harga komputer, harga komputer termurah, harga komputer murah, harga laptop, toko komputer, toko komputer harco, harco komputer, komputer jakarta, komputer murah, komputer rakitan, komputer game, komputer termurah mangga dua, jual komputer mangga dua, jual komputer termurah mangga dua, jual laptop murah, laptop murah, service laptop, service laptop jakarta, rakit komputer, rakit komputer murah" />
          <meta name="abstract" content="Toko Komputer Rakitan Harco Central PC menjual komputer, komputer branded dan komputer rakitan, hardware, laptop, aksesoris dll dengan harga murah dan menyediakan jasa maintenance, upgrading dan service atau jasa perbaiki kerusakan laptop" />
          <meta name="mytopic" content="Toko Komputer Rakitan Harco Central PC menyediakan komputer, komputer branded dan komputer rakitan, hardware, laptop, aksesoris dll lengkap dan jasa service laptop" />
          <meta name="classification" content="bisnis, jual, jualan, penjualan, usaha, layanan, jasa, komputer, service, perbaikan, maintenance, upgrading" />
          <meta name="keyphrases" content="Mencari komputer, komputer branded dan komputer rakitan, hardware, laptop, aksesoris dll silakan kunjungi toko komputer rakitan harco Central PC" />
          <meta name="author" content="ions-tech.com">
          <link rel="canonical" href="http://www.tokocentralpc.com">
      <?php
        }
        else if(Request::segment(1) == "product" && Request::segment(2) != "detail")
        {
      ?>
          @if(isset($title->title_seo) && $title->title_seo != "")
            <title>{{strip_tags($title->title_seo)}} | Toko Komputer Rakitan Harco</title>
          @elseif(isset($title->name))
            <title>{{strip_tags($title->name)}} | Toko Komputer Rakitan Harco</title>
          @endif

          @if(isset($title->description_seo) && $title->description_seo != "" && isset($products[0]))
            <meta name="description" content="List Harga  {{strip_tags($title->description_seo)}} Lengkap terbaru! {{strip_tags($products[0]->name)}}" />
          @elseif(isset($title->description_seo) && $title->description_seo != "")
            <meta name="description" content="List Harga  {{strip_tags($title->description_seo)}} Lengkap terbaru!" />
          @elseif(isset($title->name) && isset($products[0]))
            <meta name="description" content="List Harga {{strip_tags($title->name)}} Lengkap terbaru! {{strip_tags($products[0]->name)}}" />
          @elseif(isset($title->name))
          <meta name="description" content="List Harga {{strip_tags($title->name)}} Lengkap terbaru!" />
          @endif
          @if(isset($title->keyword_seo) && $title->keyword_seo != "")
            <meta name="keywords" content="{{strip_tags($title->keyword_seo)}}" />
          @elseif(isset($title->name) && isset($products[0]))
            <meta name="keywords" content="{{strip_tags($title->name)}}, {{strip_tags($products[0]->name)}}" />
          @elseif(isset($title->name))
            <meta name="keywords" content="{{strip_tags($title->name)}}" />
          @endif
      <?php
        }
        else if(Request::segment(1) == "product" && Request::segment(2) == "detail")
        {
      ?>
          @if(isset($product->title_seo) && $product->title_seo != "")
            <title>{{strip_tags($product->title_seo)}} | Toko Komputer Rakitan Harco</title>
          @elseif(isset($product->name))
            <title>{{strip_tags($product->name)}} | Toko Komputer Rakitan Harco</title>
          @endif

          @if(isset($product->description_seo) && $product->description_seo != "")
            <meta name="description" content="{{strip_tags($product->description_seo)}}" />
          @elseif(isset($product->name))
            <meta name="description" content="{{strip_tags($product->name)}}" />
          @endif

          @if(isset($product->keyword_seo) && $product->keyword_seo != "")
            <meta name="keywords" content="{{strip_tags($product->keyword_seo)}}" />
          @elseif(isset($product->name) && isset($category[0]))
            <meta name="keywords" content="{{strip_tags($product->name)}}, {{strip_tags($category[0]->name)}}" />
          @endif
      <?php
        }
        else
        {
      ?>
          @if(isset($title))
            <title>{{strip_tags($title)}} | Toko Komputer Rakitan Harco</title>
          @endif
          <!-- @if(isset($keywords))
            <meta name="description" content="{{strip_tags($keywords)}}">
          @endif -->
      <?php
        }
      ?>
      <!-- SEO End -->

  		<!-- Mobile Metas -->
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">

  		<!-- Web Fonts  -->
  		<link href="/themes/userweb/font-google-apis/css/font-googleapis.css" rel="stylesheet" type="text/css">

  		<!-- Libs CSS -->
  		<link rel="stylesheet" href="/themes/userweb/vendor/bootstrap/css/bootstrap.css">
  		<link rel="stylesheet" href="/themes/userweb/vendor/font-awesome/css/font-awesome.css">
  		<link rel="stylesheet" href="/themes/userweb/vendor/owl-carousel/owl.carousel.css" media="screen">
  		<link rel="stylesheet" href="/themes/userweb/vendor/owl-carousel/owl.theme.css" media="screen">
  		<link rel="stylesheet" href="/themes/userweb/vendor/magnific-popup/magnific-popup.css" media="screen">
  		<link rel="stylesheet" href="/themes/userweb/vendor/isotope/jquery.isotope.css" media="screen">
  		<link rel="stylesheet" href="/themes/userweb/vendor/mediaelement/mediaelementplayer.css" media="screen">

  		<!-- Theme CSS -->
  		<link rel="stylesheet" href="/themes/userweb/css/theme.css">
  		<link rel="stylesheet" href="/themes/userweb/css/theme-elements.css">
  		<link rel="stylesheet" href="/themes/userweb/css/theme-blog.css">
  		<link rel="stylesheet" href="/themes/userweb/css/theme-shop.css">
  		<link rel="stylesheet" href="/themes/userweb/css/theme-animate.css">

  		<!-- Current Page CSS -->
  		<link rel="stylesheet" href="/themes/userweb/vendor/rs-plugin/css/settings.css" media="screen">
  		<link rel="stylesheet" href="/themes/userweb/vendor/circle-flip-slideshow/css/component.css" media="screen">

  		<!-- Responsive CSS -->
  		<link rel="stylesheet" href="/themes/userweb/css/theme-responsive.css" />

  		<!-- Skin CSS -->
  		<link rel="stylesheet" href="/themes/userweb/css/skins/default.css">

  		<!-- Custom CSS -->
  		<link rel="stylesheet" href="/themes/userweb/css/custom.css">

  		<!-- Head Libs -->
  		<script src="/themes/userweb/vendor/modernizr.js"></script>

      <!-- Self Custom CSS -->
      <link rel="stylesheet" href="/assets/userweb/stylesheets/style.css">

      <!-- MetisMenu CSS -->
      <!-- <link href="/themes/userweb/metis/css/metisMenu/metisMenu.min.css" rel="stylesheet"> -->
      
      <!-- Custom CSS -->
      <!-- <link href="/themes/userweb/sb-admin-2/css/sb-admin-2.css" rel="stylesheet"> -->

  		<!--[if IE]>
  			<link rel="stylesheet" href="css/ie.css">
  		<![endif]-->

  		<!--[if lte IE 8]>
  			<script src="vendor/respond.js"></script>
  		<![endif]-->
    @show

    <!--Start of Zopim Live Chat Script-->
      <script type="text/javascript">
      window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
      d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
      _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
      $.src='//v2.zopim.com/?2PH3SzLox0QauTUpI8aSLS4Icl93IbEx';z.t=+new Date;$.
      type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
      </script>
      <!--End of Zopim Live Chat Script-->


      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-55187398-1', 'auto');
        ga('send', 'pageview');

      </script>
	</head>
	<body>
		@section('header')
			@include('layouts.userweb._navigation')
		@show
    
    @yield('body')

		@section('footer')
			@include('layouts.userweb._footer')
		@show


    @section('foot')
  		<!-- Libs -->
  		<script src="/themes/userweb/vendor/jquery.js"></script>
  		<script src="/themes/userweb/vendor/jquery.appear.js"></script>
  		<script src="/themes/userweb/vendor/jquery.easing.js"></script>
  		<script src="/themes/userweb/vendor/jquery.cookie.js"></script>
  		<script src="/themes/userweb/vendor/bootstrap/js/bootstrap.js"></script>
  		<script src="/themes/userweb/vendor/jquery.validate.js"></script>
  		<script src="/themes/userweb/vendor/jquery.stellar.js"></script>
  		<script src="/themes/userweb/vendor/jquery.knob.js"></script>
  		<script src="/themes/userweb/vendor/jquery.gmap.js"></script>
  		<script src="/themes/userweb/vendor/twitterjs/twitter.js"></script>
  		<script src="/themes/userweb/vendor/isotope/jquery.isotope.js"></script>
  		<script src="/themes/userweb/vendor/owl-carousel/owl.carousel.js"></script>
  		<script src="/themes/userweb/vendor/jflickrfeed/jflickrfeed.js"></script>
  		<script src="/themes/userweb/vendor/magnific-popup/magnific-popup.js"></script>
  		<script src="/themes/userweb/vendor/mediaelement/mediaelement-and-player.js"></script>

  		<!-- Theme Initializer -->
  		<script src="/themes/userweb/js/theme.plugins.js"></script>
  		<script src="/themes/userweb/js/theme.js"></script>

  		<!-- Current Page JS -->
  		<script src="/themes/userweb/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
  		<script src="/themes/userweb/vendor/rs-plugin/js/jquery.themepunch.revolution.js"></script>
  		<script src="/themes/userweb/vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
  		<script src="/themes/userweb/js/views/view.home.js"></script>

  		<!-- Custom JS -->
  		<script src="/themes/userweb/js/custom.js"></script>

      <!-- Metis Menu Plugin JavaScript -->
      <script src="/themes/userweb/metis/js/metisMenu/metisMenu.min.js"></script>

      <!-- Custom Theme JavaScript -->
      <script src="/themes/userweb/sb-admin-2/js/sb-admin-2.js"></script>

  		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
  		<script type="text/javascript">

  			var _gaq = _gaq || [];
  			_gaq.push(['_setAccount', 'UA-12345678-1']);
  			_gaq.push(['_trackPageview']);

  			(function() {
  			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  			})();

  		</script>
  		 -->
     @show
     {{ HTML::script('assets/userweb/javascripts/application.js') }}
	</body>
</html>
