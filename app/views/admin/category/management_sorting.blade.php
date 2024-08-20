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
              <h5>Sorting Category</h5>
            </header>
            <div class="body">
                @if(isset($categories[0]))
                  <ol class="nav sortable">
                    @foreach($categories as $category)
                      <a href="/admin/category/management-sorting-category/{{$category->id}}" class="a-sorting-list">
                      <li class="blue-border sorting-list" id="{{$category->id }}">
                          <div>
                            <i class="glyphicon glyphicon-sort custom-font-glyphicon"></i>
                            <span class="link-title">&nbsp;{{ $category->name }}</span>
                          </div>
                        </li>
                    </a>
                    @endforeach
                  </ol>
                @else
                  No Result
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
