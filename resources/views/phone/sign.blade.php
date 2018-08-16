<html>
<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<body>
    <div>
        @csrf
        <button onclick="sign()" >签到</button>
        <span id="content"></span>
    </div>
    <br />
    <table border="1">
        <tr>
            <td>总计签到</td>
            <td>最近连续签到</td>
            <td>获得积分</td>
        </tr>
        @foreach($list as $value)
        <tr>
            <td>{{ $value->number }}次</td>
            <td>{{ $value->day }}天</td>
            <td>{{ $value->integral }}分</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
<script>
    function sign(){
        var token = $("input[name=_token]").val();
        $.ajax({
            url:"sign_do",
            type:"post",
            data:{
                _token:token,
            },
            cache:false,
            async:false,
            success:function (msg){
                // alert(msg.uid);
                $("#content").html(msg.msg);
            }
        })
    }
</script>