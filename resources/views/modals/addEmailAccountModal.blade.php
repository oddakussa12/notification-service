<div  class="modal fade" id="createEmailAccountModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Add email account</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="background-color: white;">
      {{-- below span hold form validation messages --}}
      <span id="create_email_account_form_result"></span>
      <form id="createEmailAccountForm" method="POST">
            @csrf
            <div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <small for="account_name">Account name</small>
                        <input type = "text" name="account_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Account name..."/>
                    </div>
                    <div class="col-sm-6">
                        <small for="account_name">Mail Mailer</small>
                        <input type = "text" name="mail_mailer" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail mailer..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <small for="account_name">Mail Host</small>
                        <input type = "text" name="mail_host" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail host..."/>
                    </div>
                    <div class="col-sm-6">
                        <small for="account_name">Mail Port</small>
                        <input type = "text" name="mail_port" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail port..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <small for="account_name">Mail Username</small>
                        <input type = "text" name="mail_username" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail username..."/>
                    </div>
                    <div class="col-sm-6">
                        <small for="account_name">Mail Password</small>
                        <input type = "text" name="mail_password" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail password..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <small for="account_name">Mail Encryption</small>
                        <input type = "text" name="mail_encryption" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail encryption..."/>
                    </div>
                    <div class="col-sm-6">
                        <small for="account_name">Mail From Address</small>
                        <input type = "text" name="mail_from_address" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail from address..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <small for="account_name">Mail From Name</small>
                        <input type = "text" name="mail_from_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail from name..."/>
                    </div>
                    {{-- <div class="col-sm-6">
                        <small for="account_name">Mail Password</small>
                        <input type = "text" name="mail_from_address" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Mail from address..."/>
                    </div> --}}
                </div>
            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="createEmailAccountBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

