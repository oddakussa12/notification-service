<div  class="modal fade" id="addEmailLanguage"   tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#006699;">
          <h5 class="modal-title" style="color:white;">Add email language</h5>
          <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: white;">
        {{-- below span hold form validation messages --}}
        <span id="create_email_language_form_result"></span>
        <form id="create_email_language_form" method="POST">
              @csrf
              <div>
                <input type="hidden" id="email_template_id" name="email_template_id" />
                  <div class="form-group row">
                      <div class="col-sm-12">
                          <small>Language code</small>
                          <input type = "text" name="language_code" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Template name..."/>
                      </div>
                  </div>
                  
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <small>Email body</small>
                        <textarea class="form-control z-depth-1" name="email_body" style="padding:10px;font-size:14px;border-radius:4px;" rows="30" placeholder="Email body ..."></textarea>
                      </div>
                  </div>
              </div>
              <div style="text-align:right;margin-top:10px;">
                  <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" id="createEmailLanguageBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
              </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  