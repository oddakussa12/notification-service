<div  class="modal fade" id="addInappNotificationLanguaModal"   tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#006699;">
          <h5 class="modal-title" style="color:white;">Add In-App Notification Language</h5>
          <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: white;">
        {{-- below span hold form validation messages --}}
        <span id="create_inapp_noti_lang_form_result"></span>
        <form id="createInappLanguageForm" method="POST">
              @csrf
              <div>
                 <input type="hidden" id="message_lang_id" name="notificationid" />
                 <div class="form-group row">
                    <div class="col-sm-12">
                        <small>Language code (Required)</small>
                        <input type = "text" name="language_code" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Language code..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <small>Message title (Required)</small>
                        <input type = "text" name="title" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Message title..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <small>Message body (Required)</small>
                        <textarea class="form-control z-depth-1" name="body" style="padding:10px;font-size:14px;border-radius:4px;" rows="2" placeholder="Message body ..."></textarea>
                    </div>
                </div>
              </div>
              <div style="text-align:right;margin-top:10px;">
                  <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" id="createInappLangBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
              </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  