<div  class="modal fade" id="addFloorModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Add new floor</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="add_floor_form_result"></span>
      <form id="addFloorForm" method="POST">
            @csrf
            <input name="block_id" hidden value="{{$block->id}}" />
            <div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Block code:</label>
                    <div class="col-sm-8">
                        <input type = "text" disabled class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;" placeholder="{{$block->block_code}}" value="{{$block->block_code}}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Floor level:</label>
                    <div class="col-sm-8">
                        <input type = "text" name="floor_level" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Block code..."/>
                    </div>
                </div>
            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="addFloorBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Add">Add</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

