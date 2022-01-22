<div  class="modal fade" id="createScheduleModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Create schedule</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{-- below span hold form validation messages --}}
      <span id="create_schedule_form_result"></span>
      <form id="createScheduleForm" method="POST">
            @csrf
            <div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Schedule name:</label>
                    <div class="col-sm-8">
                        <input type = "text" name="schedule_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="Schedule name..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Target group:</label>
                    <div class="col-sm-8">
                        <select class="form-control" style="padding:5px;border-radius:5px;margin-top:5px;"
                            name="group_ids">
                            <option selected disabled>Choose target group</option>
                            @if(!$groups->isEmpty())
                            @foreach($groups as $group)
                                <option value={{$group->id}}>{{$group->name}}</option>
                            @endforeach
                            @else
                                <option disabled>No group found, Please create one first.</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Schedule for:</label>
                    <div class="col-sm-8">
                        <input type="datetime-local" class="form-control" style="paddgin:5px;margin-top:5px;border-radius:5px;"
                            name="schedule_time">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="form-group shadow-textarea" style="margin-top:10px;">
                            <textarea class="form-control z-depth-1" name="schedule_message" style="padding:10px;font-size:14px;border-radius:4px;" rows="6" placeholder="Write your message ..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="createScheduleBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Schedule">Schedule</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

