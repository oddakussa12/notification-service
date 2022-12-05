<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="display-4 text-primary">Send notifications</h6>
            
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <span id="admin_send_noti_form_result"></span>
        <form id="admin_send_noti_form" method="POST">
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Email notification</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <small for="account_name">Email subject</small>
                                    <input type = "text" name="subject" class="form-control"
                                     style="margin-top:5px;border-radius:5px;padding:5px; height:40px;"placeholder="Email subject..."/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;height:40px;"
                                        name="template_id">
                                        <option selected disabled>Select email template</option>
                                        @foreach($emailTemplates as $template)
                                            <option value="{{$template->templateId}}">{{$template->templateId}}</option>
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
                                    <select class="form-control" style="height:40px; padding:5px;border-radius:5px;margin-top:5px;"
                                        name="template_id">
                                        <option selected disabled>Select SMS template</option>
                                        @foreach($messages as $message)
                                            <option value="{{$message->id}}">{{$message->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row text-center">
    <div class="col-lg-12 grid-margin stretch-card">
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

<!-- script to create new email account -->
<script>
    $(document).ready(function(){
        $('#admin_send_noti_form').on('submit', function(event){
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
                    if(data.success){
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('send-notification')}}',
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