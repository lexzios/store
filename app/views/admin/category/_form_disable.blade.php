<div class="form-group">
  {{ Form::label('category[parent_id]', 'Root', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('category[parent_id]', $categories, $category->parent_id, array(
    'class' => 'form-control', 'data-placeholder' => 'Enter Root Name',
    'disabled'
    )) }}
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
      'disabled'
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
    'disabled'
    )) }} *auto generate
  </div>
</div>
<div class="form-group">
  {{ Form::label('category[sorting_id]', 'Insert Before', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('category[sorting_id]', $parent_categories, $category->sorting_id-1, array(
    'class' => 'form-control', 'data-placeholder' => 'Enter Position',
    'disabled')) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('category[description]', 'Category Description', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-5">
    {{ Form::textarea('category[description]', $category->description, array(
      'class' => 'form-control',
      'placeholder' => 'Enter description',
      'rows' => '5',
      'disabled'
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('category[file_path]', 'List Harga', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-5">
    @if(isset($category->file_path) && $category->file_path != "")
      {{$category->file_path}}
    @else
        -
    @endif
  </div>
</div>
  
<div class="form-group">
  <br/><br/><br/>
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
      'placeholder' => '-',
    'disabled',
      'rows' => '5'
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('category[description_seo]', 'Description SEO', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('category[description_seo]', $category->description_seo, array(
      'class' => 'form-control',
      'placeholder' => '-',
    'disabled',
      'rows' => '5'
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('category[keyword_seo]', 'Keyword SEO', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('category[keyword_seo]', $category->keyword_seo, array(
      'class' => 'form-control',
      'placeholder' => '-',
    'disabled',
      'rows' => '5'
    )) }}
  </div>
</div>
