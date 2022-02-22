<div  class="modal fade" id="editTag"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Edit tag</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- below span hold form validation messages -->
      <span id="edit_tag_form_result"></span>
      <form id="edit_tag_form" method="POST">
            @csrf
            <div>
                <input type="hidden" name="id" id="itemId" />
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tag name En</label>
                    <div class="col-sm-8">
                        <input type = "text" id="name_en" name="name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tag name Am</label>
                    <div class="col-sm-8">
                        <input type = "text" id="name_am" name="name_am" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"/>
                    </div>
                </div>
            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="EditTagButton" style="width:80px;" class="btn btn-primary btn-sm" value="Edit Tag">Edit Tag</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

