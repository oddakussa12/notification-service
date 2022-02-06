<div  class="modal fade" id="addUnitModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Add new unit</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="add_unit_form_result"></span>
      <form id="addUnitForm" method="POST">
            @csrf
            <input name="floor_id" hidden value="{{$floor->id}}" />
            <div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Floor level:</label>
                    <div class="col-sm-8">
                        <input type = "text" disabled class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;" placeholder="{{$floor->level}}" value="{{$floor->level}}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Unit code:</label>
                    <div class="col-sm-8">
                        <input type = "text" name="unit_code" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Unit code..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">No of bedrooms:</label>
                    <div class="col-sm-8">
                        <input type="number" name="bedrooms" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Number of bedrooms..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Direction:</label>
                    <div class="col-sm-8">
                        <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;"
                            name="direction">
                            <option selected disabled>Choose direction</option>
                            <option value="North">North</option>
                            <option value="South">South</option>
                            <option value="East">East</option>
                            <option value="West">West</option>
                        </select>
                    </div>
                </div>

            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="addUnitBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Add">Add</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

