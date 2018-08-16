{{--加载头部代码--}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" type="text/css" href="/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/loading.css"/>
    <link rel="stylesheet" type="text/css" href="/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/layui/css/layui.css"/>
    <script src="/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>
</head>
<!--loading页开始-->
<div class="loading">
    <div class="loader">
        <div class="loader-inner pacman">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<!--loading页结束-->
<body>
<header class="page-header">
    <h3>购物车</h3>
</header>

<div class="contaniner fixed-contb">
    @foreach($cart_list as $v)
    <section class="shopcar">
        <div class="shopcar-checkbox">
{{--            <input type="hidden" value="{{ $v->id }}"  >--}}
            <label for="shopcar" onselectstart="return false">
                <input type="hidden" id="pri_{{ $v->goods_id }}" value="{{ $v->price }}"/>
                <div>
                    <input type="hidden" value="{{ $v->goods_id }}"/>
                </div>
            </label>
            <input type="checkbox" id="shopcar_{{ $v->goods_id }}"/>
        </div>
        <figure><img src="{{ $v->image_url }}"/></figure>
        <dl>
            <dt>{{ $v->title }}</dt>
            <div class="add">
                <span onclick="up_num('jian',{{ $v->goods_id }})">-</span>
                <input type="text" id="num_{{ $v->goods_id }}" value="{{ $v->num }}" />
                <span onclick="up_num('jia' , {{ $v->goods_id }})">+</span>
            </div>
            <h3>￥<span id="price_{{ $v->goods_id }}">{{ $v->price }}</span></h3>
            <small><img src="/images/shopcar-icon01.png"/></small>
        </dl>
    </section>
    @endforeach
    <!--去结算-->
    <div style="margin-bottom: 16%;"></div>

</div>
<script src="//cdn.bootcss.com/layer/3.0.3/layer.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
<script type="text/javascript">
    $(".shopcar-checkbox label").on('touchstart',function(){
        // alert($(this).find('input').val());
        //获取label下第一个input的值---价格
        var price = $(this).find('input').val();
        //获取总价
        var p = $("#price").html();
        //获取拼接完后的商品ID
        var str = $("#str").val();
        //获取label下第一个div里头的第一个input-----goodsID
        var goods_id = $(this).find('div').find('input').val();
        // alert(goods_id);
        //判断是否有class 为chopcar-checkd的属性和值
        if($(this).hasClass('shopcar-checkd')){
            //如果有的话就remove也就是移除掉
            $(this).removeClass("shopcar-checkd")
            //定义一个sum值为选中的总价减去取消选中的金额
            var sum = Number(p)-Number(price);
            //赋值给总价
            $("#price").html(sum);
            //把取消选中的goodsid替换为空
            var str = str.replace(','+goods_id,'');
            //替换完后赋值给拼接的goodsid
            $("#str").val(str);
        }else{
            //如果没有选中class的话就添加一个class为shopcar-checkd的类
            $(this).addClass("shopcar-checkd")
            //选中的商品价格相加(转换为num不然就会变成字符串拼接)
            var sum = Number(p)+Number(price);
            //拼接选中的所有商品的ID以,号连接
            var str = str+","+goods_id;
            //把拼接完的goodsid赋值给隐藏域
            $("#str").val(str);
            //把选中的商品总价赋值给隐藏域
            $("#price").html(sum);
        }
        //获取到拼接完后的字符串
        var newstr = $("#str").val();
        //判断该字符串是否为0
        if (newstr.length != 0){
            //如果该字符串不等于0也就是不为空的情况下,用它的长度/2因为每个ID拼接了一个,符号来算出来一共选中了几件商品
            $("#length").html("("+newstr.length / 2+")");
        } else {
            //如果为0的话证明没有选中任何商品
            $("#length").html('');
        }

    })

    function up_num(obj , goods_id){
        var num = $("#num_"+goods_id).val();
        var token = $("input[name=_token]").val();
        if (num == 1){
            if (obj == 'jian') {
                layer.msg('已经是最少数量了,不可再减', {icon: 0});
                return false;
            }
        }
        $.ajax({
            url:'up_num',
            type:'post',
            data:{
                obj:obj,
                goods_id:goods_id,
                _token:token,
            },
            cache:false,
            async:false,
            success:function (data){
                // alert(data);
                $("#num_"+goods_id).val(data.num);
                var price = data.num*data.price;
                // alert(price);
                $("#price_"+goods_id).html(price);
                $("#pri_"+goods_id).val(price);
            }
        })

    }

    function buy(){
        var goods_id = $("#str").val();
        var token = $("input[name=_token]").val();
        var price = $("#price").val();
        if (goods_id == ''){
            layer.msg("没有选中商品",{icon:0});
        }
        // alert(goods_id);
        $.ajax({
            url:"buy",
            type:"post",
            dataType:"json",
            data:{
                'goods_id':goods_id,
                'price':price,
                '_token':token,
            },
            cache:false,
            async:false,
            success:function (data){
                if (data.code != 1){
                    layer.msg(data.msg, {icon: data.code});
                } else {
                    layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                        location.href = "buy_view?order_id="+data.order_id;
                    });
                }
            }
        });
    }
</script>
<footer class="page-footer fixed-footer">
    {{--@if($cart_list == '')--}}
    {{--@else--}}
        <div class="shop-go">
            <b>合计：￥<p style="display: inline;" id="price">0</p></b>
            @csrf
            <input type="hidden" value="" id="str" />
            <span onclick="buy()"><a href="#">去结算<p style="display:inline;" id="length"></p></a></span>
        </div>
    {{--@endif--}}
    <ul>
        <li>
            <a href="/">
                <img src="/images/footer001.png"/>
                <p>首页</p>
            </a>
        </li>
        <li>
            <a href="assort">
                <img src="/images/footer002.png"/>
                <p>分类</p>
            </a>
        </li>
        <li class="active">
            <a href="shopcar">
                <img src="/images/footer03.png"/>
                <p>购物车</p>
            </a>
        </li>
        <li>
            <a href="self">
                <img src="/images/footer004.png"/>
                <p>个人中心</p>
            </a>
        </li>
    </ul>
</footer>
</body>
</html>