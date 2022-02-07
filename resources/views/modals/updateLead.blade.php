<div  class="modal fade"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="updateLeadModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Update Lead</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="update_lead_form_result"></span>
      <form id="updateLeadForm" method="POST">
        @csrf
        <input type = "hidden"name="lead_id" id="lead_idd" />
        <div>
          <div class="form-group row">
              <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm">Prospect name:</label>
              <div class="col-sm-9">
                <input type="text" style="margin-top:5px;" id="update_name" name="name" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Prospect name">
              </div>
          </div>

          <div class="form-group row">
              <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Phone number:</label>
              <div class="col-sm-9">
                <div class="input-group input-group-sm mb-3" style="margin-top:5px;">
                  <div class="input-group-prepend" style="height:28px;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">+251</span>
                  </div>
                  <input type="number" class="form-control" id="update_phone"  name="phone" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Start with 9">
                </div>
              </div>
          </div>
          <div class="form-group row">
              <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Phone number:</label>
              <div class="col-sm-9">
                    <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;"
                        name="status" id="update_status">
                        <option selected disabled>Update status</option>
                        <option value="Prospecting">Prospecting</option>
                        <option value="Office invitation">Office invitation</option>
                        <option value="Site visit">Site visit</option>
                        <option value="Reservation">Reservation</option>
                        <option value="Payment made">Payment made</option>
                    </select>
              </div>
          </div>
        </div>
        <div style="text-align:right;margin-top:20px;">
            <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" id="updateLeadBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Update">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
