<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">All units ({{$totalUnits}})</h4>
              </div>
              <div class="col-sm-4">
              
              </div>
              <div class="col-sm-4" style="text-align:right;">
                @if(!$units->isempty())
                  <input type="text" placeholder="Search unit here" class="form-control form-control-sm" style="border-radius:5px;"/>
                @endif
              </div>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Unit code</th>
                <th>No of Bedrooms</th>
                <th>Direction</th>
                <th>Status</th>
                <th>Site code</th>
                <th>Block code</th>
                <th>Floor level</th>
              </tr>
            </thead>
            <tbody>
              @foreach($units as $unit)
                <tr>
                  <td>{{$unit->unit_code}}</td>
                  <td>{{$unit->bedrooms}}</td>
                  <td>{{$unit->direction}}</td>
                  <td>{{$unit->status}}</td>
                  <td>{{$unit->floor->block->site->site_code}}</td>
                  <td>{{$unit->floor->block->block_code}}</td>
                  <td>{{$unit->floor->level}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
