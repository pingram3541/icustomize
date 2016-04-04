/* global wp, console */
( function( $, api ) {

	var self;

	self = {
		queriedPost: new api.Value()
	};

	/**
	 * Resizer DOM Element - On the fly
	 */
	var customizer_resizer = '<div id="customize-resizer">'+
        '<div class="control-pane">'+
            '<div class="control-editor-item editor-width" title="Editor Panel Custom Width">'+
                '<div class="control-editor-spacer"></div>'+
                '<i class="fa fa-caret-square-o-left editor"></i>'+
                '<div class="control-input-slide">'+
                    '<span class="control-input-title">Editor Custom Width (px):</span>'+
                    '<input type="number" />'+
                '</div>'+
            '</div>'+
        '</div>'+
	    '<div class="resize-pane">'+
	        '<div class="control-editor-item preview-width" title="Preview Panel Custom Width">'+
	            '<div class="control-editor-spacer"></div>'+
	            '<i class="fa fa-caret-square-o-right preview"></i>'+
	            '<div class="control-input-slide">'+
	                '<span class="control-input-title">Preview Custom Width (px):</span>'+
	                '<input type="number" />'+
	            '</div>'+
	        '</div>'+
	        //'<div class="control-editor-spacer"></div>'+
	        '<div class="control-editor-item preview-desktop" title="Full > 1240px">'+
	            '<i class="fa fa-desktop"></i>'+
	        '</div>'+
	        //'<div class="control-editor-spacer"></div>'+
	        '<div class="control-editor-item preview-laptop" title="Laptop < 1240px">'+
	            '<i class="fa fa-laptop"></i>'+
	        '</div>'+
	        //'<div class="control-editor-spacer"></div>'+
	        '<div class="control-editor-item preview-tablet" title="Tablet < 768px">'+
	            '<i class="fa fa-tablet"></i>'+
	        '</div>'+
	        //'<div class="control-editor-spacer"></div>'+
	        '<div class="control-editor-item preview-mobile" title="Mobile < 480px">'+
	            '<i class="fa fa-mobile"></i>'+
	        '</div>'+
	    '</div>'+
	'</div>';

	/**
	 * Delay Helper - keeps multiple events from firing on change, keyup etc.
	 */
	var delay = (function(){
            var timer = 0;
            return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };
        })();

	/**
	 * Listen for queried-post messages from the preview.
	 */
	api.bind( 'ready', function() {
		api.previewer.bind( 'queried-post', function( queriedPost ) {
			self.queriedPost.set( queriedPost || false ); /* Note that Value.set ignores null, hence false here. */
		} );
	} );

	/**
	 * listen for when a post is being previewed or ceases to be previewed. (fires on initial init and each page load)
	 */
	self.queriedPost.bind( function( newPost, oldPost ) {
	    var page_css_title = $('body [id^=customize-control-icustomize-page-css] .customize-control-title');
        var page_js_title = $('body [id^=customize-control-icustomize-page-js] .customize-control-title');

	    var page_css_description = $('body [id^=customize-control-icustomize-page-css] .customize-control-description');
        var page_js_description = $('body [id^=customize-control-icustomize-page-js] .customize-control-description');

	    var page_css_object = $('body [id^=customize-control-icustomize-page-css] .CodeMirror');
        var page_js_object = $('body [id^=customize-control-icustomize-page-js] .CodeMirror');

	    var page_css_editor = page_css_object[0].CodeMirror;
        var page_js_editor = page_js_object[0].CodeMirror;

		if ( newPost ) {
			if ( oldPost ) {
				//future, maybe...
			}
			
			console.log(newPost);

			//store our post id for use with update
			window.pid = newPost.ID.toString();
			window.meta = newPost.meta;
			window.theme = newPost.theme;
			
			var page_css_style = $('#customize-preview iframe').contents().find('#icustomize-page-css-' + window.theme);
            var page_js_script = $('#customize-preview iframe').contents().find('#icustomize-page-js-' + window.theme);
    
    	    var page_css = '';
            var page_js = '';

			//update our post css editor on preview readiness
			page_css = page_css_style.html();
            if(page_css){
                //update page editor from custom page css
                page_css_editor.setValue(page_css.replace(/^\s+|\s+$/g, '')); //set editor value w/out opening and closing line breaks

                //unhide and refresh contents
                if(page_css_object.hasClass('hidden')){
                    _css_title.text('Custom Page CSS');
			        post_css_description.text('Edit the page\'s custom css.').attr('style','');
                    page_css_object.removeClass('hidden');
                    page_css_editor.refresh();
                }
            } else {
                //clear page editor
                page_css_editor.setValue(''); //set editor value w/out ...loading message

                //create custom page css style object if not exist
                if(! page_css_style.length){
                    $('#customize-preview iframe').contents().find('head').append('<style id="icustomize-page-css-' + window.theme + '">');
                }

                //unhide and refresh contents
                if(page_css_object.hasClass('hidden')){
                    page_css_title.text('Custom Page CSS');
			        page_css_description.text('Edit the page\'s custom css.').attr('style','');
                    page_css_object.removeClass('hidden');
                    page_css_editor.refresh();
                }
            }

            //update our page js editor on preview readiness
            page_js = page_js_script.html();
            if(page_js){
                //update page editor from custom page js
                page_js_editor.setValue(page_js.replace(/^\s+|\s+$/g, '')); //set editor value w/out opening and closing line breaks

                //unhide and refresh contents
                if(page_js_object.hasClass('hidden')){
                    page_js_title.text('Custom Page JS');
                    page_js_description.text('Edit the page\'s custom js.').attr('style','');
                    page_js_object.removeClass('hidden');
                    page_js_editor.refresh();
                }
            } else {
                //clear page editor
                page_js_editor.setValue(''); //set editor value w/out ...loading message

                //create custom page js script object if not exist
                if(! page_js_script.length){
                    $('#customize-preview iframe').contents().find('body').append('<script id="icustomize-page-js-' + window.theme + '">');
                }

                //unhide and refresh contents
                if(page_js_object.hasClass('hidden')){
                    page_js_title.text('Custom Page JS');
                    page_js_description.text('Edit the page\'s custom js.').attr('style','');
                    page_js_object.removeClass('hidden');
                    page_js_editor.refresh();
                }
            }
		} else {
			page_css_title.text('Custom Page CSS: ERROR');
			page_css_description.text('Sorry, this is not a singular post/page template and therefore cannot store custom css, use master css instead.').attr('style','color: red;');
			page_css_object.addClass('hidden');

            page_js_title.text('Custom Page JS: ERROR');
            page_js_description.text('Sorry, this is not a singular post/page template and therefore cannot store custom js, use master js instead.').attr('style','color: red;');
            page_js_object.addClass('hidden');
		}
	} );

	/**
     * KIRKI CONTROL: CODE - override /inc/kirki/assets/js/controls/code.js
     */
    wp.customize.controlConstructor['code'] = wp.customize.Control.extend( {
    	ready: function() {
    		var control = this;
    		var element = control.container.find( '#kirki-codemirror-editor-' + control.id );

    		var editor  = CodeMirror.fromTextArea( element[0] );
    		var map = {"Alt-F": "findPersistent"};

    		editor.setOption( 'value', control.setting._value );
    		editor.setOption( 'mode', control.params.choices.language );
    		editor.setOption( 'lineNumbers', true );
    		editor.setOption( 'theme', control.params.choices.theme );
    		editor.setOption( 'height', control.params.choices.height + 'px' );
    		editor.addKeyMap(map);

            //update page value and preview upon change
    		editor.on('change', function() {
    		    if( element.attr('id') == 'kirki-codemirror-editor-icustomize-page-css-' + window.theme || element.attr('id') == 'kirki-codemirror-editor-icustomize-page-js-' + window.theme){
    		        var postData =
                    {
                        'postid' :  window.pid,
                        'theme' :   window.theme,
                        'data' :    editor.getValue(),
                    }
    		        control.setting.set( postData );
    		    } else {
    		        control.setting.set( editor.getValue() );
    		    }
    		});

    		//fix on section click, refresh cm instance
    		element.parents('.accordion-section').on('click', function(){
 		        editor.refresh();
	 		});

    	}
    });

    $(document).ready(function(){

        //editor init and update
        var customize_wrap = $('.wp-full-overlay.expanded');
        var editor_pane = $('.wp-full-overlay-sidebar');
        var preview_wrap = $('#customize-preview');
        var preview_pane = $('#customize-preview iframe');
        var master_css_editor = $('body [id^=customize-control-icustomize-master-css] .CodeMirror')[0].CodeMirror;
        var master_js_editor = $('body [id^=customize-control-icustomize-master-js] .CodeMirror')[0].CodeMirror;
        var page_css_editor = $('body [id^=customize-control-icustomize-page-css] .CodeMirror')[0].CodeMirror;
        var page_js_editor = $('body [id^=customize-control-icustomize-page-js] .CodeMirror')[0].CodeMirror;
        var master_css_style = preview_pane.contents().find('#icustomize-master-css-' + window.theme );
        var master_js_script = preview_pane.contents().find('#icustomize-master-js' + window.theme );
        var page_css_style;
        var page_js_script;


        //refresh the codemirror object
        function cmrefresh(){ //deprecated or future utility
            $('.CodeMirror').each(function(i, el){
                el.CodeMirror.refresh();
            });
        }

        //create our utility pane
        $('#customize-controls').append(customizer_resizer);

        //create our dragbar
        $("#customize-controls").prepend('<div class="dragbar"></div>');

        /**
         * Utility pane actions
         */

        //icon click
        $('body').on('click', '.control-editor-item i', function(event){
            event.stopPropagation();

            preview_pane = $('#customize-preview iframe');

            if($(event.target).parent().hasClass('active')) {
                $(event.target).parent().removeClass('active');
            } else {
                $('.control-editor-item').removeClass('active');
                $(event.target).not('.fa-desktop, .fa-laptop, .fa-tablet, .fa-mobile').parent().addClass('active');
            }

            if( $(event.target).hasClass('editor') ){

            } else if ( $(event.target).hasClass('preview') ){

            } else if ( $(event.target).hasClass('fa-desktop') ){
                preview_pane.css({ 'max-width': '' });
                $('.preview-width input').val('');
                $('#preview-resize-left').css('left', '');
            } else if ( $(event.target).hasClass('fa-laptop') ){
                preview_pane.css({ 'max-width': '1239px' });
                $('.preview-width input').val('1239');
                update_preview_pane_resize_handle();
            } else if ( $(event.target).hasClass('fa-tablet') ){
                preview_pane.css({ 'max-width': '767px' });
                $('.preview-width input').val('767');
                update_preview_pane_resize_handle();
            } else if ( $(event.target).hasClass('fa-mobile') ){
                preview_pane.css({ 'max-width': '479px' });
                $('.preview-width input').val('479');
                update_preview_pane_resize_handle();
            }
        });

        //custom preview input size change
        $('body').on('change, keyup', '.preview-width input', function(event){
            preview_pane = $('#customize-preview iframe');
            delay(function(){
                var width = $(event.target).val();
                if( width >= '0' ){
                    preview_pane.css({ 'max-width': width+'px' });
                    update_preview_pane_resize_handle();
                } else {
                    preview_pane.css({ 'max-width': '' });
                    update_preview_pane_resize_handle();
                }
            }, 500);
        });

        //custom editor input size change
        $('body').on('change, keyup', '.editor-width input', function(event){
            customize_wrap = $('.wp-full-overlay.expanded');
            editor_pane = $('.wp-full-overlay-sidebar');

            delay(function(){
                var width = $(event.target).val();

                if( width >= '0' ){
                    customize_wrap.css({ 'margin-left': width+'px' });
                    editor_pane.css({ 'width': width+'px' });
                    update_preview_pane_resize_handle();
                } else {
                    customize_wrap.css({ 'margin-left': '600px' });
                    editor_pane.css({ 'width': '600px' });
                    update_preview_pane_resize_handle();
                }
            }, 500);
        });

        $('body').on('click', '#accordion-section-icustomize_master_css h3.accordion-section-title, #accordion-section-icustomize_master_js h3.accordion-section-title, #accordion-section-icustomize_page_css h3.accordion-section-title, #accordion-section-icustomize_page_js h3.accordion-section-title', function(event){
            customize_wrap = $('.wp-full-overlay.expanded');
            editor_pane = $('.wp-full-overlay-sidebar');
            preview_pane = $('#customize-preview iframe');
            
            //hide new customizer device
            $('#customize-footer-actions').css('height', 'auto').find('.devices').addClass('hidden');

            page_css_style = preview_pane.contents().find('#icustomize-page-css-' + window.theme);
            page_js_script = preview_pane.contents().find('#icustomize-page-js-' + window.theme);

            delay(function(){
                $('body').addClass('icustomize-active');

                //check if our editor has custom size already
                if( $('.editor-width input').val() >= '0' ){
                    var e_width = $('.editor-width input').val();
                    customize_wrap.css({ 'margin-left': e_width+'px' });
                    editor_pane.css({ 'width': e_width+'px' });
                    update_preview_pane_resize_handle();
                } else {
                    customize_wrap.css({ 'margin-left': '600px' });
                    editor_pane.css({ 'width': '600px' });
                    $('.editor-width input').val('600');
                    update_preview_pane_resize_handle();
                }

                //check if our preview has custom size already
                if( $('.preview-width input').val() >= '0' ){
                    var p_width = $('.preview-width input').val();
                    preview_pane.css({ 'max-width': p_width+'px' });
                    update_preview_pane_resize_handle();
                } else {
                    preview_pane.css({ 'max-width': '' });
                    $('.preview-width input').val(preview_pane.width())
                    update_preview_pane_resize_handle();
                }

                //update selectors
                master_css_style = preview_pane.contents().find('#icustomize-master-css-' + window.theme);
                master_js_script = preview_pane.contents().find('#icustomize-master-js-' + window.theme);

                //create master css style element if not exist
                if(! master_css_style.length){
                    preview_pane.contents().find('head').append('<style id="icustomize-master-css-' + window.theme + '">');
                }

                //create master js script element if not exist
                if(! master_js_script.length){
                    preview_pane.contents().find('body').append('<script id="icustomize-master-js-' + window.theme + '">');
                }

                //update page_css control value
                var page_css = page_css_style.html();
                if(page_css){
                    page_css_editor.setValue(page_css.replace(/^\s+|\s+$/g, '')); //set editor value w/out opening and closing line breaks
                } else {
                    page_css_editor.setValue(''); //set editor value w/out ...loading

                    //create custom page css style element if not exist
                    if(! page_css_style.length){
                        preview_pane.contents().find('#icustomize-master-css-' + window.theme).after('<style id="icustomize-page-css-' + window.theme + '">');
                    }
                }

                //update page_js control value
                var page_js = page_js_script.html();
                if(page_js){
                    page_js_editor.setValue(page_js.replace(/^\s+|\s+$/g, '')); //set editor value w/out opening and closing line breaks
                } else {
                    page_js_editor.setValue(''); //set editor value w/out ...loading

                    //create custom page js script element if not exist
                    if(! page_js_script.length){
                        preview_pane.contents().find('#icustomize-master-js-' + window.theme).after('<script type="text/javascript" id="icustomize-page-js-' + window.theme + '">');
                    }
                }

            }, 100);
        });

        $('body').on('click', '#accordion-section-icustomize_master_css .customize-section-back, #accordion-section-icustomize_master_js .customize-section-back, #accordion-section-icustomize_page_css .customize-section-back, #accordion-section-icustomize_page_js .customize-section-back', function(event){
            customize_wrap = $('.wp-full-overlay.expanded');
            editor_pane = $('.wp-full-overlay-sidebar');
            
            //unhide new customizer device
            $('#customize-footer-actions').css('height', '').find('.devices').removeClass('hidden');

            $('body').removeClass('icustomize-active');
            customize_wrap.css({ 'margin-left': '' });
            editor_pane.css({ 'width': '' });
        });

        master_css_editor.on('change', function(cm, change){
            //update content after 2 seconds
            preview_pane = $('#customize-preview iframe');
            master_css_style = preview_pane.contents().find('#icustomize-master-css-' + window.theme);

            delay(function(){
                master_css_style.html(cm.getValue());
            }, 2000);
        });

        master_js_editor.on('change', function(cm, change){
            //update content after 2 seconds
            preview_pane = $('#customize-preview iframe');
            preview_pane.contents().find('#icustomize-master-js-' + window.theme).remove(); //needed to execute new js

            delay(function(){
                preview_pane.contents().find('#icustomize-page-js-' + window.theme).before('<script type="text/javascript" id="icustomize-master-js-' + window.theme + '">'+cm.getValue()+'</script>');
            }, 2000);
        });

        page_css_editor.on('change', function(cm, change){
            //update content after 2 seconds
            preview_pane = $('#customize-preview iframe');
            page_css_style = preview_pane.contents().find('#icustomize-page-css-' + window.theme);

            delay(function(){
                page_css_style.html(cm.getValue());
            }, 2000);
        });

        page_js_editor.on('change', function(cm, change){
            //update content after 2 seconds
            preview_pane = $('#customize-preview iframe');
            preview_pane.contents().find('#icustomize-page-js-' + window.theme).remove(); //needed to execute new js

            delay(function(){
                preview_pane.contents().find('#icustomize-master-js-' + window.theme).after('<script type="text/javascript" id="icustomize-page-js-' + window.theme + '">'+cm.getValue()+'</script>');
            }, 2000);
        });

        /*
         * editor pane dragbar events
         ***/
         $('#customize-controls .dragbar').on('mousedown', function(event) {
	        event.preventDefault();

	        customize_wrap = $('.wp-full-overlay.expanded');
            editor_pane = $('.wp-full-overlay-sidebar');

	        //add our temp helper
	        customize_wrap.prepend('<div id="draghelper"></div>');

	        $(document).on('mousemove', function(event){
	            if( event.pageX >= 300 && $(window).width() - event.pageX >= 200 ) {
	                customize_wrap.css('margin-left', event.pageX);
	                editor_pane.css('width', event.pageX);
	                $('.editor-width').addClass('active dragging');
	                $('.editor-width input').val(event.pageX);
	            }
			});
		});
		$(document).on('mouseup', function() {
		    preview_pane = $('#customize-preview iframe');

			$(document).unbind('mousemove');
        	$('#draghelper').remove();
        	preview_pane.css('pointer-events', '');
        	if($('.editor-width, .preview-width').hasClass('dragging')){
        	    $('#preview-resize-left, .editor-width, .preview-width').removeClass('active dragging');
        	} else {
        	    $('#preview-resize-left').removeClass('active');
        	}
        	update_preview_pane_resize_handle();
		});

		/*
         * resizable preview handle position control
         ***/
		preview_wrap.prepend('<div id="preview-resize-left"></div>');

		//init resize handle position
		update_preview_pane_resize_handle();

		//resize handle position
		function update_preview_pane_resize_handle(){

		    preview_wrap = $('#customize-preview');
		    preview_pane = $('#customize-preview iframe');
		    var pw_width = preview_wrap.width(), pp_width, ph_left;

		    if( preview_pane.css('max-width') ){
		        pp_width = parseFloat(preview_pane.css('max-width'));
		        ph_left = (pw_width - pp_width) * .5;
		    } else {
		        ph_left = 0; //um duh, can't go larger than the screen!
		    }

		    $('#preview-resize-left').css( 'left', ph_left+'px' );

		}

		/*
         * preview pane dragbar events
         ***/
         $('#preview-resize-left').on('mousedown', function(event) {
	        event.preventDefault();

	        preview_wrap = $('#customize-preview');
	        preview_pane = $('#customize-preview iframe');
	        var p_sizer = $('#preview-resize-left');

	        $(document).on('mousemove', function(event){
	            if( preview_pane.css('max-width') ) {
	                p_sizer.addClass('active');
	                preview_pane.css('pointer-events', 'none');

	                var pw_width = preview_wrap.width();

	                //show resize position
	                p_sizer.css('left', event.offsetX + 'px');

	                if(event.offsetX < 100 ){
	                    //do nothing - too small
	                } else if ( (event.offsetX * 2) < (pw_width - 200) ){
	                   var nw = pw_width - (event.offsetX *2);
	                   preview_pane.css('max-width', nw + 'px');
	                   $('.preview-width').addClass('active dragging');
	                   $('.preview-width input').val(nw);
	                } else {
	                    preview_pane.css('max-width', '100px');
	                    $('.preview-width input').val('100');
	                }

	            }
			});
		});

    });

} )( jQuery, wp.customize );