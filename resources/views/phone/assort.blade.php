@extends('layouts.header')
<header class="page-header fixed-header">
    <input type="search"  />
    <span>
			<img src="/images/serach.png"/>
		</span>
</header>

<div class="contaniner fixed-cont">
    <aside class="assort">
        <ul>
            {{--<li class="active">--}}
                {{--<span>护肤系列</span>--}}
            {{--</li>--}}
            @foreach($typelist as $type)
            <li>
                <span>{{ $type->name }}</span>
            </li>
            @endforeach
        </ul>
    </aside>

    <section class="assort-cont">
        <figure>
            <a href="#">
                <img src="./uploads/2018-08-14-19-36-22-5b72beb6e8161.jpg"/>
            </a>
        </figure>
        @foreach($typelist as $type)
        <dl>
            <dt>{{ $type->name }}</dt>
            @foreach($type->goodslist as $goods)
            <dd>
                <a href="detail?id={{ $goods->id }}">
                    <img src="{{ $goods->image_url }}"/>
                </a>
                <p style="display: inline;">{{ $goods->name }}</p>
            </dd>
            @endforeach
        </dl>
        @endforeach
    </section>
</div>

<footer class="page-footer fixed-footer">
    <ul>
        <li>
            <a href="/">
                <img src="/images/footer001.png"/>
                <p>首页</p>
            </a>
        </li>
        <li class="active">
            <a href="assort">
                <img src="/images/footer02.png"/>
                <p>分类</p>
            </a>
        </li>
        <li>
            <a href="shopcar">
                <img src="/images/footer003.png"/>
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