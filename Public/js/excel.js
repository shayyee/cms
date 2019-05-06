/**
 * Created by Administrator on 2017/3/2.
 */
/**
 * 图片上传功能
 */
$(function() {
    $('#file_upload').uploadify({
        'swf'      : SCOPE.ajax_upload_swf,
        'uploader' : SCOPE.ajax_upload_excel_url,
        'removeTimeout' : 10,
        'buttonText': '上传Excel文件',
        'fileTypeDesc': 'Excel Files',
        'fileObjName' : 'file',
        'fileTypeExts': '*.xls; *.xlsx',
        'onUploadSuccess' : function(file,data,response) {
            // response true ,false
            if(response) {
                var obj = JSON.parse(data); //由JSON字符串转换为JSON对象
                $('#' + file.id).find('.data').html(' 上传完毕');
                $("#file_upload_excel").attr('value',obj.data);
            }else{
                alert('上传失败');
            }
        },
    });
    
    // $(".a-upload").on("change","input[type='file']",function(){
    //     var filePath=$(this).val();
    //     if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1){
    //         $(".fileerrorTip").html("").hide();
    //         var arr=filePath.split('\\');
    //         var fileName=arr[arr.length-1];
    //         $(".showFileName").html(fileName);
    //     }else{
    //         $(".showFileName").html("");
    //         $(".fileerrorTip").html("您未上传文件，或者您上传文件类型有误！").show();
    //         return false
    //     }
    // })
});