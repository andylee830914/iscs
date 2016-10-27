$(document).ready(function(){

    $('#mysubmit').click(function(e) {
        e.preventDefault();
        $.ajaxFileUpload({
            url             :site_url + '/upload/upload.php',
            secureuri       :false,
            fileElementId   :'userfile',
            dataType: 'JSON',
            success : function (data)
            {
                data=JSON.parse(data);
                if(data.error){
                    console.log("error");
                    alert(data.error+'\n上傳限制：解析度小於 1920x1080，且檔案小於 512KB。');
                }else{
                    console.log(data);
                    console.log("success");
                    $("#pic").val(data.userfile["name"]);
                }

            }
        });
        return false;
    });


    // $('#deletepic').click(function (e) {
    //     e.preventDefault();
    //     $("#pic").val("");
    //     return false;
    // });
});
