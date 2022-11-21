{{-- @include('/modals/addBlogModal')
@include('/modals/editBlogModal') --}}
<style>
    .expandable{
        
    }
</style>

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
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addBlog">Add New</button>
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
                        <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-{{$smsMessage->id}}" aria-expanded="false" aria-controls="group-of-rows-{{$smsMessage->id}}">
                            <td>{{$smsMessage->id}}</td>
                            <td>{{$smsMessage->title}}</td>
                            <td>
                                @foreach($smsMessage->languages as $language)
                                    <span style="font-size: 16px; color:white;" class="badge badge-success">{{$language->code}}</span>
                                @endforeach
                            </td>
                            <td>EDIT DELETE</td>
                            <td><i style="cursor: pointer;" class="fa fa-angle-down fa-2x" aria-hidden="true"></i></td>
                        </tr>
                    </tbody>
                    <tbody id="group-of-rows-{{$smsMessage->id}}" class="collapse expandable">
                        {{-- <thead> --}}
                            <tr class="table-primary" data-toggle="collapse" data-target="#group-of-rows-{{$smsMessage->id}}">
                              <th> ID </th>
                              <th> CODE</th>
                              <th> MESSAGE</th>
                              <th> ACTIONS</th>
                              <th></th>
                            </tr>
                        {{-- </thead> --}}
                        @foreach($smsMessage->languages as $language)
                            <tr class="table-info">
                                <td>{{$language->id}}</td>
                                <td><span style="font-size: 15px; color:white;" class="badge badge-info">{{$language->code}}</span></td>
                                <td>{{$language->message}}</td>
                                <td>EDIT DELETE</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                    {{-- <tr>
                        <td>{{$smsMessage->id}}</td>
                        <td>{{$smsMessage->title}}</td>
                        <td>
                            @foreach($smsMessage->languages as $language)
                                <span style="font-size: 16px; color:white;" class="badge badge-success">{{$language->code}}</span>
                            @endforeach
                        </td>
                        <td>EDIT DELETE</td>
                    </tr> --}}
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

