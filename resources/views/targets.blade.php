<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Customers group</h4>
              </div>
              <div class="col-sm-4">
                <input type="text" placeholder="Search group" class="form-control form-control-sm" style="border-radius:5px;"/>
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw createGroup">New group</button>
              </div>
        </div>
        <div class="table-responsive table-condensed">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> Avatar </th>
                <th> Group name </th>
                <th> Total Customers</th>
                <th> Created at</th>
                <th> Updated at</th>
                <th> Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="py-1">
                  <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> 
                </td>
                <td> Students </td>
                <td>250000 </td>
                <td> Junly, 13, [02:33] </td>
                <td> Junly, 13, [02:56] </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Export</button>
                        <button type="button" class="btn btn-outline-secondary">Edit</button>
                        <button type="button" class="btn btn-outline-secondary">Delete</button>
                        <button type="button" class="btn btn-outline-secondary">SMS</button>
                    </div>  
                </td>
              </tr>
              <tr>
                <td class="py-1">
                  <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> 
                </td>
                <td> Teachers </td>
                <td>250000 </td>
                <td> Junly, 13, [02:33] </td>
                <td> Junly, 13, [02:56] </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Export</button>
                        <button type="button" class="btn btn-outline-secondary">Edit</button>
                        <button type="button" class="btn btn-outline-secondary">Delete</button>
                        <button type="button" class="btn btn-outline-secondary">SMS</button>
                    </div>  
                </td>
              </tr>
              <tr>
                <td class="py-1">
                  <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> 
                </td>
                <td> Employees </td>
                <td>230300 </td>
                <td> Junly, 13, [02:33] </td>
                <td> Junly, 13, [02:56] </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Export</button>
                        <button type="button" class="btn btn-outline-secondary">Edit</button>
                        <button type="button" class="btn btn-outline-secondary">Delete</button>
                        <button type="button" class="btn btn-outline-secondary">SMS</button>
                    </div>  
                </td>
              </tr>
              <tr>
                <td class="py-1">
                  <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> 
                </td>
                <td> Merchants </td>
                <td>120300 </td>
                <td> Junly, 13, [02:33] </td>
                <td> Junly, 13, [02:56] </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Export</button>
                        <button type="button" class="btn btn-outline-secondary">Edit</button>
                        <button type="button" class="btn btn-outline-secondary">Delete</button>
                        <button type="button" class="btn btn-outline-secondary">SMS</button>
                    </div>  
                </td>
              </tr>
              <tr>
                <td class="py-1">
                  <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> 
                </td>
                <td> Drivers </td>
                <td>10300 </td>
                <td> Junly, 13, [02:33] </td>
                <td> Junly, 13, [02:56] </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Export</button>
                        <button type="button" class="btn btn-outline-secondary">Edit</button>
                        <button type="button" class="btn btn-outline-secondary">Delete</button>
                        <button type="button" class="btn btn-outline-secondary">SMS</button>
                    </div>  
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- script to create group -->
<script>
    $(document).ready(function(){
       // show create contact modal
       $('.createGroup').click(function(){
          $('#createGroupModal').modal('show');
      });
       // implementation when send button is clicked from send single sms modal
      // $('#createRecordForm').on('submit', function(event){
      //     event.preventDefault();
      //     if($('#createContactBtn').val() == 'Create'){
      //         $.ajax({
      //             url:"{{ route('api.createCustomer') }}",
      //             method:"POST",
      //             data: new FormData(this),
      //             contentType:false,
      //             cache:false,
      //             processData:false,
      //             dataType:'json',
      //             beforeSend: function()
      //             {
      //                 $('#createContactBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
      //             },
      //             success:function(data){
      //                 var html = '';
      //                 if(data.errors){
      //                     html = '<div class="alert alert-danger alert-block" style="height:30px;padding:2px;">';
      //                     for(var count = 0; count<data.errors.length; count++){
      //                         html += '<p>' + data.errors[count] + '</p>';
      //                     }
      //                     html += '</div>';
      //                     $('#createContactBtn').html('Create'); 
      //                 }
      //                 if(data.success){
      //                     html = '<div class = "alert alert-success alert-block" style="height:30px;padding:2px;">'
      //                     + data.success + '<button type="button" class="close" data-dismiss="alert">x</button</div>';
      //                     // empty form field values  
      //                     $('#createRecordForm')[0].reset();
      //                     $('#createContactBtn').html('Create');

      //                 }
      //                 // render error or success message in html variable to span element with id value form_result
      //                 $('#form_result').html(html);
      //             }
      //         })
      //     }
      // });
    });
</script>
