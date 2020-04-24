<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <!-- route命名路由 -->
        <form action="{{route('doadd')}}" method="post">
            @csrf
            <table border="1">
                <tr>
                    <td>姓名</td>
                    <td>
                        <input type="text" name="name" value="{{$name}}">
                    </td>
                </tr>
                <tr>
                    <td>地址</td>
                    <td><input type="text" name="url"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="提交"></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>



