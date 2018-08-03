{{--加载头部代码--}}
@extends('layouts.header')
<div class="p-top  clearfloat">
    <a href="personal.html">
        <div class="tu">
            <img src="/img/touxiang.png"/>
        </div>
        <p class="name">Guoguo</p>
    </a>
    <div class="p-bottom p-bottom1 clearfloat">
        <ul class="clearfloat">
            <a href="fx-center1.html">
                <li class="box-s">
                    <span class="opa6"></span>
                    <p class="bt">我的佣金</p>
                    <p class="price">0.00</p>
                </li>
            </a>
            <a href="#">
                <li class="box-s">
                    <span class="opa6"></span>
                    <p class="bt">我的积分</p>
                    <p class="price">0</p>
                </li>
            </a>
            <a href="#">
                <li class="box-s">
                    <span class="opa6"></span>
                    <p class="bt">我的足迹</p>
                    <p class="price">0</p>
                </li>
            </a>
        </ul>
    </div>
</div>

<div class="contaniner fixed-contb">
    <section class="self">
        <dl>
            <dt>
                <a href="order.html">
                    <img src="/images/self-icon.png"/>
                    <b>全部订单</b>
                    <span><img src="/images/right.png"/></span>
                </a>
            </dt>
            <dd>
                <ul>
                    <li>
                        <a href="ordertwo.html">
                            <img src="/images/order-icon01.png"/>
                            <p>待发货</p>
                        </a>
                    </li>
                    <li>
                        <a href="orderthree.html">
                            <img src="/images/order-icon03.png"/>
                            <p>待付款</p>
                        </a>
                    </li>
                    <li>
                        <a href="orderfour.html">
                            <img src="/images/order-icon02.png"/>
                            <p>待收货</p>
                        </a>
                    </li>
                    <li>
                        <a href="go-assess.html">
                            <img src="/images/order-icon04.png"/>
                            <p>待评价</p>
                        </a>
                    </li>
                </ul>
            </dd>
        </dl>

        <ul class="self-icon">
            <li>
                <a href="datum.html">
                    <img src="/images/self-icon01.png"/>
                    <p>个人信息</p>
                    <span><img src="/images/right.png"/></span>
                </a>
            </li>
            <li>
                <a href="mycollect.html">
                    <img src="/images/self-icon02.png"/>
                    <p>我的收藏</p>
                    <span><img src="/images/right.png"/></span>
                </a>
            </li>
            <li>
                <a href="balance.html">
                    <img src="/images/self-icon012.png"/>
                    <p>消费记录</p>
                    <span><img src="/images/right.png"/></span>
                </a>
            </li>
            <li>
                <a href="addres.html">
                    <img src="/images/self-icon04.png"/>
                    <p>地址管理</p>
                    <span><img src="/images/right.png"/></span>
                </a>
            </li>
        </ul>
        <ul class="self-icon">
            <li>
                <a href="gobuy.html">
                    <img src="/images/self-icon05.png"/>
                    <p>我的分销</p>
                    <span><img src="/images/right.png"/></span>
                </a>
            </li>
            <li>
                <a href="sign.html">
                    <img src="/images/self-icon011.png"/>
                    <p>修改密码</p>
                    <span><img src="/images/right.png"/></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/images/self-icon013.png"/>
                    <p>账号绑定</p>
                    <span><img src="/images/right.png"/></span>
                </a>
            </li>
        </ul>
        <a href="login"><input type="button" value="退出" /></a>

    </section>


</div>
{{--加载尾部代码--}}
@extends('layouts.footer')

</body>
</html>