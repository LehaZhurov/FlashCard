import{S as n}from"./SendRequest.f2a9e872.js";function l(){n("GET","/profile/balance").then(e=>{c(e.data)}).catch(e=>{console.log(e)})}function c(e){let a=document.querySelector("#balance");a.innerText=e.balance}export{l as g};