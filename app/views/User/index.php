<h2 class="h2-reg">Редактирование профиля</h2>

<div class="reg-form">

    <form action="/user/edit/" method="post" id="edit-form">
        <div class="form-group">
            <label for="pass">Новый пароль</label>
            <input type="password" class="form-control" id="pass" name="newpass"">
        </div>
        <div class="form-group">
            <label for="fam">Фамилия</label>
            <input type="text" class="form-control" id="fam" name="newfam" value="<?=$user['fam']?>">
        </div>
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="newname" value="<?=$user['name']?>">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="newemail" value="<?=$user['email']?>">
        </div>
        <div class="form-group">
            <label for="tel">Мобильный телефон</label>
            <input type="text" class="form-control" id="tel" name="newtel" value="<?=$user['tel']?>">
        </div>
        <div class="form-group">
            <label for="adress">Адрес доставки</label>
            <input type="text" class="form-control" id="address" name="newaddress" value="<?=$user['address']?>">
        </div>

        <input type="submit" class="btn btn-default" name="edit_btn" value="Изменить">
    </form>
</div>