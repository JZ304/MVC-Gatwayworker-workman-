<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>提示信息</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.css">
    <link rel="stylesheet" href="Admin/css/admin.css">
</head>
<body class="success">
    <div class="wrapper">
        <div class="code">
            <span><?php echo $msgTitle ?></span>
            <i class="fa fa-smile-o"></i>
        </div>
        <div class="desc"><?php echo $message ?></div>
        <div class="buttons">
            <div class="pull-left">
                <a href="<?php echo $jumpUrl ?>" class="btn">
                    <i class="fa fa-arrow-left"></i>
                    返回
                </a>
            </div>
        </div>
    </div>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script language="javascript">
    setTimeout(function(){
      location.href = '<?php echo $jumpUrl ?>';
    },<?php echo $waitSecond ?>);
    </script>
</body>
</html>