@include('/modals/createAutoReply')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
            <div class="col-sm-6">
            <h4 class="card-title text-primary text-primary">Autoreply SMS Setting</h4>
            </div>
            <div class="col-sm-6" style="text-align:right;">
            @if(!$rules->isEmpty())
              <button type="button" class="btn btn-inverse-danger btn-fw">Delete all</button>
            @endif
            <button id="newrule" type="button" class="btn btn-inverse-primary btn-fw">New rule</button>
            </div>
      </div>
      @if(!$rules->isEmpty())
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Trigger Message</th>
                <th>Response message</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($rules as $rule)
                <tr>
                  <td>{{$rule->trigger}}</td>
                  <td>{{$rule->response}}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Edit</button>
                        <button type="button" class="btn btn-outline-secondary">Delete</button>
                    </div>  
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center" style="margin-top:30px;">
          <h5 class="text-danger">No auto reply rule defined yet</h5>
        </div>
      @endif
     
    </div>
  </div>
</div>

  <!-- script to create new auto reply rule -->
  <script>
    $(document).ready(function(){
       // show create contact modal
       $('#newrule').click(function(){
          $('#createAutoReplyModal').modal('show');
      });
       // implementation when submit button is clicked from create contact modal
      $('#createAutoReplyForm').on('submit', function(event){
          event.preventDefault();
          if($('#createAutoreplytBtn').val() == 'Create'){
              $.ajax({
                  url:"{{ route('storeautoreply') }}",
                  method:"POST",
                  data: new FormData(this),
                  contentType:false,
                  cache:false,
                  processData:false,
                  dataType:'json',
                  beforeSend: function()
                  {
                      $('#createAutoreplytBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                  },
                  success:function(data){
                      var html = '';
                      if(data.errors){
                          html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                          for(var count = 0; count<data.errors.length; count++){
                              html += '<p>' + data.errors[count] + '</p>';
                          }
                          html += '</div>';
                          $('#createAutoreplytBtn').html('Create'); 
                      }
                      if(data.success){
                          html = '<div class = "alert alert-success alert-block" style="height:30px;padding:2px;">'
                          + data.success + '<button type="button" class="close" data-dismiss="alert">x</button</div>';
                          // empty form field values  
                          $('#createAutoReplyForm')[0].reset();
                          $('#createAutoreplytBtn').html('Create');

                      }
                      // render error or success message in html variable to span element with id value form_result
                      $('#create_autoreply_form_result').html(html);
                  }
              })
          }
      });
    });
</script>