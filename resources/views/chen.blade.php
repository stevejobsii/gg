<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
    <title>朱迪作业</title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>   
        h5{
			text-align: center;
		}
        body{
			background:url(images/bg.png) no-repeat top center;
            background-size:cover;		
        }
        .wrap{
            width:100%;
            margin:0 auto;
        }
        #title{
        	margin-top: 50px;
        	text-align: center;
        	color: rgb(43,34,125);
        }
		#footer{
			bottom: 2%;
            margin:0 auto;
			color: white;
			position: absolute;
	        height: auto; 
	        width: 100%;
		}
		#first-layer{
			margin-top: 30px;
		}
		#second-layer div{
	        padding: 0;
		}
		.new{
		    position: absolute;
		    padding: 0 3px;
		    top: 20px;
		    right: 10px;
		    color: #fff;
		    font-size: 15px;
		    border-radius: 5px;
		    background-color: #00a256;
		    height: 25px;
		    line-height: 25px;
        }
        .container-fluid{
        	padding: 10px
        }
        #title img{
        	max-width: 90%;
        	max-height: 90%;
        	text-align: center;
        }
        #first-layer {
        	margin-top: 30px;
        }
        #second-layer {
        	margin: 0px;
        }
        #first-layer img, #second-layer img{
        	width: 70px;
		    height: 70px;
		    display: block;
		    margin-right: auto;
		    margin-left: auto;
        }
		.link{
			color: white;
			width: 70px;
			font-size: 16px;
			text-align: center;
			margin-top: 10px;
		}
		#first-layer p, #second-layer p{
			font-weight: bold;
		    display: block;
		    margin-right: auto;
		    margin-left: auto;
		}
    </style>
</head>
	<body id="body">
	    <div id="title">
	      <img src="/images/title.png"><div class="new">最新</div>
	    </div>
		<div class="wrap">
		    <div class="container-fluid">
			    <div id="first-layer"class="raw">
				    <div class="col-md-4 col-sm-4 col-xs-4">
	                    <img src="/images/i1.png"><p class="link">大赛通知</p>
				    </div>
			        <div class="col-md-4 col-sm-4 col-xs-4">
				        <img src="/images/i2.png"><p class="link">摄影投稿</p>
				    </div>	   
				    <div class="col-md-4 col-sm-4 col-xs-4">
				        <img src="/images/i3.png"><p class="link">媒体登记</p>
				    </div>
				</div>
				<div id="second-layer"class="raw">
				    <div class="col-md-3 col-sm-3 col-xs-3">
	                    <img src="/images/i4.png"><p class="link">作品展示</p>
				    </div>
			        <div class="col-md-3 col-sm-3 col-xs-3">
				        <img src="/images/i5.png"><p class="link">省赛区</p>
				    </div>	   
				    <div class="col-md-3 col-sm-3 col-xs-3">
				        <img src="/images/i6.png"><p class="link">总决赛</p>
				    </div>
				    <div class="col-md-3 col-sm-3 col-xs-3">
                        <img src="/images/i7.png"><p class="link">摄影培训</p>
				    </div>
				</div>
		    </div>
		</div>
		<div id="footer" class="footer">
			<h5>指导单位：国家卫生计生委宣传司</h5>
			<h5>主办单位：中国卫生摄影协会、健康报社</h5>
			<h5>2016年4月至2016年6月</h5>
		</div>
	</body>
</html>

