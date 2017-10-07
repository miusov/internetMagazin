<div class="row head">
    <h3>Редактор категорий</h3>
</div>
<div class="row body-row">
    <div class="col-md-6 col-md-offset-3">
    <div id="mess"><?=$mess?></div>
    <form id="edit-category" action="/admincategory" method="post">
        <div class="form-group">
            <label for="category">Категории:</label>
            <select class="form-control" name="cat_type" id="category" size="15">
                <?php
                    foreach ($category as $k=>$v)
                    {
                        echo "<option value='{$v['id']}'>{$v['type']} - {$v['brand']}</option>";
                    }
                ?>
            </select>
        </div>
        <?php if ($_SESSION['del_cat'] == '1') echo "<div class='form-group'><button class='btn btn-danger' id='del-cat-type'>Удалить</button></div>"; ?>
        <?php if ($_SESSION['add_cat'] == '1') echo '
        <div class="form-group">
            <label for="type">Тип товара:</label>
            <input type="text" class="form-control" id="type" name="type">
        </div>
        <div class="form-group">
            <label for="brand">Бренд:</label>
            <input type="text" class="form-control" id="brand" name="brand">
        </div>
        <button type="submit" class="btn btn-success" name="add-cat-category">Добавить</button>'; ?>
    </form>
    </div>
</div>