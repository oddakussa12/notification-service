<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row" style="padding-bottom:10px;">
                <div class="col-sm-4">
                <h4 class="card-title text-primary text-primary">Blocks ({{$blockCount}})</h4>
                </div>
                <div class="col-sm-4">
                    @if(!$blocks->isEmpty())
                        <input type="number" placeholder="Search block here" class="form-control form-control-sm" style="border-radius:5px;"/>
                    @endif
                </div>
                <div class="col-sm-4" style="text-align:right;">
                    <button type="button" class="btn btn-inverse-secondary btn-fw">Back</button>
                    <button type="button" class="btn btn-inverse-primary btn-fw">Add block</button>
                </div>
            </div>
            @if(!$blocks->isEmpty())
            <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Block code</th>
                    <th>Total floors</th>
                    <th>Total units</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blocks as $block)
                    <tr>
                        <td>{{$block->block_code}}</td>
                        <td>{{$block->floors_count}}</td>
                        <td>435</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button data-id="{{$block->id}}" type="button" class="btn btn-outline-secondary floors">Floors</button>
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
            <h5 class="text-danger">There are no blocks in this site</ht>
            </div>
            @endif
            <div style="margin-top:20px;">
                {!! $blocks->links() !!}
            </div>
        </div>
        </div>
    </div>
</div>


<!-- fetch floors in a block -->
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