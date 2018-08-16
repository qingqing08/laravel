@extends('layouts.header');
	<header class="top-header fixed-header">
		<a class="icona" href="javascript:history.go(-1)">
				<img src="images/left.png"/>
			</a>
		<h3>{{ $title }}</h3>

			<!-- <a class="text-top" href="edit?add_id={{$address_info->id}}" >
        编辑
			</a> -->
	</header>

	<div class="contaniner fixed-conta">
		<form action="" method="post" class="change-address" id="save">
			<ul>
				<li>
					@csrf
					<label class="addd">收货人：</label>
					<input type="text" value="{{ $address_info->u_name }}" required="required"/>
				</li>
				<li>
					<label class="addd">手机号：</label>
					<input type="tel" value="{{ $address_info->phone }}" required="required"/>
				</li>
				<li>
					<label class="addd">所在地区：</label>
					<!-- <span>{{ $address_info->province }}{{ $address_info->city }}{{ $address_info->county }}</span> -->
					<select onchange="get_city(this.value)" style="width:70px;">
							<option value="0">请选择</option>
							@foreach($province as $val)
							<option value="{{$val->id}}">{{$val->area_name}}</option>
							@endforeach
					</select>&nbsp;&nbsp;&nbsp;&nbsp;
					<select name="city" id="city" onchange="get_county(this.value)">
							<option value="">请选择</option>
					</select>
					<select name="county" id="county">
							<option value="">请选择</option>
					</select>
				</li>
				<li>
					<label class="addd">详细地址：</label>
					<textarea readonly style="height:55px;">{{ $address_info->address }}</textarea>
				</li>
			</ul>

			<ul>
				<li class="checkboxa">
					<input type="checkbox" id="check"/>
					<label class="check" for="check" onselectstart="return false"  >设置为默认地址</label>
					<input type="hidden" name="status" id="status" value="">
				</li>
			</ul>
			<!-- <ul>
				<li>
					<h3>修改此地址</h3>
				</li> -->
			</ul>
			<input type="submit" value="保存" />
		</form>
	</div>

	<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(".checkboxa label").on('touchstart',function(){
			if($(this).hasClass('checkd')){
				$(".checkboxa label").removeClass("checkd");
				$("#status").val(0);
			}else{
				$(".checkboxa label").addClass("checkd");
				$('#status').val(1);
			}
		})

		function get_city(parent_id){
			// alert(city_parent_id);
			var token = $('input[name=_token]').val();
			$.ajax({
				url:'get_city',
				type:'post',
				data:{
					_token:token,
					parent_id:parent_id,
				},
				cache:false,
				async:false,
				success:function (msg){
					var str = "<option value='0'>请选择</option>";
					$('#city').html(str+msg.data);
					$('#county').html(str);
				}
			})
		}

		function get_county(parent_id){
			// alert(parent_id);
			var token = $('input[name=_token]').val();
			$.ajax({
				url:'get_city',
				type:'post',
				data:{
					_token:token,
					parent_id:parent_id,
				},
				cache:false,
				async:false,
				success:function (msg){
					$('#county').html(msg.data);
				}
			})
		}
	</script>


</body>
</html>
