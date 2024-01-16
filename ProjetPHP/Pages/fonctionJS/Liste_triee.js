var elements = document.querySelectorAll('.voiture_triee');
var lieuDifElement = document.getElementById('lieu-dif');
var lieuDifValue = lieuDifElement.dataset.lieuDif;
var dateDepartElement = document.getElementById('date_dep');
var dateDepartValue = dateDepartElement.dataset.dateDep;
var dateArriveeElement = document.getElementById('date_arr');
var dateArriveeValue = dateArriveeElement.dataset.dateArr;

var id_lieu_depart_element = document.getElementById('id_lieu_depart');
var id_lieu_depart_value = id_lieu_depart_element.getAttribute('data-id_lieu_depart');

var id_lieu_arrivee_element = document.getElementById('id_lieu_arrivee');
var id_lieu_arrivee_value = id_lieu_arrivee_element.getAttribute('data-id_lieu_arrivee');


var selectedDateDepart = new Date(dateDepartValue);
var selectedDateArrivee = new Date(dateArriveeValue);
var dayOfWeek = selectedDateDepart.getDay();
var difDate = selectedDateArrivee.getTime() - selectedDateDepart.getTime();

var differenceEnJours = difDate / (24 * 60 * 60 * 1000);


if (dayOfWeek === 0) {
  console.log("La date de départ est un dimanche");
}

elements.forEach(function(element) {
  var value = encodeURIComponent(element.dataset.immatriculation.replaceAll(' ', ''));
  element.addEventListener('click', function(e) {
    window.location.href = 'Plus_dinfo.php?trie=1&immatriculation=' + value + '&lieu_dif=' + lieuDifValue + '&date_depart=' + dayOfWeek + '&dif_date=' + differenceEnJours + '&datedepart=' + dateDepartValue + '&datearrivee=' + dateArriveeValue + '&idlieudepart=' + id_lieu_depart_value + '&idlieuarrivee=' + id_lieu_arrivee_value;
  });
});