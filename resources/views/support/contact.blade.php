@extends('layouts.app')

@section('content')
    <!-- container -->
    <div class="container mt-3">
        <h1 class="text-center">F. A. Q</h1>
        <div class=" py-3 bg-white">
            {{--@for($i=0; $i<=$count; $i++ )--}}
            <div class="accordion row m-0 px-3" id="faq">
                @foreach($supports->where('parent_id', null)->chunk(2) as $i=> $chunk)
                    @foreach($chunk as $item)

                        <div class="col-md-10 offset-md-1">
                            <h4 class="fw-800 mb-2 text-center mt-2">{{$item->name}}</h4>
                            @foreach($supports->where('parent_id', $item->id) as $subSupport)
                                <div class="card border-0">
                                    <div class="card-header p-0 m-0 bg-transparent border-0" >
                                        <h5 class="mb-0">
                                            <button class="btn btn-link own-btn bg-gray border-orange b-1 support-item w-100 fw-600" type="button" data-toggle="collapse"
                                                    data-target="#collapse-{{$subSupport->id}}" data-id="{{$subSupport->id}}" aria-expanded="true"
                                                    aria-controls="collapse-{{$subSupport->id}}">
                                                {{$subSupport->name}}
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse-{{$subSupport->id}}" class="collapse" aria-labelledby="heading-{{$subSupport->id}}" data-parent="#faq">
                                        <div class="card-body fs-14">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="supports-container">
            @include('support.partials.support-description')
        </div>
    </div>
    </div>

@endsection

@section('js-scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.support-item', function (e) {
                var id = $(this).data('id');
                $.ajax({
                    url: '{{route('support.description')}}',
                    type: 'GET',
                    data: {id: id},
                    success: function (result) {
                        $('#collapse-'+id+" .card-body").html(result);
                        $('.support-content').css('display','block');
                    }
                })
            })
        })
    </script>
@endsection