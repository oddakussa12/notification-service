{{-- @include('/modals/addEmailTemplate')
@include('/modals/editEmailTemplate')
@include('/modals/deleteModal') --}}
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Admin users</h4>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addEmailTemplate">Add admin</button>
              </div>
        </div>
        <!-- <div class="table-responsive table-condensed"> -->
          <table class="table table-hover">
            <thead>
              <tr>
                {{-- <th> ID </th> --}}
                <th> Name</th>
                <th> Created at</th>
                <th> ACTIOINS</th>
              </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td style="display: none;">{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->created_at}}</td>
                        
                        <td>
                            <a href="#" style="margin-left:10px;font-size:18px;" ><i class="mdi mdi-lead-pencil"></i></a>
                            <a href="#" style="margin-left:10px;font-size:18px;"><i class="mdi mdi-delete text-danger "></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        <!-- </div> -->
      </div>
    </div>
</div>

