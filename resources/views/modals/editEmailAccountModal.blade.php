<div  class="modal fade" id="editEmailAccountModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Edit Email Account</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="background-color: white;">
      <span id="edit_email_account_form_result"></span>
      <form id="edit_email_account_form" method="POST">
            @csrf
            <div>
                <input type = "hidden" id="account_id" name="account_id" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"/>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <small for="account_name">Account name</small>
                        <input type = "text" id="edit_account_name" name="account_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Account name..."/>
                    </div>
                    <div class="col-sm-6">
                        <small for="account_name">Mail Mailer</small>
                        <input type = "text" id="edit_mail_mailer" name="mail_mailer" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail mailer..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <small for="account_name">Mail Host</small>
                        <input type = "text" id="edit_mail_host" name="mail_host" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail host..."/>
                    </div>
                    <div class="col-sm-6">
                        <small for="account_name">Mail Port</small>
                        <input type = "text" id="edit_mail_port" name="mail_port" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail port..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <small for="account_name">Mail Username</small>
                        <input type = "text" id="edit_mail_username" name="mail_username" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail username..."/>
                    </div>
                    <div class="col-sm-6">
                        <small for="account_name">Mail Password</small>
                        <input type = "text" id="edit_mail_password" name="mail_password" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail password..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <small for="account_name">Mail Encryption</small>
                        <input type = "text" id="edit_mail_encryption" name="mail_encryption" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail encryption..."/>
                    </div>
                    <div class="col-sm-6">
                        <small for="account_name">Mail From Address</small>
                        <input type = "text" id="edit_mail_from_address" name="mail_from_address" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail from address..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <small for="account_name">Mail From Name</small>
                        <input type = "text" id="edit_mail_from_name" name="mail_from_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail from name..."/>
                    </div>
                    {{-- <div class="col-sm-6">
                        <small for="account_name">Mail Password</small>
                        <input type = "text" name="mail_from_address" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail from address..."/>
                    </div> --}}
                </div>
            </div>
           
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="editEmailAccountBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Update">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

