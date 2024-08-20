@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12" style="margin:10px">
          <a href="/admin/markupfee/new">
            <div class="icons" style="float:left">
              <i class="fa fa-plus"></i>
            </div>
            &nbsp New Formula
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
              <h5>Search Formula</h5>
            </header>
            <div class="body">
              {{ Form::open(array('action' => 'admin\MarkUpFeeController@search', 'class' => 'form-horizontal')) }}
                <?php
                  if(!isset($search))
                  {
                    $search = "";
                  }
                ?>
                @include('admin.markupfee._form_search', array('search', $search))
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
              <h5>Listing Mark Up Fee</h5>
            </header>
            <div class="body">
              <table class="table" style ="text-align:right">
              <thead>
                <tr>
                  <th>Formula</th>
                  <th style ="text-align:center">%</th>
                  <th style ="text-align:right">Rp</th>
                  <th colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($markup[0]))
                  @foreach($markup as $markupfee)
                  <tr>
                    <td  style ="text-align:left">{{ $markupfee->name }}</td>
                    <td style ="text-align:center">{{ (int)$markupfee->float_fee }}</td>
                    <td>{{ $markupfee->fixed_fee }}</td>
                    <td style ="text-align:center"><a href="/admin/markupfee/{{ $markupfee->id }}">Show</a></td>
                    <td style ="text-align:center"><a href="/admin/markupfee/{{ $markupfee->id }}/edit">Edit</a></td>
                    <!-- <td>
                      {{ Form::open(array('action' => array('admin\MarkUpFeeController@destroy', $markupfee->id), 'method' => 'delete')) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                      {{ Form::close() }}
                    </td> -->
                  </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="5" style ="text-align:left">No Result</td>
                  </tr>
                @endif
                
                <!-- <tr>
                  <td>Default</td>
                  <td>5</td>
                  <td>5000</td>
                  <td><a href="/admin/markupfee/1/edit">Edit</a></td>
                  <td>
                    {{ Form::open(array('action' => array('admin\MarkUpFeeController@destroy', 1), 'method' => 'delete')) }}
                      {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                    {{ Form::close() }}
                  </td>
                </tr>
                <tr>
                  <td>Class A</td>
                  <td>10</td>
                  <td>15000</td>
                  <td><a href="/admin/markupfee/1/edit">Edit</a></td>
                  <td>
                    {{ Form::open(array('action' => array('admin\MarkUpFeeController@destroy', 1), 'method' => 'delete')) }}
                      {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                    {{ Form::close() }}
                  </td>
                </tr>
                <tr>
                  <td>Class B</td>
                  <td>7</td>
                  <td>10000</td>
                  <td><a href="/admin/markupfee/1/edit">Edit</a></td>
                  <td>
                    {{ Form::open(array('action' => array('admin\MarkUpFeeController@destroy', 1), 'method' => 'delete')) }}
                      {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                    {{ Form::close() }}
                  </td>
                </tr> -->
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
