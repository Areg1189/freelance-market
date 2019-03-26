
<h5 class="modal-title text-center">Edit Portfolio</h5>

<form method="post" class="form-horizontal"
      enctype="multipart/form-data" data-action="{{route('update.portfolio',['id'=>$portfolio->id])}}" id="edit-port-form">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Change Picture<sup>*</sup></label>
        <input type="file" class="form-control" id="edit-file"
               name="edit_file" >
    </div>
    <div class="form-group">
        <label>Change Name<sup>*</sup></label>
        <input type="text" class="form-control" id="edit-name"
               name="edit_name" value="{{$portfolio->name}}">
    </div>
    <div class="form-group">
        <label>Change Link</label>
        <input type="text" class="form-control" id="edit-link"
               name="edit_link" value="{{$portfolio->link}}">
    </div>
    <div class="form-group">
        <label>Change Desceription</label>
        <textarea class="form-control"
                  id="edit-description"
                  name="edit_description"> {{$portfolio->description}}</textarea>
    </div>
    <button type="submit" class="btn btn-danger pull-right" id="edit-save">
        Save
    </button>
</form>