if(!function(e,t,n){"use strict";!function o(e,t,n){function r(s,i){if(!t[s]){if(!e[s]){var l="function"==typeof require&&require;if(!i&&l)return l(s,!0);if(a)return a(s,!0);var u=new Error("Cannot find module '"+s+"'");throw u.code="MODULE_NOT_FOUND",u}var c=t[s]={exports:{}};e[s][0].call(c.exports,function(t){var n=e[s][1][t];return r(n?n:t)},c,c.exports,o,e,t,n)}return t[s].exports}for(var a="function"==typeof require&&require,s=0;s<n.length;s++)r(n[s]);return r}({1:[function(o){var r,a,s,i,l=function(e){return e&&e.__esModule?e:{"default":e}},u=o("./modules/handle-dom"),c=o("./modules/utils"),d=o("./modules/handle-swal-dom"),f=o("./modules/handle-click"),p=o("./modules/handle-key"),m=l(p),v=o("./modules/default-params"),y=l(v),h=o("./modules/set-params"),g=l(h);s=i=function(){function o(e){var t=s;return t[e]===n?y["default"][e]:t[e]}var s=arguments[0];if(u.addClass(t.body,"stop-scrolling"),d.resetInput(),s===n)return c.logStr("SweetAlert expects at least 1 attribute!"),!1;var l=c.extend({},y["default"]);switch(typeof s){case"string":l.title=s,l.text=arguments[1]||"",l.type=arguments[2]||"";break;case"object":if(s.title===n)return c.logStr('Missing "title" argument!'),!1;l.title=s.title;for(var p in y["default"])l[p]=o(p);l.confirmButtonText=l.showCancelButton?"Confirm":y["default"].confirmButtonText,l.confirmButtonText=o("confirmButtonText"),l.doneFunction=arguments[1]||null;break;default:return c.logStr('Unexpected type of argument! Expected "string" or "object", got '+typeof s),!1}g["default"](l),d.fixVerticalPosition(),d.openModal(arguments[1]);for(var v=d.getModal(),h=v.querySelectorAll("button"),b=["onclick","onmouseover","onmouseout","onmousedown","onmouseup","onfocus"],w=function(e){return f.handleButton(e,l,v)},C=0;C<h.length;C++)for(var S=0;S<b.length;S++){var x=b[S];h[C][x]=w}d.getOverlay().onclick=w,r=e.onkeydown;var k=function(e){return m["default"](e,l,v)};e.onkeydown=k,e.onfocus=function(){setTimeout(function(){a!==n&&(a.focus(),a=n)},0)},i.enableButtons()},s.setDefaults=i.setDefaults=function(e){if(!e)throw new Error("userParams is required");if("object"!=typeof e)throw new Error("userParams has to be a object");c.extend(y["default"],e)},s.close=i.close=function(){var o=d.getModal();u.fadeOut(d.getOverlay(),5),u.fadeOut(o,5),u.removeClass(o,"showSweetAlert"),u.addClass(o,"hideSweetAlert"),u.removeClass(o,"visible");var s=o.querySelector(".sa-icon.sa-success");u.removeClass(s,"animate"),u.removeClass(s.querySelector(".sa-tip"),"animateSuccessTip"),u.removeClass(s.querySelector(".sa-long"),"animateSuccessLong");var i=o.querySelector(".sa-icon.sa-error");u.removeClass(i,"animateErrorIcon"),u.removeClass(i.querySelector(".sa-x-mark"),"animateXMark");var l=o.querySelector(".sa-icon.sa-warning");return u.removeClass(l,"pulseWarning"),u.removeClass(l.querySelector(".sa-body"),"pulseWarningIns"),u.removeClass(l.querySelector(".sa-dot"),"pulseWarningIns"),setTimeout(function(){var e=o.getAttribute("data-custom-class");u.removeClass(o,e)},300),u.removeClass(t.body,"stop-scrolling"),e.onkeydown=r,e.previousActiveElement&&e.previousActiveElement.focus(),a=n,clearTimeout(o.timeout),!0},s.showInputError=i.showInputError=function(e){var t=d.getModal(),n=t.querySelector(".sa-input-error");u.addClass(n,"show");var o=t.querySelector(".sa-error-container");u.addClass(o,"show"),o.querySelector("p").innerHTML=e,setTimeout(function(){s.enableButtons()},1),t.querySelector("input").focus()},s.resetInputError=i.resetInputError=function(e){if(e&&13===e.keyCode)return!1;var t=d.getModal(),n=t.querySelector(".sa-input-error");u.removeClass(n,"show");var o=t.querySelector(".sa-error-container");u.removeClass(o,"show")},s.disableButtons=i.disableButtons=function(){var e=d.getModal(),t=e.querySelector("button.confirm"),n=e.querySelector("button.cancel");t.disabled=!0,n.disabled=!0},s.enableButtons=i.enableButtons=function(){var e=d.getModal(),t=e.querySelector("button.confirm"),n=e.querySelector("button.cancel");t.disabled=!1,n.disabled=!1},"undefined"!=typeof e?e.sweetAlert=e.swal=s:c.logStr("SweetAlert is a frontend module!")},{"./modules/default-params":2,"./modules/handle-click":3,"./modules/handle-dom":4,"./modules/handle-key":5,"./modules/handle-swal-dom":6,"./modules/set-params":8,"./modules/utils":9}],2:[function(e,t,n){Object.defineProperty(n,"__esModule",{value:!0});var o={title:"",text:"",type:null,allowOutsideClick:!1,showConfirmButton:!0,showCancelButton:!1,closeOnConfirm:!0,closeOnCancel:!0,confirmButtonText:"OK",confirmButtonColor:"#8CD4F5",cancelButtonText:"Cancel",imageUrl:null,imageSize:null,timer:null,customClass:"",html:!1,animation:!0,allowEscapeKey:!0,inputType:"text",inputPlaceholder:"",inputValue:"",showLoaderOnConfirm:!1};n["default"]=o,t.exports=n["default"]},{}],3:[function(t,n,o){Object.defineProperty(o,"__esModule",{value:!0});var r=t("./utils"),a=(t("./handle-swal-dom"),t("./handle-dom")),s=function(t,n,o){function s(e){m&&n.confirmButtonColor&&(p.style.backgroundColor=e)}var u,c,d,f=t||e.event,p=f.target||f.srcElement,m=-1!==p.className.indexOf("confirm"),v=-1!==p.className.indexOf("sweet-overlay"),y=a.hasClass(o,"visible"),h=n.doneFunction&&"true"===o.getAttribute("data-has-done-function");switch(m&&n.confirmButtonColor&&(u=n.confirmButtonColor,c=r.colorLuminance(u,-.04),d=r.colorLuminance(u,-.14)),f.type){case"mouseover":s(c);break;case"mouseout":s(u);break;case"mousedown":s(d);break;case"mouseup":s(c);break;case"focus":var g=o.querySelector("button.confirm"),b=o.querySelector("button.cancel");m?b.style.boxShadow="none":g.style.boxShadow="none";break;case"click":var w=o===p,C=a.isDescendant(o,p);if(!w&&!C&&y&&!n.allowOutsideClick)break;m&&h&&y?i(o,n):h&&y||v?l(o,n):a.isDescendant(o,p)&&"BUTTON"===p.tagName&&sweetAlert.close()}},i=function(e,t){var n=!0;a.hasClass(e,"show-input")&&(n=e.querySelector("input").value,n||(n="")),t.doneFunction(n),t.closeOnConfirm&&sweetAlert.close(),t.showLoaderOnConfirm&&sweetAlert.disableButtons()},l=function(e,t){var n=String(t.doneFunction).replace(/\s/g,""),o="function("===n.substring(0,9)&&")"!==n.substring(9,10);o&&t.doneFunction(!1),t.closeOnCancel&&sweetAlert.close()};o["default"]={handleButton:s,handleConfirm:i,handleCancel:l},n.exports=o["default"]},{"./handle-dom":4,"./handle-swal-dom":6,"./utils":9}],4:[function(n,o,r){Object.defineProperty(r,"__esModule",{value:!0});var a=function(e,t){return new RegExp(" "+t+" ").test(" "+e.className+" ")},s=function(e,t){a(e,t)||(e.className+=" "+t)},i=function(e,t){var n=" "+e.className.replace(/[\t\r\n]/g," ")+" ";if(a(e,t)){for(;n.indexOf(" "+t+" ")>=0;)n=n.replace(" "+t+" "," ");e.className=n.replace(/^\s+|\s+$/g,"")}},l=function(e){var n=t.createElement("div");return n.appendChild(t.createTextNode(e)),n.innerHTML},u=function(e){e.style.opacity="",e.style.display="block"},c=function(e){if(e&&!e.length)return u(e);for(var t=0;t<e.length;++t)u(e[t])},d=function(e){e.style.opacity="",e.style.display="none"},f=function(e){if(e&&!e.length)return d(e);for(var t=0;t<e.length;++t)d(e[t])},p=function(e,t){for(var n=t.parentNode;null!==n;){if(n===e)return!0;n=n.parentNode}return!1},m=function(e){e.style.left="-9999px",e.style.display="block";var t,n=e.clientHeight;return t="undefined"!=typeof getComputedStyle?parseInt(getComputedStyle(e).getPropertyValue("padding-top"),10):parseInt(e.currentStyle.padding),e.style.left="",e.style.display="none","-"+parseInt((n+t)/2)+"px"},v=function(e,t){if(+e.style.opacity<1){t=t||16,e.style.opacity=0,e.style.display="block";var n=+new Date,o=function(e){function t(){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}(function(){e.style.opacity=+e.style.opacity+(new Date-n)/100,n=+new Date,+e.style.opacity<1&&setTimeout(o,t)});o()}e.style.display="block"},y=function(e,t){t=t||16,e.style.opacity=1;var n=+new Date,o=function(e){function t(){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}(function(){e.style.opacity=+e.style.opacity-(new Date-n)/100,n=+new Date,+e.style.opacity>0?setTimeout(o,t):e.style.display="none"});o()},h=function(n){if("function"==typeof MouseEvent){var o=new MouseEvent("click",{view:e,bubbles:!1,cancelable:!0});n.dispatchEvent(o)}else if(t.createEvent){var r=t.createEvent("MouseEvents");r.initEvent("click",!1,!1),n.dispatchEvent(r)}else t.createEventObject?n.fireEvent("onclick"):"function"==typeof n.onclick&&n.onclick()},g=function(t){"function"==typeof t.stopPropagation?(t.stopPropagation(),t.preventDefault()):e.event&&e.event.hasOwnProperty("cancelBubble")&&(e.event.cancelBubble=!0)};r.hasClass=a,r.addClass=s,r.removeClass=i,r.escapeHtml=l,r._show=u,r.show=c,r._hide=d,r.hide=f,r.isDescendant=p,r.getTopMargin=m,r.fadeIn=v,r.fadeOut=y,r.fireClick=h,r.stopEventPropagation=g},{}],5:[function(t,o,r){Object.defineProperty(r,"__esModule",{value:!0});var a=t("./handle-dom"),s=t("./handle-swal-dom"),i=function(t,o,r){var i=t||e.event,l=i.keyCode||i.which,u=r.querySelector("button.confirm"),c=r.querySelector("button.cancel"),d=r.querySelectorAll("button[tabindex]");if(-1!==[9,13,32,27].indexOf(l)){for(var f=i.target||i.srcElement,p=-1,m=0;m<d.length;m++)if(f===d[m]){p=m;break}9===l?(f=-1===p?u:p===d.length-1?d[0]:d[p+1],a.stopEventPropagation(i),f.focus(),o.confirmButtonColor&&s.setFocusStyle(f,o.confirmButtonColor)):13===l?("INPUT"===f.tagName&&(f=u,u.focus()),f=-1===p?u:n):27===l&&o.allowEscapeKey===!0?(f=c,a.fireClick(f,i)):f=n}};r["default"]=i,o.exports=r["default"]},{"./handle-dom":4,"./handle-swal-dom":6}],6:[function(n,o,r){var a=function(e){return e&&e.__esModule?e:{"default":e}};Object.defineProperty(r,"__esModule",{value:!0});var s=n("./utils"),i=n("./handle-dom"),l=n("./default-params"),u=a(l),c=n("./injected-html"),d=a(c),f=".sweet-alert",p=".sweet-overlay",m=function(){var e=t.createElement("div");for(e.innerHTML=d["default"];e.firstChild;)t.body.appendChild(e.firstChild)},v=function(e){function t(){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}(function(){var e=t.querySelector(f);return e||(m(),e=v()),e}),y=function(){var e=v();return e?e.querySelector("input"):void 0},h=function(){return t.querySelector(p)},g=function(e,t){var n=s.hexToRgb(t);e.style.boxShadow="0 0 2px rgba("+n+", 0.8), inset 0 0 0 1px rgba(0, 0, 0, 0.05)"},b=function(n){var o=v();i.fadeIn(h(),10),i.show(o),i.addClass(o,"showSweetAlert"),i.removeClass(o,"hideSweetAlert"),e.previousActiveElement=t.activeElement;var r=o.querySelector("button.confirm");r.focus(),setTimeout(function(){i.addClass(o,"visible")},500);var a=o.getAttribute("data-timer");if("null"!==a&&""!==a){var s=n;o.timeout=setTimeout(function(){var e=(s||null)&&"true"===o.getAttribute("data-has-done-function");e?s(null):sweetAlert.close()},a)}},w=function(){var e=v(),t=y();i.removeClass(e,"show-input"),t.value=u["default"].inputValue,t.setAttribute("type",u["default"].inputType),t.setAttribute("placeholder",u["default"].inputPlaceholder),C()},C=function(e){if(e&&13===e.keyCode)return!1;var t=v(),n=t.querySelector(".sa-input-error");i.removeClass(n,"show");var o=t.querySelector(".sa-error-container");i.removeClass(o,"show")},S=function(){var e=v();e.style.marginTop=i.getTopMargin(v())};r.sweetAlertInitialize=m,r.getModal=v,r.getOverlay=h,r.getInput=y,r.setFocusStyle=g,r.openModal=b,r.resetInput=w,r.resetInputError=C,r.fixVerticalPosition=S},{"./default-params":2,"./handle-dom":4,"./injected-html":7,"./utils":9}],7:[function(e,t,n){Object.defineProperty(n,"__esModule",{value:!0});var o='<div class="sweet-overlay" tabIndex="-1"></div><div class="sweet-alert"><div class="sa-icon sa-error">\n      <span class="sa-x-mark">\n        <span class="sa-line sa-left"></span>\n        <span class="sa-line sa-right"></span>\n      </span>\n    </div><div class="sa-icon sa-warning">\n      <span class="sa-body"></span>\n      <span class="sa-dot"></span>\n    </div><div class="sa-icon sa-info"></div><div class="sa-icon sa-success">\n      <span class="sa-line sa-tip"></span>\n      <span class="sa-line sa-long"></span>\n\n      <div class="sa-placeholder"></div>\n      <div class="sa-fix"></div>\n    </div><div class="sa-icon sa-custom"></div><h2>Title</h2>\n    <p>Text</p>\n    <fieldset>\n      <input type="text" tabIndex="3" />\n      <div class="sa-input-error"></div>\n    </fieldset><div class="sa-error-container">\n      <div class="icon">!</div>\n      <p>Not valid!</p>\n    </div><div class="sa-button-container">\n      <button class="cancel" tabIndex="2">Cancel</button>\n      <div class="sa-confirm-button-container">\n        <button class="confirm" tabIndex="1">OK</button><div class="la-ball-fall">\n          <div></div>\n          <div></div>\n          <div></div>\n        </div>\n      </div>\n    </div></div>';n["default"]=o,t.exports=n["default"]},{}],8:[function(e,t,o){Object.defineProperty(o,"__esModule",{value:!0});var r=e("./utils"),a=e("./handle-swal-dom"),s=e("./handle-dom"),i=["error","warning","info","success","input","prompt"],l=function(e){var t=a.getModal(),o=t.querySelector("h2"),l=t.querySelector("p"),u=t.querySelector("button.cancel"),c=t.querySelector("button.confirm");if(o.innerHTML=e.html?e.title:s.escapeHtml(e.title).split("\n").join("<br>"),l.innerHTML=e.html?e.text:s.escapeHtml(e.text||"").split("\n").join("<br>"),e.text&&s.show(l),e.customClass)s.addClass(t,e.customClass),t.setAttribute("data-custom-class",e.customClass);else{var d=t.getAttribute("data-custom-class");s.removeClass(t,d),t.setAttribute("data-custom-class","")}if(s.hide(t.querySelectorAll(".sa-icon")),e.type&&!r.isIE8()){var f=function(){for(var o=!1,r=0;r<i.length;r++)if(e.type===i[r]){o=!0;break}if(!o)return logStr("Unknown alert type: "+e.type),{v:!1};var l=["success","error","warning","info"],u=n;-1!==l.indexOf(e.type)&&(u=t.querySelector(".sa-icon.sa-"+e.type),s.show(u));var c=a.getInput();switch(e.type){case"success":s.addClass(u,"animate"),s.addClass(u.querySelector(".sa-tip"),"animateSuccessTip"),s.addClass(u.querySelector(".sa-long"),"animateSuccessLong");break;case"error":s.addClass(u,"animateErrorIcon"),s.addClass(u.querySelector(".sa-x-mark"),"animateXMark");break;case"warning":s.addClass(u,"pulseWarning"),s.addClass(u.querySelector(".sa-body"),"pulseWarningIns"),s.addClass(u.querySelector(".sa-dot"),"pulseWarningIns");break;case"input":case"prompt":c.setAttribute("type",e.inputType),c.value=e.inputValue,c.setAttribute("placeholder",e.inputPlaceholder),s.addClass(t,"show-input"),setTimeout(function(){c.focus(),c.addEventListener("keyup",swal.resetInputError)},400)}}();if("object"==typeof f)return f.v}if(e.imageUrl){var p=t.querySelector(".sa-icon.sa-custom");p.style.backgroundImage="url("+e.imageUrl+")",s.show(p);var m=80,v=80;if(e.imageSize){var y=e.imageSize.toString().split("x"),h=y[0],g=y[1];h&&g?(m=h,v=g):logStr("Parameter imageSize expects value with format WIDTHxHEIGHT, got "+e.imageSize)}p.setAttribute("style",p.getAttribute("style")+"width:"+m+"px; height:"+v+"px")}t.setAttribute("data-has-cancel-button",e.showCancelButton),e.showCancelButton?u.style.display="inline-block":s.hide(u),t.setAttribute("data-has-confirm-button",e.showConfirmButton),e.showConfirmButton?c.style.display="inline-block":s.hide(c),e.cancelButtonText&&(u.innerHTML=s.escapeHtml(e.cancelButtonText)),e.confirmButtonText&&(c.innerHTML=s.escapeHtml(e.confirmButtonText)),e.confirmButtonColor&&(c.style.backgroundColor=e.confirmButtonColor,c.style.borderLeftColor=e.confirmLoadingButtonColor,c.style.borderRightColor=e.confirmLoadingButtonColor,a.setFocusStyle(c,e.confirmButtonColor)),t.setAttribute("data-allow-outside-click",e.allowOutsideClick);var b=e.doneFunction?!0:!1;t.setAttribute("data-has-done-function",b),e.animation?"string"==typeof e.animation?t.setAttribute("data-animation",e.animation):t.setAttribute("data-animation","pop"):t.setAttribute("data-animation","none"),t.setAttribute("data-timer",e.timer)};o["default"]=l,t.exports=o["default"]},{"./handle-dom":4,"./handle-swal-dom":6,"./utils":9}],9:[function(t,n,o){Object.defineProperty(o,"__esModule",{value:!0});var r=function(e,t){for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n]);return e},a=function(e){var t=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(e);return t?parseInt(t[1],16)+", "+parseInt(t[2],16)+", "+parseInt(t[3],16):null},s=function(){return e.attachEvent&&!e.addEventListener},i=function(t){e.console&&e.console.log("SweetAlert: "+t)},l=function(e,t){e=String(e).replace(/[^0-9a-f]/gi,""),e.length<6&&(e=e[0]+e[0]+e[1]+e[1]+e[2]+e[2]),t=t||0;var n,o,r="#";for(o=0;3>o;o++)n=parseInt(e.substr(2*o,2),16),n=Math.round(Math.min(Math.max(0,n+n*t),255)).toString(16),r+=("00"+n).substr(n.length);return r};o.extend=r,o.hexToRgb=a,o.isIE8=s,o.logStr=i,o.colorLuminance=l},{}]},{},[1]),"function"==typeof define&&define.amd?define(function(){return sweetAlert}):"undefined"!=typeof module&&module.exports&&(module.exports=sweetAlert)}(window,document),"undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(e){"use strict";var t=e.fn.jquery.split(" ")[0].split(".");if(t[0]<2&&t[1]<9||1==t[0]&&9==t[1]&&t[2]<1)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher")}(jQuery),+function(e){"use strict";function t(t){var n=t.attr("data-target");n||(n=t.attr("href"),n=n&&/#[A-Za-z]/.test(n)&&n.replace(/.*(?=#[^\s]*$)/,""));var o=n&&e(n);return o&&o.length?o:t.parent()}function n(n){n&&3===n.which||(e(r).remove(),e(a).each(function(){var o=e(this),r=t(o),a={relatedTarget:this};r.hasClass("open")&&(n&&"click"==n.type&&/input|textarea/i.test(n.target.tagName)&&e.contains(r[0],n.target)||(r.trigger(n=e.Event("hide.bs.dropdown",a)),n.isDefaultPrevented()||(o.attr("aria-expanded","false"),r.removeClass("open").trigger("hidden.bs.dropdown",a))))}))}function o(t){return this.each(function(){var n=e(this),o=n.data("bs.dropdown");o||n.data("bs.dropdown",o=new s(this)),"string"==typeof t&&o[t].call(n)})}var r=".dropdown-backdrop",a='[data-toggle="dropdown"]',s=function(t){e(t).on("click.bs.dropdown",this.toggle)};s.VERSION="3.3.5",s.prototype.toggle=function(o){var r=e(this);if(!r.is(".disabled, :disabled")){var a=t(r),s=a.hasClass("open");if(n(),!s){"ontouchstart"in document.documentElement&&!a.closest(".navbar-nav").length&&e(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(e(this)).on("click",n);var i={relatedTarget:this};if(a.trigger(o=e.Event("show.bs.dropdown",i)),o.isDefaultPrevented())return;r.trigger("focus").attr("aria-expanded","true"),a.toggleClass("open").trigger("shown.bs.dropdown",i)}return!1}},s.prototype.keydown=function(n){if(/(38|40|27|32)/.test(n.which)&&!/input|textarea/i.test(n.target.tagName)){var o=e(this);if(n.preventDefault(),n.stopPropagation(),!o.is(".disabled, :disabled")){var r=t(o),s=r.hasClass("open");if(!s&&27!=n.which||s&&27==n.which)return 27==n.which&&r.find(a).trigger("focus"),o.trigger("click");var i=" li:not(.disabled):visible a",l=r.find(".dropdown-menu"+i);if(l.length){var u=l.index(n.target);38==n.which&&u>0&&u--,40==n.which&&u<l.length-1&&u++,~u||(u=0),l.eq(u).trigger("focus")}}}};var i=e.fn.dropdown;e.fn.dropdown=o,e.fn.dropdown.Constructor=s,e.fn.dropdown.noConflict=function(){return e.fn.dropdown=i,this},e(document).on("click.bs.dropdown.data-api",n).on("click.bs.dropdown.data-api",".dropdown form",function(e){e.stopPropagation()}).on("click.bs.dropdown.data-api",a,s.prototype.toggle).on("keydown.bs.dropdown.data-api",a,s.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",s.prototype.keydown)}(jQuery);
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

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
       this.$http.post('http://'+pathname+'/articles/'+id+'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count);
       $('#'+'b'+id).text(vote_count);});
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
       this.$http.post('http://'+pathname+'/replies/'+id+'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count);
       $('#'+'b'+id).text(vote_count);});
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

//展开
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
    var stickyTop = $('.sticky').offset().top; // returns number 
    $(window).scroll(function(){ // scroll event
      var windowTop = $(window).scrollTop();
       // returns number 
    var currentwidth = $('.side-bar').width();
      if (stickyTop < windowTop){
        $('.sticky').css({ position: 'fixed', top: 40 ,width : currentwidth});
      }
      else {
        $('.sticky').css('position','static');
      }
    });
  }
});
      



