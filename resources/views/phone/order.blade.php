<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>男装专区</title>
    <link rel="stylesheet" type="text/css" href="css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/loading.css"/>
    <link rel="stylesheet" type="text/css" href="css/base.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
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
<header class="top-header fixed-header">
    <a class="icona" href="javascript:history.go(-1)">
        <img src="images/left.png"/>
    </a>
    <h3>全部订单</h3>
    <a class="iconb" href="shopcar.html">
    </a>
</header>

<div class="contaniner fixed-conta">
    <section class="order">
        @foreach($order_list as $order)
        <dl>
            <dt>
                <time>{{ $order->time }}</time>
                <span>{{ $order->status }}</span>
            </dt>
            @foreach($order->order as $goods)
            <ul>
                <a href="detail?id={{ $goods->g_id }}">
                    <figure><img src="{{ $goods->image_url }}"/></figure>
                    <li>
                        <p>{{$goods->title}}</p>
                        <b>￥{{ $goods->price}}</b>
                        <strong>×{{ $goods->num }}</strong>
                    </li>
                </a>
            </ul>
            @endforeach
            <dd>
                <h3>商品总额</h3>
                <i>￥{{ $price }}</i>
            </dd>
            <dd>
                @if($order->status == '待支付')
                    <a href="alipay/go_pay?price={{ $price }}&order_id={{ $order->order_number }}"><input type="button"  value="{{ $order->status_b }}" class="order-que"/></a>
                    <input type="button" value="取消订单" />
                @elseif($order->status == '已发货')
                    <input type="button" value="{{ $order->status_b }}" class="order-que"/>
                    <input type="button" value="查看物流" onclick="javascript:location.href='wuliu'" />
                    <input type="button" value="取消订单" />
                @elseif($order->status == '已完成')
                    <input type="button" value="{{ $order->status_b }}" class="order-que"/>
                    <input type="button" value="查看物流" onclick="javascript:location.href='wuliu'" />
                    <input type="button" value="取消订单" />
                @else
                @endif
            </dd>
        </dl>
        @endforeach
        @csrf
    </section>
</div>
</body>
</html>
<script type="text/javascript">
    function go_pay(price , order_id){
        // alert(price);
        // alert(order_id);
        var token = $("input[name=_token]").val();
        $.ajax({
            'url':'go_pay',
            'type':'post',
            'data':{
                price:price,
                order_id:order_id,
                _token:token,
            },
            async:false,
            cache:false,
            success:function (data){
                // alert(data);
            }
        });
    }
</script>