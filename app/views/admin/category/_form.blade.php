@if( isset($category->errors) && $category->errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>{{ count($category->errors->all()) }} errors prohibited this category from being saved:</h4>

    <ul>
      {{ implode('', $category->errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif

<div class="form-group">
  {{ Form::label('category[parent_id]', 'Root', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('category[parent_id]', $categories, $category->parent_id, array(
    'class' => 'form-control', 'data-placeholder' => 'Enter Root Name',
    'onchange'=>'chooseParentCategoryOnChanged(this.value)')) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('category[name]', 'Category name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('category[name]', $category->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Category Name',
      'onkeyup'=>'productNameTextOnChange(this.value)',
      'id' => 'product_name'
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('category[permalink]', 'Category Permalink', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('category[permalink]', $category->permalink, array(
      'class' => 'form-control',
      'placeholder' => 'Enter permalink',
      'id' => 'product_permalink'
    )) }} *auto generate
  </div>
</div>

@if($category->parent_id != 0)
  <div id="chooseSortCategory" class="form-group" style="display:none">
    {{ Form::label('category[sorting_id]', 'Insert Before', array(
      'class' => 'control-label col-lg-4'
    )) }}
    <div class="col-lg-3">
      {{ Form::select('category[sorting_id]', $parent_categories, $category->sorting_id, array(
      'class' => 'form-control', 'data-placeholder' => 'Enter Position')) }}
    </div>
  </div>
@else
  <div id="chooseSortCategory" class="form-group" style="display:block">
    {{ Form::label('category[sorting_id]', 'Insert Before', array(
      'class' => 'control-label col-lg-4'
    )) }}
    <div class="col-lg-3">
      {{ Form::select('category[sorting_id]', $parent_categories, $category->sorting_id-1, array(
      'class' => 'form-control', 'data-placeholder' => 'Enter Position')) }}
    </div>
  </div>
@endif
<div class="form-group">
  {{ Form::label('category[description]', 'Category Description', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-5">
    {{ Form::textarea('category[description]', $category->description, array(
      'class' => 'form-control tinymce',
      'placeholder' => 'Enter description',
      'rows' => '5'
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('category[file_path]', 'List Harga', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::file('category[file_path]', array(
      'class' => 'form-control'
    )) }}
  </div>
</div>

<div class="form-group">
  <br/>
  {{ Form::label('category[seo]', 'FOR SEO', array(
    'class' => 'control-label col-lg-10',
    'style' => 'text-align:center'
  )) }}
</div>

<div class="form-group">
  {{ Form::label('category[title_seo]', 'Title SEO', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('category[title_seo]', $category->title_seo, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Title for SEO',
      'rows' => '5'
    )) }}*optional
  </div>
</div>
<div class="form-group">
  {{ Form::label('category[description_seo]', 'Description SEO', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('category[description_seo]', $category->description_seo, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Description for SEO',
      'rows' => '5'
    )) }}*optional
  </div>
</div>
<div class="form-group">
  {{ Form::label('category[keyword_seo]', 'Keyword SEO', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('category[keyword_seo]', $category->keyword_seo, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Keywords for SEO',
      'rows' => '5'
    )) }}*optional
  </div>
</div>


<div class="form-group">
  <div class="col-lg-4"></div>
  <div class="col-lg-3">
    {{ Form::submit('Submit', array('class' => 'btn btn-default')); }}
  </div>
</div>
