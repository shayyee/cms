/**
 * 前端登录业务类
 * @author shayyee
 */
var login = {
    check: function (url,$redirect) {
        // 获取登录页面中的用户名 和 密码
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
        var usertype = $(':checked').val();
        // var url = "/Admin/Login/check";
        var href='';
        var data = {
            'username': username,
            'password': password,
            'usertype': usertype
        };
        // 执行异步请求  $.post
        // console.log(data);
        $.post(url, data, function (result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            }
            if (result.status == 1) {
                return dialog.success(result.message, $redirect);
                // window.location.href = '/Admin/Index/index';
            }
        }, 'JSON');


    }
}