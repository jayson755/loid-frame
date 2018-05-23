<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>显示服务器时间，本地时间</title>  
<script type="text/javascript">  
var timeDiff=new Date().valueOf()-<?php echo time()*1000;?>;  
function serverTime(){  
        this.date = new Date();  
        date.setTime(new Date().valueOf()-timeDiff);  
        this.year        =date.getFullYear();  
        this.month        =date.getMonth()+1;  
        this.day        =date.getDate();  
        this.hour        =date.getHours() < 10 ? "0" + date.getHours() : date.getHours();  
        this.minute =date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();  
        this.second =date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();  
        var s=year+'年'+month+'月'+day+'日 '+hour+':'+minute+':'+second;  
        document.getElementById("serverTime").innerHTML=s;  
}  
function localTime(){  
        this.date = new Date();  
        this.year        =date.getFullYear();  
        this.month        =date.getMonth()+1;  
        this.day        =date.getDate();  
        this.hour        =date.getHours() < 10 ? "0" + date.getHours() : date.getHours();  
        this.minute =date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();  
        this.second =date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();  
        var s=year+'年'+month+'月'+day+'日 '+hour+':'+minute+':'+second;  
        document.getElementById("localTime").innerHTML=s;  
}  
window.onload=function(){  
        serverTime();  
        localTime();          
        setInterval(function(){  
                serverTime();  
                localTime();  
        }, 1000);  
}  
</script>  
</head>  
<body>
    <div style="padding-bottom:10px;">
        <div style="float: left;width: 100px;text-align: right;">服务器时间：</div>
        <div id="serverTime"></div>
    </div>
    <div>
        <div style="float: left;width: 100px;text-align: right;">本地时间：</div>
        <div id="localTime"></div>
    </div>
</body>  
</html>  