<div  class="modal fade" id="editPushNotificationLanguaModal"   tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#006699;">
          <h5 class="modal-title" style="color:white;">Edit Push Notification Language</h5>
          <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: white;">
        {{-- below span hold form validation messages --}}
        <span id="edit_push_noti_lang_form_result"></span>
        <form id="editPushLanguageForm" method="POST">
              @csrf
              <div>
                 <input type="hidden" id="edit_inapp_lang_id" name="edit_notificationid" />
                 <div class="form-group row">
                    <div class="col-sm-12">
                        <small>Language code (Required)</small>
                        <input type = "text" id="edit_language_code" name="edit_language_code" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Language code..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <small>Message title (Required)</small>
                        <input type = "text" id="push_title" name="edit_title" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Message title..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <small>Message body (Required)</small>
                        <textarea class="form-control z-depth-1" id="push_body" name="edit_body" style="padding:10px;font-size:14px;border-radius:4px;" rows="2" placeholder="Message body ..."></textarea>
                    </div>
                </div>
              </div>
              <div style="text-align:right;margin-top:10px;">
                  <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" id="editPushLangBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Update">Update</button>
              </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  