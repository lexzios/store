@extends('layouts.userweb.application')

@section('body')
	<section class="page-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Error 404</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2>Page Not Found</h2>
        </div>
      </div>
    </div>
</section>

<div class="container">
  <div class="row">
  	<h1>Error 404 - Page not found!</h1>
    <strong>The page you trying to reach does not exist, or has been moved.</strong>
  </div>
  <hr class="taller">
</div>
@stop