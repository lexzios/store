@if( isset($conversion->errors) && $conversion->errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>{{ count($conversion->errors->all()) }} errors prohibited this conversion from being saved:</h4>

    <ul>
      {{ implode('', $conversion->errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif

<div class="form-group">
  {{ Form::label('conversion[from_currency_code]', 'From', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('conversion[from_currency_code]', $currency, $conversion->from_currency_code, array(
    'class' => 'form-control', 'data-placeholder' => 'Enter Conversion From')) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('conversion[to_currency_code]', 'To', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::select('conversion[to_currency_code]', $currency, $conversion->to_currency_code, array(
    'class' => 'form-control', 'data-placeholder' => 'Enter Conversion To')) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('conversion[rate]', 'Rate', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('conversion[rate]', $conversion->rate, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Conversion Rate'
    )) }}
  </div>
</div>

<div class="form-group">
  <div class="col-lg-4"></div>
  <div class="col-lg-3">
    {{ Form::submit('Submit', array('class' => 'btn btn-default')); }}
  </div>
</div>
