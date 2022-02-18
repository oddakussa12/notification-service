<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" data-id="{{$question->id}}" class="btn btn-outline-primary">
        <i class="mdi mdi-eye"></i>
    </button>
    <button type="button"  data-id="{{$question->id}}" class="btn btn-outline-success">
        <i class="mdi mdi-checkbox-marked-circle-outline"></i>
    </button>
    <button type="button" data-id="{{$question->id}}" class="btn btn-outline-danger">
        <i class="mdi mdi-delete"></i>
    </button>
</div>