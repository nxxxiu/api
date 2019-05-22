<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="1">
    <tr>
        <td>企业名称</td>
        <td>合法人</td>
        <td>税务号</td>
        <td>对公账号</td>
        <td>营业执照</td>
        <td>审核状态</td>
        <td align="center">审核</td>
    </tr>
    @foreach($data as $k=>$v)
    <tr>
        <td>{{$v->name}}</td>
        <td>{{$v->legal_per}}</td>
        <td>{{$v->taxno}}</td>
        <td>{{$v->publicno}}</td>
        <td>{{$v->legal_per}}</td>
        <td>
            @if($v->status==1)
                已通过审核
            @elseif($v->status==2)
                已驳回
            @else
                未审核
            @endif
        </td>
        <td id="{{$v->id}}">
            <input type="submit" class="yes" value="通过">
            <input type="submit" class="no" value="驳回">
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>
<script src="/js/jquery-3.2.1.min.js"></script>
<script>
    $(function () {
        //通过
        $('.yes').click(function () {
            var id=$(this).parent('td').attr('id');
            $.ajax({
                url:'http://vmw.1809api.com/admin/yes?id='+id,
                dataType:'json',
                success:function (res) {
                    if (res.errno==0){
                        alert('审核成功');
                        window.location.reload();
                    }
                }
            })
        })

        //驳回
        $('.no').click(function () {
            var id=$(this).parent('td').attr('id');
            $.ajax({
                url:'http://vmw.1809api.com/admin/no?id='+id,
                dataType:'json',
                success:function (res) {
                    if (res.errno==0){
                        alert('已驳回');
                        window.location.reload();
                    }
                }
            })
        })
    })
</script>