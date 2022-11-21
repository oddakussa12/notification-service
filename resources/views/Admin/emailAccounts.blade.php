{{-- @include('/modals/addBlogModal')
@include('/modals/editBlogModal') --}}
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
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addBlog">Add New</button>
              </div>
        </div>
        <!-- <div class="table-responsive table-condensed"> -->
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
                        
                        <td>EDIT DELETE</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        <!-- </div> -->
      </div>
    </div>
</div>


<!-- script for the ck editor -->
<script>
    //  text area on editBlog modal with id editoredit  
    ClassicEditor
        .create( document.querySelector( '#textam' ) )
        .catch( error => {
        } );
</script>
<script>
    //  text area on editBlog modal with id editoredit  
    ClassicEditor
        .create( document.querySelector( '#texten' ) )
        .catch( error => {
        } );
</script>

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

<!-- script for ajax loading blogs -->
{{-- <script>
    $(document).ready( function () {
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.blogs') }}",
            "columns": [
                {data: "title" },
                {data: "description" },
                {data: "created_at" },
                {data: 'action', name: 'action', orderable: true, searchable: true},
                
            ]
        });
    });
</script> --}}

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

