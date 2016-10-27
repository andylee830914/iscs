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
                    switch(data.error){
                        case 'typeerror':
                            alert('請上傳 zip 檔！');
                            break;
                        case 'size':
                            alert('檔案限制10MB！');
                            break;
                        default:
                            alert('系統錯誤，請洽助教！');
                            break;
                        
                    }
                    console.log("error"+data.error);

                }else{
                    console.log(data);
                    console.log("success");
                    $("#pic").val(data.userfile["name"]);
                    alert("上傳成功！");
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
