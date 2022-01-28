<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-12">
              <h4 class="card-title text-primary text-primary">Payment</h4>
              </div>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr class="text-center">
                <th>Total Customers</th>
                <th>Total paying Customers</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td style="padding-left:10px;padding-right:10px;">
                    <blockquote class="blockquote text-center" style="padding:5px;">
                      {{$totalCustomer}}
                    </blockquote>
                  </td>
                  <td style="padding-left:10px;padding-right:10px;">
                    <blockquote class="blockquote text-center" style="padding:5px;">
                      {{$totalPayingCustomer}}
                    </blockquote>
                  </td>
                  <td class="text-center" style="padding:0px;">
                  @if($batch != null)
                      @if($batch->pending_jobs == 0 && $totalPayingCustomer > 0)
                        <button id="payBut" style="margin-top:-15px;" class="btn btn-primary">Pay</button>
                        @else
                        <button  disabled style="margin-top:-15px; cursor:not-allowed" class="btn btn-primary">Pay</button>
                      @endif
                      @elseif($totalPayingCustomer > 0)
                        <button id="payBut" style="margin-top:-15px;" class="btn btn-primary">Pay</button>
                      @else
                        <button  disabled style="margin-top:-15px;cursor:not-allowed" class="btn btn-primary">Pay</button>
                    @endif
                  </td>
                </tr>
            </tbody>
          </table>
        </div>
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
                <a id="proccessed" style="color:green;font-size:24px;">0</a>
                <a style="color:green;font-size:24px;">/</a>
                <a id="total" style="color:green;font-size:24px;">0</a>
                <div class="progress" style="height:15px;margin-top:30px;">
                    <div id="progressdiv" class="progress-bar bg-primary" role="progressbar" 
                        aria-valuemin="0"  aria-valuemax="100">0%
                    </div>
                </div>
                <button class="btn btn-danger" style="margin-top:30px;width:100px;">Stop</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p data-batchid='{{$batch->id}}' id="batchIdHold"></p>
  @endif
@endif



  <!-- script to execute when pay button is clicked -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function processPayment(){
            $.ajax({
              url:'{{route('paymentProcessing')}}',
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

        $('#payBut').on('click',function(){
            processPayment();
        });
    });
</script>


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
                    console.log("sending");
                },
                success:function(data){
                    // console.log(data);
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