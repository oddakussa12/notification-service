<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Unapproved questions</h4>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="createGroup">Ask question</button>
              </div>
        </div>
        @if(!$questions->isEmpty())
        <div class="table-responsive table-condensed">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> Question </th>
                <th> Categories </th>
                <th> Tags</th>
                <th> Asked at at</th>
                <th> Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($questions as $question)
              <tr>
                <td>{{$question->body}}</td>
                <td><label class="badge badge-info">{{$question->category->name}}</label></td>
                <td>@foreach($question->tags as $tag)
                    <label class="badge badge-primary">{{$tag->name}}</label>
                    @endforeach
                </td>
                <td>{{ Carbon\Carbon::parse($question->created_at)->format('D, M d, Y h:i A') }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary">Approve</button>
                        <button type="button" class="btn btn-outline-secondary">View</button>
                        <button type="button" class="btn btn-outline-secondary">Decline</button>
                    </div>  
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center" style="margin-top:30px;">
          <h5 class="text-danger">No unapproved questions</ht>
        </div>
        @endif
      </div>
    </div>
</div>
