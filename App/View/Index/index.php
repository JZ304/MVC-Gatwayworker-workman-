<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>
<body background="public/bg_1.jpg">
<div class="container-fluid">
    <div style="width: 40%;min-height: 700px;margin: auto;margin-top: 200px">
        <div id='home' style="width: 100%;background-color: white;height: 400px;border-radius: inherit">
        </div>
        <br>
        <br>
        <div>
            <form>
                <div class="form-group">
                    <input type="text" id = 'sub-content' class="form-control" id="exampleInputEmail1" placeholder="随便说点什么">
                    <button type="button" id ='sub-button' class="btn btn-success" style="width: 40%;margin-left:30% ">发送</button>
                </div>
                <div class="form-group">

                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
<script>
    $(function () {
        /**
         * 与GatewayWorker建立websocket连接，域名和端口改为你实际的域名端口，
         * 其中端口为Gateway端口，即start_gateway.php指定的端口。
         * start_gateway.php 中需要指定websocket协议，像这样
         * $gateway = new Gateway(websocket://0.0.0.0:7272);
         */
        ws = new WebSocket("ws://120.76.60.159:1234");
        // 服务端主动推送消息时会触发这里的onmessage
        ws.onmessage = function (e) {
            // json数据转换成js对象
            console.log(e)
            var data = eval("("+e.data+")");
            var type = data.type || '';
            switch(type){
                // Events.php中返回的init类型的消息，将client_id发给后台进行uid绑定
                case 'init':
                    // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
                    $.post('index.php?c=Index&a=bind', {client_id: data.client_id}, function(data){}, 'json');
                    break;
                // 当mvc框架调用GatewayClient发消息时直接alert出来
                case 'bind':
                    console.log('绑定成功！');
                    break;
                case 'message':
                var message = data.message || '';
                var user = data.from || '';
                $time = getNowFormatDate();
                $("#home").append("<p>" + user + "：" + message + " " + $time + "</p>")
                    break;
                default :
                    alert(e.data);
            }

        };

        /*
        * 发送信息
        */

        $("#sub-button").on('click', function(){
           var content = $("#sub-content").val();
           $.ajax({
            type:'post',
            url:'index.php?c=Index&a=sendMessage',
            data:{
                content: content
            },
            success:function(msg){
                $time = getNowFormatDate();
                $("#home").append("<p>我说：" + content + "   <span> " + $time +"</span></p>")
            }
           })
        })





        function getNowFormatDate() {//获取当前时间
            var date = new Date();
            var seperator1 = "-";
            var seperator2 = ":";
            var month = date.getMonth() + 1<10? "0"+(date.getMonth() + 1):date.getMonth() + 1;
            var strDate = date.getDate()<10? "0" + date.getDate():date.getDate();
            var currentdate = date.getFullYear() + seperator1  + month  + seperator1  + strDate
                    + " "  + date.getHours()  + seperator2  + date.getMinutes()
                    + seperator2 + date.getSeconds();
            return currentdate;
        }
    })
</script>
</body>
</html>
