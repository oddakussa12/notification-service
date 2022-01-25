<div  class="modal fade"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="createRecordModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Create contact</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="form_result"></span>
      <form id="createRecordForm" method="POST">
        @csrf
        <div>
          <div class="form-group row">
              <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Target group::</label>
              <div class="col-sm-9">
                <select id="inputState" name="group_id" class="form-control form-control-sm" style="padding:5px;border-radius:5px;margin-top:5px;">
                    <option selected disabled>Choose target group (Optional)</option>
                    <option value="1">One</option>
                </select>
              </div>
          </div>
          <div class="form-group row">
              <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Phone number:</label>
              <div class="col-sm-9">
                <input type="number" style="margin-top:5px;" name="phone" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Start with 09">
              </div>
          </div>
        </div>
        <div style="text-align:right;margin-top:20px;">
            <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" id="createContactBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>
</div>
