    <?php
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Paramètres de connexion à la base de données
            $host = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "ceu";

            // Connexion à la base de données
            $conn = new mysqli($host, $db_username, $db_password, $dbname);

            // Vérifiez la connexion
            if ($conn->connect_error) {
                die("Erreur de connexion à la base de données : " . $conn->connect_error);
            }

            // Préparez et exécutez la requête SQL
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Vérifiez si l'utilisateur existe
            if ($result->num_rows > 0) {
                $_SESSION['loggedin'] = true;
                header('Location: ../index.php');
                exit;
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect";
            }

            // Fermez la connexion
            $stmt->close();
            $conn->close();
        }
        ?>

        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Connexion</title>
            <style>
                                body {
                                        font-family: Arial, sans-serif;
                                        background-color: #f0f0f0;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        height: 100vh;
                                        margin: 0;
                                        opacity: 0;
                                        animation: fadeIn 1s forwards;
                                }
                                @keyframes fadeIn {
                                        to {
                                                opacity: 1;
                                        }
                                }
                                .login-container {
                                        background-color: #fff;
                                        padding: 20px;
                                        border-radius: 8px;
                                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                        width: 300px;
                                        text-align: center;
                                }
                                .login-container h2 {
                                        margin-bottom: 20px;
                                }
                                .login-container label {
                                        display: block;
                                        margin-bottom: 5px;
                                        text-align: left;
                                }
                                .login-container input {
                                        width: 50%;
                                        padding: 10px;
                                        margin-bottom: 10px;
                                        border: 1px solid #ccc;
                                        border-radius: 4px;
                                        transition: transform 0.3s ease;
                                }
                                .login-container input:focus {
                                        transform: scale(1.05);
                                        border-color: #007BFF;
                                }
                                .login-container button {
                                        width: 100%;
                                        padding: 10px;
                                        background-color: #007BFF;
                                        border: none;
                                        border-radius: 4px;
                                        color: white;
                                        font-size: 16px;
                                        cursor: pointer;
                                }
                                /* .login-container button:hover {
                                        background-color: #0056b3;
                                } */
                                .error {
                                        color: red;
                                        margin-bottom: 10px;
                                }
                                .retour{
                                        width: 100%;
                                        padding: 10px;
                                        background-color:rgb(70, 73, 77);
                                        border: none;
                                        border-radius: 4px;
                                        color: white;
                                        font-size: 16px;
                                        cursor: pointer;
                                }
                        </style>
        </head>
        <body>
            <div class="login-container">
                <h2>Connexion</h2>
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="post" action="">
                    <label for="username">Nom d'utilisateur:</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit">Se connecter</button>
                </form>
                <form method="get" action="index.php">
                    <button class="retour" type="submit">Retour à l'accueil</button>
                </form>
            </div>
        </body>
        </html>