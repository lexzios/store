<div class="form-group">
  {{ Form::label('distributor[name]', 'Distributor Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('distributor[name]', $distributor->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter distributor name',
      'disabled'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('distributor[address]', 'Distributor Address', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::textarea('distributor[address]', $distributor->address, array(
      'class' => 'form-control',
      'placeholder' => 'Enter distributor address',
      'rows' => '3',
      'disabled'
    )) }}
  </div>
</div>