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
//点赞阴影
$('.btn-default').click(function() {
    $(this).toggleClass('btn-default');
});
//gif alt 
(function($) {
  $('figure').on('mouseenter', function() {
    var $this   = $(this),
        $index  = $this.index(),     
        $img    = $this.children('img'),
        $imgSrc = $img.attr('src'),
        $imgAlt = $img.attr('data-alt'),
        $imgExt = $imgAlt.split('.');       
    if($imgExt[1] === 'gif') {
      $img.attr('src', $img.data('alt')).attr('data-alt', $imgSrc);
    } else {//点击停止或改变状态
      $(this).on('click', function() {
      $img.attr('src', $imgAlt).attr('data-alt', $img.data('alt'));});
    }
  });
})(jQuery);



