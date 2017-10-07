(function($) {
    $(function() {

        $("#myTable").tablesorter();

    $('.item-del').click(function () {
        if (confirm("Вы подтверждаете удаление?")) {
            var delid = $(this).attr('id');

            $.ajax({
                type: "post",
                url: "/adminitem/del",
                data: {id: delid},
                dataType: "html",
                cache: false,
                success: function () {
                    location.reload();
                }
            })
        } else {
            return false;
        }
    });

    $('#input-search').bind('textchange', function () {
        var input_search = $('#input-search').val();
        if (input_search.length >= 2)
        {
            $.ajax({
                type: "post",
                url: "/adminitem/search",
                data: "text="+input_search,
                dataType: "html",
                cache: false,
                success: function (data) {
                    if (data>'')
                    {
                        $('#result-search').show().html(data);
                    }
                    else
                    {
                        $('#result-search').hide();
                    }
                }
            });
        }
        else
        {
            $('#result-search').hide();
        }
    });

    $('.h4click').click(function () {
        if ($(this).next().css('display') == 'none'){
            $(this).next().slideDown();
        }else{
            $(this).next().slideUp();
        }

    });

    $('#delimage').click(function () {
        if (confirm("Вы подтверждаете удаление?")) {
            var iid = $(this).attr('iid');
            var src = $('#osn-img').attr('src');

            $.ajax({
                type: "post",
                url: "/adminitem/delimage",
                data: {id: iid, src: src},
                dataType: "html",
                cache: false,
                success: function () {
                    location.reload()
                }
            })
        }
        else{
            return false;
        }
    });

    $('.delimage').click(function () {
        if (confirm("Вы подтверждаете удаление?")) {

            var iid = $(this).attr('iid');
            var src = $('#gall-img'+iid).attr('src');

            $.ajax({
                type: "post",
                url: "/adminitem/delgallery",
                data: {id: iid, src: src},
                dataType: "html",
                cache: false,
                success: function () {
                    location.reload();
                }
            })
        }
        else{
            return false;
        }
    });

    $('.ok-review').click(function () {
        if (confirm("Вы хорошо подумали?")) {
            var ok = $(this).attr('ok');

            $.ajax({
                type: "post",
                url: "/adminreview/okreview",
                data: {ok: ok},
                dataType: "html",
                cache: false,
                success: function () {
                    location.reload();
                }
            });
        }
        else{
            return false;
        }
    });

    $('.del-review').click(function () {
        if (confirm("Вы подтверждаете удаление?")) {
            var del = $(this).attr('del');

            $.ajax({
                type: "post",
                url: "/adminreview/delreview",
                data: {del: del},
                dataType: "html",
                cache: false,
                success: function () {
                    location.reload();
                }
            });
        }
        else{
            return false;
        }
    });

    $('#del-cat-type').click(function () {
        if (confirm("Вы подтверждаете удаление?")) {
        var selectid = $('#category option:selected').val();
        if (!selectid)
        {
            $('#category').css('borderColor','red');
        }
        else
        {
            $.ajax({
                type: "post",
                url: "/admincategory/del",
                data: {id: selectid},
                dataType: "html",
                cache: false,
                success: function (data) {
                    console.log(data);
                    if (data == 'del')
                    {
                        $('#mess').html('<div class="alert-info text-center">Запись удалена!</div>');
                        $('#category option:selected').remove();
                    }
                }
            });
        }
        }
        else{
            return false;
        }
    });

        $('#del-brand').click(function () {
            if (confirm("Вы подтверждаете удаление?")) {
                var selectid = $('#brand option:selected').val();
                if (!selectid)
                {
                    $('#brand').css('borderColor','red');
                }
                else
                {
                    $.ajax({
                        type: "post",
                        url: "/admincategory/delbrand",
                        data: {id: selectid},
                        dataType: "html",
                        cache: false,
                        success: function (data) {
                            console.log(data);
                            if (data == 'del')
                            {
                                $('#mess').html('<div class="alert-info text-center">Запись удалена!</div>');
                                $('#brand option:selected').remove();
                            }
                        }
                    });
                }
            }
            else{
                console.log('false');
                return false;
            }
        });

        $('#type').change(function () {
            $('#brand').find('option.brand').remove();
            var selectid = $('#type option:selected').val();
            console.log(selectid);
            $.ajax({
                url: "/adminitem/loadbrand",
                type: "post",
                data: {id:selectid},
                success: function (data) {
                    $('#brand').append(data);
                }
            })
        });

    $('.block-client').click(function () {
        if($(this).children('table').css('display') == 'none'){
            $(this).children('table').slideDown(400);
        }
        else{
            $(this).children('table').slideUp(400);
        }

    });

    $('.del-user').click(function () {
        if (confirm("Вы подтверждаете удаление?")) {
        var iid = $(this).attr('iid');
        $.ajax({
            type: "post",
            url: "/adminusers/del",
            data: {id: iid},
            dataType: "html",
            cache: false,
            success: function (data) {
                console.log(data);
                if (data == 'del')
                {
                    $('#block-user'+iid).remove();
                }
            }
        });
        }
        else{
            return false;
        }
    });

    $('.add-news').click(function () {
        $('#fixed').fadeIn(300);
    });
    $('#news-exit').click(function () {
        $('#fixed').fadeOut(300);
    });


    $('.del-news').click(function () {
        if (confirm("Вы подтверждаете удаление?")) {
            var iid = $(this).attr('iid');
            $.ajax({
                type: "post",
                url: "/adminnews/del",
                data: {id: iid},
                dataType: "html",
                cache: false,
                success: function (data) {
                    console.log(data);
                    if (data == 'del')
                    {
                        $('#block-news'+iid).remove();
                    }
                }
            });
        }
        else{
            return false;
        }
    });

    $('#send_news').click(function () {
        var title = $('#title').val();
        var text = $('#text').val();

        $.ajax({
            type: "post",
            url: "/adminnews/addnews",
            data: {title: title, text: text},
            dataType: "html",
            cache: false,
            success: function (data) {
                console.log(data);
                if (data == 'OK')
                {
                    $('#mess').html("<div class='alert-success text-center'>Запись добавлена!</div>");
                    setTimeout($('#fixed').fadeOut(),1000);
                }
                else{
                    $('#mess').html(data);
                }
            }
        })
    });
    
    $('#select-all').click(function () {
        $('.privelegy input:checkbox').attr('checked', true);
    });

    $('#remove-all').click(function () {
        $('.privelegy input:checkbox').attr('checked', false);
    });


        $('.del-admin').click(function () {
            if (confirm("Вы подтверждаете удаление?")) {
                var iid = $(this).attr('iid');
                $.ajax({
                    type: "post",
                    url: "/admins/del",
                    data: {id: iid},
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        if (data == 'del')
                        {
                            $('#block-admin'+iid).remove();
                        }
                        else{
                            alert(data);
                        }
                    }
                });
            }
            else{
                return false;
            }
        });

        $('.del-order').click(function () {
            if(confirm("Вы подтверждаете удаление?")) {
                return true;
            }
            else{
                return false;
            }
        })


    })
})(jQuery);

