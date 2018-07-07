<!DOCTYPE html>
<html style="height: 100%; width: 100%;">
   <head>
       <meta charset="utf-8">
   </head>
   <body style="height: 100%; margin: 0; width: 100%;" >
       <div id="container" style="height: 100%"></div>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-gl/echarts-gl.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
       <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/simplex.js"></script>
       <script type="text/javascript">
          var dom = document.getElementById("container");
          var myChart = echarts.init(dom);
          var app = {};
          option = null;
          app.title = 'papers';

          option = {
              tooltip: {
                  trigger: 'axis',
                  axisPointer: {
                      type: 'cross',
                      crossStyle: {
                          color: '#666'
                      }
                  }
              },
              toolbox: {
                  feature: {
                      dataView: {show: true, readOnly: false},
                      magicType: {show: true, type: ['line', 'bar']},
                      restore: {show: true},
                      saveAsImage: {show: true}
                  }
              },
              legend: {
                  data:['citations','papers','papers per author']
              },
              xAxis: [
                  {
                      type: 'category',
                name: 'year',
                      data: ['2005','2006','2007','2008','2009','2010','2011','2012','2013','2014','2015','2016'],
                      axisPointer: {
                          type: 'shadow'
                      }
                  }
              ],
              yAxis: [
                  {
                      type: 'value',
                      name: 'papers/citations',
                      min: 0,
                      max: 20000,
                      interval: 2000,
                      axisLabel: {
                          formatter: '{value} '
                      }
                  },
                  {
                      type: 'value',
                      name: 'papers per author',
                      min: 0.2,
                      max: 0.4,
                      interval: 0.02,
                      axisLabel: {
                          formatter: '{value}'
                      }
                  }
              ],
              series: [
                  {
                      name:'citations',
                      type:'bar',
                      data:[18064, 16330, 18736, 16347, 17949, 15582, 14044, 10899, 8163, 3747, 727, 48]
                  },
                  {
                      name:'papers',
                      type:'bar',
                      data:[3900, 3621, 4904, 4075, 5158, 5242, 5349, 5121, 6227, 5317, 6842, 4468]
                  },
                  {
                      name:'papers per author',
                      type:'line',
                      yAxisIndex: 1,
                      data:[0.354, 0.346, 0.348, 0.336, 0.334, 0.334, 0.322, 0.313, 0.310, 0.297, 0.292, 0.284]
                  }
              ]
          };
          ;
          if (option && typeof option === "object") {
              myChart.setOption(option, true);
          }
       </script>
   </body>
</html>