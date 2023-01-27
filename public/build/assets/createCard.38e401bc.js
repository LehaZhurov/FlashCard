import{S as L,g as U}from"./getBalance.dd24ae22.js";import{s as V,a as D,u as j}from"./updateCardCollection.33254aee.js";var z=function(){return function(r,t){var e=document.querySelector(r),i=e.querySelector(".slider__items"),s=e.querySelectorAll(".slider__item"),u=e.querySelectorAll(".slider__control"),T=0,I=0,H=100,a=[],M,w,d=0,k=s.length-1,P=50,f={isAutoplay:!0,directionAutoplay:"next",delayAutoplay:2e3,isPauseOnHover:!0};for(var q in t)q in f&&(f[q]=t[q]);for(var S=0,G=s.length;S<G;S++)a.push({item:s[S],position:S,transform:0});var v={getItemIndex:function(l){for(var n=0,c=0,o=a.length;c<o;c++)(a[c].position<a[n].position&&l==="min"||a[c].position>a[n].position&&l==="max")&&(n=c);return n},getItemPosition:function(l){return a[v.getItemIndex(l)].position}},g=function(l){var n,c=d;l==="next"?(T++,T>v.getItemPosition("max")&&(n=v.getItemIndex("min"),a[n].position=v.getItemPosition("max")+1,a[n].transform+=a.length*100,a[n].item.style.transform="translateX("+a[n].transform+"%)"),I-=H,d=d+1,d>k&&(d=0)):(T--,T<v.getItemPosition("min")&&(n=v.getItemIndex("max"),a[n].position=v.getItemPosition("min")-1,a[n].transform-=a.length*100,a[n].item.style.transform="translateX("+a[n].transform+"%)"),I+=H,d=d-1,d<0&&(d=k)),i.style.transform="translateX("+I+"%)",w[c].classList.remove("active"),w[d].classList.add("active")},B=function(l){for(var n=0,c=l>d?"next":"prev";l!==d&&n<=k;)g(c),n++},y=function(){!f.isAutoplay||(x(),M=setInterval(function(){g(f.directionAutoplay)},f.delayAutoplay))},x=function(){clearInterval(M)},W=function(){var l=document.createElement("ol");l.classList.add("slider__indicators");for(var n=0,c=s.length;n<c;n++){var o=document.createElement("li");o.innerHTML=n,n===0&&o.classList.add("active"),o.setAttribute("data-slide-to",n),l.appendChild(o)}e.appendChild(l),w=e.querySelectorAll(".slider__indicators > li")},F=function(){return!!("ontouchstart"in window||navigator.maxTouchPoints)},N=function(){var l=0;if(F())e.addEventListener("touchstart",function(o){l=o.changedTouches[0].clientX,y()}),e.addEventListener("touchend",function(o){var R=o.changedTouches[0].clientX,O=R-l;O>P?g("prev"):O<-P&&g("next"),y()});else for(var n=0,c=u.length;n<c;n++)u[n].classList.add("slider__control_show");e.addEventListener("click",function(o){o.target.classList.contains("slider__control")?(o.preventDefault(),g(o.target.classList.contains("slider__control_next")?"next":"prev"),y()):o.target.getAttribute("data-slide-to")&&(o.preventDefault(),B(parseInt(o.target.getAttribute("data-slide-to"))),y())}),document.addEventListener("visibilitychange",function(){document.visibilityState==="hidden"?x():y()},!1),f.isPauseOnHover&&f.isAutoplay&&(e.addEventListener("mouseenter",function(){x()}),e.addEventListener("mouseleave",function(){y()}))};return W(),N(),y(),{next:function(){g("next")},left:function(){g("prev")},stop:function(){f.isAutoplay=!1,x()},cycle:function(){f.isAutoplay=!0,y()}}}}();function J(r){let t=new FormData;t.append("word",r),L("POST","/word/create",t).then(e=>{}).catch(e=>{console.log(e)})}function K(){return document.querySelector("#balance").innerText>1e3}let p=[],X=document.querySelector("#stepOneDisplay"),b=document.querySelector("#stepTooDisplay"),E=document.querySelector("#stepThreeDisplay"),m=document.querySelector("#word"),h=document.querySelector("#btn-step-one"),_=5;h.onclick=()=>{if(!K())return alert("\u041D\u0435 \u0445\u0432\u0430\u0442\u0430\u0435 \u043F\u044B\u043B\u0438"),location="#close",!1;Q()};async function Q(){if(!m.value)return!1;J(m.value),m.setAttribute("disabled",!0),p.word=m.value,$(),await Y(m.value),await Z(m.value),X.style.display="none",b.style.display="block",m.removeAttribute("disabled"),z(".slider",{isAutoplay:!1})}function C(){if(!m.hasAttribute("disabled")){h.innerText="\u0414\u0430\u043B\u0435\u0435",h.setAttribute("style","background:var(--secondary-dark)");return}if(_==95)return _=5,C();h.innerText="\u0418\u0449\u0435\u043C \u0433\u0438\u0444\u043A\u0438 \u0438 \u043F\u0435\u0440\u0435\u0432\u043E\u0434",setTimeout(()=>{h.setAttribute("style",`background:linear-gradient(110deg, var(--secondary-dark) 0%, 
        var(--secondary-dark) `+(_-5)+"%, rgba(239,239,242,1) "+_+"%, var(--secondary-dark) "+(_+5)+`%, 
        var(--secondary-dark) 100%);`),C()},10),_++}async function Y(r){C(),await L("GET","/translation/"+r).then(t=>{p.data=t}).catch(t=>{console.log(t)})}async function Z(r){await L("GET","/gif/search/"+r).then(t=>{ee(t.data),p.gifs=t.data}).catch(t=>{A(),console.log(t)})}function $(){let r=document.querySelector("#slider-block");r.innerHTML=" ";let t=document.createElement("div");t.setAttribute("class","slider");let e=document.createElement("div");e.setAttribute("class","slider__wrapper");let i=document.createElement("div");i.setAttribute("class","slider__items"),i.setAttribute("id","select-gif");let s=document.createElement("a");s.setAttribute("class","slider__control slider__control_prev"),s.setAttribute("href","#"),s.setAttribute("role","button"),s.innerHTML="<";let u=document.createElement("a");return u.setAttribute("class","slider__control slider__control_next"),u.setAttribute("href","#"),u.setAttribute("role","button"),u.innerHTML=">",t.appendChild(e),e.appendChild(i),e.appendChild(s),e.appendChild(u),r.appendChild(t),!0}function ee(r){try{let t=r.length,e=document.querySelector("#select-gif");e.innerHTML=" ";for(let i=0;i<t;i++)e.appendChild(te(r[i].src))}catch{A()}}function te(r){let t=document.createElement("div");t.setAttribute("class","slider__item");let e=document.createElement("div");e.setAttribute("class","slider-gif");let i=document.createElement("img");return i.src=r,t.appendChild(e),e.appendChild(i),t}document.querySelector("#btn-step-one-prev").onclick=()=>{A()};function A(){m.value="",X.style.display="block",b.style.display="none",E.style.display="none"}document.querySelector("#btn-step-too").onclick=()=>{ne()};function ne(){try{let r=document.querySelector("ol>li.active").innerHTML;p.src=p.gifs[r].src,re(),b.style.display="none",E.style.display="block"}catch{A()}}function re(){let r=document.querySelector("#creatingCardWord");r.innerHTML=" ",r.innerHTML=p.word;let t=document.querySelector("#creatingCardTranslate");t.innerHTML=" ";let e=p.data.translate.length;for(let s=0;s<e;s++){let u=" , ";s==e-1&&(u=";"),t.innerHTML+=" "+p.data.translate[s]+u}let i=document.querySelector("#creatingCardImg");i.src=p.src}document.querySelector("#btn-step-too-prev").onclick=()=>{ie()};function ie(){b.style.display="none",b.style.display="block",E.style.display="none"}document.querySelector("#btn-save-new-card").onclick=()=>{ae()};function ae(){A(),V("body","\u0421\u043E\u0445\u0440\u0430\u043D\u044F\u0435\u043C \u043A\u0430\u0440\u0442\u0443");let r=p.word,t=p.src,e=new FormData;e.append("word",r),e.append("gif",t),L("POST","/card/create",e).then(i=>{D(),location="#close",j(),U()}).catch(i=>{location="#close",D(),console.log(i)})}
