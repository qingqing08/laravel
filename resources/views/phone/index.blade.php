<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>首页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <script src="js/rem.js"></script>
    <link href="iconfont/iconfont.css" rel="stylesheet">
    <link href="css/mui.min.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/base.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<header class="mui-bar mui-bar-nav" id="header">
    <div class="top-sch-box flex-col">
        <div class="centerflex">
            <i class="fdj iconfont icon-search"></i>
            <div class="sch-txt">说出你想要的吧</div>
            <span class="shaomiao"><i class="iconfont icon-saoma"></i></span>
        </div>
    </div>
    <a class="btn" href="">
        <i class="iconfont icon-tixing"></i>
    </a>
    <a class="btn" href="shopcar">
        <i class="iconfont icon-cart"></i>
    </a>
</header>

<div id="main" class="mui-clearfix">
    <!-- 搜索层 -->
    <div class="pop-schwrap">
        <div class="ui-scrollview">
            <div class="mui-bar mui-bar-nav clone">
                <a class="btn btn-back" href="javascript:;"></a>
                <div class="top-sch-box flex-col">
                    <div class="centerflex">
                        <input class="sch-input mui-input-clear" type="text" name="" id="" placeholder="连衣裙就是你的女人味儿" />
                    </div>
                </div>
                <a class="mui-btn mui-btn-primary sch-submit" href="search.html">搜索</a>
            </div>
            <div class="scroll-wrap">
                <div class="mui-scroll">
                    <div class="sch-cont">
                        <div class="section ui-border-b">
                            <div class="tit"><i class="iconfont icon-hot"></i>热门搜索</div>
                            <div class="tags">
                                <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span><span class="tag">睡衣</span>
                                <span class="tag actice">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span><span class="tag">睡衣</span>
                                <span class="tag">外套</span><span class="tag actice">连衣裙</span><span class="tag">运动鞋</span>
                            </div>
                        </div>
                        <div class="section">
                            <div class="tit"><i class="iconfont icon-time"></i>最近搜索</div>
                            <div class="tags">
                                <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span><span class="tag">睡衣</span>
                                <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span><span class="tag">睡衣</span>
                                <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span>
                            </div>
                        </div>
                    </div>
                    <div class="sch-clear">
                        <a href="javascript:void"><i class="iconfont icon-shanchu"></i>清除搜索历史</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mui-content">
        <div class="banner swiper-container">
            <div class="swiper-wrapper">
                @foreach($bannerlist as $banner)
                <div class="swiper-slide"><a href="javascript:void({{ $banner->id }})"><img class="swiper-lazy" data-src="{{ $banner->image_url }}" alt=""></a></div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="home-fashion ui-box ui-border-t">
            <div class="fastion-plist mui-row">
                @foreach($goodslist as $goods)
                <div class="mui-col-xs-4">
                    <a class="item" href="detail?id={{ $goods->id }}">
                        <img src="{{ $goods->image_url }}" alt="" class="figure" /><span class="tit">{{ $goods->name }}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div> <!--mui-content end-->
</div>
{{--加载尾部代码--}}
@extends('layouts.footer');

</body>
<script type="text/javascript" src="js/jquery-1.8.3.min.js" ></script>
<script src="js/fastclick.js"></script>
<script src="js/mui.min.js"></script>
<script type="text/javascript" src="js/hmt.js" ></script>
<!--插件-->
<link rel="stylesheet" href="js/swiper/swiper.min.css">
<script src="js/swiper/swiper.jquery.min.js"></script>
<!--插件-->
<script src="js/global.js"></script>
<script >
    $(function () {
        var banner = new Swiper('.banner',{
            autoplay: 5000,
            pagination : '.swiper-pagination',
            paginationClickable: true,
            lazyLoading : true,
            loop:true
        });

        mui('.pop-schwrap .sch-input').input();
        var deceleration = mui.os.ios?0.003:0.0009;
        mui('.pop-schwrap .scroll-wrap').scroll({
            bounce: true,
            indicators: true,
            deceleration:deceleration
        });
        $('.top-sch-box .fdj,.top-sch-box .sch-txt,.pop-schwrap .btn-back').on('click',function () {
            $('html,body').toggleClass('holding');
            $('.pop-schwrap').toggleClass('on');
            if($('.pop-schwrap').hasClass('on')) {;
                $('.pop-schwrap .sch-input').focus();
            }
        });

    });
</script>
</html>
