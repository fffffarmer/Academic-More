<!DOCTYPE html>
<html lang="en">
  <head>
        <link rel="icon" href="/myicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Author</title>
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
        padding-bottom: 40px;
      }
  .dispattern{
    background-color: #FFFFFF;
    border:1px solid #d0d0d0;
    border-radius: 2px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom:30px;
    padding-top: 30px;
    font-family: serif;
    font-size:20px;
    color: #4F4F4F;
    font-weight: 550;
    line-height: 150%;
    box-shadow:0px 2px 5px #4F4F4F;
    }
  .but{
    padding-right: 100px;
  }

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
        font-size: 20px;
        color:  #4F4F4F;
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
          <a class="brand" href="/index.php/home">A&M</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="/index.php/home">Home</a></li>
              <li><a href="/index.php/home/about">About</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<!--     <div class="container" id="container"> -->

      <div class="container" id="container">
      </div>
<script src="/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';"></div>
      <div align='center'>
          <button class="button button-3d button-box button-normal" id="last">Pre</button>
          <!--input type="button" value="Last Page" id="last"-->
      <i id='text'></i>
          <button class="button button-3d button-box button-normal" id="next">Next</button>
          <!--input type="button" value="Next Page" id="next"-->
      </div>

  <script type="text/javascript" src="/jquery.js"></script>
  <script>
    $(document).ready(function(){
      function getdata(){
        $("#area").empty();
        $.getJSON("author_data", {'scholarname':'<?php echo $scholarname; ?>', 'page':page}, 
          function(data){
            var headcontent = "<div class='hero-unit'><h1>Search for <span class='my_font2'>\"<?php echo $scholarname; ?>\"</span></h1><p><?php echo $num; ?> result collected</p></div>";
            $("#container").html(headcontent);
          $.each(data, function(i, author){
            var row = "<div class='row'><div class='span12'><div class='dispattern'><p>ID: " + author["id"] + "<br>"+"Name: <span class='my_font3'>"+ author["name"] + "</span><br>"+"Paper Number: "+ author["num_paper"]+"<br>"+"Affiliation: <span class='my_font3'>"+ author["affiliation"] + "</span></p><div align='right'><button class='button button-3d button-box button-normal'><div class='fa fa-play' id='b" + (i + "") + "'></div></button></div></div></div></div><br><br>";
          	// var eachspan = $("<div class="span6"><div class="col-md-offset-3 col-md-6"><div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"><div class="panel panel-default"><div class="panel-heading" role="tab" id="headingTen"><h4 class="panel-title"><a class="collapsed role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen" id="18"></a></h4></div><div id="collapseTen" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTen"><div class="panel-body" style="font-size:18px;color:#000"><p id="19"></p><div align="right"><button class="button button-3d button-box button-large" id="b19"><i class="fa fa-play"></i></button></div></div></div></div></div></div></div>");
          	// $("#area").append("");
            // $("#"+(i*2+"")).html("Author: "+author["id"]);
            // $("#"+(2*i+1+"")).html("Name: "+author["name"]+"<br>"+"Paper Number: "+author["num_paper"]+"<br>"+"Affiliation Name: "+author["affiliation"]);
            // var butt=document.getElementById("b"+(2*i+1+""));
            // butt.value = author["id"];
            $("#container").append(row);

            $("#b" + i + "").click(function(){
                $(window).attr('location', "author_ind?id=" + author["id"]);
            });
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


      // var item = ["b1","b3","b5","b7","b9","b11","b13","b15","b17","b19"];
      // $(item).each(function(k,v){
      //     $("#" + v).click(function(e){   
      //     	  var content = document.getElementById(v).value;
      //  		  $(window).attr('location', "author_ind?id=" + content);
      //     });
      // });

      var page = 1;

      var num = parseInt(<?php echo $num;?>);

      if (num % 10 == 0) var pagenum = num / 10;
      else var pagenum = num / 10 + 1;
      pagenum = parseInt(pagenum);

      getdata();

      showbuttion();

    })
  </script>
      <hr>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>

  </body>
</html>
