@extends('layouts.userweb.application')

@section('body')
	<section class="page-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Error 503</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2>Page Under Maintenance</h2>
        </div>
      </div>
    </div>
</section>

<div class="container">
  <div class="row">
  	<h1>Error 503 - Page under Maintenance!</h1>
    <strong>The page you trying to reach is currently undergoing maintenance. Better things are coming. Stay tuned for more information.</strong>
  </div>
  <hr class="taller">
</div>
@stop