/**
 * Created by Administrator on 2017/2/9.
 */

/**
 * 添加按钮操作
 */
$("#button-add").click(function(){
    var url = SCOPE.add_url;
    window.location.href=url;
});
$("#button-import").click(function(){
    var url = SCOPE.import_url;
    window.location.href=url;
});
$("#singcms-button-back").click(function(){
    history.go(-1);
});
/**
 * 提交form表单操作
 */
$("#singcms-button-submit").click(function(){
    var data = $("#singcms-form").serializeArray();
    var postData = {};
    $(data).each(function(i){
        postData[this.name] = this.value;
    });
    console.log(postData);
    //验证数据格式
    var reg_email = /^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/;
    var reg_qq = /^[1-9][0-9]{4,9}$/;
    if(postData['email'] && !reg_email.test(postData['email'])){
        layer.tips('邮箱格式不正确', ":input[name='email']");
        return false;
    }
    if(postData['password'] && postData['password'].length<6){
        layer.tips('密码不能小于6位', ":input[name='password']");
        return false;
    }
    if(postData['qq'] && !reg_qq.test(postData['qq'])){
        layer.tips('QQ号格式不正确', ":input[name='qq']");
        return false;
    }
    // 将获取到的数据post给服务器
    url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    $.post(url,postData,function(result){
        if(result.status == 1) {
            //成功
            return dialog.success(result.message,jump_url);
        }else if(result.status == 0) {
            // 失败
            return dialog.error(result.message);
        }
    },"JSON");
});
$("#singcms-button-submit1").click(function(){
    var data = $("#singcms-form1").serializeArray();
    var postData = {};
    $(data).each(function(i){
        postData[this.name] = this.value;
    });
    // 将获取到的数据post给服务器
    url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    $.post(url,postData,function(result){
        if(result.status == 1) {
            //成功
            return dialog.success(result.message,jump_url);
        }else if(result.status == 0) {
            // 失败
            return dialog.error(result.message);
        }
    },"JSON");
});

$("#singcms-button-import").click(function(){
    var postData = {};
    postData['excel'] = $(":input[name='excel']").val();
    // 将获取到的数据post给服务器
    url = SCOPE.import_url;
    jump_url = SCOPE.jump_url;
    
    $.post(url,postData,function(result){
        if(result.status == 1) {
            //成功
            return dialog.success(result.message,jump_url);
        }else if(result.status == 0) {
            // 失败
            return dialog.error(result.message);
        }
    },"JSON");
});
/*
 编辑模型
 */
$('.singcms-table #singcms-edit').on('click',function(){
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url + '?id='+id;
    window.location.href=url;
});


/**
 * 删除操作JS
 */
$('.singcms-table #singcms-delete').on('click',function(){
    var id = $(this).attr('attr-id');
    // var message = $(this).attr("attr-message");
    var url = SCOPE.delete_url;

    var data = {};
    data['id'] = id;
    // if(id==1){
    //     layer.open({
    //         content:"不允许删除该帐号",
    //         icon:2,
    //         btn : "我知道了"
    //     });
    //     return false;
    // }
    layer.open({
        type : 0,
        title : '操作提示',
        btn: ['确定', '取消'],
        icon : 3,
        closeBtn : 2,
        content: "是否确定删除",
        scrollbar: true,
        yes: function(){
            // 执行相关跳转
            todelete(url, data);
        }
    });

});
function todelete(url, data) {
    $.post(url, data,
        function(s){
            if(s.status == 1) {
                return dialog.success(s.message,'');
                // 跳转到相关页面
            }else {
                return dialog.error(s.message);
            }
        }
        ,"JSON");
}

/**
 * 排序操作
 */
$('#button-listorder').click(function() {
    // 获取 listorder内容
    var data = $("#singcms-listorder").serializeArray();
    postData = {};
    $(data).each(function(i){
        postData[this.name] = this.value;
    });
    console.log(data);
    var url = SCOPE.listorder_url;
    $.post(url,postData,function(result){
        if(result.status == 1) {
            //成功
            return dialog.success(result.message,result['data']['jump_url']);
        }else if(result.status == 0) {
            // 失败
            return dialog.error(result.message,result['data']['jump_url']);
        }
    },"JSON");
});

