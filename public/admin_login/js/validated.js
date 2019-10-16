var validated = {
    admin_name: false,
    admin_pwd: false,
    // admin_code: false,
    default_code:false
};
$(function(){
    $('body').particleground({
        dotColor: '#5cbdaa',
        lineColor: '#5cbdaa'
    });
    //验证码
    createCode();
    //登录验证
    var register = $(".submit_btn");
    register.click(function() {
        // alert('sdf');
        var isOk = validated.admin_name&& validated.admin_pwd  && validated.default_code;
        if(isOk) {
            location.href="index";
            return true;
        }
        //点击提交按钮依次触发失去焦点再次验证
        $('input[name=admin_name]').trigger('blur');
        $('input[name=admin_pwd]').trigger('blur');
        $('.ver_btn').trigger('click');
        // $('input[name=admin_code]').trigger('blur');
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
            $(this).css({"color":"white"});
        }
        //用户名正则，4到16位（字母，数字，下划线，减号）
        if(!/^[a-zA-Z0-9_-]{4,16}$/g.test(admin_name)){
            obj.css({"color":"red"});
            obj.val(admin_name);
            validated.admin_name= false;
            return;
        }
        $.ajax({
            type: "get",
            url: "login_do_name",
            data: {
                admin_name: admin_name
            }, //携带的参数
            dataType: 'json',
            beforeSend: function () {
                obj.css({"color":"blue"});
                obj.val('请求中');
            },
            success: function (res) {
                //根据后台返回前台的msg给提示信息加HTML
                // alert (data.status);
                if (res.status == 1) {
                    obj.css({"color":"green"});
                    obj.val(admin_name);
                    validated.admin_name = true;
                } else {
                    obj.css({"color":"red"});
                    obj.val(admin_name+'不存在');
                    validated.user_account =false;
                }
            },
            error: function () {
                obj.css({"color":"red"});
                obj.val('网络异常');
                validated.user_account = false;
            }
        });
    });

    //---------验证密码-------------
    $('input[name=admin_pwd]').blur(function(){
        var admin_pwd = $(this).val();
        var admin_name=$('input[name=admin_name]').val();
        var obj=$(this);
        //不能为空
        if(admin_pwd == ''){
            $(this).css({"color":"red"});
            $(this).val('X');
            validated.admin_pwd = false;
            return;
        }else{
            $(this).css({"color":"white"});
        }
        //正则判断
        // 用户名正则，4到16位（字母，数字，下划线，减号）
        if(!/^[a-zA-Z0-9_-]{4,16}$/g.test(admin_pwd)){
            $(this).css({"color":"red"});
            $(this).val(admin_pwd);
            validated.admin_pwd = false;
            return;
        }
        $.ajax({
            type: "get",
            url: "login_do_pwd",
            data: {
                admin_pwd: admin_pwd,
                admin_name:admin_name
            }, //携带的参数
            dataType: 'json',
            beforeSend: function () {
                obj.css({"color":"blue"});
                obj.val('请求中');
            },
            success: function (res) {
                //根据后台返回前台的msg给提示信息加HTML
                // alert (data.status);
                if (res.status == 1) {
                    obj.css({"color":"green"});
                    obj.val(admin_pwd);
                    validated.admin_pwd = true;
                } else {
                    obj.css({"color":"red"});
                    obj.val(admin_pwd);
                    validated.user_account =false;
                }
            },
            error: function () {
                obj.css({"color":"red"});
                obj.val('网络异常');
                validated.admin_pwd = false;
            }
        });
    });
    //验证码
    // $('input[name=admin_code]').blur(function(){
    //     var admin_code = $(this).val();
    //     var obj=$(this);
    //     //不能为空
    //     if(admin_code == ''){
    //         $(this).css({"color":"red"});
    //         $(this).val('验证码不能为空');
    //         validated.admin_code = false;
    //         return;
    //     }else {
    //         obj.css({"color":"green"});
    //         obj.val(admin_code);
    //         validated.admin_code = true;
    //     }
    // });
   // 验证验证码
    $('.ver_btn').click(function() {
        var default_code=$('input[name=admin_code]').val();
        if(default_code!='验证码错误'&&default_code!=''){
            validated.default_code = true;
        }else {
            validated.default_code = false;
        }

    });
});