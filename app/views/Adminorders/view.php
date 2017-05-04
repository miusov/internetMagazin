<?php if ($_SESSION['rev_zak'] == '1'){ ?>
<div class="row head">
    <h3>Просмотр заказа</h3>
</div>
<div class="row body-row">
    <?=$mess?>
    <div class="block-order col-md-12">
        <p class="text-right"><a href="/adminorders/view?id=<?=$order['id']?>&action=accept" class="green">Подтвердить заказ</a> | <a href="/adminorders/view?id=<?=$order['id']?>&action=delete" class="red del-order">Удалить заказ</a></p>
        <p class="author-date"><?=$order['order_date']?></p>
        <div class="col-md-6"><strong>Заказ № <?=$order['id']?></strong> - <?=$status?></div>
        <table class="table text-center">
            <thead>
            <tr>
                <th class="text-center">№</th>
                <th class="text-center">Наименование товара</th>
                <th class="text-center">Цена</th>
                <th class="text-center">Количество</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($buy as $k => $v) {
            $price = $price + ($v['price'] * $v['buy_count_product']);
            $index_count = $index_count +1; ?>
                <tr>
                    <td><?=$index_count?></td>
                    <td><?=$v['title']?></td>
                    <td><?=$v['price']?> грн.</td>
                    <td><?=$v['buy_count_product']?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <hr>
            <p>Общая цена - <strong><?=$price?> грн.</strong></p>
            <p>Способ доставки - <strong><?=$order['order_delivery']?></strong></p>
            <p>Статус оплаты - <strong><?=$statpay?></strong></p>
            <p>Тип оплаты - <strong><?=$order['order_type_pay']?></strong></p>
            <p>Дата оплаты - <strong><?=$order['order_date']?><strong></p>
        <table class="table text-center">
            <thead>
            <tr>
                <th class="text-center">ФИО</th>
                <th class="text-center">Адрес</th>
                <th class="text-center">Контакты</th>
                <th class="text-center">Примечание</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$order['order_fio']?></td>
                    <td><?=$order['order_address']?></td>
                    <td><?=$order['order_tel']?></td>
                    <td><?=$order['order_note']?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php }
else
{
    echo "<div class='alert-danger text-center'>У вас нет прав на просмотр данного раздела!</div>";
}
?>