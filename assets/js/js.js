jQuery(document).ready(function($){


//下滑呼出侧栏客服台
$(window).scroll(function () {
    let top = $(this).scrollTop();
    if(top>=400){
        $('.r_aside').css("opacity","1");   //显示
    }else{
        $('.r_aside').css("opacity","0");   //隐藏
    }
})
//点击火箭回到顶部
$('.back-top').click(function () {
    $('html,body').animate({
        scrollTop:0
    },100);
})


//幻灯片
$('.banbox').owlCarousel({
animateOut: 'fadeOut',
items: 1,
loop:true,
nav:true,
margin: 0,
mouseDrag:false,
touchDrag:false,
autoplay:true,
autoplayTimeout:5000,
autoplayHoverPause:true,
navText:['',''],
})

//首页热门泪目
$('.index_hot_cat').owlCarousel({
center:true,
loop:true,
margin:10,
nav:true,
autoplay:true,
autoplayTimeout:3000,
autoplayHoverPause:true,
navText:['',''],
responsive:{
    0:{
        items:4
    },
    600:{
        items:6
    },
    800:{
        items:7
    },
    900:{
        items:8
    },
    1000:{
        items:8
    },
    1200:{
        items:8
    }
}
})



});


//导航菜单
function ds_mainmenu(ulclass){
    $(document).ready(function(){
        $(ulclass+' li').hover(function(){
            $(this).children("ul").show();
        },function(){
            $(this).children("ul").hide();
        });
    });
}
ds_mainmenu('.header-menu-ul');


//赞
$.fn.postLike = function() {
    if ($(this).hasClass('done')) {
        alert('勿重复操作');
        return false;
    } else {
        $(this).addClass('done');
        var id = $(this).data("id"),
        action = $(this).data('action'),
        rateHolder = $(this).children('.count');
        var ajax_data = {
            action: "specs_zan",
            um_id: id,
            um_action: action
        };
        $.post("/wp-admin/admin-ajax.php", ajax_data,
        function(data) {
            $(rateHolder).html(data);
        });
        return false;
    }
};
$(document).on("click", ".specsZan", function() {$(this).postLike();});


//table预设calss
$('.wznrys table').addClass("table");


// 错误提示
function addtips(msg) {
    $('.addtips').html(msg).animate({
        height: 60
    }, 200)
    setTimeout(function() {
        $('.addtips').animate({
            height: 0
        }, 200)
    }, 3000)
}

