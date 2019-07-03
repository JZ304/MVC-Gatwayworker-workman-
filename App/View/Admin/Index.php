<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="edge" />
    <meta charset="utf-8" />
    <title>新希望H5系统后台</title>

    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="Echarts/echarts.js"></script>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.css">
    <link rel="stylesheet" href="Admin/css/admin.css">
    <link rel="stylesheet" href="Admin/layui/css/layui.css">
    <style>
        table, th, td
        {
        border: 1px solid lightgrey;
        text-align: center;
        }
    </style>
</head>

<body>
    <?php View::tplInclude('Admin/Header');?>
    <div class="container-fluid" id="content">
        <div id="left">
            <div class="subnav">
                <div class="subnav-title">
                    <a href="#" class='toggle-subnav'>
                        <i class="fa fa-angle-down"></i>
                        <span>快捷导航</span>
                    </a>
                </div>
                <ul class="subnav-menu">
                        <li>
                            <a href="index.php?c=Admin" style="color: red">首页</a>
                        </li>
                        <li>
                            <a href="index.php?c=Admin&a=OrderList&lang=questions">问题热度</a>
                        </li>
                        <li>
                            <a href="index.php?c=Admin&a=OrderList&lang=secKill">秒杀名单</a>
                        </li>
                </ul>
            </div>
        </div>

        <div id="main">

            <div class="container-fluid">
                <div class="page-header">
                    <div class="pull-left">
                        <h1>首页</h1>
                    </div>
                </div>
                <div class="breadcrumbs">
                    <ul>
                        <li>
                            <a href="#">首页</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="index.php?c=Admin">系统信息</a>
                        </li>
                    </ul>
                </div>
                <br />
                <!--统计框-->
                 <div style="width: 100%;height: 800px;">
                       <div style="width: 100%;height: 400px;">
                            <table style="width:100%;height: 400px;font-size: 15px;" >
                                <tr>
                                    <td style="width: 10%"><b>系统类型:</b></td>
                                    <td style="width: 40%"><i><?php echo $system ?></i></td>
                                    <td style="width: 10%"><b>系统版本:</b></td>
                                    <td style="width: 40%"><i><?php echo $version ?></i></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><b>PHP版本:</b></td>
                                    <td style="width: 40%"><i><?php echo $p_version ?></i></td>
                                    <td style="width: 10%"><b>Zend版本:</b></td>
                                    <td style="width: 40%"><i><?php echo $z_version ?></i></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><b>服务器IP:</b></td>
                                    <td style="width: 40%"><i><?php echo $serverIp ?></i></td>
                                    <td style="width: 10%"><b>客户端IP:</b></td>
                                    <td style="width: 40%"><i><?php echo $userIp ?></i></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><b>服务器域名:</b></td>
                                    <td style="width: 40%"><i><?php echo $serverinfo ?></i></td>
                                    <td style="width: 10%"><b>浏览器信息:</b></td>
                                    <td style="width: 40%"><i><?php echo $chorminfo ?></i></td>
                                </tr>
                            </table>
                       </div>

                 </div>

            </div>
        </div>

    </div>

    <?php View::tplInclude('Admin/Footer');?>
    <script>
    </script>
</body>
</html>
