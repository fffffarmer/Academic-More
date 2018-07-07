<!DOCTYPE html>
<html style="height: 100%">
   <head>
       <meta charset="utf-8">
   </head>
   <body style="height: 100%; margin: 0">
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
       <script type="text/javascript" src="/jquery.js"></script>
       <script type="text/javascript">
        var author_content = eval(<?php echo json_encode($authorinfo); ?>);
        var bubble_data = new Array();
        for (var i in author_content)
        {
          var each_bubble = new Array();
          each_bubble[0] = i;
          //each_bubble[1] = "author_content[i].name";
          each_bubble[1] = author_content[i].teacher.length + author_content[i].student.length + author_content[i].coauthor.length;
          each_bubble[2] = author_content[i].total_cites;
          each_bubble[3] = author_content[i].id;
          each_bubble[4] = author_content[i].name;
          each_bubble[5] = author_content[i].teacher.length;
          each_bubble[6] = author_content[i].student.length;
          // each_bubble[7] = "A";
          if (author_content[i].total_cites > 4)
          {
            each_bubble[7] = "High";
          }
          else
          {
            each_bubble[7] = "Low";
          }
          bubble_data.push(each_bubble);
        }
        var dom = document.getElementById("container");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        var data = bubble_data;
        // var data = [
        //     [1,55,9,56,0.46,18,6,"良"],
        //     [2,25,11,21,0.65,34,9,"优"],
        //     [3,56,7,63,0.3,14,5,"良"],
        //     [4,33,7,29,0.33,16,6,"优"],
        //     [6,42,24,44,0.76,40,16,"优"],
        //     [6,82,58,90,1.77,68,33,"良"],
        //     [7,74,49,77,1.46,48,27,"良"],
        //     [8,78,55,80,1.29,59,29,"良"],
        //     [9,267,216,280,4.8,108,64,"重度污染"],
        //     [10,185,127,216,2.52,61,27,"中度污染"],
        //     [11,39,19,38,0.57,31,15,"优"],
        //     [12,41,11,40,0.43,21,7,"优"],
        //     [13,64,38,74,1.04,46,22,"良"],
        //     [14,108,79,120,1.7,75,41,"轻度污染"],
        //     [15,108,63,116,1.48,44,26,"轻度污染"],
        //     [16,33,6,29,0.34,13,5,"优"],
        //     [17,94,66,110,1.54,62,31,"良"],
        //     [18,186,142,192,3.88,93,79,"中度污染"],
        //     [19,57,31,54,0.96,32,14,"良"],
        //     [20,22,8,17,0.48,23,10,"优"],
        //     [21,39,15,36,0.61,29,13,"优"],
        //     [22,94,69,114,2.08,73,39,"良"],
        //     [23,99,73,110,2.43,76,48,"良"],
        //     [24,31,12,30,0.5,32,16,"优"],
        //     [25,42,27,43,1,53,22,"优"],
        //     [26,154,117,157,3.05,92,58,"中度污染"],
        //     [27,234,185,230,4.09,123,69,"重度污染"],
        //     [28,160,120,186,2.77,91,50,"中度污染"],
        //     [29,134,96,165,2.76,83,41,"轻度污染"],
        //     [30,52,24,60,1.03,50,21,"良"]
        // ];


        var schema = [
            {name: 'authorsquence', index: 0, text: 'Sequence'},
            {name: 'authorname', index: 1, text: 'Coauthors'},
            {name: 'cites', index: 2, text: 'Total cites'},
            {name: 'authorid', index: 3, text: 'ID'},
            {name: 'coauthors', index: 4, text: 'Name'},
            {name: 'teachers', index: 5, text: 'Teachers'},
            {name: 'students', index: 6, text: 'Students'}
            
        ];


        var itemStyle = {
            normal: {
                opacity: 0.8,
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowOffsetY: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
        };

        option = {
            backgroundColor: '#404a59',
            color: [
                '#dd4444'
            ],
            legend: {
                y: 'top',
                data: ['Author'],
                textStyle: {
                    color: '#fff',
                    fontSize: 16
                }
            },
            grid: {
                x: '10%',
                x2: 150,
                y: '18%',
                y2: '10%'
            },
            tooltip: {
                padding: 10,
                backgroundColor: '#222',
                borderColor: '#777',
                borderWidth: 1,
                formatter: function (obj) {
                    var value = obj.value;
                    return '<div style="border-bottom: 1px solid rgba(255,255,255,.3); font-size: 18px;padding-bottom: 7px;margin-bottom: 7px">'
                        +  'Popularity：'
                        + value[7]
                        + '</div>'
                        + schema[0].text + '：' + value[0] + '<br>'
                        + schema[1].text + '：' + value[1] + '<br>'
                        + schema[2].text + '：' + value[2] + '<br>'
                        + schema[3].text + '：' + value[3] + '<br>'
                        + schema[4].text + '：' + value[4] + '<br>'
                        + schema[5].text + '：' + value[5] + '<br>'
                        + schema[6].text + '：' + value[6] + '<br>';
                }
            },
            xAxis: {
                type: 'value',
                name: 'Sequence',
                nameGap: 16,
                nameTextStyle: {
                    color: '#fff',
                    fontSize: 14
                },
                max: data.length,
                splitLine: {
                    show: false
                },
                axisLine: {
                    lineStyle: {
                        color: '#eee'
                    }
                }
            },
            yAxis: {
                type: 'value',
                name: 'Coauthors',
                nameLocation: 'end',
                nameGap: 20,
                nameTextStyle: {
                    color: '#fff',
                    fontSize: 16
                },
                axisLine: {
                    lineStyle: {
                        color: '#eee'
                    }
                },
                splitLine: {
                    show: false
                }
            },
            visualMap: [
                {
                    left: 'right',
                    top: '10%',
                    dimension: 2,
                    min: 0,
                    max: 100,
                    itemWidth: 30,
                    itemHeight: 120,
                    calculable: true,
                    precision: 0.1,
                    text: ['Circle size：total cites'],
                    textGap: 30,
                    textStyle: {
                        color: '#fff'
                    },
                    inRange: {
                        symbolSize: [10, 70]
                    },
                    outOfRange: {
                        symbolSize: [10, 70],
                        color: ['rgba(255,255,255,.2)']
                    },
                    controller: {
                        inRange: {
                            color: ['#c23531']
                        },
                        outOfRange: {
                            color: ['#444']
                        }
                    }
                },
                {
                    left: 'right',
                    bottom: '5%',
                    dimension: 6,
                    min: 0,
                    max: 30,
                    itemHeight: 120,
                    calculable: true,
                    precision: 0.1,
                    text: ['Brightness：student number'],
                    textGap: 30,
                    textStyle: {
                        color: '#fff'
                    },
                    inRange: {
                        colorLightness: [1, 0.5]
                    },
                    outOfRange: {
                        color: ['rgba(255,255,255,.2)']
                    },
                    controller: {
                        inRange: {
                            color: ['#c23531']
                        },
                        outOfRange: {
                            color: ['#444']
                        }
                    }
                }
            ],
            series: [
                {
                    name: 'Author',
                    type: 'scatter',
                    itemStyle: itemStyle,
                    data: data
                }
            ]
        };

        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
       </script>
   </body>
</html>