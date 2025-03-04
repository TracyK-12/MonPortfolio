                      
                      // GESTION DES BOUTONS TOGGLE

document.addEventListener("DOMContentLoaded", function() {

    const skillsSection = document.querySelector("#skills");
    const projetSection = document.querySelector("#projet");

    if (skillsSection && projetSection) {
        
        const toggleSkillsBtn = document.createElement("button");
        const toggleProjetBtn = document.createElement("button");

        
        toggleSkillsBtn.innerHTML = `Afficher/Masquer Compétences <span class="icon">▼</span>`;
        toggleProjetBtn.innerHTML = `Afficher/Masquer Projets <span class="icon">▼</span>`;

        
        toggleSkillsBtn.classList.add("toggle-btn");
        toggleProjetBtn.classList.add("toggle-btn");

       
        skillsSection.parentNode.insertBefore(toggleSkillsBtn, skillsSection);
        projetSection.parentNode.insertBefore(toggleProjetBtn, projetSection);

                                     
        // Gestion du clic sur les boutons
        toggleSkillsBtn.addEventListener("click", function() {
            skillsSection.style.display = (skillsSection.style.display === "none" ? "block" : "none");

                                    // Changer l'icône en fonction de l'état
            const icon = toggleSkillsBtn.querySelector(".icon");
            icon.innerHTML = skillsSection.style.display === "none" ? "▲" : "▼"; // ▲ Dropup, ▼ Dropdown
        });

        toggleProjetBtn.addEventListener("click", function() {
            projetSection.style.display = (projetSection.style.display === "none" ? "block" : "none");
            // Changer l'icône en fonction de l'état
            const icon = toggleProjetBtn.querySelector(".icon");
            icon.innerHTML = projetSection.style.display === "none" ? "▲" : "▼"; // ▲ Dropup, ▼ Dropdown
        });
    } else {
        console.error("⚠️ Erreur : Les sections #skills et/ou #projet sont introuvables dans le DOM.");
    }
});
                                           // SCRIPT FORMULAIRE

document.addEventListener("DOMContentLoaded", function() {
                                 /**  1. GESTION DU FORMULAIRE **/

    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Empêcher l'envoi du formulaire

            let isValid = true;
            let formData = {};

            // Sélectionner tous les champs du formulaire
            const inputs = form.querySelectorAll("input, textarea");

            inputs.forEach(input => {
                const value = input.value.trim();
                const fieldName = input.placeholder || input.name; // Récupérer le placeholder ou name

                // Vérifier si le champ est vide
                if (value === "") {
                    isValid = false;
                    input.style.border = "2px solid red";
                    alert(`❌ Le champ "${fieldName}" est obligatoire.`);
                } else {
                    input.style.border = "2px solid green";
                    formData[fieldName] = value; // Stocker les données dans un objet
                }

                // Vérifier si l'email est valide
                if (input.type === "email") {
                    if (!validateEmail(value)) {
                        isValid = false;
                        input.style.border = "2px solid red";
                        alert("❌ Veuillez entrer une adresse e-mail valide.");
                    }
                }
            });

            // Si tout est OK, afficher les données du formulaire dans la console
            if (isValid) {
                console.log("✅ Données du formulaire :");
                console.table(formData); // Afficher les données sous forme de tableau dans la console
                alert("✔️ Formulaire soumis avec succès !");
                form.reset(); // Réinitialiser le formulaire après envoi
            }
        });

        /**  2. FONCTION DE VALIDATION EMAIL **/
        function validateEmail(email) {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return emailPattern.test(email);
        }
    } else {
        console.error("⚠️ Erreur : Formulaire introuvable dans le DOM.");
    }
});
 //   SCRIPT MODALE INSCRIPTION
document.addEventListener("DOMContentLoaded", function() {
    const openModalBtn = document.getElementById("openModal");
    const modal = document.getElementById("modal1");
    const closeModalBtn = document.querySelector(".close");

    // Ouvrir la modale
    openModalBtn.addEventListener("click", function() {
        modal.style.display = "flex";
    });

    // Fermer la modale
    closeModalBtn.addEventListener("click", function() {
        modal.style.display = "none";
    });

    // Fermer la modale en cliquant à l'extérieur
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});

// SCRIPT MODALE ENREGISTREMENT

document.addEventListener("DOMContentLoaded", function() {
    const registerModal = document.getElementById("registerModal");
    const registerBtn = document.getElementById("openRegisterModal");
    const closeBtn = registerModal.querySelector(".close");
    const form = document.getElementById("registerForm");

    // Ouvrir la modale
    registerBtn.addEventListener("click", function() {
        registerModal.style.display = "flex";
    });

    // Fermer la modale
    closeBtn.addEventListener("click", function() {
        registerModal.style.display = "none";
    });

    // Fermer la modale en cliquant à l'extérieur
    window.addEventListener("click", function(event) {
        if (event.target === registerModal) {
            registerModal.style.display = "none";
        }
    });

    // Validation du formulaire
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Empêche l'envoi par défaut

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        if (name === "" || email === "" || password === "" || confirmPassword === "") {
            alert("❌ Tous les champs sont obligatoires !");
            return;
        }

        if (!validateEmail(email)) {
            alert("❌ Veuillez entrer une adresse e-mail valide.");
            return;
        }

        if (password.length < 6) {
            alert("❌ Le mot de passe doit contenir au moins 6 caractères.");
            return;
        }

        if (password !== confirmPassword) {
            alert("❌ Les mots de passe ne correspondent pas !");
            return;
        }

        console.log("✅ Inscription réussie !");
        console.table({ Nom: name, Email: email, Password: password });

        alert("✔️ Compte créé avec succès !");
        form.reset(); // Réinitialise le formulaire
        registerModal.style.display = "none"; // Ferme la modale
    });

    // Fonction de validation email
    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailPattern.test(email);
    }
});

