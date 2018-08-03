<h1>修改{{ $data['username'] }}</h1>
<form action="/usersmodify_do" method="post">
	@csrf
	请输入学生姓名：
	<input type="text" name="username" id="username" value="{{ $data['username'] }}"><br>
	<input type="hidden" name="uid" id="id" value="{{ $data['id'] }}">
	请输入性别：
	<input type="text" name="sex" id="sex" value="{{ $data['sex'] }}" ><br>
	请输入年龄：
	<input type="text" name="age" id="age" value="{{ $data['age'] }}"><br>
	<input type="submit" value="提交">
</form>
