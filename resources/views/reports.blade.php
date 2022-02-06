<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row" style="padding-bottom:15px;">
          <div class="col-sm-6">
              <h4 class="card-title text-primary">Active leads</h4>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            @if(!$leads->isEmpty())
              <button type="button" class="btn btn-inverse-danger btn-fw">Delete Selected</button>
            @endif
          </div>
        </div>
        @if(!$leads->isEmpty())
        <div class="table-responsive table-condensed">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Select</th>
                <th>Prospect name</th>
                <th>Prospect phone</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($leads as $lead)
                <tr>
                    <td>
                        <input type="checkbox" style="padding:0px;margin-left:10px;margin-top:-6px;" class="form-check-input" id="exampleCheck1">
                    </td>
                    <td>{{$lead->prospect_name}}</td>
                    <td>{{$lead->prospect_phone}}</td>
                    <td>{{$lead->status}}</td>
                    <td>{{$lead->progress}}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-outline-secondary">Update</button>
                          <button type="button" class="btn btn-outline-secondary">Delete</button>
                      </div>  
                    </td>
                </tr>
              @endforeach              
            </tbody>
          </table>
        </div>
        @else
          <div class="text-center">
              <h6 class="text-danger">No active lead</h6>
          </div>
        @endif
      </div>
    </div>
  </div>