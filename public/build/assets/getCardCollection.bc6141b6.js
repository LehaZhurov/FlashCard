import{S as l}from"./getBalance.dd24ae22.js";import{s as n,c,e as i,a as s,g as C,b as g,d as p}from"./updateCardCollection.33254aee.js";let t=document.querySelector("#deck-card"),h=["","common","rare","epic","legend"];function m(a){n("body","\u0417\u0430\u0433\u0440\u0443\u0436\u0430\u0435\u043C \u0432\u0430\u0448\u0443 \u043A\u043E\u043B\u043B\u0435\u043A\u0446\u0438\u044E"),l("GET","/card/getCards/?page="+a).then(e=>{v(),u(e.data),c(e.pagination),i(e.pagination),s()}).catch(e=>{console.log(e)})}m(1);function u(a){for(let e=0;e<a.length;e++)t.appendChild(f(a[e]))}function f(a){let e=document.createElement("div");e.setAttribute("class","card "+h[a.level]);let o=C(a),d=g(a),r=p(a);return e.appendChild(o),e.appendChild(d),e.appendChild(r),e}function v(){for(;t.children.length>1;)t.removeChild(t.lastChild)}
