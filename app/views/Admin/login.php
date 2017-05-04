<style>
    #login-block{
        width: 600px;
        height: 230px;
        border: 1px solid lightgray;
        border-radius: 5px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -200px;
        margin-left: -300px;
        padding: 20px 30px;
        background-color: rgba(176, 196, 222, 0.27);
    }
</style>
<div id="login-block">
    <form action="/admin/login" method="post">
        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" class="form-control" id="login" name="login" autofocus>
        </div>
        <div class="form-group">
            <label for="pass">Пароль:</label>
            <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <button type="submit" class="btn btn-default" name="signin">Войти</button>
    </form>
    <div class="text-center"><a href="/">Перейти на сайт</a></div>
</div>
