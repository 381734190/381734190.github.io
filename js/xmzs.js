var winWidth = 0;
var winHeight = 0;
function findDimensions() //函数：获取尺寸
{
    //获取窗口宽度
    if (window.innerWidth)
        winWidth = window.innerWidth;
    else if ((document.body) && (document.body.clientWidth))
        winWidth = document.body.clientWidth;
    //获取窗口高度
    if (window.innerHeight)
        winHeight = window.innerHeight;
    else if ((document.body) && (document.body.clientHeight))
        winHeight = document.body.clientHeight;
    //通过深入Document内部对body进行检测，获取窗口大小
    if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth) {
        winHeight = document.documentElement.clientHeight;
        winWidth = document.documentElement.clientWidth;
    }

    //结果输出至两个文本框
    console.log(winHeight);
    console.log(winWidth);

}
findDimensions();
//调用函数，获取数值
window.onresize = findDimensions;

$(window).scroll( function() {
    var a = $(this).scrollTop();
    if(a>=100){
        $('.side').css({'opacity':'1'});
    }else{
        $('.side').css({'opacity':'0'});
    }

    if(a>=300){
        $('.style-side').css({'position':'fixed','top':'150px'});
    }else{
        $('.style-side').css({'position':'absolute','top':'50%'});
    }

    if (winWidth > 1200) {
        if(a>=700){
            $('.style-zx').addClass('style-fixed');
        }else{
            $('.style-zx').removeClass('style-fixed');
        }
    }   
    
});
$(function() {
    //滑动返回
    $('#side-top').click(function(){
        $("html,body").animate({scrollTop:0},1000);
    });

});