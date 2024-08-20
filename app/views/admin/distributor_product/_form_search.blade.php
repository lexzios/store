<div class="form-group">
  <div class="col-lg-6">
    {{ Form::text('search', $search, array(
      'class' => 'form-control',
      'placeholder' => 'Enter distributor product name'
    )) }}
  </div>
  <div class="col-lg-2">
    {{ Form::submit('Search', array('class' => 'btn btn-default')); }}
  </div>
  <div class="col-lg-2">
    {{ Form::submit('Export to CSV', array(
    'class' => 'btn btn-default',
    'name' => 'is_csv'
    ));
  }}
  </div>
  <div class="col-lg-2">
    {{ Form::submit('Import CSV', array(
    'class' => 'btn btn-default',
    'name' => 'is_csv_upload'
    ));
  }}
  </div>
</div>
