import{S as m}from"./Index.1114c64e.js";import{o,c as n,a as t,r,d as c,b as s,x as i}from"./vue.runtime.esm-bundler.f433d23f.js";import{_ as a}from"./_plugin-vue_export-helper.3febc96a.js";const p={},y={class:"aioseo-seo-site-score-svg-loading",viewBox:"0 0 33.83098862 33.83098862",xmlns:"http://www.w3.org/2000/svg"},f=t("circle",{fill:"none",class:"aioseo-seo-site-score-loading__circle",cx:"16.91549431",cy:"16.91549431",r:"15.91549431","stroke-linecap":"round","stroke-width":"2","stroke-dasharray":"93","stroke-dashoffset":"90"},null,-1),h=[f];function v(_,l){return o(),n("svg",y,h)}const k=a(p,[["render",v]]);const x={components:{SvgSeoSiteScore:m,SvgSeoSiteScoreLoading:k},props:{score:Number,loading:Boolean,description:String,strokeWidth:{type:Number,default(){return 1.75}}},data(){return{strings:{analyzing:this.$t.__("Analyzing...",this.$td)}}}},S={class:"aioseo-site-score"},w={class:"aioseo-score-amount-wrapper"},B={key:0,class:"aioseo-score-amount"},L={class:"score"},z=t("span",{class:"total"},"/ 100",-1),A=["innerHTML"],C={key:2,class:"score-analyzing"};function N(_,l,e,W,d,b){const u=r("svg-seo-site-score-loading"),g=r("svg-seo-site-score");return o(),n("div",S,[e.loading?(o(),c(u,{key:0})):s("",!0),e.loading?s("",!0):(o(),c(g,{key:1,score:e.score,strokeWidth:e.strokeWidth},null,8,["score","strokeWidth"])),t("div",w,[e.loading?s("",!0):(o(),n("div",B,[t("span",L,i(e.score),1),z])),e.loading?s("",!0):(o(),n("div",{key:1,class:"score-description",innerHTML:e.description},null,8,A)),e.loading?(o(),n("div",C,i(d.strings.analyzing),1)):s("",!0)])])}const V=a(x,[["render",N]]);export{V as C};