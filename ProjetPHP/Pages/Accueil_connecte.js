var sidenav = document.getElementById("menu_hamburger");
var openBtn = document.getElementById("open_menu_hamburger");
var closeBtn = document.getElementById("close_button");

openBtn.onclick = openNav;  
closeBtn.onclick = closeNav;

function openNav() {
  console.log("je fonctionne");
  sidenav.classList.add("active");
}

function closeNav() {
  sidenav.classList.remove("active");
}

console.log("Le script est en cours d'exécution");
document.getElementById('imglogo_container').addEventListener('click', function(e) {
  console.log('coucou');
  window.location.href = "Accueil_connecte.php";
});

function verif_date() {
  var date1 = new Date(document.getElementById("date_depart_value").value);
  var date2 = new Date(document.getElementById("date_arrivee_value").value);

  if (date1 >= date2) {
      alert("La date de départ doit être antérieure à la date de retour");
      return false;
  }

  return true;
}
