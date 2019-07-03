<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>提示信息</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Admin/css/admin.css">
</head>
<body class='error'>
    <div class="wrapper">
        <div class="code">
            <span><?php echo $msgTitle ?></span>
            <i class="fa fa-warning"></i>
        </div>
        <div class="desc"><?php echo $error ?></div>
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