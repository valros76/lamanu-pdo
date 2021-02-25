<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="public/sources/css/style.css">
   <title>La Manu - PDO - Webdevoo</title>
</head>
<body>
   <header class="main-head flex-center">
      <h1>La Manu PDO</h1>
   </header>
   <main class="main-content grid-auto-row-dense">
      <?= $mainContent ?? '<section class="main-sections">
      <h2>Erreur</h2>
      <p>Contenu introuvable...</p>
      </section>';?>
   </main>
</body>
</html>