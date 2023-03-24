$(document).ready(function(){
    var min_sc_width = 680;
    　//ここにjQueryの処理を記述します。
        var menu_length = jQuery(window).width();
        var items_length = 0;
        var items_height = 0;
        console.log("def items_length:" + items_length);
        console.log("def items_height:" + items_height);
        console.log("def menu_length:" + menu_length);
        $("nav.pc-nav div.menu ul li.page_item").each(function(i, o){
            console.log("into");
            //コンソールにインデックス番号とテキストを出力する
            console.log('インデックス番号:' + i + '、テキスト:' + $(o).text());
            items_length += $(o).outerWidth(true);
            items_height += $(o).outerHeight(true);
            console.log("add items_length:" + items_length);
            console.log("add items_height:" + items_height);
        });

        if((items_length + min_sc_width) > menu_length || items_length < items_height){
            console.log("ハンバーガーメニュー");
            console.log("items_length:" + items_length);
            console.log("menu_length:" + menu_length);
            $(".pc-nav").css("display", "none");
            $(".sp-nav").css("display", "block");
            if(menu_length < min_sc_width){
            }


        }else{
            console.log("通常メニュー");
            $(".sp-nav").css("display", "none");
            $(".pc-nav").css("display", "block");
            $('#hum_btn').css("display", "none");
        }
    });

    $('#hum_btn').on('click', function(){
        $(this).toggleClass('is-active');
        $(".sp-nav").toggleClass('is-active');
    });

    $('.sp-nav a').on('click', function(){
        $(this).removeClass('is-active');
        $(".sp-nav").removeClass('is-active');
    });