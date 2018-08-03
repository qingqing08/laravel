{{--加载头部代码--}}
@extends('layouts.header')
<header class="page-header">
    <h3>购物车</h3>
</header>

<div class="contaniner fixed-contb">
    <section class="shopcar">
        <div class="shopcar-checkbox">
            <label for="shopcar" onselectstart="return false"></label>
            <input type="checkbox" id="shopcar"/>
        </div>
        <figure><img src="/images/shopcar-ph01.png"/></figure>
        <dl>
            <dt>超级大品牌服装，现在买只要998</dt>
            <dd>颜色：经典绮丽款</dd>
            <dd>尺寸：L</dd>
            <div class="add">
                <span>-</span>
                <input type="text" value="3" />
                <span>+</span>
            </div>
            <h3>￥653.00</h3>
            <small><img src="/images/shopcar-icon01.png"/></small>
        </dl>
    </section>
    <!--去结算-->
    <div style="margin-bottom: 16%;"></div>

</div>
<script type="text/javascript">
    $(".shopcar-checkbox label").on('touchstart',function(){
        if($(this).hasClass('shopcar-checkd')){
            $(".shopcar-checkbox label").removeClass("shopcar-checkd")
        }else{
            $(".shopcar-checkbox label").addClass("shopcar-checkd")
        }
    })
</script>
<footer class="page-footer fixed-footer">
    <div class="shop-go">
        <b>合计：￥108.90</b>
        <span><a href="buy">去结算（2）</a></span>
    </div>
    <ul>
        <li>
            <a href="index">
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