import{S as p}from"./SendRequest.f2a9e872.js";let m="https://i.giphy.com/media/j5sp3actiz8foT88Dp/giphy.webp",o;function g(e,t="\u0417\u0430\u0433\u0440\u0443\u0437\u043A\u0430"){o=document.querySelector("#"+e),o.classList.add("nonescroll"),s();let l=C(),n=document.createElement("div"),r=b(),c=f(t);n.appendChild(r),l.appendChild(n),l.appendChild(c),o.appendChild(l)}function h(){let e=document.querySelector("#loadblock");e&&(o.removeChild(e),o.classList.remove("nonescroll"))}function b(){let e=document.createElement("img");return e.src=m,e}function f(e){let t=document.createElement("p");return t.innerText=e,t}function C(){let e=document.createElement("div");return e.setAttribute("style",`
            position: absolute;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            background-color: var(--secondary-light);
            flex-direction:column;
            height: `+window.innerHeight+`px;
            z-index:100000;
            align-items: center;
    `),e.setAttribute("id","loadblock"),e}var u;function s(){var e=Math.max(document.body.scrollTop,document.documentElement.scrollTop);return e>0?(window.scrollBy(0,-100),u=setTimeout(s(),20)):clearTimeout(u),!1}function k(e){let t=document.createElement("div");t.setAttribute("class","card-gif");let l=document.createElement("img");return l.src=e.src,t.appendChild(l),t}function x(e){let t=document.createElement("div");t.setAttribute("class","card-text");let l=document.createElement("p");l.innerText=e.word;let n=document.createElement("p"),r=e.info.translate.length;for(let c=0;c<r;c++){let i=" , ";c==r-1&&(i=";"),n.innerText+=" "+e.info.translate[c]+i}return t.appendChild(l),t.appendChild(n),t}function v(e){console.log("\u0423\u0434\u0430\u043B\u0435\u043D\u0438\u0435 \u043A\u0430\u0440\u0442\u044B",e)}function T(e){console.log("\u0414\u043E\u0431\u0430\u0432\u043B\u0435\u043D\u0438\u0435 \u0432 \u043A\u043E\u043B\u043E\u0434\u0443",e)}function A(e){let t=document.createElement("div");t.setAttribute("class","card-option");let l=document.createElement("div");l.setAttribute("class","button-group-column"),t.appendChild(l);let n=document.createElement("button");n.setAttribute("class","danger"),n.innerText="\u0420\u0430\u0441\u043F\u044B\u043B\u0438\u0442\u044C",n.onclick=()=>{v(e.id)};let r=document.createElement("button");return r.setAttribute("class",""),r.innerText="\u0412 \u043A\u043E\u043B\u043E\u0434\u0443",r.onclick=()=>{T(e.id)},l.appendChild(n),l.appendChild(r),t.appendChild(l),t}function E(e){window.currentPage=e.current_page;let t=document.querySelector("#collection-pagination");t.innerHTML=" ";let l=document.createElement("a");if(l.innerText=e.current_page,l.setAttribute("class","deck-paginte-item active-paginate-item"),l.setAttribute("role","button"),l.onclick=()=>{d(e.current_page)},e.prev_page!=null){let n=document.createElement("a");n.setAttribute("class","deck-paginte-item"),n.innerText=e.prev_page,n.setAttribute("role","button"),n.setAttribute("href","#"+e.prev_page),n.onclick=()=>{d(e.prev_page)},t.appendChild(n)}if(t.appendChild(l),e.next_page!=null){let n=document.createElement("a");n.setAttribute("class","deck-paginte-item"),n.setAttribute("role","button"),n.setAttribute("href","#"+e.next_page),n.innerText=e.next_page,n.onclick=()=>{d(e.next_page)},t.appendChild(n)}}let a=document.querySelector("#deck-card"),y=["","common","rare","epic","legend"];function d(e){g("body","\u0417\u0430\u0433\u0440\u0443\u0436\u0430\u0435\u043C \u0432\u0430\u0448\u0443 \u043A\u043E\u043B\u043B\u0435\u043A\u0446\u0438\u044E"),p("GET","/card/getCards/?page="+e).then(t=>{L(),_(t.data),E(t.pagination),h()}).catch(t=>{console.log(t)})}d(1);function _(e){for(let t=0;t<e.length;t++)a.appendChild(w(e[t]))}function w(e){let t=document.createElement("div");t.setAttribute("class","card "+y[e.level]);let l=k(e),n=x(e),r=A(e);return t.appendChild(l),t.appendChild(n),t.appendChild(r),t}function L(){for(;a.children.length>1;)a.removeChild(a.lastChild)}export{h as a,k as b,E as c,x as d,A as e,d as g,g as s};
