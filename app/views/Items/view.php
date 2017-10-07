<div class="row row-item">
    <div class="col-sm-4 col-md-4">
        <img src="/public/images/products/<?=$item['image']?>" alt="" width="100%">
    </div>
    <div class="col-sm-8 col-md-8">
        <h2><b><?=$item['title']?></b></h2>
        <p><span class="glyphicon glyphicon-eye-open" aria-hidden="true"> <?=$item['count']?></span>&nbsp &nbsp &nbsp <span class="glyphicon glyphicon-user" aria-hidden="true"> <?=$count_com?></span>&nbsp &nbsp &nbsp <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            <span class="count-like"><?=$item['like_ok']?></span><span class="like" like="<?=$item['id']?>">Нравиться</span></p>
        <h3 class="item-price"><b><?=$item['price']?> грн.</b></h3>
        <p><button class="btn btn-info add-to-cart" item="<?=$item['id']?>">В корзину</button></p>
        <p><?=$item['mini_description']?></p>
    </div>
    <div id="block-img-slide">
        <ul class="gallery">
            <?php
            foreach ($image as $k=>$v)
            {
                echo "<li><a data-fancybox='gallery' href='/public/images/products/{$v['image']}'><img src='/public/images/products/{$v['image']}' height='70'></a></li>";
            }
            ?>
        </ul>
    </div>
</div>
<div class="row">
    <div class="ionTabs" id="tabs_1" data-name="Tabs_Group_name">
        <ul class="ionTabs__head">
            <li class="ionTabs__tab" data-target="Tab_1_name">Описание</li>
            <li class="ionTabs__tab" data-target="Tab_2_name">Характеристики</li>
            <li class="ionTabs__tab" data-target="Tab_3_name">Отзывы</li>
            <li class="ionTabs__tab" data-target="Tab_4_name">Видео</li>
        </ul>
        <div class="ionTabs__body">
            <div class="ionTabs__item" data-name="Tab_1_name">
                <?=$item['description']?>
            </div>
            <div class="ionTabs__item" data-name="Tab_2_name">
                <?=$item['features']?>
            </div>
            <div class="ionTabs__item" data-name="Tab_3_name">
                <p id="send-review">
                    <a class="send-review btn btn-success">Оставить отзыв</a>
                </p>
                <?php foreach ($comments as $k=>$v) { ?>
                    <div class="reviews">
                        <p class="author-date text-right"><strong><?=$v['name']?></strong>, <?=$v['date']?></p>
                        <table class="coment-table">
                    <tr>
                        <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                        <td class="text-review"><?=$v['good_review']?></td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                        <td class="text-review"><?=$v['bad_review']?></td>
                    </tr>
                </table>
                <p class="text-coment"><?=$v['comment']?></p>
            </div>
            <?php } ?>
            </div>
            <div class="ionTabs__item" data-name="Tab_4_name">
                <div class="text-center">
                    <?php if ($item['link_video'] != '') {echo $item['link_video'];} else echo "Видео не найдено!"; ?>
                </div>

            </div>

            <div class="ionTabs__preloader"></div>
        </div>
    </div>
</div>

<div class="row random-item">
    <?php
        foreach ($random as $key=>$value)
        {
        if ($value['image'] != '')
        {
        $image_path = "/public/images/products/{$value['image']}";
        $max_width = 100;
        $max_height = 100;
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
        $width = 100;
        $height = 100;
        }
        echo "
            <div class='hidden-xs hidden-sm col-md-4 item-mini'>
            <div class='col-xs-6 col-md-5 text-center'><a href='/items/view?id={$value['id']}'><img src='{$image_path}' alt='' width='{$width}' height='{$height}'></a></div>
            <div class='col-xs-6 col-md-7'>
                <h5 class='item-title-mini'><a href='/items/view?id={$value['id']}'>{$value['title']}</a></h5>
                <h5 class='item-price-mini text-right'>{$value['price']} грн.</h5>
                <p class='button-cart text-right'><button class='add-to-cart btn btn-info' item='{$value['id']}'>В корзину</button></p>
            </div>
            </div>
        ";
        }
    ?>

</div>




<div id="fixed">
    <div class="comment-modal">
        <p class="text-right"><button class="btn btn-default" id="comment-exit">X</button></p>
        <p style="color: red">Публикация отзыва производится после предварительной модерации!</p>
        <form id="form-review" method="post">
            <div class="form-group">
                <label for="name">ФИО*</label>
                <input type="text" id="rev-name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="good">Плюсы*</label>
                <textarea name="good" id="rev-good" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="bad">Минусы*</label>
                <textarea name="bad" id="rev-bad" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="com">Комментарий*</label>
                <textarea name="com" id="rev-com" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-default" id="send_review" iid="<?=$item['id']?>">Отправить</button>
            </div>
        </form>
    </div>
</div>