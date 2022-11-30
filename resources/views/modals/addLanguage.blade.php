<div  class="modal fade" id="createSMSmessageLanguageModal"   tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#006699;">
          <h5 class="modal-title" style="color:white;">Add SMS Language</h5>
          <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: white;">
        {{-- below span hold form validation messages --}}
        <span id="create_sms_lang_form_result"></span>
        <form id="createSMSLanguageForm" method="POST">
              @csrf
              <div>
                    <input type="hidden" id="message_lang_id" name="message_id" />
                  <div class="form-group row">
                      <div class="col-sm-12">
                          <small>Language code</small>
                          <input type = "text" name="language_code" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Template name..."/>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <small>Message body</small>
                        <textarea class="form-control z-depth-1" name="message_body" style="padding:10px;font-size:14px;border-radius:4px;" rows="2" placeholder="Message in English language ..."></textarea>
                      </div>
                  </div>
              </div>
              <div style="text-align:right;margin-top:10px;">
                  <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" id="createSMSmessageLanguageBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
              </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  