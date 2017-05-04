<div class="row head">
    <h3>Товары</h3>
</div>
<div class="row body-row">
    <div class="col-md-6"><h4>Всего товаров: <strong><?=$count_tovar?></strong></h4></div>
    <div class="col-md-6 text-right"><a href="/adminitem/add" class="btn btn-success">Добавить товар</a></div>
    <hr>
</div>
<div class="search">
    <form action="/admin/tovari" method="get">
        <div class="form-group">
            <input type="text" name="search_input" placeholder="Поиск..." id="input-search" class="form-control">
            <ul id="result-search" class="text-left"></ul>
            <input type="submit" name="search" value="Найти" class="btn btn-default">
        </div>
    </form>

</div>
<div class="row content-row">
    <table class='table table-hover tablesorter' id="myTable">
        <thead>
        <tr><th>id</th><th class="text-center">Фото</th><th>Заголовок</th><th class="text-center">Цена</th><th class="text-center">Бренд</th><th class="text-center">Изменено</th><th class="text-center">Видимость</th><th class="text-center">Просмотры</th><th class="text-center">Лайки</th><th class="text-center">Опции</th></tr>
        </thead>
        <tbody>
    <?php
    foreach ($tovari as $k=>$v)
    {
        if ($_SESSION['del_tov'] == '1') $del = "<a href='#' class='item-del' id='{$v['id']}'>Удалить</a>";
        echo "
            <tr>
            <td>{$v['id']}</td>
            <td class='text-center'><img src='/public/images/products/{$v['image']}' alt='{$v['title']}' height='50'></td>
            <td><a href='/items/view?id={$v['id']}' target='_blank'>{$v['title']}</a></td>
            <td class='text-center'>{$v['price']}</td>
            <td class='text-center'>{$v['brand']}</td>
            <td class='text-center'>{$v['created_at']}</td>
            <td class='text-center'>{$v['visible']}</td>
            <td class='text-center'>{$v['count']}</td>
            <td class='text-center'>{$v['like_ok']}</td>
            <td class='text-center'><a href='/adminitem/edit?item={$v['id']}'>Изменить</a><br>{$del}</td>
            </tr>
        ";
    }
    ?>
        </tbody>
    </table>
</div>
<div class='pstrnav text-center col-md-12'>
    <ul>
        <?php
        if (!$_GET['search_input']) echo $pagin;
        ?>
    </ul>
</div>