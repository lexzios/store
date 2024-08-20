@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="fa fa-envelope"></i>
              </div>
              <h5>Show Testimonial</h5>
            </header>
            <div class="body">
              @if(isset($testimonial))
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Name:</strong>
                  </div>
                  <div class="col-lg-10">
                    {{$testimonial->name}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Email:</strong>
                  </div>
                  <div class="col-lg-10">
                    {{$testimonial->email}}
                  </div>
                </div>
                <br/>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Country:</strong>
                  </div>
                  <div class="col-lg-10">
                    {{$testimonial->country}}
                  </div>
                </div>
                <br/><br/>
                <div class="row">
                  <div class="col-lg-2">
                    <strong>Testimonial:</strong>
                  </div>
                  <div class="col-lg-10">
                    <p class="newline">{{$testimonial->testimonial}}</p>
                  </div>
                </div>
                <br/><br/>
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/testimonials">Back to Testimonial List</a>
                </div>
              </div>
              @endif
            </div>
          </div> <!-- box inverse -->
        </div>
      </div>
    </div>
  </div>
</div>
@stop

