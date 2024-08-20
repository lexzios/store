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
                <i class="fa fa-plus-square-o"></i>
              </div>
              <h5>Distributor CSV Upload</h5>
            </header>
            <div class="body">	
      				{{ Form::open(array('action' => array('admin\DistributorController@createCSV'), 'files'=>true, 'class' => 'form-horizontal')) }}
      					@include('layouts.admin._csv_form', array('errors' => $errors))
      				{{ Form::close() }}
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/distributor">Cancel</a>
                </div>
              </div>
            </div>

          </div><!-- Box Inverse -->
        </div>
      </div>
    </div>
  </div>
</div>
@stop
