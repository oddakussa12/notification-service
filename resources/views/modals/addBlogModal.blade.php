<div  class="modal fade" id="createBlogModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Write blog post</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="create_blog_form_result"></span>
      <form id="createBlogForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Blog title En</label>
                    <div class="col-sm-8">
                        <input type = "text" name="title" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Blog title in english..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Blog title Am</label>
                    <div class="col-sm-8">
                        <input type = "text" name="title_am" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Blog title in amharic..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Blog image</label>
                    <div class="col-sm-8">
                    <input type="file" name="file"  class="form-control" style="padding:6px;"/>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Blog category</label>
                    <div class="col-sm-8">
                        <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;"
                            name="category_id">
                            <option selected disabled>Choose category</option>
                            @if(!$blogCategories->isEmpty())
                            @foreach($blogCategories as $cat)
                                <option value={{$cat->id}}>{{$cat->name}}</option>
                            @endforeach
                            @else
                                <option disabled>No category found, Please create one first.</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div>
                    <textarea id="texten" name="description" placeholder="Blog body in english" ></textarea>
                </div>
                <div style="margin-top:10px;" >
                    <textarea id="textam" name="description_am" placeholder="Blog body in amharic" ></textarea>
                </div>
                
                
            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="createBlogBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Post">Post</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

