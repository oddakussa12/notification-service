@include('/modals/createSchedule')
<div class="col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row" style="padding-bottom:15px;">
                <div class="col-sm-6">
                    <h4 class="card-title text-primary">Previous schedules</h4>
                </div>
                <div class="col-sm-6" style="text-align:right;">
                    <button type="button" class="btn btn-inverse-danger btn-fw">Delete Selected</button>
                    <button type="button" id="newSchedule" class="btn btn-inverse-primary btn-fw">New Schedule</button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>Schedule name</th>
                        <th>Target groups</th>
                        <th>Scheduled for</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" style="padding:0px;margin-left:10px;margin-top:-6px;" class="form-check-input" id="exampleCheck1">
                            </td>
                            <td>SMS sent to Ride and Feres drivers</td>
                            <td>
                                <span class="badge badge-pill badge-info">Feres Drivers</span>
                                <span class="badge badge-pill badge-info">Ride Drivers</span>
                            </td>
                            <td class="text-primary">Jun 22 2022 03:40PM</td>
                            <td>
                                <span class="badge badge-pill badge-success">Executed</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-secondary">Content</button>
                                    <button type="button" class="btn btn-outline-secondary">Edit</button>
                                    <button type="button" class="btn btn-outline-secondary">Delete</button>
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" style="padding:0px;margin-left:10px;margin-top:-6px;" class="form-check-input" id="exampleCheck1">
                            </td>
                            <td>SMS sent to Airlines Employees</td>
                            <td>
                                <span class="badge badge-pill badge-info">Airlines Employees</span>
                            </td>
                            <td class="text-primary">Jun 25 2022 05:00PM</td>
                            <td>
                                <span class="badge badge-pill badge-dark">Pending</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-secondary">Content</button>
                                    <button type="button" class="btn btn-outline-secondary">Edit</button>
                                    <button type="button" class="btn btn-outline-secondary">Delete</button>
                                </div>  
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- script to create new schedule -->
<script>
    $(document).ready(function(){
       // show create contact modal
       $('#newSchedule').click(function(){
          $('#createScheduleModal').modal('show');
        //   console.log("odda");
      });
       // implementation when submit button is clicked from create contact modal
      $('#createScheduleForm').on('submit', function(event){
          event.preventDefault();
          if($('#createScheduleBtn').val() == 'Schedule'){
              $.ajax({
                  url:"{{ route('/storeSchedule') }}",
                  method:"POST",
                  data: new FormData(this),
                  contentType:false,
                  cache:false,
                  timeout: 10000,
                  async: false
                  processData:false,
                  dataType:'json',
                  beforeSend: function()
                  {
                      $('#createScheduleBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                  },
                  success:function(data){
                      var html = '';
                      if(data.errors){
                          html = '<div class="alert alert-danger alert-block" style="height:30px;padding:2px;">';
                          for(var count = 0; count<data.errors.length; count++){
                              html += '<p>' + data.errors[count] + '</p>';
                          }
                          html += '</div>';
                          $('#createScheduleBtn').html('Schedule'); 
                      }
                      if(data.success){
                          html = '<div class = "alert alert-success alert-block" style="height:30px;padding:2px;">'
                          + data.success + '<button type="button" class="close" data-dismiss="alert">x</button</div>';
                          // empty form field values  
                          $('#createScheduleForm')[0].reset();
                          $('#createScheduleBtn').html('Schedule');

                      }
                      // render error or success message in html variable to span element with id value form_result
                      $('#create_schedule_form_result').html(html);
                  }
              })
          }
      });
    });
</script>