@foreach ($files as $file)
    <div class="col-md-2">
        <div class="dz-image img_block">
            <img data-dz-thumbnail=""
                 src="{{asset('images/icon/file.png')}}" width="120">
        </div>

        <div class="dz-details onblur text-center">
            <div class="dz-size">
                <span data-dz-size="">
                    <strong>{{bytesToHuman($file->filesize)}}</strong>
                </span>
            </div>
            <div class="dz-filename">
                <span data-dz-name="">{{$file->group??$file->filename}}</span>
            </div>
            <div>
                <a href="{{$file->getTemporaryUrl(now()->addDay(1))}}"
                   target="_blank">
                    <i class="fa fa-download"></i>
                </a>
            </div>
        </div>
    </div>
@endforeach