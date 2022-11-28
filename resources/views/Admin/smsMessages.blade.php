@include('/modals/addSmsMessage')
@include('/modals/editSmsMessage')
@include('/modals/deleteModal')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">SMS Messages</h4>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addsmsmessage">Add New</button>
              </div>
        </div>
        <!-- <div class="table-responsive table-condensed"> -->
          <table class="table table-hover">
            <thead>
              <tr class="table-primary">
                <th> ID </th>
                <th> Title</th>
                <th> Languages</th>
                <th> ACTIONS</th>
                <th> </th>
              </tr>
            </thead>
            <tbody>
                @foreach($smsMessages as $smsMessage)
                    <tbody>
                        <tr>
                            <td>{{$smsMessage->id}}</td>
                            <td>{{$smsMessage->title}}</td>
                            <td>
                                @foreach($smsMessage->languages as $language)
                                    <span style="font-size: 16px; color:white;" class="badge badge-success">{{$language->code}}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="#" style="margin-left:10px;font-size:18px;" ><i class="edit_sms_message mdi mdi-lead-pencil"></i></a>
                                <a href="#" style="margin-left:10px;font-size:18px;"><i class="delete_sms_message mdi mdi-delete text-danger "></i></a>
                            </td>
                            <td data-toggle="collapse" data-target="#group-of-rows-{{$smsMessage->id}}" aria-expanded="false" aria-controls="group-of-rows-{{$smsMessage->id}}">
                                <i style="cursor: pointer;" class="fa fa-angle-down fa-2x" aria-hidden="true"></i>
                            </td>
                        </tr>
                    </tbody>
                    <tbody id="group-of-rows-{{$smsMessage->id}}" class="collapse expandable">
                        {{-- <thead> --}}
                            <tr class="table-primary" data-toggle="collapse" data-target="#group-of-rows-{{$smsMessage->id}}">
                              <th> ID </th>
                              <th> CODE</th>
                              <th> MESSAGE</th>
                              <th> ACTIONS</th>
                              
                            </tr>
                        {{-- </thead> --}}
                        @foreach($smsMessage->languages as $language)
                            <tr class="table-info">
                                <td>{{$language->id}}</td>
                                <td><span style="font-size: 15px; color:white;" class="badge badge-info">{{$language->code}}</span></td>
                                <td>{{$language->message}}</td>
                                <td>
                                    <a href="#" style="margin-left:10px;font-size:18px;" ><i class="edit_template mdi mdi-lead-pencil"></i></a>
                                    <a href="#" style="margin-left:10px;font-size:18px;"><i class="delete_language mdi mdi-delete text-danger "></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                @endforeach

            </tbody>
          </table>
        <!-- </div> -->
      </div>
    </div>
</div>

<!-- script to create new SMS message -->
<script>
    $(document).ready(function(){
        $('#addsmsmessage').click(function(){
          $('#createSMSmessageModal').modal('show');
        });

        $('#createSMSmessageForm').on('submit', function(event){
          event.preventDefault();
          if($('#createSMSmessageBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('SMSmessage.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createSMSmessageBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createSMSmessageBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_sms_message_form_result').html(html);
                    }
                    if(data.success){
                        $('#createSMSmessageModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('smsMessages')}}',
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

<!-- script to edit SMS message -->
<script>
    $(document).ready(function(){
        $('.edit_sms_message').click(function(e){
            $('#editEmailTemplateModal').modal('show');

            // populate email account select field
            $.ajax({
                url:"{{ route('fetchEmailAccount')}}",
                type:"GET",
                success:function(data){
                    // console.log("data" data);
                    $('#edit_email_account').append($('<option selected disabled> Select email account</option>'));
                   for (var i = 0; i <= data.length; i++) {
                        $('#edit_email_account').append('<option value="' + data[i]['id'] + '">' + data[i]['ACCOUNT_NAME'] + '</option>');
                    }
                }
            });

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            // console.log(data);

            $('#template_id').val(data[0]);
            $('#edit_template_name').val(data[1]);
            $('#edit_template_id').val(data[2]);
            $('#edit_description').val(data[3]);
            $('#edit_data').val(data[4]);

        });

        $('#edit_email_template_form').on('submit', function(event){
            event.preventDefault();
            if($('#editEmailTemplateBtn').val() == "Update"){
                $.ajax({
                    url:"{{ route('SMSmessage.update') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType:'json',
                    beforeSend: function()
                    {   
                        $('#editEmailTemplateBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                    },
                    success:function(data){
                        var html = '';
                        if(data.errors){
                            html = '<div class="alert alert-danger alert-block">';
                            for(var count = 0; count<data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#editEmailTemplateBtn').html('Update');
                            // render error or success message in html variable to span element with id value form_result
                            $('#edit_email_template_form_result').html(html);
                        }
                        if(data.success){
                            $('#editEmailTemplateModal').modal('hide');
                                setTimeout(function() { fetchtable(); }, 500);
                                function fetchtable(){
                                    $.ajax({
                                        url:'{{route('smsMessages')}}',
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
                    }
                })
            }
        });    
    });
   
</script>

<!-- script to delete SMS message -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function deleteSMSmessage(id,token){
            $.ajax({
                url:"{{route('SMSmessage.delete')}}",
                method:'DELETE',
                data:{id:id,_token:token},
                beforeSend: function()
                {   
                    $('#deleteModal').modal('hide');
                },
                success:function(data){
                    setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('smsMessages')}}',
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
            });
        }
        $('body').on('click','.delete_sms_message',function(e){
            e.preventDefault();
            $('#deleteModal').modal('show');

            var $tr =$(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            // console.log(data);
            $('#deleteitemid').val(data[0]);
            $('#deleteitemname').html('"'+data[1]+'"');
        });
        $('#delete_form').on('submit',function(e){
            e.preventDefault();
            var id = $('#deleteitemid').val();
            deleteSMSmessage(id,token);
        });
    });
</script>



