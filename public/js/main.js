Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
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
        config.bdText = title+'请访问goodgoto.com';
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

//页内投票
Vue.component('upvotebookmark',{
  template : '#upvote-bookmark-template',

  props:['when-applied','when-bookmark','id','title','photoname'],//id of <upvote>component

  methods:{
      toggleLike: function(){
      this.whenApplied(this.id);//push id to upper
      },
      bookMark: function(){
      this.whenBookmark(this.photoname, this.title, this.id);
      },
  }
});
new Vue({    
    el: '.votebookmark',
    methods:{
       bookmark: function(photoname,title){
          var pathname = window.location.hostname;
          this.$http.post('http://'+pathname+'/api/bookmark',{'bookmark':photoname},function(){
          swal({
              title: '图片标题:'+title+'已经设为您的书签！',
              text: "点击右上角续看书签!",
              type: "success",
              timer: 2600,
              showConfirmButton: false
          });
          }).error(function () {
          swal({title: "您要登陆后才能使用书签!",   
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#DD6B55",   
          confirmButtonText: "Yes,简单注册登录",   
          closeOnConfirm: false }, 
          function(){window.location.replace('auth/login');});
          });
       },//@{{bookmark}}
       //页内点赞
       toggleLike: function(id){
       var pathname = window.location.hostname;
       this.$http.get('http://'+pathname+'/articles/'+id+'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count);
       $('#'+'b'+id).text(vote_count);}).error(function () {
        swal({title: "您要登陆后才能点赞!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes,简单注册登录",   
        closeOnConfirm: false }, 
        function(){window.location.replace('auth/login');});
        });
       },
    }   
});
//reply  upvote
Vue.component('upvote',{
  template : '#upvote-template',

  props:['when-applied','id'],//id of <upvote>component

  methods:{
      toggleLike: function(){
      this.whenApplied(this.id);//push id to upper
      },
  }
});
new Vue({    
    el: '.reply_list',
    methods:{
       toggleLike: function(id){
       var pathname = window.location.hostname;
       this.$http.get('http://'+pathname+'/replies/'+id+'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count);
       $('#'+'b'+id).text(vote_count);}).error(function () {
        swal({title: "您要登陆后才能点赞!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes,简单注册登录",   
        closeOnConfirm: false }, 
        //replace-<>
        function(){var pathname = window.location.hostname;
          window.location.replace('http://'+pathname+'/auth/login');});
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
      title: "您确定吗?", 
      text: "您点击'OK'后,将永久删除。" , 
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
//guestbook
// register the grid component
Vue.component('demo-grid', {
  template: '#grid-template',
  replace: true,
  props: ['data', 'columns', 'filter-key'],
  data: function () {
    return {
      data: null,
      columns: null,
      sortKey: '',
      filterKey: '',
      reversed: {}
    }
  },
  compiled: function () {
    // initialize reverse state
    var self = this
    this.columns.forEach(function (key) {
      self.reversed.$add(key, false)
    })
  },
  methods: {
    sortBy: function (key) {
      this.sortKey = key
      this.reversed[key] = !this.reversed[key]
    }
  }
})

new Vue({
    el: '#guestbook',
    data: {
        searchQuery: '',
        gridColumns: ['name', 'message'],
        reverse : true,
        newMessage: { name: '', message: '' },
        submitted: false
    },
    computed: {
        errors: function() {
            for (var key in this.newMessage) {
                if ( ! this.newMessage[key]) return true;
            }
            return false;
        }
    },
    ready: function() {
        this.fetchMessages();
    },
    methods: {
        fetchMessages: function() {
            this.$http.get('/api/messages', function(messages) {
                this.$set('messages', messages);
            });
        },
        onSubmitForm: function(e) {
            e.preventDefault();
            var message = this.newMessage;
            this.messages.push(message);
            this.newMessage = { name: '', message: '' };
            this.submitted = true;
            this.$http.post('api/messages', message);
        }
    }
});
//side-bar ad
// define slider component
Vue.component('img-slider', {
  template: '#img-slider-template',
  replace: true
});
// boot up demo
new Vue({
  el: '#side-bar-ad',
});
//bookmark-link
new Vue({
    el: '#bookmark-link',
    methods: {
        getbookmark: function() {
            this.$http.get('/api/bookmark', function(bookmark) {
                this.$set('bookmarkid', bookmark);
                var pathname = window.location.hostname;
                window.location = 'http://'+pathname+'/articles'+'?id='+this.bookmarkid;
            });      
        },
    },
});




