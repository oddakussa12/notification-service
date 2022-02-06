@include('/modals/addfloormodal')
<button id="blockIdHolder" value="{{$block->id}}" hidden></button>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row" style="padding-bottom:10px;">
                <div class="col-sm-4">
                <h4 class="card-title text-primary text-primary">Floors ({{$floorCount}})</h4>
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-4" style="text-align:right;">
                    <button type="button" class="btn btn-inverse-secondary btn-fw" id="backToBlock" data-id="{{$site->id}}">Back</button>
                    <button type="button" class="btn btn-inverse-primary btn-fw" id="addFloor" >Add floor</button>
                </div>
            </div>
            @if(!$floors->isEmpty())
            <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Floor level</th>
                    <th>Number of units</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($floors as $floor)
                    <tr>
                        <td>{{$floor->level}}</td>
                        <td>{{$floor->units_count}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" data-id="{{$floor->id}}" class="btn btn-outline-secondary units">Units</button>
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
            <h5 class="text-danger">There are no floors in this block</ht>
            </div>
            @endif
        </div>
        </div>
    </div>
</div>



<!-- fetch units in a floor -->
<script>
    $(document).ready(function(){
        $('.units').on('click', function () {
            fetchUnits($(this).data('id'));
        });
        function fetchUnits(floorId){
            $.ajax({
                url:'http://localhost:8000/floorunits/'+floorId,
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

<!-- script to create new floor -->
<script>
    $(document).ready(function(){
        $('#addFloor').click(function(){
          $('#addFloorModal').modal('show');
        });
        $('#addFloorForm').on('submit', function(event){
          event.preventDefault();
          if($('#addFloorBtn').val() == 'Add'){
              $.ajax({
                url:"{{ route('storeFloor') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#addFloorBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#addFloorBtn').html('Add'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#add_floor_form_result').html(html);
                    }
                    if(data.success){
                        var blockId = document.getElementById('blockIdHolder').value;
                        $('#addFloorModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'http://localhost:8000/blockfloors/'+blockId,
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


<script>
    $(document).ready(function(){
        $('#backToBlock').on('click', function () {
            fetchBloks($(this).data('id'));
        });
        function fetchBloks(siteId){
            $.ajax({
                url:'http://localhost:8000/siteblocks/'+siteId,
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

<!-- script for back to block-->
<script>
    $(document).ready(function(){
        $('.floors').on('click', function () {
            fetchBloks($(this).data('id'));
        });
        function fetchBloks(blockId){
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