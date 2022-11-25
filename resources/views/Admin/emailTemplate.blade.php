@include('/modals/addEmailTemplate')
@include('/modals/editEmailTemplate')
@include('/modals/deleteModal')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Email Templates</h4>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addEmailTemplate">Add Template</button>
              </div>
        </div>
        <!-- <div class="table-responsive table-condensed"> -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th> ID </th>
                <th> Template name</th>
                <th> Template ID</th>
                <th> Description</th>
                <th hidden> Data</th>
                <th> Is active </th>
                <th> Email account name</th>
                <th> ACTIOINS</th>
              </tr>
            </thead>
            <tbody>
                @foreach($emailTemplates as $emailTemplate)
                    <tr>
                        <td>{{$emailTemplate->id}}</td>
                        <td>{{$emailTemplate->name}}</td>
                        <td>{{$emailTemplate->templateId}}</td>
                        <td>{{$emailTemplate->description}}</td>
                        <td hidden>{{$emailTemplate->data}}</td>

                        <td>
                            @if($emailTemplate->is_active)
                                Yes
                            @else
                                No
                            @endif
                        </td>

                        @if($emailTemplate->emailAccount != null)
                            <td>{{$emailTemplate->emailAccount->ACCOUNT_NAME}}</td>
                                @else
                            <td>NULL</td>
                        @endif

                        <td>
                            <a href="#" style="margin-left:10px;font-size:18px;" ><i class="edit_template mdi mdi-lead-pencil"></i></a>
                            <a href="#" style="margin-left:10px;font-size:18px;"><i class="delete_template mdi mdi-delete text-danger "></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        <!-- </div> -->
      </div>
    </div>
</div>


<!-- script to create new email template -->
<script>
    $(document).ready(function(){
        $('#addEmailTemplate').click(function(){
          $('#createEmailTemplateModal').modal('show');

          // populate email account select field
          $.ajax({
                url:"{{ route('fetchEmailAccount')}}",
                type:"GET",
                success:function(data){
                    // console.log("data" data);
                    $('#add_email_template_account_select').append($('<option selected disabled> Select email account</option>'));
                   for (var i = 0; i <= data.length; i++) {
                        $('#add_email_template_account_select').append('<option value="' + data[i]['id'] + '">' + data[i]['ACCOUNT_NAME'] + '</option>');
                    }
                }
            });
        });
        $('#createEmailTemplateForm').on('submit', function(event){
          event.preventDefault();
          if($('#createEmailTemplateBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('emailTemplate.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createEmailTemplateBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createEmailTemplateBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_email_template_form_result').html(html);
                    }
                    if(data.success){
                        $('#createEmailTemplateModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('emailTemplates')}}',
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

<!-- script to edit email template -->
<script>
    $(document).ready(function(){
        $('.edit_template').click(function(e){
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
                    url:"{{ route('emailTemplate.update') }}",
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
                                        url:'{{route('emailTemplates')}}',
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

<!-- script to delete email template -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function deleteEmailAccount(id,token){
            $.ajax({
                url:"{{route('emailTemplate.delete')}}",
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
                                url:'{{route('emailTemplates')}}',
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
        $('body').on('click','.delete_template',function(e){
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

