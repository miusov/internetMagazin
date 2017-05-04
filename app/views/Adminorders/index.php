<div class="row head">
    <h3>Заказы</h3>
</div>
<div class="row body-row">
    <div class="col-md-12">
        <table class="cellpadding">
            <tr>
                <td><h4><a href="/adminorders?sort=all">Всего заказов: </a></h4></td>
                <td class="text-center"><h4><strong><?=$count_orders?></strong></h4></td>
            </tr>
            <tr>
                <td><h4><a href="/adminorders?sort=ok">Обработанные: </a></h4></td>
                <td class="text-center"><h4><strong><?=$okord?></strong></h4></td>
            </tr>
            <tr>
                <td><h4><a href="/adminorders?sort=no">Не обработанные: </a></h4></td>
                <td class="text-center"><h4><strong><?=$noord?></strong></h4></td>
            </tr>
        </table>
    </div>
</div>
<div class="row content-row">
<?php foreach ($orders as $k=>$v){
    if ($v['order_confirm'] == 'ok')
    {
        $status = "<span class='green'>Обработан</span>";
    }
    else
    {
        $status = "<span class='red'>Не обработан</span>";
    }?>
<div class="block-order col-md-12">
    <p class="author-date"><?=$v['order_date']?></p>
    <div class="col-md-6"><strong>Заказ № <?=$v['id']?></strong> - <?=$status?></div>
    <div class="text-right col-md-6"><a href="/adminorders/view?id=<?=$v['id']?>" class="btn btn-link">Подробнее</a></div>
</div>
<?php } ?>
</div>
<div class='pstrnav text-center col-md-12'>
    <ul>
        <?=$pagin?>
    </ul>
</div>