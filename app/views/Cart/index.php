<?php
echo $breadcrumbs;
if (isset($clear)) echo $clear;
if (isset($res))
{
    echo "
        <table class='table table-striped cart-table'>
          <thead>
            <tr><th>Изображение</th><th>Наименование товара</th><th>Кол-во</th><th>Цена</th><th></th></tr>
          </thead>
          <tbody>";
              foreach ($res as $k=>$v)
              {
                  $int = $v['cart_price']*$v['cart_count'];
                  @$all_price = @$all_price+$int;
                  echo "<tr id='tovar{$v['cart_id']}'><td class='text-center'><img src='/public/images/products/{$v['image']}' height='80'></td><td>{$v['title']}</td><td id='item-count'><span class='minus' iid='{$v['cart_id']}'>-</span><span id='kol_vo-{$v['cart_id']}'>{$v['cart_count']}</span><span class='plus' iid='{$v['cart_id']}'>+</span></td><td><p style='color: gray;'><span class='count-span'>{$v['cart_count']}</span> x {$v['price']} грн.</p><p class='totalprice' price='{$v['price']}'><b>{$int} грн.</b></p> </td><td><a href='/cart/del?action=del&task={$v['cart_id']}' class='btn btn-danger'>X</a></td></tr>";
              }
         echo "</tbody>
        </table>
        <hr>
        <div class='text-right'><h3 class='itog'>Итого: <span>{$all_price}</span>грн.</h3></div>
        <p class='text-right'><a href='/cart?action=confirm' class='btn btn-success'>Далее</a></p>
    ";
}

if ($_GET['action'] == 'confirm')
{
    if ($_SESSION['order_delivery'] == 'Новая почта') $ch1 = 'checked';
    if ($_SESSION['order_delivery'] == 'Интайм') $ch2 = 'checked';
    if ($_SESSION['order_delivery'] == 'Самовывоз') $ch3 = 'checked';
    ?>
<div class="confirm" xmlns="http://www.w3.org/1999/html">
    <form action="/cart/confirm" method="post" id="confirm-form">
        <h3>Способы доставки:</h3>
        <hr>
        <div><input type="radio" name="radio" id="np" value="Новая почта" <?=@$ch1?>><label for="np">Новая почта</label></div>
        <div><input type="radio" name="radio" id="it" value="Интайм" <?=@$ch2?>><label for="it">Интайм</label></div>
        <div><input type="radio" name="radio" id="sam" value="Самовывоз" <?=@$ch3?>><label for="sam">Самовывоз</label></div>
        <br>
        <h3>Информация для доставки:</h3>
        <hr>
        <table>
            <tr>
                <td>*ФИО</td>
                <td><input type="text" name="fio" value="<?=@$_SESSION['fam']?> <?=@$_SESSION['name']?>"></td>
                <td class="primer">Пример: Иванов Иван Иванович</td>
            </tr>
            <tr>
                <td>*Email</td>
                <td><input type="email" name="email" value="<?=@$_SESSION['email']?>"></td>
                <td class="primer">Пример: ivan@mail.com</td>
            </tr>
            <tr>
                <td>*Телефон</td>
                <td><input type="text" name="tel" value="<?=@$_SESSION['tel']?>"></td>
                <td class="primer">Пример: 096 321 56 89</td>
            </tr>
            <tr>
                <td>*Адрес доставки</td>
                <td><input type="text" name="address" value="<?=@$_SESSION['address']?>"></td>
                <td class="primer">Пример: г.Киев, Новая почта отделение №5</td>
            </tr>
            <tr>
                <td>Примечание</td>
                <td><textarea name="text" id="" rows="5"></textarea></td>
                <td class="primer">Уточните информацию о заказе. Например, удобное время для звонка нашего менеджера.</td>
            </tr>
        </table>
        <p>* - Обязательно для заполнения!</p>
        <p class="text-right"><input type="submit" name="confirm_btn" class="btn btn-success" value="Далее"></p>
    </form>

</div>
<?php
}
?>
<?php
if ($_GET['action'] == 'completion')
{
    if (isset($_SESSION['order_fio']))
    {
        foreach ($res2 as $k => $v) {
            $int2 = $v['cart_price'] * $v['cart_count'];
            @$all_price2 = @$all_price2 + $int2;
        }
        ?>
        <h3 class="con-info">Конечная информация</h3>
        <table class="table table-completion">
            <tbody>
            <tr>
                <td>ФИО</td>
                <td><?= $_SESSION['order_fio'] ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $_SESSION['order_email'] ?></td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><?= $_SESSION['order_tel'] ?></td>
            </tr>
            <tr>
                <td>Способ доставки</td>
                <td><?= $_SESSION['order_delivery'] ?></td>
            </tr>
            <tr>
                <td>Адрес</td>
                <td><?= $_SESSION['order_address'] ?></td>
            </tr>
            <tr>
                <td>Примечание</td>
                <td><?= $_SESSION['order_text'] ?></td>
            </tr>
            </tbody>
        </table>
        <div class="text-right"><h3>Итого: <?= $all_price2 ?> грн.</h3></div>
        <p class="text-right"><a href="#" class="btn btn-success">Оплатить</a></p>


        <?php
    }
    else
    {
        echo "<h2 class='text-center' style='margin-top: 70px'>Сначала нужно заполнить контактную информацию!</h2>";
    }
}
?>