new Vue({
    el: '#vote',
    data:{
       liked : false
    },
    methods:{
       toggleLike: function(){
       var pathname = window.location.pathname;
       this.liked = ! this.liked;
       this.$http.get(pathname +'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count)}).error(function () {
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
    data:{
       liked : false
    }, 
    methods:{
       toggleLike: function(){
       this.liked = ! this.liked;
       this.$http.get('articles/'+elId+'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count)}).error(function () {
            window.location.replace('auth/login');
        }); 
       if($('#'+'b'+elId).text().indexOf("points") >= 0){
       var currentValue = $('#'+'b'+elId).text().substring(6);
       var newValue = parseInt(currentValue) + 1
       $('#'+'b'+elId).text(newValue);
       }else{var currentValue = $('#'+'b'+elId).text();
       var newValue = parseInt(currentValue) - 1
       $('#'+'b'+elId).text('points'+newValue);};
       }
    }
})

