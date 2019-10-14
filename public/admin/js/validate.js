var validated = {
    admin_name: false,
    admin_pwd: false,
    admin_pwded:false,
    admin_email:false
};
$(function(){
    //增加管理员验证
    var register = $('input[name=submit]');
    var role_id = $('input[name=role_id]');
    register.click(function() {
        // alert('sdf');
        var isOk = validated.admin_name&& validated.admin_pwd  && validated.admin_pwded && validated.admin_email;
        if(isOk) {
            //发送ajax插入
            // return true;

            // $.ajax({
            //     type: "post",
            //     url: "add_do",
            //     data: {
            //         admin_name: admin_name,
            //         admin_email:admin_email,
            //         role_id:role_id
            //
            //     }, //携带的参数
            //     dataType: 'json',
            //     beforeSend: function () {
            //         obj.css({"color":"blue"});
            //         obj.val('请求中');
            //     },
            //     success: function (res) {
            //         if (res.status == 1) {
            //             alert(添加成功);
            //             location.href="show";
            //             return true;
            //         } else {
            //             location.href="add";
            //             alert(添加失败);
            //             return false;
            //         }
            //     },
            //     error: function () {
            //         location.href="add";
            //         alert(网络异常);
            //         return false;
            //     }
            // });
            // location.href="show";
            return true;
        }
        //点击提交按钮依次触发失去焦点再次验证
        $('input[name=admin_name]').trigger('blur');
        $('input[name=admin_pwd]').trigger('blur');
        $('input[name=admin_pwded]').trigger('blur');
        $('input[name=admin_email]').trigger('blur');
        return false;
    });
    //-------验证用户名-------
    $('input[name=admin_name]').blur(function(){
        var admin_name = $(this).val();
        var obj=$(this);
        //不能为空
        if(admin_name== ''){
            // msg = '用户名不能为空！';
            $(this).css({"color":"red"});
            $(this).val('用户名不能为空');
            validated.admin_name = false;
            return;
        }else{
            $(this).css({"color":"blue"});
        }
        //用户名正则，4到16位（字母，数字，下划线，减号）
        if(!/^[a-zA-Z0-9_-]{4,16}$/g.test(admin_name)){
            obj.css({"color":"red"});
            obj.val(admin_name);
            validated.admin_name= false;
            return;
        }
        //验证用户名是否存在
        $.ajax({
            type: "get",
            url: "find",
            data: {
                admin_name: admin_name
            }, //携带的参数
            dataType: 'json',
            beforeSend: function () {
                obj.css({"color":"blue"});
                obj.val('请求中');
            },
            success: function (res) {
                if (res.status == 1) {
                    obj.css({"color":"green"});
                    obj.val(admin_name);
                    validated.admin_name = true;
                } else {
                    obj.css({"color":"red"});
                    obj.val(admin_name+'已存在');
                    validated.user_account =false;
                }
            },
            error: function () {
                obj.css({"color":"red"});
                obj.val('网络异常');
                validated.user_account = false;
            }
        });
        // $(this).css({"color":"green"});
        // $(this).val(admin_name);
        // validated.admin_name = true;
    });

    //---------验证密码-------------

    $('input[name=admin_pwd]').blur(function(){
        var admin_pwd = $(this).val();
        var obj=$(this);
        //不能为空
        if(admin_pwd == ''){
            $(this).css({"color":"red"});
            $(this).val('X');
            validated.admin_pwd = false;
            return;
        }else{
            $(this).css({"color":"blue"});
        }
        //正则判断
        // 用户名正则，4到16位（字母，数字，下划线，减号）
        if(!/^[a-zA-Z0-9_-]{4,16}$/g.test(admin_pwd)){
            $(this).css({"color":"red"});
            $(this).val(admin_pwd);
            validated.admin_pwd = false;
            return;
        }
        $(this).css({"color":"green"});
        $(this).val(admin_pwd);
        validated.admin_pwd = true;
    });
//    验证确认密码
    $('input[name=admin_pwded]').blur(function(){
        var admin_pwded = $(this).val();
        var admin_pwd= $('input[name=admin_pwd]').val();
        var obj=$(this);
        //不能为空
        if(admin_pwded == ''){
            $(this).css({"color":"red"});
            $(this).val('X');
            validated.admin_pwded = false;
            return;
        }
        //和第一次的密码比较
        if(admin_pwded!=admin_pwd){
            $(this).css({"color":"red"});
            $(this).val(admin_pwded);
            validated.admin_pwded = false;
            return;
        }
        $(this).css({"color":"green"});
        $(this).val(admin_pwded);
        validated.admin_pwded = true;
    });
//    验证邮箱
    $('input[name=admin_email]').blur(function(){
        var admin_email = $(this).val();
        var obj=$(this);
        //不能为空
        if(admin_email == ''){
            $(this).css({"color":"red"});
            $(this).val('邮箱不能为空');
            validated.admin_email = false;
            return;
        }else{
            $(this).css({"color":"blue"});
        }
        //正则判断
        if(!/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/g.test(admin_email)){
            $(this).css({"color":"red"});
            $(this).val(admin_email);
            validated.admin_email = false;
            return;
        }
        $(this).css({"color":"green"});
        $(this).val(admin_email);
        validated.admin_email = true;
    });
});