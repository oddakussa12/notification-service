@include('/modals/addEmailAccountModal')
@include('/modals/editEmailAccountModal')
@include('/modals/deleteModal')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Email Accounts</h4>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addEmailAccount">Add New</button>
              </div>
        </div>
        <div class="table-responsive table-condensed">
          <table class="table table-hover">
            <thead>
              <tr>
                <th> ID </th>
                <th> ACCOUNT_NAME</th>
                <th> MAIL_MAILER</th>
                <th> MAIL_HOST</th>
                <th> MAIL_PORT </th>
                <th> MAIL_USERNAME</th>
                <th> MAIL_PASSWORD</th>
                <th> MAIL_ENCRYPTION</th>
                <th> MAIL_FROM_ADDRESS</th>
                <th> MAIL_FROM_NAME</th>
                <th> ACTIONS</th>
              </tr>
            </thead>
            <tbody>
                @foreach($emailAccounts as $emailAccount)
                    <tr>
                        <td>{{$emailAccount->id}}</td>
                        <td>{{$emailAccount->ACCOUNT_NAME}}</td>
                        <td>{{$emailAccount->MAIL_MAILER}}</td>
                        <td>{{$emailAccount->MAIL_HOST}}</td>
                        <td>{{$emailAccount->MAIL_PORT}}</td>
                        <td>{{$emailAccount->MAIL_USERNAME}}</td>
                        <td>{{$emailAccount->MAIL_PASSWORD}}</td>
                        <td>{{$emailAccount->MAIL_ENCRYPTION}}</td>
                        <td>{{$emailAccount->MAIL_FROM_ADDRESS}}</td>
                        <td>{{$emailAccount->MAIL_FROM_NAME}}</td>
                        
                        <td>
                            <a href="#" style="margin-left:10px;font-size:18px;" ><i class="edit_account mdi mdi-lead-pencil"></i></a>
                            <a href="#" style="margin-left:10px;font-size:18px;"><i class="delete_account mdi mdi-delete text-danger "></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

<!-- script to create new email account -->
<script>
    $(document).ready(function(){
        $('#addEmailAccount').click(function(){
          $('#createEmailAccountModal').modal('show');
        });
        $('#createEmailAccountForm').on('submit', function(event){
          event.preventDefault();
          if($('#createEmailAccountBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('emailAccount.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createEmailAccountBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createEmailAccountBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_email_account_form_result').html(html);
                    }
                    if(data.success){
                        $('#createEmailAccountModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('emailAccounts')}}',
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

<!-- script to edit email account -->
<script>
    $(document).ready(function(){
        $('.edit_account').click(function(e){
            console.log("clicked");
            $('#editEmailAccountModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            console.log(data);

            $('#account_id').val(data[0]);
            $('#edit_account_name').val(data[1]);
            $('#edit_mail_mailer').val(data[2]);
            $('#edit_mail_host').val(data[3]);
            $('#edit_mail_port').val(data[4]);
            $('#edit_mail_username').val(data[5]);
            $('#edit_mail_password').val(data[6]);
            $('#edit_mail_encryption').val(data[7]);
            $('#edit_mail_from_address').val(data[8]);
            $('#edit_mail_from_name').val(data[9]);
        });

        $('#edit_email_account_form').on('submit', function(event){
            event.preventDefault();
            if($('#editEmailAccountBtn').val() == "Update"){
                $.ajax({
                    url:"{{ route('emailAccount.update') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType:'json',
                    beforeSend: function()
                    {   
                        $('#editEmailAccountBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                    },
                    success:function(data){
                        var html = '';
                        if(data.errors){
                            html = '<div class="alert alert-danger alert-block">';
                            for(var count = 0; count<data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#editEmailAccountBtn').html('Update');
                            // render error or success message in html variable to span element with id value form_result
                            $('#edit_email_account_form_result').html(html);
                        }
                        if(data.success){
                            $('#editEmailAccountModal').modal('hide');
                            console.log("Successssss")
                                setTimeout(function() { fetchtable(); }, 500);
                                function fetchtable(){
                                    $.ajax({
                                        url:'{{route('emailAccounts')}}',
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
    // implementation when edit brand button is clicked from addBrandModal
   
</script>

<!-- script to delete email account -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function deleteEmailAccount(id,token){
            $.ajax({
                url:"{{route('emailAccount.delete')}}",
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
                                url:'{{route('emailAccounts')}}',
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
        $('body').on('click','.delete_account',function(e){
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
            deleteEmailAccount(id,token);
        });
    });
</script>

