<!DOCTYPE html>
<html lang="en">
  <head>
        <link rel="icon" href="/myicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta charset="utf-8">
    <title id="title"><?php echo $name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--图标样式和布局-->
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/font-awesome.min.css" rel="stylesheet">

<!--公共样式-->
<link rel="stylesheet" type="text/css" href="/css/demo.css">
<link href="/css/bootstrap-responsive.css" rel="stylesheet">
<link href="/css/bootstrap.css" rel="stylesheet">
<link href="/css/button.css" rel="stylesheet">
<style type="text/css">
    
      body {
        padding-top: 60px;
        padding-bottom: 100px;
      }

    </style>
   
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">A&M</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="/index.php/home">Home</a></li>
              <li><a href="/index.php/home/about">About</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1 id="name"><?php echo $name; ?></h1>
        <p id="content"><?php echo $content; ?></p>
        <div align="left">
        <a href="<?php echo $web; ?>" class="button button-3d button-primary button-rounded" id="web">Learn More</a></div>
        <!--p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p-->
      </div>
      <h2>VISUALIZATION</h2>
      <div id="visual" style="height: 400px"></div>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-gl/echarts-gl.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
       <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/simplex.js"></script>
       <script type="text/javascript" src="/jquery.js"></script>
       <script type="text/javascript">
        var year_data = eval(<?php echo json_encode($data); ?>);
        var dom = document.getElementById("visual");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        option = {
            xAxis: {
                type: 'category',
                data: ['2007', '2008', '2009',
                '2010', '2011', '2012', '2013', '2014', '2015','2016']
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: year_data,
                type: 'line',
                symbol: 'squire',
                symbolSize: 10,
                lineStyle: {
                    normal: {
                        color: 'grey',
                        width: 4,
                        type: 'dashed'
                    }
                },
                itemStyle: {
                    normal: {
                        borderWidth: 2,
                        borderColor: 'light green',
                        color: 'light blue'
                    }
                }
            }]
        };
        ;
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
       </script>

      <!-- Example row of columns -->

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>

  </body>
</html>
