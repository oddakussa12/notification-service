@include('/modals/addunitmodal')
<button id="floorIdHolder" value="{{$floor->id}}" hidden></button>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row" style="padding-bottom:10px;">
                <div class="col-sm-4">
                <h4 class="card-title text-primary text-primary">Units ({{$unitCount}})</h4>
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-4" style="text-align:right;">
                    <button type="button" class="btn btn-inverse-secondary btn-fw" id="backToFloor" data-id="{{$block->id}}" >Back</button>
                    <button type="button" class="btn btn-inverse-primary btn-fw" id="addUnit">Add unit</button>
                </div>
            </div>
            @if(!$units->isEmpty())
            <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Unit code</th>
                        <th>Status</th>
                        <th>Number of bedrooms</th>
                        <th>Direction</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($units as $unit)
                    <tr>
                        <td>{{$unit->unit_code}}</td>
                        <td>{{$unit->status}}</td>
                        <td>{{$unit->bedrooms}}</td>
                        <td>{{$unit->direction}}</td>
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
            <h5 class="text-danger">There are no units in this floor</ht>
            </div>
            @endif
        </div>
        </div>
    </div>
</div>

<!-- script to create new unit -->
<script>
    $(document).ready(function(){
        $('#addUnit').click(function(){
          $('#addUnitModal').modal('show');
        });
        $('#addUnitForm').on('submit', function(event){
          event.preventDefault();
          if($('#addUnitBtn').val() == 'Add'){
              $.ajax({
                url:"{{ route('storeUnit') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#addUnitBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#addUnitBtn').html('Add'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#add_unit_form_result').html(html);
                    }
                    if(data.success){
                        var floorId = document.getElementById('floorIdHolder').value;
                        $('#addUnitModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'http://localhost:8000/floorunits/'+floorId,
                                cache: false,
                                type:'GET',
                                beforeSend: function()
                                {  
                                    $("#loading-overlay").show();
                                },
                                success:function(data){
                                    $("#odda").html(data);
                                    $("#loading-overlay").hide();
                                }
                            });
                        }
                    }
                },
              })
            }
        });
    });
</script>

<!-- script for back to floor -->
<script>
    $(document).ready(function(){
        $('#backToFloor').on('click', function () {
            fetchFloors($(this).data('id'));
        });
        function fetchFloors(blockId){
            $.ajax({
                url:'http://localhost:8000/blockfloors/'+blockId,
                cache:false,
                method:'GET',
                beforeSend: function()
                {
                    $("#loading-overlay").show();
                },
                success:function(data){
                    $('#odda').empty();
                    $('#odda').append(data);
                    $("#loading-overlay").hide();
                }
            });
        }
    });
</script>
