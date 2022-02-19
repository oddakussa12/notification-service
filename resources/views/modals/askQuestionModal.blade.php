<div  class="modal fade" id="createQuestionModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Ask a question</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <span id="create_question_form_result"></span>
      <form id="createQuestionForm" method="POST">
            @csrf
            <div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="form-group shadow-textarea" style="margin-top:10px;">
                            <textarea class="form-control z-depth-1" name="body" style="padding:10px;font-size:14px;border-radius:4px;" rows="6" placeholder="Write your question here ..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Question category</label>
                    <div class="col-sm-8">
                        <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;"
                            name="category_id">
                            <option selected disabled>Choose category</option>
                            @if(!$categories->isEmpty())
                            @foreach($categories as $cat)
                                <option value={{$cat->id}}>{{$cat->name}}</option>
                            @endforeach
                            @else
                                <option disabled>No category found, Please create one first.</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    @if(!$tags->isEmpty())
                        <div class="row" style="margin-left:10px;">
                            @foreach($tags as $tag)
                                <div class="form-group form-check" style="padding-right:15px;">
                                    <input type="checkbox" name="tag_ids[]" value={{$tag->id}} class="form-check-input" id="exampleCheck{{$tag->id}}">
                                    <label style="margin-left:-12px;margin-top:2px;" class="form-check-label" for="exampleCheck{{$tag->id}}">{{$tag->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        @else
                            <p>No tags</p>
                    @endif
                </div>
            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="createQuestionBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Post">Post</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

