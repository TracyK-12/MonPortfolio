<?php
require_once "model/user.php";

// 👤 Création de l'admin
$admin = new NishUser();
$admin->setName("Tracy Kaje")
      ->setEmail("tracy.kaje" . rand(1,9999) . "@test.com")
      ->encryptPassword("test123")
      ->setStatus("admin")
      ->setCreated_at(new DateTime());

// 👤 Création de l'employé
$employee = new NishUser();
$employee->setName("Tsk Kaje")
        ->setEmail("tsk.kaje" . rand(1,9999) . "@test.com")
        ->encryptPassword("test123")
        ->setStatus("employee") // ⚠️ Bien sans accent
        ->setCreated_at(new DateTime());

// 🔎 Debug AVANT insertion
echo "<pre>AVANT INSERTION\n";
var_dump($admin);
var_dump($employee);
echo "</pre>";

// 🔁 Insertion
$ret1 = createUser($admin);
$ret2 = createUser($employee);

echo "<hr>";

// ✅ Vérification
if ($ret1 && $ret2) {
    echo "<h2>✅ Utilisateurs enregistrés avec succès !</h2>";

    $users = getAllUsers();
    echo "<h3>📋 Liste des utilisateurs</h3>";
    echo "<ul>";
    foreach ($users as $u) {
        echo "<li><strong>{$u->getName()}</strong> — Status: <em>{$u->getStatus()}</em> — Email: {$u->getEmail()}</li>";
    }
    echo "</ul>";
} else {
    echo "<h2>❌ Erreur lors de l'enregistrement.</h2>";
    if (!$ret1) echo "<p>❌ Insertion admin échouée</p>";
    if (!$ret2) echo "<p>❌ Insertion employé échouée</p>";
}
?>
