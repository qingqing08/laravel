<h1>学生列表</h1>
<h3><a href="/usersadd">添加学生</a></h3>
<table border="1">
	<tr>
		<td>学生姓名</td>
		<td>年龄</td>
		<td>性别</td>
		<td>操作</td>
	</tr>
	@foreach( $userlist as $user)
	<tr>
		<td>{{ $user->username }}</td>
		<td>{{ $user->age }}</td>
		<td>{{ $user->sex }}</td>
		<td><a href="/modifyuser?id={{ $user->id }}">编辑</a> | <a href="/deluser?id={{ $user->id }}">删除</a></td>
	</tr>
	@endforeach
</table>
