<div class="row head">
    <h3>Основная информация</h3>
</div>
<div class="row body-row">
<div class="col-md-4">
    <table class="table-info" width="100%">
        <tr>
            <td>Всего заказов - </td>
            <td class="text-center"><?=$orders?></td>
        </tr>
        <tr>
            <td>Всего товаров - </td>
            <td class="text-center"><?=$products?></td>
        </tr>
        <tr>
            <td>Всего отзывов - </td>
            <td class="text-center"><?=$reviews?></td>
        </tr>
        <tr>
            <td>Всего клиентов - </td>
            <td class="text-center"><?=$clients?></td>
        </tr>
    </table>
</div>
<div class="col-md-8">
    <h3 class="text-center">Статистика продаж</h3>
    <table class="table text-center">
        <thead>
        <tr>
            <th class="text-center">Дата</th>
            <th class="text-center">Наименование товара</th>
            <th class="text-center">Цена</th>
            <th class="text-center">Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($ordprod as $k => $v) {
            $order = R::findOne('tableproducts','WHERE id=?',[$v['buy_id_product']]);
            $statuspay = '';
            if ($v['order_pay'] == 'accepted') $statuspay = 'Оплачено';
            ?>
            <tr>
                <td><?=$v['order_date']?></td>
                <td><?=$order['title']?></td>
                <td><?=$order['price']?> грн.</td>
                <td><?=$statuspay?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</div>