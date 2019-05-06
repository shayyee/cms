/**
 * Created by Administrator on 2017/2/8.
 */
var dialog = {
    // 错误弹出层
    error: function(message) {
        layer.open({
            content:message,
            icon:2,
            title : '错误提示'
        });
    },
    error_f: function(message,fun) {
        layer.open({
            content:message,
            icon:2,
            title : '错误提示',
            yes : fun
        });
    },
    //成功弹出层
    success : function(message,url) {
        layer.open({
            content:message,
            icon : 1,
            title:"提示",
            yes : function(){
                location.href=url;
            }
        });
    },
    success_f : function(message,fun) {
        layer.open({
            content : message,
            icon : 1,
            title:"提示",
            yes : fun,
        });
    },

    // 确认弹出层
    confirm : function(message, url) {
        layer.open({
            content : message,
            icon:3,
            btn : ['是','否'],
            yes : function(){
                location.href=url;
            },
        });
    },

    //无需跳转到指定页面的确认弹出层
    toconfirm : function(message) {
        layer.open({
            content : message,
            icon:3,
            btn : ['确定'],
        });
    },
}

