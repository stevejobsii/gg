//点赞阴影
$('.btn-default').click(function() {
    $(this).toggleClass('btn-default');
});
//click to  play/pause
//!!好难才加gif图标
$('.video_wrap').mouseenter(function() {$(this).find("video")[0].play();$(this).find("h2").fadeOut();});
$('.video_wrap').click(function() {
      if ($(this).find("video")[0].paused) {
        $(this).find("video")[0].play();
        $(this).find("h2").fadeOut();
      } else {
        $(this).find("video")[0].pause();
        $(this).find("h2").fadeIn();     
      }
});
//永久删除
$('.btn-danger').click(function(e) {
e.preventDefault(); // Prevent the href from redirecting directly
    swal({
      title: "您确定吗?", 
      text: "您点击'OK'后,将永久删除。" , 
      type: "warning",
      showCancelButton: true
    }, function() {
       $('.btn-danger').unbind('click').click();
    });
});
//back-to-top
$(document).ready(function () {
   //首先将#back-to-top隐藏
   $("#back-to-top").hide();
   //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
   $(function () {
       $(window).scroll(function () {
           if ($(window).scrollTop() > 100) {
               $("#back-to-top").fadeIn(1500);
           }
           else {
               $("#back-to-top").fadeOut(1000);
           }
       });
       //当点击跳转链接后，回到页面顶部位置
       $("#back-to-top").click(function () {
           $('body,html').animate({ scrollTop: 0 }, 500);
           return false;
       });
   });
});
// reply a reply !!回复评论@
function replyOne(username){
    replyContent = $("#reply_content");
    oldContent = replyContent.val();
    prefix = "@" + username + " ";
    newContent = ''
    if(oldContent.length > 0){
        if (oldContent != prefix) {
            newContent = oldContent + "\n" + prefix;
        }
    } else {
        newContent = prefix
    }
    replyContent.focus();
    replyContent.val(newContent);
    moveEnd($("#reply_content"));
};

//search-bar hide
$(".nav-search").hide();
$("#nav-search").click(function(){
    $(".nav-search").toggle();
});

//百度分享
  var photoname = "";
  $(function () {
      $(".bdsharebuttonbox a").mouseover(function () {
          photo = $(this).attr("data-photo");
          title = $(this).attr("data-title");
          type  = $(this).attr("data-type");
      });
  });
  function SetShareUrl(cmd, config) {   
        var pathname = window.location.hostname;         
        config.bdText = title+'via goodgoto.com';
        config.bdDesc = title+'via goodgoto.com';
        config.bdUrl = 'http://'+pathname+'/images/catalog/'+ photo + type;
        config.bdPic = 'http://'+pathname+'/images/catalog/'+ photo + type;
        return config;
  };
  window._bd_share_config = {
  common : {
  onBeforeClick: SetShareUrl,
  },
  share : [{
  "bdSize" : 32, 
  }],
  }
//以下为js加载部分
  with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];

//展开
$('.side-bar-hot').mouseenter(function() { $(this).addClass('side-bar-hot-full-size');$(this).find('.show_more').html(' &UpTeeArrow; 收起');});
$('.side-bar-hot').click(function () {
          var $this = $(this);
          if (!$this.hasClass('side-bar-hot-full-size')) {
            $this.addClass('side-bar-hot-full-size');
            $this.find('.show_more').html(' &UpTeeArrow; 收起');
          } else {
            $this.removeClass('side-bar-hot-full-size');
            $this.find('.show_more').html(' &DownTeeArrow; 展开');
          }
        })

//side-bot-list
$('.hot-tabs li').mouseenter(function () {
  var tab = this.id.split('-')[1];
  
  var parent = $(this).parent();

  parent.find('li').removeClass('current');
  parent.parent().find('.hot-list-item').removeClass('hot-list-item-current');

  $(this).addClass('current');
  $('#list-' + tab).addClass('hot-list-item-current');  
});

//sticky
$(function(){ // document ready
  if (!!$('.sticky').offset()) { // make sure ".sticky" element exists
    // returns number 
    $(window).scroll(function(){ // scroll event
      var stickyTopshowmore = $('#side-bar-related-height').height();
      var windowTop = $(window).scrollTop();
       
       // returns number 
      var currentwidth = $('.side-bar').width();
      if (stickyTopshowmore < windowTop){
        $('.sticky').css({ position: 'fixed', top:40, width : currentwidth});
      }
      else {
        $('.sticky').css('position','static');
      }
    });
  }
});
    
      
$(document).ready(function (){
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="token"]').attr('value') }
    });
});

//post upvote/bookmark
$('.votebookmark').on("click", ".index-upvote", function () {
   var myBookId = $(this).data('id');
   var pathname = window.location.hostname;
   var urll = 'http://'+pathname+'/articles/'+myBookId+'/upvote';
   $.ajax({
      method: "POST",
      url: urll,
    })
    .done(function( vote_count ) {
     $('#'+'b'+myBookId).text(vote_count);
    });
});

$('.votebookmark').on("click", ".index-bookmark", function () {
   var myBookId = $(this).data('id');
   var title = $(this).data('title');
   var pathname = window.location.hostname;
   
     $.ajax({
        method: "POST",
        url:'http://'+pathname+'/api/bookmark',
        data:{'bookmark':myBookId}
      })
      .done(function() {
        swal({
              title: '图片标题:'+title+'已经设为您的书签！',
              text: "点击右上角续看书签!",
              type: "success",
              timer: 2600,
              showConfirmButton: false
        });
      })
       .fail(function() {
        swal({title: "您要登陆后才能使用书签!",   
              type: "warning",   
              showCancelButton: true,   
              confirmButtonColor: "#DD6B55",   
              confirmButtonText: "Yes,简单注册登录",   
              closeOnConfirm: false }, 
              function(){
                var pathname = window.location.hostname;
                window.location.replace('http://'+pathname+'/auth/login');});
       });
});

$('.reply_list').on("click", ".show-upvote", function () {
   var myBookId = $(this).data('id');
   var pathname = window.location.hostname;
   var urll = 'http://'+pathname+'/replies/'+myBookId+'/upvote';
   $.ajax({
      method: "POST",
      url: urll,
    })
    .done(function( vote_count ) {
     $('#'+'br'+myBookId).text(vote_count);
    });
});

//getbookmark
$('#bookmark-link').on("click",function () {
   var pathname = window.location.hostname;
   var urll = 'http://'+pathname+'/api/bookmark';
   $.ajax({
      method: "GET",
      url: urll,
    })
    .done(function( bookmark ) {
      var pathname = window.location.hostname;
      window.location.replace('http://'+pathname+'/articles?id='+bookmark);
    });
});
//upload avatar
$('#avatarinput').change(function () {
            $('#avatarinput-submit').click();
        });

$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }     
    });
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
//hover nav ul打开
$('#navbar li').hover(function(){
  $(this).children('ul').stop(true,true).slideDown(500);
},function(){
  $(this).children('ul').stop(true,true).slideUp(500);
});