!function e(t,n,o){function s(r,d){if(!n[r]){if(!t[r]){var a="function"==typeof require&&require;if(!d&&a)return a(r,!0);if(i)return i(r,!0);var l=new Error("Cannot find module '"+r+"'");throw l.code="MODULE_NOT_FOUND",l}var u=n[r]={exports:{}};t[r][0].call(u.exports,function(e){var n=t[r][1][e];return s(n?n:e)},u,u.exports,e,t,n,o)}return n[r].exports}for(var i="function"==typeof require&&require,r=0;r<o.length;r++)s(o[r]);return s}({1:[function(e){!function(){function t(){var t=document.getElementById("registerForm"),n=document.getElementById("loginForm"),r=e("./classes/validatie.js");t&&(console.log("Register page"),n=0,new r(n,t)),n&&(console.log("Login page"),t=0,new r(n,t));var d=e("./classes/projectIndex.js");new d;var a=document.getElementById("dikkePlus");if(a){var l=e("./classes/Addproject.js");a.onclick=function(){event.preventDefault(),new l}}var u=e("./classes/img.js"),c=document.getElementById("addImage");c&&(c.onclick=function(e){e.preventDefault(),o(),new u});var m=e("./classes/video.js"),p=document.getElementById("addVideo");p&&(p.onclick=function(e){e.preventDefault(),s(),new m});var f=e("./classes/stickyNote.js"),v=document.getElementById("addStickyNote");v&&(v.onclick=function(e){e.preventDefault(),new f});var h=e("./classes/todo.js"),w=document.getElementById("addTodo");w&&(w.onclick=function(e){e.preventDefault(),new h});var y=e("./classes/draw.js"),g=document.getElementById("draw");g&&(g.onclick=function(e){e.preventDefault(),new y}),$(document).ready(function(){$(".projectItem").each(function(){$(this).css("background-color",i())})})}function n(){$(document).ready(function(){$(".addBtn").click(function(){event.preventDefault(),$(".whiteboard").toggleClass("moveWBoard")})})}function o(){$("#imageInput").click()}function s(){$("#videoInput").click()}function i(){for(var e="0123456789ABCDEF".split(""),t="#",n=0;6>n;n++)t+=e[Math.round(15*Math.random())];return t}t(),n()}()},{"./classes/Addproject.js":2,"./classes/draw.js":3,"./classes/img.js":4,"./classes/projectIndex.js":5,"./classes/stickyNote.js":6,"./classes/todo.js":7,"./classes/validatie.js":8,"./classes/video.js":9}],2:[function(e,t){t.exports=function(){function e(){$.post("index.php?page=addProject",{name:"Klik om aan te passen",description:"Klik om aan te passen, druk op enter ter bevestiging"}).done(function(e){if(e.result){var t=[e.projects_last];$.get("index.php?page=addProject",function(){var e=Handlebars.compile($("#project-template").html()),n=e(t);$(".projectList").append(n)})}})}return e}()},{}],3:[function(e,t){t.exports=function(){function e(){console.log("[Draw] Hello Jil")}return e}()},{}],4:[function(e,t){t.exports=function(){function e(){this.el=document.createElement("img");var e=document.getElementById("whiteboard");e.appendChild(this.el),this._mouseDownHandler=this.mouseDownHandler.bind(this),this._mouseMoveHandler=this.mouseMoveHandler.bind(this),this._mouseUpHandler=this.mouseUpHandler.bind(this),this.el.addEventListener("mousedown",this._mouseDownHandler)}var t=0;return e.prototype.mouseDownHandler=function(e){this.offsetX=e.offsetX,this.offsetY=e.offsetY,window.addEventListener("mousemove",this._mouseMoveHandler),window.addEventListener("mouseup",this._mouseUpHandler),t++,this.el.style.zIndex=t},e.prototype.mouseMoveHandler=function(e){this.el.style.left=e.x-this.offsetX+"px",this.el.style.top=e.y-this.offsetY+"px"},e.prototype.mouseUpHandler=function(){window.removeEventListener("mousemove",this._mouseMoveHandler),window.removeEventListener("mouseup",this._mouseUpHandler)},e}()},{}],5:[function(e,t){t.exports=function(){function e(){$.get("index.php?page=projects",function(e){var r=e.projects,d=Handlebars.compile($("#project-template").html()),a=d(r);$(".projectList").append(a);for(var l=document.querySelectorAll(".title"),u=document.querySelectorAll(".link"),c=document.querySelectorAll(".description"),m=0;m<l.length;m++){o=l[m],i=u[m],s=c[m],o.contentEditable=!0,s.contentEditable=!0;var p=i.getAttribute("href"),f=p.substring(29,35);t(o,f),n(s,f)}})}function t(e,t){e.addEventListener("keydown",function(n){if(13===n.keyCode){n.preventDefault();{var o=e.innerText,s={name:o,id:t};$.post("index.php?page=projects",s)}}})}function n(e,t){e.addEventListener("keydown",function(n){if(13===n.keyCode){n.preventDefault();{var o=e.innerText,s={description:o,id:t};$.post("index.php?page=projects",s)}}})}var o,s,i;return e}()},{}],6:[function(e,t){t.exports=function(){function e(){console.log("[stickyNote] Hello sticky Jil"),this.el=document.createElement("div"),this.el.classList.add("postIt_vervangenDoorCirkel");var e=document.getElementById("whiteboard");e.appendChild(this.el),this._mouseDownHandler=this.mouseDownHandler.bind(this),this._mouseMoveHandler=this.mouseMoveHandler.bind(this),this._mouseUpHandler=this.mouseUpHandler.bind(this),this.el.addEventListener("mousedown",this._mouseDownHandler)}var t=0;return e.prototype.mouseDownHandler=function(e){this.offsetX=e.offsetX,this.offsetY=e.offsetY,window.addEventListener("mousemove",this._mouseMoveHandler),window.addEventListener("mouseup",this._mouseUpHandler),t++,this.el.style.zIndex=t},e.prototype.mouseMoveHandler=function(e){this.el.style.left=e.x-this.offsetX+"px",this.el.style.top=e.y-this.offsetY+"px"},e.prototype.mouseUpHandler=function(){window.removeEventListener("mousemove",this._mouseMoveHandler),window.removeEventListener("mouseup",this._mouseUpHandler)},e}()},{}],7:[function(e,t){t.exports=function(){function e(){console.log("[Todo] Hello Jil"),this.el=document.createElement("div"),this.el.classList.add("todo_vervangenDoorCirkel");var e=document.getElementById("whiteboard");e.appendChild(this.el),this._mouseDownHandler=this.mouseDownHandler.bind(this),this._mouseMoveHandler=this.mouseMoveHandler.bind(this),this._mouseUpHandler=this.mouseUpHandler.bind(this),this.el.addEventListener("mousedown",this._mouseDownHandler)}var t=0;return e.prototype.mouseDownHandler=function(e){this.offsetX=e.offsetX,this.offsetY=e.offsetY,window.addEventListener("mousemove",this._mouseMoveHandler),window.addEventListener("mouseup",this._mouseUpHandler),t++,this.el.style.zIndex=t},e.prototype.mouseMoveHandler=function(e){this.el.style.left=e.x-this.offsetX+"px",this.el.style.top=e.y-this.offsetY+"px"},e.prototype.mouseUpHandler=function(){window.removeEventListener("mousemove",this._mouseMoveHandler),window.removeEventListener("mouseup",this._mouseUpHandler)},e}()},{}],8:[function(e,t){t.exports=function(){function e(e,o){0!==e&&t(e),0!==o&&n(o)}function t(){console.log("[Login validatie]"),a=this.loginForm;var e=a.querySelector("input[name=email]"),t=a.querySelector("input[name=password]");a.addEventListener("submit",i),e.addEventListener("blur",o),t.addEventListener("blur",o)}function n(){if(console.log("[Registratie validatie]"),window.File&&window.FileReader&&window.FileList&&window.Blob){var e=document.querySelector("input[name=image]"),t=e.parentNode.querySelector(".error-message");e.addEventListener("change",function(){t.style.display="none";var n=e.parentNode.querySelector("img");if(n&&e.parentNode.removeChild(n),e.files.length>0){var o=e.files[0];if(0!==o.type.search("image"))t.innerText="the selected file is not an image",t.style.display="block";else{var s=new FileReader;s.onload=function(){var t=document.createElement("img");t.onload=function(){e.parentNode.appendChild(t)},t.setAttribute("src",s.result),t.setAttribute("width","300")},s.readAsDataURL(o)}}})}d=this.registerForm;var n=d.querySelector("input[name=vn]"),o=d.querySelector("input[name=an]"),r=d.querySelector("input[name=nickname]"),a=d.querySelector("input[name=email]"),l=d.querySelector("input[name=password]"),u=d.querySelector("input[name=repassword]"),c=d.querySelector("input[name=job]");d.addEventListener("submit",i),n.addEventListener("blur",s),o.addEventListener("blur",s),r.addEventListener("blur",s),a.addEventListener("blur",s),l.addEventListener("blur",s),u.addEventListener("blur",s),c.addEventListener("blur",s)}function o(){r(a,this)}function s(){r(d,this)}function i(e){var t=!0;t&=r(voornaamInput),t&=r(achternaamInput),t&=r(nicknameInput),t&=r(emailInput),t&=r(passInput),t&=r(pass2Input),t&=r(jobInput),t||e.preventDefault()}function r(e,t){var n=e.querySelector("[data-for="+t.getAttribute("name")+"]");return t.value.length>0?(n.classList.add("hidden"),!0):(n.classList.remove("hidden"),!1)}var d,a;return e}()},{}],9:[function(e,t){t.exports=function(){function e(){console.log("[video] Hello video Jil"),this.el=document.createElement("div"),this.el.classList.add("video_vervangenDoorCirkel");var e=document.getElementById("whiteboard");e.appendChild(this.el),this._mouseDownHandler=this.mouseDownHandler.bind(this),this._mouseMoveHandler=this.mouseMoveHandler.bind(this),this._mouseUpHandler=this.mouseUpHandler.bind(this),this.el.addEventListener("mousedown",this._mouseDownHandler)}var t=0;return e.prototype.mouseDownHandler=function(e){this.offsetX=e.offsetX,this.offsetY=e.offsetY,window.addEventListener("mousemove",this._mouseMoveHandler),window.addEventListener("mouseup",this._mouseUpHandler),t++,this.el.style.zIndex=t},e.prototype.mouseMoveHandler=function(e){this.el.style.left=e.x-this.offsetX+"px",this.el.style.top=e.y-this.offsetY+"px"},e.prototype.mouseUpHandler=function(){window.removeEventListener("mousemove",this._mouseMoveHandler),window.removeEventListener("mouseup",this._mouseUpHandler)},e}()},{}]},{},[1]);
//# sourceMappingURL=script.dist.js.map