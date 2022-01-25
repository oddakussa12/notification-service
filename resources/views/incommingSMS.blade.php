@include('/modals/replySingleSMS')
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
      <div class="card-body">
        <div class="row" style="padding-bottom:15px;">
              <div class="col-sm-3">
                <h4 class="card-title text-primary text-primary">Incomming SMS</h4>
              </div>
              @if(!$messages->isEmpty())
              <div class="col-sm-5">
                <input type="number" placeholder="Search contact" class="form-control form-control-sm" style="border-radius:5px;"/>
              </div>
                <div class="col-sm-4" style="text-align:right;">
                  <button type="button" class="btn btn-inverse-danger btn-fw">Delete selected</button>
                  <button type="button" class="btn btn-inverse-primary btn-fw">Export data</button>
                </div>
              @endif
        </div>
        @if(!$messages->isEmpty())
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Select</th>
                <th>Contact</th>
                <th>Message</th>
                <th>Recieved at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($messages as $message)
              <tr>
                  <td>
                    <input type="checkbox" style="padding:0px;margin-left:10px;margin-top:-6px;" class="form-check-input" id="exampleCheck1">
                  </td>
                  <td>{{$message->phone}}</td>
                  <td>{{$message->message}}</td>
                  <td>{{ Carbon\Carbon::parse($message->created_at)->format('D, M d, Y h:i A') }}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">View</button>
                        <button type="button" class="btn btn-outline-secondary">Delete</button>
                        <button type="button" class="btn btn-outline-secondary replysingleSMS">Reply</button>
                    </div>  
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
          <div class="text-center" style="margin-top:30px;">
              <h5 class="text-danger">No message received yet</ht>
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- script to send single sms -->
<script>
    $(document).ready(function(){
       // show create contact modal
       $('.replysingleSMS').click(function(){
          $('#replySingleSMS').modal('show');
      });
       // implementation when send button is clicked from send single sms modal
      // $('#createRecordForm').on('submit', function(event){
      //     event.preventDefault();
      //     if($('#createContactBtn').val() == 'Create'){
      //         $.ajax({
      //             url:"{{ route('api.createCustomer') }}",
      //             method:"POST",
      //             data: new FormData(this),
      //             contentType:false,
      //             cache:false,
      //             processData:false,
      //             dataType:'json',
      //             beforeSend: function()
      //             {
      //                 $('#createContactBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
      //             },
      //             success:function(data){
      //                 var html = '';
      //                 if(data.errors){
      //                     html = '<div class="alert alert-danger alert-block" style="height:30px;padding:2px;">';
      //                     for(var count = 0; count<data.errors.length; count++){
      //                         html += '<p>' + data.errors[count] + '</p>';
      //                     }
      //                     html += '</div>';
      //                     $('#createContactBtn').html('Create'); 
      //                 }
      //                 if(data.success){
      //                     html = '<div class = "alert alert-success alert-block" style="height:30px;padding:2px;">'
      //                     + data.success + '<button type="button" class="close" data-dismiss="alert">x</button</div>';
      //                     // empty form field values  
      //                     $('#createRecordForm')[0].reset();
      //                     $('#createContactBtn').html('Create');

      //                 }
      //                 // render error or success message in html variable to span element with id value form_result
      //                 $('#form_result').html(html);
      //             }
      //         })
      //     }
      // });
    });
</script>