import{S as l}from"./SendRequest.f2a9e872.js";import{s as n,c,a as i,b as s,d as C,e as g}from"./getCardCollection.9f89fe36.js";let a=document.querySelector("#deck-card"),p=["","common","rare","epic","legend"];function h(t){n("body","\u0417\u0430\u0433\u0440\u0443\u0436\u0430\u0435\u043C \u0432\u0430\u0448\u0443 \u043A\u043E\u043B\u043B\u0435\u043A\u0446\u0438\u044E"),l("GET","/card/getCards/?page="+t).then(e=>{f(),m(e.data),c(e.pagination),i()}).catch(e=>{console.log(e)})}h(1);function m(t){for(let e=0;e<t.length;e++)a.appendChild(u(t[e]))}function u(t){let e=document.createElement("div");e.setAttribute("class","card "+p[t.level]);let o=s(t),d=C(t),r=g(t);return e.appendChild(o),e.appendChild(d),e.appendChild(r),e}function f(){for(;a.children.length>1;)a.removeChild(a.lastChild)}