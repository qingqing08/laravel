<h1>添加类别</h1>
<form action="typeadd_do" method="post">
    @csrf
    请输入类别名称：
    <input type="text" name="name" id="name"><br>
    <input type="submit" value="提交">
</form>
