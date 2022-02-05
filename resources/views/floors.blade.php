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
                    <button type="button" class="btn btn-inverse-secondary btn-fw">Back</button>
                    <button type="button" class="btn btn-inverse-primary btn-fw">Add floor</button>
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