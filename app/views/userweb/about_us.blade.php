@extends('layouts.userweb.application')

@section('body')
<section class="page-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">About Us</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2>About Us</h2>
        </div>
      </div>
    </div>
</section>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3><strong>Who</strong> We Are</h3>
      <p>Central PC berlokasi di pusat elektronik Harco Mangga Dua. Kami senantiasa memberikan <a href="/">product</a> serta pelayanan yang terbaik bagi Anda.</p>
      <p>Saran dan Kritik yang membangun sangat kami harapkan sebagai usaha meningkatkan <span class="alternative-font">pelayanan</span>  kami. Buka Toko setiap hari Senin – Sabtu pukul 10.00 – 18.30</p>
    </div>
    <!-- <div class="col-md-4">
      <div class="featured-box featured-box-secundary">
        <div class="box-content">
          <h4>Behind the scenes</h4>
          <img src="http://www.tokocentralpc.com/wp-content/uploads/2012/12/620x320xcentralpc11.jpg.pagespeed.ic.fOb23_mwmd.jpg" style="width:100%">
        </div>
      </div>
    </div> -->
  </div>
  <hr class="tall">
  <div class="row">
    <div class="col-md-6">
      @if($errors->any())
        <div class="alert alert-danger" id="contactError">
          <strong>Error!</strong>
          {{ implode('', $errors->all('<li>:message</li>')) }}
        </div>
      @endif
      @if(isset($error_code))
        @if($error_code == 0)
          <div class="alert alert-success" id="contactSuccess">
            <strong>Success!</strong> Your message has been sent to us.
          </div>
        @else
          <div class="alert alert-danger" id="contactError">
            <strong>Error!</strong> There was an error sending your message.
          </div>
        @endif
      @endif


      <h2 class="short"><strong>Contact</strong> Us</h2>
      <form id="contactForm" action="/about-us" method="POST">
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
              <label>Subject</label>
              <input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <div class="col-md-12">
              <label>Message *</label>
              <textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <input type="submit" value="Send Message" class="btn btn-primary btn-lg" data-loading-text="Loading...">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-6">

      <h4 class="push-top">Get in <strong>touch</strong></h4>
      <p>Untuk informasi lebih lanjut anda dapat menghubungi kami melalui nomor telepon, messenger atau anda dapat langsung mengunjungi toko kami.</p>

      <hr />

      <h4>The <strong>Office</strong></h4>
      <ul class="list-unstyled">
        <li><i class="icon icon-map-marker"></i> <strong>Address:</strong> Plaza Harco Mangga Dua Lt. 3 Blok B No.49D</br>Jl. Arteri Mangga Dua Raya Jakarta - 10730</li>
        <li><i class="icon icon-phone"></i> <strong>Phone:</strong> (0851) 0120 2123, (0851) 0770 9278<br/> (021) 612 1193, (021) 612 1197</li>
        <li><i></i> <strong>Fax:</strong> (021) 612-1197</li>
        <li><i></i> <strong>Pin BB:</strong> 5727189F</li>
        <li><i class="icon icon-envelope"></i> <strong>Email 1:</strong> <a href="mailto:support@tokocentralpc.com">support@tokocentralpc.com</a></li>
        <li><i class="icon icon-envelope"></i> <strong>Email 2:</strong> <a href="mailto:tokocentralpc@gmail.com">tokocentralpc@gmail.com</a></li>

      </ul>
      <hr />

      <h4>Business <strong>Hours</strong></h4>
      <ul class="list-unstyled">
        <li><i class="icon icon-time"></i> Senin - Sabtu 10.00 - 18.30</li>
        <li><i class="icon icon-time"></i> Minggu - Tutup</li>
      </ul>

    </div>
  </div>
  <hr class="tall">

</div>


@stop
