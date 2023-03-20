async function u(e,t,o=null,n=!0){return new Promise((r,l)=>{const c=new XMLHttpRequest;c.open(e,t,!0),c.responseType="json",c.withCredentials=!0,c.setRequestHeader("X-CSRF-TOKEN",document.head.querySelector("[name=csrf-token]").content),c.readyState==1&&n&&console.log("\u041E\u0442\u043F\u0440\u0430\u0432\u043A\u0430 \u0437\u0430\u043F\u0440\u043E\u0441\u0430 "+e+" \u0437\u0430\u043F\u0440\u043E\u0441\u0430 \u043D\u0430 "+t),c.onload=()=>{c.status>=400?l(c.response):r(c.response)},c.onerror=()=>{l(c.response)},c.send(o)})}function f(){u("GET","/profile/balance").then(e=>{C(e.data)}).catch(e=>{console.log(e)})}function C(e){let t=document.querySelector("#balance");t.innerText=e.balance}let b="https://i.giphy.com/media/j5sp3actiz8foT88Dp/giphy.webp",a;function s(e,t="\u0417\u0430\u0433\u0440\u0443\u0437\u043A\u0430"){a=document.querySelector("#"+e),a.classList.add("nonescroll"),g();let o=_(),n=document.createElement("div"),r=h(),l=k(t);n.appendChild(r),o.appendChild(n),o.appendChild(l),a.appendChild(o)}function m(){let e=document.querySelector("#loadblock");e&&(a.removeChild(e),a.classList.remove("nonescroll"))}function h(){let e=document.createElement("img");return e.src=b,e}function k(e){let t=document.createElement("p");return t.innerText=e,t}function _(){let e=document.createElement("div");return e.setAttribute("style",`
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
    `),e.setAttribute("id","loadblock"),e}var p;function g(){var e=Math.max(document.body.scrollTop,document.documentElement.scrollTop);return e>0?(window.scrollBy(0,-100),p=setTimeout(g(),20)):clearTimeout(p),!1}function T(e){let t=document.createElement("div");t.setAttribute("class","card-gif");let o=document.createElement("img");return o.src=e.src,o.onclick=()=>{var n=new Audio;n.src=e.audio,n.autoplay=!0},t.appendChild(o),t}function y(e){let t=document.createElement("div");t.setAttribute("class","card-text");let o=document.createElement("p");o.innerText=e.word;let n=document.createElement("p"),r=e.info.translate.length;for(let l=0;l<r;l++){let c=" , ";l==r-1&&(c=";"),n.innerText+=" "+e.info.translate[l]+c}return t.appendChild(o),t.appendChild(n),t}function x(){window.currentPage<2&&i(1)}function v(e){let t=document.querySelector("#comfim_delete_card"),o=document.querySelector("#aboard_delete_card");location="#deleteCard",t.onclick=()=>(A(e),!0),o.onclick=()=>{location="#close"}}function A(e){s("body","\u0420\u0430\u0441\u043F\u044B\u043B\u044F\u044E..."),u("GET","/card/delete/"+e).then(t=>{console.log(t),location="#close",m(),x(),f()}).catch(t=>{console.log(t)})}function E(e){location="#addCardToDeck";let t=document.querySelector("#comfim_add_to_deck"),o=document.querySelector("#aboard_add_to_deck");t.onclick=()=>(q(),!0),o.onclick=()=>{location="#close"};let n=document.querySelector("#input_deck_from_add_card");n.value=e}async function q(){let e=document.querySelector("#add_card_to_deck_form"),t=new FormData(e);s("body","\u0414\u043E\u0431\u043E\u0432\u043B\u044F\u044E \u0432 \u043A\u043E\u043B\u043E\u0434\u0443"),await u("POST","/card/addToDeck",t),m(),location="#close"}function S(e){let t=document.createElement("div");t.setAttribute("class","card-option");let o=document.createElement("div");o.setAttribute("class","button-group-column"),t.appendChild(o);let n=document.createElement("button");n.setAttribute("class","danger"),n.innerText="\u0420\u0430\u0441\u043F\u044B\u043B\u0438\u0442\u044C",n.onclick=()=>{v(e.id)};let r=document.createElement("button");return r.setAttribute("class",""),r.innerText="\u0412 \u043A\u043E\u043B\u043E\u0434\u0443",r.onclick=()=>{E(e.id)},o.appendChild(n),o.appendChild(r),t.appendChild(o),t}function w(e){window.currentPage=e.current_page;let t=document.querySelector("#collection-pagination");t.innerHTML=" ";let o=document.createElement("a");if(o.innerText=e.current_page,o.setAttribute("class","deck-paginte-item active-paginate-item"),o.setAttribute("role","button"),o.onclick=()=>{i(e.current_page)},e.prev_page!=null){let n=document.createElement("a");n.setAttribute("class","deck-paginte-item"),n.innerText=e.prev_page,n.setAttribute("role","button"),n.setAttribute("href","#"+e.prev_page),n.onclick=()=>{i(e.prev_page)},t.appendChild(n)}if(t.appendChild(o),e.next_page!=null){let n=document.createElement("a");n.setAttribute("class","deck-paginte-item"),n.setAttribute("role","button"),n.setAttribute("href","#"+e.next_page),n.innerText=e.next_page,n.onclick=()=>{i(e.next_page)},t.appendChild(n)}}function B(e){let t=document.querySelector("#count_card_current_page"),o=document.querySelector("#count_cards"),n=0;e.next_page==null?n=e.total:n=e.current_page*e.count_item_current_page,t.innerText=n,o.innerText=e.total}let d=document.querySelector("#deck-card"),P=["","common","rare","epic","legend"];function i(e){s("body","\u0417\u0430\u0433\u0440\u0443\u0436\u0430\u0435\u043C \u0432\u0430\u0448\u0443 \u043A\u043E\u043B\u043B\u0435\u043A\u0446\u0438\u044E"),u("GET","/card/getCards/?page="+e).then(t=>{F(),D(t.data),w(t.pagination),B(t.pagination),m()}).catch(t=>{console.log(t)})}function D(e){for(let t=0;t<e.length;t++)d.appendChild(L(e[t]))}function L(e){let t=document.createElement("div");t.setAttribute("class","card "+P[e.level]);let o=T(e),n=y(e),r=S(e);return t.appendChild(o),t.appendChild(n),t.appendChild(r),t}function F(){for(;d.children.length>1;)d.removeChild(d.lastChild)}export{u as S,i as a,m as b,T as c,v as d,y as e,f as g,s,x as u};
