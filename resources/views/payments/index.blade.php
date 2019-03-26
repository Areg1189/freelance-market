@extends('layouts.app')
@section('content')
    {{--<form action="https://demomoney.yandex.ru/eshop.xml" method="post">--}}
        {{--<!-- Обязательные поля -->--}}
        {{--<input name="shopId" value="151" type="hidden"/>--}}
        {{--<input name="scid" value="363" type="hidden"/>--}}
        {{--<input name="customerNumber" value="100500"/>--}}
        {{--<input name="sum" value="100">--}}
        {{--Способ оплаты:<br>--}}
        {{--<input name="paymentType" value="PC" type="radio">Оплата из кошелька в Яндекс.Деньгах<br>--}}
        {{--<input name="paymentType" value="AC" type="radio">Оплата с произвольной банковской карты<br>--}}
        {{--<input name="paymentType" value="GP" type="radio">Оплата наличными через кассы и терминалы<br><br>--}}
        {{--<input type="submit" value="Заплатить"/>--}}
    {{--</form>--}}
    {{--<iframe src="https://money.yandex.ru/quickpay/button-widget?targets=test&default-sum=500&button-text=12&yamoney-payment-type=on&button-size=m&button-color=orange&successURL=&quickpay=small&account=410015507362569&" width="184" height="36" frameborder="0" allowtransparency="true" scrolling="no"></iframe>--}}


@endsection
@section('js-scripts')
    <script src='https://oplata.qiwi.com/popup/v1.js'></script>
    <script>
    QiwiCheckout.createInvoice({
    publicKey: 'e041ea4ac6de3daaea90a2c1e4e8b4f6d184a15ddf1b381e7d1da0d3479ec6e8',
    amount: 1.23,
    phone: '37494418718',
    })
    .then(data => {
    //  data === {
    //    publicKey: '5nAq6abtyCz4tcDj89e5w7Y5i524LAFmzrsN6bQTQ3c******',
    //    amount: 1.23,
    //    phone: '79123456789',
    //  }
    })
    .catch(error => {
    //  error === {
    //      reason: "PAYMENT_FAILED"
    //  }
    })
    </script>
@endsection