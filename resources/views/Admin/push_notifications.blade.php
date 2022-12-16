@include('/modals/addPushNotification')
@include('/modals/editPushNotification')
@include('/modals/deleteModal')
@include('/modals/addPushLanguage')
@include('/modals/editPushLanguage')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Push Notifications</h4>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addpushnotification">Add New</button>
              </div>
        </div>
        <div class="table-responsive table-condensed">
          <table class="table table-hover">
            <thead>
              <tr class="table-primary">
                <th> ID </th>
                <th> Title</th>
                <th> Description</th>
                <th> Languages</th>
                <th> ACTIONS</th>
                <th>Expand </th>
              </tr>
            </thead>
            <tbody>
                @foreach($push_notifications as $push_noti)
                    <tbody>
                        <tr>
                            <td>{{$push_noti->id}}</td>
                            <td>{{$push_noti->title}}</td>
                            <td>{{$push_noti->description}}</td>
                            <td>
                                @foreach($push_noti->pushlanguages as $language)
                                    <span style="font-size: 16px; color:white;" class="badge badge-success">{{$language->code}}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="#" style="margin-left:10px;font-size:18px;" ><i class="edit_push_notification mdi mdi-lead-pencil" data-id={{$push_noti->id}}></i></a>
                                <a href="#" style="margin-left:10px;font-size:18px;"><i class="delete_push_notification mdi mdi-delete text-danger "></i></a>
                                <a href="#" style="margin-left:10px;font-size:18px;" data-id={{$push_noti->id}} class="add_push_lang">Add language</a>
                            </td>
                            <td data-toggle="collapse" data-target="#group-of-rows-{{$push_noti->id}}" aria-expanded="false" aria-controls="group-of-rows-{{$push_noti->id}}">
                                <i style="cursor: pointer;" class="fa fa-angle-down fa-2x" aria-hidden="true"></i>
                            </td>
                        </tr>
                    </tbody>
                    <tbody id="group-of-rows-{{$push_noti->id}}" class="collapse expandable">
                        {{-- <thead> --}}
                            <tr class="table-primary" data-toggle="collapse" data-target="#group-of-rows-{{$push_noti->id}}">
                              <th> ID </th>
                              <th> CODE</th>
                              <th> Subject</th>
                              <th> Body</th>
                              <th> ACTIONS</th>
                            </tr>
                        {{-- </thead> --}}
                        @foreach($push_noti->pushlanguages as $language)
                            <tr class="table-info">
                                <td>{{$language->id}}</td>
                                <td><span style="font-size: 15px; color:white;" class="badge badge-info">{{$language->code}}</span></td>
                                <td>{{$language->subject}}</td>
                                <td>{{$language->body}}</td>
                                <td>
                                    <a href="#" style="margin-left:10px;font-size:18px;" ><i class="edit_language_push mdi mdi-lead-pencil"></i></a>
                                    <a href="#" style="margin-left:10px;font-size:18px;"><i class="delete_push_language mdi mdi-delete text-danger "></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

<!-- script to create new push notification -->
<script>
    $(document).ready(function(){
        $('#addpushnotification').click(function(){
          $('#addPushNotificationModal').modal('show');
        });

        $('#createPushNotificationForm').on('submit', function(event){
          event.preventDefault();
          if($('#createPushNotificationBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('push-notification.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createPushNotificationBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createPushNotificationBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_push_noti_form_result').html(html);
                    }
                    if(data.success){
                        $('#addPushNotificationModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('pushNotifications')}}',
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

<!-- script to edit push notification-->
<script>
    $(document).ready(function(){
        $('.edit_push_notification').click(function(e){
            $('#editPushNotificationModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            $('#notification_id').val(data[0]);
            $('#edit_title').val(data[1]);
            $('#edit_description').val(data[2]);

        });

        $('#editPushNotificationForm').on('submit', function(event){
            event.preventDefault();
            if($('#editPushNotificationBtn').val() == "Update"){
                $.ajax({
                    url:"{{ route('push-notification.update') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType:'json',
                    beforeSend: function()
                    {   
                        $('#editPushNotificationBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                    },
                    success:function(data){
                        var html = '';
                        if(data.errors){
                            html = '<div class="alert alert-danger alert-block">';
                            for(var count = 0; count<data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#editPushNotificationBtn').html('Update');
                            // render error or success message in html variable to span element with id value form_result
                            $('#edit_push_noti_form_result').html(html);
                        }
                        if(data.success){
                            $('#editPushNotificationModal').modal('hide');
                                setTimeout(function() { fetchtable(); }, 500);
                                function fetchtable(){
                                    $.ajax({
                                        url:'{{route('pushNotifications')}}',
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

<!-- script to delete push notification -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function deletePushNoti(id,token){
            $.ajax({
                url:"{{route('push-notification.delete')}}",
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
                                url:'{{route('pushNotifications')}}',
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
        $('body').on('click','.delete_push_notification',function(e){
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
            deletePushNoti(id,token);
        });
    });
</script>

<!-- script to create new push notification language -->
<script>
    $(document).ready(function(){
        $('.add_push_lang').click(function(){
          $('#addPushNotificationLanguaModal').modal('show');
          const noti_id = $(this).data("id");
          $('#message_lang_id').val(noti_id);

        });

        $('#createPushLanguageForm').on('submit', function(event){
          event.preventDefault();
          if($('#createPushLangBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('pushLanguage.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createPushLangBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createPushLangBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_push_noti_lang_form_result').html(html);
                    }
                    if(data.success){
                        $('#addPushNotificationLanguaModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('pushNotifications')}}',
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

<!-- script to edit push notification language-->
<script>
    $(document).ready(function(){
        $('.edit_language_push').click(function(e){
            $('#editPushNotificationLanguaModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            $('#edit_inapp_lang_id').val(data[0]);
            $('#edit_language_code').val(data[1]);
            $('#push_title').val(data[2]);
            $('#push_body').val(data[3]);
            

        });

        $('#editPushLanguageForm').on('submit', function(event){
            event.preventDefault();
            if($('#editPushLangBtn').val() == "Update"){
                $.ajax({
                    url:"{{ route('pushLanguage.update') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType:'json',
                    beforeSend: function()
                    {   
                        $('#editPushLangBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                    },
                    success:function(data){
                        var html = '';
                        if(data.errors){
                            html = '<div class="alert alert-danger alert-block">';
                            for(var count = 0; count<data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#editPushLangBtn').html('Update');
                            // render error or success message in html variable to span element with id value form_result
                            $('#edit_push_noti_lang_form_result').html(html);
                        }
                        if(data.success){
                            $('#editPushNotificationLanguaModal').modal('hide');
                                setTimeout(function() { fetchtable(); }, 500);
                                function fetchtable(){
                                    $.ajax({
                                        url:'{{route('pushNotifications')}}',
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

<!-- script to delete push notification language-->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function deletePushNotiLang(id,token){
            $.ajax({
                url:"{{route('pushLanguage.delete')}}",
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
                                url:'{{route('pushNotifications')}}',
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
        $('body').on('click','.delete_push_language',function(e){
            e.preventDefault();
            $('#deleteModal').modal('show');

            var $tr =$(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            // console.log(data);
            $('#deleteitemid').val(data[0]);
            $('#deleteitemname').html('"'+data[2]+'"');
        });
        $('#delete_form').on('submit',function(e){
            e.preventDefault();
            var id = $('#deleteitemid').val();
            deletePushNotiLang(id,token);
        });
    });
</script>
