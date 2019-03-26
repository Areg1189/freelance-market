@extends('layouts.app')

@section('content')
    <div id="columns" class="columns-container">
        <div class="bg-top"></div>
        <div class="warpper">
            <!-- container -->
            <div class="container">

                <table class="table">
                    <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Employer</th>
                        <th>Budget</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                    <tr id="invoice-{{$invoice->id}}">
                        <td>{{$invoice->job->title}}</td>
                        <td>{{$invoice->employer->first_name}}</td>
                        <td>{{$invoice->job->budget}}</td>
                        <td>
                            <button class="btn button btn-default cancel" data-id="{{$invoice->id}}">CANCEL</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    </div> <!-- end container -->
    </div><!-- end warpper -->
    <div class="bg-bottom"></div>
    </div><!--end columns-->

@stop
@section('script')
    @parent
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');

        //============================ CANCEL
        $('.cancel').click( function (event) {
            event.preventDefault();


            var id = $(this).data('id');
            var _this = $(this ,".cancel");
            $.ajax({
                type: 'POST',
                url: '{{route('paypal.invoice.cancel')}}/'+id,
                data: { _token: token } ,
                beforeSend: function() {
                    // setting a timeout
                    $('#invoice-'+id).after('<p class="info">Please waite...</p>');
                },
                success: function (data) {
//                    $('#invoice-'+id).remove();
                    _this.remove();
                    $('.info').remove();
                    if(data.success){
                        toastr.success(data.message);
                    }else{
                        toastr.warning(data.message);
                    }

                }
            });
        });
    </script>
@stop