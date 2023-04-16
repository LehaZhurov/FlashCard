import{S as T,c as X,s as V,b as D,u as $,g as j}from"./getCardCollection.0cbd83d5.js";var z=function(){return function(t,e){var n=document.querySelector(t),a=n.querySelector(".slider__items"),s=n.querySelectorAll(".slider__item"),c=n.querySelectorAll(".slider__control"),y=0,w=0,P=100,i=[],H,I,u=0,k=s.length-1,M=50,f={isAutoplay:!0,directionAutoplay:"next",delayAutoplay:2e3,isPauseOnHover:!0};for(var q in e)q in f&&(f[q]=e[q]);for(var S=0,B=s.length;S<B;S++)i.push({item:s[S],position:S,transform:0});var v={getItemIndex:function(l){for(var r=0,d=0,o=i.length;d<o;d++)(i[d].position<i[r].position&&l==="min"||i[d].position>i[r].position&&l==="max")&&(r=d);return r},getItemPosition:function(l){return i[v.getItemIndex(l)].position}},g=function(l){var r,d=u;l==="next"?(y++,y>v.getItemPosition("max")&&(r=v.getItemIndex("min"),i[r].position=v.getItemPosition("max")+1,i[r].transform+=i.length*100,i[r].item.style.transform="translateX("+i[r].transform+"%)"),w-=P,u=u+1,u>k&&(u=0)):(y--,y<v.getItemPosition("min")&&(r=v.getItemIndex("max"),i[r].position=v.getItemPosition("min")-1,i[r].transform-=i.length*100,i[r].item.style.transform="translateX("+i[r].transform+"%)"),w+=P,u=u-1,u<0&&(u=k)),a.style.transform="translateX("+w+"%)",I[d].classList.remove("active"),I[u].classList.add("active")},W=function(l){for(var r=0,d=l>u?"next":"prev";l!==u&&r<=k;)g(d),r++},m=function(){!f.isAutoplay||(x(),H=setInterval(function(){g(f.directionAutoplay)},f.delayAutoplay))},x=function(){clearInterval(H)},F=function(){var l=document.createElement("ol");l.classList.add("slider__indicators");for(var r=0,d=s.length;r<d;r++){var o=document.createElement("li");o.innerHTML=r,r===0&&o.classList.add("active"),o.setAttribute("data-slide-to",r),l.appendChild(o)}n.appendChild(l),I=n.querySelectorAll(".slider__indicators > li")},N=function(){return!!("ontouchstart"in window||navigator.maxTouchPoints)},R=function(){var l=0;if(N())n.addEventListener("touchstart",function(o){l=o.changedTouches[0].clientX,m()}),n.addEventListener("touchend",function(o){var U=o.changedTouches[0].clientX,O=U-l;O>M?g("prev"):O<-M&&g("next"),m()});else for(var r=0,d=c.length;r<d;r++)c[r].classList.add("slider__control_show");n.addEventListener("click",function(o){o.target.classList.contains("slider__control")?(o.preventDefault(),g(o.target.classList.contains("slider__control_next")?"next":"prev"),m()):o.target.getAttribute("data-slide-to")&&(o.preventDefault(),W(parseInt(o.target.getAttribute("data-slide-to"))),m())}),document.addEventListener("visibilitychange",function(){document.visibilityState==="hidden"?x():m()},!1),f.isPauseOnHover&&f.isAutoplay&&(n.addEventListener("mouseenter",function(){x()}),n.addEventListener("mouseleave",function(){m()}))};return F(),R(),m(),{next:function(){g("next")},left:function(){g("prev")},stop:function(){f.isAutoplay=!1,x()},cycle:function(){f.isAutoplay=!0,m()}}}}();function J(t){return T("POST","api/word/audio/create",t).then(e=>e).catch(e=>{X(e.message,"error")})}function K(t){let e=new FormData;e.append("word",t),T("POST","api/word/create",e).then(n=>{Q(n)&&J(e)}).catch(n=>{X(n.message,"error")})}function Q(t){return t.data.audio=="def"||t.data.audio==""}function Y(){return document.querySelector("#balance").innerText>=1e3}function Z(){let t=document.querySelector("#slider-block");t.innerHTML=" ";let e=document.createElement("div");e.setAttribute("class","slider");let n=document.createElement("div");n.setAttribute("class","slider__wrapper");let a=document.createElement("div");a.setAttribute("class","slider__items"),a.setAttribute("id","select-gif");let s=document.createElement("a");s.setAttribute("class","slider__control slider__control_prev"),s.setAttribute("href","#"),s.setAttribute("role","button"),s.innerHTML="<";let c=document.createElement("a");return c.setAttribute("class","slider__control slider__control_next"),c.setAttribute("href","#"),c.setAttribute("role","button"),c.innerHTML=">",e.appendChild(n),n.appendChild(a),n.appendChild(s),n.appendChild(c),t.appendChild(e),!0}function ee(t){let e=document.createElement("div");e.setAttribute("class","slider__item");let n=document.createElement("div");n.setAttribute("class","slider-gif");let a=document.createElement("img");return a.src=t,e.appendChild(n),n.appendChild(a),e}async function te(t){return await T("GET","api/translation/"+t).then(e=>e).catch(e=>{console.log(e)})}function ne(t){let e=t.length,n=document.querySelector("#select-gif");n.innerHTML=" ";for(let a=0;a<e;a++)n.appendChild(ee(t[a].src))}async function re(t){V("body","\u0421\u043E\u0445\u0440\u0430\u043D\u044F\u0435\u043C \u043A\u0430\u0440\u0442\u0443");let e=t.word,n=t.src,a=new FormData;a.append("word",e),a.append("gif",n),await T("POST","/card/create",a).then(s=>{D(),location="#close",$(),j()}).catch(s=>{location="#close",alert(s.message,"error"),D()})}function ae(t){let e=document.querySelector("#creatingCardWord");e.innerHTML=" ",e.innerHTML=t.word;let n=document.querySelector("#creatingCardTranslate");n.innerHTML=" ";let a=t.data.translate.length;for(let c=0;c<a;c++){let y=" , ";c==a-1&&(y=";"),n.innerHTML+=" "+t.data.translate[c]+y}let s=document.querySelector("#creatingCardImg");s.src=t.src}let h=[],G=document.querySelector("#stepOneDisplay"),A=document.querySelector("#stepTooDisplay"),E=document.querySelector("#stepThreeDisplay"),p=document.querySelector("#word"),_=document.querySelector("#btn-step-one"),b=5;_.onclick=()=>{if(!Y())return alert("\u041D\u0435 \u0445\u0432\u0430\u0442\u0430\u0435 \u043F\u044B\u043B\u0438"),location="#close",!1;ie()};document.querySelector("#btn-step-too").onclick=()=>{le()};document.querySelector("#btn-step-one-prev").onclick=()=>{L()};document.querySelector("#btn-step-too-prev").onclick=()=>{se()};document.querySelector("#btn-save-new-card").onclick=()=>{re(h),L()};async function ie(){if(!p.value)return!1;K(p.value),h.word=p.value,p.setAttribute("disabled",!0),Z(),C(),h.data=await te(p.value),await oe(p.value),p.removeAttribute("disabled"),z(".slider",{isAutoplay:!1}),G.style.display="none",A.style.display="block"}function C(){if(!p.hasAttribute("disabled")){_.innerText="\u0414\u0430\u043B\u0435\u0435",_.disabled=!1,_.setAttribute("style","background:var(--secondary-dark)");return}if(b==95)return b=5,C();_.innerText="\u0418\u0449\u0435\u043C \u0433\u0438\u0444\u043A\u0438 \u0438 \u043F\u0435\u0440\u0435\u0432\u043E\u0434",setTimeout(()=>{_.disabled=!0,_.setAttribute("style",`background:linear-gradient(110deg, var(--secondary-dark) 0%, 
        var(--secondary-dark) `+(b-5)+"%, rgba(239,239,242,1) "+b+"%, var(--secondary-dark) "+(b+5)+`%, 
        var(--secondary-dark) 100%);`),C()},10),b++}async function oe(t){await T("GET","api/gif/search/"+t).then(e=>{ne(e.data),h.gifs=e.data}).catch(e=>{L(),console.log(e)})}function L(){p.value="",G.style.display="block",A.style.display="none",E.style.display="none"}function le(){try{let t=document.querySelector("ol>li.active").innerHTML;h.src=h.gifs[t].src,A.style.display="none",E.style.display="block",ae(h)}catch(t){L(),console.log(t)}}function se(){A.style.display="none",A.style.display="block",E.style.display="none"}