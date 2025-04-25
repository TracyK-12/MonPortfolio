document.addEventListener("DOMContentLoaded", function () {
    const heroText = document.getElementById("heroText");
    let text = "Bonjour, je suis Tracy KAJE ✨";
    let index = 0;
  
    function typeWriter() {
      if (index < text.length) {
        heroText.innerHTML += text.charAt(index);
        index++;
        setTimeout(typeWriter, 100);
      }
    }
    typeWriter();
  
    emailjs.init("lQfBY5vqDUIBGJUWo");
  
    document.getElementById("contact-form").addEventListener("submit", function (event) {
      event.preventDefault();
  
      const formData = {
        user_name: document.getElementById("name").value,
        user_email: document.getElementById("email").value,
        message: document.getElementById("message").value,
      };
  
      emailjs.send("service_g7cnh5b", "template_tbe4ou2", formData)
        .then(() => {
          document.getElementById("feedback").innerText = "✅ Message envoyé avec succès !";
          document.getElementById("feedback").style.display = "block";
          document.getElementById("contact-form").reset();
        })
        .catch((error) => {
          document.getElementById("feedback").innerText = "❌ Une erreur est survenue.";
          document.getElementById("feedback").style.display = "block";
          console.error("Erreur EmailJS :", error);
        });
    });
  });
  