import{s as u,S as p,a as s}from"./load.4cf3e6c8.js";function g(t){let e=document.createElement("div");e.setAttribute("class","card-gif");let l=document.createElement("img");return l.src=t.src,e.appendChild(l),e}function m(t){let e=document.createElement("div");e.setAttribute("class","card-text");let l=document.createElement("p");l.innerText=t.word;let n=document.createElement("p"),r=t.info.translate.length-2;for(let c=0;c<=r;c++){let i=" , ";c==r&&(i=";"),n.innerText+=" "+t.info.translate[c]+i}return e.appendChild(l),e.appendChild(n),e}function f(t){console.log("\u0423\u0434\u0430\u043B\u0435\u043D\u0438\u0435 \u043A\u0430\u0440\u0442\u044B",t)}function b(t){console.log("\u0414\u043E\u0431\u0430\u0432\u043B\u0435\u043D\u0438\u0435 \u0432 \u043A\u043E\u043B\u043E\u0434\u0443",t)}function C(t){let e=document.createElement("div");e.setAttribute("class","card-option");let l=document.createElement("div");l.setAttribute("class","button-group-column"),e.appendChild(l);let n=document.createElement("button");n.setAttribute("class","danger"),n.innerText="\u0420\u0430\u0441\u043F\u044B\u043B\u0438\u0442\u044C",n.onclick=()=>{f(t.id)};let r=document.createElement("button");return r.setAttribute("class",""),r.innerText="\u0412 \u043A\u043E\u043B\u043E\u0434\u0443",r.onclick=()=>{b(t.id)},l.appendChild(n),l.appendChild(r),e.appendChild(l),e}let d=document.querySelector("#deck-card"),v=["","common","rare","epic","legend"];function o(t){u("body","\u0417\u0430\u0433\u0440\u0443\u0436\u0430\u0435\u043C \u0432\u0430\u0448\u0443 \u043A\u043E\u043B\u043B\u0435\u043A\u0446\u0438\u044E"),p("GET","/card/getCards/?page="+t).then(e=>{E(),k(e.data),h(e.pagination),s()}).catch(e=>{console.log(e)})}o(1);function k(t){for(let e=0;e<t.length;e++)d.appendChild(A(t[e]))}function A(t){let e=document.createElement("div");e.setAttribute("class","card "+v[t.level]);let l=g(t),n=m(t),r=C(t);return e.appendChild(l),e.appendChild(n),e.appendChild(r),e}function E(){for(;d.children.length>1;)d.removeChild(d.lastChild)}function h(t){let e=document.querySelector("#collection-pagination");e.innerHTML=" ";let l=document.createElement("a");if(l.innerText=t.current_page,l.setAttribute("class","deck-paginte-item active-paginate-item"),l.setAttribute("role","button"),l.onclick=()=>{o(t.current_page)},t.prev_page!=null){let n=document.createElement("a");n.setAttribute("class","deck-paginte-item"),n.innerText=t.prev_page,n.setAttribute("role","button"),n.setAttribute("href","#"+t.prev_page),n.onclick=()=>{o(t.prev_page),console.log(t.prev_page)},e.appendChild(n)}if(e.appendChild(l),t.next_page!=null){let n=document.createElement("a");n.setAttribute("class","deck-paginte-item"),n.setAttribute("role","button"),n.setAttribute("href","#"+t.next_page),n.innerText=t.next_page,n.onclick=()=>{o(t.next_page),console.log(t.next_page)},e.appendChild(n)}}let a=document.querySelector("#deck-card"),T=["","common","rare","epic","legend"];function x(t){u("body","\u0417\u0430\u0433\u0440\u0443\u0436\u0430\u0435\u043C \u0432\u0430\u0448\u0443 \u043A\u043E\u043B\u043B\u0435\u043A\u0446\u0438\u044E"),p("GET","/card/getCards/?page="+t).then(e=>{y(),_(e.data),h(e.pagination),s()}).catch(e=>{console.log(e)})}x(1);function _(t){for(let e=0;e<t.length;e++)a.appendChild(P(t[e]))}function P(t){let e=document.createElement("div");e.setAttribute("class","card "+T[t.level]);let l=g(t),n=m(t),r=C(t);return e.appendChild(l),e.appendChild(n),e.appendChild(r),e}function y(){for(;a.children.length>1;)a.removeChild(a.lastChild)}
