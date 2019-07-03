<!doctype html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="edge" />
    <meta charset="utf-8" />
    <title>系统后台</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.css">
    <link rel="stylesheet" href="Admin/css/admin.css">
    <script type="text/javascript">
    if (window.parent !== window.self) {
        document.write = '';
        window.parent.location.href = window.self.location.href;
        setTimeout(function () {
            document.body.innerHTML = '';
        }, 0);
    }
    </script>
</head>
<body class="login">
    <div class="wrapper">
        <h1>后台管理系统</h1>
        <div class="login-body">
            <h2>登录</h2>
            <form class='form-validate' id="loginform" method="post" name="loginform" action="index.php?c=Admin&a=tologin">
                <div class="form-group">
                        <input type="text" name='username' placeholder="帐号名" class='form-control' tabindex="1" data-rule-required="true"/>

                </div>
                <div class="form-group">
                        <input type="password" name="password" placeholder="密码" class='form-control' tabindex="2" data-rule-required="true"/>

                </div>
                <div class="form-group row">
                    <div class="col-lg-5">
                        <input  id="verifycode" name="code" maxlength="4" tabindex="3" class='form-control' type="text" value="" placeholder="请输入验证码" style="width:150px;display:inline-block"  data-rule-required="true"/>
                    </div>
                    <div class="col-lg-7">
                            <img class="yanzheng_img" id="code_img" alt="" src="index.php?c=Admin&a=Checkcode&code_len=4&font_size=18&width=100&height=34&type=verify"/>
                            <a href="javascript:document.getElementById('code_img').src='index.php?c=Admin&a=Checkcode&code_len=4&font_size=18&width=100&height=34&type=verify&time='+Math.random();void(0);" class="change_img">换一张</a>
                    </div>
                </div>
                <div class="submit">
                    <input type="submit" value="登录" class='btn btn-primary btn-block'></div>
            </form>
            <div class="forget">
                Copyright &copy; 2019, THinkMore All Rights Reserved.
            </div>
        </div>
    </div>

    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="Admin/js/jquery.validate.min.js"></script>
    <script src="Admin/js/admin.js"></script>
    <script type="text/javascript">
        
    </script>
</body>
</html>