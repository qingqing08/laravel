@extends('layouts.header')
<header class="top-header">
    <h3>注册</h3>
    <a class="text" href="login">登录</a>
</header>

<div class="login">
    <form action="#">
        @csrf
        <ul>
            <li>
                <img src="/images/login.png"/>
                <label>账号</label>
                <input type="text" name="username" id="username" placeholder="请输入账号"/>
            </li>
            <li>
                <img src="/images/login.png"/>
                <label>电话</label>
                <input type="text" name="phone" id="phone" placeholder="请输入手机号"/>
            </li>
            <li>
                <img src="/images/password.png"/>
                <label>验证码</label>
                <input type="text" placeholder="请输入验证码" style ="width:44%;" id="code">
                <input type="button" onclick="get_code()" id="codeseon"value="点击发送验证码" style="width:30%;border-radius:8px; background:#0f0; font-size: 1.7em; padding: 3% 2%;" />
            </li>
            <li>
                <img src="/images/password.png"/>
                <label>密码</label>
                <input type="password" name="password" id="password" placeholder="请输入密码"/>
            </li>
        </ul>
        <input type="submit" lay-submit lay-filter="formDemo" value="注册" />
    </form>
</div>

</body>
</html>
<script src="/layui/layui.js"></script>
{{--<script src="//cdn.bootcss.com/layer/3.0.3/layer.min.js"></script>--}}
{{--<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>--}}
<script type="text/javascript">
    layui.use('form', function(){
        var form = layui.form;
        //  监听提交
        form.on('submit(formDemo)', function(data){
            var username = $("#username").val();
            var password = $("#password").val();
            var phone = $("#phone").val();
            var code = $("#code").val();
            var token = $("input[name=_token]").val();
            $.ajax({
                url:"register_do",
                type:"post",
                dataType:"json",
                data:{
                    'username':username,
                    'password':password,
                    'phone':phone,
                    'code':code,
                    '_token':token,
                },
                cache:false,
                async:false,
                success:function (data){
                    // alert(data);
                    if (data.code == 1) {
                        layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                            location.href = "/login";
                        });
                    } else {
                        layer.msg(data.msg, {icon: data.code});
                    }

                }
            })

            return false;
        });
    });

    function get_code(){
        var phone = $("#phone").val();
        var token = $("input[name=_token]").val();
        var intDiff = parseInt(60);
        alert(phone);
        $.ajax({
            url:'get_sms',
            type:'post',
            dataType:'json',
            data:{
                phone:phone,
                _token:token,
            },
            async:false,
            cache:false,
            success:function (data){
                alert(data.msg);
                if (data.code == 1) {
        //             // layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                        window.setInterval(function(){
                            var second=0;//时间默认值
                            if(intDiff > 0){
                                second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
                            }
                            if (second <= 9) second = '0' + second; $('#codeseon').attr('disabled',true);
                            $('#codeseon').val('<s></s>'+second+'秒');
                            $('#codeseon').attr('disabled',false);
                            intDiff--;
                        }, 1000);
        //             // });
                }
            }
        })
    }
</script>
