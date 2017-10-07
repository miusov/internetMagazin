<?php //xprint($brand); ?>
<div class="row head">
    <h3>Редактор категорий</h3>
</div>
<div class="row body-row">
    <div class="col-md-12">
    <div id="mess"><?=$mess?></div>
    <form id="edit-category" action="/admincategory" method="post">
        <div class="col-md-6">
        <div class="form-group">
            <label for="category">Категории:</label>
            <select class="form-control" name="cat_type" id="category" size="10">
                <?php
                    foreach ($category as $k=>$v)
                    {
                        echo "<option value='{$v['id']}'>{$v['type']}</option>";
                    }
                ?>
            </select>
        </div>
        <?php if ($_SESSION['del_cat'] == '1') echo "<div class='form-group'><button class='btn btn-danger' id='del-cat-type'>Удалить категорию</button></div>"; ?>
        <?php if ($_SESSION['add_cat'] == '1') echo '
        <div class="form-group">
            <label for="type">Название категории:</label>
            <input type="text" class="form-control" id="type" name="type">
        </div>
        <button type="submit" class="btn btn-success" name="add-cat-category">Добавить категорию</button>'; ?>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label for="category">Бренд - категория:</label>
            <select class="form-control" name="brand_type" id="brand" size="10">
			    <?php
			    foreach ($brand as $k=>$v)
			    {
				    echo "<option value='{$v['id']}'>{$v['brand']} - {$v['type']}</option>";
			    }
			    ?>
            </select>
        </div>
	    <?php if ($_SESSION['del_cat'] == '1') echo "<div class='form-group'><button class='btn btn-danger' id='del-brand'>Удалить бренд</button></div>"; ?>
	    <?php if ($_SESSION['add_cat'] == '1') : ?>
        <div class="form-group">
            <label for="type">Название бренда:</label>
            <input type="text" class="form-control" id="brand" name="brand">
        </div>
        <div class="form-group">
            <label for="category">Категория бренда:</label>
            <select class="form-control" name="brand-cat-type" id="brand-category">
			    <?php
			    foreach ($category as $k=>$v)
			    {
				    echo "<option value='{$v['id']}' name='{$v['id']}'>{$v['type']}</option>";
			    }
			    ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success" name="add-brand">Добавить бренд</button>
        <?php endif; ?>
        </div>
    </form>
    </div>
</div>