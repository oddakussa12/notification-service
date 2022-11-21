{{-- @include('/modals/addBlogModal')
@include('/modals/editBlogModal') --}}
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
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addBlog">Add New</button>
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
                        <td>{{$emailTemplate->is_active}}</td>
                        <td>{{$emailTemplate->emailAccount->ACCOUNT_NAME}}</td>
                        <td>EDIT DELETE</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        <!-- </div> -->
      </div>
    </div>
</div>


<!-- script to edit blog -->
<script>
    $(document).ready(function(){
        $('#editblog').click(function(e){
            console.log("clicked");
            $('#editBlogModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            console.log(data);

            $('#editcatid').val(data[0]);
            $('#editcatname').val(data[1]);
        });
    });
    // implementation when edit brand button is clicked from addBrandModal
   
</script>

<!-- script to create new blog -->
<script>
    $(document).ready(function(){
        $('#addBlog').click(function(){
          $('#createBlogModal').modal('show');
        });
        $('#createBlogForm').on('submit', function(event){
          event.preventDefault();
          if($('#createBlogBtn').val() == 'Post'){
              $.ajax({
                url:"{{ route('blog.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createBlogBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createBlogBtn').html('Post'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_blog_form_result').html(html);
                    }
                    if(data.success){
                        $('#createBlogModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('blogs')}}',
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

