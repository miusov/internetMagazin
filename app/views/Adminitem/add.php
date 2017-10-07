<?php if ($_SESSION['add_tov'] == '1'){ ?>
<div class="row head">
    <h3>Добавить товар</h3>
</div>
<div class="row content-row">
    <form enctype="multipart/form-data" method="post" id="additemform" class="form-add-item" action="/adminitem/add">
        <div class="form-group">
            <label class="control-label col-sm-2" for="title">*Название товара:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" value="<?=$_POST['title']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="price">*Цена:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="price" name="price" value="<?=$_POST['price']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="seo_words">Ключевые слова:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="seo_words" name="seo_words"  value="<?=$_POST['seo_words']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="seo_description">SEO описание:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="seo_description" name="seo_description" rows="4"><?=$_POST['seo_description']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-2">*Категория:</label>
            <div class="col-sm-10">
            <select class="form-control" id="type" name="type">
                <option value='0'>Выберите категорию</option>
	            <?php
	            foreach ($cat as $k=>$v)
	            {
		            echo "<option value='{$v['id']}'>{$v['type']}</option>";
	            }
	            ?>
            </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="seo_words">*Бренд:</label>
            <div class="col-sm-10">
                <select class="form-control" id="brand" name="brand">
                    <option value='0'>Выберите бренд</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2 osn-img" for="seo_description">Основная картинка:</label>
            <div class="col-sm-10">
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                <input type="file" accept="image/*" name="upload_image">
            </div>
        </div>
        <div class="form-group" id="objects">
            <label class="control-label col-sm-2 osn-img" for="seo_description">Галерея картинок:</label>
            <div class="col-sm-10 addimage" id="addimage1">
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input type="file" name="file[]" multiple accept="image/*" id="files">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="seo_description">Ссылка на видео:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="link_video" name="link_video" rows="4" placeholder='<iframe width="560" height="315" src="https://www.youtube.com/....." frameborder="0" allowfullscreen></iframe>'><?=$_POST['link_video']?></textarea>
            </div>
        </div>
        <div class="row col-md-12">
        <h4 class="h4click col-md-12"><p class="h3click-img-right"></p>Краткое описание товара</h4>
        <div class="div-editor1 col-md-12">
            <textarea name="txt1" id="editor1"><?=$_POST['txt1']?></textarea>
            <script>
                var ckeditor1 = CKEDITOR.replace("editor1");
                AjexFileManager.init({
                    returnTo: "ckeditor",
                    editor: "ckeditor1"
                });
            </script>
        </div>
        </div>
        <div class="row col-md-12">
            <h4 class="h4click col-md-12"><p class="h3click-img-right"></p>Описание товара</h4>
            <div class="div-editor2 col-md-12">
                <textarea name="txt2" id="editor2"><?=$_POST['txt2']?></textarea>
                <script>
                    var ckeditor2 = CKEDITOR.replace("editor2");
                    AjexFileManager.init({
                        returnTo: "ckeditor",
                        editor: "ckeditor2"
                    });
                </script>
            </div>
        </div>
        <div class="row col-md-12">
            <h4 class="h4click col-md-12"><p class="h3click-img-right"></p>Краткие характеристики товара</h4>
            <div class="div-editor3 col-md-12">
                <textarea name="txt3" id="editor3"><?=$_POST['txt3']?></textarea>
                <script>
                    var ckeditor3 = CKEDITOR.replace("editor3");
                    AjexFileManager.init({
                        returnTo: "ckeditor",
                        editor: "ckeditor3"
                    });
                </script>
            </div>
        </div>
        <div class="row col-md-12">
            <h4 class="h4click col-md-12"><p class="h3click-img-right"></p>Характеристики товара</h4>
            <div class="div-editor4 col-md-12">
                <textarea name="txt4" id="editor4"><?=$_POST['txt4']?></textarea>
                <script>
                    var ckeditor4 = CKEDITOR.replace("editor4");
                    AjexFileManager.init({
                        returnTo: "ckeditor",
                        editor: "ckeditor4"
                    });
                </script>
            </div>
        </div>
        <div class="col-md-12" id="opt_item"><h4>Опции товара</h4></div>
        <div class="col-md-12">
            <ul id="chkbox">
                <li><input type="checkbox" name="chk_visible" id="chk_visible"><label for="chk_visible">Показать товар</label></li>
                <li><input type="checkbox" name="chk_new" id="chk_new"><label for="chk_new">Новый товар</label></li>
                <li><input type="checkbox" name="chk_leader" id="chk_leader"><label for="chk_leader">Популярный товар</label></li>
                <li><input type="checkbox" name="chk_sale" id="chk_sale"><label for="chk_sale">Товар со скидкой</label></li>
            </ul>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9 text-right btn-item">
                <button type="submit" class="btn btn-success" id="add_item" name="add_item">Добавить товар</button>
            </div>
        </div>
    </form>
</div>

<?php }
else
{
    echo "<div class='alert-danger text-center'>У вас нет прав на просмотр данного раздела!</div>";
}
?>