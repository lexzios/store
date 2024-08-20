<div class="form-group">
  {{ Form::label('conversion[from_currency_code]', 'From', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('conversion[from_currency_code]', $currency, $conversion->from_currency_code, array(
    'class' => 'form-control', 
    'data-placeholder' => 'Enter Conversion From',
    'disabled'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('conversion[to_currency_code]', 'To', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('conversion[to_currency_code]', $currency, $conversion->to_currency_code, array(
    'class' => 'form-control',
    'data-placeholder' => 'Enter Conversion To',
    'disabled'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('conversion[rate]', 'Rate', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('conversion[rate]', $conversion->rate, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Conversion Rate',
    'disabled'
    )) }}
  </div>
</div>

