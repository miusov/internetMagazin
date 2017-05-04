<?php if ($_SESSION['rev_adm'] == '1'){ ?>
<div class="row head">
    <h3>Раздел администраторов</h3>
</div>
    <div id="mess"></div>
<div class="row body-row">
    <div class="col-md-12 text-right"><a href="/admins/addadmin" class="btn btn-success add-admin">Добавить пользователя</a></div>
    <hr>
    <?php foreach ($admins as $k=>$v) { ?>
        <div class="block-admin col-md-12" id="block-admin<?=$v['id']?>">
            <div class="col-md-12">Должность: <?=$v['role']?></div>
            <div class="col-md-12">Логин: <strong><?=$v['login']?></strong></div>
            <div class="col-md-12">Имя: <strong><?=$v['fio']?></strong></div>
            <div class="col-md-12">Email: <strong><?=$v['email']?></strong></div>
            <div class="col-md-12">Телефон: <strong><?=$v['tel']?></strong></div>
            <div class="col-md-12 text-right"><a href="/admins/editadmin?adminid=<?=$v['id']?>" class="btn btn-info edit-admin">Изменить</a> <a class="btn btn-danger del-admin" iid="<?=$v['id']?>">Удалить</a></div>
        </div>
    <?php }?>
</div>
<?php }
else
{
    echo "<div class='alert-danger text-center'>У вас нет прав на просмотр данного раздела!</div>";
}
?>