<html lang="en">
  <head>
    <link rel="icon" href="/myicon.ico">
    <meta charset="utf-8">
    <title>Author</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/button.css" rel="stylesheet">
    <style type="text/css">
              .my_font{
        text-transform:capitalize;
        font-size: 40px;
        color:  #6495ED;
      }
        .my_font2{
        text-transform:capitalize;
      }

            .my_font3{
        text-transform:capitalize;
        font-size: 20px;
        color:  #4F4F4F;
      }
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
.node circle {
            cursor: pointer;
            fill: #fff;
            stroke: steelblue;
            stroke-width: 1.5px;
        }
        .node text {
            font-size: 11px;
        }
        path.link {
            fill: none;
            stroke: #ccc;
            stroke-width: 1.5px;
        }
button {
    text-align:center;
  border:2px solid #a1a1a1;
  padding:10px 20px; 
  background:#dddddd;
  width:150px;
  border-radius:20px;
  -moz-border-radius:25px; /* 老的 Firefox */

}
html {
  position: relative;
  min-height: 100%;
}

body {
  font-family: "Segoe UI", "Lucida Grande", Helvetica, Arial, "Microsoft YaHei", FreeSans, Arimo, "Droid Sans", "wenquanyi micro hei", "Hiragino Sans GB", "Hiragino Sans GB W3", FontAwesome, sans-serif;
}

.front,
.back {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
}

.front:hover {
  animation-name: disappear;
  animation-duration: 1s;
  animation-iteration-count: 1;
  animation-fill-mode: forwards;
}

@keyframes disappear {
  100% {
    opacity: 0.0;
  }
  0% {
    opacity: 1.0;
  }
}

</style>
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <!--link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png"-->
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

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4">
          <!-- <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header" style="font-size:18px">Visualization</li>
              <br>
              <li><div style="font-size:20px;color:#000">&nbsp;&nbsp;&nbsp;Teacher - Student Tree</div></li>
              <br>
              <span class="button-wrap">
              <a href="javascript:void(0);" class="button button-pill button-small" onclick="show_student_tree()">Teacher</a>
              </span>
              <span class="button-wrap">
              <a href="javascript:void(0);" class="button button-pill button-small" onclick="show_teacher_tree()">Student</a>
              </span>
              <li><div style="font-size:20px;color:#000">&nbsp;&nbsp;&nbsp;Force - Graph</div></li>
              <br>
              <span class="button-wrap">
              <a href="javascript:void(0);" class="button button-pill button-small" onclick="show_force_graph()">Show</a>
              </span>
            </ul> -->
            <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Visualization</li>
              <li class="active" id="student_button"><a href="javascript:void(0);">Papers in last 10 years</a></li>
     <!--          <li class="active"><a href="javascript:void(0);" onclick="show_student_tree()">Force Graph </a></li> -->
            </ul>
          <iframe src="tag_graph?tag=<?php echo $tag; ?>" frameborder='0' width='400' scrolling='No' height='400' leftmargin='0' topmargin='0' id='graph'></iframe> 
          </div><!--/.well -->           
        </div><!--/span-->


        <div class="span8">
          <div class="hero-unit">
            <h1><span class='my_font'>"<?php echo $tag; ?>"</span></h1>  <!--添加搜索的authorname-->
          </div>
          <div class="row-fluid">
            <div class="span12">

              <p style="font-size:18px;color:#000">
                <div>10 Most cited papers</div>
            <table id="receiveLogs-table"
              class="table table-hover"
              data-pagination="false"
              data-show-refresh="false"
              data-show-toggle="false"
              data-showColumns="false"
              data-toggle="table"
              data-row-style="rowStyle">
              <thead> 
              <tr>
              <th><div align='center'>ID</div></th>
              <th><div align='center'>Title</div></th>
              </tr>
              </thead>
              <tbody id="papercontent">
              </tbody>
            </table>
          </p>
            </div><!--/span-->
          </div>
        </div>
      </div>

      <script src="/js/jquery.js"></script>
    <script src="/js/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>  
<script> 

$.getJSON("tag_paper_data", {'tag':'<?php echo $tag; ?>'}, function(data){
  $.each(data, function(i, paper){
    var tr = "<tr><td><div align='center'>" + paper['id'] + "</div></td><td><div align='center'><span class='my_font2'>" + "<a href='paper_ind?id=" + paper['id'] + "'>" + paper['title'] + "</span></div></td></tr>";
    $("#papercontent").append(tr);
  });
})

</script>
      
      <hr>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

<!--       <style>

  .links line {
    stroke: #999;
    stroke-opacity: 0.6;
  }

  .nodes circle {
    stroke: #fff;
    stroke-width: 1.5px;
  }

  </style>
  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script>

  var svg = d3.select("#force_graph"),
      width = +svg.attr("width"),
      height = +svg.attr("height");

  var color = d3.scaleOrdinal(d3.schemeCategory20);

  var simulation = d3.forceSimulation()
      .force("link", d3.forceLink().id(function(d) { return d.id; }))
      .force("charge", d3.forceManyBody())
      .force("center", d3.forceCenter(width / 2, height / 2));

  function show_force_graph()
  {
    d3.json("author_graph_data?authorid=", function(error, graph) {
      if (error) throw error;

      var link = svg.append("g")
          .attr("class", "links")
        .selectAll("line")
        .data(graph.links)
        .enter().append("line")
          .attr("stroke-width", function(d) { return Math.sqrt(d.value); });

      var node = svg.append("g")
          .attr("class", "nodes")
        .selectAll("circle")
        .data(graph.nodes)
        .enter().append("circle")
          .attr("r", 5)
          .attr("fill", function(d) { return color(d.group); })
          .call(d3.drag()
              .on("start", dragstarted)
              .on("drag", dragged)
              .on("end", dragended));

      node.append("title")
          .text(function(d) { return d.name; });

      simulation
          .nodes(graph.nodes)
          .on("tick", ticked);

      simulation.force("link")
          .links(graph.links);

      function ticked() {
        link
            .attr("x1", function(d) { return d.source.x; })
            .attr("y1", function(d) { return d.source.y; })
            .attr("x2", function(d) { return d.target.x; })
            .attr("y2", function(d) { return d.target.y; });

        node
            .attr("cx", function(d) { return d.x; })
            .attr("cy", function(d) { return d.y; });
      }
    });

    function dragstarted(d) {
      if (!d3.event.active) simulation.alphaTarget(0.3).restart();
      d.fx = d.x;
      d.fy = d.y;
    }

    function dragged(d) {
      d.fx = d3.event.x;
      d.fy = d3.event.y;
    }

    function dragended(d) {
      if (!d3.event.active) simulation.alphaTarget(0);
      d.fx = null;
      d.fy = null;
    }
  }

  </script> -->




  </body>
</html>
