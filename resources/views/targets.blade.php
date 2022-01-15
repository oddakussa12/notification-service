<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Customers group</h4>
              </div>
              <div class="col-sm-4">
                <input type="text" placeholder="Search group" class="form-control form-control-sm" style="border-radius:5px;"/>
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-secondary btn-fw">New group</button>
              </div>
        </div>
        <div class="table-responsive table-condensed">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> Avatar </th>
                <th> Group name </th>
                <th> Total Customers</th>
                <th> Created at</th>
                <th> Updated at</th>
                <th> Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="py-1">
                  <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> 
                </td>
                <td> Students </td>
                <td>250000 </td>
                <td> Junly, 13, [02:33] </td>
                <td> Junly, 13, [02:56] </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Export</button>
                        <button type="button" class="btn btn-outline-secondary">Edit</button>
                        <button type="button" class="btn btn-outline-secondary">Delete</button>
                        <button type="button" class="btn btn-outline-secondary">SMS</button>
                    </div>  
                </td>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>