<div  class="modal fade" id="createGroupHeaderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Create new customer group</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{-- below span hold form validation messages --}}
        <span id="create_group_header_form_result"></span>
        <form id="createGroupHeaderForm" method="POST">
          @csrf
          <div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Group name:</label>
                <div class="col-sm-9">
                    <input type="text" style="margin-top:5px;" name="groupName" class="form-control form-control-sm"  placeholder="Group name...">
                </div>
            </div>
          </div>
          <div style="text-align:right;margin-top:20px;">
            <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" id="createHeaderGroupBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
          </div>
        </form>  
      </div>
    </div>
  </div>
</div>
