<form role="form" method="post" action="{{route('profile.avatar.update')}}" data-lui-croppie-form>
    @csrf
    @method('PUT')

    {{--<div class="form-group text-center lui-croppie-initial-visible lui-croppie-uploading-visible lui-croppie-success-visible">--}}
        {{--<img data-lui-croppie-image src="{{ asset('storage/' . auth()->user()->avatar) }}">--}}
    {{--</div>--}}
    <div class="upload-demo-wrap lui-croppie-cropping-visible d-block">
        <div data-lui-croppie-viewport></div>
        {{--<div class="help-block text-center">Use the slider to zoom the image, drag/swipe the image to adjust.</div>--}}
        <div class="d-none sfbl text-center mb-4">
            <button type="submit" class="own-btn">
                <i class="fa fa-upload margin-r-5"></i>
                Crop and Upload
            </button>
            <button type="button" class="own-btn" data-lui-croppie-rotate-right>
                <i class="fa fa-rotate-left margin-r-5"></i>
                Rotate Left
            </button>
            <button type="button" class="own-btn" data-lui-croppie-rotate-left>
                <i class="fa fa-rotate-right margin-r-5"></i>
                Rotate Left
            </button>

        </div>

    </div>
    <div class="align-items-center justify-content-center d-flex  st_block">
        <label class="d-block w-50 fileInputOwn" for="file-input"> choose file</label>
        <span class="fileInputOwn-span d-block w-50">No choosen File</span>
        <input type="file" name="avatar" value="Choose an image" id="file-input" class="file-load w-50 d-none"
               accept="image/*"/>
    </div>



    <div class="form-group lui-croppie-uploading-visible">
        <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                 aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%"
                 data-lui-croppie-progress-bar>
                <span data-lui-croppie-progress-text>0%</span>
            </div>
        </div>
    </div>
</form>

