<div class="row head">
    <h3>Редактирование профиля администратора</h3>
</div>
<div class="row body-row">
    <?php echo array_shift($mess)?>
    <form action="/admins/editadmin" method="post">
        <div class="form-group">
            <label for="login">*Логин:</label>
            <input type="text" class="form-control" id="login" name="login" value="<?=$admin['login']?>">
        </div>
        <div class="form-group">
            <label for="pass">Пароль:</label>
            <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <div class="form-group">
            <label for="fio">*ФИО:</label>
            <input type="text" class="form-control" id="fio" name="fio" value="<?=$admin['fio']?>">
        </div>
        <div class="form-group">
            <label for="role">*Должность:</label>
            <input type="text" class="form-control" id="role" name="role" value="<?=$admin['role']?>">
        </div>
        <div class="form-group">
            <label for="email">*Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?=$admin['email']?>">
        </div>
        <div class="form-group">
            <label for="tel">Телефон:</label>
            <input type="text" class="form-control" id="tel" name="tel" value="<?=$admin['tel']?>">
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
                    <div class="checkbox"><label><input type="checkbox" <?=$rev_zak?> name="rev_zak" value="1">Просмотр заказов</label></div>
                    <div class="checkbox"><label><input type="checkbox" <?=$wrk_zak?> name="wrk_zak" value="1">Обработка заказов</label></div>
                    <div class="checkbox"><label><input type="checkbox" <?=$del_zak?> name="del_zak" value="1">Удаление заказов</label></div>
            </div>
            <div class="col-md-2">
                <h4>Товары</h4>
                <div class="checkbox"><label><input type="checkbox" <?=$add_tov?> name="add_tov" value="1">Добавление товаров</label></div>
                <div class="checkbox"><label><input type="checkbox" <?=$edt_tov?> name="edt_tov" value="1">Изменение товаров</label></div>
                <div class="checkbox"><label><input type="checkbox" <?=$del_tov?> name="del_tov" value="1">Удаление товаров</label></div>
            </div>
            <div class="col-md-2">
                <h4>Отзывы</h4>
                <div class="checkbox"><label><li><input type="checkbox" <?=$mod_otz?> name="mod_otz" value="1">Модерация отзывов</label></div>
                <div class="checkbox"><label><li><input type="checkbox" <?=$del_otz?> name="del_otz" value="1">Удаление отзывов</label></div>
            </div>
            <div class="col-md-2">
                <h4>Клиенты</h4>
                <div class="checkbox"><label><li><input type="checkbox" <?=$rev_cln?>  name="rev_cln" value="1">Просмотр клиентов</label></div>
                <div class="checkbox"><label><li><input type="checkbox" <?=$del_cln?>  name="del_cln" value="1">Удаление клиентов</label></div>
            </div>
            <div class="col-md-2">
                <h4>Новости</h4>
                <div class="checkbox"><label><li><input type="checkbox" <?=$add_nes?> name="add_nes" value="1">Добавление новостей</label></div>
                <div class="checkbox"><label><li><input type="checkbox" <?=$del_nes?> name="del_nes" value="1">Удаление новостей</label></div>
            </div>
            <div class="col-md-2">
                <h4>Категории</h4>
                <div class="checkbox"><label><li><input type="checkbox" <?=$add_cat?> name="add_cat" value="1">Добавление категорий</label></div>
                <div class="checkbox"><label><li><input type="checkbox" <?=$del_cat?> name="del_cat" value="1">Удаление категорий</label></div>
            </div>
            <div class="col-md-12">
                <h4>Администраторы</h4>
                <div class="checkbox">
                    <label style="width: auto"><input type="checkbox" <?=$rev_adm?> name="rev_adm" value="1">Просмотр администраторов</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12 text-right">
                <input type="hidden" name="admin-id" value="<?=$admin['id']?>">
                <button type="submit" class="btn btn-success" name="edit-admin">Изменить</button>
            </div>
        </div>
    </form>
</div>