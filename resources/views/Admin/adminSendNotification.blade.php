<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="display-4 text-primary">Broadcast notifications</h6>
            
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <span id="admin_send_noti_form_result"></span>
        <form id="admin_send_noti_form" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Email notification</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <small for="account_name" style="font-size: 16px;">Email subject</small>
                                    <input type = "text" name="email_subject" class="form-control"
                                     style="margin-top:5px;border-radius:5px;padding:5px; height:40px; font-size:16px;"
                                     placeholder="Email subject..."/>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:30px;">
                                <div class="col-sm-12">
                                    <small for="account_name" style="font-size: 16px;">Email template</small>
                                    <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;height:40px; font-size:16px;"
                                        name="email_template_id">
                                        <option selected disabled>Select email template</option>
                                        @foreach($emailTemplates as $template)
                                            <option value="{{$template->templateId}}" style="font-size: 16px;">
                                                {{$template->templateId}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:30px;">
                                <div class="col-sm-12">
                                    <small for="account_name" style="font-size: 16px;">Email account</small>
                                    <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;height:40px; font-size:16px;"
                                        name="email_account">
                                        <option selected disabled>Select email account</option>
                                        @foreach($emailAccounts as $emailAccount)
                                            <option value="{{$emailAccount->ACCOUNT_NAME}}"  style="font-size: 16px;">
                                                {{$emailAccount->MAIL_USERNAME}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">SMS notification</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <small for="account_name" style="font-size: 16px;">SMS template</small>
                                    <select class="form-control" style="height:40px; padding:5px;border-radius:5px;margin-top:5px;font-size:16px;"
                                        name="message_id">
                                        <option selected disabled>Select SMS template</option>
                                        @foreach($messages as $message)
                                            <option value="{{$message->id}}" style="font-size: 16px;">{{$message->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">InApp notification</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <small for="account_name" style="font-size: 16px;">InApp Notification</small>
                                    <select class="form-control" style="height:40px; padding:5px;border-radius:5px;margin-top:5px;font-size:16px;"
                                        name="inapp_noti_id">
                                        <option selected disabled>Select notification...</option>
                                        @foreach($inapp_notifications as $message)
                                            <option value="{{$message->id}}" style="font-size: 16px;">{{$message->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Push notification</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <small for="account_name" style="font-size: 16px;">SMS template</small>
                                    <select class="form-control" style="height:40px; padding:5px;border-radius:5px;margin-top:5px;font-size:16px;"
                                        name="message_id">
                                        <option selected disabled>Select SMS template</option>
                                        @foreach($messages as $message)
                                            <option value="{{$message->id}}" style="font-size: 16px;">{{$message->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 grid-margin stretch-card text-center">
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" id="adminSendNotiBtn" class="btn-lg btn btn-primary btn-fw" 
                            style="width:200px;font-size:24px;" value="Send">
                                SEND
                                <i class="mdi mdi mdi-send"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- script to send notification by admin user-->
<script>
    $(document).ready(function(){
        $('#admin_send_noti_form').on('submit', function(event){
            console.log("You are here");
          event.preventDefault();
          if($('#adminSendNotiBtn').val() == 'Send'){
              $.ajax({
                url:"{{ route('admin-user-send-noti.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#adminSendNotiBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#adminSendNotiBtn').html('Send'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#admin_send_noti_form_result').html(html);
                    }
                   
                    html = '<div class = "alert alert-success alert-block">'
                        + "Notification has been sent."+ '<button type="button" class="close" data-dismiss="alert">x</button</div>';

                    $('#admin_send_noti_form_result').html(html);
                    $('#adminSendNotiBtn').html('Send'); 
                },
              })
            }
        });
    });
</script>