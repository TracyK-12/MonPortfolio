// // // Assurez-vous que le script est exécuté après le chargement du HTML
// // document.addEventListener('DOMContentLoaded', function() {
// //     // Assurez-vous que le bouton et le formulaire existent
// //     const addProductButton = document.getElementById('addProductButton');
// //     const productForm = document.getElementById('productForm');
    
// //     // Vérification pour s'assurer que les éléments existent
// //     if (addProductButton && productForm) {
// //         // Ajouter un gestionnaire d'événement au bouton
// //         addProductButton.addEventListener('click', function() {
// //             // Bascule la classe 'show' pour afficher ou cacher le formulaire
// //             productForm.classList.toggle('show');
// //         });
// //     }

// //     // Gestion du formulaire d'ajout de produit
// //     const productFormContent = document.getElementById('productFormContent');
// //     if (productFormContent) {
// //         productFormContent.addEventListener('.submit', function(event) {
// //             event.preventDefault();

// //             const productName = document.getElementById('productName').value;
// //             const productDescription = document.getElementById('productDescription').value;
// //             const productPrice = document.getElementById('productPrice').value;
// //             const productImage = document.getElementById('productImage').files[0];

// //             // Simule l'ajout du produit avec une alerte
// //             alert('Produit ajouté: ' + productName);

// //             // Réinitialiser le formulaire et cacher à nouveau le formulaire
// //             productFormContent.reset();
// //             productForm.classList.remove('show');
// //         });
// //     }
// // });

//         // Sélectionner les éléments nécessaires
//         const openFormButton = document.getElementById('openFormButton');
//         const modalBackground = document.getElementById('modalBackground');
//         const closeModal = document.getElementById('closeModal');
//         const productFormContent = document.getElementById('productFormContent');

//         // Ouvrir le popup
//         openFormButton.addEventListener('click', function() {
//             modalBackground.style.display = 'block';  // Afficher le fond du modal (popup)
//         });

//         // Fermer le popup
//         closeModal.addEventListener('click', function() {
//             modalBackground.style.display = 'none';  // Cacher le fond du modal (popup)
//         });

//         // Fermer le modal si l'utilisateur clique en dehors du formulaire
//         window.addEventListener('click', function(event) {
//             if (event.target === modalBackground) {
//                 modalBackground.style.display = 'none';  // Cacher le modal si on clique dehors
//             }
//         });

//         // Soumettre le formulaire
//         productFormContent.addEventListener('submit', function(event) {
//             event.preventDefault();  // Empêcher la soumission normale du formulaire

//             const productName = document.getElementById('productName').value;
//             const productDescription = document.getElementById('productDescription').value;
//             const productPrice = document.getElementById('productPrice').value;
//             const productImage = document.getElementById('productImage').files[0];

//             // Simule l'ajout du produit (ici on affiche une alerte)
//             alert('Produit ajouté: ' + productName);

//             // Réinitialiser le formulaire et cacher à nouveau le popup après soumission
//             productFormContent.reset();
//             modalBackground.style.display = 'none';  // Cacher le modal après l'ajout
//         });
   // S'assurer que le DOM est complètement chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner les éléments nécessaires
    const openFormButton = document.getElementById('openFormButton');
    const modalBackground = document.getElementById('modalBackground');
    const closeModal = document.getElementById('closeModal');
    
    // Ouvrir le popup lorsque l'utilisateur clique sur le bouton "Ajouter un produit"
    openFormButton.addEventListener('click', function() {
        modalBackground.style.display = 'block';  // Afficher le fond du modal
    });

    // Fermer le popup lorsque l'utilisateur clique sur le bouton "X"
    closeModal.addEventListener('click', function() {
        modalBackground.style.display = 'none';  // Cacher le fond du modal
    });

    // Fermer le modal si l'utilisateur clique en dehors du formulaire
    window.addEventListener('click', function(event) {
        if (event.target === modalBackground) {
            modalBackground.style.display = 'none';  // Cacher le modal
        }
    });
});


