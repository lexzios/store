@if( isset($product->errors) && $product->errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>{{ count($product->errors->all()) }} errors prohibited this product from being saved:</h4>

    <ul>
      {{ implode('', $product->errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif

<?php
  if(isset($product->product_category_id)) 
  {
    $category_id = $product->product_category_id;
  }
  else
  {
    $category_id = 0;
  }
  if(isset($product->formula_id)) 
  {
    $formula_id = $product->formula_id;
  }
  else
  {
    $formula_id = 0;
  }
?>

<div class="form-group">
  {{ Form::label('product[product_category_id]', 'Product Category', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('product[product_category_id]', $category, $category_id, array(
    'class' => 'form-control', 'data-placeholder' => 'Enter Product Category')) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('product[name]', 'Product Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('product[name]', $product->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter product name',
      'onkeyup'=>'productNameTextOnChange(this.value)',
      'id' => 'product_name',
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('product[permalink]', 'Permalink', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('product[permalink]', $product->permalink, array(
      'class' => 'form-control',
      'placeholder' => 'Enter permalink',
      'id' => 'product_permalink'
    )) }} *auto generate
  </div>
</div>
<div class="form-group">
  {{ Form::label('product[currency_code]', 'Currency', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('product[currency_code]', $currency, $product->currency_code, array(
    'class' => 'form-control', 'data-placeholder' => 'Choose Currency')) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('product[formula_id]', 'Formula', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('product[formula_id]', $markup, $formula_id, array(
    'class' => 'form-control', 'data-placeholder' => 'Choose Formula')) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('product[base_price]', 'Base Price', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('product[base_price]', $product->base_price, array(
      'class' => 'form-control',
      'placeholder' => 'Enter base price'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('product[is_sale]', 'On Sale', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ 
      Form::checkbox('product[is_sale]', '1', $product->is_sale)
    }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('product[is_in_editor_pick]', 'Editor Pick', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ 
      Form::checkbox('product[is_in_editor_pick]', '1', $product->is_in_editor_pick)
    }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('product[streak_price]', 'Streak Price', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('product[streak_price]', $product->streak_price, array(
      'class' => 'form-control',
      'placeholder' => 'Enter streak price'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('product[is_call_for_best_price]', 'Call For Best Price', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ 
      Form::checkbox('product[is_call_for_best_price]', '1', $product->is_call_for_best_price)
    }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('product[short_description]', 'Short Description', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('product[short_description]', $product->short_description, array(
      'class' => 'form-control tinymce',
      'placeholder' => 'Enter short description',
      'rows' => '3'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('product[long_description]', 'Long Description', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('product[long_description]', $product->long_description, array(
      'class' => 'form-control tinymce',
      'placeholder' => 'Enter long description',
      'rows' => '5'
    )) }}
  </div>
</div>

<div class="form-group">
  <br/>
  {{ Form::label('product[seo]', 'FOR SEO', array(
    'class' => 'control-label col-lg-10',
    'style' => 'text-align:center'
  )) }}
</div>

<div class="form-group">
  {{ Form::label('product[title_seo]', 'Title SEO', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('product[title_seo]', $product->title_seo, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Title for SEO',
      'rows' => '5'
    )) }}*optional
  </div>
</div>
<div class="form-group">
  {{ Form::label('product[description_seo]', 'Description SEO', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('product[description_seo]', $product->description_seo, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Description for SEO',
      'rows' => '5'
    )) }}*optional
  </div>
</div>
<div class="form-group">
  {{ Form::label('product[keyword_seo]', 'Keyword SEO', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-6">
    {{ Form::textarea('product[keyword_seo]', $product->keyword_seo, array(
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
