
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
            <h4 class="card-title text-primary">Import customer</h4>
            <form action="/api/importCustomer" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col">
                    <select name = "group_id"class="form-control" style="padding:0px;">
                        <option selected disabled>Choose customer group</option>
                        @if(!$groups->isEmpty())
                            @foreach($groups as $group)
                                <option value={{$group->id}}>{{$group->name}}</option>
                            @endforeach
                        @else
                            <option>No group found, Please create one first.</option>
                        @endif
                    </select>
                    </div>
                    <div class="col" style="height:10px;">
                    <input type="file" name="mycsv" id="mycsv" class="form-control" style="padding:6px;"/>
                    </div>
                </div>
                <input value="Import" type="submit" class="btn btn-primary btn-block" style="margin-top:30px;width:100px;" />
            </form>
        </div>
    </div>
</div>
