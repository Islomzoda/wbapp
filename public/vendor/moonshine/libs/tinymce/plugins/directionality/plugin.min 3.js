/**
 * TinyMCE version 6.4.1 (2023-03-29)
 */
!function(){"use strict";var t=tinymce.util.Tools.resolve("tinymce.PluginManager");const e=t=>e=>typeof e===t,o=t=>"string"===(t=>{const e=typeof t;return null===t?"null":"object"===e&&Array.isArray(t)?"array":"object"===e&&(o=r=t,(n=String).prototype.isPrototypeOf(o)||(null===(i=r.constructor)||void 0===i?void 0:i.name)===n.name)?"string":e;var o,r,n,i})(t),r=e("boolean"),n=t=>!(t=>null==t)(t),i=e("function"),s=e("number"),l=(!1,()=>false);class a{constructor(t,e){this.tag=t,this.value=e}static some(t){return new a(!0,t)}static none(){return a.singletonNone}fold(t,e){return this.tag?e(this.value):t()}isSome(){return this.tag}isNone(){return!this.tag}map(t){return this.tag?a.some(t(this.value)):a.none()}bind(t){return this.tag?t(this.value):a.none()}exists(t){return this.tag&&t(this.value)}forall(t){return!this.tag||t(this.value)}filter(t){return!this.tag||t(this.value)?this:a.none()}getOr(t){return this.tag?this.value:t}or(t){return this.tag?this:t}getOrThunk(t){return this.tag?this.value:t()}orThunk(t){return this.tag?this:t()}getOrDie(t){if(this.tag)return this.value;throw new Error(null!=t?t:"Called getOrDie on None")}static from(t){return n(t)?a.some(t):a.none()}getOrNull(){return this.tag?this.value:null}getOrUndefined(){return this.value}each(t){this.tag&&t(this.value)}toArray(){return this.tag?[this.value]:[]}toString(){return this.tag?`some(${this.value})`:"none()"}}a.singletonNone=new a(!1);const u=(t,e)=>{for(let o=0,r=t.length;o<r;o++)e(t[o],o)},c=t=>{if(null==t)throw new Error("Node cannot be null or undefined");return{dom:t}},d=c,h=(t,e)=>{const o=t.dom;if(1!==o.nodeType)return!1;{const t=o;if(void 0!==t.matches)return t.matches(e);if(void 0!==t.msMatchesSelector)return t.msMatchesSelector(e);if(void 0!==t.webkitMatchesSelector)return t.webkitMatchesSelector(e);if(void 0!==t.mozMatchesSelector)return t.mozMatchesSelector(e);throw new Error("Browser lacks native selectors")}};"undefined"!=typeof window?window:Function("return this;")();const m=t=>e=>(t=>t.dom.nodeType)(e)===t,g=m(1),f=m(3),v=m(9),p=m(11),y=(t,e)=>{t.dom.removeAttribute(e)},w=i(Element.prototype.attachShadow)&&i(Node.prototype.getRootNode)?t=>d(t.dom.getRootNode()):t=>v(t)?t:d(t.dom.ownerDocument),N=t=>d(t.dom.host),b=t=>{const e=f(t)?t.dom.parentNode:t.dom;if(null==e||null===e.ownerDocument)return!1;const o=e.ownerDocument;return(t=>{const e=w(t);return p(o=e)&&n(o.dom.host)?a.some(e):a.none();var o})(d(e)).fold((()=>o.body.contains(e)),(r=b,i=N,t=>r(i(t))));var r,i},S=t=>"rtl"===((t,e)=>{const o=t.dom,r=window.getComputedStyle(o).getPropertyValue(e);return""!==r||b(t)?r:((t,e)=>(t=>void 0!==t.style&&i(t.style.getPropertyValue))(t)?t.style.getPropertyValue(e):"")(o,e)})(t,"direction")?"rtl":"ltr",A=(t,e)=>((t,o)=>((t,e)=>{const o=[];for(let r=0,n=t.length;r<n;r++){const n=t[r];e(n,r)&&o.push(n)}return o})(((t,e)=>{const o=t.length,r=new Array(o);for(let n=0;n<o;n++){const o=t[n];r[n]=e(o,n)}return r})(t.dom.childNodes,d),(t=>h(t,e))))(t),T=("li",t=>g(t)&&"li"===t.dom.nodeName.toLowerCase());const C=(t,e)=>{const n=t.selection.getSelectedBlocks();n.length>0&&(u(n,(t=>{const n=d(t),c=T(n),m=((t,e)=>{return(e?(o=t,r="ol,ul",((t,e,o)=>{let n=t.dom;const s=i(o)?o:l;for(;n.parentNode;){n=n.parentNode;const t=d(n);if(h(t,r))return a.some(t);if(s(t))break}return a.none()})(o,0,n)):a.some(t)).getOr(t);var o,r,n})(n,c);var f;(f=m,(t=>a.from(t.dom.parentNode).map(d))(f).filter(g)).each((t=>{if(S(t)!==e?((t,e,n)=>{((t,e,n)=>{if(!(o(n)||r(n)||s(n)))throw console.error("Invalid call to Attribute.set. Key ",e,":: Value ",n,":: Element ",t),new Error("Attribute value was not simple");t.setAttribute(e,n+"")})(t.dom,e,n)})(m,"dir",e):S(m)!==e&&y(m,"dir"),c){const t=A(m,"li[dir]");u(t,(t=>y(t,"dir")))}}))})),t.nodeChanged())},D=(t,e)=>o=>{const r=t=>{const r=d(t.element);o.setActive(S(r)===e)};return t.on("NodeChange",r),()=>t.off("NodeChange",r)};t.add("directionality",(t=>{(t=>{t.addCommand("mceDirectionLTR",(()=>{C(t,"ltr")})),t.addCommand("mceDirectionRTL",(()=>{C(t,"rtl")}))})(t),(t=>{t.ui.registry.addToggleButton("ltr",{tooltip:"Left to right",icon:"ltr",onAction:()=>t.execCommand("mceDirectionLTR"),onSetup:D(t,"ltr")}),t.ui.registry.addToggleButton("rtl",{tooltip:"Right to left",icon:"rtl",onAction:()=>t.execCommand("mceDirectionRTL"),onSetup:D(t,"rtl")})})(t)}))}();