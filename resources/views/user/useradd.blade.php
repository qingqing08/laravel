<h1>添加学生</h1>
<form action="/usersadd_do" method="post">
	@csrf
	请输入学生姓名：
	<input type="text" name="username" id="username"><br>
	请输入密码：
	<input type="password" name="password" id="password"><br>
	请输入性别：
	<input type="text" name="sex" id="sex" ><br>
	请输入年龄：
	<input type="text" name="age" id="age"><br>
	<input type="submit" value="提交">
</form>
