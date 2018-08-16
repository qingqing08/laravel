@extends('layouts.header')
<header class="top-header">
    <a class="text texta" href="javascript:history.go(-1)">返回</a>
    <h3>重置密码</h3>
</header>
<style>
    .lis{height: 50px;}
    .lis .left{width: 50% !important;float:left;height: 100%;}
    #codeseon{float:right;width: 30% !important;font-size:18px !important;}
</style>

<div class="login">
    <form action="#">
        @csrf
        <input type="hidden" name="uid" id="uid" value="{{ $data['id'] }}">
        <ul>
            <li>
                <img src="/images/login.png"/>
                <label>电话</label>
                <input type="text" name="phone" id="phone" placeholder="请输入手机号"/>
            </li>
            <li class = "lis">
                <div class = 'left'>
                <img src="images/password.png"/>
                <input type="text" placeholder="请输入验证码" style ="width:58%;" id="code">
                </div>
                    <input type="button" id="codeseon"value="点击发送验证码" style="width:30%;border-radius:8px; background:#0f0; font-size: 1.7em; padding: 3% 2%;" />
            </li>
            <li>
                <img src="/images/password.png"/>
                <input type="password" name="password" id="password" placeholder="输入新密码"/>
            </li>
            <li>
                <img src="/images/password.png"/>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="输入确认密码"/>
            </li>
        </ul>
        <input type="submit" lay-submit lay-filter="formDemo" value="立即修改" />
    </form>
</div>

</body>
</html>
<script src="/layui/layui.js"></script>
<script>
    layui.use('form', function(){
        var form = layui.form;
        //  监听提交
        form.on('submit(formDemo)', function(data){
            var uid = $("#uid").val();
            var password = $("#password").val();
            var confirm_password = $('#confirm_password').val();
            var token = $("input[name=_token]").val();
            $.ajax({
                url:"reset_do",
                type:"post",
                dataType:"json",
                data:{
                    'uid':uid,
                    'password':password,
                    'confirm_password':confirm_password,
                    '_token':token,
                },
                cache:false,
                async:false,
                success:function (data){
                    // alert(data);
                    if (data.code == 1) {
                        layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                            location.href = "self";
                        });
                    } else if (data.code == 5) {
                        layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                            location.href = "login";
                        });
                    } else {
                        layer.msg(data.msg, {icon: data.code});
                    }

                }
            })

            return false;
        });
    });
</script>