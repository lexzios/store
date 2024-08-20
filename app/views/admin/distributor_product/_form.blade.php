@if( isset($distributorProduct->errors) && $distributorProduct->errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>{{ count($distributorProduct->errors->all()) }} errors prohibited this distributor product from being saved:</h4>

    <ul>
      {{ implode('', $distributorProduct->errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif
@if( isset($errors) && $errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>errors prohibited this distributor product from being saved:</h4>

    <ul>
      {{ implode('', $errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif

<?php
  if(isset($distributorProduct->product_id)) 
  {
    $productSelected = $distributorProduct->product_id;
  }
  else
  {
    $productSelected = 0;
  }

?>


{{ Form::text('distributorProduct[distributor_id]', $room_id, array(
      'class' => 'form-control hidden'
    )) }}
<div class="form-group">
  {{ Form::label('distributorProduct[name]', 'Product Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('distributorProduct[name]', $distributorProduct->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter distributor product name'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('distributorProduct[product_id]', 'Product Id', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('distributorProduct[product_id]', $products, $productSelected, array(
    'class' => 'form-control chzn-select',
    'data-placeholder' => 'Enter Product Id',
    'placeholder' => 'Choose a Product...'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('distributorProduct[currency_code]', 'Currency', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('distributorProduct[currency_code]', $currency, $distributorProduct->currency_code, array(
    'class' => 'form-control', 'data-placeholder' => 'Choose Currency')) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('distributorProduct[distributor_product_price]', 'Product Price', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('distributorProduct[distributor_product_price]', $distributorProduct->distributor_product_price, array(
      'class' => 'form-control',
      'placeholder' => 'Enter distributor product price'
    )) }}
  </div>
</div>

<div class="form-group">
  <div class="col-lg-4"></div>
  <div class="col-lg-3">
    {{ Form::submit('Submit', array('class' => 'btn btn-default')); }}
  </div>
</div>
