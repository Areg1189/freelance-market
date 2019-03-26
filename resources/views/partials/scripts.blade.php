<script>
    var authId = '{{Auth::check() ? auth()->id() : false}}',
    userId = '{{auth()->id()??0}}'

</script>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/all.js')}}"></script>


@toastr_js
@toastr_render


@if (Auth::check())
    <script type="text/javascript">

        var withId = '{{$withUser->id??false}}',
                messagesCount = '{{isset($messages)?count($messages):false}}' ;
        pusher = new Pusher('{{config('messenger.pusher.app_key')}}', {
            cluster: '{{config('messenger.pusher.options.cluster')}}'
        });
    </script>
@endif

<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/messenger-chat.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<script>
    $(document).ready(function () {
        $('#skills').select2({
            placeholder: "Eg: UI/UX Design...",
            maximumSelectionLength: 6,
            minimumInputLength: 2,
            ajax: {
                url: '{{route('skills.find')}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        skill: $.trim(params.term),
                        value: $.trim(params.id),
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    })
</script>




