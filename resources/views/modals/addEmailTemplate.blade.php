<div  class="modal fade" id="createEmailTemplateModal"   tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#006699;">
          <h5 class="modal-title" style="color:white;">Add email template</h5>
          <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: white;">
        {{-- below span hold form validation messages --}}
        <span id="create_email_template_form_result"></span>
        <form id="createEmailTemplateForm" method="POST">
              @csrf
              <div>
                  <div class="form-group row">
                      <div class="col-sm-6">
                          <small>Template name</small>
                          <input type = "text" name="template_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Template name..."/>
                      </div>
                      <div class="col-sm-6">
                          <small>Template ID</small>
                          <input type = "text" name="template_id" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Template ID..."/>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-6">
                            <small>Is active?</small>
                            <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;"
                                name="is_active">
                                <option selected value="1">Yes</option>
                                <option value="0">No</option>
                            </select>

                            <small>Email Account</small>
                            <select class="form-control" id="add_email_template_account_select" style="padding:5px;border-radius:5px;margin-top:5px;"
                                name="email_account_id">
                                
                            </select>
                        </div>
                      <div class="col-sm-6">
                          <small>Template Description</small>
                          <textarea class="form-control z-depth-1" name="description" style="padding:10px;font-size:14px;border-radius:4px;" rows="5" placeholder="Email template description..."></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <small>Template Data</small>
                        <textarea class="form-control z-depth-1" name="data" style="padding:10px;font-size:14px;border-radius:4px;" rows="20" placeholder="Email template description here ..."></textarea>
                      </div>
                  </div>
              </div>
              <div style="text-align:right;margin-top:10px;">
                  <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" id="createEmailTemplateBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
              </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  