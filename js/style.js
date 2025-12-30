
//--------------------------------clear field client--------------------------------
const email = document.getElementById('email');
const pays = document.getElementById('pays');
const code_sage =document.getElementById('code_sage');
const raison_sociale = document.getElementById('raison_sociale');
const type_client = document.getElementById('type_client');
const adresse = document.getElementById('adresse');
const code_postale = document.getElementById('code_postale');
const ville = document.getElementById('ville') ;
const eacce1 = document.getElementById('eacce1');
const eacce2 = document.getElementById('eacce2');
const eacce3 = document.getElementById('eacce3');
const nrc = document.getElementById('nrc');
const n_centre = document.getElementById('n_centre');
const tel1 = document.getElementById('tel1');
const tel2 = document.getElementById('tel2');
const fax = document.getElementById('fax');
const mybtn_supprimer =document.getElementById('mybtn_supprimer');
if (mybtn_supprimer !== null) {
    mybtn_supprimer.addEventListener('click', function handleSupprimerClick(event) {
    code_sage.value = ' ';
    raison_sociale.value = ' ' ;
    type_client.value = 'client';
    adresse.value = ' ' ;
    code_postale.value = ' ' ;
    ville.value = ' ';
    eacce1.value = ' ';
    eacce2.value = ' ';
    eacce3.value= ' ';
    nrc.value = ' ';
    n_centre.value =  ' ';
    tel1.value = ' ';
    tel2.value = ' ';
    fax.value = ' ';
    email.value = ' ';
    pays.value = ' ';

});
}
else
{
    console.log("null");
}

//---------------------------------table facturation--------------------------------------

// // Récupérer les éléments DOM des boutons d'ajout et de suppression
// const addButton = document.getElementById('add');
// const deleteButton = document.getElementById('mybtn_supprimer');

// // Récupérer l'élément DOM du tableau
// const table = document.querySelector('table');

// // Ajouter un écouteur d'événements sur le bouton d'ajout
// addButton.addEventListener('click', function() {
//   // Créer une nouvelle ligne dans le tableau
//   const newRow = document.createElement('tr');

//   // Ajouter les cellules de la ligne avec des champs de texte
//   const codeNgpCell = document.createElement('td');
//   const codeNgpInput = document.createElement('input');
//   codeNgpInput.classList.add('form-control');
//   codeNgpCell.appendChild(codeNgpInput);
//   newRow.appendChild(codeNgpCell);

//   const codeArticleCell = document.createElement('td');
//   const codeArticleInput = document.createElement('input');
//   codeArticleInput.classList.add('form-control');
//   codeArticleCell.appendChild(codeArticleInput);
//   newRow.appendChild(codeArticleCell);

//   const designationCell = document.createElement('td');
//   const designationInput = document.createElement('input');
//   designationInput.classList.add('form-control');
//   designationCell.appendChild(designationInput);
//   newRow.appendChild(designationCell);

//   const paysCell = document.createElement('td');
//   const paysInput = document.createElement('input');
//   paysInput.classList.add('form-control');
//   paysCell.appendChild(paysInput);
//   newRow.appendChild(paysCell);

//   const uniteCell = document.createElement('td');
//   const uniteInput = document.createElement('input');
//   uniteInput.classList.add('form-control');
//   uniteCell.appendChild(uniteInput);
//   newRow.appendChild(uniteCell);

//   const qteCell = document.createElement('td');
//   const qteInput = document.createElement('input');
//   qteInput.classList.add('form-control');
//   qteCell.appendChild(qteInput);
//   newRow.appendChild(qteCell);

//   const poidsNetCell = document.createElement('td');
//   const poidsNetInput = document.createElement('input');
//   poidsNetInput.classList.add('form-control');
//   poidsNetCell.appendChild(poidsNetInput);
//   newRow.appendChild(poidsNetCell);

//   const valeurDeviseCell = document.createElement('td');
//   const valeurDeviseInput = document.createElement('input');
//   valeurDeviseInput.classList.add('form-control');
//   valeurDeviseCell.appendChild(valeurDeviseInput);
//   newRow.appendChild(valeurDeviseCell);

//   const deleteButtonCell = document.createElement('td');
//   const deleteButton = document.createElement('button');
//   deleteButton.classList.add('btn', 'btn-danger', 'mybtn');
//   deleteButton.textContent = 'X';
//   deleteButton.addEventListener('click', function() {
//     // Supprimer la ligne du tableau
//     newRow.remove();
//   });
//   deleteButtonCell.appendChild(deleteButton);
//   newRow.appendChild(deleteButtonCell);

//   // Ajouter la nouvelle ligne au tableau
//   table.querySelector('tbody').appendChild(newRow);
// });

// // Ajouter un écouteur d'événements sur le bouton de suppression
// deleteButton.addEventListener('click', function() {
//   // Supprimer la ligne du tableau
//   table.querySelector('tbody tr').remove();
// });

  //------------------------Facture ajouter supprimer ligne-----------------------------

