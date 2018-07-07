<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="en" class="no-js">
    <link rel="icon" href="/myicon.ico">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>

<link rel="stylesheet" type="text/css" href="/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="/css/demo.css" />
<link href="/css/button.css" rel="stylesheet">
<link href="/css/flatnav1.css" rel="stylesheet">
<link href="/css/np_style.css" rel="stylesheet">
<link href="/css/font-awesome.min.css" rel="stylesheet">
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="/css/set2.css" />
<link rel="stylesheet" href="/jquery.ui.autocomplete.css"/>
<script type="text/javascript" src="/jquery-1.3.2.js"></script>
<script type="text/javascript" src="/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="/ui/jquery.ui.autocomplete.js"></script>


<script type="text/javascript">
    $(function(){
        $( "#search_text" ).autocomplete({
            source: "home/hint_author",
            autoFocus: true,
            delay: 20,
            minLength: 2,
            autoFill: true,
            matchSubset: true
        });
    });

    $(document).ready(function(){
        var address = "home/author";

        $("#papertype").click(function(){
            $("#change").html("Paper");
            $('#myformid').attr("action", "home/paper");
            address = "home/paper";
            $(function(){
                $( "#search_text" ).autocomplete({
                    source: "home/hint_paper", 
                    delay: 50,
                    minLength: 2
                });
            });
            // document.myForm.action = "home/paper";  
        });

        $("#authortype").click(function(){
            $("#change").html("Author");
            $('#myformid').attr("action", "home/author");
            address = "home/author";
            $(function(){
                $( "#search_text" ).autocomplete({
                    source: "home/hint_author", 
                    delay: 50,
                    minLength: 2
                });
            });
            // document.myForm.action = "home/result";  
        });

        $("#conferencetype").click(function(){
            $("#change").html("Conference");
            $('#myformid').attr("action", "home/conference");
            address = "home/conference";
            $(function(){
                $( "#search_text" ).autocomplete({
                    source: "home/hint_conference", 
                    delay: 50,
                    minLength: 2
                });
            });
            // document.myForm.action = "home/result";  
        });

        $("#search_button").click(function(){
            var content = document.getElementById("search_text").value;
            if(content == ""){
                alert("EMPTY??");
                return false;
            }

            else{
                if (address == "home/author"){
                    $(window).attr('location', address + "?scholarname=" + content);
                    return true;
                }

                if (address == "home/conference"){
                    $(window).attr('location', address + "?conference=" + content);
                    return true;
                }

                else{
                    $(window).attr('location', address + "?papertitle=" + content);
                    return true;
                }
            }
        });

        // $("#fantasy").click(function(){
        //  $(window).attr('location', "home/choose_graph");
        // });
    });

</script>
<style type="text/css"> 
input[type="text"]{
text-align:center;
border:2px solid #a1a1a1;
padding:10px 40px; 
background:#dddddd;
width:350px;
vertical-align:middle;
       }
* {
    margin:0;
    padding:0;
}

body {
    font-size:16px;
    font:400 16px/1.62 Georgia,"Xin Gothic","Hiragino Sans GB","Droid Sans Fallback","Microsoft YaHei",sans-serif;font-family: 'PT serif',微軟正黑體,微软雅黑,华文细黑,Microsoft Yahei,Hiragino Sans GB,sans-serif;
    color:#D0CCCC;
    overflow:hidden;
    text-shadow: 0px 0px 1px rgba(24, 22, 22, 0.35);
    background-color: #000;
}
    a.mine:link {text-decoration: :#E0E0E0;}    /* 未被访问的链接 */
    a.mine:visited {text-decoration:#E0E0E0;} /* 已被访问的链接 */
    a.mine:hover {text-decoration:#FFFFFF;}   /* 鼠标指针移动到链接上 */
    a.mine:active {text-decoration:#FFFFFF;}  /* 正在被点击的链接 */
</style>
</head>
<body>
<canvas height="100%" width="100%" style="position: fixed; top: 0px; left: 0px; z-index: -1; opacity: 1;"  id="canvas"></canvas>
<script>
var canvas,
    ctx,
    width,
    height,
    size,
    lines,
    tick;

function line() {
    this.path = [];
    this.speed = rand(10, 20);
    this.count = randInt(10, 30);
    this.x = width / 2, +1;
    this.y = height / 2 + 1;
    this.target = {
        x: width / 2,
        y: height / 2
    };
    this.dist = 0;
    this.angle = 0;
    this.hue = tick / 5;
    this.life = 1;
    this.updateAngle();
    this.updateDist();
}

line.prototype.step = function(i) {
    this.x += Math.cos(this.angle) * this.speed;
    this.y += Math.sin(this.angle) * this.speed;

    this.updateDist();

    if (this.dist < this.speed) {
        this.x = this.target.x;
        this.y = this.target.y;
        this.changeTarget();
    }

    this.path.push({
        x: this.x,
        y: this.y
    });
    if (this.path.length > this.count) {
        this.path.shift();
    }

    this.life -= 0.001;

    if (this.life <= 0) {
        this.path = null;
        lines.splice(i, 1);
    }
};

line.prototype.updateDist = function() {
    var dx = this.target.x - this.x,
        dy = this.target.y - this.y;
    this.dist = Math.sqrt(dx * dx + dy * dy);
}

line.prototype.updateAngle = function() {
    var dx = this.target.x - this.x,
        dy = this.target.y - this.y;
    this.angle = Math.atan2(dy, dx);
}

line.prototype.changeTarget = function() {
    var randStart = randInt(0, 3);
    switch (randStart) {
        case 0: // up
            this.target.y = this.y - size;
            break;
        case 1: // right
            this.target.x = this.x + size;
            break;
        case 2: // down
            this.target.y = this.y + size;
            break;
        case 3: // left
            this.target.x = this.x - size;
    }
    this.updateAngle();
};

line.prototype.draw = function(i) {
    ctx.beginPath();
    var rando = rand(0, 10);
    for (var j = 0, length = this.path.length; j < length; j++) {
        ctx[(j === 0) ? 'moveTo' : 'lineTo'](this.path[j].x + rand(-rando, rando), this.path[j].y + rand(-rando, rando));
    }
    ctx.strokeStyle = 'hsla(' + rand(this.hue, this.hue + 30) + ', 80%, 55%, ' + (this.life / 3) + ')';
    ctx.lineWidth = rand(0.1, 2);
    ctx.stroke();
};

function rand(min, max) {
    return Math.random() * (max - min) + min;
}

function randInt(min, max) {
    return Math.floor(min + Math.random() * (max - min + 1));
};

function init() {
    canvas = document.getElementById('canvas');
    ctx = canvas.getContext('2d');
    size = 30;
    lines = [];
    reset();
    loop();
}

function reset() {
    width = Math.ceil(window.innerWidth / 2) * 2;
    height = Math.ceil(window.innerHeight / 2) * 2;
    tick = 0;

    lines.length = 0;
    canvas.width = width;
    canvas.height = height;
}

function create() {
    if (tick % 10 === 0) {
        lines.push(new line());
    }
}

function step() {
    var i = lines.length;
    while (i--) {
        lines[i].step(i);
    }
}

function clear() {
    ctx.globalCompositeOperation = 'destination-out';
    ctx.fillStyle = 'hsla(0, 0%, 0%, 0.1';
    ctx.fillRect(0, 0, width, height);
    ctx.globalCompositeOperation = 'lighter';
}

function draw() {
    ctx.save();
    ctx.translate(width / 2, height / 2);
    ctx.rotate(tick * 0.001);
    var scale = 0.8 + Math.cos(tick * 0.02) * 0.2;
    ctx.scale(scale, scale);
    ctx.translate(-width / 2, -height / 2);
    var i = lines.length;
    while (i--) {
        lines[i].draw(i);
    }
    ctx.restore();
}

function loop() {
    requestAnimationFrame(loop);
    create();
    step();
    clear();
    draw();
    tick++;
}

function onresize() {
    reset();
}

window.addEventListener('resize', onresize);

init();

</script>
<form action="result" method="get">
   <br>
   <div style="text-align:center; vertical-align:middle;">
   <div style="font-size:10px"><p><a>Academic & More</a></p></div></div>
   <br>
   
   <div style="text-align:center; vertical-align:middle;">
    <ul class="nav">
        <li id="search">
            <form action="home/author" method="get", id="myformid">
                <input type="text" name="search_text" id="search_text" placeholder="Search"/>
                <input type="button" name="search_button" id="search_button"></a>
            </form>
        </li>
        <li id="options">
            <a id="change">Author</a>
            <ul class="subnav">
                <li> <a id="authortype">Author</a></li>
                <li> <a id="papertype">Paper</a></li>
                <li> <a id="conferencetype">Conference</a></li>
            </ul>
        </li>
    </ul>
    <script src="/js/prefixfree-1.0.7.js" type="text/javascript"></script>
</form>
<br>
<br>
<br>
<br>

<br>
<br>
<br>
<footer align="center">
 <a href="http://acemap.sjtu.edu.cn/" class="button button-raised button-rounded button-inverse"  id="acknowledgement">Acknowledgement</a>
<a href="home/choose_graph" class="button button-raised button-rounded button-inverse" id="fantasy">Fantasy!</a>
<a href="http://ieee.seiee.com/" class="button button-raised button-rounded button-inverse">&nbsp;Cooperation &nbsp;&nbsp;</a></footer>
</body>



</html>
    