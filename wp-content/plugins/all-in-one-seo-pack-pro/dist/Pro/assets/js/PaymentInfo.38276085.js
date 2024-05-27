import{S,r as _,o as p,c as m,g as a,a as o,x as n,w as y,b as g,B as $,d as D}from"./vue.runtime.esm-bundler.f433d23f.js";import{_ as b}from"./_plugin-vue_export-helper.3febc96a.js";import{C as x}from"./HtmlTagsEditor.7946c9f4.js";import{B as P}from"./Phone.c4929e10.js";import{d as O,i as v,u as V}from"./links.5aee9a8f.js";import{C as j}from"./ImageUploader.5f8afb8f.js";import{C as I,D as A}from"./Map.e7d16bc7.js";import{C}from"./index.8dbdb224.js";const f={computed:{getDataObject(){var l,s;const e=S(),t=O(),h=v();return((s=(l=e==null?void 0:e.root)==null?void 0:l.data)==null?void 0:s.screenContext)==="metabox"?h.currentPost.local_seo.locations.business:t.options.localBusiness.locations.business}}};const L={mixins:[f],data(){return{strings:{areaServedDescription:this.$t.__("The geographic area where a service or offered item is provided.",this.$tdPro)}}}},k={class:"field-description"};function B(e,t,h,l,s,u){const i=_("base-input");return p(),m("div",null,[a(i,{type:"text",size:"medium",modelValue:e.getDataObject.areaServed,"onUpdate:modelValue":t[0]||(t[0]=d=>e.getDataObject.areaServed=d)},null,8,["modelValue"]),o("span",k,n(s.strings.areaServedDescription),1)])}const st=b(L,[["render",B],["__scopeId","data-v-4b144b05"]]);const N={components:{CoreHtmlTagsEditor:x},mixins:[f],data(){return{strings:{streetAddress:this.$t.__("Address Line 1",this.$tdPro),streetAddress2:this.$t.__("Address Line 2",this.$tdPro),zipCode:this.$t.__("Zip Code",this.$tdPro),city:this.$t.__("City",this.$tdPro),state:this.$t.__("State",this.$tdPro),country:this.$t.__("Country",this.$tdPro),addressFormat:this.$t.__("Address Format",this.$tdPro),addressFormatDescription:this.$t.__("Use the smart tags above to define your address format (used in blocks, widgets and shortcodes).",this.$tdPro)}}}},U={class:"columns field-row aioseo-business-address"},T={class:"aioseo-col col-xs-12 text-xs-left"},z={class:"field-description"},E={class:"aioseo-col col-xs-12 text-xs-left"},K={class:"field-description"},M={class:"aioseo-address-wrapper"},F={class:"aioseo-col col-xs-12 col-sm-12 col-md-6 text-xs-left"},w={class:"field-description"},Y={class:"aioseo-col col-xs-12 col-sm-12 col-md-6 text-xs-left"},R={class:"field-description"},H={class:"aioseo-col col-xs-12 text-xs-left"},G={class:"field-description"},J={id:"aioseo-local-business-business-country",class:"aioseo-col col-xs-12 text-xs-left"},Z={class:"field-description"},W={class:"aioseo-col col-xs-12 text-xs-left address-format"},q={class:"field-description"},Q=o("span",null,null,-1),X={class:"aioseo-description"};function ee(e,t,h,l,s,u){const i=_("base-input"),d=_("base-select"),c=_("core-html-tags-editor");return p(),m("div",U,[o("div",T,[o("span",z,n(s.strings.streetAddress),1),a(i,{type:"text",size:"medium",modelValue:e.getDataObject.address.streetLine1,"onUpdate:modelValue":t[0]||(t[0]=r=>e.getDataObject.address.streetLine1=r)},null,8,["modelValue"])]),o("div",E,[o("span",K,n(s.strings.streetAddress2),1),a(i,{type:"text",size:"medium",modelValue:e.getDataObject.address.streetLine2,"onUpdate:modelValue":t[1]||(t[1]=r=>e.getDataObject.address.streetLine2=r)},null,8,["modelValue"])]),o("div",M,[o("div",F,[o("span",w,n(s.strings.zipCode),1),a(i,{type:"text",size:"medium",modelValue:e.getDataObject.address.zipCode,"onUpdate:modelValue":t[2]||(t[2]=r=>e.getDataObject.address.zipCode=r)},null,8,["modelValue"])]),o("div",Y,[o("span",R,n(s.strings.city),1),a(i,{type:"text",size:"medium",modelValue:e.getDataObject.address.city,"onUpdate:modelValue":t[3]||(t[3]=r=>e.getDataObject.address.city=r)},null,8,["modelValue"])])]),o("div",H,[o("span",G,n(s.strings.state),1),a(i,{type:"text",size:"medium",modelValue:e.getDataObject.address.state,"onUpdate:modelValue":t[4]||(t[4]=r=>e.getDataObject.address.state=r)},null,8,["modelValue"])]),o("div",J,[o("span",Z,n(s.strings.country),1),a(d,{size:"medium",options:e.$constants.COUNTRY_LIST,modelValue:this.$constants.COUNTRY_LIST.find(r=>r.value===e.getDataObject.address.country),"onUpdate:modelValue":t[5]||(t[5]=r=>e.getDataObject.address.country=r.value)},null,8,["options","modelValue"])]),o("div",W,[o("span",q,n(s.strings.addressFormat),1),a(c,{modelValue:e.getDataObject.address.addressFormat,"onUpdate:modelValue":t[6]||(t[6]=r=>e.getDataObject.address.addressFormat=r),"line-numbers":!1,checkUnfilteredHtml:"","tags-context":"addressFormat","disable-emoji":"","default-tags":["streetLineOne","streetLineTwo","zipCode","city","state","country"]},{"tags-description":y(()=>[Q]),_:1},8,["modelValue"]),o("div",X,n(s.strings.addressFormatDescription),1)])])}const ot=b(N,[["render",ee]]);const te={components:{BasePhone:P},mixins:[f],data(){return{strings:{emailAddress:this.$t.__("Email Address",this.$tdPro),phoneNumber:this.$t.__("Phone Number",this.$tdPro),faxNumber:this.$t.__("Fax Number",this.$tdPro)}}}},se={class:"aioseo-local-business-business-contact"},oe={class:"aioseo-col col-xs-12 text-xs-left"},ne={class:"field-description"},ie={id:"aioseo-local-business-phone-number",class:"aioseo-col col-xs-12 text-xs-left"},ae={class:"field-description mt-8"},re={id:"aioseo-local-business-fax-number",class:"aioseo-col col-xs-12 text-xs-left"},le={class:"field-description mt-8"};function de(e,t,h,l,s,u){const i=_("base-input"),d=_("base-phone");return p(),m("div",se,[o("div",oe,[o("span",ne,n(s.strings.emailAddress),1),a(i,{type:"text",size:"medium",modelValue:e.getDataObject.contact.email,"onUpdate:modelValue":t[0]||(t[0]=c=>e.getDataObject.contact.email=c)},null,8,["modelValue"])]),o("div",ie,[o("span",ae,n(s.strings.phoneNumber),1),a(d,{modelValue:e.getDataObject.contact.phone,"onUpdate:modelValue":t[1]||(t[1]=c=>e.getDataObject.contact.phone=c),onInputFormatted:t[2]||(t[2]=c=>e.getDataObject.contact.phoneFormatted=c)},null,8,["modelValue"])]),o("div",re,[o("span",le,n(s.strings.faxNumber),1),a(d,{modelValue:e.getDataObject.contact.fax,"onUpdate:modelValue":t[3]||(t[3]=c=>e.getDataObject.contact.fax=c),onInputFormatted:t[4]||(t[4]=c=>e.getDataObject.contact.faxFormatted=c)},null,8,["modelValue"])])])}const nt=b(te,[["render",de]]);const ce={mixins:[f],data(){return{strings:{vatID:this.$t.__("VAT ID",this.$tdPro),taxID:this.$t.__("Tax ID",this.$tdPro),chamberID:this.$t.__("Chamber of Commerce ID",this.$tdPro)}}}},pe={class:"aioseo-local-business-ids"},ue={class:"aioseo-col col-xs-12 text-xs-left"},me={class:"field-description"},_e={class:"aioseo-col col-xs-12 text-xs-left"},he={class:"field-description mt-8"};function ge(e,t,h,l,s,u){const i=_("base-input");return p(),m("div",pe,[o("div",ue,[o("span",me,n(s.strings.vatID),1),a(i,{type:"text",size:"medium",modelValue:e.getDataObject.ids.vat,"onUpdate:modelValue":t[0]||(t[0]=d=>e.getDataObject.ids.vat=d)},null,8,["modelValue"])]),o("div",_e,[o("span",he,n(s.strings.taxID),1),a(i,{type:"text",size:"medium",modelValue:e.getDataObject.ids.tax,"onUpdate:modelValue":t[1]||(t[1]=d=>e.getDataObject.ids.tax=d)},null,8,["modelValue"])])])}const it=b(ce,[["render",ge]]),$e={mixins:[f],data(){return{strings:{businessType:this.$t.__("Type",this.$tdPro)}}},methods:{getBusinessTypeOptions(e){let t=this.$constants.LOCAL_SEO_BUSINESS_TYPES.find(h=>h.value===e);return(typeof t>"u"||t.length===0)&&(t=this.$constants.LOCAL_SEO_BUSINESS_TYPES.find(h=>!!h.value)),t}}};function be(e,t,h,l,s,u){const i=_("base-select");return p(),m("div",null,[a(i,{size:"medium",options:e.$constants.LOCAL_SEO_BUSINESS_TYPES,modelValue:u.getBusinessTypeOptions(e.getDataObject.businessType),"onUpdate:modelValue":t[0]||(t[0]=d=>e.getDataObject.businessType=d.value)},null,8,["options","modelValue"])])}const at=b($e,[["render",be]]),fe={setup(){return{optionsStore:O(),postEditorStore:v()}},components:{CoreImageUploader:j},mixins:[f],data(){return{strings:{name:this.$t.__("Name",this.$tdPro)}}},watch:{"getDataObject.image"(e){if(this.$root._data.screenContext!=="metabox"){this.optionsStore.options.localBusiness.locations.business.image=e;return}this.postEditorStore.currentPost.local_seo.locations.business.image=e,this.postEditorStore.savePostState()}}};function ye(e,t,h,l,s,u){const i=_("core-image-uploader");return p(),m("div",null,[a(i,{modelValue:e.getDataObject.image,"onUpdate:modelValue":t[0]||(t[0]=d=>e.getDataObject.image=d)},null,8,["modelValue"])])}const rt=b(fe,[["render",ye]]);const Oe={setup(){return{optionsStore:O(),rootStore:V()}},components:{CoreAlert:C,CoreMap:I},mixins:[A],data(){return{place:null,placesEmbedAvailable:null,strings:{map:this.$t.__("Map",this.$tdPro),coordinates:this.$t.__("Coordinates",this.$tdPro),latitude:this.$t.__("Latitude",this.$tdPro),longitude:this.$t.__("Longitude",this.$tdPro),zoom:this.$t.__("Zoom Level",this.$tdPro),currentMarker:this.$t.__("Your current marker",this.$tdPro),address:this.$t.__("Address",this.$tdPro),phoneNumber:this.$t.__("Phone Number",this.$tdPro),website:this.$t.__("Website",this.$tdPro),placeId:this.$t.__("Place ID",this.$tdPro),description:this.$t.__("Use the map below to set your exact location. Search for an address, select a business or click anywhere to place a marker.",this.$tdPro),placeSelected:this.$t.sprintf(this.$t.__("You selected a Place (from Google Places) but your Maps Embed API is not enabled. For a more seamless experience and rich information cards please enable it in your Google Project. %1$s",this.$tdPro),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"localSeoMapEmbedApi",!0)),apiKeyInvalid:this.$t.sprintf(this.$t.__("Your API Key is invalid. Please make sure you have set your key correctly. %1$s",this.$tdPro),this.$links.getDocLink(this.$t.__("Learn more",this.$tdPro),"localSeoMapSetup",!0)),apiKeyNotSet:this.$t.__("You must first enter a Google Maps API Key for this feature to work.",this.$tdPro),apiKeyNotSetAnchor:this.$t.__("Click here to enter an API key",this.$tdPro)}}},computed:{getScreenContext(){return S().root.data.screenContext},currentMarker(){return{position:this.getCoordinates(),icon:this.getDataObject.customMarker}}},methods:{updatePlace(e){(e!=null&&e.lat||e!=null&&e.latLng)&&(this.getDataObject.mapOptions.center=e.lat?e.toJSON():e.latLng.toJSON()),this.getDataObject.placeId=e.placeId||null},getCoordinates(){return this.getDataObject.mapOptions.center.lat=parseFloat(this.getDataObject.mapOptions.center.lat),this.getDataObject.mapOptions.center.lng=parseFloat(this.getDataObject.mapOptions.center.lng),this.getDataObject.mapOptions.center}}},De={class:"local-business-map"},Se={key:0},ve=["innerHTML"],xe={key:1},Pe={key:0},Ve={key:1},je=["href"],Ie=["href"],Ae={key:2},Ce={key:0,class:"information"},Le={key:0,class:"latLng"},ke={key:1},Be={class:"map-zoom"};function Ne(e,t,h,l,s,u){const i=_("core-alert"),d=_("router-link"),c=_("core-map");return p(),m("div",De,[!l.optionsStore.options.localBusiness.maps.apiKeyValid&&l.optionsStore.options.localBusiness.maps.apiKey?(p(),m("div",Se,[a(i,{type:"yellow"},{default:y(()=>[o("div",{innerHTML:s.strings.apiKeyInvalid},null,8,ve)]),_:1})])):g("",!0),l.optionsStore.options.localBusiness.maps.apiKey?g("",!0):(p(),m("div",xe,[a(i,{type:"yellow"},{default:y(()=>[u.getScreenContext!=="metabox"?(p(),m("div",Pe,[$(n(s.strings.apiKeyNotSet)+" ",1),a(d,{to:"/maps"},{default:y(()=>[$(n(s.strings.apiKeyNotSetAnchor),1)]),_:1}),a(d,{to:"/maps",class:"no-underline"},{default:y(()=>[$(" → ")]),_:1})])):g("",!0),u.getScreenContext==="metabox"?(p(),m("div",Ve,[$(n(s.strings.apiKeyNotSet)+" ",1),o("a",{target:"_blank",href:this.rootStore.aioseo.urls.aio.localSeo+"#/maps"},n(s.strings.apiKeyNotSetAnchor),9,je),o("a",{target:"_blank",href:this.rootStore.aioseo.urls.aio.localSeo+"#/maps",class:"no-underline"}," → ",8,Ie)])):g("",!0)]),_:1})])),l.optionsStore.options.localBusiness.maps.apiKeyValid&&l.optionsStore.options.localBusiness.maps.apiKey?(p(),m("div",Ae,[a(i,{type:"blue"},{default:y(()=>[$(n(s.strings.description),1)]),_:1}),s.place?(p(),m("div",Ce,[s.place.latLng?(p(),m("div",Le,[o("div",null,[o("strong",null,n(s.strings.latitude),1),$(": "+n(s.place.latLng.lat),1)]),o("div",null,[o("strong",null,n(s.strings.longitude),1),$(": "+n(s.place.latLng.lng),1)])])):g("",!0),l.optionsStore.options.localBusiness.maps.mapsEmbedApiEnabled&&s.place.placeId?(p(),m("div",ke,[o("strong",null,n(s.strings.placeId),1),$(": "+n(s.place.placeId),1)])):g("",!0)])):g("",!0),l.optionsStore.options.localBusiness.maps.apiKeyValid&&l.optionsStore.options.localBusiness.maps.apiKey?(p(),D(c,{key:1,apiKey:l.optionsStore.options.localBusiness.maps.apiKey,options:e.getDataObject.mapOptions,placeId:e.getDataObject.placeId,marker:u.currentMarker,address:e.getDataObject.geocodeAddress,searchBox:!0,onZoomChanged:t[0]||(t[0]=r=>e.getDataObject.mapOptions.zoom=r),onClick:t[1]||(t[1]=r=>u.updatePlace(r)),onMarkerPositionChanged:t[2]||(t[2]=r=>u.updatePlace(r)),onPlaceInformation:t[3]||(t[3]=r=>s.place=r)},null,8,["apiKey","options","placeId","marker","address"])):g("",!0),o("div",Be,[o("strong",null,n(s.strings.zoom)+":",1),$(" "+n(e.getDataObject.mapOptions.zoom),1)]),this.getDataObject.placeId&&!l.optionsStore.options.localBusiness.maps.mapsEmbedApiEnabled?(p(),D(i,{key:2,type:"yellow",innerHTML:s.strings.placeSelected},null,8,["innerHTML"])):g("",!0)])):g("",!0)])}const lt=b(Oe,[["render",Ne]]);const Ue={mixins:[f],data(){return{strings:{nameDesc:this.$t.__("Your name or company name.",this.$tdPro)}}}},Te={class:"field-description"};function ze(e,t,h,l,s,u){const i=_("base-input");return p(),m("div",null,[a(i,{type:"text",size:"medium",modelValue:e.getDataObject.name,"onUpdate:modelValue":t[0]||(t[0]=d=>e.getDataObject.name=d)},null,8,["modelValue"]),o("span",Te,n(s.strings.nameDesc),1)])}const dt=b(Ue,[["render",ze],["__scopeId","data-v-b51dd7f1"]]);const Ee={mixins:[f],data(){return{currencies:this.$constants.CURRENCY_LIST,strings:{priceIndicator:this.$t.__("Price Indicator",this.$tdPro),currenciesAccepted:this.$t.__("Currencies Accepted",this.$tdPro),paymentMethods:this.$t.__("Payment Methods Accepted",this.$tdPro),selectPriceIndicator:this.$t.__("Select a price indicator...",this.$tdPro),selectCurrency:this.$t.__("Select a currency...",this.$tdPro)}}},computed:{priceIndicatorOptions(){return[{value:"$",label:"$"},{value:"$$",label:"$$"},{value:"$$$",label:"$$$"},{value:"$$$$",label:"$$$$"},{value:"$$$$$",label:"$$$$$"}]},currenciesAccepted:{get(){let e=this.getDataObject.payment.currenciesAccepted||[];return typeof e<"u"&&0<e.length&&(e=JSON.parse(e)),e},set(e){this.getDataObject.payment.currenciesAccepted=JSON.stringify(e)}}}},Ke={class:"aioseo-local-business-payment-info"},Me={class:"aioseo-col col-xs-12 text-xs-left"},Fe={class:"field-description"},we={id:"aioseo-local-business-currencies-accepted",class:"aioseo-col col-xs-12 text-xs-left"},Ye={class:"field-description mt-8"},Re={class:"aioseo-col col-xs-12 text-xs-left"},He={class:"field-description mt-8"};function Ge(e,t,h,l,s,u){const i=_("base-select"),d=_("base-input");return p(),m("div",Ke,[o("div",Me,[o("span",Fe,n(s.strings.priceIndicator),1),a(i,{size:"medium",options:u.priceIndicatorOptions,placeholder:s.strings.selectPriceIndicator,modelValue:u.priceIndicatorOptions.find(c=>c.value===e.getDataObject.payment.priceRange),"onUpdate:modelValue":t[0]||(t[0]=c=>e.getDataObject.payment.priceRange=c.value)},null,8,["options","placeholder","modelValue"])]),o("div",we,[o("span",Ye,n(s.strings.currenciesAccepted),1),a(i,{size:"medium",modelValue:u.currenciesAccepted,"onUpdate:modelValue":t[1]||(t[1]=c=>u.currenciesAccepted=c),label:"currenciesAccepted","track-by":"value",class:"aioseo-multiselect",options:s.currencies,placeholder:s.strings.selectCurrency,multiple:"","close-on-select":!1},null,8,["modelValue","options","placeholder"])]),o("div",Re,[o("span",He,n(s.strings.paymentMethods),1),a(d,{type:"text",size:"medium",modelValue:e.getDataObject.payment.methods,"onUpdate:modelValue":t[2]||(t[2]=c=>e.getDataObject.payment.methods=c)},null,8,["modelValue"])])])}const ct=b(Ee,[["render",Ge]]);export{st as L,ot as a,nt as b,it as c,at as d,rt as e,lt as f,dt as g,ct as h};
