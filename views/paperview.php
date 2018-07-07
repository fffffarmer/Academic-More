<html lang="en">
  <head>
        <link rel="icon" href="/myicon.ico">
    <meta charset="utf-8">
    <title>Paper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/demo.css">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/button.css" rel="stylesheet">
      <style type="text/css">
      .my_font{
        font-size: 20px;
        color:  #4169E1;
        font-style: italic;
      }

      .my_font2{
        font-size: 55px;
        color:  #4169E1;
        font-style: italic;
      }

      .my_font3{
        text-transform:capitalize;
      }

     .demo{padding: 2em 0; background: #fff;}
  a:hover,a:focus{
    text-decoration: none;
    outline: none;
  }
  #accordion .panel{
    border: none;
    box-shadow: none;
    border-radius: 0;
    margin: 0 0 15px 10px;
  }
  #accordion .panel-heading{
    padding: 0;
    border-radius: 30px;
  }
  #accordion .panel-title a{
    text-transform:capitalize;
    display: block;
    padding: 12px 20px 12px 50px;
    background: #ebb710;
    font-size: 18px;
    font-weight: 600;
    color: #fff;
    border: 1px solid transparent;
    border-radius: 30px;
    position: relative;
    transition: all 0.1s ease 0s;
  }
  #accordion .panel-title a.collapsed{
    background: #fff;
    color: #0d345d;
    border: 1px solid #ddd;
  }
  #accordion .panel-title a:after,
  #accordion .panel-title a.collapsed:after{
    content: "\f107";
    font-family: fontawesome;
    width: 55px;
    height: 55px;
    line-height: 55px;
    border-radius: 50%;
    background: #ebb710;
    font-size: 25px;
    color: #fff;
    text-align: center;
    border: 1px solid transparent;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.58);
    position: absolute;
    top: -5px;
    left: -20px;
    transition: all 0.3s ease 0s;
  }
  #accordion .panel-title a.collapsed:after{
    content: "\f105";
    background: #fff;
    color: #0d345d;
    border: 1px solid #ddd;
    box-shadow: none;
  }
  #accordion .panel-body{
    padding: 20px 25px 10px 9px;
    background: transparent;
    font-size: 14px;
    color: #8c8c8c;
    line-height: 25px;
    border-top: none;
    position: relative;
  }
  #accordion .panel-body p{
    padding-left: 25px;
    border-left: 1px dashed #8c8c8c;
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
              <li class="active"><a href="#">Paper Per Year</a></li>
            </ul>
            <iframe src="paper_graph?papertitle=<?php echo $papertitle; ?>" frameborder='0' width='400' scrolling='No' height='400' leftmargin='0' topmargin='0' id='paper_graph'></iframe> 
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span8">
          <div class="hero-unit">
            <h1>Search for <span class='my_font2'>"<?php echo $papertitle; ?>"</span></h1>  <!--添加搜索的papername-->
            <p><?php echo $num; ?> results collected<!--搜索的作者名字--></p>
          </div>
          <div class="row-fluid">
              <div class="col-md-offset-3 col-md-6">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="row">
      <div class="span12">
      <div class="dispattern"><p id=9></p><button class="button button-3d button-box button-normal" id=#><div class="fa fa-play"></div></button></div></div></div><br><br>
      </div>
        </div>
      </div>

      </div>
            <!--/span-->
          </div>
          <div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';"></div>
      <div align='center'>
          <button class="button button-3d button-box button-normal" id="last">Pre</button>
          <!--input type="button" value="Last Page" id="last"-->
      <i id='text'></i>
          <button class="button button-3d button-box button-normal" id="next">Next</button>
          <!--input type="button" value="Next Page" id="next"-->
      </div>
      </div>
      
  	  </div>

      <script type="text/javascript" src="/jquery.js"></script>
  <script>
    $(document).ready(function(){
      function getdata(){
      	$("#accordion").empty();
        $.getJSON("paper_data", {'papertitle':'<?php echo $_GET['papertitle']; ?>', 'page':page}, function(data){
          $.each(data, function(i, paper){
            var panel;
            if (paper['tags'].length == 0)
            {
              panel = "<div class='panel panel-default'><div class='panel-heading' role='tab·····························'' id='heading" + (i + "") + "'><h4 class='panel-title'><a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse" + (i + "") + "'aria-expanded='false' aria-controls='collapse" + (i + "") + "'>" + paper["title"] + " (" + paper["publishyear"] +  ")</a></h4></div><div id='collapse" + (i + "") + "' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading" + (i + "") + "'><div class='panel-body'><p style='font-size:18px;color:#000'><div>Cites: " + paper['cites'] + " Venue: " + paper['venue'] + "</div><div>Author Information: </div><table id='receiveLogs-table' class='table table-hover'data-pagination='false' data-show-refresh='false' data-show-toggle='false' data-showColumns='false' data-toggle='table' data-row-style='rowStyle'><thead><tr><th><div align='center'>Sequence</div></th><th><div align='center'>ID</div></th><th><div align='center'>Name</div></th></tr></thead><tbody>";
            }

            else 
            {
              var tag_content = "";
              for (var j in paper['tags'])
              {
                tag_content += "<span class='label label-info'>" + paper['tags'][j].toUpperCase() + "</span>";
              }

              // panel = "<div class='panel panel-default'><div class='panel-heading' role='tab·····························'' id='heading" + (i + "") + "'><h4 class='panel-title'><a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse" + (i + "") + "'aria-expanded='false' aria-controls='collapse" + (i + "") + "'>" +paper["title"] + "(" + paper["publishyear"] +  ")</a></h4></div><div id='collapse" + (i + "") + "' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading" + (i + "") + "'><div class='panel-body'><p style='font-size:18px;color:#000'><div><span class='label label-info'>good</span></div><div>Author Information: </div><table id='receiveLogs-table' class='table table-hover'data-pagination='false' data-show-refresh='false' data-show-toggle='false' data-showColumns='false' data-toggle='table' data-row-style='rowStyle'><thead><tr><th data-field='name' data-align='center'>Name</th><th data-field='sequence' data-align='center'>Sequence</th><th data-field='id' data-align='center'>ID</th></tr></thead><tbody>";
              panel = "<div class='panel panel-default'><div class='panel-heading' role='tab·····························'' id='heading" + (i + "") + "'><h4 class='panel-title'><a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse" + (i + "") + "'aria-expanded='false' aria-controls='collapse" + (i + "") + "'>" + paper["title"] + "(" + paper["publishyear"] +  ") " + tag_content + "</a></h4></div><div id='collapse" + (i + "") + "' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading" + (i + "") + "'><div class='panel-body'><p style='font-size:18px;color:#000'><div>Author Information: </div><table id='receiveLogs-table' class='table table-hover'data-pagination='false' data-show-refresh='false' data-show-toggle='false' data-showColumns='false' data-toggle='table' data-row-style='rowStyle'><thead><tr><th data-field='name' data-align='center'>Name</th><th data-field='sequence' data-align='center'>Sequence</th><th data-field='id' data-align='center'>ID</th></tr></thead><tbody>";
            }

          	// var panel = "<div class='panel panel-default'><div class='panel-heading' role='tab·····························'' id='heading" + (i + "") + "'><h4 class='panel-title'><a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse" + (i + "") + "'aria-expanded='false' aria-controls='collapse" + (i + "") + "'>" +paper["title"] + "(" + paper["publishyear"] +  ")</a></h4></div><div id='collapse" + (i + "") + "' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading" + (i + "") + "'><div class='panel-body'><p style='font-size:18px;color:#000'><div>Tag: <span class='label label-info'>bleadfasdf</span></div><div>Author Information: </div><table id='receiveLogs-table' class='table table-hover'data-pagination='false' data-show-refresh='false' data-show-toggle='false' data-showColumns='false' data-toggle='table' data-row-style='rowStyle'><thead><tr><th data-field='name' data-align='center'>Name</th><th data-field='sequence' data-align='center'>Sequence</th><th data-field='id' data-align='center'>ID</th></tr></thead><tbody>";

          	// $("#accordion").append(panel);

            // $("#"+(i*2+"")).html("Title: " + paper["title"] + "&ensp; PublishYear: " + paper["publishyear"]);

            $.each(paper["authorinfo"], function(j, author){
            	var tr = "<tr><td><div align='center'>" + author["authorsequence"] + "</div></td><td><div align='center'>" + author["authorid"] + "</div></td><td><div align='center'><span class='my_font3'>" + "<a href='author_ind?id=" + author["authorid"] + "'>" + author["authorname"] + "</span></div></td></tr>";
            	panel += tr;
			      });

      			var end = "</tbody></table></p><div align='right'> <button class='button button-3d button-box button-middle'><i class='fa fa-play' id='b" + (i + "") + "'></i></button></div></div></div></div>";
      			panel += end;

      			$("#accordion").append(panel);

      			$("#b" + i + "").click(function(){
      		        $(window).attr('location', "paper_ind?id=" + paper["id"]);
      		  });

                  // var butt=document.getElementById("b"+(2*i+1+""));
                  // butt.value = author["id"];
      			// butt.getAttributeNode("value").value=author["id"];
          });
                
        })
        $("#text").html(page + '/' + pagenum);
      }

      function showbuttion(){
        if (pagenum != 1){
          if (page == 1){
            $("#last").hide();
            $("#next").show();
          }
          else if (page == pagenum){
            $("#last").show();
            $("#next").hide();
          }
          else{
            $("#next").show();
            $("#last").show();
          }
        }
        else {
          $("#last").hide();
          $("#next").hide();
        }
      }

      $("#next").click(function(){
        page++;
        getdata();
        showbuttion();
      });

      $("#last").click(function(){
        page--;
        getdata();
        showbuttion();
      });

      // $("#b1").click(function(){
      // 	var content = document.getElementById("b1").value;
      //   $(window).attr('location', "author_ind?id=" + content);
      // });

      var page = 1;

      var num = parseInt(<?php echo $num;?>);

      if (num % 10 == 0) var pagenum = num / 10;
      else var pagenum = num / 10 + 1;
      pagenum = parseInt(pagenum);

      getdata();

      showbuttion();

    });
  </script>

      <hr>
    </div>
    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>
