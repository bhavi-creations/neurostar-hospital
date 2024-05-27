import{u as v,q as x,d as N,c as D}from"./links.5aee9a8f.js";import{l as M}from"./license.1bab1f97.js";import{r as a,o as r,c as p,g as n,w as o,d as m,B as g,x as l,b as d,a as _,F as O,C as I,f as E,n as C}from"./vue.runtime.esm-bundler.f433d23f.js";import{_ as w}from"./_plugin-vue_export-helper.3febc96a.js";import{C as H}from"./index.8dbdb224.js";import{S as Y}from"./Caret.b5c2e4ec.js";/* empty css                                            *//* empty css                                              */import"./default-i18n.41786823.js";import"./constants.a78fc4cb.js";import{N as R}from"./Network.26f210f2.js";/* empty css                                              */import{C as $}from"./Card.4b2113fb.js";import{G as j,a as F}from"./Row.e69aefbc.js";import{T as P}from"./ToolsSettings.43c6a3f6.js";import{C as q}from"./Index.af046b6e.js";import{B as G}from"./Checkbox.8f797799.js";import{C as z}from"./SettingsRow.81a9aa4d.js";import{S as J}from"./Checkmark.74f4bcd8.js";import{C as K}from"./Index.9f46e792.js";import{C as Q}from"./Blur.0f2284b0.js";import"./isArrayLikeObject.c55f4dd0.js";import"./upperFirst.28ffc55f.js";import"./_stringToArray.4de3b1f3.js";import"./toString.cf439405.js";import"./Tooltip.6a8793f6.js";import"./Slide.99d45c60.js";import"./addons.f922e933.js";import"./allowed.91f506b0.js";import"./deburr.6d7d37af.js";const W={setup(){return{rootStore:v(),toolsStore:x()}},components:{BaseCheckbox:G,CoreAlert:H,CoreModal:q,CoreSettingsRow:z,GridColumn:j,GridRow:F,SvgClose:Y},mixins:[P],props:{site:Object},data(){return{showSuccess:!1,showModal:!1,loading:!1,options:{},strings:{selectSettings:this.$t.__("Select Settings",this.$td),selectSettingsToReset:this.$t.__("Select settings that you would like to reset:",this.$td),resetSelectedSettings:this.$t.__("Reset Selected Settings to Default",this.$td),resetSuccess:this.$t.__("Your settings have been reset successfully!",this.$td),areYouSureReset:this.$t.__("Are you sure you want to reset the selected settings to default?",this.$td),actionCannotBeUndone:this.$t.sprintf(this.$t.__("This action cannot be undone. Before taking this action, we recommend that you make a %1$sfull website backup first%2$s.",this.$td),"<strong>","</strong>"),yesIHaveBackup:this.$t.__("Yes, I have a backup and want to reset the settings",this.$td),noBackup:this.$t.__("No, I need to make a backup",this.$td),allSettings:this.$t.sprintf(this.$t.__("All %1$s Settings",this.$td),"AIOSEO")}}},computed:{canReset(){if(this.rootStore.aioseo.data.isNetworkAdmin&&!this.site)return!1;const s=[];return Object.keys(this.options).forEach(t=>{s.push(this.options[t])}),!s.some(t=>t)}},methods:{processResetSettings(){const s=[];this.options.all?this.toolsSettings.filter(t=>t.value!=="all").forEach(t=>{s.push(t.value)}):Object.keys(this.options).forEach(t=>{this.options[t]&&s.push(t)}),this.loading=!0,this.toolsStore.resetSettings({payload:s,siteId:this.site?this.site.blog_id:null}).then(()=>{this.showModal=!1,this.loading=!1,this.showSuccess=!0,this.options={},setTimeout(()=>{this.showSuccess=!1},5e3)})}}},X={class:"aioseo-core-reset-settings"},Z={class:"reset-settings"},ee=_("br",null,null,-1),te=_("br",null,null,-1),se={class:"aioseo-modal-body"},oe=["innerHTML"];function ie(s,t,y,c,e,i){const S=a("core-alert"),u=a("base-checkbox"),k=a("grid-column"),L=a("grid-row"),b=a("base-button"),f=a("core-settings-row"),B=a("svg-close"),A=a("core-modal");return r(),p("div",X,[n(f,{name:e.strings.selectSettings,class:"no-border"},{content:o(()=>[e.showSuccess?(r(),m(S,{key:0,class:"reset-success",type:"green"},{default:o(()=>[g(l(e.strings.resetSuccess),1)]),_:1})):d("",!0),_("div",Z,[g(l(e.strings.selectSettingsToReset)+" ",1),ee,te,n(L,{class:"settings"},{default:o(()=>[n(k,null,{default:o(()=>[n(u,{size:"medium",modelValue:e.options.all,"onUpdate:modelValue":t[0]||(t[0]=h=>e.options.all=h),disabled:c.rootStore.aioseo.data.isNetworkAdmin&&!y.site},{default:o(()=>[g(l(e.strings.allSettings),1)]),_:1},8,["modelValue","disabled"])]),_:1}),(r(!0),p(O,null,I(s.toolsSettings,(h,U)=>(r(),m(k,{key:U,xl:"3",md:"4",sm:"6"},{default:o(()=>[e.options.all?d("",!0):(r(),m(u,{key:0,size:"medium",modelValue:e.options[h.value],"onUpdate:modelValue":V=>e.options[h.value]=V,disabled:c.rootStore.aioseo.data.isNetworkAdmin&&!y.site},{default:o(()=>[g(l(h.label),1)]),_:2},1032,["modelValue","onUpdate:modelValue","disabled"])),h.value!=="all"&&e.options.all?(r(),m(u,{key:1,size:"medium",modelValue:!0,disabled:""},{default:o(()=>[g(l(h.label),1)]),_:2},1024)):d("",!0)]),_:2},1024))),128))]),_:1}),n(b,{type:"gray",size:"medium",onClick:t[1]||(t[1]=h=>e.showModal=!0),disabled:i.canReset},{default:o(()=>[g(l(e.strings.resetSelectedSettings),1)]),_:1},8,["disabled"])])]),_:1},8,["name"]),e.showModal?(r(),m(A,{key:0,"no-header":"",onClose:t[5]||(t[5]=h=>e.showModal=!1)},{body:o(()=>[_("div",se,[_("button",{class:"close",onClick:t[3]||(t[3]=E(h=>e.showModal=!1,["stop"]))},[n(B,{onClick:t[2]||(t[2]=h=>e.showModal=!1)})]),_("h3",null,l(e.strings.areYouSureReset),1),_("div",{class:"reset-description",innerHTML:e.strings.actionCannotBeUndone},null,8,oe),n(b,{type:"blue",size:"medium",onClick:i.processResetSettings,loading:e.loading},{default:o(()=>[g(l(e.strings.yesIHaveBackup),1)]),_:1},8,["onClick","loading"]),n(b,{type:"gray",size:"medium",onClick:t[4]||(t[4]=h=>e.showModal=!1)},{default:o(()=>[g(l(e.strings.noBackup),1)]),_:1})])]),_:1})):d("",!0)])}const T=w(W,[["render",ie]]);const re={setup(){return{optionsStore:N(),rootStore:v(),toolsStore:x()}},mixins:[R],components:{CoreCard:$,CoreResetSettings:T,CoreSettingsRow:z,SvgCheckmark:J},data(){return{site:null,selectedSite:null,clearedLogs:{badBotBlockerLogs:!1,redirectLogs:!1,logs404:!1},loadingLog:null,strings:{selectSite:this.$t.__("Select Site",this.$td),resetRestoreSettings:this.$t.__("Reset / Restore Settings",this.$td),logs:this.$t.__("Logs",this.$td),badBotBlockerLogs:this.$t.__("Bad Bot Blocker Logs",this.$td),cleared:this.$t.__("Cleared",this.$td),clearBadBotBlockerLogs:this.$t.__("Clear Bad Bot Blocker Logs",this.$td),logs404:this.$t.__("404 Logs",this.$td),clear404Logs:this.$t.__("Clear 404 Logs",this.$td),redirectLogs:this.$t.__("Redirect Logs",this.$td),clearRedirectLogs:this.$t.__("Clear Redirect Logs",this.$td),logsTooltip:this.$t.__(`Log sizes may fluctuate and not always be 100% accurate since the results can be cached. Also after clearing a log, it may not show as "0" since database tables also include additional information such as indexes that we don't clear.`,this.$td)}}},watch:{site(s){this.selectedSite=this.rootStore.aioseo.data.network.sites.sites.find(t=>this.getUniqueSiteId(t)===s.value)}},computed:{canReset(){const s=[];return Object.keys(this.options).forEach(t=>{s.push(this.options[t])}),!s.some(t=>t)},showLogs(){return!this.rootStore.aioseo.data.isNetworkAdmin&&(this.showBadBotBlockerLogs||this.rootStore.aioseo.data.logSizes.redirectLogs||this.rootStore.aioseo.data.logSizes.logs404)},showBadBotBlockerLogs(){return this.optionsStore.internalOptions.internal.deprecatedOptions.includes("badBotBlocker")},sites(){return this.getSites.filter(s=>!s.parentDomain).map(s=>({value:this.getUniqueSiteId(s),label:`${s.domain}${s.path}`}))}},methods:{getSizeClass(s){let t="green";return 262144e3<s?t="orange":1073741274<s&&(t="red"),t},processClearLog(s){this.loadingLog=s,this.toolsStore.clearLog(s).then(()=>{this.loadingLog=null,this.clearedLogs[s]=!0})},disabledLog(s){return!this.rootStore.aioseo.data.logSizes[s].original||this.clearedLogs[s]}}},ne={class:"aioseo-tools-database-tools"},ae={key:0},le={key:1},ce={class:"log-size"},de={key:0},ge={key:1},_e={class:"log-size"},ue={key:0},he={key:1},me={class:"log-size"};function pe(s,t,y,c,e,i){const S=a("base-select"),u=a("core-settings-row"),k=a("core-reset-settings"),L=a("core-card"),b=a("svg-checkmark"),f=a("base-button");return r(),p("div",ne,[n(L,{slug:"databaseTools","header-text":e.strings.resetRestoreSettings},{default:o(()=>[c.rootStore.aioseo.data.isNetworkAdmin?(r(),m(u,{key:0,name:e.strings.selectSite},{content:o(()=>[n(S,{size:"medium",modelValue:e.site,"onUpdate:modelValue":t[0]||(t[0]=B=>e.site=B),options:i.sites},null,8,["modelValue","options"])]),_:1},8,["name"])):d("",!0),n(k,{site:e.selectedSite},null,8,["site"])]),_:1},8,["header-text"]),i.showLogs?(r(),m(L,{key:0,slug:"databaseToolsLogs","header-text":e.strings.logs},{tooltip:o(()=>[g(l(e.strings.logsTooltip),1)]),default:o(()=>[c.rootStore.aioseo.data.logSizes.logs404?(r(),m(u,{key:0,name:e.strings.logs404,align:""},{content:o(()=>[n(f,{class:"clear-log",type:"gray",size:"medium",loading:e.loadingLog==="logs404",disabled:i.disabledLog("logs404"),onClick:t[1]||(t[1]=B=>i.processClearLog("logs404"))},{default:o(()=>[i.disabledLog("logs404")?(r(),p("span",ae,[n(b),g(" "+l(e.strings.cleared),1)])):d("",!0),i.disabledLog("logs404")?d("",!0):(r(),p("span",le,l(e.strings.clear404Logs),1))]),_:1},8,["loading","disabled"]),_("div",ce,[_("span",{class:C(["size-dot",i.getSizeClass(c.rootStore.aioseo.data.logSizes.logs404.original)])},null,2),g(" "+l(c.rootStore.aioseo.data.logSizes.logs404.readable),1)])]),_:1},8,["name"])):d("",!0),c.rootStore.aioseo.data.logSizes.redirectLogs?(r(),m(u,{key:1,name:e.strings.redirectLogs,align:""},{content:o(()=>[n(f,{class:"clear-log",type:"gray",size:"medium",loading:e.loadingLog==="redirectLogs",disabled:i.disabledLog("redirectLogs"),onClick:t[2]||(t[2]=B=>i.processClearLog("redirectLogs"))},{default:o(()=>[i.disabledLog("redirectLogs")?(r(),p("span",de,[n(b),g(" "+l(e.strings.cleared),1)])):d("",!0),i.disabledLog("redirectLogs")?d("",!0):(r(),p("span",ge,l(e.strings.clearRedirectLogs),1))]),_:1},8,["loading","disabled"]),_("div",_e,[_("span",{class:C(["size-dot",i.getSizeClass(c.rootStore.aioseo.data.logSizes.redirectLogs.original)])},null,2),g(" "+l(c.rootStore.aioseo.data.logSizes.redirectLogs.readable),1)])]),_:1},8,["name"])):d("",!0),i.showBadBotBlockerLogs?(r(),m(u,{key:2,name:e.strings.badBotBlockerLogs,align:""},{content:o(()=>[n(f,{class:"clear-log",type:"gray",size:"medium",loading:e.loadingLog==="badBotBlockerLog",disabled:i.disabledLog("badBotBlockerLog"),onClick:t[3]||(t[3]=B=>i.processClearLog("badBotBlockerLog"))},{default:o(()=>[i.disabledLog("badBotBlockerLog")?(r(),p("span",ue,[n(b),g(" "+l(e.strings.cleared),1)])):d("",!0),i.disabledLog("badBotBlockerLog")?d("",!0):(r(),p("span",he,l(e.strings.clearBadBotBlockerLogs),1))]),_:1},8,["loading","disabled"]),_("div",me,[_("span",{class:C(["size-dot",i.getSizeClass(c.rootStore.aioseo.data.logSizes.badBotBlockerLog.original)])},null,2),g(" "+l(c.rootStore.aioseo.data.logSizes.badBotBlockerLog.readable),1)])]),_:1},8,["name"])):d("",!0)]),_:1},8,["header-text"])):d("",!0)])}const be=w(re,[["render",pe]]);const Se={mixins:[R],components:{CoreBlur:Q,CoreCard:$,CoreResetSettings:T,CoreSettingsRow:z,Cta:K},data(){return{strings:{selectSite:this.$t.__("Select Site",this.$td),resetRestoreSettings:this.$t.__("Reset / Restore Settings",this.$td),logs:this.$t.__("Logs",this.$td),badBotBlockerLogs:this.$t.__("Bad Bot Blocker Logs",this.$td),cleared:this.$t.__("Cleared",this.$td),clearBadBotBlockerLogs:this.$t.__("Clear Bad Bot Blocker Logs",this.$td),logs404:this.$t.__("404 Logs",this.$td),clear404Logs:this.$t.__("Clear 404 Logs",this.$td),redirectLogs:this.$t.__("Redirect Logs",this.$td),clearRedirectLogs:this.$t.__("Clear Redirect Logs",this.$td),logsTooltip:this.$t.__(`Log sizes may fluctuate and not always be 100% accurate since the results can be cached. Also after clearing a log, it may not show as "0" since database tables also include additional information such as indexes that we don't clear.`,this.$td),ctaHeader:this.$t.sprintf(this.$t.__("This feature is not available in your current plan.",this.$td),"AIOSEO","Pro"),ctaButtonText:this.$t.__("Upgrade Your Plan and Unlock Network Tools",this.$td),networkDatabaseToolsDescription:this.$t.__("Unlock network-level tools to manage all your sites from one easy-to-use location. Migrate data or create backups without the need to visit each dashboard.",this.$td)}}}},fe={class:"aioseo-tools-database-tools"};function ke(s,t,y,c,e,i){const S=a("base-select"),u=a("core-settings-row"),k=a("core-reset-settings"),L=a("core-blur"),b=a("cta"),f=a("core-card");return r(),p("div",fe,[n(f,{slug:"databaseTools","header-text":e.strings.resetRestoreSettings},{default:o(()=>[n(L,null,{default:o(()=>[n(u,{name:e.strings.selectSite},{content:o(()=>[n(S,{size:"medium",modelValue:{value:"",label:""},options:[]})]),_:1},8,["name"]),n(k)]),_:1}),n(b,{"cta-link":s.$links.getPricingUrl("network-tools","database-tools"),"button-text":e.strings.ctaButtonText,"learn-more-link":s.$links.getUpsellUrl("network-tools","database-tools","home")},{"header-text":o(()=>[g(l(e.strings.ctaHeader),1)]),description:o(()=>[g(l(e.strings.networkDatabaseToolsDescription),1)]),_:1},8,["cta-link","button-text","learn-more-link"])]),_:1},8,["header-text"])])}const Le=w(Se,[["render",ke]]),Be={setup(){return{licenseStore:D(),rootStore:v()}},components:{DatabaseTools:be,LiteDatabaseTools:Le},data(){return{license:M}}};function ye(s,t,y,c,e,i){const S=a("database-tools",!0),u=a("lite-database-tools");return r(),p("div",null,[!c.rootStore.aioseo.data.isNetworkAdmin||!c.licenseStore.isUnlicensed&&e.license.hasCoreFeature("tools","network-tools-database")?(r(),m(S,{key:0})):d("",!0),c.rootStore.aioseo.data.isNetworkAdmin&&(c.licenseStore.isUnlicensed||!e.license.hasCoreFeature("tools","network-tools-database"))?(r(),m(u,{key:1})):d("",!0)])}const et=w(Be,[["render",ye]]);export{et as default};
