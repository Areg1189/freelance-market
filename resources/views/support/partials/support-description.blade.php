<div class="box support-content" style="display: none">
    @isset($support)
    <div class="box-content">
        <div class="tab-content clearfix">
            <div role="tabpanel" class="tab-pane active" id="tab1">
                <div class="block-Successful">
                    <h4 class="title_block">{{$support->name}}</h4>
                    <div class="des">
                     {!! $support->description  !!}
                    </div>
                </div>
                {{--<div class="block-related">--}}
                    {{--<h4 class="title_block">Related questions</h4>--}}
                    {{--<ul class="bullet list-group">--}}
                        {{--@foreach($support->pivotSupports as $item)--}}
                            {{--<li role="presentation" >--}}
                                {{--<a href="#tab1"--}}
                                   {{--class="support-item"--}}
                                   {{--aria-controls="tab1"--}}
                                   {{--role="tab"--}}
                                   {{--data-toggle="tab"--}}
                                   {{--data-id="{{$item->id}}"--}}
                                {{-->--}}
                                    {{--{{$item->name}}--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div><!-- end tab1 -->
        </div><!-- end support-content -->
    </div><!-- end box-content -->
        @endisset
</div>