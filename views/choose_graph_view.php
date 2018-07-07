<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="icon" href="/myicon.ico">

        <link rel="stylesheet" href="/css/style.css" type="text/css" media="screen"/>
        <style>
            *{
                margin:0;
                padding:0;
            }
            body{
                font-family:Arial;
        background-size:100%;
            }
            a.back{
                background:transparent url(back.png) no-repeat top left;
                position:fixed;
                width:150px;
                height:27px;
                outline:none;
                bottom:0px;
                left:0px;
            }
            #content{
                margin:150px auto 10px auto;
            }
            .reference{
                clear:both;
                width:80px;
                margin:30px auto;
            }
            .reference p a{
                text-transform:uppercase;
                text-shadow:1px 1px 1px #fff;
                color:#666;
                text-decoration:none;
                font-size:10px;
            }
            .reference p a:hover{
                color:#333;
            }
        </style>

    </head>

    <body>
        <div id="content">

            <div class="rotator">
                <ul id="rotmenu">
                    <li>
                        <a href="rot1">TOP 10 AUTHORS</a>
                        <div style="display:none;">
                            <div class="info_image">test3.jpg</div>
                            <div class="info_heading">TOP 10 AUTHORS</div>
                            <div class="info_description">
         At vero eos et accusamus et iusto odio
        dignissimos ducimus qui blanditiis praesentium
        voluptatum deleniti atque corrupti quos dolores et
        quas molestias excepturi sint occaecati cupiditate
        non provident... 
                                <a href="top_10_authors" class="more">ENTER</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="rot2">CONFERENCE</a>
                        <div style="display:none;">
                            <div class="info_image">test2.jpg</div>
                            <div class="info_heading">CONFERENCE</div>
                            <div class="info_description">
         At vero eos et accusamus et iusto odio
        dignissimos ducimus qui blanditiis praesentium
        voluptatum deleniti atque corrupti quos dolores et
        quas molestias excepturi sint occaecati cupiditate
        non provident...
                                <a href="conference_graph" class="more">ENTER</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="rot3">AFFILIATION MAP</a>
                        <div style="display:none;">
                            <div class="info_image">test4.jpg</div>
                            <div class="info_heading">AFFILIATION MAP</div>
                            <div class="info_description">
         At vero eos et accusamus et iusto odio
        dignissimos ducimus qui blanditiis praesentium
        voluptatum deleniti atque corrupti quos dolores et
        quas molestias excepturi sint occaecati cupiditate
        non provident...
                                <a href="map" class="more">ENTER</a>
                            </div>
                        </div>
                    </li>
                    
                </ul>
                <div id="rot1">
                    <img src="" width="800" height="300" class="bg" alt=""/>
                    <div class="heading">
                        <h1></h1>
                    </div>
                    <div class="description">
                        <p></p>

                    </div>    
                </div>
            </div>
        </div>
    <body background="/back.jpeg">
        <!-- The JavaScript -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
                var current = 1;
                
                var iterate   = function(){
                    var i = parseInt(current+1);
                    var lis = $('#rotmenu').children('li').size();
                    if(i>lis) i = 1;
                    display($('#rotmenu li:nth-child('+i+')'));
                }
                display($('#rotmenu li:first'));
                var slidetime = setInterval(iterate,3000);
        
                $('#rotmenu li').bind('click',function(e){
                    clearTimeout(slidetime);
                    display($(this));
                    e.preventDefault();
                });
        
                function display(elem){
                    var $this   = elem;
                    var repeat  = false;
                    if(current == parseInt($this.index() + 1))
                        repeat = true;
          
                    if(!repeat)
                        $this.parent().find('li:nth-child('+current+') a').stop(true,true).animate({'marginRight':'-20px'},300,function(){
                            $(this).animate({'opacity':'0.7'},700);
                        });
          
                    current = parseInt($this.index() + 1);
          
                    var elem = $('a',$this);
                    
                        elem.stop(true,true).animate({'marginRight':'0px','opacity':'1.0'},300);
          
                    var info_elem = elem.next();
                    $('#rot1 .heading').animate({'left':'-420px'}, 500,'easeOutCirc',function(){
                        $('h1',$(this)).html(info_elem.find('.info_heading').html());
                        $(this).animate({'left':'0px'},400,'easeInOutQuad');
                    });
          
                    $('#rot1 .description').animate({'bottom':'-270px'},500,'easeOutCirc',function(){
                        $('p',$(this)).html(info_elem.find('.info_description').html());
                        $(this).animate({'bottom':'0px'},400,'easeInOutQuad');
                    })
                    $('#rot1').prepend(
                    $('<img/>',{
                        style : 'opacity:0',
                        className : 'bg'
                    }).load(
                    function(){
                        $(this).animate({'opacity':'1'},600);
                        $('#rot1 img:first').next().animate({'opacity':'0'},700,function(){
                            $(this).remove();
                        });
                    }
                ).attr('src','/images/'+info_elem.find('.info_image').html()).attr('width','800').attr('height','300')
                );
                }
            });
        </script>
</body>
</html>