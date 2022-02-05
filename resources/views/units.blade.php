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
                    <button type="button" class="btn btn-inverse-secondary btn-fw">Back</button>
                    <button type="button" class="btn btn-inverse-primary btn-fw">Add unit</button>
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


