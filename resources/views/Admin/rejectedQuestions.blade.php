
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Rejected questions</h4>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <!-- <button type="button" class="btn btn-inverse-primary btn-fw" id="askQuestion">Ask question</button> -->
              </div>
        </div>
        <!-- <div class="table-responsive table-condensed"> -->
          <table class="table table-hover" id="datatable">
            <thead>
              <tr>
                <th> Question </th>
                <th> Status </th>
                <th> Asked at</th>
                <th> Actions</th>
              </tr>
            </thead>
            <tbody>
    
            </tbody>
          </table>
        <!-- </div> -->
      </div>
    </div>
</div>

<!-- script for ajax loading rejected questions -->
<script>
    $(document).ready( function () {
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.rejectedQuestions') }}",
            "columns": [
                {data: 'body' },
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'created_at' },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
