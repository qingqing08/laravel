@extends('layouts.header')
	<header class="top-header">
		<a class="text texta" href="index">取消</a>
		<h3>登录</h3>
		<a class="text" href="sign">注册</a>
	</header>

	<div class="login">
		<form>
			<ul>
				<li>
					<img src="/images/login.png"/>
					<label>账号</label>
					<input type="text" placeholder="请输入账号"/>
				</li>
				<li>
					<img src="/images/password.png"/>
					<label>密码</label>
					<input type="password" placeholder="请输入密码"/>
				</li>
			</ul>
			<input type="submit" value="登录"/>
		</form>
	</div>

</body>
</html>
