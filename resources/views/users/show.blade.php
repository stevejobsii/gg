@extends('app')
@section('content')
    @include('users.partials.infonav', ['current' => 'basicinfo'])
	  <style>
	  body {
	      position: relative;
	  }
	  ul.nav-pills {
	      top: 200px;
	      position: fixed;
	  }
	  div.col-sm-10 div {
	      height: 250px;
	      font-size: 28px;
	  }
	  #section1 {color: #fff; background-color: #1E88E5;}
	  #section2 {color: #fff; background-color: #673ab7;}
	  #section3 {color: #fff; background-color: #ff9800;}
	  #section41 {color: #fff; background-color: #00bcd4;}
	  #section42 {color: #fff; background-color: #009688;}  
	  </style>


  <div class="row">
    <nav class="col-sm-2" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Section 1</a></li>
        <li><a href="#section2">Section 2</a></li>
        <li><a href="#section3">Section 3</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Section 4 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#section41">Section 4-1</a></li>
            <li><a href="#section42">Section 4-2</a></li>                     
          </ul>
        </li>
      </ul>
    </nav>
    <div class="col-sm-10">
      <div id="section1">    
        <h1>Section 1</h1>
        <p>Try to scroll this section and look at the navigation list while scrolling!</p>
      </div>
      <div id="section2"> 
        <h1>Section 2</h1>
        <p>Try to scroll this section and look at the navigation list while scrolling!</p>
      </div>        
      <div id="section3">         
        <h1>Section 3</h1>
        <p>Try to scroll this section and look at the navigation list while scrolling!</p>
      </div>
      <div id="section41">         
        <h1>Section 4-1</h1>
        <p>Try to scroll this section and look at the navigation list while scrolling!</p>
      </div>      
      <div id="section42">         
        <h1>Section 4-2</h1>
        <p>Try to scroll this section and look at the navigation list while scrolling!</p>
      </div>
    </div>
  </div>

@stop
