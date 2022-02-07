@include('/modals/updateLead')
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
                <th>id</th>
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
                    <td>{{$lead->id}} </td>
                    <td>{{$lead->progress}}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-outline-secondary edit-lead">Update</button>
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


  <!-- script when update button is clicked on update lead modal-->
<script>
    $(document).ready(function(){
        $('#createSite').click(function(){
          $('#createSiteModal').modal('show');
        });
        $('#addSiteForm').on('submit', function(event){
          event.preventDefault();
          if($('#createSiteBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('storeSite') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createScheduleBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createSiteBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#add_site_form_result').html(html);
                    }
                    if(data.success){
                        $('#createSiteModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('dash')}}',
                                cache: false,
                                type:'GET',
                                beforeSend: function()
                                {  
                                    $("#loading-overlay").show();
                                },
                                success:function(data){
                                    $("#odda").html(data);
                                    $("#loading-overlay").hide();
                                }
                            });
                        }
                    }
                },
              })
            }
        });
    });
</script>

{{-- script when update button is clicked from leads table --}}
<script>
    $(document).ready(function(){
        // populate modal data
        $("body").on("click",".edit-lead",function(event){
            event.preventDefault();
            $('#updateLeadModal').modal('show');

            // populate other edit item form fields
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            console.log(data);
            $('#lead_idd').val(data[4]);
            $('#update_name').val(data[1]);
            $('#update_phone').val(data[2]);
            $('#update_status').val(data[3]);

            $('#updateLeadForm').on('submit', function(event){
            event.preventDefault();
            if($('#updateLeadBtn').val() == 'Update'){
                $.ajax({
                  url:"{{ route('updateLead') }}",
                  method:"post",
                  data: new FormData(this),
                  contentType:false,
                  cache:false,
                  processData:false,
                  dataType:'json',
                  beforeSend: function()
                  {
                    console.log("This is before send");
                      $('#createScheduleBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                  },
                  success:function(data){
                      var html = '';
                      if(data.errors){
                          html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                          for(var count = 0; count<data.errors.length; count++){
                              html += '<p>' + data.errors[count] + '</p>';
                          }
                          html += '</div>';
                          $('#updateLeadBtn').html('Update'); 
                          // render error or success message in html variable to span element with id value form_result
                          $('#update_lead_form_result').html(html);
                      }
                      if(data.success){
                          $('#updateLeadModal').modal('hide');
                          setTimeout(function() { odda(); }, 500);
                          function odda(){
                              $.ajax({
                                  url:'{{route('SMSReport')}}',
                                  cache: false,
                                  type:'GET',
                                  beforeSend: function()
                                  {  
                                      $("#loading-overlay").show();
                                  },
                                  success:function(data){
                                      $("#odda").html(data);
                                      $("#loading-overlay").hide();
                                  }
                              });
                          }
                      }
                  },
                })
            }
          });
        });
    });
</script>