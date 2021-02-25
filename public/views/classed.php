<?php
/* Afficher tous les clients. */
$clientsManager = new ClientsManager($bdd);
$clients = $clientsManager->getList();
$clientsLimit = $clientsManager->getListLimit(20);
$clientsWithCards = $clientsManager->getClientsWithCard();
$clientsLastnameBeginByM = $clientsManager->filtred('lastName','M%','lastName');
$showtypesManager = new ShowtypesManager($bdd);
$showtypes = $showtypesManager->getList();
$showPresentations = $bdd->query('SELECT title,performer,DATE_FORMAT(date, "%e-%c-%Y") as date,startTime FROM shows ORDER BY title')->fetchAll(PDO::FETCH_OBJ);
ob_start();; ?>
<section class="main-sections grid-auto-fill-row-dense grid-row-100">
   <h2 class="grid-row-100 flex">
      Afficher tous les clients
   </h2>
   <?php
   foreach ($clients as $client) {; ?>
      <div class="data-card flex-column-center">
         <h2><?= $client->id ;?></h2>
         <p>
            <?= $client->firstName . ' ' . $client->lastName; ?>
         </p>
      </div>
   <?php
   }; ?>
</section>

<section class="main-sections grid-auto-fill-row-dense grid-row-100">
   <h2 class="grid-row-100 flex">
      Afficher tous les types de spectacles possibles.
   </h2>
   <?php
   foreach ($showtypes as $showtype) {; ?>
      <div class="data-card flex-column-center">
         <h2><?= $showtype->id; ?></h2>
         <p>
            <?= $showtype->type; ?>
         </p>
      </div>
   <?php
   }; ?>
</section>

<section class="main-sections grid-auto-fill-row-dense grid-row-100">
   <h2 class="grid-row-100 flex">
      Afficher les 20 premiers clients.
   </h2>
   <?php
   foreach ($clientsLimit as $limit_client) {; ?>
      <div class="data-card flex-column-center">
         <h2><?= $limit_client->id; ?></h2>
         <p>
            <?= $limit_client->lastName . ' ' . $limit_client->firstName; ?>
         </p>
      </div>
   <?php
   }; ?>
</section>

<section class="main-sections grid-auto-fill-row-dense grid-row-100">
   <h2 class="grid-row-100 flex">
      N'afficher que les clients possédant une carte de fidélité.
   </h2>
   <?php
   foreach ($clientsWithCards as $clientsWithCard) {; ?>
      <div class="data-card flex-column-center">
         <h2><?= $clientsWithCard->id; ?></h2>
         <p>
            <?= $clientsWithCard->lastName . ' ' . $clientsWithCard->firstName; ?>
         </p>
      </div>
   <?php
   }; ?>
</section>

<section class="main-sections grid-auto-fill-row-dense grid-row-100">
   <h2 class="grid-row-100 flex">
      Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".<br />
      Les afficher comme ceci :<br />
      Nom : Nom du client<br />
      Prénom : Prénom du client<br />
      Trier les noms par ordre alphabétique.
   </h2>
   <?php
   foreach ($clientsLastnameBeginByM as $clientsByM) {; ?>
      <div class="data-card flex-column-center">
         <h2><?= $clientsByM->id; ?></h2>
         <p>
            Nom : <?= $clientsByM->lastName; ?>
         </p>
         <p>
            Prénom : <?= $clientsByM->firstName; ?>
         </p>
      </div>
   <?php
   }; ?>
</section>

<section class="main-sections grid-auto-fill-row-dense grid-row-100">
   <h2 class="grid-row-100 flex">
      Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure.<br />
      Trier les titres par ordre alphabétique.
      <br />
      Afficher les résultat comme ceci : Spectacle par artiste, le date à heure.
   </h2>
   <?php
   foreach ($showPresentations as $showPresentation) {; ?>
      <div class="data-card flex-column-center">
         <h2><?= $showPresentation->title; ?> par <?= $showPresentation->performer; ?></h2>
         <p>
            Le <?= $showPresentation->date; ?> à <?= $showPresentation->startTime; ?>
         </p>
      </div>
   <?php
   }; ?>
</section>

<section class="main-sections grid-auto-fill-row-dense grid-row-100">
   <h2 class="grid-row-100 flex">
      Afficher tous les clients comme ceci :<br />
      Nom : Nom de famille du client<br />
      Prénom : Prénom du client<br />
      Date de naissance : Date de naissance du client<br />
      Carte de fidélité : Oui (Si le client en possède une) ou Non (s'il n'en possède pas)<br />
      Numéro de carte : Numéro de la carte fidélité du client s'il en possède une.
   </h2>
   <?php
   foreach ($clients as $client) {; ?>
      <div class="data-card flex-column-center">
         <h2><?= $client->id; ?></h2>
         <p>
            <?= $client->firstName; ?>
         </p>
         <p>
            <?= $client->lastName; ?>
         </p>
         <p>
            Date de naissance : <br/><?= $client->birthDate; ?>
         </p>
         <p>
            Carte de fidélité :
            <?php
            if ($client->card != 0) {
               echo 'Non';
            } else {
               echo 'Oui<br/>Numéro de carte : '.$client->cardNumber;
            }; ?>
         </p>
      </div>
   <?php
   }; ?>
</section>


<?php
$mainContent = ob_get_clean();
require 'public/templates/default_template.php';; ?>