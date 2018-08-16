<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>商城</title>
    <link rel="stylesheet" type="text/css" href="/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/loading.css"/>
    <link rel="stylesheet" type="text/css" href="/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
    <link rel="stylesheet" type="text/css" href="/layui/css/layui.css"/>
    <script src="/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
        // $(document).ready(function () {
        //     $.ajax({
        //
        //     })
        // });
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
<header class="detail-header fixed-header">
    <a href="javascript:history.go(-1)"><img src="/images/detail-left.png"/></a>

    <a href="shopcar.html" class="right"><img src="/images/shopbar.png"/></a>
</header>


<div class="contaniner fixed-contb">
    <section class="detail">
        <figure class="swiper-container">
            <ul class="swiper-wrapper">
                <li class="swiper-slide">
                    <a href="#">
                        <img src="{{ $goods_info->image_url }}"/>
                    </a>
                </li>
                <li class="swiper-slide">
                    <a href="#">
                        <img src="{{ $goods_info->image_url }}"/>
                    </a>
                </li>
                <li class="swiper-slide">
                    <a href="#">
                        <img src="{{ $goods_info->image_url }}"/>
                    </a>
                </li>
                <li class="swiper-slide">
                    <a href="#">
                        <img src="{{ $goods_info->image_url }}"/>
                    </a>
                </li>
            </ul>
            <div class="swiper-pagination">
            </div>
        </figure>
        <dl class="jiage">
            <dt>
                <h3>{{ $goods_info->name }}</h3>
                <div class="collect">
                    <img src="/images/detail-heart-hei.png"/>
                    <p>收藏</p>
                </div>
            </dt>
            <dd>
                <b>￥{{ $goods_info->in_price }}</b>
                <del>￥{{ $goods_info->out_price }}</del>
                <input type="button" value="包邮" readonly />
                {{--<small>+356积分</small>--}}
            </dd>
        </dl>

        <a href="#" class="seven">
            <b>7</b>天无理由退换货
            <span id="sss"></span>
        </a>

        <article class="detail-article">
            <nav>
                <ul class="article">
                    <li id="talkbox1" class="article-active">商品详情</li>
                    <li id="talkbox2">评价</li>
                </ul>
            </nav>

            <section class="talkbox1">
                会尽快啦辅导费发挥大路口
            </section>

            <section class="talkbox2" style="display: none;">
                <ul class="talk">
                    <li>
                        <figure><img src="/images/detail-tou.png"/></figure>
                        <dl>
                            <dt>
                                <p>瑾晨</p>
                                <time>2015.11.17</time>
                                <div class="star">
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn001.png"/></span>
                                    <span><img src="/images/detail-iocn001.png"/></span>
                                </div>
                            </dt>
                            <dd>哎哟不错哦，很性感哦！</dd>
                            <small>颜色：豹纹凯特</small>
                        </dl>
                    </li>
                    <li>
                        <figure><img src="/images/detail-tou.png"/></figure>
                        <dl>
                            <dt>
                                <p>瑾晨</p>
                                <time>2015.11.17</time>
                                <div class="star">
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn001.png"/></span>
                                    <span><img src="/images/detail-iocn001.png"/></span>
                                </div>
                            </dt>
                            <dd>哎哟不错哦，很性感哦！</dd>
                            <small>颜色：豹纹凯特</small>
                            <div class="picbox">
                                <img src="/images/detail-pp01.png"/>
                                <img src="/images/detail-pp02.png"/>
                                <img src="/images/detail-pp03.png"/>
                                <img src="/images/detail-pp04.png"/>
                            </div>
                        </dl>
                    </li>
                    <li>
                        <figure><img src="/images/detail-tou.png"/></figure>
                        <dl>
                            <dt>
                                <p>瑾晨</p>
                                <time>2015.11.17</time>
                                <div class="star">
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn001.png"/></span>
                                    <span><img src="/images/detail-iocn001.png"/></span>
                                </div>
                            </dt>
                            <dd>哎哟不错哦，很性感哦！</dd>
                            <small>颜色：豹纹凯特</small>
                        </dl>
                    </li>
                    <li>
                        <figure><img src="/images/detail-tou.png"/></figure>
                        <dl>
                            <dt>
                                <p>瑾晨</p>
                                <time>2015.11.17</time>
                                <div class="star">
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn01.png"/></span>
                                    <span><img src="/images/detail-iocn001.png"/></span>
                                    <span><img src="/images/detail-iocn001.png"/></span>
                                </div>
                            </dt>
                            <dd>哎哟不错哦，很性感哦！</dd>
                            <small>颜色：豹纹凯特</small>
                            <div class="picbox">
                                <img src="/images/detail-pp01.png"/>
                                <img src="/images/detail-pp02.png"/>
                                <img src="/images/detail-pp03.png"/>
                                <img src="/images/detail-pp04.png"/>
                            </div>
                        </dl>
                    </li>
                </ul>
            </section>

        </article>
    </section>
</div>


<footer class="detail-footer fixed-footer">
    <a href="#" class="go-car">
        <input type="button" onclick="create_cart({{ $goods_info->id }},{{$goods_info->out_price }})" value="加入购物车"/>
        @csrf
    </a>
    <a href="buy.html" class="buy">
        立即购买
    </a>
</footer>

<script src="/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="//cdn.bootcss.com/layer/3.0.3/layer.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
<script type="text/javascript">
    $(window).scroll(function() {
        if ($(".detail-header").offset().top > 50) {
            $(".detail-header").addClass("change");
        } else {
            $(".detail-header").removeClass("change");
        }
    });

    function create_cart(goods_id , goods_price){
        var token = $('input[name=_token]').val();
        // alert(goods_price);
        $.ajax({
            url:"create_cart",
            type:"post",
            dataType:"json",
            data:{
                'goods_id':goods_id,
                'goods_price':goods_price,
                '_token':token,
            },
            cache:false,
            async:false,
            success:function (data){
                if (data.code == 1) {
                    // location.href = "/shopcar";
                    layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                        location.href = "/shopcar";
                    });
                } else if (data.code == 0) {
                    // location.href = "/login";
                    layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                        location.href = "login";
                    });
                } else {
                    layer.msg(data.msg, {icon: data.code});
                }

            }
        })
    }
</script>
<script src="/js/swiper.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var mySwiper = new Swiper('.swiper-container',{
            loop: true,
            speed:1000,
            autoplay: 2000,
            pagination: '.swiper-pagination',
        });
    })
</script>
<script type="text/javascript">
    $(function(){
        $('.chose li').click(function(){

            $(this).addClass('chose-active').siblings().removeClass('chose-active');

            var tags=document.getElementsByClassName('chose-active');//获取标签

            var tagArr = "";
            for(var i=0;i < tags.length; i++)
            {
                tagArr += tags[i].innerHTML;//保存满足条件的元素

            }

            $('#sss').html(tagArr);

        });

        $('.article li').click(function(){

            $(this).addClass('article-active').siblings().removeClass('article-active');
            if($(this).attr("id")=="talkbox1"){
                $('.talkbox1').show();
                $('.talkbox2').hide();
            }else{
                $('.talkbox2').show();
                $('.talkbox1').hide();
            }

        });
    });
</script>
</body>
</html>