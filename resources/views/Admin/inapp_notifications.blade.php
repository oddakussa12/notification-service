@include('/modals/addInAppNotification')
@include('/modals/editInappNotification')
@include('/modals/deleteModal')
@include('/modals/addInAppLanguage')
@include('/modals/editInappNotiLanguage')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">In-App/Database Notifications</h4>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addinappnotification">Add New</button>
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
                @foreach($inapp_notifications as $inapp_noti)
                    <tbody>
                        <tr>
                            <td>{{$inapp_noti->id}}</td>
                            <td>{{$inapp_noti->title}}</td>
                            <td>{{$inapp_noti->description}}</td>
                            <td>
                                @foreach($inapp_noti->inappLanguages as $language)
                                    <span style="font-size: 16px; color:white;" class="badge badge-success">{{$language->code}}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="#" style="margin-left:10px;font-size:18px;" ><i class="edit_inapp_notification mdi mdi-lead-pencil" data-id={{$inapp_noti->id}}></i></a>
                                <a href="#" style="margin-left:10px;font-size:18px;"><i class="delete_inapp_notification mdi mdi-delete text-danger "></i></a>
                                <a href="#" style="margin-left:10px;font-size:18px;" data-id={{$inapp_noti->id}} class="add_in_app_lang">Add language</a>
                            </td>
                            <td data-toggle="collapse" data-target="#group-of-rows-{{$inapp_noti->id}}" aria-expanded="false" aria-controls="group-of-rows-{{$inapp_noti->id}}">
                                <i style="cursor: pointer;" class="fa fa-angle-down fa-2x" aria-hidden="true"></i>
                            </td>
                        </tr>
                    </tbody>
                    <tbody id="group-of-rows-{{$inapp_noti->id}}" class="collapse expandable">
                        {{-- <thead> --}}
                            <tr class="table-primary" data-toggle="collapse" data-target="#group-of-rows-{{$inapp_noti->id}}">
                              <th> ID </th>
                              <th> CODE</th>
                              <th> Subject</th>
                              <th> Body</th>
                              <th> ACTIONS</th>
                            </tr>
                        {{-- </thead> --}}
                        @foreach($inapp_noti->inappLanguages as $language)
                            <tr class="table-info">
                                <td>{{$language->id}}</td>
                                <td><span style="font-size: 15px; color:white;" class="badge badge-info">{{$language->code}}</span></td>
                                <td>{{$language->subject}}</td>
                                <td>{{$language->body}}</td>
                                <td>
                                    <a href="#" style="margin-left:10px;font-size:18px;" ><i class="edit_language_inapp mdi mdi-lead-pencil"></i></a>
                                    <a href="#" style="margin-left:10px;font-size:18px;"><i class="delete_inapp_language mdi mdi-delete text-danger "></i></a>
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

<!-- script to create new in-app notification -->
<script>
    $(document).ready(function(){
        $('#addinappnotification').click(function(){
          $('#addInappNotificationModal').modal('show');
        });

        $('#createInappNotificationForm').on('submit', function(event){
          event.preventDefault();
          if($('#createInappNotificationBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('inapp-notification.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createInappNotificationBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createInappNotificationBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_inapp_noti_form_result').html(html);
                    }
                    if(data.success){
                        $('#addInappNotificationModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('inAppNotifications')}}',
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

<!-- script to edit in app notification-->
<script>
    $(document).ready(function(){
        $('.edit_inapp_notification').click(function(e){
            $('#editInappNotificationModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            $('#notification_id').val(data[0]);
            $('#edit_title').val(data[1]);
            $('#edit_description').val(data[2]);

        });

        $('#editInappNotificationForm').on('submit', function(event){
            event.preventDefault();
            if($('#editInappNotificationBtn').val() == "Update"){
                $.ajax({
                    url:"{{ route('inapp-notification.update') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType:'json',
                    beforeSend: function()
                    {   
                        $('#editInappNotificationBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                    },
                    success:function(data){
                        var html = '';
                        if(data.errors){
                            html = '<div class="alert alert-danger alert-block">';
                            for(var count = 0; count<data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#editInappNotificationBtn').html('Update');
                            // render error or success message in html variable to span element with id value form_result
                            $('#edit_inapp_noti_form_result').html(html);
                        }
                        if(data.success){
                            $('#editInappNotificationModal').modal('hide');
                                setTimeout(function() { fetchtable(); }, 500);
                                function fetchtable(){
                                    $.ajax({
                                        url:'{{route('inAppNotifications')}}',
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

<!-- script to delete in app notification -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function deleteInappNoti(id,token){
            $.ajax({
                url:"{{route('inapp-notification.delete')}}",
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
                                url:'{{route('inAppNotifications')}}',
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
        $('body').on('click','.delete_inapp_notification',function(e){
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
            deleteInappNoti(id,token);
        });
    });
</script>

<!-- script to create new in app notification language -->
<script>
    $(document).ready(function(){
        $('.add_in_app_lang').click(function(){
          $('#addInappNotificationLanguaModal').modal('show');
          const noti_id = $(this).data("id");
          $('#message_lang_id').val(noti_id);

        });

        $('#createInappLanguageForm').on('submit', function(event){
          event.preventDefault();
          if($('#createInappLangBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('inAppLanguage.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createInappLangBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createInappLangBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_inapp_noti_lang_form_result').html(html);
                    }
                    if(data.success){
                        $('#addInappNotificationLanguaModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('inAppNotifications')}}',
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


<!-- script to edit in app notification language-->
<script>
    $(document).ready(function(){
        $('.edit_language_inapp').click(function(e){
            $('#editInappNotificationLanguaModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            $('#edit_inapp_lang_id').val(data[0]);
            $('#edit_language_code').val(data[1]);
            $('#inapp_title').val(data[2]);
            $('#inapp_body').val(data[3]);
            

        });

        $('#editInappLanguageForm').on('submit', function(event){
            event.preventDefault();
            if($('#editInappLangBtn').val() == "Update"){
                $.ajax({
                    url:"{{ route('inAppLanguage.update') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType:'json',
                    beforeSend: function()
                    {   
                        $('#editInappLangBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                    },
                    success:function(data){
                        var html = '';
                        if(data.errors){
                            html = '<div class="alert alert-danger alert-block">';
                            for(var count = 0; count<data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#editInappLangBtn').html('Update');
                            // render error or success message in html variable to span element with id value form_result
                            $('#edit_inapp_noti_lang_form_result').html(html);
                        }
                        if(data.success){
                            $('#editInappNotificationLanguaModal').modal('hide');
                                setTimeout(function() { fetchtable(); }, 500);
                                function fetchtable(){
                                    $.ajax({
                                        url:'{{route('inAppNotifications')}}',
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

<!-- script to delete in app notification language-->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function deleteInappNotiLang(id,token){
            $.ajax({
                url:"{{route('inAppLanguage.delete')}}",
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
                                url:'{{route('inAppNotifications')}}',
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
        $('body').on('click','.delete_inapp_language',function(e){
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
            deleteInappNotiLang(id,token);
        });
    });
</script>
