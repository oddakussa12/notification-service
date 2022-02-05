@include('/modals/addblockmodal')
<button id="siteIdHolder" value="{{$site->id}}" hidden></button>
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
                    <button type="button" class="btn btn-inverse-secondary btn-fw" id="backToSites">Back</button>
                    <button type="button" class="btn btn-inverse-primary btn-fw" id="addBlock">Add block</button>
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

<!-- script to back to sites from blocks page -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function displayDash(){
            $.ajax({
              url:'{{route('dash')}}',
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

        $('#backToSites').on('click',function(){
            displayDash();
        });
    });
</script>

<!-- script to create new block -->
<script>
    $(document).ready(function(){
        $('#addBlock').click(function(){
          $('#addBlockModal').modal('show');
        });
        $('#addBlockForm').on('submit', function(event){
          event.preventDefault();
          if($('#addBlockBtn').val() == 'Add'){
              $.ajax({
                url:"{{ route('storeBlock') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#addBlockBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#addBlockBtn').html('Add'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#add_block_form_result').html(html);
                    }
                    if(data.success){
                        var siteId = document.getElementById('siteIdHolder').value;
                        $('#addBlockModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'http://localhost:8000/siteblocks/'+siteId,
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
