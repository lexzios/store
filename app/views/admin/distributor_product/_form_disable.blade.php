<?php
  if(isset($distributorProduct->product_id)) 
  {
    $productSelected = $distributorProduct->product_id;
  }
  else
  {
    $productSelected = 0;
  }
  if(isset($distributorProduct->currency_id)) 
  {
    $currency_id = $distributorProduct->currency_id;
  }
  else
  {
    $currency_id = 0;
  }
?>

<div class="form-group">
  {{ Form::label('distributorProduct[name]', 'Product Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('distributorProduct[name]', $distributorProduct->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter distributor product name',
      'disabled'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('distributorProduct[product_id]', 'Product Id', array(
    'class' => 'control-label col-lg-4'
  )) }}
  @if(isset($distributorProduct->product_id) && $distributorProduct->product_id != 0)
    <div class="col-lg-3">
    {{ Form::select('distributorProduct[product_id]', $products, $productSelected, array(
    'class' => 'form-control', 
    'data-placeholder' => 'Enter Product Id',
      'disabled'
    )) 
  }}
  </div>
  @else
    <div class="col-lg-3">
    {{ Form::select('distributorProduct[product_id]', array('-', '-'), '', array(
    'class' => 'form-control', 
    'data-placeholder' => 'Enter Product Id',
      'disabled'
    )) 
  }}
  </div>
  @endif
</div>

<div class="form-group">
  {{ Form::label('distributorProduct[currency_code]', 'Currency', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('distributorProduct[currency_code]', $currency, $distributorProduct->currency_code, array(
    'class' => 'form-control', 'data-placeholder' => 'Choose Currency',
      'disabled'
    )) 
  }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('distributorProduct[distributor_product_price]', 'Product Price', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('distributorProduct[distributor_product_price]', $distributorProduct->distributor_product_price, array(
      'class' => 'form-control',
      'placeholder' => 'Enter distributor product price',
      'disabled'
    )) }}
  </div>
</div>
