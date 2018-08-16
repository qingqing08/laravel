<h1>类别列表</h1>
<h3><a href="typeadd">添加类别</a></h3>
<table border="1">
    <tr>
        <td>类别名称</td>
        <td>添加时间</td>
        <td>操作</td>
    </tr>
    @foreach( $typelist as $type)
        <tr>
            <td>{{ $type->name }}</td>
            <td>{{ $type->ctime }}</td>
            <td><a href="#">编辑</a> | <a href="#">删除</a></td>
        </tr>
    @endforeach
</table>
