
countdownManager = {
  // Configuration
  // targetTime: new Date().getTime() + (60*60*24*5 + 60*60*6 + 60*25 + 37)*1000, // Date cible du compte à rebours (00:00:00)
  
/*  date = new Date("3/19/2015 19:00:00"),
  targetTime = date.getTime(),*/

  // targetTime: new Date("2015-05-30T16:28:00+0000").getTime(),
  targetTime: new Date("2015-06-12T15:48:00+0000").getTime(),
  displayElement: { // Elements HTML où sont affichés les informations
    day:  null,
    hour: null,
    min:  null,
    sec:  null
  },
  
  // Initialisation du compte à rebours (à appeller 1 fois au chargement de la page)
  init: function(){
    // Récupération des références vers les éléments pour l'affichage
    // La référence n'est récupérée qu'une seule fois à l'initialisation pour optimiser les performances
    this.displayElement.day  = jQuery('#countdown_day');
    this.displayElement.hour = jQuery('#countdown_hour');
    this.displayElement.min  = jQuery('#countdown_min');
    this.displayElement.sec  = jQuery('#countdown_sec');
    
    // Lancement du compte à rebours
    this.tick(); // Premier tick tout de suite
    window.setInterval("countdownManager.tick();", 1000); // Ticks suivants, répété toutes les secondes (1000 ms)
  },
  
  // Met à jour le compte à rebours (tic d'horloge)
  tick: function(){
    // Instant présent
    var timeNow  = new Date();
    
    // On s'assure que le temps restant ne soit jamais negatif (ce qui est le cas dans le futur de targetTime)
    if( timeNow > this.targetTime ){
      timeNow = this.targetTime;
    }
    
    // Calcul du temps restant
    var diff = this.dateDiff(timeNow, this.targetTime);
    
    this.displayElement.day.text(  diff.day  );
    this.displayElement.hour.text( diff.hour );
    this.displayElement.min.text(  diff.min  );
    this.displayElement.sec.text(  diff.sec  );



  },
  
  // Calcul la différence entre 2 dates, en jour/heure/minute/seconde
  dateDiff: function(date1, date2){
    var diff = {}                           // Initialisation du retour
    var tmp = date2 - date1;

    tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
    diff.sec = tmp % 60;                    // Extraction du nombre de secondes
    tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
    diff.min = tmp % 60;                    // Extraction du nombre de minutes
    tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
    diff.hour = tmp % 24;                   // Extraction du nombre d'heures
    tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
    diff.day = tmp;

    return diff;
  }
};

jQuery(function($){
  // Lancement du compte à rebours au chargement de la page
  countdownManager.init();
});
