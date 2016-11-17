CKEDITOR.plugins.add('autocomplete',
				{
					state: 0,
					selected:"",
					init : function(editor) {
						
					},
					validate: function(editor){
						//Get selected user
						if($("#suggestionusers > .useroptionselected").length){
							id = $("#suggestionusers > .useroptionselected").data("id");
							name = $("#suggestionusers > .useroptionselected").data("name");
							editor.insertHtml("###@@@@####");
							var findString = "@[^@]*###@@@@####";
							var regEx = new RegExp(findString, "ig");
							var rnd = Math.floor((Math.random() * 10000) + 1);
							newTXT = editor.getData().replace(regEx,"<SPAN class=usertag contenteditable='false' id='alert"+rnd+"' data-sent=\"0\" data-id="+id+" >@&nbsp;"+name.replace(/\s/g, '&nbsp;')+"</SPAN>&nbsp;");
							//var book = editor.getSelection().createBookmarks2();
							editor.setData(newTXT);
							//editor.getSelection().selectBookmarks( book);
							var range = editor.createRange();
							var node = editor.document.getById( 'alert'+rnd );
							range.moveToPosition( node,CKEDITOR.POSITION_AFTER_END);
							range.select();
						}
						editor.plugins.autocomplete.selected = "";editor.plugins.autocomplete.state = 0;$("#suggestionusers").remove(); // END COMPLETION
					},
					afterInit : function(editor) {
						editor.on('blur', function(evt){
							switch(editor.plugins.autocomplete.state){
							case 1:
								editor.plugins.autocomplete.selected = "";editor.plugins.autocomplete.state = 0;$("#suggestionusers").remove(); // END COMPLETION
							}							
						});
						
						editor.on("key", function (evt){
							//console.log("KEY:"+evt.data.keyCode+"="+String.fromCharCode(evt.data.keyCode)+ "STATE:"+editor.plugins.autocomplete.state);
							switch(editor.plugins.autocomplete.state){
								case 1: // Completion started
									switch(evt.data.keyCode){
										case 13: //Enter
											editor.plugins.autocomplete.validate(editor);
											evt.cancel();evt.stop();
										break;
										case 40: // up & down arrows
										case 38:
											var sel = $("#suggestionusers > .useroptionselected");
											var newSel=null;
											if(evt.data.keyCode == 40) newSel = sel.next(".usersoption");
											else newSel = sel.prev(".usersoption");											
											if(newSel.length==1){
													sel.removeClass("useroptionselected");
													newSel.addClass("useroptionselected");
											}
											evt.cancel();evt.stop();
										break;
									}
								break;
							}
						});
						editor.on('contentDom', function (e) {
							var editable = editor.editable();
							editable.attachListener(editable,'keyup', function (evt) {
								//console.log("KEYUP:"+evt.data.keyCode+"="+String.fromCharCode(evt.data.keyCode)+ "STATE:"+editor.plugins.autocomplete.state);
								switch(editor.plugins.autocomplete.state){
								case 1: // Completion started
									switch(evt.data.$.keyCode){
										case 8: // Backspace
										case 37: // Left Arrow
											if(editor.plugins.autocomplete.selected !=""){
												editor.plugins.autocomplete.selected = editor.plugins.autocomplete.selected.slice(0, - 1);
												autocomplete(editor, editor.plugins.autocomplete.selected);
											}else{
												editor.plugins.autocomplete.selected = "";editor.plugins.autocomplete.state = 0;$("#suggestionusers").remove(); // END COMPLETION
											}
										break;
										
										case 32: // Space
											editor.plugins.autocomplete.validate(editor);
											evt.cancel();
										break;
										case 39: // Right arrow
										case 27: // Escape
											editor.plugins.autocomplete.selected = "";editor.plugins.autocomplete.state = 0;$("#suggestionusers").remove(); // END COMPLETION
										break;
									}
								break;
								};
							});
							editable.attachListener( editable,'keypress', function(evt) {
							evt.data.keyCode = evt.data.$.keyCode;
							//console.log("KEYPRESS:"+evt.data.keyCode+"="+String.fromCharCode(evt.data.keyCode));
							switch(editor.plugins.autocomplete.state){
							case 0: // Waiting for '@'
								if (String.fromCharCode(evt.data.keyCode) == '@' ) {
									//car = getPrevChar(editor);
									//check = ".,()[]{}-!?-_+&'\"@#%;:=<> "+String.fromCharCode(64)+String.fromCharCode(8203)+String.fromCharCode(160)+String.fromCharCode(9);
									//if(car==null|| car=="" || check.indexOf(car)!=-1){
										autocomplete(editor, '');
										editor.plugins.autocomplete.state=1;
									//}
									
								}
								break;
							case 1: // Completion started
								switch(evt.data.keyCode){
									case editor.config.suggestionsTriggerKey.keyCode:
										// New @
										editor.plugins.autocomplete.selected = "";editor.plugins.autocomplete.state = 0;
										autocomplete(editor, '');
									break;
									default:
										car = String.fromCharCode(evt.data.keyCode);
										check = ".,()[]{}-!?-_+&'\"@#%;:=<> "+String.fromCharCode(64)+String.fromCharCode(160)+String.fromCharCode(9);
										if(check.indexOf(car)!=-1 ){ //Non usable char
											if(evt.data.$.keyCode == editor.config.suggestionsTriggerKey.keyCode){
												editor.plugins.autocomplete.state = 1;
												editor.plugins.autocomplete.selected=""; // RESET
											}else{
												editor.plugins.autocomplete.selected = "";editor.plugins.autocomplete.state = 0;$("#suggestionusers").remove(); // END COMPLETION	
											}
										}else{
											// Add character, search completion		
											key = evt.data.$.keyCode;
											editor.plugins.autocomplete.selected += String.fromCharCode(evt.data.keyCode);
											autocomplete(editor, editor.plugins.autocomplete.selected);
										}
									break;
								}
								break;
							}
							});//
						
						});
						
						
						editor.addCommand('reloadSuggetionBox', {
								exec : function(editor,suggestions) {
								
										var dummyElement = editor.document.createElement('span');
										editor.insertElement(dummyElement);
							
										var x = 0;
										var y = 0;
										var yscroll = 0;
										var obj = dummyElement.$;
										for(i=0;i<2;i++){
											while (obj.offsetParent) {
												if(i==0) x += obj.offsetLeft;
												y += obj.offsetTop;
												if(i==0)y -= obj.offsetParent ? obj.offsetParent.scrollTop : 0;
												obj = obj.offsetParent;
											}
											if(i==0)x += obj.offsetLeft;
											y += obj.offsetTop;
										obj = editor.container.$;
										}
										dummyElement.remove();
										
										var html="<DIV CLASS=suggestionusers ID=suggestionusers STYLE='top:"+(y+10)+"px; left:"+(x+20)+"px; width:200px;'>";
										select = " useroptionselected";
										$.each(suggestions,function(i, suggestion) {
															html += "<DIV class='usersoption"+select+"' data-id="+suggestion.id+" data-name='"+suggestion.label+"'>"+suggestion.label+"</DIV>";
															select="";
											});
										html=html+"</DIV>";
										$("#suggestionusers").remove();
										$(".item-details").append(html);
										$(".usersoption").click(function(){
											editor.plugins.autocomplete.validate(editor);										
										});
										$(".usersoption").mouseover(function(){
											$(".useroptionselected").removeClass("useroptionselected");
											$(this).addClass("useroptionselected");	
										});
										//$(editor.container.$).append(html);
//										editor.container.$.append(html);

								}
						 });
						 
					}
				});
	 
	
	 function validSelected(editor){
	 
	 }
	
	 function autocomplete(editor, text){
		getUsers(text);			
	}

				
	function getPrevChar(editor){
			var range = editor.getSelection().getRanges()[ 0 ],startNode = range.startContainer;
			if ( startNode.type == CKEDITOR.NODE_TEXT && range.startOffset )
				// Range at the non-zero position of a text node.
				return startNode.getText()[ range.startOffset - 1 ];
			else {
				// Expand the range to the beginning of editable.
				range.collapse( true );
				range.setStartAt( editor.editable(), CKEDITOR.POSITION_AFTER_START );
	
				// Let's use the walker to find the closes (previous) text node.
				var walker = new CKEDITOR.dom.walker( range ),node;
				while ( ( node = walker.previous() ) ) {
					// If found, return the last character of the text node.
					if ( node.type == CKEDITOR.NODE_TEXT )
					return node.getText().slice( -1 );         
				}
			}
			// Selection starts at the 0 index of the text node and/or there's no previous text node in contents.
			return null;
	}