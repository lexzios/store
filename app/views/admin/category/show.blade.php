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
                <i class="fa fa-user"></i>
              </div>
              <h5>Show Category</h5>
            </header>
            <div class="body">
              <div class="form-horizontal">

                @include('admin.category._form_disable', array('category' => $category, 'categories' => $categories, 'parent_categories' => $parent_categories))
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/category/{{$category->id}}/edit">Edit</a> |
                  <a href="/admin/category">Back To Category List</a>
                  {{ Form::open(array('action' => array('admin\CategoryController@destroy', $category->id), 'method' => 'delete', 'class' => 'form-horizontal')) }}
                          {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

