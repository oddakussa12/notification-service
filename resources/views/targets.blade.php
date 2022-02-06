@include('/modals/registerAgentModal')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Sales agents</h4>
              </div>
              <div class="col-sm-4">
              @if(!$agents->isempty())
                <input type="text" placeholder="Search agent here" class="form-control form-control-sm" style="border-radius:5px;"/>
              @endif
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="createGroup">Register agent</button>
              </div>
        </div>
        @if(!$agents->isEmpty())
        <div class="table-responsive table-condensed">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> Avatar </th>
                <th> Name</th>
                <th> Phone</th>
                <th> Total leads</th>
                <th> Total deals</th>
                <th> Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($agents as $agent)
              <tr>
                <td class="py-1">
                  <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> 
                </td>
                <td> {{$agent->name}} </td>
                <td> {{$agent->phone}} </td>
                <td>{{$agent->leads_count}}</td>
                <td>{{$agent->leads_count}}</td>
                
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Edit</button>
                        <button type="button" class="btn btn-outline-secondary">Delete</button>
                    </div>  
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center" style="margin-top:30px;">
          <h5 class="text-danger">No agent registered yet</ht>
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
