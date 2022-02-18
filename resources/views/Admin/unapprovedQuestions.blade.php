@include('/modals/askQuestionModal')
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
              <button type="button" class="btn btn-inverse-primary btn-fw" id="askQuestion">Ask question</button>
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

<!-- script for ajax loading unapproved questions -->
<script>
    $(document).ready( function () {
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.unapprovedquestions') }}",
            "columns": [
                {data: 'body' },
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'created_at' },
                {data: 'action', name: 'action', orderable: false, searchable: false},
                
            ]
        });
    });
</script>

<!-- script to create new question -->
<script>
    $(document).ready(function(){
        $('#askQuestion').click(function(){
          $('#createQuestionModal').modal('show');
        });
        $('#createQuestionForm').on('submit', function(event){
          event.preventDefault();
          if($('#createQuestionBtn').val() == 'Post'){
              $.ajax({
                url:"{{ route('question.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createQuestionBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createQuestionBtn').html('Post'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_question_form_result').html(html);
                    }
                    if(data.success){
                        $('#createQuestionModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('unapprovedQuestions')}}',
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