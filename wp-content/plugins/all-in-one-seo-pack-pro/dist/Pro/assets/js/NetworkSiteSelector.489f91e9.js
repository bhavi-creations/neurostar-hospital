import{u as l}from"./links.5aee9a8f.js";import{r as i,a as u,g as c}from"./params.f0608262.js";import{r as m,o as p,c as d,g as f}from"./vue.runtime.esm-bundler.f433d23f.js";import{_}from"./_plugin-vue_export-helper.3febc96a.js";import"./index.8dbdb224.js";import"./Caret.b5c2e4ec.js";/* empty css                                            *//* empty css                                              */import"./default-i18n.41786823.js";import"./constants.a78fc4cb.js";import{N as h}from"./Network.26f210f2.js";/* empty css                                              */const w={setup(){return{rootStore:l()}},emits:["selected-site"],mixins:[h],props:{followSelectedSite:Boolean,showNetwork:Boolean},data(){return{site:null,network:{value:"network",label:this.$t.__("Network Admin (no site)",this.$td)}}},watch:{site(t){let e=this.rootStore.aioseo.data.network.sites.sites.find(o=>this.getUniqueSiteId(o)===t.value);t.value==="network"&&(e={blog_id:"network"}),this.$emit("selected-site",e),this.followSelectedSite&&this.querySelectedSite()}},computed:{sites(){const t=this.getSites.filter(e=>!e.parentDomain).map(e=>({value:this.getUniqueSiteId(e),label:`${e.domain}${e.path}`}));return this.showNetwork?[this.network].concat(t):t}},methods:{querySelectedSite(){i("aioseo-selected-site-value"),this.site.value!=="network"&&u("aioseo-selected-site-value",this.site.value)}},created(){const t=c();if(t["aioseo-selected-site-value"])return this.site=this.sites.find(e=>e.value===decodeURIComponent(t["aioseo-selected-site-value"])),i("aioseo-selected-site-value"),!1;this.showNetwork&&(this.site=this.network)}},k={class:"aioseo-network-site-selector"};function S(t,e,o,v,s,r){const n=m("base-select");return p(),d("div",k,[f(n,{size:"medium",modelValue:s.site,"onUpdate:modelValue":e[0]||(e[0]=a=>s.site=a),options:r.sites},null,8,["modelValue","options"])])}const I=_(w,[["render",S]]);export{I as C};