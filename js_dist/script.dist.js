!function e(t,n,o){function r(a,s){if(!n[a]){if(!t[a]){var l="function"==typeof require&&require;if(!s&&l)return l(a,!0);if(i)return i(a,!0);var d=new Error("Cannot find module '"+a+"'");throw d.code="MODULE_NOT_FOUND",d}var c=n[a]={exports:{}};t[a][0].call(c.exports,function(e){var n=t[a][1][e];return r(n?n:e)},c,c.exports,e,t,n,o)}return n[a].exports}for(var i="function"==typeof require&&require,a=0;a<o.length;a++)r(o[a]);return r}({1:[function(e){!function(){function t(){var t=document.getElementById("registerForm"),n=document.getElementById("loginForm"),o=e("./classes/validatie.js");t&&(console.log("Register page"),n=0,new o(n,t)),n&&(console.log("Login page"),t=0,new o(n,t));var r=document.getElementById("dikkePlus");if(r){var i=e("./classes/Addproject.js");r.onclick=function(){event.preventDefault(),new i};var a=e("./classes/projectIndex.js");new a}var s=document.getElementById("whiteboard");if(s){var l=e("./classes/Viewfunctions.js");new l;var d=e("./classes/img.js");new d;var c=e("./classes/video.js"),u=document.getElementById("videoSubmit");u&&(u.onclick=function(){window.File&&window.FileReader&&window.FileList&&window.Blob&&new c});var p=e("./classes/stickyNote.js"),m=document.getElementById("addStickyNote");m&&(m.onclick=function(e){e.preventDefault(),new p});var f=e("./classes/todo.js"),v=document.getElementById("addTodo");v&&(v.onclick=function(){new f})}}function n(){$(document).ready(function(){$(".addBtn").click(function(){event.preventDefault(),$(".whiteboard").toggleClass("moveWBoard"),$(".addObjectUl").toggleClass("hide")})})}t(),n()}()},{"./classes/Addproject.js":2,"./classes/Viewfunctions.js":3,"./classes/img.js":4,"./classes/projectIndex.js":5,"./classes/stickyNote.js":6,"./classes/todo.js":7,"./classes/validatie.js":8,"./classes/video.js":9}],2:[function(e,t){t.exports=function(){function t(){$.post("index.php?page=addProject",{name:"Klik om aan te passen",description:"Klik om aan te passen, druk op enter ter bevestiging"}).done(function(e){if(e.result){var t=[e.projects_last];$.get("index.php?page=addProject",function(){var e=Handlebars.compile($("#project-template").html()),n=e(t);$(".projectList").append(n)});var o=$(".projectItem");$(o[o.length-1]).css("background-color",n())}})}function n(){for(var e="0123456789ABCD".split(""),t="#",n=0;6>n;n++)t+=e[Math.round(13*Math.random())];return t}e("./projectIndex.js");return t}()},{"./projectIndex.js":5}],3:[function(e,t){t.exports=function(){function e(){var e=document.URL,n=e.split("=");a=n[2],t()}function t(){$.get("index.php?page=whiteboard&id="+a,function(e){var t=e.todos,o=Handlebars.compile($("#todo-template").html()),i=o(t);$(".whiteboard").append(i);var a=e.stickyNotes,d=Handlebars.compile($("#stickyNote-template").html()),c=d(a);$(".whiteboard").append(c),r(),s=e.imges;var u=Handlebars.compile($("#img-template").html()),p=u(e.imges);$(".whiteboard").append(p),l=e.videos;var m=Handlebars.compile($("#video-template").html()),f=m(e.videos);$(".whiteboard").append(f),n()})}function n(){for(var e,t,n=document.querySelectorAll(".img-object"),r=0;r<n.length;r++)e=s[r].xPos,t=s[r].yPos;o(n,e,t);for(var i,a,d=document.querySelectorAll(".video-object"),c=0;c<n.length;c++)i=l[c].xPos,a=l[c].yPos;o(d,i,a)}function o(e,t,n){for(var o=0;o<e.length;o++){element=e[o],console.log(element.getAttribute("alt"));var r=t[o],i=n[o];element.style.top=r+"px",element.style.left=i+"px",element.addEventListener("mousedown",mouseDownHandler)}}function r(){for(var e=$(".stickyNote_content"),t=document.querySelectorAll(".deleteStickyNote"),n=0;n<e.length;n++){stickynote=e[n],stickynote_link=t[n];var o=stickynote_link.getAttribute("href"),r=o.split("="),a=r[2];stickynote.contentEditable=!0,i(stickynote,a)}}function i(e,t){e.addEventListener("keydown",function(n){if(13===n.keyCode){n.preventDefault();var o=e.innerText,r={text:o,id_stickynote:t};$.post("index.php?page=UpdateFunctie",r),e.blur()}})}var a,s,l,d=0;return mouseDownHandler=function(e){element.offsetX=e.offsetX,element.offsetY=e.offsetY,window.addEventListener("mousemove",mouseMoveHandler),window.addEventListener("mouseup",mouseUpHandler),d++,element.style.zIndex=d},mouseMoveHandler=function(e){if(element.style.left=e.x-element.offsetX+"px",element.style.top=e.y-element.offsetY+"px","video-object"===element.className){var t={className:element.className,xPos:element.style.left,yPos:element.style.top};$.post("index.php?page=whiteboard&id="+a,t).done(function(e){console.log(e.dataPost)})}},mouseUpHandler=function(){window.removeEventListener("mousemove",mouseMoveHandler),window.removeEventListener("mouseup",mouseUpHandler)},e}()},{}],4:[function(e,t){t.exports=function(){function e(){}return e}()},{}],5:[function(e,t){t.exports=function(){function e(){$.get("index.php?page=projects",function(e){var n=e.projects,o=Handlebars.compile($("#project-template").html()),r=o(n);$(".projectList").append(r),t()})}function t(){for(var e=document.querySelectorAll(".title"),t=document.querySelectorAll(".link"),c=document.querySelectorAll(".description"),u=document.querySelectorAll(".deleteProject"),p=0;p<e.length;p++){a=e[p],l=t[p],s=c[p],d=u[p],a.contentEditable=!0,s.contentEditable=!0;var m=l.getAttribute("href"),f=m.split("="),v=f[2];o(a,v),r(s,v),i(d,v)}$(".projectItem").each(function(){$(this).css("background-color",n())})}function n(){for(var e="0123456789ABCD".split(""),t="#",n=0;6>n;n++)t+=e[Math.round(13*Math.random())];return t}function o(e,t){e.addEventListener("keydown",function(n){if(13===n.keyCode){n.preventDefault();{var o=e.innerText,r={name:o,id:t};$.post("index.php?page=projects",r)}e.blur()}})}function r(e,t){e.addEventListener("keydown",function(n){if(13===n.keyCode){n.preventDefault();{var o=e.innerText,r={description:o,id:t};$.post("index.php?page=projects",r)}e.blur()}})}function i(e,t){e.addEventListener("click",function(e){e.preventDefault();var n={action:"delete",id_project:t},o=$.post("index.php?page=deleteProject",n);o.done(function(){{var e=document.querySelector(".projectList");e.querySelectorAll(".projectItem")}})})}var a,s,l,d;return e}()},{}],6:[function(e,t){t.exports=function(){function e(){var e=document.URL,t=e.split("="),n=t[2],o={text:"Klik om de tekst aan te passen",id:n},r=$.post("index.php?page=addNote",o);r.done(function(e){if(e.result){var t=[e.stickyNote_last];$.get("index.php?page=addNote",function(){var e=Handlebars.compile($("#stickyNote-template").html()),n=e(t);$(".whiteboard").append(n)})}})}return e}()},{}],7:[function(e,t){t.exports=function(){function e(){var e=document.URL,t=e.split("="),n=t[2],o={project_id:n},r=$.post("index.php?page=addTodo",o);r.done(function(e){if(e.result){var t=[e.todo_last];$.get("index.php?page=addTodo",function(){var e=Handlebars.compile($("#todo-template").html()),n=e(t);$(".whiteboard").append(n)})}})}return e}()},{}],8:[function(e,t){t.exports=function(){function e(e,o){0!==e&&t(e),0!==o&&n(o)}function t(){console.log("[Login validatie]"),l=this.loginForm;var e=l.querySelector("input[name=email]"),t=l.querySelector("input[name=password]");l.addEventListener("submit",i),e.addEventListener("blur",o),t.addEventListener("blur",o)}function n(){if(console.log("[Registratie validatie]"),window.File&&window.FileReader&&window.FileList&&window.Blob){var e=document.querySelector("input[name=image_register]"),t=e.parentNode.querySelector(".error-message");e.addEventListener("change",function(){t.style.display="none";var n=e.parentNode.querySelector("img");if(n&&e.parentNode.removeChild(n),e.files.length>0){var o=e.files[0];if(0!==o.type.search("image"))t.innerText="the selected file is not an image",t.style.display="block";else{var r=new FileReader;r.onload=function(){var t=document.createElement("img");t.onload=function(){e.parentNode.appendChild(t)},t.setAttribute("src",r.result),t.setAttribute("width","300")},r.readAsDataURL(o)}}})}s=this.registerForm;var n=s.querySelector("input[name=vn]"),o=s.querySelector("input[name=an]"),a=s.querySelector("input[name=nickname]"),l=s.querySelector("input[name=email]"),d=s.querySelector("input[name=password]"),c=s.querySelector("input[name=repassword]"),u=s.querySelector("input[name=job]");s.addEventListener("submit",i),n.addEventListener("blur",r),o.addEventListener("blur",r),a.addEventListener("blur",r),l.addEventListener("blur",r),d.addEventListener("blur",r),c.addEventListener("blur",r),u.addEventListener("blur",r)}function o(){a(l,this)}function r(){a(s,this)}function i(e){var t=!0;t&=a(voornaamInput),t&=a(achternaamInput),t&=a(nicknameInput),t&=a(emailInput),t&=a(passInput),t&=a(pass2Input),t&=a(jobInput),t||e.preventDefault()}function a(e,t){var n=e.querySelector("[data-for="+t.getAttribute("name")+"]");return t.value.length>0?(n.classList.add("hidden"),!0):(n.classList.remove("hidden"),!1)}var s,l;return e}()},{}],9:[function(e,t){t.exports=function(){function e(){console.log("[video] Hello video Jil")}return e}()},{}]},{},[1]);
//# sourceMappingURL=script.dist.js.map