new Vue({
    el: '#vote',
    methods:{
       toggleLike: function(){
       var pathname = window.location.pathname;
       this.$http.get(pathname +'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count);
       var current = vote_count.substring(1);
       var cpathname = pathname.substring(10);
       $('#'+'b'+cpathname).text(current);}).error(function () {
        swal({title: "您好！帅哥美女！",   
        text: "您要先登陆才能点赞或评论!",  
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes,登录或注册!",   
        closeOnConfirm: false }, 
        function(){window.location.replace('auth/login');});
        });   
       }
    }
})
    //抓elId的id
    var elId;
    $(".list-item").mouseover(function(ev){
    var target = $(ev.target);
    var elid = target.attr('id');
    if( target.is(".list-item") ) {
    return elId = elid;}
    });
new Vue({    
    el: '.list',
    methods:{
       toggleLike: function(){
       var pathname = window.location.hostname;
       this.$http.get('http://'+pathname+'/articles/'+elId+'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count);
       var current = vote_count.substring(1);
       $('#'+'b'+elId).text(current);}).error(function () {
        swal({title: "您好！帅哥美女！",   
        text: "您要先登陆才能点赞或评论!",  
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes,登录或注册!",   
        closeOnConfirm: false }, 
        function(){window.location.replace('auth/login');});
        });
       }
    }   
});
//reply  upvote
new Vue({    
    el: '.reply_list',
    methods:{
       toggleLike: function(){
       var pathname = window.location.hostname;
       this.$http.get('http://'+pathname+'/replies/'+elId+'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count);
       var current = vote_count.substring(1);
       $('#'+'b'+elId).text(current);}).error(function () {
        swal({title: "您好！帅哥美女！",   
        text: "您要先登陆才能点赞或评论!",  
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes,登录或注册!",   
        closeOnConfirm: false }, 
        function(){window.location.replace('auth/login');});
        });
       }
    }   
});
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

$('.btn-danger').click(function(e) {
e.preventDefault(); // Prevent the href from redirecting directly
    swal({
      title: "Are you sure?", 
      text: "If you click 'OK', you will delete it forever." , 
      type: "warning",
      showCancelButton: true
    }, function() {
       $('.btn-danger').unbind('click').click();
    });
});
// reply a reply !!回复评论
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

WB2.anyWhere(function(W){
    W.widget.connectButton({
        id: "wb_connect_btn", 
        type:"1,2",
        callback : {
            login:function(o){  
             alert("login: " + o.screen_name);//登录后的回调函数
            },  
            logout:function(){  
               alert("login: " + o.screen_name);//退出后的回调函数
            }
        }
    });
});
