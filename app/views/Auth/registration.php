<h2 class="h2-reg">Регистрация</h2>
<p id="reg-message"><?=$res?></p>
<?php
if (isset($res))
{
?>
    <a href="">Войти</a>
<?php
}
?>
<div class="reg-form">

<form action="/auth/registration" method="post" id="registr-form">
    <div class="form-group">
        <label for="login">Логин*</label>
        <input type="text" class="form-control" id="login" name="login"  value="<?php echo @$_POST['login'] ?>">
    </div>
    <div class="form-group">
        <label for="pass">Пароль*</label>
        <input type="password" class="form-control" id="pass" name="pass">
    </div>
    <div class="form-group">
        <label for="pass2">Повторите пароль*</label>
        <input type="password" class="form-control" id="pass2" name="pass2">
    </div>
    <div class="form-group">
        <label for="fam">Фамилия*</label>
        <input type="text" class="form-control" id="fam" name="fam" value="<?php echo @$_POST['fam'] ?>">
    </div>
    <div class="form-group">
        <label for="name">Имя*</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo @$_POST['name'] ?>">
    </div>
    <div class="form-group">
        <label for="email">E-mail*</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo @$_POST['email'] ?>">
    </div>
    <div class="form-group">
        <label for="tel">Мобильный телефон*</label>
        <input type="text" class="form-control" id="tel" name="tel" value="<?php echo @$_POST['tel'] ?>">
    </div>
    <div class="form-group">
        <label for="adress">Адрес доставки*</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo @$_POST['address'] ?>">
    </div>
    <h4>* - поля обязательные для заполнения.</h4>
    <input type="submit" class="btn btn-default" name="reg_btn" value="Регистрация">
</form>
</div>