@foreach ($profile->portfolios as $portfolio)
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12">
        <div class="protfolio-image">
            <div class="port-action pull-right">
                <span class="edit-port" data-url="{{route('edit.portfolio',['id'=>$portfolio->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></span>
                <span class="delete-port" data-url="{{route('delete.portfolio',['id'=>$portfolio->id]) }}"><i class="fa fa-trash-o" aria-hidden="true" ></i></span>
                <span class="hide-port" data-url="{{route('hide.portfolio',['id'=>$portfolio->id]) }}">
                <i class="fa {{$portfolio->show == 1 ? 'fa-eye' : 'fa-eye-slash'}}" aria-hidden="true" ></i>
            </span>
            </div>
            <img class="img-responsive"
                 src="{{Voyager::image($portfolio->image)}}" alt="">
            <a href="{{$portfolio->link??'#'}}"
               target="{{$portfolio->link?'_blank':'_self'}}"
               title="{{$portfolio->name}}">{{$portfolio->name}}</a>
        </div>
    </div>
@endforeach