
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
            <h4 class="card-title">Import customer</h4>
            <form action="/api/importCustomer" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- <input type="file" name="mycsv" id="mycsv" class="form-control"/>
                <input value="Upload" type="submit" class="btn btn-success btn-block" style="margin-top:30px;width:100px;" /> -->
               
                <div class="form-row">
                    <div class="col">
                    <select id="inputState" class="form-control" style="padding:0px;">
                        <option selected>Choose customer group</option>
                        <option>...</option>
                    </select>
                    </div>
                    <div class="col" style="height:10px;">
                    <input type="file" name="mycsv" id="mycsv" class="form-control" style="padding:6px;"/>
                        <!-- <div class="custom-file">
                            <input type="file" name="mycsv" id="mycsv" class="custom-file-input">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div> -->
                    </div>
                </div>
                <input value="Import" type="submit" class="btn btn-primary btn-block" style="margin-top:30px;width:100px;" />
            </form>
           
        </div>
    </div>
</div>
