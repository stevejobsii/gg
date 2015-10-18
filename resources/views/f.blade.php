<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/sweetalert/1.1.0/sweetalert.min.css" rel="stylesheet">
    <link  rel="stylesheet" href="/css/main.css">
    <meta id="token" name="token" value="{{ csrf_token() }}">

    <title>好去处GoodGoTo</title>
</head>
<body>
 


 <p>Link 1</p>
<a data-toggle="modal" data-id="ISBN564541" title="Add this item" class="open-AddBookDialog btn btn-primary" href="#addBookDialog">test</a>

<p>&nbsp;</p>


<p>Link 2</p>
<a data-toggle="modal" data-id="ISBN-001122" title="Add this item" class="open-AddBookDialog btn btn-primary" href="#addBookDialog">test</a>

  <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
            <script src="//cdn.bootcss.com/vue/0.12.16/vue.min.js"></script>
             <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
            <script src="//cdn.bootcss.com/vue-resource/0.1.16/vue-resource.min.js"></script>


<script type="text/javascript">
  $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     alert( myBookId );
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>

          
            <script src="/js/main.js"></script>
   
    </body>
</html>
