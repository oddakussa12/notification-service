@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Task progress</h4>
        <div class="container text-center" style="max-width:400px;margin-top:130px;">
          <div class="container text-center" style="margin-top:50px;">
              <a id="proccessed" style="color:green;font-size:24px;">{{$batch->pendingJobs}}</a>
              <a style="color:green;font-size:24px;">/</a>
              <a id="total" style="color:green;font-size:24px;">{{$batch->totalJobs}}</a>
              <div class="progress" style="height:20px;margin-top:30px;">
                  <div id="progressdiv" class="progress-bar bg-success" role="progressbar" 
                      aria-valuemin="0" aria-valuemax="100">0%
                  </div>
              </div>
              <p data-batchid='{{$batch->id}}' id="batchIdHold"></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection

  @section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var batchId = $('#batchIdHold').data("batchid");
        var timer = setInterval(function(){ 
            fetchBatchStatus(batchId);
        }, 1000);
        function fetchBatchStatus(batchId){
            $.ajax({
                url:'http://172.17.104.10:8181/api/batch/'+batchId,
                cache:false,
                method:'GET',
                beforeSend: function()
                {  
                    console.log("sending");
                },
                success:function(data){
                    console.log(data);
                    $("#proccessed").text(data.processedJobs);
                    $("#total").text(data.totalJobs);
                    $('#progressdiv').attr('aria-valuenow', data.progress).text(data.progress + '%').css('width', data.progress+'%');
                    // stop sending request
                    if(data.progress == 100){
                        clearInterval(timer);
                    }
                }
            });
        }
    });
</script>
@endsection
