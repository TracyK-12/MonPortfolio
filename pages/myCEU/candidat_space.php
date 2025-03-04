
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidater - Commission Électorale Universitaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc; /* Fond doux */
            font-family: 'Arial', sans-serif;
        }
        
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 700px;
            margin: 50px auto;
        }

        .form-container h1 {
            font-size: 2rem;
            margin-bottom: 30px;
            text-align: center;
            color: #007bff;
        }

        .form-container label {
            font-weight: bold;
            color: #333;
        }

        .form-container .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-container .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-container button {
            background-color: #007bff;
            color: #fff;
            font-size: 1.2rem;
            padding: 10px 25px;
            border-radius: 30px;
            border: none;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .form-container .file-label {
            position: relative;
            margin-bottom: 20px;
        }

        .form-container .file-input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .form-container .file-label::after {
            content: '📷 Choisir une photo de profil';
            color: #007bff;
            font-size: 1rem;
            text-align: center;
            display: block;
            margin-top: 10px;
        }

        /* Effet de focus sur les champs */
        .form-container .form-control:focus + label {
            color: #007bff;
        }

        /* Animations d'entrée */
        .form-container {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .form-container .icon {
            font-size: 20px;
            color: #007bff;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Devenez un candidat !</h1>
        <form action="registre_candidat.php" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="firstName" class="form-label"><i class="fas fa-user icon"></i>Prénom</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>

            <div class="mb-4">
                <label for="lastName" class="form-label"><i class="fas fa-user icon"></i>Nom</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label"><i class="fas fa-envelope icon"></i>Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-4">
                <label for="phone" class="form-label"><i class="fas fa-phone icon"></i>Téléphone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="mb-4">
                <label for="course" class="form-label"><i class="fas fa-graduation-cap icon"></i>Programme d’études</label>
                <input type="text" class="form-control" id="course" name="course" required>
            </div>

            <div class="mb-4">
                <label for="campaign" class="form-label"><i class="fas fa-pen icon"></i>Message de campagne</label>
                <textarea class="form-control" id="campaign" name="campaign" rows="4" required></textarea>
            </div>

            <div class="file-label">
                <input type="file" class="file-input" id="photo" name="photo" accept="image/*">
            </div>

            <button type="submit">S'inscrire comme candidat</button>
        </form>
        <!-- Lien de retour vers la page d'accueil -->
<div class="text-center mt-4">
    <a href="index.php" class="btn btn-outline-primary"> <i class="fa-solid fa-left-long"></i> Retour à l'accueil</a> 
</div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
