@include('/modals/createGroupModal')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Customers group</h4>
              </div>
              <div class="col-sm-4">
              @if(!$groups->isempty())
                <input type="text" placeholder="Search group" class="form-control form-control-sm" style="border-radius:5px;"/>
              @endif
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="createGroup">New group</button>
              </div>
        </div>
        @if(!$groups->isEmpty())
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
              @foreach($groups as $group)
              <tr>
                <td class="py-1">
                  <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> 
                </td>
                <td> {{$group->name}} </td>
                <td>{{$group->customers_count}}</td>
                <td>{{ Carbon\Carbon::parse($group->created_at)->format('D, M d, Y h:i A') }}</td>
                <td>{{ Carbon\Carbon::parse($group->updated_at)->format('D, M d, Y h:i A') }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Export</button>
                        <button type="button" class="btn btn-outline-secondary">Edit</button>
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
          <h5 class="text-danger">No customer group created yet</ht>
        </div>
        @endif
      </div>
    </div>
  </div>

  <!-- script to create group -->




<script>
    $(document).ready(function(){
       // show create contact modal
       $('#createGroup').click(function(event){
          event.preventDefault();
          $('#createGroupModal').modal('show');
      });
      $('#createGroupForm').one('submit', function(event){
          event.preventDefault();
          if($('#createGroupBtn').val() == 'Create'){
              $.ajax({
                  url:"{{ route('storeGroup') }}",
                  method:"POST",
                  data: new FormData(this),
                  contentType:false,
                  cache:false,
                  processData:false,
                  dataType:'json',
                  beforeSend: function()
                  {
                      $('#createGroupBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                  },
                  success:function(data){
                      var html = '';
                      if(data.errors){
                          html = '<div class="alert alert-danger alert-block" style="height:30px;padding:2px;">';
                          for(var count = 0; count<data.errors.length; count++){
                              html += '<p>' + data.errors[count] + '</p>';
                          }
                          html += '</div>';
                          $('#createGroupBtn').html('Create'); 
                          // render error or success message in html variable to span element with id value form_result
                          $('#create_group_form_result').html(html);
                      }
                      if(data.success){
                          $('#create_group_form_result').html('');
                          $('#createGroupForm')[0].reset();
                          $('#createGroupBtn').html('Create'); 
                          $('#createGroupModal').modal('hide');
                          setTimeout(function() { odda(); }, 500);
                          function odda(){
                            $.ajax({
                              url:'{{route('targets')}}',
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
                      }
                  }
              })
          }
      });
    });
</script>
