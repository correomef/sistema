/*Admin options pannal data value*/



function weblizar_option_data_save(name, reload) {

	reload = reload || '';

	jQuery('.switch-html').trigger( "click" );
	var weblizar_settings_save= "#weblizar_settings_save_"+name;
	var weblizar_theme_options = "#weblizar_theme_options_"+name;
	var weblizar_settings_save_success = weblizar_settings_save+"_success";
	var loding_image ="#weblizar_loding_"+name;
	var weblizar_loding_image = loding_image +"_image";
	serial = jQuery(weblizar_theme_options).serialize();
	jQuery(weblizar_loding_image).show();
	jQuery(weblizar_settings_save).val("1");
	jQuery.ajax({
		url:'themes.php?page=weblizar',
		type:'post',
		data : serial,
		success : function(data)
		{  jQuery(weblizar_loding_image).fadeOut();
			jQuery('.switch-tmce').trigger( "click" );
			jQuery(weblizar_settings_save_success).show();
			jQuery(weblizar_settings_save_success).fadeOut(5000);
			if (reload !== '') {
				location.reload();
			}
		}
	});
}
/*Admin options value reset */
function weblizar_option_data_reset(name)
{
	var r=confirm("Do you want reset your theme setting!");
	if (r===true)
		{		var weblizar_settings_save= "#weblizar_settings_save_"+name;
	var weblizar_theme_options = "#weblizar_theme_options_"+name;
	var weblizar_settings_save_reset = weblizar_settings_save+"_reset";
	jQuery(weblizar_settings_save).val("2");
	jQuery.ajax({
		url:'themes.php?page=weblizar',
		type:'post',
		data : jQuery(weblizar_theme_options).serialize(),
		success : function(data){
			jQuery(weblizar_settings_save_reset).show();
			jQuery(weblizar_settings_save_reset).fadeOut(5000);
		}
	});
} else  {
	alert("Cancel! reset theme setting process");  }
}

function cargaMapa (id) {
	jQuery(id).after('<div class="contenedorMapa"></div>');
	jQuery('.contenedorMapa').load(jQuery('#themeURL').attr('data-themeURL')+'cargaMapa.php?id="'+id+'"');
}

// js to active the link of option pannel
jQuery(document).ready(function() {

	if (jQuery('.abreMapa').length) {
		jQuery('.abreMapa').click(function(){
			cargaMapa(jQuery(this).attr('data-idInput'));
			jQuery(this).hide();
		});
	}

	jQuery('#nav > li > a').click(function(){

		if (jQuery(this).attr('class') != 'active')

			moduloActivo = jQuery(this).attr('id');
		console.log('pestaña apretada tiene el id '+ moduloActivo );
		{
			jQuery('#nav li ul').slideUp(350);
			jQuery(this).next().slideToggle(350);
			jQuery('#nav li a').removeClass('active');
			jQuery(this).addClass('active');

			jQuery('ul.options_tabs li').removeClass('active');
			jQuery(this).parent().addClass('active');
			var divid =  jQuery(this).attr("id");
			var add="div#option-"+divid;
			var strlenght = add.length;

			/*if(strlenght<17)
			{
				var add="div#option-ui-id-"+divid;
				var ulid ="#ui-id-"+divid;
				jQuery('ul.options_tabs li li ').removeClass('currunt');
				jQuery(ulid).parent().addClass('currunt');
			}	*/
			jQuery('div.ui-tabs-panel').addClass('deactive').fadeIn(300);
			jQuery('div.ui-tabs-panel').removeClass('active');
			jQuery(add).removeClass('deactive');
			jQuery(add).addClass('active');
			if (jQuery('#moduloActivo').length) {
				console.log('el input de id #moduloActivo existe asi que le bua aponer el val => '+ moduloActivo);
				jQuery('#moduloActivo').val('#'+moduloActivo);
			}
		}
	});

	jQuery('.ConfToggleHead').click(function(){
		destino = jQuery(this).attr('href');
		jQuery(destino).slideToggle();
	});

	/*activo = jQuery('#moduloActivo').val();
	jQuery(activo).trigger( "click" );*/

	function mediaupload() {
		showImg = jQuery(this).nextAll('img');

		formfield = jQuery('.upload').attr('name');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');

		uploadID= jQuery(this).parent().find('.inputUrlImagen');

		console.log('entro a media');
		window.send_to_editor = function(html) {
			jQuery('.media-item').each(function(){
				jQuery(this).prepend('<button>asd</button>');
				console.log('entrp');
			});


			imgurl = jQuery("<div>" + html + "</div>").find('img').attr('src');
			clasesImagen = jQuery("<div>" + html + "</div>").find('img').attr('class');
			console.log(clasesImagen);
			ultimaClasse = clasesImagen.toString().split(' ')[2];
			console.log(ultimaClasse);
			IDimagen = ultimaClasse.toString().split('-')[2];
			console.log(IDimagen);

			inputID = uploadID.attr('name').split('-img')[0]+'-id';

			if (jQuery('input[name="'+inputID+'"]').length) {
				console.log('SI HAY!'+inputID);
				jQuery('input[name="'+inputID+'"]').attr('value', IDimagen);
			} else{
				console.log('no hay ID');
				uploadID.after('<input type="hidden" name="'+inputID+'" value="'+IDimagen+'">');

			}
			showImg.attr('src',imgurl);

			uploadID.val(imgurl);


			tb_remove();
		};

		return false;

	}


	jQuery('.upload_image_button').click(mediaupload);

	function eliminarSlide(){
		jQuery(this).parent().slideUp();
		inputs = jQuery(this).parent().find('input');
		textareas = jQuery(this).parent().find('textarea');
		console.log(inputs);
		inputs.each(function(){
			jQuery(this).val('eliminarCampo');
		});
		textareas.each(function(){
			jQuery(this).val('eliminarCampo');
		});
	}

	function borrarInputImagen (disparador) {
		jQuery(disparador).click(function () {
			jQuery(this).offsetParent().find('input').val('');
			jQuery(this).offsetParent().find('img').attr('src','');
		});
	}

	borrarInputImagen('.borraImagen');

	jQuery('.eliminar_image_button').click(eliminarSlide);



	function activaTraduccionClon(){

		var qTranslateConfig={
			"default_language":"es",
			"language":"es",
			"url_mode":2,
			"lsb_style_wrap_class":"qtranxs-lang-switch-wrap",
			"lsb_style_active_class":"active",
			"hide_default_language":true,"custom_fields":[],"custom_field_classes":["traducir"],"homeinfo_path":"\/autogestion\/",
			"home_url_path":"\/autogestion\/",
			"flag_location":"http:\/\/ti000059.ferozo.com\/autogestion\/wp-content\/plugins\/qtranslate-x\/flags\/",
			"js":[],"language_config":{"es":{"flag":"ar.png",
			"name":"Espa\u00f1ol",
			"locale":"es_ES",
			"locale_html":"es"},"pt":{"flag":"br.png",
			"name":"Portugu\u00eas",
			"locale":"pt_PT",
			"locale_html":"pt"}},"page_config":{"pages":{"post.php":"",
			"post-new.php":"",
			"admin.php":"page=weblizar"},"anchors":{"post-body-content":{"where":"first last"},"woocommerce-product-data":{"where":"before"}},"forms":{"post":{"fields":{"title":[],"excerpt":[],"attachment_caption":[],"attachment_alt":[],"view-post-btn":{"encode":"display"},"wp-editor-area":{"jquery":".wp-editor-area"},"wp-caption-text":{"jquery":".wp-caption-text",
			"encode":"display"},"inp-variable_description":{"jquery":"textarea[name^=variable_description]"},"td-attribute_name":{"jquery":"td.attribute_name",
			"encode":"display"},"strong-attribute_name":{"jquery":"strong.attribute_name",
			"encode":"display"},"order_number":{"jquery":".order_number",
			"encode":"display"},"display_meta":{"jquery":".display_meta",
			"encode":"display"},"select-option":{"jquery":"select option",
			"encode":"display"}}},"wpbody-content":{"fields":{"wrap-h2":{"jquery":".wrap>h2",
			"encode":"display"}}}}},"LSB":true
		};



		function qtranxj_get_cookie(e){for(var n=document.cookie.split(";"),a=0;a<n.length;++a){var t=n[a],i=t.split("=");if(i[0].trim()==e&&!(n.length<2))return i[1].trim()}return""}

		function qtranxj_ce(e,n,a,t){

			var i=document.createElement(e);

			if(n)for(prop in n)i[prop]=n[prop];
			console.log(jQuery(e).attr('name'));
			if (jQuery('#'+jQuery(e).attr('name')).prev().val() !== '[' ){
				return a&&(t&&a.firstChild?a.insertBefore(i,a.firstChild):a.appendChild(i)),i
			}else{
				return i

			}
		}

		qtranxj_get_split_blocks=function(e){var n=/(<!--:[a-z]{2}-->|<!--:-->|\[:[a-z]{2}\]|\[:\]|\{:[a-z]{2}\}|\{:\})/gi;return e.xsplit(n)},

		qtranxj_split=function(e){var n=qtranxj_get_split_blocks(e);return qtranxj_split_blocks(n)},

		qtranxj_split_blocks=function(e){var n=new Object;for(var a in qTranslateConfig.language_config)n[a]="";if(!e||!e.length)return n;if(1==e.length){var t=e[0];for(var a in qTranslateConfig.language_config)n[a]+=t;return n}for(var i,r=/<!--:([a-z]{2})-->/gi,o=/\[:([a-z]{2})\]/gi,s=/\{:([a-z]{2})\}/gi,a=!1,l=0;l<e.length;++l){var t=e[l];if(t.length)if(i=r.exec(t),r.lastIndex=0,null==i)if(i=o.exec(t),o.lastIndex=0,null==i)if(i=s.exec(t),s.lastIndex=0,null==i)if("<!--:-->"!=t&&"[:]"!=t&&"{:}"!=t)if(a)n[a]?n[a]+=t:n[a]=t,a=!1;else for(var c in n)n[c]+=t;else a=!1;else a=i[1];else a=i[1];else a=i[1]}return n},

		String.prototype.xsplit=function(e){if(3==="a~b".split(/(~)/).length)return this.split(e);e.global||(e=new RegExp(e.source,"g"+(e.ignoreCase?"i":"")));for(var n,a=0,t=[];null!=(n=e.exec(this));)t.push(this.slice(a,n.index)),n.length>1&&t.push(n[1]),a=e.lastIndex;return a<this.length&&t.push(this.slice(a)),a==this.length&&t.push(""),t};

		var qTranslateX=function(e){

			var n=this;

			qTranslateConfig.qtx=this,

			this.getLanguages=function(){return qTranslateConfig.language_config},

			this.getFlagLocation=function(){return qTranslateConfig.flag_location},

			this.isLanguageEnabled=function(e){return!!qTranslateConfig.language_config[e]};

			var a=function(e){document.cookie="qtrans_edit_language="+e};

			qTranslateConfig.activeLanguage,qTranslateConfig.LSB?(qTranslateConfig.activeLanguage=qtranxj_get_cookie("qtrans_edit_language"),qTranslateConfig.activeLanguage&&this.isLanguageEnabled(qTranslateConfig.activeLanguage)||(qTranslateConfig.activeLanguage=qTranslateConfig.language,this.isLanguageEnabled(qTranslateConfig.activeLanguage)?a(qTranslateConfig.activeLanguage):qTranslateConfig.LSB=!1)):(qTranslateConfig.activeLanguage=qTranslateConfig.language,a(qTranslateConfig.activeLanguage)),

			this.getActiveLanguage=function(){return qTranslateConfig.activeLanguage},

			this.getLanguages=function(){return qTranslateConfig.language_config};

			var t={};

			this.hasContentHook=function(e){return t[e]},

			this.addContentHook=function(e,a,i){

				if(!e)return!1;switch(e.tagName){case"TEXTAREA":break;case"INPUT":switch(e.type){case"button":case"checkbox":case"password":case"radio":case"submit":return!1}break;default:return!1}if(!i){if(!e.name)return!1;i=e.name}if(e.id){if(t[e.id]){if(jQuery.contains(document,e))return t[e.id];n.removeContentHook(e)}}else if(t[i]){var r=0;do++r,e.id=i+r;while(t[i])}else e.id=i;var o=t[e.id]={};o.name=i,o.contentField=e,o.lang=qTranslateConfig.activeLanguage;var s=qtranxj_split(e.value);e.value=s[o.lang];var l;if(a)switch(a){case"slug":l="qtranslate-slugs[";break;case"term":l="qtranslate-terms[";break;default:l="qtranslate-fields["}else a="[",l="qtranslate-fields[";var c,f,g=o.name.indexOf("[");if(0>g)c=l+o.name+"]";else if(c=l+o.name.substring(0,g)+"]",o.name.lastIndexOf("[]")<0)c+=o.name.substring(g);else{var u=o.name.length-2;u>g&&(c+=o.name.substring(g,u)),f="[]"}o.fields={};

				console.log(o.name);


				for(var d in s){

					var h=s[d],
					v=c+"["+d+"]";
					f&&(v+=f);

					var C=qtranxj_ce("input",{name:v,type:"hidden",className:"hidden",value:h});
					o.fields[d]=C,
					e.parentNode.insertBefore(C,e)

				}

				switch(a){
					case"slug":
					case"term":
					o.sepfield=qtranxj_ce("input",{name:c+"[qtranslate-original-value]", type:"hidden", className:"hidden", value:s[qTranslateConfig.default_language]});
					break;
					default:
					o.sepfield=qtranxj_ce("input",{name:c+"[qtranslate-separator]", type:"hidden", className:"hidden", value:a })
				}

				console.log('tototot     '+jQuery(e).attr('name'));
				if (jQuery('#'+jQuery(e).attr('name')).prev().val() !== '[' ){
					return e.parentNode.insertBefore(o.sepfield,e),o.encode=a,e.className+=" qtranxs-translatable",o;
				}else{
					return o.encode=a,e.className+=" qtranxs-translatable",o;

				}



			},


			this.addContentHookC=function(e){return n.addContentHook(e,"[")},

			this.addContentHookB=function(e){return n.addContentHook(e,"[")},

			this.addContentHookById=function(e,a,t){return n.addContentHook(document.getElementById(e),a,t)},

			this.addContentHookByIdName=function(e){var a; switch(e[0]){case"<": case"[": a=e.substring(0,1),e=e.substring(1)}return n.addContentHookById(e,a)},

			this.addContentHookByIdC=function(e){return n.addContentHookById(e,"[")},

			this.addContentHookByIdB=function(e){return n.addContentHookById(e,"[")},

			this.addContentHooks=function(e,a,t){for(var i=0;i<e.length;++i){var r=e[i];n.addContentHook(r,a,t)}};var i=function(e,a,t){a||(a=document);var i=a.getElementsByClassName(e);n.addContentHooks(i,t)};

			this.addContentHooksByClass=function(e,n){var a;(0==e.indexOf("<")||0==e.indexOf("["))&&(a=e.substring(0,1),e=e.substring(1)),i(e,n,a)},

			this.addContentHooksByTagInClass=function(e,a,t){for(var i=t.getElementsByClassName(e),r=0;r<i.length;++r){var o=i[r],s=o.getElementsByTagName(a);n.addContentHooks(s)}};var r=function(e){if(!e)return!1;e.sepfield&&jQuery(e.sepfield).remove();for(var n in e.fields)jQuery(e.fields[n]).remove();return delete t[e.contentField.id],!0};

			this.removeContentHook=function(e){if(!e)return!1;if(!e.id)return!1;if(!t[e.id])return!1;var n=t[e.id];return r(n),jQuery(e).removeClass("qtranxs-translatable"),!0},

			this.refreshContentHook=function(e){if(!e)return!1;if(!e.id)return!1;var a=t[e.id];return a&&r(a),n.addContentHook(e)};var o=[],s=function(e){if(!e.nodeValue)return 0;var n=qtranxj_get_split_blocks(e.nodeValue);if(!n||!n.length||1==n.length)return 0;var a={};return a.nd=e,a.contents=qtranxj_split_blocks(n),e.nodeValue=a.contents[qTranslateConfig.activeLanguage],o.push(a),1},

			l=[],c=function(e){if(!e.value)return 0;var n=qtranxj_get_split_blocks(e.value);if(!n||!n.length||1==n.length)return 0;var a={};return a.nd=e,a.contents=qtranxj_split_blocks(n),e.value=a.contents[qTranslateConfig.activeLanguage],l.push(a),1};

			this.addDisplayHook=function(e){if(!e||!e.tagName)return 0;switch(e.tagName){case"TEXTAREA":return 0;case"INPUT":switch(e.type){case"submit":if(e.value)return c(e);default:return 0}}var a=0;if(e.childNodes&&e.childNodes.length)for(var t=0;t<e.childNodes.length;++t){var i=e.childNodes[t];switch(i.nodeType){case 1:a+=n.addDisplayHook(i);break;case 2:case 3:a+=s(i)}}return a},

			this.addDisplayHookById=function(e){return n.addDisplayHook(document.getElementById(e))};

			var f=function(e){
				text=e.contentField.value,
				e.wpautop&&window.switchEditors&&(text=window.switchEditors.wpautop(text)),
				e.mce.setContent(text,{format:"html"})},
				g=function(e){
					a(e);
					for(var n=o.length;--n>=0;){
						var i=o[n];
						i.nd.parentNode?i.nd.nodeValue=i.contents[e]:o.splice(n,1)
					}
					for(var n=l.length;--n>=0;){
						var i=l[n];
						i.nd.parentNode?i.nd.value=i.contents[e]:l.splice(n,1)
					}
					for(var r in t){
						var i=t[r],
						s=i.mce&&!i.mce.hidden;
						s&&i.mce.save({format:"html"}),
						i.fields[i.lang].value=i.contentField.value,
						i.lang=e;
						var c=i.fields[i.lang].value;
						i.contentField.placeholder&&""!=c&&(i.contentField.placeholder=""),
						i.contentField.value=c,
						s&&f(i)
					}
				};

				this.addDisplayHooks=function(e){for(var a=0;a<e.length;++a){var t=e[a];n.addDisplayHook(t)}},this.addDisplayHooksByClass=function(e,a){var t=a.getElementsByClassName(e);n.addDisplayHooks(t)},this.addDisplayHooksByTagInClass=function(e,a,t){for(var i=t.getElementsByClassName(e),r=0;r<i.length;++r){var o=i[r],s=o.getElementsByTagName(a);n.addDisplayHooks(s)}},this.addCustomContentHooks=function(){for(var e=0;e<qTranslateConfig.custom_fields.length;++e){var a=qTranslateConfig.custom_fields[e];n.addContentHookByIdName(a)} for(var e=0;e<qTranslateConfig.custom_field_classes.length;++e){console.log(qTranslateConfig.custom_field_classes[e]);var a=qTranslateConfig.custom_field_classes[e];n.addContentHooksByClass(a) } qTranslateConfig.LSB&&setTinyMceInit()};

				var u=function(e){e(".i18n-multilingual").each(function(e,a){n.addContentHook(a,"[")}),e(".i18n-multilingual-curly").each(function(e,a){n.addContentHook(a,"{")}),e(".i18n-multilingual-term").each(function(e,a){n.addContentHook(a,"term")}),e(".i18n-multilingual-slug").each(function(e,a){n.addContentHook(a,"slug")}),e(".i18n-multilingual-display").each(function(e,a){n.addDisplayHook(a)})},

				d=function(e){for(var a in e){var t,i=e[a];if(i.form){if(i.form.id)t=document.getElementById(i.form.id);else if(i.form.jquery)t=$(i.form.jquery);else if(i.form.name){var r=document.getElementsByName(i.form.name);r&&r.length&&(t=r[0])}}else t=document.getElementById(a);t||(t=v(),t||(t=document));for(var o in i.fields){var s=i.fields[o],l=[];if(s.container_id){var c=document.getElementById(s.container_id);c&&l.push(c)}else s.container_jquery?l=$(s.container_jquery):s.container_class?l=document.getElementsByClassName(s.container_class):l.push(t);var f=s.encode;switch(f){case"none":continue;case"display":if(s.jquery)for(var g=0;g<l.length;++g){var c=l[g],u=jQuery(c).find(s.jquery);n.addDisplayHooks(u)}else{var d=s.id?s.id:o;n.addDisplayHook(document.getElementById(d))}break;case"[":case"<":case"{":case"byline":default:if(s.jquery)for(var g=0;g<l.length;++g){var c=l[g],u=jQuery(c).find(s.jquery);n.addContentHooks(u,f,s.name)}else{var d=s.id?s.id:o;n.addContentHookById(d,f,s.name)}}}}},
				h=function(){function e(e){var n=e.id;if(n){var a=t[n];if(a&&!a.mce){a.mce=e,e.getContainer().className+=" qtranxs-translatable",e.getElement().className+=" qtranxs-translatable";var i=a.updateTinyMCEonInit;if(null==i){var r=e.getContent({format:"html"}).replace(/\s+/g,""),o=a.contentField.value.replace(/\s+/g,"");i=r!=o}return i&&f(a),a}}}

				setTinyMceInit=function(){if(window.tinyMCE)for(var n in t){var a=t[n];if("TEXTAREA"===a.contentField.tagName&&!a.mce&&!a.mceInit&&tinyMCEPreInit.mceInit[n]){if(a.mceInit=tinyMCEPreInit.mceInit[n],a.mceInit.wpautop){a.wpautop=a.mceInit.wpautop;var i=tinymce.DOM.select("#wp-"+n+"-wrap");i&&i.length&&(a.wrapper=i[0],a.wrapper&&(tinymce.DOM.hasClass(a.wrapper,"tmce-active")&&(a.updateTinyMCEonInit=!0),tinymce.DOM.hasClass(a.wrapper,"html-active")&&(a.updateTinyMCEonInit=!1)))}else a.updateTinyMCEonInit=!1;

				tinyMCEPreInit.mceInit[n].init_instance_callback=function(n){e(n)}}}},

				setTinyMceInit(),loadTinyMceHooks=function(){if(window.tinyMCE&&tinyMCE.editors)for(var n=0;n<tinyMCE.editors.length;++n){var a=tinyMCE.editors[n];e(a)}},

				window.addEventListener("load",loadTinyMceHooks)};

				qTranslateConfig.onTabSwitchFunctions||(qTranslateConfig.onTabSwitchFunctions=[]),qTranslateConfig.onTabSwitchFunctionsSave||(qTranslateConfig.onTabSwitchFunctionsSave=[]),qTranslateConfig.onTabSwitchFunctionsLoad||(qTranslateConfig.onTabSwitchFunctionsLoad=[]),

				this.addLanguageSwitchListener=function(e){qTranslateConfig.onTabSwitchFunctions.push(e)},

				this.addLanguageSwitchBeforeListener=function(e){qTranslateConfig.onTabSwitchFunctionsSave.push(e)},

				this.delLanguageSwitchBeforeListener=function(e){for(var n=0;n<qTranslateConfig.onTabSwitchFunctionsSave.length;++n){var a=qTranslateConfig.onTabSwitchFunctionsSave[n];if(a==e)return void qTranslateConfig.onTabSwitchFunctionsSave.splice(n,1)}},

				this.addLanguageSwitchAfterListener=function(e){qTranslateConfig.onTabSwitchFunctionsLoad.push(e)},

				this.delLanguageSwitchAfterListener=function(e){for(var n=0;n<qTranslateConfig.onTabSwitchFunctionsLoad.length;++n){var a=qTranslateConfig.onTabSwitchFunctionsLoad[n];if(a==e)return void qTranslateConfig.onTabSwitchFunctionsLoad.splice(n,1)}},

				this.enableLanguageSwitchingButtons=function(e){var n=e?"block":"none";for(var a in qTranslateConfig.tabSwitches){for(var t=qTranslateConfig.tabSwitches[a],i=0;i<t.length;++i){var r=(t[i],t[i].parentElement);r.style.display=n;break}break}};

				var v=function(){for(var e=document.getElementsByClassName("wrap"),n=0;n<e.length;++n){var a=e[n],t=a.getElementsByTagName("form");if(t.length)return t[0]}var t=document.getElementsByTagName("form");if(1===t.length)return t[0];for(var n=0;n<t.length;++n){var i=t[n];if(e=i.getElementsByClassName("wrap"),e.length)return i}return null};

				if("function"==typeof e.addContentHooks&&e.addContentHooks(this),qTranslateConfig.page_config&&qTranslateConfig.page_config.forms&&d(qTranslateConfig.page_config.forms),u(jQuery),!o.length&&!l.length){var C=!1;for(var m in t){C=!0;break}if(!C)return}

				this.switchActiveLanguage=function(){var e=this,n=e.lang;if(!n)return void alert("qTranslate-X: This should not have happened: Please, report this incident to the developers: !lang");if(qTranslateConfig.activeLanguage!==n){if(qTranslateConfig.activeLanguage){for(var a=!0,t=qTranslateConfig.onTabSwitchFunctionsSave,i=0;i<t.length;++i){var r=t[i].call(qTranslateConfig.qtx,qTranslateConfig.activeLanguage,n);r===!1&&(a=!1)}if(!a)return;for(var o=qTranslateConfig.tabSwitches[qTranslateConfig.activeLanguage],i=0;i<o.length;++i)o[i].classList.remove(qTranslateConfig.lsb_style_active_class)}var s=qTranslateConfig.activeLanguage;qTranslateConfig.activeLanguage=n;for(var o=qTranslateConfig.tabSwitches[qTranslateConfig.activeLanguage],i=0;i<o.length;++i)o[i].classList.add(qTranslateConfig.lsb_style_active_class);for(var l=qTranslateConfig.onTabSwitchFunctions,i=0;i<l.length;++i)l[i].call(qTranslateConfig.qtx,n,s);for(var c=qTranslateConfig.onTabSwitchFunctionsLoad,i=0;i<c.length;++i)c[i].call(qTranslateConfig.qtx,n,s)}};

				var q=function(){var e=qtranxj_ce("ul",{className:qTranslateConfig.lsb_style_wrap_class}),n=qTranslateConfig.language_config;qTranslateConfig.tabSwitches||(qTranslateConfig.tabSwitches={});for(var a in n){var t=n[a],i=qTranslateConfig.flag_location,r=qtranxj_ce("li",{lang:a,className:"qtranxs-lang-switch",onclick:qTranslateConfig.qtx.switchActiveLanguage},e);qtranxj_ce("img",{src:i+t.flag},r),qtranxj_ce("span",{innerHTML:t.name},r),qTranslateConfig.activeLanguage==a&&r.classList.add(qTranslateConfig.lsb_style_active_class),qTranslateConfig.tabSwitches[a]||(qTranslateConfig.tabSwitches[a]=[]),qTranslateConfig.tabSwitches[a].push(r)}return e},

				T=function(e){var n=document.getElementById("qtranxs-meta-box-lsb");if(n){var a=n.getElementsByClassName("inside");if(a.length){n.className+=" closed",e(n).find(".hndle").remove();var t=document.createElement("span");n.insertBefore(t,a[0]),t.className="hndle ui-sortable-handle";var i=q();t.appendChild(i),e(function(e){e("#qtranxs-meta-box-lsb .hndle").unbind("click.postboxes")})}}};

				if(qTranslateConfig.LSB){
					h(),T(jQuery);var p=[];if(qTranslateConfig.page_config&&qTranslateConfig.page_config.anchors)for(var y in qTranslateConfig.page_config.anchors){var w=qTranslateConfig.page_config.anchors[y],b=document.getElementById(y);if(b)p.push({f:b,where:w.where});else if(w.jquery)for(var _=jQuery(w.jquery),k=0;k<_.length;++k){var b=_[k];p.push({f:b,where:w.where})}}if(!p.length){var b=e.langSwitchWrapAnchor;b||(b=v()),b&&p.push({f:b,where:"before"})}for(var k=0;k<p.length;++k){var w=p[k];if(!w.where||w.where.indexOf("before")>=0){var x=q();w.f.parentNode.insertBefore(x,w.f)}if(w.where&&w.where.indexOf("after")>=0){var x=q();w.f.parentNode.insertBefore(x,w.f.nextSibling)}if(w.where&&w.where.indexOf("first")>=0){var x=q();w.f.insertBefore(x,w.f.firstChild)}if(w.where&&w.where.indexOf("last")>=0){var x=q();w.f.insertBefore(x,null)}}this.addLanguageSwitchListener(g),e.onTabSwitch&&this.addLanguageSwitchListener(e.onTabSwitch)}
				};

				qTranslateConfig.js.get_qtx=function(){return qTranslateConfig.qtx||new qTranslateX(qTranslateConfig.js),qTranslateConfig.qtx},


				jQuery(document).ready(qTranslateConfig.js.get_qtx);


				jQuery(document).ready(function(e){var a,n,t,r,l,i,s,h,d=qTranslateConfig.js.get_qtx(),o=function(e,a){switch(qTranslateConfig.url_mode.toString()){case"1":e.search?e.search+="&lang="+a:e.search="?lang="+a;break;case"2":var n=qTranslateConfig.home_url_path,t=e.pathname;"/"!=t[0]&&(t="/"+t);var r=t.indexOf(n);r>=0&&(e.pathname=qTranslateConfig.homeinfo_path+a+t.substring(r+n.length-1));break;case"3":e.host=a+"."+e.host;break;case"4":e.host=qTranslateConfig.domains[a]}},c=function(d){if(!a){var c=document.getElementById("view-post-btn");if(!c||!c.children.length)return;if(a=c.children[0],"A"!=a.tagName)return;n=a.href,t=qtranxj_ce("a",{}),r=n.search(/\?/)>0}t.href=n,o(t,d),a.href=t.href;var g=document.getElementById("preview-action");if(g&&g.children.length&&(g.children[0].href=t.href),1!=qTranslateConfig.url_mode){if(!l){var f=document.getElementById("sample-permalink");f&&f.offsetHeight>0&&f.childNodes.length&&(l=f.childNodes[0],i=l.nodeValue)}l&&(t.href=i,o(t,d),l.nodeValue=t.href)}else h||(e("#sample-permalink").append('<span id="sample-permalink-lang-query"></span>'),h=e("#sample-permalink-lang-query")),h&&h.text((n.search(/\?/)<0?"/?lang=":"&lang=")+d);s||(s=document.getElementById("wp-admin-bar-view")),s&&s.children.length&&(s.children[0].href=a.href)},g=jQuery("#title"),f=jQuery("#title-prompt-text"),m=function(e){var a=g.attr("value");a?f.addClass("screen-reader-text"):f.removeClass("screen-reader-text")};d.addCustomContentHooks(),c(d.getActiveLanguage()),d.addLanguageSwitchAfterListener(c),f&&g&&d.addLanguageSwitchAfterListener(m)});
			}








			jQuery('.agregarNuevoCONPARAMETROS').click(function () {
				var padre = '#'+jQuery(this).parent().attr('id');

				var entradas = jQuery(padre + ' > div').not('.modeloClon');

				clonBase = jQuery(padre + ' .modeloClon');

				clonBaseHtml = clonBase.clone(true);


				if (entradas.length > 1) {
					var mayor = 0;

					entradas.each(function(index, el) {
						idEnArray = jQuery(this).attr('id').split('_');
						numero = idEnArray[idEnArray.length - 1];
						if (numero > mayor) {
							mayor = numero;
							ultimaEntrada = jQuery(this);
						}
					});
				}else{
					ultimaEntrada = clonBase.prev();
				}


				ultimoID = ultimaEntrada.attr('id').split('_');
				numeroAnteriro = ultimoID[ultimoID.length - 1];
				ultimoID.pop();
				base = ultimoID.join('_');
				nuevoID = parseInt(numeroAnteriro) + 1;

				ultimoIndex = entradas.last().attr('data-index');
				nuevoIndex = parseInt(ultimoIndex) + 1;

				clonBaseHtml.attr('id', base + '_' + nuevoID);
				clonBaseHtml.attr('data-index', nuevoIndex);

				h2Clon = clonBaseHtml.find('h2');
				h2Base = h2Clon.text().split('HHH')[0];
				h2Clon.text(h2Base + ' ' + nuevoIndex);


				clonBase.before(clonBaseHtml);



				jQuery('#'+base +'_'+ nuevoID).html(
					function (index, html) {
						return html.replace(/\HHH/g, nuevoID);
					}
					);

				botonImagen = ultimaEntrada.find('.upload_image_button').each(function (index, item) {
					console.log('index = ' + index + '; item = ' + item);
					var a = jQuery(this).clone(true)
					var b = jQuery(padre + ' #' + base + '_' + nuevoID + ' .parametro_imagen img').eq(index).before(a);
					console.log(b);
			//b.before(a);
		});
				jQuery(padre + ' #' + base + '_' + nuevoID).

				append(jQuery('.eliminar_image_button').first().clone(true));
				jQuery(padre + ' #' + base + '_' + nuevoID).removeClass('modeloClon');

		// activaTraduccionClon()


	});

			jQuery('.agregarNuevo').click(function(){


				padre =  jQuery(this).parent();
				padreID = padre.attr('id');

				console.log(padreID);

				seccion = padre.attr('id');

				ultimoDiv = jQuery('#' + padreID + '> div').last();

				var esVisible= false;

				while (!esVisible){

					if (ultimoDiv.css('display') === 'none') {
						ultimoDiv = ultimoDiv.prev();
					}else{
						esVisible = true;
					}
				}

				if (ultimoDiv.length && esVisible) {

					if ( isNaN(parseInt(ultimoDiv.attr('data-i')))) {
						i=1;
					} else{
						i = parseInt(ultimoDiv.attr('data-i')) + 1;
					}


					anterior = ultimoDiv.attr('id').split('_');
					ID = 's_'+(parseInt(anterior[1]) + 1);

					console.log(ID);
					console.log(anterior);

				}else{
					i=1;
					ID = 's_1';
					console.log('SI');
				}



				clonSlider = '<div class="section celda col3" data-i="'+i+'" id="'+ID+'"> <input class="inputUrlImagen" type="text" value=""  name="'+seccion+'-'+ID+'-img"> <input type="button" id="upload_button" value="Cargar Slide '+i+'" class="upload_image_button"> <div> <label>Titulo: </label> <input class="traducir" type="text" value="" id="'+seccion+'-'+ID+'-titulo" name="'+seccion+'-'+ID+'-titulo"> </div> <div> <label>Descripcion: </label> <input class="traducir" type="text" value="" id="'+seccion+'-'+ID+'-descripcion" name="'+seccion+'-'+ID+'-descripcion"> </div> <div> <label>Link del slide: </label> <input type="text" value="" id="'+ID+'" name="'+seccion+'-'+ID+'-link"> </div> <input type="button" id="upload_button'+i+'" value="Eliminar" class="eliminar_image_button" /> <img style="max-width:100%;" src=""> </div> ';


				clonMetodoENvio = '<div class="section" id="'+ seccion +'-'+i+'" data-i="'+i+'"> <h2>Tipo de Envio '+i+'</h2> <h3>Nombre</h3> <input class="weblizar_inpute"  type="text" name="'+ seccion +'-'+i+'" id="'+ seccion +'-'+i+'" value="" > <h3>Imagen</h3> <div> <input class="inputUrlImagen" type="text" id="'+ seccion +'-'+i+'-img" name="'+ seccion +'-'+i+'-img" class="upload has-file" value=""/> <input type="button" id="upload_button" value="Cargar Imagen del tipo" class="upload_image_button" /> <img style="max-width:100%" src="" /> </div> <h3>Costo</h3> <input class="weblizar_inpute AdminCostoEnvio"  type="text" name="'+ seccion +'-'+i+'-costo" id="'+ seccion +'-'+i+'-costo" value="" > <h3>Tiempo</h3> <input class="weblizar_inpute"  type="text" name="'+ seccion +'-'+i+'-tiempo" id="'+ seccion +'-'+i+'-tiempo" value="" > <h3>Descripcion</h3> <input class="weblizar_inpute"  type="text" name="'+ seccion +'-'+i+'-descripcion" id="'+ seccion +'-'+i+'-descripcion" value="" > <h3>Volumen</h3> <input class="weblizar_inpute"  type="text" name="'+ seccion +'-'+i+'-volumen" id="metodoEnvio-andreani-volumen" value="" ><h3>Sucursales</h3><textarea cols="30" rows="10" name="'+ seccion +'-'+i+'-sucursales id="'+ seccion +'-'+i+'-sucursales"></textarea></div>';

				clonPasos = '<div class="section" id="'+ seccion +'-'+i+'" data-i="'+i+'"> <h2>Paso '+i+'</h2> <div class="celda section"><h3>Titulo español</h3> <div> <input class="inputUrlImagen" type="text" value="" id="'+ seccion +'-'+i+'-img-es" name="'+ seccion +'-'+i+'-img-es" class="upload has-file"/> <input type="button" id="upload_button" value="Cargar Titulo" class="upload_image_button" /> <img style="max-width:100%" src="" /> </div></div> <div class="celda section"><h3>Titulo portugues</h3> <div> <input class="inputUrlImagen" type="text" value="" id="'+ seccion +'-'+i+'-img-pt" name="'+ seccion +'-'+i+'-img-pt" class="upload has-file"/> <input type="button" id="upload_button" value="Cargar titulo" class="upload_image_button" /> <img style="max-width:100%" src="" /> </div></div> <h3>Detalle del paso español</h3> <textarea name="'+ seccion +'-'+i+'-detalle-es" id="'+ seccion +'-'+i+'-detalle-es" cols="30" rows="10"></textarea> <h3>Detalle del paso portugues</h3> <textarea name="'+ seccion +'-'+i+'-detalle-pt" id="'+ seccion +'-'+i+'-detalle-pt" cols="30" rows="10"></textarea> </div>';

				if (padreID === 'CarroDeCompras-metodosDeEnvio') {

					jQuery(this).before(clonMetodoENvio);
				}
				else if (padreID === 'Como-Comprar-paso' || padreID === 'Preguntas-Frecuentes' || padreID === 'formas-de-envio') {

					jQuery(this).before(clonPasos);
				}
				else{
					jQuery(this).before(clonSlider);

				}

		/*jQuery('.AdminCostoEnvio').keyup(function(e){

			if (e.which === 188) {
				console.log(e.which);
				anterior = jQuery(this).val();
				nuevo = anterior.toString().replace(/\,/g,'.');
				jQuery(this).val(nuevo);
			}
		});*/

		/*$('.AdminCostoEnvio').keydown(function (e) {
		        // Allow: backspace, delete, tab, escape, enter and .
		        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		             // Allow: Ctrl+A, Command+A
		            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
		             // Allow: home, end, left, right, down, up
		            (e.keyCode >= 35 && e.keyCode <= 40)) {
		                 // let it happen, don't do anything
		                 return;
		        }
		        // Ensure that it is a number and stop the keypress
		        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		            e.preventDefault();
		        }

        		jQuery(this).keyup(function(e){

        			if (e.which === 188) {
        				console.log(e.which);
        				anterior = jQuery(this).val();
        				nuevo = anterior.toString().replace(/\,/g,'.');
        				jQuery(this).val(nuevo);
        			}
        		});
        	});*/


        	jQuery('.upload_image_button').click(mediaupload);
        	jQuery('.eliminar_image_button').click(eliminarSlide);

        	jQuery('.qtranxs-lang-switch-wrap').first().remove();

        	wpurl = jQuery('#wp-admin-bar-site-name a').attr('href');

        	anchorete = 'inicio-slide-'+ID+'-titulo';


		// activaTraduccionClon()

	});

jQuery('.ConfBody').each(function(){

	jQuery(this).sortable({
		items: '.ordenable',
		cursor: 'move',
		scrollSensitivity: 40,
		forcePlaceholderSize: true,
		forceHelperSize: true,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'wc-metabox-sortable-placeholder',
		start: function( event, ui ) {
			var contenedor = jQuery(this);
			var ordenables = contenedor.children('.ordenable').not('.modeloClon');

			ordenables.css({

				'display': 'inline-block',
			});
			ui.item.css( {
				'background-color': '#f6f6f6',
			});
			contenedor.find('.agregarNuevoCONPARAMETROS').remove();
			contenedor.find('.agregarNuevo').remove();
			if(jQuery('#kkk').length == 0){
				contenedor.append('<div class="botonRojo" id="kkk">Guardar y Recargar</div>');
			}

		},
		stop: function( event, ui ) {
			jQuery('#kkk').on('click',function(){
				weblizar_option_data_save('general','reloadPage');
			});
			ui.item.removeAttr( 'style' );
			var contenedor = jQuery(this);
			contenedor.children('.ordenable').removeAttr( 'style' );
		}
	});
});






});

