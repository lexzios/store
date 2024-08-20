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
              <h5>New Category</h5>
            </header>
            <div class="body">
              {{ Form::open(array('action' => 'admin\CategoryController@create', 'files'=>true, 'class' => 'form-horizontal')) }}
                @include('admin.category._form', array('category' => $category, 'categories' => $categories, 'parent_categories' => $parent_categories))
              {{ Form::close() }}
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/category">Cancel</a>
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
