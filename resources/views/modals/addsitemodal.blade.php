<div  class="modal fade" id="createSiteModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Creating new site</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="add_site_form_result"></span>
      <form id="addSiteForm" method="POST">
            @csrf
            <div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Site name:</label>
                    <div class="col-sm-8">
                        <input type = "text" name="site_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Site name..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Site code:</label>
                    <div class="col-sm-8">
                        <input type = "text" name="site_code" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Site code..."/>
                    </div>
                </div>
            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="createSiteBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

