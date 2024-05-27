import{C as S,p as O,c as z,d as C,u as L,m as E}from"./links.5aee9a8f.js";import{C as I}from"./Card.4b2113fb.js";import{C as x}from"./Tabs.48911838.js";import{C as B}from"./SeoSiteAnalysisResults.935f95c2.js";import{p as M}from"./popup.6fe74774.js";import"./default-i18n.41786823.js";import{u as w,S as D}from"./SeoSiteScore.1dc33159.js";import{r as s,o as a,c as u,g as n,b as _,a as o,x as l,d as y,w as i,B as $,n as G}from"./vue.runtime.esm-bundler.f433d23f.js";import{_ as g}from"./_plugin-vue_export-helper.3febc96a.js";import{a as H}from"./index.8dbdb224.js";import"./Caret.b5c2e4ec.js";/* empty css                                            *//* empty css                                              */import"./constants.a78fc4cb.js";/* empty css                                              */import{C as N}from"./Blur.0f2284b0.js";import{C as K}from"./Index.9ed2b61a.js";import{S as U}from"./Book.99c0d6e4.js";import{C as P}from"./Tooltip.6a8793f6.js";import{S as W}from"./Refresh.7ff4214d.js";import"./isArrayLikeObject.c55f4dd0.js";import"./Slide.99d45c60.js";import"./TruSeoScore.177d3103.js";import"./Ellipse.662ef541.js";import"./Information.6754f071.js";import"./Tags.879f02d2.js";import"./tags.dc4abb2d.js";import"./postContent.437c0775.js";import"./cleanForSlug.e9209847.js";import"./toString.cf439405.js";import"./_baseTrim.8725856f.js";import"./_stringToArray.4de3b1f3.js";import"./deburr.6d7d37af.js";import"./html.3b119483.js";import"./get.e0392af6.js";import"./GoogleSearchPreview.716c0630.js";import"./Gear.30ee21fa.js";import"./params.f0608262.js";import"./Index.1114c64e.js";const V={setup(){return{analyzerStore:S()}},components:{CoreSiteScore:K,SvgBook:U},props:{score:Number,loading:Boolean,description:String,summary:{type:Object,default(){return{}}}},data(){return{strings:{yourOverallSiteScore:this.$t.__("Your Overall Site Score",this.$td),goodResult:this.$t.sprintf(this.$t.__("A very good score is between %1$s%3$d and %4$d%2$s.",this.$td),"<strong>","</strong>",50,75),forBestResults:this.$t.sprintf(this.$t.__("For best results, you should strive for %1$s%3$d and above%2$s.",this.$td),"<strong>","</strong>",70),anErrorOccurred:this.$t.__("An error occurred while analyzing your site.",this.$td),criticalIssues:this.$t.__("Important Issues",this.$td),warnings:this.$t.__("Warnings",this.$td),recommendedImprovements:this.$t.__("Recommended Improvements",this.$td),goodResults:this.$t.__("Good Results",this.$td),completeSiteAuditChecklist:this.$t.__("Complete Site Audit Checklist",this.$td),readUltimateSeoGuide:this.$t.__("Read the Ultimate WordPress SEO Guide",this.$td)}}},computed:{getError(){switch(this.analyzerStore.analyzeError){case"invalid-url":return this.$t.__("The URL provided is invalid.",this.$td);case"missing-content":return this.$t.sprintf("%1$s %2$s",this.$t.__("We were unable to parse the content for this site.",this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"seoAnalyzerIssues",!0));case"invalid-token":return this.$t.sprintf(this.$t.__("Your site is not connected. Please connect to %1$s, then try again.",this.$td),"AIOSEO")}return this.analyzerStore.analyzeError}}},Y={class:"aioseo-site-score-analyze"},q={key:0,class:"aioseo-seo-site-score-score"},j={key:1,class:"aioseo-seo-site-score-description"},F=["innerHTML"],Q=["innerHTML"],J={class:"d-flex"},X=["href"],Z={key:2,class:"analyze-errors"},ee=["innerHTML"];function te(e,f,m,t,r,c){const d=s("core-site-score"),h=s("svg-book");return a(),u("div",Y,[t.analyzerStore.analyzeError?_("",!0):(a(),u("div",q,[n(d,{loading:m.loading,score:m.score,description:m.description,strokeWidth:1.75},null,8,["loading","score","description"])])),t.analyzerStore.analyzeError?_("",!0):(a(),u("div",j,[o("h2",null,l(r.strings.yourOverallSiteScore),1),o("div",{innerHTML:r.strings.goodResult},null,8,F),o("div",{innerHTML:r.strings.forBestResults},null,8,Q),o("div",J,[n(h),o("a",{href:e.$links.getDocUrl("ultimateGuide"),target:"_blank"},l(r.strings.readUltimateSeoGuide),9,X)])])),t.analyzerStore.analyzeError?(a(),u("div",Z,[o("h3",null,l(r.strings.anErrorOccurred),1),o("span",{innerHTML:c.getError},null,8,ee)])):_("",!0)])}const se=g(V,[["render",te]]);const oe={setup(){const{strings:e}=w();return{analyzerStore:S(),connectStore:O(),licenseStore:z(),optionsStore:C(),rootStore:L(),strings:e}},components:{CoreBlur:N,CoreSiteScoreAnalyze:se},mixins:[D],data(){return{score:0}},watch:{"optionsStore.internalOptions.internal.siteAnalysis.score"(e){this.score=e}},computed:{getSummary(){return{recommended:this.analyzerStore.recommendedCount(),critical:this.analyzerStore.criticalCount(),good:this.analyzerStore.goodCount()}}},methods:{openPopup(e){M(e,this.connectWithAioseo,600,630,!0,["token"],this.completedCallback,this.closedCallback)},completedCallback(e){return this.connectStore.saveConnectToken(e.token)},closedCallback(e){e&&this.analyzerStore.runSiteAnalyzer(),this.analyzerStore.analyzing=!0}},mounted(){!this.optionsStore.internalOptions.internal.siteAnalysis.score&&this.licenseStore.licenseKey&&(this.analyzerStore.analyzing=!0,this.analyzerStore.runSiteAnalyzer()),this.score=this.optionsStore.internalOptions.internal.siteAnalysis.score}},re={class:"aioseo-seo-site-score"},ne={key:1,class:"aioseo-seo-site-score-cta"},ie=["href"];function ae(e,f,m,t,r,c){const d=s("core-site-score-analyze"),h=s("core-blur");return a(),u("div",re,[t.licenseStore.licenseKey?_("",!0):(a(),y(h,{key:0},{default:i(()=>[n(d,{score:85,description:e.description},null,8,["description"])]),_:1})),t.licenseStore.licenseKey?_("",!0):(a(),u("div",ne,[o("a",{href:t.rootStore.aioseo.urls.aio.settings},l(t.strings.enterLicenseKey),9,ie),$(" "+l(t.strings.toSeeYourSiteScore),1)])),t.licenseStore.licenseKey?(a(),y(d,{key:2,score:r.score,description:e.description,loading:t.analyzerStore.analyzing,summary:c.getSummary},null,8,["score","description","loading","summary"])):_("",!0)])}const le=g(oe,[["render",ae]]);const ce={setup(){return{analyzerStore:S(),licenseStore:z(),optionsStore:C(),settingsStore:E()}},components:{CoreCard:I,CoreMainTabs:x,CoreSeoSiteAnalysisResults:B,CoreSeoSiteScoreAnalyze:le,CoreTooltip:P,SvgRefresh:W,SvgCircleQuestionMark:H},data(){return{internalDebounce:!1,strings:{completeSeoChecklist:this.$t.__("Complete SEO Checklist",this.$td),refreshResults:this.$t.__("Refresh Results",this.$td),cardDescription:this.$t.__("These are the results our SEO Analzyer has generated after analyzing the homepage of your website.",this.$td)+" "+this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"seoAnalyzer",!0)}}},computed:{tabs(){const e=this.optionsStore.internalOptions.internal.siteAnalysis;return[{slug:"all-items",label:this.$t.__("All Items",this.$td),analyze:{classColor:"black",count:e.score?this.analyzerStore.allItemsCount():0}},{slug:"critical",label:this.$t.__("Important Issues",this.$td),analyze:{classColor:"red",count:e.score?this.analyzerStore.criticalCount():0}},{slug:"recommended-improvements",label:this.$t.__("Recommended Improvements",this.$td),analyze:{classColor:"blue",count:e.score?this.analyzerStore.recommendedCount():0}},{slug:"good-results",label:this.$t.__("Good Results",this.$td),analyze:{classColor:"green",count:e.score?this.analyzerStore.goodCount():0}}]}},methods:{processChangeTab(e){this.internalDebounce||(this.internalDebounce=!0,this.settingsStore.changeTab({slug:"seoAuditChecklist",value:e}),setTimeout(()=>{this.internalDebounce=!1},50))},refresh(){this.analyzerStore.analyzing=!0,this.analyzerStore.runSiteAnalyzer({refresh:!0})}}},ue={class:"aioseo-seo-audit-checklist"},_e=["innerHTML"],de={class:"label"};function he(e,f,m,t,r,c){const d=s("core-seo-site-score-analyze"),h=s("core-card"),k=s("svg-circle-question-mark"),b=s("core-tooltip"),v=s("svg-refresh"),A=s("base-button"),T=s("core-main-tabs"),R=s("core-seo-site-analysis-results");return a(),u("div",ue,[n(h,{slug:"connectOrScore","hide-header":"","no-slide":"",toggles:!1},{default:i(()=>[n(d)]),_:1}),(e.$isPro&&t.licenseStore.licenseKey||t.optionsStore.internalOptions.internal.siteAnalysis.connectToken)&&t.optionsStore.internalOptions.internal.siteAnalysis.score?(a(),y(h,{key:0,slug:"completeSeoChecklist","no-slide":"",toggles:!1},{header:i(()=>[o("span",null,l(r.strings.completeSeoChecklist),1),n(b,null,{tooltip:i(()=>[o("span",{innerHTML:r.strings.cardDescription},null,8,_e)]),default:i(()=>[n(k)]),_:1})]),"header-extra":i(()=>[n(A,{class:"refresh-results",type:"gray",size:"small",onClick:c.refresh,loading:t.analyzerStore.analyzing},{default:i(()=>[n(v),$(" "+l(r.strings.refreshResults),1)]),_:1},8,["onClick","loading"])]),tabs:i(()=>[n(T,{tabs:c.tabs,showSaveButton:!1,active:t.settingsStore.settings.internalTabs.seoAuditChecklist,internal:"",onChanged:c.processChangeTab,"skinny-tabs":""},{"var-tab":i(({tab:p})=>[o("span",{class:G(["round",p.analyze.classColor])},l(p.analyze.count||0),3),o("span",de,l(p.label),1)]),_:1},8,["tabs","active","onChanged"])]),default:i(()=>[n(R,{section:t.settingsStore.settings.internalTabs.seoAuditChecklist,"all-results":t.analyzerStore.getSiteAnalysisResults,"show-instructions":""},null,8,["section","all-results"])]),_:1})):_("",!0)])}const Ze=g(ce,[["render",he]]);export{Ze as default};
