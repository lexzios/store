@extends('layouts.admin.application')

@section('content')
  <div id="content">
    <div class="outer">
      <div class="inner bg-light lter">
        <div class="row">
          <div class="col-lg-8">
            <div class="box">
              <div class="body">
                <table class="table table-condensed table-hovered sortableTable">
                  <header>
                    <div class="icons">
                      <i class="fa fa-list"></i>
                    </div>
                    <h5>Conversion Rates</h5>
                  </header>
                  <thead>
                    <tr>
                      <th>From
                        <i class="fa sort"></i>
                      </th>
                      <th>To
                        <i class="fa sort"></i>
                      </th>
                      <th>Currency
                        <i class="fa sort"></i>
                      </th>
                      <th>Updated at
                        <i class="fa sort"></i>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($conversions[0]))
                      @foreach($conversions as $conversion)
                      <tr class="success">
                        <td>{{$conversion->currency_from->code}}</td>
                        <td>{{$conversion->currency_to->code}}</td>
                        <td>{{ number_format((int)$conversion->rate,2,",",".") }}</td>
                        <td>{{$conversion->updated_at}}</td>
                      </tr>
                      @endforeach
                    @else
                      <tr class="success">
                        <td colspan="4">No Result</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.inner -->
    </div><!-- /.outer -->
  </div><!-- /#content -->
@stop

@section('custom_script')
@parent
<script>
  $(function() {
    Metis.dashboard();
  });
</script>
@overwrite
