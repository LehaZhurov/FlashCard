function f(e,o,n=null,r=!0){return new Promise((a,i)=>{const t=new XMLHttpRequest;t.open(e,o,!0),t.responseType="json",t.withCredentials=!0,t.setRequestHeader("X-CSRF-TOKEN",document.head.querySelector("[name=csrf-token]").content),t.readyState==1&&r&&console.log("\u041E\u0442\u043F\u0440\u0430\u0432\u043A\u0430 \u0437\u0430\u043F\u0440\u043E\u0441\u0430 "+e+" \u0437\u0430\u043F\u0440\u043E\u0441\u0430 \u043D\u0430 "+o),t.onload=()=>{t.status>=400?i(t.response):a(t.response)},t.onerror=()=>{i(t.response)},t.send(n)})}let d="https://i.giphy.com/media/j5sp3actiz8foT88Dp/giphy.webp",l;function h(e,o="\u0417\u0430\u0433\u0440\u0443\u0437\u043A\u0430"){l=document.querySelector("#"+e),l.classList.add("nonescroll"),s();let n=m(),r=document.createElement("div"),a=u(),i=p(o);r.appendChild(a),n.appendChild(r),n.appendChild(i),l.appendChild(n)}function y(){let e=document.querySelector("#loadblock");e&&(l.removeChild(e),l.classList.remove("nonescroll"))}function u(){let e=document.createElement("img");return e.src=d,e}function p(e){let o=document.createElement("p");return o.innerText=e,o}function m(){let e=document.createElement("div");return e.setAttribute("style",`
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
    `),e.setAttribute("id","loadblock"),e}var c;function s(){var e=Math.max(document.body.scrollTop,document.documentElement.scrollTop);return e>0?(window.scrollBy(0,-100),c=setTimeout(s(),20)):clearTimeout(c),!1}export{f as S,y as a,h as s};
