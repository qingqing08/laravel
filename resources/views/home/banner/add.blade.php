<h1>{{ $title }}</h1>
<form action="banneradd_do" method="post" enctype="multipart/form-data">
    @csrf
    请输入标题：
    <input type="text" name="title" id="title"><br>
    请选择图片：
    <input type="file" name="image" id="image"><br>
    <input type="submit" value="提交">
</form>
