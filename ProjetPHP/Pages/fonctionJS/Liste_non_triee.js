var elements = document.querySelectorAll('.voiture_triee');
elements.forEach(function(element) {
  var value = encodeURIComponent(element.dataset.immatriculation.replaceAll(' ', ''));
  element.addEventListener('click', function(e) {
    window.location.href = 'Plus_dinfo.php?trie= && immatriculation=' + value;
  });
});