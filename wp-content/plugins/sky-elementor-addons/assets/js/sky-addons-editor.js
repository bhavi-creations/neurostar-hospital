!function(e){"use strict";elementor.hooks.addFilter("panel/elements/regionViews",(function(e){if(SkyAddonsEditorConfig.pro_installed||SkyAddonsEditorConfig.promotional_widgets<=0)return e;var t,o,n=SkyAddonsEditorConfig.promotional_widgets,i=e.elements.options.collection,s=e.categories.options.collection,r=e.categories.view,l=e.elements.view,d=[];return _.each(n,(function(e,t){i.add({name:e.name,title:e.title,icon:e.icon,categories:e.categories,editable:!1})})),i.each((function(e){"sky-elementor-addons-pro"===e.get("categories")[0]&&d.push(e)})),(o=s.findIndex({name:"sky-elementor-addons"}))&&s.add({name:"sky-elementor-addons-pro",title:"Sky Addons Pro",defaultActive:!1,items:d},{at:o+1}),t={getWedgetOption:function(e){return n.find((function(t){return t.name==e}))},className:function(){var e="elementor-element-wrapper";return this.isEditable()||(e+=" elementor-element--promotion"),e},onMouseDown:function(){this.constructor.__super__.onMouseDown.call(this);var e=this.getWedgetOption(this.model.get("name"));elementor.promotion.showDialog({title:sprintf(wp.i18n.__("%s","elementor"),this.model.get("title")),content:sprintf(wp.i18n.__("Use %s widget and dozens more pro features to extend your toolbox and build sites faster and better.","elementor"),this.model.get("title")),targetElement:this.el,position:{blockStart:"-7"},actionButton:{url:e.action_button.url,text:e.action_button.text,classes:e.action_button.classes||["elementor-button","elementor-button-success"]}})}},e.elements.view=l.extend({childView:l.prototype.childView.extend(t)}),e.categories.view=r.extend({childView:r.prototype.childView.extend({childView:r.prototype.childView.prototype.childView.extend(t)})}),e}))}(jQuery);