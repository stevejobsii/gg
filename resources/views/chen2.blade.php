<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
    <title>朱迪作业</title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style> 	
		@media (min-width: 350px){
          body{
	    	background:url(images/bg.png) no-repeat top center;
            background-size:cover;		
          }
		}
        @media (max-width: 350px){
          body{
	    	background:url(images/bg-lowerpixel.png) no-repeat top center;
            background-size:cover;		
          }
        }
        h5{
			text-align: center;
		}	
        .wrap{
            width:100%;
        }
        #title{
        	margin-top: 15%;
        	text-align: center;
        }
        #title img{
        	max-width: 90%;
        	max-height: 90%;
        }
		#footer{
			bottom: 1%;
			color: white;
			position: absolute;
	        width: 100%;
		}
		#second-layer div, #first-layer div{
	        padding: 1px;
		}
        #first-layer {
        	width:90%;
        	margin-top: 10%;
        }
 
		.link{
			font-weight: bold;
            width: 100%;
			color: white;
			font-size: 16px;
			text-align: center;
			margin-top: 5%;
		}
    </style>
    <script type="text/javascript">    	
    $(window).on('resize', function() {
	    if($(window).width() > 350) {
	        $('body').addClass('limit1200');
	    }else{
	        $('body').addClass('limit400');
	    }
    })
    </script>
</head>
	<body id="body">
	    <div id="title">
	      <img src="/images/title.png">
	    </div>
		<div class="wrap">
		    <div  id="first-layer" class="container-fluid">
			    <div class="raw">
				    <div class="col-md-4 col-sm-4 col-xs-4">
	                    <img src="/images/i1.png" class="img-responsive"><p class="link">大赛通知</p>
				    </div>
			        <div class="col-md-4 col-sm-4 col-xs-4">
				        <img src="/images/i2.png" class="img-responsive"><p class="link">摄影投稿</p>
				    </div>	   
				    <div class="col-md-4 col-sm-4 col-xs-4">
				        <img src="/images/i3.png" class="img-responsive"><p class="link">媒体登记</p>
				    </div>
				</div>
			</div>
			<div id="second-layer" class="container-fluid">
				<div class="raw">
				    <div class="col-md-3 col-sm-3 col-xs-3">
	                    <img src="/images/i4.png" class="img-responsive"><p class="link">作品展示</p>
				    </div>
			        <div class="col-md-3 col-sm-3 col-xs-3">
				        <img src="/images/i5.png" class="img-responsive"><p class="link">省赛区</p>
				    </div>	   
				    <div class="col-md-3 col-sm-3 col-xs-3">
				        <img src="/images/i6.png" class="img-responsive"><p class="link">总决赛</p>
				    </div>
				    <div class="col-md-3 col-sm-3 col-xs-3">
                        <img src="/images/i7.png" class="img-responsive"><p class="link">摄影培训</p>
				    </div>
				</div>
		    </div>
		<div id="footer" class="footer">
			<h5>指导单位：国家卫生计生委宣传司</h5>
			<h5>主办单位：中国卫生摄影协会、健康报社</h5>
			<h5>2016年4月至2016年6月</h5>
		</div>

		</div>
		<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
        <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>

