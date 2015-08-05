new Vue({

    el: '#vote',

    data:{
       liked : false
    },
    ready: function() {
        this.toggleLike();
    },
    methods:{
       toggleLike: function(e){
       e.preventDefault();
       var pathname = window.location.pathname;
       this.liked = ! this.liked;
       this.$http.get(pathname +'/upvote',function(vote_count) {
                this.$set('vote_count', vote_count)})
       
       }
    }

})

new Vue({
    el: '.list',

    data:{
        liked : false
     },

    ready: function() {

       this.toggleLike();},
    
    methods: {
       toggleLike: function(){
       this.liked = ! this.liked;
       this.$http.get('articles/108/upvote' ,function(vote_count) {
       this.$set('vote_count', vote_count)})
       }
   }
       
})