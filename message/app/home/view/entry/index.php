<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        <link rel="stylesheet" href="./static/bt3/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top: 30px">
    <table border="1" class="table table-hover">
        <tr>
            <td>id</td>
            <td>标题</td>
            <td>点击</td>
            <td>操作</td>
        </tr>
        <?php foreach($arcData as $v): ?>
            <tr>
                <td><?php echo $v['aid'] ?></td>
                <td><?php echo $v['title'] ?></td>
                <td><?php echo $v['click'] ?></td>
                <td>
                    <a href="?s=home/entry/update&aid=<?php echo $v['aid'] ?>" class="btn btn-info btn-xs" >编辑</a>
                    <a href="javascript: if(confirm('真的要删除吗？')) location.href='?s=home/entry/remove&aid=<?php echo $v['aid'] ?>';" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <br>
    <hr>

    <form class="form-horizontal" method="post">

        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="请输入内容" name="title"></textarea>
        </div>

        <div class="form-group">
            <input type="text"  class="form-control" name="click" placeholder="点击次数">
        </div>

        <div class="form-group">
            <label for="inputID" class="col-sm-2 control-label">验证码:</label>
            <div class="col-sm-10">
                <input type="text" name="captcha" id="inputID" class="form-control" value="" title="" required="required">
                <img src="?s=home/entry/captcha" onclick="this.src=this.src+'&='+Math.random()" alt="">

            </div>
        </div>

        <div class="form-group" style="margin-left: 220px;">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加留言</button>
            </div>
        </div>


    </form>
</div>

</body>
</html