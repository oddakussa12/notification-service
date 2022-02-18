<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 15px;">
        <form method="POST" id="delete_form">
            @csrf
            <div class="modal-body">
                <input type="hidden" id="deleteitemid" value="" />
                
                <div class="row">
                    <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                </div>
                <p class="font-weight-bold mb-2" style="font-family: Arial, Helvetica, sans-serif;"> Are you sure you wanna delete
                    <strong id="deleteitemname"></strong> 
                </p>
                <p class="text-muted" style="font-family: Arial, Helvetica, sans-serif;"> This will also delete all items in this sub category.</p>
                
                <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                    <div class="row justify-content-end no-gutters">
                        <div class="col-auto" style="padding-right:2%;"><button type="button" class="btn btn-light btn-sm text-muted" data-dismiss="modal">Cancel</button></div>
                        <div class="col-auto"><button type="submit" class="btn btn-danger btn-sm px-4">Delete</button></div>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>