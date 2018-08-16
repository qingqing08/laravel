<h1>添加商品</h1>
<form action="goodsadd_do" method="post" enctype="multipart/form-data">
    @csrf
    请选择商品类别：
    <select name="type_id" id="type_id">
        <option value="0">请选择</option>
        @foreach($typelist as $type)
            <option value="{{$type->id}}">{{$type->name}}</option>
        @endforeach
    </select><br>
    请输入类别名称：
    <input type="text" name="name" id="name"><br>
    请输入库存：
    <input type="number" name="num" id="num"><br>
    请输入进价：
    <input type="text" name="in_price" id="in_price"><br>
    请输入出货价：
    <input type="text" name="out_price" id="out_price"><br>
    请选择商品图：
    <input type="file" name="image" id="image"><br>
    <input type="submit" value="提交">
</form>
