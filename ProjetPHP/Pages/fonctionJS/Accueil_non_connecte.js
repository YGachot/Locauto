
document.getElementById('inscription-button').addEventListener('click', function(e) {
    document.getElementById('inscription_popup').style.display = 'block'
    document.getElementById('inscription-container').style.display = 'block'
    document.getElementById('inscription-back').style.display = 'block'
}
);

document.getElementById('inscription-close').addEventListener('click', function(e) {
document.getElementById('inscription_popup').style.display = 'none'
document.getElementById('inscription-container').style.display = 'none'
document.getElementById('inscription-back').style.display = 'none'
});

document.getElementById('connexion-button').addEventListener('click', function(e) {
  document.getElementById('connexion_popup').style.display = 'block'
  document.getElementById('connexion-container').style.display = 'block'
  document.getElementById('connexion-back').style.display = 'block'
}
);

document.getElementById('connexion-close').addEventListener('click', function(e) {
document.getElementById('connexion_popup').style.display = 'none'
document.getElementById('connexion-container').style.display = 'none'
document.getElementById('connexion-back').style.display = 'none'
});

document.getElementById('deja_un_compte').addEventListener('click', function(e) {
document.getElementById('inscription_popup').style.display = 'none'
document.getElementById('inscription-container').style.display = 'none'
document.getElementById('inscription-back').style.display = 'none'
document.getElementById('connexion_popup').style.display = 'block'
document.getElementById('connexion-container').style.display = 'block'
document.getElementById('connexion-back').style.display = 'block'
});

document.getElementById('pas_un_compte').addEventListener('click', function(e) {
  document.getElementById('connexion_popup').style.display = 'none'
  document.getElementById('connexion-container').style.display = 'none'
  document.getElementById('connexion-back').style.display = 'none'
  document.getElementById('inscription_popup').style.display = 'block'
  document.getElementById('inscription-container').style.display = 'block'
  document.getElementById('inscription-back').style.display = 'block'
  });

  function validerFormulaireInscription() {
    var nomElement = document.getElementById('nom-insc')
    var prenomElement = document.getElementById('firstname-insc')
    var adressElement = document.getElementById('address-insc')
    var mailElement = document.getElementById('mail-insc')
    var mdpElement = document.getElementById('mdp-insc')
    var confirm_mdpElement = document.getElementById('confirm-mdp-insc')

    var nom = nomElement[0].value
    var prenom = prenomElement[0].value
    var email = mailElement[0].value
    var mdp = mdpElement[0].value
    var confirm_mdp = confirm_mdpElement[0].value

    var regexChiffres = /\d/;
    if (regexChiffres.test(nom) || regexChiffres.test(prenom)) {
      alert("Le nom et le prénom ne doivent pas contenir de chiffres.");
      return false;
    }
    var regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!regexEmail.test(email)) {
      alert("Veuillez entrer une adresse email valide.");
      return false;
    }
    if (mdp !== confirm_mdp) {
      alert("Le mot de passe et la confirmation du mot de passe ne correspondent pas.");
      return false;
    }
    return true
  }


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

  document.addEventListener('DOMContentLoaded', function() {
    // Sélectionnez tous les boutons radio avec la classe "type-insc"
    var typeInscButtons = document.querySelectorAll('.type-insc input[type="radio"]');

    typeInscButtons.forEach(function(button) {
      button.addEventListener('change', function() {
        typeInscButtons.forEach(function(button) {
          button.parentNode.classList.remove('selected');
        });
  
        if (this.checked) {
          this.parentNode.classList.add('selected');
        }
      });
    });
  });

  document.getElementById('vehicule_opt_location').addEventListener('click', function(e) {
    alert('Veuillez vous connecter avant de pouvoir effectuer une location')
  })
  document.getElementById('faire_louer').addEventListener('click', function(e) {
    alert('Veuillez vous connecter avant de pouvoir mettre un véhicule en location')
  })
  document.getElementById('carte_garage').addEventListener('click', function(e) {
    alert('Veuillez vous connecter avant de pouvoir accéder à la carte de nos garages')
  })
  document.getElementById('liste_vehicule').addEventListener('click', function(e) {
    alert('Veuillez vous connecter avant de pouvoir acceder à la liste de nos véhicules en location')
  })
  document.getElementById('a_propos_de_nous').addEventListener('click', function(e) {
    alert("Veuillez vous connecter avant de pouvoir acceder à nos pages d'informations")
  })
  document.getElementById('nous_contacter').addEventListener('click', function(e) {
    alert("Veuillez vous connecter avant de pouvoir acceder à nos pages d'informations")
  })