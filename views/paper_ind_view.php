<html lang="en">
  <head>
        <link rel="icon" href="/myicon.ico">
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">

          .my_font{
        text-transform:capitalize;
        font-size: 40px;
        color:  #6495ED;
      }
        .my_font2{
        text-transform:capitalize;
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
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Visualization</li>
              <li class="active" id="bubble_button"><a href="javascript:void(0);" onclick="show_bubble_chart()">Bubble chart </a></li>
              <li class="negative" id="recommend_button"><a href="javascript:void(0);" onclick="show_recommendation()">Recommendation </a></li>
            </ul>
            <iframe src="paper_bubble_chart?id=<?php echo $id; ?>" frameborder='0' width='384.5' scrolling='No' height='450' leftmargin='0' topmargin='0' id='bubble_graph'></iframe> 
            <div id="recommend_content">
            <p style="font-size:18px;color:#000">
            <div> Maybe you will like:</div>
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
              <th><div align='center'>Papers Of The First Author</div></th>
              </tr>
              </thead>
              <tbody id="author_recommendation">
              </tbody>
            </table>
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
              <th><div align='center'>Papers With Same Tags</div></th>
              </tr>
              </thead>
              <tbody id="tag_recommendation">
              </tbody>
            </table>
          </p>
        </div>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span8">
          <div class="hero-unit">
            <h1><span class='my_font'><?php echo $title; ?> (<?php echo $publishyear; ?>)</span></h1>  <!--添加搜索的papername-->
            <div id="taginfo"></div>
            <h3>Citation: <?php echo $cites; ?> &nbsp;&nbsp;&nbsp;&nbsp; Venue: <?php echo $venue; ?></h3>
          </div>
          <div class="row-fluid">
            <div class="span12">
              
          

          <p style="font-size:18px;color:#000">
            <div>Author Information</div>
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
              <th><div align='center'>Sequence</div></th>
              <th><div align='center'>ID</div></th>
              <th><div align='center'>Name</div></th>
              </tr>
              </thead>
              <tbody id="authorcontent">
              </tbody>
            </table>
          </p>
          <!-- <div class="row-fluid">
            <div class="span12">
            <h3>Co-Authors</h3></div></div>
            <div class="row-fluid">
            <div class="span4">
              <h4>AuthorSequence</h4>
              <p id=#></p>
            </div>
            <div class="span4">
              <h4>AuthorID</h4>
              <p id=#></p>
            </div>
            <div class="span4">
              <h4>AuthorName</h4>
              <p id=#></p>
            </div>
          </div> -->
        </div>
      </div>

      <hr>


    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
      $("#recommend_content").hide();
      var tags = eval(<?php echo json_encode($tags); ?>);
      if (tags.length =! 0)
      {
        var tag_content = "";
        for (var j in tags)
        {
          tag_content += "<span class='label label-info' onclick='javascript:window.open(&quot;tag?tag=" + tags[j] + "&quot;)'>" + tags[j].toUpperCase() + "</span>";
          // $("#tag" + (j + "")).click(function(){
          //   $(window).attr('location', "tag?tag=" + tags[j]);
          // });
        }

        $('#taginfo').append(tag_content);
      }
      function show_bubble_chart() {
        $('#bubble_button').attr("class", "active");
        $('#recommend_button').attr("class", "negative");
        $("#recommend_content").hide();
        $("#bubble_graph").show();
      }
      function show_recommendation() {
        $('#bubble_button').attr("class", "negative");
        $('#recommend_button').attr("class", "active");
        $("#bubble_graph").hide();
        $("#recommend_content").show();
        $.getJSON("paper_author_recommendation_data", {'id':'<?php echo $id; ?>'}, function(data){
          $.each(data, function(i, paper){
            var tr = "<tr><td><div align='center'><span class='my_font2'>" + "<a href='paper_ind?id=" + paper['id'] + "'>" + paper['title'] + "</span></div></td></tr>";
            $("#author_recommendation").append(tr);
          });
        });

        $.getJSON("paper_tag_recommendation_data", {'id':'<?php echo $id; ?>'}, function(data){
          $.each(data, function(i, paper){
            var tr = "<tr><td><div align='center'><span class='my_font2'>" + "<a href='paper_ind?id=" + paper['id'] + "'>" + paper['title'] + "</span></div></td></tr>";
            $("#tag_recommendation").append(tr);
          });
        });
      }

      var author_content = eval(<?php echo json_encode($authorinfo); ?>);
      for (var i in author_content) {
        var tr = "<tr><td><div align='center'>" + author_content[i].authorsequence + "</div></td><td><div align='center'>" + author_content[i].authorid + "</div></td><td><div align='center'><span class='my_font2'>" + "<a href='author_ind?id=" + author_content[i].authorid + "'>" + author_content[i].authorname + "</span></div></td></tr>";
        $("#authorcontent").append(tr);
        // alert(author_content[i].authorname);
      }

      // $.each(author_content, function(i, author){
      //   var tr = "<tr><td><div align='center'>" + author["authorsequence"] + "</div></td><td><div align='center'>" + author["authorid"] + "</div></td><td><div align='center'>" + "<a href='author_ind?id=" + author["authorid"] + "'>" + author["authorname"] + "</div></td></tr>";
      //   $("#tbody").append(tr);
      // });
    </script>
  </body>
</html>
