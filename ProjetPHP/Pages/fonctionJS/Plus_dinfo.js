document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('paiement_button').addEventListener('click', function(e) {
        document.getElementById('paiement_popup').style.display = 'block'
        document.getElementById('paiement_container').style.display = 'block'
        document.getElementById('paiement_back').style.display = 'block'
    }
    );
    
    document.getElementById('paiement_close').addEventListener('click', function(e) {
        document.getElementById('paiement_popup').style.display = 'none'
        document.getElementById('paiement_container').style.display = 'none'
        document.getElementById('paiement_back').style.display = 'none'
    });
});

var checkbox_1 = document.getElementById('checkbox_option_1');
var checkbox_2 = document.getElementById('checkbox_option_2');
var checkbox_3 = document.getElementById('checkbox_option_3');
var prix_option_1 = document.getElementById('prix_option_1');
var prix_option_2 = document.getElementById('prix_option_2');
var prix_option_3 = document.getElementById('prix_option_3');
var prix_option_lieu_dif = document.getElementById('prix_option_lieu');
var prix_option_date_depart = document.getElementById('prix_option_date_depart');

var total = document.getElementById('total');

var prix_option_1_element = document.getElementById('option_1');
var prix_option_1_value = prix_option_1_element.getAttribute('data-option_1');

var prix_option_2_element = document.getElementById('option_2');
var prix_option_2_value = prix_option_2_element.getAttribute('data-option_2');

var prix_option_3_element = document.getElementById('option_3');
var prix_option_3_value = prix_option_3_element.getAttribute('data-option_3');

var prix_initial_element = document.getElementById('prix_initial')
var prix_initial_value = prix_initial_element.getAttribute('data-prix_initial')

var prix_lieu_dif_element =  document.getElementById('prix_lieu_dif')
if (prix_lieu_dif_element) {
  var prix_lieu_dif_value = prix_lieu_dif_element.getAttribute('data-prix_lieu_dif')
}

var prix_dimanche_element = document.getElementById('prix_dimanche')
if (prix_dimanche_element) {
  var prix_dimanche_value = prix_dimanche_element.getAttribute('data-prix_dimanche')
}

var valeur_lieu_dif = 0
var valeur_dimanche = 0
if (prix_option_lieu_dif) {
  prix_option_lieu_dif.style.display = "block";
  valeur_lieu_dif = parseInt(prix_lieu_dif_value)
}
if (prix_option_date_depart) {
  prix_option_date_depart.style.display = "block";
  valeur_dimanche = - parseInt(prix_dimanche_value)
}

var valeur_prix_option_1 = 0;
var valeur_prix_option_2 = 0;
var valeur_prix_option_3 = 0;
var calctotal = 0;

checkbox_1.addEventListener('change', function() {
  if (this.checked) {
    prix_option_1.style.display = "block";
    valeur_prix_option_1 = parseInt(prix_option_1_value);
  } else {
    prix_option_1.style.display = "none";
    valeur_prix_option_1 = 0;
  }
  calctotal = valeur_prix_option_1 + valeur_prix_option_2 + valeur_prix_option_3 + parseInt(prix_initial_value) + valeur_dimanche + valeur_lieu_dif;
  total.textContent = "Total à régler : " + calctotal + " €";
});

checkbox_2.addEventListener('change', function() {
  if (this.checked) {
    prix_option_2.style.display = "block";
    valeur_prix_option_2 = parseInt(prix_option_2_value);
  } else {
    prix_option_2.style.display = "none";
    valeur_prix_option_2 = 0;
  }
  calctotal = valeur_prix_option_1 + valeur_prix_option_2 + valeur_prix_option_3 + parseInt(prix_initial_value) + valeur_dimanche + valeur_lieu_dif;
  total.textContent = "Total à régler : " + calctotal + " €";
});

checkbox_3.addEventListener('change', function() {
  if (this.checked) {
    prix_option_3.style.display = "block";
    valeur_prix_option_3 = parseInt(prix_option_3_value);
  } else {
    prix_option_3.style.display = "none";
    valeur_prix_option_3 = 0;
  }
  calctotal = valeur_prix_option_1 + valeur_prix_option_2 + valeur_prix_option_3 + parseInt(prix_initial_value) + valeur_dimanche + valeur_lieu_dif;
  total.textContent = "Total à régler : " + calctotal + " €";
});

calctotal = valeur_prix_option_1 + valeur_prix_option_2 + valeur_prix_option_3 + parseInt(prix_initial_value) + valeur_dimanche + valeur_lieu_dif;
total.textContent = "Total à régler : " + calctotal + " €";