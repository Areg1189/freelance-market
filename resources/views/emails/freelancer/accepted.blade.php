<table style="text-align: center;" width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr align="center">
        <td style="padding: 30px 0;width: 100%;background-color: #546979;">
            {{}}
        </td>
    </tr>
</table>
<table style="text-align: center;" width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td style="color: #000;font-size: 20px;text-transform: uppercase;width: 30%; padding-right: 30px">
            <a href='{{asset('gift-card-qr/'.$png)}}' target='_blank'>
                <img src="{{asset('gift-card-qr/'.$png)}}" width="200px"
                     style="display: inline-block;-webkit-box-shadow: 5px 5px 10px #dcdcdc;-moz-box-shadow: 5px 5px 10px #dcdcdc;box-shadow: 5px 5px 10px #dcdcdc;"/>
            </a>
            <div style="padding-top: 15px ;"><b style="color: #000;font-size: 27px;">${{$details->amount}}</b></div>
        </td>

        <td style="color: #000;font-size: 20px;width: 60%;">
            @if($details->message)
                <div><p style="color: #cccccc;"><b>Note</b></p></div>
                <div style="margin-bottom: 25px;border-bottom: 1px solid #e6e6e6"><p
                            style="font-size: 13px;color: #000000;">
                        {{$details->message }}
                    </p>
                </div>
            @endif
            {{--FROM--}}
            @if( $details->sender_name || $details->sender_email)
                <div><p style="color: #cccccc;"><b>From</b></p></div>
                <div style="margin-bottom: 25px;border-bottom: 1px solid #e6e6e6">
                    <p style="font-size: 13px;color: #000000;">{!! $details->sender_name ? '<b>Name  :</b> '. $details->sender_name :'' !!} </p>
                    <p style="font-size: 13px;color: #000000;">{!! $details->sender_email ? '<b>E-mail  : </b>'. $details->sender_email :'' !!} </p>

                </div>
            @endif
        </td>
    </tr>
</table>



















