/**
 * Created by Administrator on 2016/8/22.
 */
function format(today) {
    var week=['日','一','二','三','四','五','六']
    var y=today.getFullYear();
    var m=today.getMonth()+1;
    m<10&&(m='0'+m);
    var d=today.getDate();
    d<10&&(d='0'+d);
    var w=week[today.getDay()];
    var result=y+"年"+m+"月"+d+"日 星期"+w;

//        小时
    var hours, minutes, seconds;
    var intHours, intMinutes, intSeconds;

    intHours = today.getHours();
    intMinutes = today.getMinutes();
    intSeconds = today.getSeconds();

    if (intHours == 0) {
        hours = "00:";
    } else if (intHours < 10) {
        hours = "0" + intHours+":";
    } else {
        hours = intHours + ":";
    }

    if (intMinutes < 10) {
        minutes = "0"+intMinutes+":";
    } else {
        minutes = intMinutes+":";
    }
    if (intSeconds < 10) {
        seconds = "0"+intSeconds+" ";
    } else {
        seconds = intSeconds+" ";
    }
    timeString = hours+minutes+seconds;
    Clock.innerHTML = result + " " + timeString;
    window.setTimeout("format(new Date());", 1000);
}


$(function () {
    format(new Date());

    // 表单验证
    $('#addNews').bootstrapValidator({
        message: '输入的内容无效',

        fields: {
            newsTitle: {
                validators: {
                    notEmpty: {
                        message: '新闻标题不能为空！'
                    }
                }
            },
            newsAuthor: {
                validators: {
                    notEmpty: {
                        message: '新闻来源不能为空！'
                    }
                }
            },
            newsImg: {
                validators: {
                    notEmpty: {
                        message: '未上传缩略图片！'
                    }

                }
            },
            newsDescription: {
                validators: {
                    notEmpty: {
                        message: '新闻简介不能为空！'
                    }

                }
            }
        }
    });

	$('#editorNews').bootstrapValidator({
        message: '输入的内容无效',

        fields: {
            newsTitle: {
                validators: {
                    notEmpty: {
                        message: '新闻标题不能为空！'
                    }
                }
            },
            newsAuthor: {
                validators: {
                    notEmpty: {
                        message: '新闻来源不能为空！'
                    }
                }
            },
            newsDescription: {
                validators: {
                    notEmpty: {
                        message: '新闻简介不能为空！'
                    }

                }
            }
        }
    });

	$('#addREC').bootstrapValidator({
        message: '输入的内容无效',

        fields: {
            recTitle: {
                validators: {
                    notEmpty: {
                        message: '岗位名称不能为空！'
                    }
                }
            },
            recClass: {
                validators: {
                    notEmpty: {
                        message: '请选择招聘分类！'
                    }
                }
            }
        }
    });
});








































