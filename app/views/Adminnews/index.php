<?php if (isset($_SESSION['mess'])) echo $_SESSION['mess']; unset($_SESSION['mess']); ?>
<div class="row head">
    <h3>Редактор новостей</h3>
</div>
<div class="row body-row">
    <div class="col-md-10"><h4>Всего новостей: <strong><?=$count?></strong></h4></div>
    <div class="col-md-2 text-right">
        <?php if ($_SESSION['add_nes'] == '1') echo "<a class='btn btn-success add-news'>Добавить новость</a>"; ?>
    </div>
</div>
<div class="row content-row">
    <?php foreach ($news as $k=>$v){ ?>
<div class="block-news col-md-12" id="block-news<?=$v['id']?>">
    <p><h3><?=$v['title']?></h3></p>
    <p><?=$v['date']?></p>
    <p><?=$v['text']?></p>
    <?php if ($_SESSION['del_nes'] == '1') echo "<p class='text-right'><a class='btn btn-danger del-news' iid='{$v['id']}''>Удалить</a></p>"; ?>
    <hr>
</div>
    <?php } ?>
</div>

<div id="fixed">
    <div class="comment-modal">
        <p class="text-right"><button class="btn btn-default" id="news-exit">X</button></p>
        <form id="add-news" method="post">
            <div id="mess"></div>
            <div class="form-group">
                <label for="title">Заголовок*</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="text">Описание*</label>
                <textarea name="text" id="text" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-success" id="send_news">Добавить</button>
            </div>
        </form>
    </div>
</div>