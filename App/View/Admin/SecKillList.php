<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="edge" />
    <meta charset="utf-8" />
    <title>系统后台</title>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="Admin/css/admin.css">
    <script src="Admin/layui/layui.js"></script>
    <link rel="stylesheet" href="Admin/layui/css/layui.css">
</head>

<body>
<?php
$data = array('username' => $username, );
View::tplInclude('Admin/Header',$data);
?>
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
                    <a href="index.php?c=Admin" >首页</a>
                </li>
                <li>
                    <a href="index.php?c=Admin&a=OrderList&lang=questions">问题热度</a>
                </li>
                <li>
                    <a href="index.php?c=Admin&a=OrderList&lang=secKill" style="color: red">秒杀名单</a>
                </li>

            </ul>
        </div>
    </div>
    <div id="main">
        <div class="container-fluid">
            <div class="page-header">
                <div class="pull-left">
                    <h1>秒杀名单</h1>
                </div>
            </div>
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="#">首页</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a>秒杀名单</a>
                        <i class="fa fa-angle-right"></i>
                    </li>

                </ul>
            </div>
            <br>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-title"></div>
                        <div class="box-content nopadding" style="padding-top: 50px">
                            <div style="width: 90%;margin-left: 100px;height:700px">
                                <br>
                                <button class="layui-btn" id="dropOut">导出数据</button>
                                <table id="member" lay-filter="test"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php View::tplInclude('Admin/Footer'); ?>
</body>
</html>
<script>
    $(function () {
        layui.use('table', function(){
            var table = layui.table;
            table.render({
                elem: '#member'
                ,height: 700
                ,url: 'index.php?c=Admin&a=getData&lang=seckillList' //数据接口
                ,page: true //开启分页
                ,loading:true
                ,skin:'line'
                ,cols: [[ //表头
                    {field: 'id', title: 'ID', width:'10%', sort: true, fixed: 'left',align:'center' ,style:"height:70px;"}
                    ,{field: 'username', title: '用户姓名',width:'15%',align:'center',style:"height:70px;"}
                    ,{field: 'babyname', title: '宝宝姓名', width:'15%',align:'center',style:"height:70px;"}
                     ,{field: 'babyage', title: '宝宝年龄', width:'10%',align:'center',style:"height:70px;"}
                      ,{field: 'tel', title: '联系电话', width:'40%',align:'center',style:"height:70px;"}
                    ,{field: 'created_at', title: '添加时间', width: '10%', sort: true,align:'center',style:"height:70px;"}
                ]]
            });

        });
        /* 导出Execel */
        $("#dropOut").on('click',function () {

            window.location.href='index.php?c=Admin&a=getExcel'

        })


    })
</script>