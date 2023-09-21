/**
 * TinyMCE version 6.4.1 (2023-03-29)
 */
!function(){"use strict";var e=tinymce.util.Tools.resolve("tinymce.PluginManager"),t=tinymce.util.Tools.resolve("tinymce.Env");const o=e=>t=>t.options.get(e),s=o("min_height"),i=o("max_height"),n=o("autoresize_overflow_padding"),r=o("autoresize_bottom_margin"),l=(e,t)=>{const o=e.getBody();o&&(o.style.overflowY=t?"":"hidden",t||(o.scrollTop=0))},g=(e,t,o,s)=>{var i;const n=parseInt(null!==(i=e.getStyle(t,o,s))&&void 0!==i?i:"",10);return isNaN(n)?0:n},a=(e,o,r,c)=>{var d;const f=e.dom,u=e.getDoc();if(!u)return;if((e=>e.plugins.fullscreen&&e.plugins.fullscreen.isFullscreen())(e))return void l(e,!0);const m=u.documentElement,h=c?c():n(e),p=null!==(d=s(e))&&void 0!==d?d:e.getElement().offsetHeight;let y=p;const S=g(f,m,"margin-top",!0),v=g(f,m,"margin-bottom",!0);let C=m.offsetHeight+S+v+h;C<0&&(C=0);const b=e.getContainer().offsetHeight-e.getContentAreaContainer().offsetHeight;C+b>p&&(y=C+b);const w=i(e);if(w&&y>w?(y=w,l(e,!0)):l(e,!1),y!==o.get()){const s=y-o.get();if(f.setStyle(e.getContainer(),"height",y+"px"),o.set(y),(e=>{e.dispatch("ResizeEditor")})(e),t.browser.isSafari()&&(t.os.isMacOS()||t.os.isiOS())){const t=e.getWin();t.scrollTo(t.pageXOffset,t.pageYOffset)}e.hasFocus()&&(e=>{if("setcontent"===(null==e?void 0:e.type.toLowerCase())){const t=e;return!0===t.selection||!0===t.paste}return!1})(r)&&e.selection.scrollIntoView(),(t.browser.isSafari()||t.browser.isChromium())&&s<0&&a(e,o,r,c)}};e.add("autoresize",(e=>{if((e=>{const t=e.options.register;t("autoresize_overflow_padding",{processor:"number",default:1}),t("autoresize_bottom_margin",{processor:"number",default:50})})(e),e.options.isSet("resize")||e.options.set("resize",!1),!e.inline){const o=(e=>{let t=0;return{get:()=>t,set:e=>{t=e}}})();((e,t)=>{e.addCommand("mceAutoResize",(()=>{a(e,t)}))})(e,o),((e,o)=>{let s,i,l=()=>r(e);e.on("init",(i=>{s=0;const r=n(e),g=e.dom;g.setStyles(e.getDoc().documentElement,{height:"auto"}),t.browser.isEdge()||t.browser.isIE()?g.setStyles(e.getBody(),{paddingLeft:r,paddingRight:r,"min-height":0}):g.setStyles(e.getBody(),{paddingLeft:r,paddingRight:r}),a(e,o,i,l),s+=1})),e.on("NodeChange SetContent keyup FullscreenStateChanged ResizeContent",(t=>{if(1===s)i=e.getContainer().offsetHeight,a(e,o,t,l),s+=1;else if(2===s){const t=i<e.getContainer().offsetHeight;if(t){const t=e.dom,o=e.getDoc();t.setStyles(o.documentElement,{"min-height":0}),t.setStyles(e.getBody(),{"min-height":"inherit"})}l=t?(0,()=>0):l,s+=1}else a(e,o,t,l)}))})(e,o)}}))}();