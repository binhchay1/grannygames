/** Game resizing */
function myarcadeDomReady(e){if("function"==typeof e)return"interactive"===document.readyState||"complete"===document.readyState?e():void document.addEventListener("DOMContentLoaded",e,!1)}var myarcade=myarcade||{};myarcade.intrinsicRatioGames={init:function(){this.makeFit(),window.addEventListener("resize",function(){this.makeFit()}.bind(this))},makeFit:function(){element_list=document.querySelectorAll("#playframe"),element_list.length||(element_list=document.querySelectorAll("#play_game iframe")),element_list.forEach(function(e){var t,i,a,n=e.parentNode,d=window.innerHeight-50,r=n.offsetWidth;e.dataset.origwidth||(e.setAttribute("data-origwidth",e.width),e.setAttribute("data-origheight",e.height)),t=e.dataset.origwidth/e.dataset.origheight,parseInt(e.dataset.origheight)>parseInt(e.dataset.origwidth)?(i=d,a=d*t,a>r&&(i=r/t,a=r)):(a=r,i=a/t,i>d&&(i=d,a=i*t)),e.style.width=a+"px",e.style.height=i+"px"})}},myarcadeDomReady(function(){myarcade.intrinsicRatioGames.init()});