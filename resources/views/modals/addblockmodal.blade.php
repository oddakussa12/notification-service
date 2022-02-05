<div  class="modal fade" id="addBlockModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Add new block</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="add_block_form_result"></span>
      <form id="addBlockForm" method="POST">
            @csrf
            <input name="site_id" hidden value="{{$site->id}}" />
            <div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Site name:</label>
                    <div class="col-sm-8">
                        <input type = "text" disabled class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;" placeholder="{{$site->name}}" value="{{$site->name}}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Block direction:</label>
                    <div class="col-sm-8">
                        <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;"
                                name="direction">
                            <option selected disabled>Choose direction of the block</option>
                                <option value="North">North</option>
                                <option value="South">South</option>
                                <option value="East">East</option>
                                <option value="West">West</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Block code:</label>
                    <div class="col-sm-8">
                        <input type = "text" name="block_code" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Block code..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="form-group shadow-textarea" style="margin-top:10px;">
                            <textarea class="form-control z-depth-1" name="description" style="padding:10px;font-size:14px;border-radius:4px;" rows="6" placeholder="Write description ..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="addBlockBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Add">Add</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

