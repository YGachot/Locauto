document.addEventListener('DOMContentLoaded', function() {
    // Sélectionnez tous les boutons radio avec la classe "type-insc"
    var typeInscButtons = document.querySelectorAll('.location input[type="radio"]');

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


  document.addEventListener('DOMContentLoaded', function() {
    // Sélectionnez tous les boutons radio avec la classe "type-insc"
    var typeInscButtons = document.querySelectorAll('.list_vehicule input[type="radio"]');

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