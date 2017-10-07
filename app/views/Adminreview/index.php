<div class="row head">
    <h3>Редактор отзывов</h3>
</div>
<div class="row body-row">
    <div class="col-md-12">
        <table class="cellpadding">
            <tr>
                <td><h4><a href="/adminreview?sort=all">Всего отзывов: </a></h4></td>
                <td class="text-center"><h4><strong><?=$count_rev?></strong></h4></td>
            </tr>
            <tr>
                <td><h4><a href="/adminreview?sort=mod">Одобренных: </a></h4></td>
                <td class="text-center"><h4><strong><?=$cmr?></strong></h4></td>
            </tr>
            <tr>
                <td><h4><a href="/adminreview?sort=nomod">На проверке: </a></h4></td>
                <td class="text-center"><h4><strong><?=$cnr?></strong></h4></td>
            </tr>
        </table>
    </div>
</div>
<div class="row content-row">

    <?php foreach ($rev as $k=>$v) {
        $item = R::findOne('tableproducts',"WHERE id=?",[$v['products_id']]);
        ?>
        <div class="reviews admin-review">
            <p class="author-date text-right"><strong><?=$v['name']?></strong>, <?=$v['date']?></p>
            <table class="coment-table">
                <tr>
                    <td rowspan="3" width="200px" class="text-center">
                        <img class="text-center" src="/public/images/products/<?=$item['image']?>" height="100" alt="">
                        <h4 style="margin: 10px 0;"><?=$item['price']?> грн.</h4>
                        <p><a href="/items/view?id=<?=$item['id']?>" target="_blank"><?=$item['title']?></a></p>
                    </td>
                    <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                    <td class="text-review"><?=$v['good_review']?></td>
                </tr>
                <tr>
                    <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                    <td class="text-review"><?=$v['bad_review']?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p class="text-coment"><?=$v['comment']?></p></td>
                </tr>
            </table>
            <p class="text-right">
                <?php if ($v['moderat'] == '0' && $_SESSION['mod_otz'] == '1') echo "<a class='btn btn-success ok-review' ok='{$v['id']}'>Принять</a>"; ?>
                <?php if ($_SESSION['del_otz'] == '1') echo "<a class='btn btn-danger del-review' del='{$v['id']}'>Удалить</a>"?>
            </p>
        </div>
    <?php } ?>

</div>
<div class='pstrnav text-center col-md-12'>
    <ul>
        <?=$pagin?>
    </ul>
</div>