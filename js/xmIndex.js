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
    document.getElementsByClassName("bg-video")[0].style.height = winHeight + "px";
    document.getElementsByClassName("bg-video")[0].style.width = winWidth + "px";
    document.getElementById("bg-video").style.marginLeft = -(1920 - winWidth) / 2 + "px";
    if (winHeight < 768) {
        console.log("手机网页");
    }


}

window.onload = function () {
    // 更换背景视频
    var bgvideo = document.getElementById("bg-video");
    var i = 0;
    if (i === 0) {
        bgvideo.addEventListener('ended', changeVideo, true);
    }
    function changeVideo() {
        // bgvideo.src = "video/bg-100.mp4";
        // bgvideo.loop = true;
        $('.bg-content').css({'margin-top':0,'opacity':1});
        var bg100 = document.getElementById("bg-100");
        bg100.play();
        $('#bg-video').css({'display': 'none'});
        $('#bg-100').css({'display': 'block'});
        i++;
    }
    
    
}
findDimensions();
//调用函数，获取数值
window.onresize = findDimensions;