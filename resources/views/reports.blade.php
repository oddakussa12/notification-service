<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row" style="padding-bottom:15px;">
          <div class="col-sm-6">
              <h4 class="card-title text-primary">SMS Broadcast History</h4>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            @if(!$job_batches->isEmpty())
              <button type="button" class="btn btn-inverse-danger btn-fw">Delete Selected</button>
            @endif
          </div>
        </div>
        @if(!$job_batches->isEmpty())
        <div class="table-responsive table-condensed">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Select</th>
                <th>Task name</th>
                <th>Total</th>
                <th>Pending</th>
                <th>Failed</th>
                <th>Created at</th>
                <th>Finished at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($job_batches as $job_batch)
                <tr>
                    <td>
                        <input type="checkbox" style="padding:0px;margin-left:10px;margin-top:-6px;" class="form-check-input" id="exampleCheck1">
                    </td>
                    <td>{{$job_batch->name}}</td>
                    <td>{{$job_batch->total_jobs}}</td>
                    <td>{{$job_batch->pending_jobs}}</td>
                    <td>{{$job_batch->failed_jobs}}</td>
                    <td> {{ Carbon\Carbon::parse($job_batch->created_at)->format('D, M d, Y h:i A') }}</td>
                    <td> {{ Carbon\Carbon::parse($job_batch->finished_at)->format('D, M d, Y h:i A') }}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-outline-secondary">Content</button>
                          <button type="button" class="btn btn-outline-secondary">Resend</button>
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
              <h6 class="text-danger">History empty</h6>
          </div>
        @endif
      </div>
    </div>
  </div>