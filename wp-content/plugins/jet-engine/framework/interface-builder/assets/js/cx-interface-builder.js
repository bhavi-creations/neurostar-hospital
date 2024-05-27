(()=>{"use strict";var t={311:t=>{t.exports=jQuery}},e={};function i(n){var a=e[n];if(void 0!==a)return a.exports;var r=e[n]={exports:{}};return t[n](r,r.exports,i),r.exports}(()=>{var t=i(311);function e(t,e,i){return(e=o(e))in t?Object.defineProperty(t,e,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[e]=i,t}function n(t){return n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},n(t)}function a(t,e){(null==e||e>t.length)&&(e=t.length);for(var i=0,n=new Array(e);i<e;i++)n[i]=t[i];return n}function r(t,e){for(var i=0;i<e.length;i++){var n=e[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,o(n.key),n)}}function o(t){var e=function(t,e){if("object"!==n(t)||null===t)return t;var i=t[Symbol.toPrimitive];if(void 0!==i){var a=i.call(t,"string");if("object"!==n(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(t)}(t);return"symbol"===n(e)?e:String(e)}var s=function(){function e(t,i,n){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,e),this.id=t,this.args=i,this.conditions=this.args.conditions,this.siblingsControls=n,this.$selector=this.getSelector(),this.$selector.data("condition-id",this.id),this.checked=!1}var i,n;return i=e,(n=[{key:"getIdParts",value:function(){return this.id.split("::")}},{key:"getSelector",value:function(){var e;if("settings"===this.args.type)e=".cx-settings."+this.args.name+', [data-content-id="#'+this.args.name+'"]';else{var i=this.getIdParts(),n=/^item-\d+$/;if(e='.cx-control[data-control-name="'+i[0]+'"]',i.length>1)for(var a=1;a<i.length;a++)e=n.test(i[a])?e+' [data-item-index="'+i[a].replace("item-","")+'"]':e+' [data-repeater-control-name="'+i[a]+'"]'}return t(e)}},{key:"getSiblingsValues",value:function(t){var e=this.getIdParts();if(e.length>1){e.splice(-1,1);var i,n=!0,r=function(t,e){var i="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!i){if(Array.isArray(t)||(i=function(t,e){if(t){if("string"==typeof t)return a(t,e);var i=Object.prototype.toString.call(t).slice(8,-1);return"Object"===i&&t.constructor&&(i=t.constructor.name),"Map"===i||"Set"===i?Array.from(t):"Arguments"===i||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i)?a(t,e):void 0}}(t))||e&&t&&"number"==typeof t.length){i&&(t=i);var n=0,r=function(){};return{s:r,n:function(){return n>=t.length?{done:!0}:{done:!1,value:t[n++]}},e:function(t){throw t},f:r}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var o,s=!0,c=!1;return{s:function(){i=i.call(t)},n:function(){var t=i.next();return s=t.done,t},e:function(t){c=!0,o=t},f:function(){try{s||null==i.return||i.return()}finally{if(c)throw o}}}}(e);try{for(r.s();!(i=r.n()).done;){var o=i.value;if(!t[o]){n=!1;break}t=t[o]}}catch(t){r.e(t)}finally{r.f()}return!!n&&t}return t}}])&&r(i.prototype,n),Object.defineProperty(i,"prototype",{writable:!1}),e}(),c={controlConditions:{},controls:window.cxInterfaceBuilder.controls||{},conditionState:window.cxInterfaceBuilder.fields||{},init:function(){var i=this;t(window).on("cx-switcher-change",(function(t){var e=t.controlName,n=t.controlStatus;i.updateConditionRules(e,n),i.renderConditionRules()})),t(window).on("cx-select-change",(function(t){var e=t.controlName,n=t.controlStatus;i.updateConditionRules(e,n),i.renderConditionRules()})),t(window).on("cx-select2-change",(function(t){var e=t.controlName,n=t.controlStatus;i.updateConditionRules(e,n),i.renderConditionRules()})),t(window).on("cx-radio-change",(function(t){var e=t.controlName,n=t.controlStatus;i.updateConditionRules(e,n),i.renderConditionRules()})),t(window).on("cx-checkbox-change",(function(t){t.controlName;var e=t.controlStatus;i.updateConditionRules(!1,e),i.renderConditionRules()})),t(window).on("cx-control-change",(function(t){var e=t.controlName,n=t.controlStatus;i.updateConditionRules(e,n),i.renderConditionRules()})),t(window).on("cx-repeater-change",(function(t){var n=t.controlName,a=t.controlStatus,r=t.action;i.updateConditionRules(n,a[n]||{}),"add"===r&&i.generateConditionRules(e({},n,i.controls[n]),a),i.renderConditionRules()})),i.generateConditionRules(i.controls,i.conditionState),i.renderConditionRules()},getControlNameParts:function(t){return t.match(/[a-zA-Z0-9_-]+|(?=\[\])/g)},generateConditionRules:function(e,i,n){var a=this;t.each(e,(function(r,o){if("repeater"===o.type&&i.hasOwnProperty(r)&&t.each(i[r],(function(t,e){var i=r+"::"+t;void 0!==n&&(i=n+"::"+i),a.generateConditionRules(o.fields,e,i)})),void 0!==o.conditions){void 0===o.conditions.__terms__&&(o.conditions=a.convertConditions(o.conditions));var c=o.name?o.name:r;void 0!==n&&(c=n+"::"+c),a.controlConditions[c]||(a.controlConditions[c]=new s(c,o,e))}}))},convertConditions:function(e){var i=this,n=[];return t.each(e,(function(t,e){var a=t.match(/([a-zA-Z0-9_-]+)?(!?)$/i),r=a[1],o=!!a[2],s=i.getCurrentValue(r);n.push({name:r,operator:i.getOperator(e,o,s),value:e})})),{__relation__:"AND",__terms__:n}},getCurrentValue:function(e,i,a,r){i=void 0!==i?i:this.controls,a=void 0!==a?a:this.conditionState,r=void 0!==r&&r;var o="",s=i[e],c="select"===s.type&&s.multiple,l="checkbox"===s.type,d="switcher"===s.type;if(r)return(c||l)&&(o=[]),d&&(o=!1),o;if(a.hasOwnProperty(e)&&(o=a[e]),l&&"object"===n(o)){var u=[];t.each(o,(function(t,e){!0!==e&&"true"!==e||u.push(t)})),o=u}return!c&&!l||Array.isArray(o)?d&&"boolean"!=typeof o&&(o=cxInterfaceBuilderAPI.utils.filterBoolValue(o)):o=[],o},updateConditionRules:function(i,n){if(!1!==i){var a=this.getControlNameParts(i);if(1<(a=a.filter((function(t){return void 0!==t&&""!==t}))).length){for(var r;void 0!==(r=a.pop());)n=e({},r,n);this.conditionState=t.extend(!0,this.conditionState,n)}else this.conditionState[a[0]]=n}else this.conditionState=t.extend(!0,this.conditionState,n)},renderConditionRules:function(){var e=this;t.each(this.controlConditions,(function(t,e){e.checked=!1})),t.each(this.controlConditions,(function(i,n){t(document).find(n.$selector).length?n.checked||(e.checkConditions(n.$selector,n.conditions,n.siblingsControls,n.getSiblingsValues(e.conditionState)),n.checked=!0):delete e.controlConditions[i]}))},checkConditions:function(e,i,n,a){var r=this,o=i.__terms__,s=o.length,c=i.__relation__?i.__relation__:"AND",l=e.hasClass("cx-ui-repeater-item-control"),d="cx-control-hidden",u=[],h=!1;switch(t.each(o,(function(i,o){var s=l?e.siblings('[data-repeater-control-name="'+o.name+'"]'):t('.cx-control[data-control-name="'+o.name+'"]'),c=s.data("condition-id"),h=!1;if(c){var p=r.controlConditions[c];p.checked||(r.checkConditions(p.$selector,p.conditions,p.siblingsControls,p.getSiblingsValues(r.conditionState)),p.checked=!0),s.hasClass(d)&&(h=!0)}var m=r.getCurrentValue(o.name,n,a,h);r.compare(m,o.operator,o.value)&&u.push(!0)})),c){case"AND":case"and":h=u.length===s;break;case"OR":case"or":h=!!u.length}h?(e.removeClass(d),e.find('[data-required="1"]').removeAttr("data-required").attr("required",!0)):(e.addClass(d),e.find("[required]").removeAttr("required").attr("data-required",1))},compare:function(e,i,a){switch(i){case"==":return e==a;case"!=":return e!=a;case"!==":return e!==a;case"in":return-1!==a.indexOf(e);case"!in":return-1===a.indexOf(e);case"contains":return-1!==e.indexOf(a);case"!contains":return-1===e.indexOf(a);case"intersect":return!!e.filter((function(t){return a.includes(t)})).length;case"!intersect":return!e.filter((function(t){return a.includes(t)})).length;case"<":return Number(e)<Number(a);case"<=":return Number(e)<=Number(a);case">":return Number(e)>Number(a);case">=":return Number(e)>=Number(a);case"length_less":return this.compare(e.length,"<",a);case"length_greater":return this.compare(e.length,">",a);case"empty":return"object"===n(e)?t.isEmptyObject(e):Array.isArray(e)?!e.length:!e;case"!empty":return!this.compare(e,"empty",null);case"regexp":return new RegExp(a,"mi").test(e);case"!regexp":return!this.compare(e,"regexp",a);default:return e===a}},getOperator:function(t,e,i){var n="==";return Array.isArray(t)&&Array.isArray(i)?n=e?"!intersect":"intersect":Array.isArray(t)?n=e?"!in":"in":Array.isArray(i)?n=e?"!contains":"contains":e&&(n="!="),n}};const l=c;var d=i(311),u={tabClass:".cx-tab",accordionClass:".cx-accordion",toggleClass:".cx-toggle",buttonClass:".cx-component__button",contentClass:".cx-settings__content",buttonActiveClass:"active",showClass:"show",localStorage:{},conditionsManager:l,init:function(){this.localStorage=this.getState()||{},this.componentInit(this.tabClass),this.componentInit(this.accordionClass),this.componentInit(this.toggleClass),this.addEvent(),this.conditionsManager.init()},addEvent:function(){d("body").off("click.cxInterfaceBuilder").on("click.cxInterfaceBuilder",this.tabClass+" "+this.buttonClass+", "+this.toggleClass+" "+this.buttonClass+", "+this.accordionClass+" "+this.buttonClass,this.componentClick.bind(this))},componentInit:function(t){var e=this,i=d(t),n=null,a=null,r=null,o="";i.each((function(i,s){switch(s=d(s),n=s.data("compotent-id"),t){case e.toggleClass:e.localStorage[n]&&e.localStorage[n].length&&(o=e.localStorage[n].join(", ")),d(e.contentClass,s).not(o).addClass(e.showClass).prevAll(e.buttonClass).addClass(e.buttonActiveClass);break;case e.tabClass:case e.accordionClass:e.localStorage[n]?(r=e.localStorage[n][0],a=d('[data-content-id="'+r+'"]',s)):(a=d(e.buttonClass,s).eq(0),r=a.data("content-id")),e.showElement(a,s,r)}}))},componentClick:function(t){var e,i=d(t.target),n=i.closest(this.tabClass+", "+this.accordionClass+", "+this.toggleClass),a=new RegExp(this.tabClass+"|"+this.accordionClass+"|"+this.toggleClass),r=n[0].className.match(a)[0].replace(" ","."),o=i.data("content-id"),s=n.data("compotent-id"),c=i.hasClass(this.buttonActiveClass);switch(r){case this.tabClass:c||(this.hideElement(n),this.showElement(i,n,o),this.localStorage[s]=new Array(o),this.setState());break;case this.accordionClass:this.hideElement(n),c?this.localStorage[s]={}:(this.showElement(i,n,o),this.localStorage[s]=new Array(o)),this.setState();break;case this.toggleClass:i.toggleClass(this.buttonActiveClass).nextAll(o).toggleClass(this.showClass),Array.isArray(this.localStorage[s])?-1!==(e=this.localStorage[s].indexOf(o))?this.localStorage[s].splice(e,1):this.localStorage[s].push(o):this.localStorage[s]=new Array(o),this.setState()}return i.blur(),!1},showElement:function(t,e,i){t.addClass(this.buttonActiveClass),e.data("content-id",i),d(i,e).addClass(this.showClass)},hideElement:function(t){var e=t.data("content-id");d('[data-content-id="'+e+'"]',t).removeClass(this.buttonActiveClass),d(e,t).removeClass(this.showClass)},getState:function(){try{return JSON.parse(localStorage.getItem("interface-builder"))}catch(t){return!1}},setState:function(){try{localStorage.setItem("interface-builder",JSON.stringify(this.localStorage))}catch(t){return!1}}};const h=u;var p=i(311);const m={switcherClass:".cx-switcher-wrap",trueClass:".cx-input-switcher-true",falseClass:".cx-input-switcher-false",init:function(){p("body").on("click.cxSwitcher",this.switcherClass,this.switchState.bind(this))},switchState:function(t){var e=p(t.currentTarget),i=p(this.trueClass,e),n=p(this.falseClass,e),a=i[0].checked,r=i.attr("name");i.prop("checked",!a),n.prop("checked",!!a),a=i[0].checked,p(window).trigger({type:"cx-switcher-change",controlName:r,controlStatus:a})}};var f=i(311);const g={inputClass:'.cx-checkbox-input[type="hidden"]:not([name*="__i__"])',itemClass:".cx-checkbox-label, .cx-checkbox-item",itemWrapClass:".cx-checkbox-item-wrap",addButtonClass:".cx-checkbox-add-button",customValueInputClass:".cx-checkbox-custom-value",init:function(){f("body").on("click.cxCheckbox",this.itemClass,this.switchState.bind(this)).on("click.cxCheckbox",this.addButtonClass,this.addCustomCheckbox.bind(this)).on("input.cxCheckbox",this.customValueInputClass,this.updateCustomValue.bind(this)),this.resetOnEditTagsPage()},switchState:function(t){var e,i=f(t.currentTarget).siblings(this.inputClass),n=f(t.target).closest(this.customValueInputClass),a=cxInterfaceBuilderAPI.utils.filterBoolValue(i.val()),r=f(t.currentTarget).closest(".cx-checkbox-group"),o=f(t.currentTarget).closest(".cx-control-checkbox"),s=!!o[0]&&o.data("control-name");n[0]||(i.val(a?"false":"true").attr("checked",!a),r[0]&&(e=cxInterfaceBuilderAPI.utils.serializeObject(r),f(window).trigger({type:"cx-checkbox-change",controlName:s,controlStatus:e})))},addCustomCheckbox:function(t){var e=f(t.currentTarget);t.preventDefault(),e.before('<div class="cx-checkbox-item-wrap"><span class="cx-label-content"><input type="hidden" class="cx-checkbox-input" checked value="true"><span class="cx-checkbox-item"><span class="marker dashicons dashicons-yes"></span></span><label class="cx-checkbox-label"><input type="text" class="cx-checkbox-custom-value cx-ui-text"></label></span></div>')},updateCustomValue:function(t){var e=f(t.currentTarget),i=e.val(),n=e.closest(".cx-checkbox-label").siblings(this.inputClass),a=e.closest(".cx-control-checkbox").data("control-name");n.attr("name",i?a+"["+i+"]":"")},resetOnEditTagsPage:function(){var t=this;if(-1!==window.location.href.indexOf("edit-tags.php")){var e=f(t.inputClass),i=[];e[0]&&(e.each((function(){"true"===f(this).val()&&i.push(f(this).attr("name"))})),f(document).ajaxComplete((function(n,a,r){if(r.data&&-1!==r.data.indexOf("action=add-tag")&&-1===a.responseText.indexOf("wp_error")){var o=f(t.customValueInputClass);o[0]&&o.closest(t.itemWrapClass).remove(),e.each((function(){-1!==i.indexOf(f(this).attr("name"))?f(this).val("true").attr("checked",!0):f(this).val("false").attr("checked",!1)}))}})))}}};var v=i(311);const x={inputClass:'.cx-radio-input:not([name*="__i__"])',customValueInputClass:".cx-radio-custom-value",init:function(){v("body").on("click.cxRadio",this.inputClass,this.switchState.bind(this)).on("input.cxRadio",this.customValueInputClass,this.updateCustomValue.bind(this)),this.resetOnEditTagsPage()},switchState:function(t){var e=v(t.currentTarget),i=v(t.currentTarget).siblings(this.customValueInputClass),n=e.attr("name");i[0]&&i.focus(),v(window).trigger({type:"cx-radio-change",controlName:n,controlStatus:v(e).val()})},updateCustomValue:function(t){var e=v(t.currentTarget),i=e.val();e.siblings(this.inputClass).attr("value",i)},resetOnEditTagsPage:function(){var t=this;if(-1!==window.location.href.indexOf("edit-tags.php")){var e=v(t.inputClass),i=[];e[0]&&(e.each((function(){v(this).prop("checked")&&i.push(v(this).attr("name")+"["+v(this).val()+"]")})),v(document).ajaxComplete((function(n,a,r){if(r.data&&-1!==r.data.indexOf("action=add-tag")&&-1===a.responseText.indexOf("wp_error")){var o=v(t.customValueInputClass);o[0]&&o.siblings(t.inputClass).val(""),e.each((function(){-1!==i.indexOf(v(this).attr("name")+"["+v(this).val()+"]")?v(this).prop("checked",!0):v(this).prop("checked",!1)}))}})))}}};var w=i(311);const C={init:function(){w("body").on("input.cxSlider change.cxSlider",".cx-slider-unit, .cx-ui-stepper-input",this.changeHandler.bind(this))},changeHandler:function(t){var e=w(t.currentTarget),i=e.val(),n=e.closest(".cx-slider-wrap"),a=e.closest(".cx-ui-container"),r=a.data("settings")||{},o=w(".cx-ui-stepper-input",a).attr("name"),s=r.range_label||!1,c=e.hasClass("cx-slider-unit")?".cx-ui-stepper-input":".cx-slider-unit";if(w(c,n).val(i),o&&w(window).trigger({type:"cx-control-change",controlName:o,controlStatus:i}),s){var l=w(".cx-slider-range-label",n),d=r.range_labels;if(0==+i)return l.html(d[+i].label),l.css("color",d[+i].color),!1;Object.keys(d).reduce((function(t,e,n,a){return+i>+t&&+i<=+e&&(l.html(d[+e].label),l.css("color",d[+e].color)),e}))}}};var b=i(311);const y={selectWrapClass:".cx-ui-select-wrapper",selectClass:'.cx-ui-select[data-filter="false"]:not([name*="__i__"])',select2Class:'.cx-ui-select[data-filter="true"]:not([name*="__i__"]), .cx-ui-select[multiple]:not([name*="__i__"])',selectClearClass:".cx-ui-select-clear",init:function(){b(this.selectRender.bind(this)),b(document).on("cx-control-init",this.selectRender.bind(this)).on("click.cxSelect",this.selectClearClass,this.clearSelect)},clearSelect:function(t){t.preventDefault();var e=b(this).siblings("select");e.find(":selected").removeAttr("selected"),e.val(null).trigger("change")},selectRender:function(t){var e=t._target?t._target:b("body");b(this.selectClass,e).each(this.selectInit.bind(this)),b(this.select2Class,e).each(this.select2Init.bind(this))},selectInit:function(t,e){var i=b(e),n=i.attr("name");i.change((function(t){b(window).trigger({type:"cx-select-change",controlName:n,controlStatus:b(t.target).val()})}))},select2Init:function(t,e){var i=b(e),n=(i.closest(this.selectWrapClass),i.attr("name")),a={placeholder:i.data("placeholder"),dropdownCssClass:"cx-ui-select2-dropdown"},r=i.data("post-type"),o=i.data("exclude"),s=i.data("action");s&&r&&(a.ajax={url:function(){return ajaxurl+"?action="+s+"&post_type="+i.data("post-type")+"&exclude="+o},dataType:"json"},a.minimumInputLength=3),i.select2(a).on("change.cxSelect2",(function(t){b(window).trigger({type:"cx-select2-change",controlName:n,controlStatus:b(t.target).val()})}))}};var _=i(311);const k={inputClass:'.cx-ui-text:not([name*="__i__"]), .cx-ui-textarea:not([name*="__i__"])',init:function(){_("body").on("input.cxText, change.cxText",this.inputClass,this.changeHandler.bind(this))},changeHandler:function(t){var e=_(t.currentTarget),i=e.attr("name");i&&_(window).trigger({type:"cx-control-change",controlName:i,controlStatus:e.val()})}};var S=i(311);const I={inputClass:'input.cx-upload-input:not([name*="__i__"])',init:function(){S(this.mediaRender.bind(this)),S(document).on("cx-control-init",this.mediaRender.bind(this)),S("body").on("change.cxMedia",this.inputClass,k.changeHandler.bind(this))},mediaRender:function(t){var e=t._target?t._target:S("body"),i=S(".cx-upload-button",e),n=function(t,e){return t.length?("both"===e.value_format?(e.multiple||(t=t[0]),t=JSON.stringify(t)):t=t.join(","),t):""},a=S("#post_ID");a.length&&wp.media.view&&wp.media.view.settings&&wp.media.view.settings.post&&!wp.media.view.settings.post.id&&(wp.media.view.settings.post.id=a.val()),i.each((function(){var t=S(this),e=t.closest(".cx-ui-media-wrap"),i={input:S(".cx-upload-input",e),img_holder:S(".cx-upload-preview",e),title_text:t.data("title"),multiple:t.data("multi-upload"),library_type:t.data("library-type"),value_format:t.data("value-format")||"id"},a=wp.media.frames.file_frame=wp.media({title:i.title_text,button:{text:i.title_text},multiple:i.multiple,library:{type:i.library_type}});e.has('input[name*="__i__"]')[0]||(t.off("click.cx-media").on("click.cx-media",(function(){return a.open(),!1})),t.data("multi-upload")&&a.on("open",(function(){var t=a.state().get("selection"),e=i.input.attr("data-ids-attr");e&&(e=e.split(",")).forEach((function(e){t.add(wp.media.attachment(e))}))})),a.on("select",(function(){var t=a.state().get("selection").toJSON(),e=0,r=[],o=[],s=S(".cx-all-images-wrap",i.img_holder),c="",l=[];t.forEach((function(e,i){!e.url&&e.id&&l.push(wp.media.attachment(e.id).fetch().then((function(e){t[i]=e})))})),Promise.all(l).then((function(){for(;t[e];){var a,l=t[e],d=l.id,u=l.url,h=l.mime,p="",m="icon";switch(a="both"===i.value_format?{id:d,url:u}:l[i.value_format],h){case"image/jpeg":case"image/png":case"image/gif":case"image/svg+xml":case"image/webp":p='<img  src="'+(void 0!==l.sizes?l.sizes.thumbnail?l.sizes.thumbnail.url:l.sizes.full.url:u)+'" alt="" data-img-attr="'+d+'">',m="image";break;case"application/pdf":p='<span class="dashicons dashicons-media-document"></span>';break;case"image/x-icon":p='<span class="dashicons dashicons-format-image"></span>';break;case"video/mpeg":case"video/mp4":case"video/quicktime":case"video/webm":case"video/ogg":p='<span class="dashicons dashicons-format-video"></span>';break;case"audio/mpeg":case"audio/wav":case"audio/ogg":p='<span class="dashicons dashicons-format-audio"></span>'}c+='<div class="cx-image-wrap cx-image-wrap--'+m+'"><div class="inner"><div class="preview-holder" data-id-attr="'+d+'" data-url-attr="'+u+'"><div class="centered">'+p+'</div></div><a class="cx-remove-image" href="#"><i class="dashicons dashicons-no"></i></a><span class="title">'+l.title+"</span></div></div>",r.push(a),o.push(d),e++}i.input.val(n(r,i)).attr("data-ids-attr",o.join(",")).trigger("change"),s.html(c)}))})),e.on("click",".cx-remove-image",(function(){return function(t){var e=t.closest(".cx-ui-media-wrap"),a=S(".cx-upload-input",e),r=t.parent().parent(".cx-image-wrap"),o=(S(".preview-holder",r).data("id-attr"),a.attr("value")),s=[];o&&(r.remove(),o=[],e.find(".cx-image-wrap").each((function(){var t=S(".preview-holder",this).data("id-attr"),e=S(".preview-holder",this).data("url-attr");switch(s.push(t),i.value_format){case"id":o.push(t);break;case"url":o.push(e);break;case"both":o.push({id:t,url:e})}})),a.attr({value:n(o,i),"data-ids-attr":s.join(",")}).trigger("change"))}(S(this)),!1})))})),i[0]&&S(".cx-all-images-wrap",e).sortable({items:"div.cx-image-wrap",cursor:"move",scrollSensitivity:40,forcePlaceholderSize:!0,forceHelperSize:!1,helper:"clone",opacity:.65,placeholder:"cx-media-thumb-sortable-placeholder",start:function(){},stop:function(){},update:function(){var t=[],e=[],i=S(this).parent().siblings(".cx-element-wrap").find("input.cx-upload-input"),a=S(this).parent().siblings(".cx-element-wrap").find("button.cx-upload-button"),r={multiple:a.data("multi-upload"),value_format:a.data("value-format")};S(".cx-image-wrap",this).each((function(){var i=S(".preview-holder",this).data("id-attr"),n=S(".preview-holder",this).data("url-attr");switch(e.push(i),r.value_format){case"id":t.push(i);break;case"url":t.push(n);break;case"both":t.push({id:i,url:n})}})),i.val(n(t,r)).attr("data-ids-attr",e.join(",")).trigger("change")}})}};var E=i(311);const A={inputClass:'input.cx-ui-colorpicker:not([name*="__i__"])',init:function(){E(this.render.bind(this)),E(document).on("cx-control-init",this.render.bind(this))},render:function(t){var e=t._target?t._target:E("body"),i=E(this.inputClass,e);i[0]&&i.wpColorPicker({change:this.changeHandler})},changeHandler:function(t,e){var i=E(t.target),n=i.attr("name");n&&setTimeout((function(){E(window).trigger({type:"cx-control-change",controlName:n,controlStatus:i.val()})}))}};var P=i(311);const B={iconSets:{},iconSetsKey:"cx-icon-sets",init:function(){P(this.setIconsSets.bind(this,window.CxIconSets)),P(this.render.bind(this)),P(document).on("cx-control-init",this.render.bind(this))},setIconsSets:function(t){var e,i=this;t&&(e=t.response?t.response.CxIconSets:t,P.each(e,(function(t,e){i.iconSets[t]=e})),i.setState(i.iconSetsKey,i.iconSets))},getIconsSets:function(){var t=this.getState(this.iconSetsKey);t&&(this.iconSets=t)},render:function(t){var e,i,n,a=t._target?t._target:P("body"),r=P('.cx-ui-iconpicker:not([name*="__i__"])',a),o=this;r[0]&&(this.getIconsSets(),r.each((function(){e=P(this),i=e.data("set"),n=o.iconSets[i],e.length&&n.icons&&e.iconpicker({icons:n.icons,iconBaseClass:n.iconBase,iconClassPrefix:n.iconPrefix,animation:!1,fullClassFormatter:function(t){return n.iconBase+" "+n.iconPrefix+t}}).on("iconpickerUpdated",(function(){P(this).trigger("change"),P(window).trigger({type:"cx-control-change",controlName:P(this).attr("name"),controlStatus:P(this).val()})})),n&&P("head").append('<link rel="stylesheet" type="text/css" href="'+n.iconCSS+'"">')})))},getState:function(t){try{return JSON.parse(window.sessionStorage.getItem(t))}catch(t){return!1}},setState:function(t,e){try{window.sessionStorage.setItem(t,JSON.stringify(e))}catch(t){return!1}}};var O=i(311);const N={container:".cx-ui-dimensions",isLinked:".cx-ui-dimensions__is-linked",units:".cx-ui-dimensions__unit",unitsInput:'input[name*="[units]"]',linkedInput:'input[name*="[is_linked]"]',valuesInput:".cx-ui-dimensions__val",init:function(){O("body").on("click",this.isLinked,{self:this},this.switchLinked).on("click",this.units,{self:this},this.switchUnits).on("input",this.valuesInput+".is-linked",{self:this},this.changeLinked)},render:function(t){},switchLinked:function(t){var e=t.data.self,i=O(this),n=i.closest(e.container),a=n.find(e.linkedInput),r=n.find(e.valuesInput),o=a.val();0===parseInt(o)?(a.val(1),i.addClass("is-linked"),r.addClass("is-linked")):(a.val(0),i.removeClass("is-linked"),r.removeClass("is-linked"))},switchUnits:function(t){var e=t.data.self,i=O(this),n=i.data("unit"),a=i.closest(e.container),r=a.find(e.unitsInput),o=a.find(e.valuesInput),s=a.data("range");i.hasClass("is-active")||(i.addClass("is-active").siblings(e.units).removeClass("is-active"),r.val(n),o.attr({min:s[n].min,max:s[n].max,step:s[n].step}))},changeLinked:function(t){var e=t.data.self,i=O(this),n=i.closest(".cx-ui-dimensions__values");O(e.valuesInput,n).val(i.val())}};var T=i(311);const R={defaultEditorSettings:{tinymce:{wpautop:!0,toolbar1:"formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,wp_adv,dfw",toolbar2:"strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help"},quicktags:{buttons:"strong,em,link,block,del,ins,img,ul,ol,li,code,more,close,dfw"},mediaButtons:!0},editorSettings:!1,init:function(){var t=this;T(window).on("load",(function(){setTimeout((function(){T(t.render.bind(t))}))})),T(document).on("cx-control-init",this.render.bind(this)),T(window).on("cx-repeater-sortable-stop",this.reInit.bind(this))},render:function(t){var e=this,i=t._target?t._target:T("body"),n=T('textarea.cx-ui-wysiwyg:not([name*="__i__"])',i);n[0]&&n.each((function(){var t=T(this),i=t.attr("id");if(!t.data("init")){void 0!==window.wp.editor.initialize?window.wp.editor.initialize(i,e.getEditorSettings()):window.wp.oldEditor.initialize(i,e.getEditorSettings());var n=window.tinymce.get(i);n&&n.on("change",(function(e){T(window).trigger({type:"cx-control-change",controlName:t.attr("name"),controlStatus:n.getContent()})})),e.addSaveTriggerOnEditTagsPage(i),t.data("init",!0)}}))},reInit:function(t){var e=this,i=t._item,n=T("textarea.wp-editor-area",i);n[0]&&n.each((function(){var t=T(this).attr("id");void 0!==window.wp.editor.initialize?(window.wp.editor.remove(t),window.wp.editor.initialize(t,e.getEditorSettings())):(window.wp.oldEditor.remove(t),window.wp.oldEditor.initialize(t,e.getEditorSettings()))}))},getEditorSettings:function(){return this.editorSettings||(this.editorSettings=this.defaultEditorSettings,window.tinyMCEPreInit&&(window.tinyMCEPreInit.mceInit&&window.tinyMCEPreInit.mceInit.cx_wysiwyg&&(this.editorSettings.tinymce=window.tinyMCEPreInit.mceInit.cx_wysiwyg),window.tinyMCEPreInit.qtInit&&window.tinyMCEPreInit.qtInit.cx_wysiwyg&&(this.editorSettings.quicktags=window.tinyMCEPreInit.qtInit.cx_wysiwyg))),this.editorSettings},addSaveTriggerOnEditTagsPage:function(t){if(-1!==window.location.href.indexOf("edit-tags.php")&&window.tinymce){var e=window.tinymce.get(t);e&&e.on("change",(function(){e.save()})),T(document).ajaxComplete((function(t,i,n){n.data&&-1!==n.data.indexOf("action=add-tag")&&-1===i.responseText.indexOf("wp_error")&&e.setContent("")}))}}};var j=i(311);const F={init:function(){this.switcher.init(),this.checkbox.init(),this.radio.init(),this.slider.init(),this.select.init(),this.media.init(),this.colorpicker.init(),this.iconpicker.init(),this.dimensions.init(),this.wysiwyg.init(),this.repeater.init(),this.text.init()},switcher:m,checkbox:g,radio:x,slider:C,select:y,media:I,colorpicker:A,iconpicker:B,dimensions:N,wysiwyg:R,repeater:{repeaterControlClass:".cx-control-repeater",repeaterContainerClass:".cx-ui-repeater-container",repeaterListClass:".cx-ui-repeater-list",repeaterItemClass:".cx-ui-repeater-item",repeaterItemHandleClass:".cx-ui-repeater-actions-box",repeaterTitleClass:".cx-ui-repeater-title",addItemButtonClass:".cx-ui-repeater-add",removeItemButtonClass:".cx-ui-repeater-remove",removeConfirmItemButtonClass:".cx-ui-repeater-remove__confirm",removeCancelItemButtonClass:".cx-ui-repeater-remove__cancel",copyItemButtonClass:".cx-ui-repeater-copy",toggleItemButtonClass:".cx-ui-repeater-toggle",minItemClass:"cx-ui-repeater-min",sortablePlaceholderClass:"sortable-placeholder",init:function(){j(this.addEvents.bind(this))},addEvents:function(){j("body").on("click",this.addItemButtonClass,{self:this},this.addItem).on("click",this.removeItemButtonClass,{self:this},this.showRemoveItemTooltip).on("click",this.removeConfirmItemButtonClass,{self:this},this.removeItem).on("click",this.removeCancelItemButtonClass,{self:this},this.hideRemoveItemTooltip).on("click",this.copyItemButtonClass,{self:this},this.copyItem).on("click",this.toggleItemButtonClass,{self:this},this.toggleItem).on("change",this.repeaterListClass+" input, "+this.repeaterListClass+" textarea, "+this.repeaterListClass+" select",{self:this},this.changeWrapperLable).on("sortable-init",{self:this},this.sortableItem),j(document).on("cx-control-init",{self:this},this.sortableItem),this.triggers()},triggers:function(t){return j("body").trigger("sortable-init"),t&&j(document).trigger("cx-control-init",{target:t}),this},addItem:function(t){var e=t.data.self,i=j(this).prev(e.repeaterListClass),n=i.data("index"),a=i.data("name"),r=wp.template(a),o=i.data("widget-id"),s={index:n},c=i.parent().closest(e.repeaterListClass);(o="__i__"!==o?o:i.attr("id"))&&(s.widgetId=o),c.length&&(s.parentIndex=parseInt(c.data("index"),10)-1),i.append(r(s)),n++,i.data("index",n),e.triggers(j(e.repeaterItemClass+":last",i)).stopDefaultEvent(t);var l=i.closest(e.repeaterControlClass);j(window).trigger({type:"cx-repeater-change",action:"add",controlName:l.data("control-name"),controlStatus:cxInterfaceBuilderAPI.utils.serializeObject(l)})},copyItem:function(t){var e,i=t.data.self,n=j(this).closest(i.repeaterItemClass),a=j(this).closest(i.repeaterListClass),r=a.parent().closest(i.repeaterListClass),o=n.data("item-index"),s=a.data("index"),c=a.data("name"),l=a.data("widget-id"),d=wp.template(c),u={index:s};(l="__i__"!==l?l:a.attr("id"))&&(u.widgetId=l),r.length&&(u.parentIndex=parseInt(r.data("index"),10)-1),e=j(d(u)),n.find(".cx-ui-repeater-item-control").each((function(){var t=j(this).data("repeater-control-name"),i=j(this).find('[name^="'+l+"[item-"+o+"]["+t+']"]');i.filter(".cx-checkbox-input, .cx-radio-input, .cx-input-switcher").length?i.each((function(){var t=j(this),i=t.prop("checked"),n=t.val(),a=t.attr("name").replace("[item-"+o+"]","[item-"+s+"]");t.hasClass("cx-checkbox-input")?e.find('[name="'+a+'"]').val(n).attr("checked",i):e.find('[name="'+a+'"][value="'+n+'"]').prop("checked",i)})):i.filter(".cx-ui-select").length?i.data("filter")?e.find('.cx-ui-select[name^="'+l+"[item-"+s+"]["+t+']"]').html(i.html()):e.find('.cx-ui-select[name^="'+l+"[item-"+s+"]["+t+']"]').val(i.val()):e.find('[name="'+l+"[item-"+s+"]["+t+']"]').val(i.val());var n=j(this).find(".cx-ui-media-wrap");if(n.length){var a=n.find(".cx-upload-preview").html();e.find('.cx-ui-repeater-item-control[data-repeater-control-name="'+t+'"] .cx-upload-preview').html(a)}})),e.find(".cx-ui-repeater-title").html(n.find(".cx-ui-repeater-title").html()),n.after(e),s++,a.data("index",s),i.triggers(e).stopDefaultEvent(t);var h=a.closest(i.repeaterControlClass);j(window).trigger({type:"cx-repeater-change",action:"add",controlName:h.data("control-name"),controlStatus:cxInterfaceBuilderAPI.utils.serializeObject(h)})},showRemoveItemTooltip:function(t){var e=t.data.self;j(this).find(".cx-tooltip").addClass("cx-tooltip--show"),e.stopDefaultEvent(t)},hideRemoveItemTooltip:function(t){var e=t.data.self;j(this).closest(".cx-tooltip").removeClass("cx-tooltip--show"),e.stopDefaultEvent(t)},removeItem:function(t){var e=t.data.self,i=j(this).closest(e.repeaterListClass);e.applyChanges(i),j(this).closest(e.repeaterItemClass).remove(),e.triggers().stopDefaultEvent(t);var n=i.closest(e.repeaterControlClass);j(window).trigger({type:"cx-repeater-change",action:"remove",controlName:n.data("control-name"),controlStatus:cxInterfaceBuilderAPI.utils.serializeObject(n)})},toggleItem:function(t){var e=t.data.self;j(this).closest(e.repeaterItemClass).toggleClass(e.minItemClass),e.stopDefaultEvent(t)},sortableItem:function(t){var e,i=t.data.self;j(i.repeaterListClass).each((function(t,n){e=j(n),j(n).data("sortable-init")?e.sortable("refresh"):e.sortable({items:i.repeaterItemClass,handle:i.repeaterItemHandleClass,cursor:"move",scrollSensitivity:40,forcePlaceholderSize:!0,forceHelperSize:!1,distance:2,tolerance:"pointer",helper:function(t,e){return e.clone().find(":input").attr("name",(function(t,e){return"sort_"+parseInt(1e5*Math.random(),10).toString()+"_"+e})).end()},start:function(t,e){j(window).trigger({type:"cx-repeater-sortable-start",_item:e.item})},stop:function(t,e){j(window).trigger({type:"cx-repeater-sortable-stop",_item:e.item})},opacity:.65,placeholder:i.sortablePlaceholderClass,create:function(){e.data("sortable-init",!0)},update:function(t,e){var n=j(t.target);i.applyChanges(n)}})}))},changeWrapperLable:function(t){var e,i,n=t.data.self,a=j(n.repeaterListClass).data("title-field"),r=j(this);if(a&&r.closest("."+a+"-wrap")[0]){if(i=r.closest(n.repeaterItemClass),"SELECT"===r[0].nodeName){var o=[];r.find("option:selected").each((function(){o.push(j(this).html())})),e=o.join(", ")}else e=r.val();j(n.repeaterTitleClass,i).html(e)}},applyChanges:function(t){return void 0!==wp.customize&&j("input[name]:first, select[name]:first",t).change(),this},stopDefaultEvent:function(t){return t.preventDefault(),t.stopImmediatePropagation(),t.stopPropagation(),this}},text:k};var V=i(311);const z={serializeObject:function(t){var e,i=this,n={},a={},r={validate:/^[a-zA-Z_][a-zA-Z0-9_-]*(?:\[(?:\d*|[a-zA-Z0-9\s_-]+)\])*$/,key:/[a-zA-Z0-9\s_-]+|(?=\[\])/g,push:/^$/,fixed:/^\d+$/,named:/^[a-zA-Z0-9\s_-]+$/};return this.build=function(t,e,i){return t[e]=i,t},this.push_counter=function(t){return void 0===a[t]&&(a[t]=0),a[t]++},e="FORM"===t[0].tagName?t.serializeArray():t.find("input, textarea, select").serializeArray(),V.each(e,(function(){var t,e,a,o;if(r.validate.test(this.name)){for(e=this.name.match(r.key),a=this.value,o=this.name;void 0!==(t=e.pop());)o=o.replace(new RegExp("\\["+t+"\\]$"),""),t.match(r.push)?a=i.build([],i.push_counter(o),a):(t.match(r.fixed)||t.match(r.named))&&(a=i.build({},t,a));n=V.extend(!0,n,a)}})),n},filterBoolValue:function(t){var e=+t;return isNaN(e)?!!String(t).toLowerCase().replace(!1,""):!!e}};var M=i(311);const L={errorMessages:{required:window.cxInterfaceBuilder.i18n.requiredError,min:window.cxInterfaceBuilder.i18n.minError,max:window.cxInterfaceBuilder.i18n.maxError,step:window.cxInterfaceBuilder.i18n.stepError},init:function(){this.isBlockEditor()?this.onBlockEditorSavePost():M("#post, #edittag, #your-profile, .cx-form").on("submit",this.onSubmitForm.bind(this)),cxInterfaceBuilderAPI.filters.addFilter("cxInterfaceBuilder/form/validation",this.requiredValidation.bind(this)),cxInterfaceBuilderAPI.filters.addFilter("cxInterfaceBuilder/form/validation",this.numberValidation.bind(this)),M(document).on("change",".cx-control input, .cx-control textarea, .cx-control select",this.removeFieldErrorOnChange.bind(this)),M(".cx-control-repeater").on("focusin",this.removeRepeaterErrorOnChange.bind(this))},isBlockEditor:function(){return M("body").hasClass("block-editor-page")},onBlockEditorSavePost:function(){var t=this,e=wp.data.dispatch("core/editor"),i=e.savePost;e.savePost=function(e){(e=e||{}).isAutosave||e.isPreview?i(e):(t.beforeValidation(),cxInterfaceBuilderAPI.filters.applyFilters("cxInterfaceBuilder/form/validation",!0,M("#editor"))?i(e):t.scrollToFirstErrorField())}},onSubmitForm:function(t){this.beforeValidation(),cxInterfaceBuilderAPI.filters.applyFilters("cxInterfaceBuilder/form/validation",!0,M(t.target))||(this.scrollToFirstErrorField(),t.preventDefault())},beforeValidation:function(){this.removeAllFieldsErrors(),void 0!==window.tinyMCE&&window.tinyMCE.triggerSave()},requiredValidation:function(t,e){if(!t)return t;var i=this,n=e.find(".cx-control-required:not(.cx-control-hidden)"),a=!1;return n.length?(n.each((function(){var t=M(this),e=t.data("control-name"),n=!1;n=t.hasClass("cx-control-checkbox")||t.hasClass("cx-control-radio")?!!t.find('[name^="'+e+'"]').filter(":checked").length:t.hasClass("cx-control-repeater")?!!t.find(".cx-ui-repeater-item").length:t.find('[name^="'+e+'"]').val(),Array.isArray(n)&&(n=!!n.length),n||(i.addFieldError(t,i.errorMessages.required),a=!0)})),!a&&t):t},numberValidation:function(t,e){if(!t)return t;if(!this.isBlockEditor())return t;var i=this,n=e.find(".cx-control-stepper:not(.cx-control-hidden), .cx-repeater-item-control-stepper:not(.cx-control-hidden)"),a=!1;return n.length?(n.each((function(){var t=M(this),e=t.find("input.cx-ui-stepper-input"),n=e.attr("min"),r=e.attr("max"),o=e.attr("step"),s=e.val();if(""!==n&&s&&Number(s)<Number(n))i.addFieldError(t,i.errorMessages.min.replace("%s",n)),a=!0;else if(""!==r&&s&&Number(s)>Number(r))i.addFieldError(t,i.errorMessages.max.replace("%s",r)),a=!0;else if(""!==o&&s){var c=function(t){var e=(""+t).match(/(?:\.(\d+))?$/);return e&&e[1]?e[1].length:0},l=c(s),d=c(o),u=l>d?l:d;0!=Math.round(s*Math.pow(10,u))%Math.round(o*Math.pow(10,u))&&(i.addFieldError(t,i.errorMessages.step.replace("%s",o)),a=!0)}})),!a&&t):t},addFieldError:function(t,e){var i=t.find(".cx-control__error");if(i.length)i.html(e);else{var n=t.hasClass("cx-ui-repeater-item-control")?".cx-ui-container":".cx-control__content";t.find(n).append('<div class="cx-control__error">'+e+"</div>")}t.addClass("cx-control--error")},removeFieldError:function(t){t.find(".cx-control__error").remove(),t.removeClass("cx-control--error")},removeFieldErrorOnChange:function(t){var e=M(t.target).closest(".cx-ui-repeater-item-control, .cx-control");e.hasClass("cx-control--error")&&this.removeFieldError(e)},removeRepeaterErrorOnChange:function(t){var e=M(t.currentTarget).closest(".cx-control");e.hasClass("cx-control--error")&&this.removeFieldError(e)},removeAllFieldsErrors:function(){var t=this,e=M(".cx-control--error");e.length&&e.each((function(){t.removeFieldError(M(this))}))},scrollToFirstErrorField:function(){var t=M(".cx-control--error").first();if(!t.is(":visible")){var e=t.closest(".cx-component");if(e.length){var i=t.closest(".cx-settings__content").attr("id");e.find('[data-content-id="#'+i+'"]').trigger("click")}var n=t.closest(".cx-ui-repeater-item.cx-ui-repeater-min");n.length&&n.find(".cx-ui-repeater-toggle").trigger("click");var a=t.closest(".postbox.closed");a.length&&a.find("button.handlediv").trigger("click")}var r=M("html, body"),o=t.offset().top,s=40;this.isBlockEditor()&&(M("body").hasClass("is-fullscreen-mode")?s+=20:s+=60,t.closest(".interface-interface-skeleton__sidebar").length?(r=M("#editor .interface-interface-skeleton__sidebar"),s+=50):r=M("#editor .interface-interface-skeleton__content"),o+=r.scrollTop()),r.stop().animate({scrollTop:o-s},500)}};var q,D=i(311),$={init:function(){this.component.init(),D(document).on("cxFramework:interfaceBuilder:component",this.component.init.bind(this.component)),this.control.init(),D(document).on("cxFramework:interfaceBuilder:control",this.control.init.bind(this.control)),this.controlValidation.init()},component:h,control:F,utils:z,controlValidation:L,filters:(q={},{addFilter:function(t,e){q.hasOwnProperty(t)||(q[t]=[]),q[t].push(e)},applyFilters:function(t,e,i){if(!q.hasOwnProperty(t))return e;void 0===i&&(i=[]);for(var n=q[t],a=n.length,r=0;r<a;r++)"function"==typeof n[r]&&(e=n[r](e,i));return e}})};window.cxInterfaceBuilderAPI=$,cxInterfaceBuilderAPI.init()})()})();