<div class="row">
  <div class="col-md-3 col-sm-6 grid-margin stretch-card" style="height:100px;">
    <div class="card">
      <div class="card-body" style="padding-top:15px;height:100px;">
        <h4 class="card-title">Total Customers</h4>
        <div class="media">
          <i class="mdi mdi-account-multiple icon-md text-info d-flex align-self-start mr-3"></i>
          <div class="media-body">
            <h2 class="card-text text-info" style="margin-top:3px;">{{$allCuscount}}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 grid-margin stretch-card" style="height:100px;" id="activeCus">
    <div class="card">
      <div class="card-body" style="padding-top:15px;height:100px;">
        <h4 class="card-title">Active Customers</h4>
        <div class="media">
          <i class="mdi mdi-account-check icon-md text-success d-flex align-self-center mr-3"></i>
          <div class="media-body">
            <h2 class="card-text text-success" style="margin-top:3px;">{{$acCount}}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 grid-margin stretch-card" style="height:100px;cursor:pointer" id="disabledCus">
    <div class="card">
      <div class="card-body" style="padding-top:15px;height:100px;">
        <h4 class="card-title">Disabled Customers</h4>
        <div class="media">
          <i class="mdi mdi-account-remove icon-md text-danger d-flex align-self-end mr-3"></i>
          <div class="media-body">
            <h2 class="card-text text-danger" style="margin-top:3px;">{{$dcCount}}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 grid-margin stretch-card" style="height:100px;">
    <div class="card">
      <div class="card-body" style="padding-top:15px;height:100px;">
        <h4 class="card-title">New Customers</h4>
        <div class="media">
          <i class="mdi mdi-account-star icon-md text-warning d-flex align-self-end mr-3"></i>
          <div class="media-body">
            <h2 class="card-text text-warning" style="margin-top:3px;">{{$newCusCount}}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary text-primary">New customers ({{$newCusCount}})</h4>
              </div>
              @if(!$newCustomers->isEmpty())
                <div class="col-sm-4">
                  <input type="number" placeholder="Search contact" class="form-control form-control-sm" style="border-radius:5px;"/>
                </div>
                <div class="col-sm-4" style="text-align:right;">
                <button type="button" class="btn btn-inverse-primary btn-fw">Export data</button>
                </div>
              @endif
              
        </div>
        @if(!$newCustomers->isEmpty())
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
              @foreach($newCustomers as $customer)
                <tr>
                  <td>{{$customer->phone}}</td>
                  @if($customer->group != null)
                  <td><span class="badge badge-info">{{$customer->group->name}}</span></td>
                  @else
                  <td><span class="badge badge-warning">Not grouped</span></td>
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
        @else
        <div class="text-center" style="margin-top:30px;">
          <h5 class="text-danger">There are no new customers</ht>
        </div>
        @endif
        <div style="margin-top:20px;">
            {!! $newCustomers->links() !!}
            </div>
      </div>
    </div>
</div>
</div>


<!-- script to display all active customers table -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function activeCustomers(){
            $.ajax({
              url:'{{route('customers')}}',
                cache:false,
                method:'GET',
                beforeSend: function()
                {  
                    $("#loading-overlay").show();
                },
                success:function(data){
                    $('#odda').empty();
                    $('#odda').append(data);
                    $("#loading-overlay").hide();
                }
            });
        }

        $('#activeCus').on('click',function(){
            activeCustomers();
        });
    });
</script>
<!-- script to load disabled customers page page -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function disabledCustomers(){
            $.ajax({
              url:'{{route('disabledCustomers')}}',
                cache:false,
                method:'GET',
                beforeSend: function()
                {  
                    $("#loading-overlay").show();
                },
                success:function(data){
                    $('#odda').empty();
                    $('#odda').append(data);
                    $("#loading-overlay").hide();
                }
            });
        }

        $('#disabledCus').on('click',function(){
            disabledCustomers();
        });
    });
</script>
