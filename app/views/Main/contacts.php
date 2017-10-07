<br>
<h2 class="text-center">Форма обратной связи</h2>
<br>
<form id="contacts-form" method="post" action="/main/contacts">
    <div class="form-group">
        <label for="name">*Ваше имя:</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
        <label for="email">*Ваш Email:</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="theme">*Тема:</label>
        <input type="text" class="form-control" id="theme" name="theme">
    </div>
    <div class="form-group">
        <label for="mess">*Сообщение:</label>
        <textarea name="mess" id="mess" rows="5"  class="form-control"></textarea>
    </div>
    <p>* - поля обязательные для заполнения!</p>
    <button type="submit" class="btn btn-default" name="cont_form">Отправить</button>
</form>
