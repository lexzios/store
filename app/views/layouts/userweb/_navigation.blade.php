<header id="header">
  <div class="container">
    <h1 class="logo">
      <a href="/">
        <img alt="Central PC | Software | Gadget | Computer | Laptop | Notebook | Toko Komputer | Jual Komputer | Harga Komputer" width="368" height="73" data-sticky-width="242" data-sticky-height="48" src="/assets/userweb/images/centralpc_logo.png">
      </a>
    </h1>
    <div class="search">
      <form id="searchForm" action="/product/search/list/" method="get">
        <div class="input-group">
          @if(isset($name))
            <input type="text" class="form-control search" name="name" id="name" value="{{$name}}" placeholder="Search...">
          @else
            <input type="text" class="form-control search" name="name" id="name" placeholder="Search...">
          @endif
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit" id="searchFormSubmit"><i class="icon icon-search"></i></button>
          </span>
        </div>
      </form>
    </div>
    <nav>
      <ul class="nav nav-pills nav-top">
        <li>
          <a href="/about-us"><i class="icon icon-angle-right"></i>About Us</a>
        </li>
        <li>
          <a href="/about-us"><i class="icon icon-angle-right"></i>Contact Us</a>
        </li>
        <li class="phone">
          <span><i class="icon icon-phone"></i>(021) 612 1193</span>
        </li>
      </ul>
    </nav>
    <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
      <i class="icon icon-bars"></i>
    </button>
  </div>
  <div class="navbar-collapse nav-main-collapse collapse">
    <div class="container">
      <ul class="social-icons">
        <li class="facebook"><a href="http://www.facebook.com/TokoCentralPC" target="_blank" title="Facebook">Facebook</a></li>
        <li class="twitter"><a href="http://www.twitter.com/komputerzone" target="_blank" title="Twitter">Twitter</a></li>
        <li class="instagram"><a href="http://instagram.com/central_pc" target="_blank" title="Instagram">Instagram</a></li>
        <li class="kaskus"><a href="http://www.kaskus.co.id/profile/viewallclassified/4983376" target="_blank" title="Kaskus">Kaskus</a></li>
        <li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin">Linkedin</a></li>
      </ul>
      <nav class="nav-main mega-menu">
        <ul class="nav nav-pills nav-main" id="mainMenu">
          @if(Request::segment(1) == NULL || Request::segment(1) == "product")
            <li class = "active">
          @else
            <li>
          @endif
            <a href="/">Product</a>
          </li>
          <li>
            <a href="/blog">Blog</a>
          </li>
          @if(Request::segment(1) == "cara-order")
            <li class = "active">
          @else
            <li>
          @endif
            <a href="/cara-order">Cara Order</a>
          </li>
          @if(Request::segment(1) == "testimonials")
            <li class = "active">
          @else
            <li>
          @endif
            <a href="/testimonials">Testimonial</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>

  <div>
    <div class="container mega-menu-space">
      <nav>
        <a href="javascript:$zopim.livechat.window.show()" target="_blank" class="btn btn-sm chat-with-us">
          click here to chat with Us
        </a> 
        <!-- <span class="arrow hlb hidden-xs hidden-sm hidden-md" data-appear-animation="rotateInUpLeft" style="top:-22px;"> -->
        Retail 1 : <a href="ymsgr:sendIM?marketing_centralpc2"><img src="http://opi.yahoo.com/online?u=marketing_centralpc2&amp;m=g&amp;t=1"></a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        Retail 2 : <a href="ymsgr:sendIM?marketing_centralpc5"><img src="http://opi.yahoo.com/online?u=marketing_centralpc5&amp;m=g&amp;t=1"></a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        Dealer : <a href="ymsgr:sendIM?nia_centralpc"><img src="http://opi.yahoo.com/online?u=nia_centralpc&amp;m=g&amp;t=1"></a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        Corporate : <a href="ymsgr:sendIM?marketing.centralpc"><img src="http://opi.yahoo.com/online?u=marketing.centralpc&amp;m=g&amp;t=1"></a>
      </nav>
  </div>
  </div>
  
</header>
