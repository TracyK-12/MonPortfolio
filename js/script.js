document.addEventListener("DOMContentLoaded", function () {
    emailjs.init("lQfBY5vqDUIBGJUWo");  

    document.getElementById("contact-form").addEventListener("submit", function (event) {
        event.preventDefault(); 

        // Récuperation des données du formulaire
        const formData = {
            user_name: document.getElementById("name").value,
            user_email: document.getElementById("email").value,
            message: document.getElementById("message").value,
        };

        // Envoyer l'email via EmailJS
        emailjs.send("service_g7cnh5b","template_tbe4ou2", formData) 
            .then(() => {
                console.log("Message envoyé avec succès !");
                document.getElementById("feedback").innerText = "✅ Message envoyé avec succès !";
                document.getElementById("feedback").style.display = "block";
                document.getElementById("contact-form").reset();
            })
            .catch((error) => {
                console.log("Une erreur est survenue lors de l'envoi du message.");
                document.getElementById("feedback").innerText = "❌ Une erreur est survenue.";
                document.getElementById("feedback").style.display = "block";
                console.error("Erreur EmailJS :", error);
            });
    });
});

