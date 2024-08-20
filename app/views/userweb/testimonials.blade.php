@extends('layouts.userweb.application')

@section('body')
<section class="page-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Testimonials</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2>Testimonials</h2>
        </div>
      </div>
    </div>
</section>
<div class = "col-md-10" style="margin-bottom:100px">
  <div class="col-md-6 col-md-offset-3">
    <h2 class="short"><strong>Testimonial</strong></h2>

      @if($errors->any())
        @if($errors->all()[0] == '0')
          <div class="alert alert-success" id="contactSuccess">
            <strong>Success!</strong> Your testimonial has been post to us.
          </div>
        @else
          <div class="alert alert-danger" id="contactError">
            <strong>Error!</strong>
            {{ implode('', $errors->all('<li>:message</li>')) }}
          </div>
        @endif
      @endif

      <form id="contactForm" action="/testimonials" method="POST">
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
              <label>Country *</label>
              <input type="text" value="" data-msg-required="Please enter your country." maxlength="100" class="form-control" name="country" id="country">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <div class="col-md-12">
              <label>Testimonial *</label>
              <textarea maxlength="5000" data-msg-required="Please enter your testimonial." rows="10" class="form-control" name="testimonial" id="testimonial"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <input type="submit" value="Post" class="btn btn-primary btn-lg" data-loading-text="Loading...">
          </div>
        </div>
      </form>
    </div>
</div>

<!-- <div class="col-md-12" style="margin-bottom:100px">
  <div class="post-comments clearfix col-md-8">
    <h2>Testimonials</h2>
    <ul class="comments">
      <li>
        <div class="comment">
          <div class="img-thumbnail">
            <img class="avatar" alt="" src="assets/userweb/images/default-avatar.png">
          </div>
          <div class="comment-block">
            <div class="comment-arrow"></div>
            <span class="comment-by">
              <strong>Gerwin</strong>
            </span>
            <p>Saya baru pertama kali order di Central PC. pokoknya pelayan oke d(^^)b makasih Central PC.</p>
            <span class="date pull-right">January 12, 2013 at 1:38 pm</span>
          </div>
        </div>
      </li>
      <li>
        <div class="comment">
          <div class="img-thumbnail">
            <img class="avatar" alt="" src="assets/userweb/images/default-avatar.png">
          </div>
          <div class="comment-block">
            <div class="comment-arrow"></div>
            <span class="comment-by">
              <strong>anake_bupati</strong>
            </span>
            <p>barang dah nyampe paking rapihh sweeeep esok order lagi gannnnnnn.</p>
            <span class="date pull-right">January 12, 2013 at 1:38 pm</span>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div> -->




@stop
