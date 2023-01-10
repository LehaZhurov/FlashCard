function M(r,e,t=null,l=!0){return new Promise((d,p)=>{const i=new XMLHttpRequest;i.open(r,e,!0),i.responseType="json",i.withCredentials=!0,i.setRequestHeader("X-CSRF-TOKEN",document.head.querySelector("[name=csrf-token]").content),i.readyState==1&&l&&console.log("\u041E\u0442\u043F\u0440\u0430\u0432\u043A\u0430 \u0437\u0430\u043F\u0440\u043E\u0441\u0430 "+r+" \u0437\u0430\u043F\u0440\u043E\u0441\u0430 \u043D\u0430 "+e),i.onload=()=>{i.status>=400?p(i.response):d(i.response)},i.onerror=()=>{p(i.response)},i.send(t)})}var K=function(){return function(r,e){var t=document.querySelector(r),l=t.querySelector(".slider__items"),d=t.querySelectorAll(".slider__item"),p=t.querySelectorAll(".slider__control"),i=0,x=0,k=100,o=[],E,I,u=0,L=d.length-1,w=50,m={isAutoplay:!0,directionAutoplay:"next",delayAutoplay:2e3,isPauseOnHover:!0};for(var q in e)q in m&&(m[q]=e[q]);for(var A=0,D=d.length;A<D;A++)o.push({item:d[A],position:A,transform:0});var _={getItemIndex:function(s){for(var n=0,c=0,a=o.length;c<a;c++)(o[c].position<o[n].position&&s==="min"||o[c].position>o[n].position&&s==="max")&&(n=c);return n},getItemPosition:function(s){return o[_.getItemIndex(s)].position}},g=function(s){var n,c=u;s==="next"?(i++,i>_.getItemPosition("max")&&(n=_.getItemIndex("min"),o[n].position=_.getItemPosition("max")+1,o[n].transform+=o.length*100,o[n].item.style.transform="translateX("+o[n].transform+"%)"),x-=k,u=u+1,u>L&&(u=0)):(i--,i<_.getItemPosition("min")&&(n=_.getItemIndex("max"),o[n].position=_.getItemPosition("min")-1,o[n].transform-=o.length*100,o[n].item.style.transform="translateX("+o[n].transform+"%)"),x+=k,u=u-1,u<0&&(u=L)),l.style.transform="translateX("+x+"%)",I[c].classList.remove("active"),I[u].classList.add("active")},G=function(s){for(var n=0,c=s>u?"next":"prev";s!==u&&n<=L;)g(c),n++},v=function(){!m.isAutoplay||(T(),E=setInterval(function(){g(m.directionAutoplay)},m.delayAutoplay))},T=function(){clearInterval(E)},R=function(){var s=document.createElement("ol");s.classList.add("slider__indicators");for(var n=0,c=d.length;n<c;n++){var a=document.createElement("li");a.innerHTML=n,n===0&&a.classList.add("active"),a.setAttribute("data-slide-to",n),s.appendChild(a)}t.appendChild(s),I=t.querySelectorAll(".slider__indicators > li")},B=function(){return!!("ontouchstart"in window||navigator.maxTouchPoints)},W=function(){var s=0;if(B())t.addEventListener("touchstart",function(a){s=a.changedTouches[0].clientX,v()}),t.addEventListener("touchend",function(a){var F=a.changedTouches[0].clientX,H=F-s;H>w?g("prev"):H<-w&&g("next"),v()});else for(var n=0,c=p.length;n<c;n++)p[n].classList.add("slider__control_show");t.addEventListener("click",function(a){a.target.classList.contains("slider__control")?(a.preventDefault(),g(a.target.classList.contains("slider__control_next")?"next":"prev"),v()):a.target.getAttribute("data-slide-to")&&(a.preventDefault(),G(parseInt(a.target.getAttribute("data-slide-to"))),v())}),document.addEventListener("visibilitychange",function(){document.visibilityState==="hidden"?T():v()},!1),m.isPauseOnHover&&m.isAutoplay&&(t.addEventListener("mouseenter",function(){T()}),t.addEventListener("mouseleave",function(){v()}))};return R(),W(),v(),{next:function(){g("next")},left:function(){g("prev")},stop:function(){m.isAutoplay=!1,T()},cycle:function(){m.isAutoplay=!0,v()}}}}();let f=[],P=document.querySelector("#stepOneDisplay"),S=document.querySelector("#stepTooDisplay"),X=document.querySelector("#stepThreeDisplay"),y=document.querySelector("#word"),b=document.querySelector("#btn-step-one");b.onclick=()=>{N()};let h=5;function C(){if(!y.hasAttribute("disabled")){b.innerText="\u0414\u0430\u043B\u0435\u0435",b.setAttribute("style","background:var(--secondary-dark)");return}if(h==95)return h=10,C();b.innerText="\u0418\u0449\u0435\u043C \u0433\u0438\u0444\u043A\u0438 \u0438 \u043F\u0435\u0440\u0435\u0432\u043E\u0434",setTimeout(()=>{b.setAttribute("style",`background:linear-gradient(110deg, var(--secondary-dark) 0%, 
        var(--secondary-dark) `+(h-5)+"%, rgba(239,239,242,1) "+h+"%, var(--secondary-dark) "+(h+5)+`%, 
        var(--secondary-dark) 100%);`),C()},10),h++}async function N(){if(!y.value)return!1;y.setAttribute("disabled",!0),f.word=y.value,j(),await U(y.value),await V(y.value),P.style.display="none",S.style.display="block",y.removeAttribute("disabled"),K(".slider",{isAutoplay:!1})}async function U(r){C(),await M("GET","/translation/"+r).then(e=>{f.data=e,console.log(f)}).catch(e=>{console.log(e)})}async function V(r){await M("GET","/gif/search/"+r).then(e=>{z(e.data),f.gifs=e.data}).catch(e=>{O(),console.log(e)})}function j(){let r=document.querySelector("#slider-block");r.innerHTML=" ";let e=document.createElement("div");e.setAttribute("class","slider");let t=document.createElement("div");t.setAttribute("class","slider__wrapper");let l=document.createElement("div");l.setAttribute("class","slider__items"),l.setAttribute("id","select-gif");let d=document.createElement("a");d.setAttribute("class","slider__control slider__control_prev"),d.setAttribute("href","#"),d.setAttribute("role","button"),d.innerHTML="<";let p=document.createElement("a");return p.setAttribute("class","slider__control slider__control_next"),p.setAttribute("href","#"),p.setAttribute("role","button"),p.innerHTML=">",e.appendChild(t),t.appendChild(l),t.appendChild(d),t.appendChild(p),r.appendChild(e),!0}function z(r){let e=document.querySelector("#select-gif");e.innerHTML=" ";for(let t=0;t<r.length;t++)e.appendChild(J(r[t].src))}function J(r){let e=document.createElement("div");e.setAttribute("class","slider__item");let t=document.createElement("div");t.setAttribute("class","slider-gif");let l=document.createElement("img");return l.src=r,e.appendChild(t),t.appendChild(l),e}document.querySelector("#btn-step-one-prev").onclick=()=>{O()};function O(){P.style.display="block",y.value="",S.style.display="none"}document.querySelector("#btn-step-too").onclick=()=>{Q()};function Q(){let r=document.querySelector("ol>li.active").innerHTML;f.src=f.gifs[r].src,Y(),S.style.display="none",X.style.display="block"}function Y(){let r=document.querySelector("#creatingCardWord");r.innerHTML=" ",r.innerHTML=f.word;let e=document.querySelector("#creatingCardTranslate");e.innerHTML=" ";for(let l=0;l<f.data.translate.length-1;l++)e.innerHTML+=" "+f.data.translate[l];let t=document.querySelector("#creatingCardImg");t.src=f.src}document.querySelector("#btn-step-too-prev").onclick=()=>{Z()};function Z(){S.style.display="block",X.style.display="none"}
