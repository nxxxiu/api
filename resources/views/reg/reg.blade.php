<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h3>注册</h3>
    <form action="/regdo" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>企业名称</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>合法人</td>
                <td><input type="text" name="legal_per"></td>
            </tr>
            <tr>
                <td>税务号</td>
                <td><input type="text" name="taxno"></td>
            </tr>
            <tr>
                <td>对公账号</td>
                <td><input type="text" name="publicno"></td>
            </tr>
            <tr>
                <td>营业执照</td>
                <td><input type="file" name="license"></td>
            </tr>
            <tr>
                <td><input type="submit" value="REGISTER"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>