import{j as r}from"./links.5aee9a8f.js";import{S as c}from"./Profile.6dd34133.js";import{r as u,o as s,c as i,d as l}from"./vue.runtime.esm-bundler.f433d23f.js";import{_}from"./_plugin-vue_export-helper.3febc96a.js";const A={methods:{getAuthorEmailAndLogin(e){return typeof(e==null?void 0:e.author)!="object"||!e.author.email||!e.author.login?"":e.author.email+" ("+e.author.login+")"}}},w={methods:{async watchObjectRevisionsOnSavePost(e){await this.$nextTick();const a=(e==null?void 0:e.savePost)||null;if(typeof a!="function")return!1;const t=r();e.savePost=n=>(n=n||{},a(n).then(()=>{!n.isAutosave&&!n.isPreview&&setTimeout(()=>{t.fetch()},2e3)}))}}};const f={components:{SvgDannieProfile:c},props:{src:String,size:{required:!0,type:Number}}},m=["src","width","height"];function h(e,a,t,n,g,y){const o=u("svg-dannie-profile");return t.src?(s(),i("img",{key:0,src:t.src,width:t.size,height:t.size,alt:"avatar",loading:"lazy",decoding:"async",class:"aioseo-user-avatar"},null,8,m)):(s(),l(o,{key:1,width:t.size,height:t.size,class:"aioseo-user-avatar aioseo-user-avatar--dannie"},null,8,["width","height"]))}const P=_(f,[["render",h],["__scopeId","data-v-4705aae0"]]);export{w as O,A as R,P as U};
