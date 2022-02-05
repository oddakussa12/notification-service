
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
            <h4 class="card-title text-primary">Import customer</h4>
            <span id="import_form_result"></span>
            <form  id="importCustomerForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col">
                    <select name = "group_id"class="form-control" style="padding:0px;">
                        <option selected disabled>Choose customer group</option>
                        @if(!$groups->isEmpty())
                            @foreach($groups as $group)
                                <option value={{$group->id}}>{{$group->name}}</option>
                            @endforeach
                        @else
                            <option>No group found, Please create one first.</option>
                        @endif
                    </select>
                    </div>
                    <div class="col" style="height:10px;">
                    <input type="file" name="mycsv" id="mycsv" class="form-control" style="padding:6px;"/>
                    </div>
                </div>
                <input value="Import" type="submit" id="importBtn" class="btn btn-primary btn-block" style="margin-top:30px;width:100px;" />
            </form>
        </div>
    </div>
</div>


@if($batch != null)
  @if($batch->pending_jobs > 0)
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-primary">Task progress</h4>
          <div class="container text-center" style="max-width:400px;margin-top:10px;">
            <div class="container text-center">
              <p>Task name: {{$batch->name}}</p>
              <p>Started time: {{$batch->created_at}} </p>
              <p id="finishedAtp"></p>
                <a id="proccessed" style="color:green;font-size:24px;">0</a>
                <a style="color:green;font-size:24px;">/</a>
                <a id="total" style="color:green;font-size:24px;">0</a>
                <div class="progress" style="height:15px;margin-top:30px;">
                    <div id="progressdiv" class="progress-bar bg-primary" role="progressbar" 
                        aria-valuemin="0"  aria-valuemax="100">0%
                    </div>
                </div>
                <h3 id="finished" class="text-success" style="margin-top:20px;"></h3>
                <button id="stop" class="btn btn-danger" style="margin-top:30px;width:100px;">Stop task</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p data-batchid='{{$batch->id}}' id="batchIdHold"></p>
  @endif
@endif



<script>
    $(document).ready(function(){

        $('#importCustomerForm').on('submit', function(event){
          event.preventDefault();
          if($('#importBtn').val() == 'Import'){
              $.ajax({
                url:"{{ route('api.importCustomer') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $("#loading-overlay").show();
                    $('#importBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="height:30px;padding:4px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createScheduleBtn').html('Schedule'); 
                        $("#loading-overlay").hide();
                        // render error or success message in html variable to span element with id value form_result
                        $('#import_form_result').html(html);
                    }
                    if(data.success){
                        $("#loading-overlay").hide();
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('importCustomer')}}',
                                cache: false,
                                type:'GET',
                                beforeSend: function()
                                {  
                                    $("#loading-overlay").show();
                                },
                                success:function(data){
                                    
                                    $("#odda").html(data);
                                    $("#loading-overlay").hide();
                                    // disable the import button
                                    const button = document.getElementById('importBtn');
                                    button.style.cursor = "not-allowed";
                                    button.disabled = true;
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


<!-- auto fetch by ajax  -->
<script>
    $(document).ready(function(){
        var batchId = $('#batchIdHold').data("batchid");
        if(batchId){
          var timer = setInterval(function(){ 
              fetchBatchStatus(batchId);
          }, 1000);
        }
        function fetchBatchStatus(batchId){
            $.ajax({
                url:'http://172.17.104.10:8181/api/batch/'+batchId,
                cache:false,
                method:'GET',
                beforeSend: function()
                {  
                    // console.log("sending");
                },
                success:function(data){
                    // console.log(data);
                    $("#proccessed").text(data.processedJobs);
                    $("#total").text(data.totalJobs);

                    $('#progressdiv').attr('aria-valuenow', data.progress).text(data.progress + '%').css('width', data.progress+'%');
                    // stop sending request
                    if(data.progress == 100){
                        clearInterval(timer);
                        // enable import button
                        const button = document.getElementById('importBtn');
                        button.style.cursor = "pointer";
                        button.disabled = false;
                        
                        // show finished at time stamp
                        const p = document.getElementById('finishedAtp').innerHTML = "Finished at "+data.finishedAt;

                        // hide stop task button
                        const stopBut = document.getElementById('stop').style.display = "none";
                        
                        // disply finished text
                        const mes = document.getElementById('finished').innerHTML = "Task completed";
                        
                        // change the style of the progress bar
                        document.getElementById("progressdiv").classList.remove('bg-primary');
                        document.getElementById("progressdiv").classList.add('bg-success');                        
                    }
                }
            });
        }
    });
</script>