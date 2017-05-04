<div class="row head">
    <h3>Добавление администратора</h3>
</div>
<div class="row body-row">
    <?php echo array_shift($mess)?>
    <form action="/admins/addadmin" method="post">
        <div class="form-group">
            <label for="login">*Логин:</label>
            <input type="text" class="form-control" id="login" name="login" value="<?=$_POST['login']?>">
        </div>
        <div class="form-group">
            <label for="pass">*Пароль:</label>
            <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <div class="form-group">
            <label for="fio">*ФИО:</label>
            <input type="text" class="form-control" id="fio" name="fio" value="<?=$_POST['fio']?>">
        </div>
        <div class="form-group">
            <label for="role">*Должность:</label>
            <input type="text" class="form-control" id="role" name="role" value="<?=$_POST['role']?>">
        </div>
        <div class="form-group">
            <label for="email">*Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?=$_POST['email']?>">
        </div>
        <div class="form-group">
            <label for="tel">Телефон:</label>
            <input type="text" class="form-control" id="tel" name="tel" value="<?=$_POST['tel']?>">
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <h3>Привелегии</h3>
                <p><a class="btn btn-link" id="select-all">Выбрать все</a> | <a class="btn btn-link" id="remove-all">Снять все</a></p>
            </div>
        </div>
        <div class="form-group privelegy">
            <div class="col-md-2">
                <h4>Заказы</h4>
                <ul>
                    <div class="checkbox"><label><input type="checkbox" name="rev_zak" value="1">Просмотр заказов</label></div>
                    <div class="checkbox"><label><input type="checkbox" name="wrk_zak" value="1">Обработка заказов</label></div>
                    <div class="checkbox"><label><input type="checkbox" name="del_zak" value="1">Удаление заказов</label></div>
            </div>
            <div class="col-md-2">
                <h4>Товары</h4>
                <div class="checkbox"><label><input type="checkbox" name="add_tov" value="1">Добавление товаров</label></div>
                <div class="checkbox"><label><input type="checkbox" name="edt_tov" value="1">Изменение товаров</label></div>
                <div class="checkbox"><label><input type="checkbox" name="del_tov" value="1">Удаление товаров</label></div>
            </div>
            <div class="col-md-2">
                <h4>Отзывы</h4>
                <div class="checkbox"><label><li><input type="checkbox" name="mod_otz" value="1">Модерация отзывов</label></div>
                <div class="checkbox"><label><li><input type="checkbox" name="del_otz" value="1">Удаление отзывов</label></div>
            </div>
            <div class="col-md-2">
                <h4>Клиенты</h4>
                <div class="checkbox"><label><li><input type="checkbox" name="rev_cln" value="1">Просмотр клиентов</label></div>
                <div class="checkbox"><label><li><input type="checkbox" name="del_cln" value="1">Удаление клиентов</label></div>
            </div>
            <div class="col-md-2">
                <h4>Новости</h4>
                <div class="checkbox"><label><li><input type="checkbox" name="add_nes" value="1">Добавление новостей</label></div>
                <div class="checkbox"><label><li><input type="checkbox" name="del_nes" value="1">Удаление новостей</label></div>
            </div>
            <div class="col-md-2">
                <h4>Категории</h4>
                <div class="checkbox"><label><li><input type="checkbox" name="add_cat" value="1">Добавление категорий</label></div>
                <div class="checkbox"><label><li><input type="checkbox" name="del_cat" value="1">Удаление категорий</label></div>
            </div>
            <div class="col-md-12">
                <h4>Администраторы</h4>
                <div class="checkbox">
                    <label style="width: auto"><input type="checkbox" name="rev_adm" value="1">Просмотр администраторов</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-success" name="add-admin">Добавить</button>
            </div>
        </div>
    </form>
</div>