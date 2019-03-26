@extends('layouts.app')

@section('css-styles')
    <link rel="stylesheet" href="{{asset('css/star-rating-svg.css')}}">
@endsection

@section('content')
    @if(!$feedback->feedback && !$feedback->star)
        <div class="text-center">
            <span>Overall result</span>
            <div class="result"></div>
        </div>


        <form action="{{route('contract.feedback.store', ['contract' => $contract, 'recipient' => $recipient])}}"
              method="POST">
            @csrf
            <div class="form-group">
                <div class="">
                    <span>Rate the availability of freelancer</span>
                    <div class="my-rating"></div>
                </div>
                <div class="">
                    <span>Rate the humanity of a freelancer</span>
                    <div class="my-rating"></div>
                </div>
                <div class="">
                    <span>Rate the professionalism of a freelancer</span>
                    <div class="my-rating"></div>
                </div>
                <div class="">
                    <span>Rate link freelancer</span>
                    <div class="my-rating"></div>
                </div>
                <div class="">
                    <span>Rate link freelancer</span>
                    <div class="my-rating"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="feedback">Write a feedback</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
            </div>
            <input type="hidden" name="star" id="star">
            <button type="submit" class="btn btn-success">
                Save
            </button>
        </form>
    @else
        <div class="text-center">
            <span>Your mark</span>
            <div class="result"></div>
        </div>
        <div class="text-center">
            <p>{{$feedback->feedback}}</p>
        </div>
    @endif
@stop



@section('script')

    @parent
    <script src="{{asset('js/jquery.star-rating-svg.js')}}"></script>
    <script>
        var result = $('.result').starRating({
            readOnly: true,
            useFullStars: false,
            initialRating: '{{(int) $feedback->star??0}}',
        });

        var average_array = [];
        $(".my-rating").starRating({
            starSize: 25,
            totalStars: 5,
            initialRating: '{{$recipient == 'freelancer' ? $contract->freelancer->workHistories()->avg('star') : 0 }}',
            disableAfterRate: false,
            strokeColor: '#894A00',
            strokeWidth: 10,
            callback: function (currentRating, $el) {
                average_array[$el.index('.my-rating')] = currentRating;
                var average_sum = average_array.reduce(getSum);
                average = parseFloat(average_sum / $(".my-rating").length);
                result.starRating('setRating', average, true)
                $('#star').val(average);
            }
        });
        function getSum(total, num) {
            return total + num;
        }


    </script>
@stop