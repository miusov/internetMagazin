$(document).ready(function () {

    loadcart();

    $.ionTabs("#tabs_1, #tabs_2, #tabs_3");

//акардион для категорий товаров

$('p.cat-link').click(function () {

    if($(this).next().css('display') != 'block') {
        $('p.cat-link').next().slideUp(400);
        $('p.cat-link').removeClass('active');
        $(this).next().slideDown(400);
        $(this).addClass('active');
        $.cookie('select_cat', $(this).attr('id'));
    }
    else {
        $(this).next().slideUp(400);
        $(this).removeClass('active');
        $.cookie('select_cat', '');
    }
});

if ($.cookie('select_cat') != '')
{
    $('#'+$.cookie('select_cat')).addClass('active').next().show();
}



//выпадающий список сортировки

$('#select-sort').click(function () {
    $('#sorting-list').slideToggle(400);
});



//сортировка по цене (плагин trackbar)

var start = $.cookie('start');
var end = $.cookie('end');
if(typeof start !=="undefined"){
    start = $.cookie('start')
}else{
    start = 100;
}
if(typeof end !=="undefined"){
    end = $.cookie('end')
}else{
    end = 10000;
}

$('#trackbar').trackbar({
    onMove: function () {
        document.getElementById("start-price").value = this.leftValue;
        document.getElementById("end-price").value = this.rightValue;
    },
    width: 210,
    leftLimit: 100,
    leftValue: start,
    rightLimit: 50000,
    rightValue: end,
    roundUp: 200
});

//слайдер новостей

    $('#ns').bxSlider({
        mode: 'vertical',
        speed: 2000,
        randomStart: true,
        responsive: true,
        useCSS: true,
        touchEnabled: true,
        slideMargin: 10,
        minSlides: 3,
        controls: false,
        auto: true,
        pause: 10000,
        autoHover: true
    });

    $('.category-items ul li').click(function(){
        $(this).addClass('active-light');
        $.cookie('select_sub_cat', $(this).attr('id'));
    });

    if ($.cookie('select_sub_cat') != '')
    {
        $('#'+$.cookie('select_sub_cat')).addClass('active-light');
    }

//    окно для логина
    $('#login').click(function () {
        $('.remindpass').slideUp(300);
        $('.block-login').slideToggle(400);
    });
    $('#remindpass').click(function () {
        $('.block-login').slideUp(300, function () {
            $('.remindpass').slideDown(300);
        });
    });
    $('#back').click(function () {
        $('.remindpass').slideUp(300, function () {
            $('.block-login').slideDown(300);
        });
    });

    //восстановление пароля

    $('#remindpass-btn').click(function () {
        var remindpass = $('#rem').val();
        if(remindpass == '' || remindpass > 30){
            $('#rem').css('border-color', 'red');
        }
        else{
            $.ajax({
                type: "POST",
                url: "/auth/remind/",
                cache: false,
                data: "email="+remindpass,
                dataType: "html",
                success: function (data) {
                    if(data == 'OK'){
                        console.log(data);
                        $('#remEmail').slideDown().html("<div class='alert-success text-center'>На ваш Email отослан пароль!</div>");
                        setTimeout("$('.remindpass').html('').fadeOut(), $('.block-login').fadeIn(300)",3000);
                    }else{
                        $('#remEmail').slideDown().html("<div class='alert-danger text-center'>Данного Email нет в базе!</div>");
                    }
                }
            })
        }
    })

//    Поисковое поле

    $('#input-search').bind('textchange', function () {
        var input_search = $('#input-search').val();
        if (input_search.length >= 2)
        {
            $.ajax({
                type: "post",
                url: "/main/search",
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
            })
        }
        else
        {
            $('#result-search').hide();
        }
    });

//    Добавление в корзину

    function itog() {
        $.ajax({
            type: "post",
            url: "/cart/itog",
            dataType: "html",
            cache: false,
            success: function (data) {
                $('.itog span').html(data);
            }
        })
    }

$('.add-to-cart').click(function () {
    var item = $(this).attr('item');

    $.ajax({
        type: "POST",
        url: "/cart/addcart",
        data: "id="+item,
        dataType: "html",
        cache: false,
        success: function () {
            loadcart();
        }
    })
});
    function loadcart() {
        $.ajax({
            type: "POST",
            url: "/cart/loadcart",
            dataType: "html",
            cache: false,
            success: function (data) {
                if (data == 0){
                    $('#cart-link').html("Корзина пуста");
                }
                else{
                    $('#cart-link').html(data);
                }

            }
        })
    }

    $('.add-to-cart').click(function () {
        $(this).css('backgroundColor','gray');
    });


    $('.minus').click(function () {
        var iid = $(this).attr('iid');

        $.ajax({
            type: "POST",
            url: "/cart/minus",
            data: "id="+iid,
            dataType: "html",
            cache: false,
            success: function (data) {
                $('#kol_vo-'+iid).html(data);
                loadcart();
                itog();
                var priceproduct = $('#tovar'+iid+' .totalprice').attr('price');
                var result_total = Number(priceproduct) * Number(data);
                $('#tovar'+iid+' .totalprice').html("<b>"+result_total+" грн.</b>");
                $('#tovar'+iid+' .count-span').html(data);

            }
        })
    });

    $('.plus').click(function () {
        var iid = $(this).attr('iid');

        $.ajax({
            type: "POST",
            url: "/cart/plus",
            data: "id="+iid,
            dataType: "html",
            cache: false,
            success: function (data) {
                $('#kol_vo-'+iid).html(data);
                loadcart();
                itog();
                var priceproduct = $('#tovar'+iid+' .totalprice').attr('price');
                var result_total = Number(priceproduct) * Number(data);
                $('#tovar'+iid+' .totalprice').html("<b>"+result_total+" грн.</b>");
                $('#tovar'+iid+' .count-span').html(data);

            }
        })
    });


//    валидация формы для отправки

    $('#confirm-form').validate({
        rules:{
            radio: {
                required: true
            },
            fio:{
                required: true,
                minlength: 5
            },
            email:{
                required: true,
                email: true
            },
            tel:{
                required: true
            },
            address:{
                required: true
            }
        },
        messages:{
            radio:{
                required: 'Нужно что то выбрать!'
            },
            fio:{
                required: 'Нужно заполнить!',
                minlength: 'Слишком короткое Имя и Фамилия!'
            },
            email:{
                required: 'Нужно заполнить!',
                email: 'Не правильный Email!'
            },
            tel:{
                required: 'Нужно заполнить!'
            },
            address:{
                required: 'Нужно заполнить!'
            }
        }
    });

//    МОдальое окно для отзывов

    $('.send-review').click(function () {
        $('#fixed').fadeIn(300);
    });
    $('#comment-exit').click(function () {
        $('#fixed').fadeOut(300);
    });

    $('#form-review').validate({
        rules:{
            name: {
                required: true
            },
            good:{
                required: true
            },
            bad:{
                required: true
            },
            com:{
                required: true
            }
        },
        messages:{
            name:{
                required: 'Нужно ввести имя!'
            },
            good:{
                required: 'Нужно заполнить!'
            },
            bad:{
                required: 'Нужно заполнить!'
            },
            com:{
                required: 'Нужно заполнить!'
            }
        }
    });

    $('#send_review').click(function () {
        var iid = $(this).attr('iid');
        var name = $('#rev-name').val();
        var good = $('#rev-good').val();
        var bad = $('#rev-bad').val();
        var bad = $('#rev-bad').val();
        var com = $('#rev-com').val();

        $.ajax({
            type: "post",
            url: "/items/sendreview",
            data: {id: iid, name: name, good: good, bad: bad, com: com},
            dataType: "html",
            cache: false,
            success: function () {
                if (name != '' && good != '' && bad != '' && com != '')
                {
                    setTimeout($('#fixed').fadeOut(),1000);
                }
            }
        })
    });

//    LIKE

    $('.like').click(function () {
        var like = $(this).attr('like');

        $.ajax({
            type: "post",
            url: "/items/like",
            data: {id: like},
            dataType: "html",
            cache: false,
            success: function (data) {
                if (data == 'no')
                {
                    alert('Вы уже голосовали!');
                }
                else
                {
                    $('.count-like').html(data);
                }
            }
        })
    });

//    Contacts form

    $('#contacts-form').validate({
        rules:{
            name: {
                required: true
            },
            email:{
                required: true,
                email: true
            },
            theme:{
                required: true
            },
            mess:{
                required: true
            }
        },
        messages:{
            name:{
                required: 'Нужно ввести имя!'
            },
            email:{
                required: 'Нужно заполнить!',
                email: 'Не корректный Email!'
            },
            theme:{
                required: 'Нужно заполнить!'
            },
            mess:{
                required: 'Нужно заполнить!'
            }
        }
    });

});
