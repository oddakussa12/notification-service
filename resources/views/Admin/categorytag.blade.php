<div class="row">
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="row" style="padding-bottom:10px;">
            <div class="col-sm-6">
                <h4 class="card-title">Forum categories</h4>
            </div>
            <div class="col-sm-6" style="text-align:right;">
                <button class="btn btn-outline-primary">Add category</button>
            </div>
          </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name EN</th>
                <th>Name AM</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @if(!$categories->isEmpty())
                @foreach($categories as $fcategory)
                    <tr>
                        <td>{{$fcategory->name}}</td>
                        <td>{{$fcategory->name_am}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="mdi mdi-lead-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="text-center text-danger">
                        <td colspan="4">No content!</td>
                    </tr>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="row" style="padding-bottom:10px;">
            <div class="col-sm-6">
                <h4 class="card-title">Blog categories</h4>
            </div>
            <div class="col-sm-6" style="text-align:right;">
                <button class="btn btn-outline-primary">Add category</button>
            </div>
          </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name EN</th>
                <th>Name AM</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @if(!$blogCategories->isEmpty())
                    @foreach($blogCategories as $bcategory)
                        <tr>
                            <td>{{$bcategory->name}}</td>
                            <td>{{$bcategory->name_am}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="mdi mdi-lead-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr class="text-center text-danger">
                        <td colspan="4">No content!</td>
                    </tr>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="row" style="padding-bottom:10px;">
            <div class="col-sm-6">
                <h4 class="card-title">Tags</h4>
            </div>
            <div class="col-sm-6" style="text-align:right;">
                <button class="btn btn-outline-primary">Add tag</button>
            </div>
          </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name EN</th>
                <th>Name AM</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @if(!$tags->isEmpty())
                @foreach($tags as $tag)
                    <tr>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->name_am}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="mdi mdi-lead-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="text-center text-danger">
                        <td colspan="4">No content!</td>
                    </tr>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>