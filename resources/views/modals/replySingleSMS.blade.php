<div  class="modal fade"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="replySingleSMS">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Reply SMS</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="form_result"></span>
      <form id="createRecordForm" method="POST">
        @csrf
        <div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Phone number:</label>
                <div class="col-sm-9">
                    <input type="number" disabled style="margin-top:5px;" name="phone" class="form-control form-control-sm" id="colFormLabelSm" placeholder="0900048949">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group shadow-textarea" style="margin-top:10px;">
                        <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" style="padding:10px;font-size:14px;border-radius:4px;" rows="6" placeholder="Write your message ..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align:right;margin-top:20px;">
            <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" id="createContactBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Send">Send</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>
</div>
