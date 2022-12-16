<div  class="modal fade" id="addInappNotificationModal"   tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#006699;">
          <h5 class="modal-title" style="color:white;">Add In-App Notification</h5>
          <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: white;">
        {{-- below span hold form validation messages --}}
        <span id="create_inapp_noti_form_result"></span>
        <form id="createInappNotificationForm" method="POST">
              @csrf
              <div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                          <small>Notification name</small>
                          <input type = "text" name="title" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Notification name..."/>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <small>Notification description (Optional)</b></small>
                        <textarea class="form-control z-depth-1" name="description" style="padding:10px;font-size:14px;border-radius:4px;" rows="2" placeholder="Notification description ..."></textarea>
                      </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                        <small>Message title in <b>English</b> (Required)</small>
                        <input type = "text" name="en_title" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Message title..."/>
                    </div>
                </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <small>Message body in <b>English</b> (Required)</small>
                      <textarea class="form-control z-depth-1" name="en_body" style="padding:10px;font-size:14px;border-radius:4px;" rows="2" placeholder="Message body ..."></textarea>
                    </div>
                  </div>
              </div>
              <div style="text-align:right;margin-top:10px;">
                  <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" id="createInappNotificationBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
              </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  