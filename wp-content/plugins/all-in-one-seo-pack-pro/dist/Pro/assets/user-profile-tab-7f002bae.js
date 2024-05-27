import{_ as h}from"./js/_plugin-vue_export-helper.3febc96a.js";import{r as c,o as r,c as l,a as p,F as b,C as v,n as y,f as C,d as u,A as S,b as d,B as P,x as m,w,g as I,E as x}from"./js/vue.runtime.esm-bundler.f433d23f.js";import{l as T}from"./js/index.23b40181.js";import{l as E}from"./js/index.8dbdb224.js";import{l as k}from"./js/index.0b123ab1.js";import{u as A,m as L,l as B}from"./js/links.5aee9a8f.js";import{C as N}from"./js/Card.4b2113fb.js";import{C as $}from"./js/SocialProfiles.90d1a5c3.js";import{S as D}from"./js/LogoGear.63f69c37.js";import{e as F}from"./js/elemLoaded.9a6eb745.js";import"./js/translations.f6b76bbe.js";import"./js/default-i18n.41786823.js";import"./js/constants.a78fc4cb.js";import"./js/Caret.b5c2e4ec.js";import"./js/isArrayLikeObject.c55f4dd0.js";import"./js/Tooltip.6a8793f6.js";import"./js/Slide.99d45c60.js";import"./js/Checkbox.8f797799.js";import"./js/Checkmark.74f4bcd8.js";import"./js/Textarea.43a6e51d.js";import"./js/SettingsRow.81a9aa4d.js";import"./js/Row.e69aefbc.js";/* empty css                                               */import"./js/Twitter.ce479273.js";const R={setup(){return{rootStore:A(),settingsStore:L()}},components:{CoreCard:N,CoreSocialProfiles:$,SvgLogoGear:D},data(){return{activeTabIndex:0,strings:{socialProfiles:this.$t.__("Social Profiles",this.$td),description:this.$t.__("To let search engines know which profiles are associated with this user, enter them below:",this.$td)}}},methods:{setActiveTab(e){const o=this.activeTabIndex;switch(this.activeTabIndex=e,this.activeTabObject.slug){case"personal-options":document.getElementById("your-profile").childNodes.forEach(t=>{t.style&&(t.style.display="block")});break;case"social-profiles":document.getElementById("your-profile").childNodes.forEach(t=>{t.id==="aioseo-user-profile-tab"||t.className==="submit"||!t.style||(t.style.display="none")});break;case"customer-data":this.activeTabIndex=o,window.location.href=this.rootStore.aioseo.urls.home+"/wp-admin/admin.php?page=followup-emails-reports&tab=reportuser_view&email="+encodeURIComponent(this.settingsStore.userProfile.userData.user_email)+"&user_id="+this.settingsStore.userProfile.userData.ID;break}},updateHiddenInputField(e){document.getElementById("aioseo-user-social-profiles").value=JSON.stringify(e)}},computed:{tabs(){const e=[{label:this.$t.__("Personal Options",this.$td),slug:"personal-options"},{label:this.$t.__("Social Profiles",this.$td),slug:"social-profiles",svg:"svg-logo-gear"}];return this.settingsStore.userProfile.isWooCommerceFollowupEmailsActive&&e.push({label:this.$t.__("Customer Data",this.$td),slug:"customer-data"}),e},activeTabObject(){return this.tabs[this.activeTabIndex]}},async created(){this.updateHiddenInputField(this.settingsStore.userProfile.profiles)},mounted(){const e=new URLSearchParams(window.location.search);e&&e.get("social-profiles")&&this.setActiveTab(1)}},U={id:"aioseo-user-profile-tab"},V={class:"navigation-bar"},H=["onClick"],O={class:"aioseo-settings-row aioseo-section-description"};function G(e,o,t,f,a,i){const _=c("CoreSocialProfiles"),g=c("CoreCard");return r(),l("div",U,[p("div",V,[(r(!0),l(b,null,v(i.tabs,(s,n)=>(r(),l("a",{key:n,class:y({active:n===a.activeTabIndex}),href:"#",onClick:C(J=>i.setActiveTab(n),["prevent"])},[s.svg?(r(),u(S(s.svg),{key:0})):d("",!0),P(" "+m(s.label),1)],10,H))),128))]),i.activeTabObject.slug==="social-profiles"?(r(),u(g,{key:0,slug:"userProfiles","header-text":a.strings.socialProfiles,"no-slide":"",toggles:!1},{default:w(()=>[p("div",O,m(a.strings.description),1),I(_,{userProfiles:f.settingsStore.userProfile.profiles,onUpdated:o[0]||(o[0]=s=>i.updateHiddenInputField(s))},null,8,["userProfiles"])]),_:1},8,["header-text"])):d("",!0)])}const j=h(R,[["render",G]]),q=()=>{const e=document.getElementById("your-profile");if(!e)return;const o=document.createElement("div");o.id="aioseo-user-profile-tab";const t=document.createElement("input");t.id="aioseo-user-social-profiles",t.name="aioseo-user-social-profiles",t.type="hidden",e.prepend(t),e.prepend(o)},z=()=>{let e=x({...j,name:"Standalone/UserProfileTab"});e=T(e),e=E(e),e=k(e),B(e),e.mount("#aioseo-user-profile-tab")};F("#your-profile","profilePageLoaded");document.addEventListener("animationstart",function(e){e.animationName==="profilePageLoaded"&&(q(),z())});
