<?php if ($_SESSION['rev_cln'] == '1'){ ?>
<div class="row head">
    <h3>Зарегистрированные пользователи</h3>
</div>
<div class="row head count-client"><h4>Всего клиентов: <strong><?=$count_clients?></strong></h4></div>
<div class="row body-row">
    <?php foreach ($clients as $k=>$v) { ?>
    <div class="block-client col-md-12" id="block-user<?=$v['id']?>">
            <div class="col-md-12">Дата регистрации: <?=$v['created_at']?></div>
            <div class="col-md-11">Email: <strong><?=$v['email']?></strong></div>
            <div class="col-md-1 text-right">
                <?php if ($_SESSION['del_cln'] == '1') echo "<a class='btn btn-danger del-user' iid='{$v['id']}'>Удалить</a>"?>
            </div>
            <table class="table-client">
                <tr>
                    <td>Логин:</td>
                    <td><strong><?=$v['login']?></strong></td>
                </tr>
                <tr>
                    <td>ФИО:</td>
                    <td><strong><?=$v['fam']?> <?=$v['name']?></strong></td>
                </tr>
                <tr>
                    <td>Телефон:</td>
                    <td><strong><?=$v['tel']?></strong></td>
                </tr>
                <tr>
                    <td>Адрес:</td>
                    <td><strong><?=$v['address']?></strong></td>
                </tr>
                <tr>
                    <td>ip:</td>
                    <td><strong><?=$v['ip']?></strong></td>
                </tr>
            </table>
    </div>
    <?php }?>
</div>
<div class='pstrnav text-center col-md-12'>
    <ul>
        <?php
        if (!$_GET['search_input']) echo $pagin;
        ?>
    </ul>
</div>
<?php }
else
{
    echo "<div class='alert-danger text-center'>У вас нет прав на просмотр данного раздела!</div>";
}
?>