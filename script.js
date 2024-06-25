document.addEventListener('DOMContentLoaded', function () {

  const selectionDiv = document.querySelector('.selection');
  const checkboxesDiv = document.querySelector('.checkboxes');

  selectionDiv.addEventListener('click', function () {
    checkboxesDiv.style.display = checkboxesDiv.style.display === 'block' ? 'none' : 'block';
  });

  const regionDiv = document.querySelector('.region');
  const checkboxes_regionDiv = document.querySelector('.checkboxes_region');

  regionDiv.addEventListener('click', function () {
    checkboxes_regionDiv.style.display = checkboxes_regionDiv.style.display === 'block' ? 'none' : 'block';
  });

  const producteurDiv = document.querySelector('.producteur');
  const checkboxes_producteurDiv = document.querySelector('.checkboxes_producteur');

  producteurDiv.addEventListener('click', function () {
    checkboxes_producteurDiv.style.display = checkboxes_producteurDiv.style.display === 'block' ? 'none' : 'block';
  });

  const labelDiv = document.querySelector('.label');
  const checkboxes_labelDiv = document.querySelector('.checkboxes_label');

  labelDiv.addEventListener('click', function () {
    checkboxes_labelDiv.style.display = checkboxes_labelDiv.style.display === 'block' ? 'none' : 'block';
  });

  const noteDiv = document.querySelector('.note');
  const checkboxes_noteDiv = document.querySelector('.checkboxes_note');

  noteDiv.addEventListener('click', function () {
    checkboxes_noteDiv.style.display = checkboxes_noteDiv.style.display === 'block' ? 'none' : 'block';
  });
}); 

var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");
var closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

/* Set the width of the side navigation to 250px */
function openNav() {
  sidenav.classList.add("active");
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  sidenav.classList.remove("active");
}

document.getElementById('trier-toggle').addEventListener('click', function () {
  document.querySelectorAll('.elements').forEach(function (element) {
    element.classList.toggle('visible');
  });
});


// PAGES DETAILS POUR LA QUANTITE


function changeQuantity(elementId, delta) {
  const input = document.getElementById(elementId);
  let currentValue = parseInt(input.value);
  let newValue = currentValue + delta;
  if (newValue < 1) newValue = 1; // Prevent quantity from going below 1
  input.value = newValue;
}



// Bouton activé / Désecativé

document.querySelector('.switch input').addEventListener('change', function() {
  if (this.checked) {
      console.log('Switch is ON');
  } else {
      console.log('Switch is OFF');
  }
});


// Pour les photos 

document.getElementById('photo').addEventListener('change', function() {
  var fileName = this.files[0] ? this.files[0].name : 'Aucun fichier choisi';
  document.getElementById('file-name').textContent = fileName;
});
