<div  class="modal fade" id="editEmailTemplateModal"   tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#006699;">
          <h5 class="modal-title" style="color:white;">Edit email template</h5>
          <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: white;">
        {{-- below span hold form validation messages --}}
        <span id="edit_email_template_form_result"></span>
        <form id="edit_email_template_form" method="POST">
              @csrf
              <div>
                <input type = "hidden" id="template_id" name="template_id" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"/>
                  <div class="form-group row">
                      <div class="col-sm-6">
                          <small>Template name</small>
                          <input type = "text" id="edit_template_name" name="template_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Template name..."/>
                      </div>
                      <div class="col-sm-6">
                          <small>Template ID</small>
                          <input type = "text" id="edit_template_id" name="edit_template_id" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Template ID..."/>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-6">
                            <small>Is active?</small>
                            <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;"
                                id="edit_is_active" name="is_active">
                                <option selected value="1">Yes</option>
                                <option value="0">No</option>
                            </select>

                            <small>Email Account</small>
                            <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;"
                                id="edit_email_account" name="email_account">
                            </select>
                        </div>
                      <div class="col-sm-6">
                          <small>Template Description</small>
                          <textarea class="form-control z-depth-1" id="edit_description" name="template_description" style="padding:10px;font-size:14px;border-radius:4px;" rows="5" placeholder="Email template description..."></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <small>Template Data</small>
                        <textarea class="form-control z-depth-1" id="edit_data" name="template_data" style="padding:10px;font-size:14px;border-radius:4px;" rows="20" placeholder="Email template description here ..."></textarea>
                      </div>
                  </div>
              </div>
              <div style="text-align:right;margin-top:10px;">
                  <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" id="editEmailTemplateBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Update">Update</button>
              </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  