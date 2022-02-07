<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row" style="padding-bottom:15px;">
          <div class="col-sm-6">
              <h4 class="card-title text-primary">Reservation requests</h4>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            @if(!$reservations->isEmpty())
              <button type="button" class="btn btn-inverse-danger btn-fw">Delete Selected</button>
            @endif
          </div>
        </div>
        @if(!$reservations->isEmpty())
        <div class="table-responsive table-condensed">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Select</th>
                <th>Sales person name</th>
                <th>Status</th>
                <th>Requested at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reservations as $reservation)
                <tr>
                    <td>
                        <input type="checkbox" style="padding:0px;margin-left:10px;margin-top:-6px;" class="form-check-input" id="exampleCheck1">
                    </td>
                    <td>{{$reservation->agent->name}}</td>
                    <td>{{$reservation->status}}</td>
                    <td>{{$reservation->created_at}}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-outline-success">Approve</button>
                          <button type="button" class="btn btn-outline-danger">Decline</button>
                      </div>  
                    </td>
                </tr>
              @endforeach              
            </tbody>
          </table>
        </div>
        @else
          <div class="text-center">
              <h6 class="text-danger">No reservation request are made yet.</h6>
          </div>
        @endif
      </div>
    </div>
  </div>