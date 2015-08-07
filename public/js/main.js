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
        window.location.replace('/auth/login');
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
       this.$http.get('articles/'+elId+'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count);
       var current = vote_count.substring(1);
       $('#'+'b'+elId).text(current);}).error(function () {
            window.location.replace('auth/login');
        }); 
       }
    }
})
//百度share
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":["qzone","tsina","weixin","renren","tqq","douban","fbook","twi","linkedin"],"bdPic":"","bdStyle":"0","bdSize":"16"},"image":{"viewList":["weixin","tsina"],"viewText":"Share：","viewSize":"24"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];

