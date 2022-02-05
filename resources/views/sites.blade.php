<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row" style="padding-bottom:10px;">
                <div class="col-sm-4">
                <h4 class="card-title text-primary text-primary">Sites ({{$siteCount}})</h4>
                </div>
                <div class="col-sm-4">
                    @if(!$sites->isEmpty())
                        <input type="number" placeholder="Search site here" class="form-control form-control-sm" style="border-radius:5px;"/>
                    @endif
                </div>
                <div class="col-sm-4" style="text-align:right;">
                    <button type="button" class="btn btn-inverse-primary btn-fw">Create site</button>
                </div>
            </div>
            @if(!$sites->isEmpty())
            <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Site code</th>
                    <th>Total blocks</th>
                    <th>Total units</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sites as $site)
                    <tr>
                        <td>{{$site->name}}</td>
                        <td>{{$site->site_code}}</td>
                        <td>{{$site->blocks_count}}</td>
                        <td>1456</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button data-id="{{$site->id}}" type="button" class="btn btn-outline-secondary blocks">Blocks</button>
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
            <h5 class="text-danger">There are no sites</ht>
            </div>
            @endif
            <div style="margin-top:20px;">
                {!! $sites->links() !!}
            </div>
        </div>
        </div>
    </div>
</div>

<!-- fetch blocks in a site -->
<script>
    $(document).ready(function(){
        $('.blocks').on('click', function () {
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