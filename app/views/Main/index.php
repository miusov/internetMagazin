<div class="col-md-12">
    <div class="row sort">
        <div class="col-md-12">
            <ul id="option-list">
                <li>Сортировать:</li>
                <li><span id="select-sort"><?php echo $sort_name ?></span>
                <ul id="sorting-list">
                    <li><a href="/main?<?=substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'], '&')+1).'&'?>sort=price-asc">От дешевых к дорогим</a></li>
                    <li><a href="/main?<?=substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'], '&')+1).'&'?>sort=price-desc">От дорогих к дешевым</a></li>
                    <li><a href="/main?<?=substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'], '&')+1).'&'?>sort=popular">Популярные</a></li>
                    <li><a href="/main?<?=substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'], '&')+1).'&'?>sort=new">Новинки</a></li>
                    <li><a href="/main?<?=substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'], '&')+1).'&'?>sort=brand">от А до Я</a></li>
                </ul>
                </li>
            </ul>
        </div>
    </div>
<?php
echo "<h1 class='text-center'>{$empty}</h1>";
foreach ($prod as $key=>$value)
{
    if ($value['image'] != '')
    {
        $image_path = "/public/images/products/{$value['image']}";
        $max_width = 130;
        $max_height = 130;
        list($width,$height) = getimagesize(ROOT."/public/images/products/{$value['image']}");
        $ratioh = $max_height / $height;
        $ratiow = $max_width / $width;
        $ratio = min($ratioh,$ratiow);
        $width = intval($ratio * $width);
        $height = intval($ratio * $height);
    }
    else
    {
        $image_path = '/public/images/noimage.png';
        $width = 200;
        $height = 200;
    }
    $count_com = R::count('reviews',"WHERE products_id='{$value['id']}' AND moderat='1'");
    echo "
    
    <div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 item'>
        <div class='col-sm-12 col-md-5 col-xs-3  text-center'><a href='/items/view?id={$value['id']}'><img src='{$image_path}' alt='' width='{$width}' height='{$height}'></a></div>
        <div class='col-sm-12 col-md-7 col-xs-9'>
            <h4 class='item-title text-center'><a href='/items/view?id={$value['id']}'>{$value['title']}</a></h4>
            <p class='hidden-sm visible-xs'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> {$value['count']}</span>&nbsp &nbsp &nbsp <span class='glyphicon glyphicon-user' aria-hidden='true'> {$count_com}</span>&nbsp &nbsp &nbsp <span class='glyphicon glyphicon-thumbs-up' aria-hidden='true'></span>
        <span class='count-like'>{$value['like_ok']}</span></p>
            <p class='item-price text-right'>{$value['price']} грн.</p>
            <p class='button-cart text-right'><button class='btn btn-info add-to-cart' item='{$value['id']}'>В корзину</button></p>
        </div>
        <div class='col-md-12 hidden-sm item-mfeatures'>
            {$value['mini_features']}
        </div>
    </div>
    
    ";
}
?>
    <div class='pstrnav text-center col-xs-12'>
        <ul>
            <?=$pagin?>
        </ul>
    </div>
</div>