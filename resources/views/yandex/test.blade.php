<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Платёжна форма Магазина</title>
</head>
<body>
<form action="https://demomoney.yandex.ru/eshop.xml" method="post" target="_blank">
    <!-- Обязательные поля -->
    <input name="shopId" value="151" type="hidden"/>
    <input name="shopArticleId" value="151" type="hidden"/>
    <input name="scid" value="59816" type="hidden"/>
    <input name="sum" value="300" type="hidden">
    <input name="customerNumber" value="100500" type="hidden"/>
    <select id="paymentType" name="paymentType">
        <option value="PC">Со счета в Яндекс.Деньгах</option>
        <option value="AC">С банковской карты</option>
    </select>
    <input type="hidden" name="rebillingOn" value="true">
    <input type="submit" value="Заплатить"/>
</form>
<br>

<form action="mws/listOrders.php" method="post" target="result">
    <input type="submit" value="Получить список заказов"/>
</form>
<form action="mws/listReturns.php" method="post" target="result">
    <input type="submit" value="Получить список возвратов"/>
</form>
<iframe name="result" style="width:1000px; height: 300px;"></iframe>
<form action="mws/returnPayment.php" method="post" target="result">
    Введите идентификатор заказа:&nbsp;<input type="text" name="invoiceId"/>&nbsp;&nbsp;
    Введите сумму:&nbsp;<input type="text" name="amount"/>
    <input type="submit" value="Вернуть платеж"/>
</form>
<hr>
<form action="mws/confirmPayment.php" method="post" target="result">
    Введите идентификатор заказа:&nbsp;<input type="text" name="invoiceId"/>&nbsp;&nbsp;
    Введите сумму:&nbsp;<input type="text" name="amount"/>
    <input type="submit" value="Подтвердить платеж"/>
</form>
<hr>
<form action="mws/cancelPayment.php" method="post" target="result">
    Введите идентификатор заказа:&nbsp;<input type="text" name="invoiceId"/>&nbsp;&nbsp;
    Введите сумму:&nbsp;<input type="text" name="amount"/>
    <input type="submit" value="Отменить платеж"/>
</form>
<hr>
<form action="mws/repeatCardPayment.php" method="post" target="result">
    Введите идентификатор заказа:&nbsp;<input type="text" name="invoiceId"/>&nbsp;&nbsp;
    Введите сумму:&nbsp;<input type="text" name="amount"/>
    <input type="submit" value="Повторить платеж"/>
</form>

<iframe name="result" style="width:1000px; height: 150px;"></iframe>
</body>
</html>