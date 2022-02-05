<div  class="modal fade" id="createAutoReplyModal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Create new auto reply rule</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="create_autoreply_form_result"></span>
      <form id="createAutoReplyForm" method="POST">
        @csrf
        <div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group shadow-textarea" style="margin-top:10px;">
                        <textarea class="form-control z-depth-1" name="triggerMessage" style="padding:10px;font-size:14px;border-radius:4px;" rows="3" placeholder="Trigger message"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group shadow-textarea" style="margin-top:10px;">
                        <textarea class="form-control z-depth-1" name="responseMessage" style="padding:10px;font-size:14px;border-radius:4px;" rows="6" placeholder="Auto reply response message"></textarea>
                    </div>
                </div>
            </div>
          
        </div>
        <div style="text-align:right;margin-top:20px;">
            <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" id="createAutoreplytBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>
</div>
