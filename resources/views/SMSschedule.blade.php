@include('/modals/createSchedule')
<div class="col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row" style="padding-bottom:15px;">
                <div class="col-sm-6">
                    <h4 class="card-title text-primary">Previous schedules</h4>
                </div>
                <div class="col-sm-6" style="text-align:right;">
                    @if(!$schedules->isEmpty())
                    <button type="button" class="btn btn-inverse-danger btn-fw">Delete Selected</button>
                    @endif
                    <button type="button" id="newschedule" class="btn btn-inverse-primary btn-fw">New Schedule</button>
                </div>
            </div>
            @if(!$schedules->isEmpty())
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
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>
                                        <input type="checkbox" style="padding:0px;margin-left:10px;margin-top:-6px;" class="form-check-input" id="exampleCheck1">
                                    </td>
                                    <td>{{$schedule->name}}</td>
                                    <td>
                                        @if(!$schedule->groups->isEmpty())
                                            @foreach($schedule->groups as $group)
                                                <span class="badge badge-pill badge-info">{{$group->name}}</span>
                                            @endforeach
                                            @else
                                            <span class="badge badge-pill badge-danger">Not grouped</span>
                                        @endif
                                    </td>
                                    <td class="text-primary">{{$schedule->date_time}}</td>
                                    <td>
                                        <span class="badge badge-pill badge-success">{{$schedule->status}}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-secondary">Content</button>
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
                <div class="text-center">
                    <h6 class="text-danger">No schedule created yet</h6>
                </div>
            @endif
        </div>
    </div>
</div>


<!-- script to create new schedule -->
<script>
    $(document).ready(function(){
        $('#newschedule').click(function(){
          $('#createScheduleModal').modal('show');
        });
        $('#createScheduleForm').on('submit', function(event){
          event.preventDefault();
          if($('#createScheduleBtn').val() == 'Schedule'){
              $.ajax({
                url:"{{ route('storeSchedule') }}",
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
                        $('#createScheduleBtn').html('Schedule'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_schedule_form_result').html(html);
                    }
                    if(data.success){
                        $('#createScheduleModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('smsSchedule')}}',
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