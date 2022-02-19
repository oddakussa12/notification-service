@include('/modals/addBlogCategoryModal')
@include('/modals/addTagModal')
@include('/modals/addForumCategoryModal')
@include('/modals/addReportWordModal')
@include('/modals/deleteModal')

<div class="row">
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="row" style="padding-bottom:10px;">
            <div class="col-sm-6">
                <h4 class="card-title">Forum categories</h4>
            </div>
            <div class="col-sm-6" style="text-align:right;">
                <button class="btn btn-outline-primary" id="addforumcategory">Add category</button>
            </div>
          </div>
<<<<<<< HEAD
        <div class="table-responsive admincards" style="height:200px; overflow-x:auto; overflow-y:auto;">
=======
        <div class="table-responsive admincards" style="height:200px; overflow-y:auto;">
>>>>>>> ff78aa05b49ab4a8a35e8ba8e05c6979294be14b
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name EN</th>
                <th>Name AM</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @if(!$categories->isEmpty())
                @foreach($categories as $fcategory)
                    <tr>
                        <td>{{$fcategory->name}}</td>
                        <td>{{$fcategory->name_am}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="mdi mdi-lead-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="text-center text-danger">
                        <td colspan="4">No content!</td>
                    </tr>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="row" style="padding-bottom:10px;">
            <div class="col-sm-6">
                <h4 class="card-title">Blog categories</h4>
            </div>
            <div class="col-sm-6" style="text-align:right;">
                <button class="btn btn-outline-primary" id="blogcategory">Add category</button>
            </div>
          </div>
        <div class="table-responsive admincards" style="height:200px; overflow-y:auto;">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name EN</th>
                <th>Name AM</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @if(!$blogCategories->isEmpty())
                    @foreach($blogCategories as $bcategory)
                        <tr>
                            <td>{{$bcategory->name}}</td>
                            <td>{{$bcategory->name_am}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="mdi mdi-lead-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr class="text-center text-danger">
                        <td colspan="4">No content!</td>
                    </tr>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <div class="row" style="padding-bottom:10px;">
                <div class="col-sm-6">
                    <h4 class="card-title">Tags</h4>
                </div>
                <div class="col-sm-6" style="text-align:right;">
                    <button class="btn btn-outline-primary" id="addTag">Add tag</button>
                </div>
            </div>
            <div class="table-responsive admincards" style="height:200px; overflow-y:auto;" >
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name EN</th>
                    <th>Name AM</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if(!$tags->isEmpty())
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{$tag->id}}</td>
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->name_am}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="mdi mdi-lead-pencil"></i>
                                    </button>
                                    <button type="button" id="deleteTag" class="btn btn-outline-danger">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="text-center text-danger">
                            <td colspan="4">No content!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            </div>
        </div>
        </div>
  </div>
  <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <div class="row" style="padding-bottom:10px;">
                <div class="col-sm-6">
                    <h4 class="card-title">Report phrase</h4>
                </div>
                <div class="col-sm-6" style="text-align:right;">
                    <button class="btn btn-outline-primary" id="addreportword">Add</button>
                </div>
            </div>
            <div class="table-responsive admincards" style="height:200px; overflow-y:auto;" >
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name EN</th>
                    <th>Name AM</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if(!$reportwords->isEmpty())
                    @foreach($reportwords as $word)
                        <tr>
                            <td>{{$word->name}}</td>
                            <td>{{$word->name_am}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="mdi mdi-lead-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="text-center text-danger">
                            <td colspan="4">No content!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            </div>
        </div>
        </div>
  </div>
</div>

<!-- script to create new forum category -->
<script>
    $(document).ready(function(){
        $('#addforumcategory').click(function(){
          $('#createForumCategoryModal').modal('show');
        });
        $('#createForumCategoryForm').on('submit', function(event){
          event.preventDefault();
          if($('#createForumCategoryBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('forumcategory.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createForumCategoryBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createForumCategoryBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_forum_category_form_result').html(html);
                    }
                    if(data.success){
                        $('#createForumCategoryModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('categorytag')}}',
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

<!-- script to create new blog category -->
<script>
    $(document).ready(function(){
        $('#blogcategory').click(function(){
          $('#createBlogCategoryModal').modal('show');
        });
        $('#createBlogCategoryForm').on('submit', function(event){
          event.preventDefault();
          if($('#createBlogCategoryBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('blogcategory.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createBlogCategoryBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createBlogCategoryBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_blog_category_form_result').html(html);
                    }
                    if(data.success){
                        $('#createBlogCategoryModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('categorytag')}}',
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

<!-- script to create new tag -->
<script>
    $(document).ready(function(){
        $('#addTag').click(function(){
          $('#createTagModal').modal('show');
        });
        $('#createTagForm').on('submit', function(event){
          event.preventDefault();
          if($('#createTagBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('tag.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createTagBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createTagBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_tag_form_result').html(html);
                    }
                    if(data.success){
                        $('#createTagModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('categorytag')}}',
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


<!-- script to create new report word -->
<script>
    $(document).ready(function(){
        $('#addreportword').click(function(){
          $('#createReportWordModal').modal('show');
        });
        $('#createReportwordForm').on('submit', function(event){
          event.preventDefault();
          if($('#createReportwordBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('reportword.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createReportwordBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createReportwordBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_report_word_form_result').html(html);
                    }
                    if(data.success){
                        $('#createReportWordModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('categorytag')}}',
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

<!-- script to delete tag -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function deleteTag(id,token){
            $.ajax({
                url:"{{route('tag.delete')}}",
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
                                url:'{{route('categorytag')}}',
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
        $('body').on('click','#deleteTag',function(e){
            e.preventDefault();
            // var subcatid = $(this).data('subcategoryid');
            // deleteSubCat(subcatid,token);
            // open delete sub category confimation modal
            $('#deleteModal').modal('show');

            var $tr =$(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            // console.log(data);
            $('#deleteitemid').val(data[0]);
            // $('#catNameInDelCatModal').val(data[1]); 
            $('#deleteitemname').html('"'+data[1]+'"');
        });
        // when delete button is clicked from delete subcategory modal
        $('#delete_form').on('submit',function(e){
            e.preventDefault();
            var id = $('#deleteitemid').val();
            deleteTag(id,token);
        });
    });
</script>