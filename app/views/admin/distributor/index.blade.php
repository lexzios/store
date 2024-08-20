@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12" style="margin:10px">
          <a href="/admin/distributor/new">
            <div class="icons" style="float:left">
              <i class="fa fa-plus"></i>
            </div>
            &nbsp New Distributor
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-10">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="glyphicon glyphicon-search"></i>
              </div>
              <h5>Search Distributor</h5>
            </header>
            <div class="body">
              {{ Form::open(array('action' => 'admin\DistributorController@search', 'class' => 'form-horizontal')) }}
                <?php
                  if(!isset($search))
                  {
                    $search = "";
                  }
                ?>
                @include('admin.distributor._form_search', array('search', $search))
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="fa fa-list"></i>
              </div>
              <h5>Listing Distributor</h5>
            </header>
            <div class="body">
              <table class="table">
              <thead>
                <tr>
                  <th>Distributor Name</th>
                  <th>Distributor Address</th>
                  <th colspan="3"></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($distributors[0]))
                  @foreach($distributors as $distributor)
                    <tr>
                      <td>{{$distributor->name}}</td>
                      <td>
                        @if(isset($distributor->address))
                          {{$distributor->address}}
                        @else
                          -
                        @endif
                      </td>
                      <td><a href="/admin/distributor/{{$distributor->id}}/product">show</a></td>
                      <td><a href="/admin/distributor/{{$distributor->id}}/edit">Edit</a></td>
                      <td>
                        {{ Form::open(array('action' => array('admin\DistributorController@destroy', $distributor->id), 'method' => 'delete')) }}
                          {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                        {{ Form::close() }}
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="4">No Result</td>
                  </tr>
                @endif
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> <!-- body -->
    </div>
  </div>
</div>
@stop
