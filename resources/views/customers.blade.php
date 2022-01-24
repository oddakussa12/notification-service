<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
      <div class="card-body">
        <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary text-primary">Active customers</h4>
              </div>
              <div class="col-sm-4">
                <input type="number" placeholder="Search contact" class="form-control form-control-sm" style="border-radius:5px;"/>
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-secondary btn-fw">Export data</button>
              </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Contact</th>
                <th>Group</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($customers as $customer)
                <tr>
                  <td>{{$customer->phone}}</td>
                  @if($customer->group != null)
                  <td>{{$customer->group->name}}</td>
                  @else
                  <td><span class="badge badge-danger">Not grouped</span></td>
                  @endif
                  <td><span class="badge badge-success">Active</span></td>
                  <td>{{$customer->created_at}}</td>
                  <td>{{$customer->updated_at}}</td>
                  <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-outline-secondary">View</button>
                          <button type="button" class="btn btn-outline-secondary">Delete</button>
                          <button type="button" class="btn btn-outline-secondary">SMS</button>
                      </div>  
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div style="margin-top:20px;">
            {!! $customers->links() !!}
            </div>
      </div>
    </div>
  </div>