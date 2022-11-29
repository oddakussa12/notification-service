<div  class="modal fade" id="editSMSmessageModal"   tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#006699;">
          <h5 class="modal-title" style="color:white;">Edit SMS Message</h5>
          <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: white;">
        {{-- below span hold form validation messages --}}
        <span id="edit_sms_message_form_result"></span>
        <form id="edit_sms_message_form" method="POST">
              @csrf
              <div>
                    <input type="hidden" id="message_id" name="message_id" />
                  <div class="form-group row">
                      <div class="col-sm-12">
                          <small>Message name</small>
                          <input type = "text" id="message_name" name="message_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Template name..."/>
                      </div>
                  </div>
              </div>
              <div style="text-align:right;margin-top:10px;">
                  <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" id="editSMSmessageBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Update">Update</button>
              </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  