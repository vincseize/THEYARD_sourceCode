<script type='text/javascript'>

/*function go_anchor(a){
	$( ".navbarGDC" ).show();

}*/


function show_navbar(){
	$( "#TOP_navbarGDC" ).show();
}


function hide_navbar(){
	$( "#TOP_navbarGDC" ).hide();
}



function getNbattle_restante(v){

	// var village = 0;
	var village = v;

	var e = document.getElementById('selectBattleLeft'+village);
	var n = e.options[e.selectedIndex].value;


	/*document.getElementById( "form_selectBattleLeft" ).submit();*/

/*	alert(village);
	alert(n);*/


	var the_value = "village="+village+";n="+n;

	$.post('get_nbattles.php?data='+the_value , function(data) {
	        //do whatever you want with the result
	        location.reload();
	   });


	// location.reload();

}



function n_battles_ennemy_used(){



	// var village = 0;
	// var nWin = v;

	var e = document.getElementById('select_n_battles_ennemy_used');
	var n = e.options[e.selectedIndex].value;


	/*document.getElementById( "form_selectBattleLeft" ).submit();*/

// alert(nWin);
/*		alert(n);*/


	var the_value = "n_battles_ennemy_used="+n;

	$.post('n_battles_ennemy_used.php?data='+the_value , function(data) {
	        //do whatever you want with the result
	        location.reload();
	   });


	// location.reload();

}


function n_battles_team_used(){



	// var village = 0;
	// var nWin = v;

	var e = document.getElementById('select_n_battles_team_used');
	var n = e.options[e.selectedIndex].value;


	/*document.getElementById( "form_selectBattleLeft" ).submit();*/

	// alert(n);
/*		alert(n);*/


	var the_value = "n_battles_team_used="+n;

	$.post('n_battles_team_used.php?data='+the_value , function(data) {
	        //do whatever you want with the result
	        location.reload();
	   });


	// location.reload();

}



function clickEtoile(e){


		// alert(e);

		var the_value = "etoiles="+e;

		$.post('n_etoiles_win.php?data='+the_value , function(data) {
		        //do whatever you want with the result
		        location.reload();
		   });

}


function clickEtoileLoose(e){


		// alert(e);

		var the_value = "etoiles="+e;

		$.post('n_etoiles_lost.php?data='+the_value , function(data) {
		        //do whatever you want with the result
		        location.reload();
		   });




}

function resetBattle(e){


		// alert(e);

		var the_value = "etoiles="+e; // 0_etoile_1_grise

		$.post('n_reset_battle.php?data='+the_value , function(data) {
		        //do whatever you want with the result
		        location.reload();
		   });


/*		var the_value = "n_battles_team_used=2";

		$.post('n_battles_team_used.php?data='+the_value , function(data) {
		        //do whatever you want with the result
		        location.reload();
		   });*/


}













</script>