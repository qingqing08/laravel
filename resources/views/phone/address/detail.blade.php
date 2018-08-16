@extends('layouts.header');
	<header class="top-header fixed-header">
		<a class="icona" href="javascript:history.go(-1)">
				<img src="images/left.png"/>
			</a>
		<h3>{{ $title }}</h3>

			<a class="text-top" href="addressedit?add_id={{$address_info->id}}" >
        编辑
			</a>
	</header>

	<div class="contaniner fixed-conta">
		<form action="" method="post" class="change-address" id="save">
			<ul>
				<li>
					<label class="addd">收货人：</label>
					<input type="text" value="{{ $address_info->u_name }}" readonly/>
				</li>
				<li>
					<label class="addd">手机号：</label>
					<input type="tel" value="{{ $address_info->phone }}" readonly/>
				</li>
				<li>
					<label class="addd">所在地区：</label>
					<span>{{ $address_info->province }}{{ $address_info->city }}{{ $address_info->county }}</span>
				</li>
				<li>
					<label class="addd">详细地址：</label>
					<textarea readonly style="height:55px;">{{ $address_info->address }}</textarea>
				</li>
			</ul>

			<!-- <ul>
				<li class="checkboxa">
					<input type="checkbox" id="check"/>
					<label class="check" for="check" onselectstart="return false"  >设置为默认地址</label>
				</li>
			</ul> -->
			<ul>
				<li>
					<h3>删除此地址</h3>
				</li>
			</ul>
			<!-- <input type="submit" value="保存" /> -->
		</form>
	</div>

	<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(".checkboxa label").on('touchstart',function(){
			if($(this).hasClass('checkd')){
				$(".checkboxa label").removeClass("checkd");
			}else{
				$(".checkboxa label").addClass("checkd");

			}
		})
	</script>


</body>
</html>
