
// Cytoscape Init starts 
var cy = cytoscape({

	container: $('#container'),
	wheelSensitivity: 0.2,
	zoom: 1.5,

	elements: [],

	style: [
		{
			selector: 'node',
			style: {
				'shape': 'rectangle',
				'width': '50',
				'height': '50',
				'padding-left': '10px', 'padding-right': '10px',
				'padding-top': '10px', 'padding-bottom': '10px',
				'background-color': '#DDD',
				'border-color': '#999',
				'border-width': '2px',
				'font-size': '11px',
				'color': '#333',
				'text-outline-color': '#DDD',
				'text-outline-width': '3px',
				'content': 'data(name)',
				'text-valign': 'center',
				'min-zoomed-font-size': '10px'
			}
		},
		{
			selector: 'node.scenes',
			style: {
				'shape': 'rectangle',
				'width': 'label',
				'height': 'label',
				'background-color': '#585858',
				'background-image': 'url(../upload/_medias/cases/vignette.jpg)',

				'border-color': '#FFF',
				'color': '#fff',
				'text-outline-color': '#585858'
			}
		},
		{
			selector: 'node.master',
			style: {
				'background-color': '#000',
				'text-outline-color': '#000'
			}
		},
		{
			selector: 'node.scenes:selected',
			style: {
				// 'background-color': '#FA0'
			}
		},
		{
			selector: 'node.assets',
			style: {
				'shape': 'ellipse'
			}
		},
		{
			selector: 'node.assets:selected',
			style: {
				// 'background-color': '#BD0'
			}
		},
		{
			selector: 'node.shots',
			style: {
				'shape': 'hexagon'
			}
		},
		{
			selector: 'node.shots:selected',
			style: {
				// 'background-color': '#0AF'
			}
		},
		{
			selector: 'node.highlight',
			style: {
				'background-color': '#FC0',
				'color': '#111',
				'border-color': '#FFF',
				'border-width': '2px',
				'text-outline-color': '#FC0'
			}
		},
		{
			selector: 'node.conxlight',
			style: {
				'color': '#000',
				'border-color': '#3F0',
				'border-width': '4px'
			}
		},
		{
			selector: 'node:selected',
			style: {
				'background-color': '#06C',
				'color': '#111',
				'border-color': '#FFF',
				'border-width': '2px',
				'text-outline-color': '#06C'
			}
		},
		{
			selector: 'edge',
			style: {
				'width': 1,
				'curve-style': 'unbundled-bezier',
				'mid-target-arrow-shape': 'none',
				'mid-target-arrow-fill': 'filled',
				'target-arrow-shape': 'triangle',
				'target-arrow-fill': 'filled'
			}
		},
		{
			selector: 'edge.scenesLine',
			style: {
				// 'line-color': '#A50',
				// 'mid-target-arrow-color': '#B60',
				// 'target-arrow-color': '#B60'
			}
		},
		{
			selector: 'edge.assetsLine',
			style: {
				// 'line-color': '#680',
				// 'mid-target-arrow-color': '#790',
				// 'target-arrow-color': '#790'
			}
		},
		{
			selector: 'edge.shotsLine',
			style: {
				// 'line-color': '#05A',
				// 'mid-target-arrow-color': '#06B',
				// 'target-arrow-color': '#06B'
			}
		},
		{
			selector: 'edge:selected',
			style: {
				'line-color': '#FC0',
				'target-arrow-color': '#FC0'
			}
		},
		{
			selector: 'edge.highlight',
			style: {
				'mid-target-arrow-shape': 'triangle',
				'mid-target-arrow-color': '#FC0',
				'target-arrow-color': '#FC0'
			}
		}
	],


	layout: {
		name: 'dagre',
		animate: true
	}

});
// Cytoscape Init ends


var lastClickCoords  = [0,0];	// Pour sauver la position du clic-droit
var contextSelection = false;	// Pour garder en mémoire le node du clic-droit
if (!localStorage.graph)
	localStorage.graph = "";
var layoutChoosen = "dagre";


// Document Ready starts
$(function(){

	if (localStorage.graph !== "") {
		var elems = JSON.parse(localStorage.graph);
		if (elems.length) {
			cy.add(elems);
			// cy.layout({'name': layoutChoosen, animate: true});
		}
	}

	// Highlight children on hover
	cy.on('mouseover', 'node', function(e){
		e.cyTarget.addClass('highlight').outgoers().addClass('highlight');
		if (e.originalEvent.ctrlKey && cy.$(":selected").length)
			e.cyTarget.addClass('conxlight');
	});
	cy.on('mouseout', 'node', function(e){
		e.cyTarget.removeClass('highlight conxlight').outgoers().removeClass('highlight');
	});


	///////////// Menu principal //////////////

	// Choix du layout
	$('#layoutCh').on('change', function(){
		layoutChoosen = $(this).val();
		cy.layout({'name': layoutChoosen, animate: true});
	});

	// Bouton FIT
	$('#fit, #fitM').click(function(){
		cy.fit();
	});

	// Bouton REDRAW
	$('#redraw').click(function(){
		cy.layout({'name': layoutChoosen, animate: true});
	});

	// Bouton CLEAR
	$('#clear, #clearM').click(function(){
		if (!confirm("Vider le graph ? Sûr ?")) return;
		cy.remove('*');
	});

	// Comportement à la sélection
	cy.on('select', function(e){
		$('#deleteNodes').removeClass('disabled');
	});
	cy.on('unselect', function(e){
		if (! cy.$(':selected').length)
			$('#deleteNodes').addClass('disabled');
	});
	// Connexions manuelles
	function checkConnectable(srce, dest) {
		if (srce.hasClass('shots'))
			return false;
		if (srce.hasClass('assets') && !dest.hasClass('scenes master'))
			return false;
		if (srce.hasClass('scenes') && dest.hasClass('assets'))
			return false;
		return true;
	}
	cy.on('tapstart', 'node', function(e){
		if (!e.originalEvent.ctrlKey)
			return;
		var parents = cy.$(":selected");
		if (!parents.length)
			return;
		for (i=0; i<parents.length; i++) {
			var srce 	= parents.eq(i);
			var srceID 	= srce.data('id');
			var dest 	= e.cyTarget;
			var destID 	= dest.data('id');
			if (!checkConnectable(srce, dest))
				return true;
			var edge = {
				data: {
					id: "E"+srceID+destID,
					source: srceID,
					target: destID
				},
				group: "edges"
			}
			cy.add(edge);
			console.log("Connection to '"+dest.data('name')+"' done.");
		}
	});
	cy.on('tapend', 'node', function(e){
		if (e.originalEvent.ctrlKey) {
			console.log("Unselect '"+e.cyTarget.data('name')+"'...");
			setTimeout(function(){ e.cyTarget.unselect(); }, 50);
		}
	});
	
	// Bouton DELETE sélection
	$('#deleteNodes').click(function(){
		cy.remove(":selected");
		$('#deleteNodes').addClass('disabled');
	});

	// Bouton LOAD
	$('#load').click(function(){
		cy.remove('*');
		$('#deleteNodes').addClass('disabled');
		if (localStorage.graph !== "") {
			var elems = JSON.parse(localStorage.graph);
			if (elems.length) {
				cy.add(elems);
				cy.layout({'name': layoutChoosen, animate: true});
				return;
			}
		}
		var version = Date.now();
		$.getJSON('./elements.json?v='+version, function(elems){
			cy.add(elems).layout({'name': layoutChoosen, animate: true});
		});
	});

	// Bouton SAVE
	$('#save').click(function(){
		if (!cy.elements().length)
			return;
		var allJson = cy.elements().jsons();
		localStorage.graph = JSON.stringify(allJson);
		$('#nbNodes').html("OK, "+cy.nodes().length+" éléments en mémoire.").show();
		console.log(localStorage.graph);
	});

	// Bouton OUBLIER LocalStorage
	$('#emptyLS').click(function(){
		localStorage.graph = "";
		$('#nbNodes').html("OK, plus rien en mémoire.").show();
	});

	// Affichage du nombre de nodes chargés
	cy.on('layoutready', function(){
		if (cy.nodes().length) {
			$('#nbNodes').html("Ok ! "+ cy.nodes().length +' nodes loaded.').show();
			setTimeout(function(){ $('#nbNodes').fadeOut() }, 4000);
		}
		else
			$('#nbNodes').html("Rien à afficher.").show();
	});


	///////////// Menu de droite //////////////

	$('.nodeModel').draggable({
		helper: "clone",
		cursor: "pointer"
	});
	$('#container').droppable({
		accept: ".nodeModel",
		drop: function (e, ui) {
			var nodeModel = ui.draggable.get(0);
			var offset = $('#container').offset();
			var idE	 = cy.nodes().length + 1;
			var type = $(nodeModel).data('type');
			var elem = {
				data: {
					id: idE,
					name: "Case "+type
				},
				renderedPosition: {
					x: e.pageX - offset.left,
					y: e.pageY - offset.top
				},
				group: "nodes",
				classes: type+"s"
			};
			cy.add(elem);
			// cy.layout({'name': layoutChoosen, animate: true});
		}
	});

	///////////// Menu contextuel //////////////

	// Init
	cy.on('cxttap', 'node', function(e){
		$('.ctxNodeTitle').html(e.cyTarget.data('name'));
		var offset = $('#container').offset();
		lastClickCoords = [e.originalEvent.pageX -offset.left, e.originalEvent.pageY -offset.top];
		contextSelection = e.cyTarget.data('id');
		$('.overNode, .nodeAction').show();
		$("#contextMenu").css({'top': (e.originalEvent.pageY-5)+'px', 'left': (e.originalEvent.pageX-10)+'px'}).show();
		e.originalEvent.preventDefault();
		e.originalEvent.stopPropagation();
		return false;
	});
	cy.on('cxttap', function(e){
		if (e.cyTarget.length) return false;
		lastClickCoords = [e.originalEvent.pageX -30, e.originalEvent.pageY -120];
		$('.overNode, .nodeAction').hide();
		$("#contextMenu").css({'top': (e.originalEvent.pageY-5)+'px', 'left': (e.originalEvent.pageX-10)+'px'}).show();
		e.originalEvent.preventDefault();
		e.originalEvent.stopPropagation();
		return false;
	});
	$('#contextMenu').on('mouseleave click', function(){
		$(this).hide();
	});

	// Ajout de node
	$('.addNode').click(function(e){
		var type = $(this).data('type');
		var idE	 = cy.nodes().length + 1;
		var elem = {
			data: {
				id: idE,
				name: "test "+type
			},
			renderedPosition: {
				x: lastClickCoords[0],
				y: lastClickCoords[1]
			},
			group: "nodes",
			classes: type+"s"
		};
		cy.add(elem);
	});

	// Suppression de node
	$('#deleteNode').click(function(){
		cy.remove('#'+contextSelection);
	});

	// Renommage de node
	$('#renameNode').click(function(){
		var newName = prompt('Nouveau nom');
		if (newName === '') return;
		cy.$('#'+contextSelection).data('name', newName);
	});


	// Connexion des nodes en drag & drop
	//
	// cy.edgehandles({
	// 	enabled: false,
	// 	handleColor: '#FFF',
	// 	hoverDelay: 200,
	// 	toggleOffOnLeave: true,
	// 	edgeType: function( sourceNode, targetNode ) {
	// 		if (sourceNode.hasClass('shots'))
	// 			return null;
	// 		if (sourceNode.hasClass('assets') && targetNode.hasClass('shots'))
	// 			return null;
	// 		if (sourceNode.hasClass('scene') && targetNode.hasClass('assets'))
	// 			return null;
	// 		if (cy.$('#E'+sourceNode.data('id')+targetNode.data('id')).isEdge())
	// 			return null;
	// 		return 'flat';
	// 	},
	// 	edgeParams: function(sourceNode, targetNode, i) {
	// 		var edgeClass = "";
	// 		if (sourceNode.hasClass('assets') && !targetNode.hasClass('shots'))
	// 			edgeClass = "assetsLine";
	// 		if (sourceNode.hasClass('scenes') && !targetNode.hasClass('assets'))
	// 			edgeClass = "scenesLine";
	// 		if (targetNode.hasClass('shots') && !sourceNode.hasClass('assets'))
	// 			edgeClass = "shotsLine";
	// 		return {
	// 			data: {
	// 				id: "E"+sourceNode.data('id')+targetNode.data('id'),
	// 				source: sourceNode.data('id'),
	// 				target: targetNode.data('id')
	// 			},
	// 			group: "edges",
	// 			classes: edgeClass
	// 		}
	// 	}
	// });
	// $('.switchMode').click(function(){
	// 	if (!$(this).hasClass('switchOn')) {
	// 		$(this).addClass('switchOn').find('span').html("ON");
	// 		cy.edgehandles('enable');
	// 	}
	// 	else {
	// 		$(this).removeClass('switchOn').find('span').html("(off)");
	// 		cy.panBy({x:1, y:0});
	// 		cy.edgehandles('disable');
	// 	}
	// });

});
// Document Ready Ends