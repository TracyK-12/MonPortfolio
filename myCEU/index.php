<!-- lien page : http://localhost/myCEU/ -->

<?php
// Paramètres de connexion à la base de données
$host = "localhost";       // Serveur MySQL (par défaut : localhost)
$username = "root";        // Nom d'utilisateur (par défaut : root)
$password = "";            // Mot de passe (vide par défaut pour WAMP)
$dbname = "ceu";           // Nom de la base de données

// Connexion à MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commission Électorale Universitaire</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Votre propre fichier CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- En-tête -->
    <header class="bg-primary text-white py-3">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <div class="logo">
                <img class=" rounded-circle" src="assets/images/CEU.png" alt="Logo CEU" style="height: 70px;">
            </div>
            <!-- Navigation -->
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#apropos">A propos de nous</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="candidat_space.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="login.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#contact">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Section principale -->
    <section id="accueil">
        <main class="py-5">
            <div class="container">
                <h1 class="text-center">Bienvenue à la Commission Électorale Universitaire</h1>
                <p class="text-center mt-4">
                    Cette plateforme permet aux étudiants de l'université de candidater et de voter en ligne pour les représentants étudiants.
                </p>
            </div>
        </main>
    </section>
          
    <!-- Section À propos de nous -->
    <section id="apropos" class="py-5 bg-light" id="about">
        <div class="container">
            <h2 class="text-center mb-4">À propos de nous</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>
                        La <strong>Commission Électorale Universitaire (CEU)</strong> est une plateforme dédiée à l'organisation et à la gestion des élections universitaires. 
                        Elle permet aux étudiants de participer activement en tant que candidats ou électeurs, dans un environnement transparent, sécurisé et accessible.
                    </p>
                    <p>
                        Notre objectif est de favoriser une meilleure implication des étudiants dans la gouvernance universitaire, tout en garantissant l'équité et la confidentialité 
                        des votes grâce à des outils numériques modernes.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/about.jpg" alt="Image CEU" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Section Avantages -->
<section class="py-5 bg-white" id="advantages">
    <div class="container">
        <h2 class="text-center mb-4">Les avantages de cette plateforme</h2>
        <div class="row g-4">
            <!-- Avantage 1 -->
            <div class="col-md-4">
                <div class="advantage-card text-center">
                    <div class="advantage-icon">
                        <i class="fas fa-vote-yea fa-3x text-primary"></i>
                    </div>
                    <div class="advantage-text mt-3">
                        <h5>Vote électronique sécurisé</h5>
                        <p>
                            Facilite les votes en ligne et élimine les risques de trucages grâce à un système sécurisé et transparent.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Avantage 2 -->
            <div class="col-md-4">
                <div class="advantage-card text-center">
                    <div class="advantage-icon">
                        <i class="fas fa-comments fa-3x text-success"></i>
                    </div>
                    <div class="advantage-text mt-3">
                        <h5>Interactions et propagande en ligne</h5>
                        <p>
                            Les candidats peuvent promouvoir leurs idées en ligne et les électeurs peuvent interagir via des likes et des commentaires.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Avantage 3 -->
            <div class="col-md-4">
                <div class="advantage-card text-center">
                    <div class="advantage-icon">
                        <i class="fas fa-chart-bar fa-3x text-danger"></i>
                    </div>
                    <div class="advantage-text mt-3">
                        <h5>Résultats rapides</h5>
                        <p>
                            Les résultats sont affichés instantanément à la fin des élections, sans risque d'erreurs humaines.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="portfolio" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Nos anciens candidats élus</h2>
        <div class="row">

            <!-- Premier candidat -->
            <div class="col-md-4">
                <div class="card shadow-sm hover-zoom">
                    <img src="assets/images/etudiant1.jpg" class="card-img-top" alt="Candidat 1">
                    <div class="card-body">
                        <h5 class="card-title">Jean Dupont</h5>
                        <p class="card-text">Élu en 2020, Jean a apporté de nombreuses améliorations au sein de l'université en mettant en place de nouvelles initiatives étudiantes.</p>
                    </div>
                </div>
            </div>

            <!-- Deuxième candidat -->
            <div class="col-md-4">
                <div class="card shadow-sm hover-zoom">
                    <img src="assets/images/etudiant2.jpg" class="card-img-top" alt="Candidat 2">
                    <div class="card-body">
                        <h5 class="card-title">Marie Curie</h5>
                        <p class="card-text">Présidente en 2021, Marie a dirigé plusieurs projets liés à la recherche et à l'innovation au sein de la faculté.</p>
                    </div>
                </div>
            </div>

            <!-- Troisième candidat -->
            <div class="col-md-4">
                <div class="card shadow-sm hover-zoom">
                    <img src="assets/images/etudiant3.jpg" class="card-img-top" alt="Candidat 3">
                    <div class="card-body">
                        <h5 class="card-title">Ahmed Ben Salah</h5>
                        <p class="card-text">Ahmed a favorisé une meilleure inclusion des étudiants étrangers et a promu la diversité culturelle.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




    <!-- Section Boutons d'action -->
    <section class="py-5 text-center" id="actions">
        <div class="container">
            <h2 class="mb-4">Rejoignez l'initiative</h2>
            <p class="mb-5">
                Souhaitez-vous participer en tant que candidat ou simplement voter pour élire vos représentants ?
            </p>
            <div>
                <a href="candidat_space.php" class="btn btn-primary btn-lg me-3">S'incrire</a>
                <a href="login.php" class="btn btn-success btn-lg">Se connecter</a>
            </div>
        </div>



</section>
</main>


    
    <!-- Section Contact -->
    <section id="contact" class="py-5 bg-dark text-white">
        <!-- Pied de page -->
        <!-- Footer avec Contact -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row">
                    <!-- Google Map -->
                    <div class="col-md-6 mb-4">
                        <h4>Notre emplacement</h4>
                        <!-- Remplacer par votre propre emplacement dans Google Maps -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.084624013347!2d-122.41941898468176!3d37.774929779759594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085808d42e456f3%3A0xb56bdbca90b8b477!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1618705679393!5m2!1sen!2sus" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

                    <!-- Formulaire de Contact -->
                    <div class="col-md-6">
                        <h4>Laissez-nous un message</h4>
                        <form action="send-message.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Sujet</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-dark text-white py-3">
                <div class="container text-center">
                    <p>&copy; 2025 Commission Électorale Universitaire. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
