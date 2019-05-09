/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.entities = false;
	//config.entities_latin = false;
	
    config.pasteFromWordPromptCleanup = false;
    config.pasteFromWordCleanupFile = false;
    config.pasteFromWordRemoveFontStyles = false;
    config.pasteFromWordNumberedHeadingToList = false;
    config.pasteFromWordRemoveStyles = false;
    config.allowedContent=true;
    config.extraPlugins = 'tableresize';

	config.toolbar = [
					   ['Source','Preview','Templates'],
					   ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
					   ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
					   '/',
					   ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
					   ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
					   ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					   ['BidiLtr', 'BidiRtl' ],
					   ['Link','Unlink','Anchor'],
					   ['Image','Flash','Iframe','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
					   '/',
					   ['Styles','Format','Font','FontSize'],
					   ['TextColor','BGColor'],
					   ['Maximize','ShowBlocks','Syntaxhighlight']
                      ]
	config.filebrowserBrowseUrl = 'ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = 'ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
