@extends('layouts.header')
<header class="top-header fixed-header">
    <a class="icona" href="javascript:history.go(-1)">
        <img src="images/left.png"/>
    </a>
    <h3>{{ $title }}</h3>

    <a class="text-top" href="go-address.html">
        添加
    </a>
</header>

<div class="contaniner fixed-conta">
    @foreach($addresslist as $address)
    <dl class="address">
        <a href="addressdetail?add_id={{ $address->id }}">
            <dt>
                <p>{{ $address->u_name }}</p>
                <span>{{ $address->phone }}</span>
                @if($address->status == 1)
                <small>默认</small>
                @endif
            </dt>
            <dd>{{ $address->province }}{{ $address->city }}{{ $address->county }}{{ $address->address }}</dd>
        </a>
    </dl>
    @endforeach
</div>





</body>
</html>
