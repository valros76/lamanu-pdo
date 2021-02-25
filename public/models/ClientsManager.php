<?php
class ClientsManager
{
   private $_bdd;

   public function __construct($bdd)
   {
      $this->setBdd($bdd);
   }

   public function add(Client $client)
   {
      $req = $this->_bdd->prepare('INSERT INTO `clients`(`lastName`,`firstName`,`birthDate`,`card`,`cardNumber`) VALUES(:lastName,:firstName,:birthDate,:card,:cardNumber)');
      $req->bindValue(':lastname', $client->getLastName());
      $req->bindValue(':firstName', $client->getFirstName());
      $req->bindValue(':birthDate', $client->getBirthDate());
      $req->bindValue(':card', $client->getCard(), PDO::PARAM_INT);
      $req->bindValue(':cardNumber', $client->getCardNumber(), PDO::PARAM_INT);
      $req->execute();

      $client->hydrate([
         'id' => $this->_bdd->lastInsertId()
      ]);
   }

   public function delete(int $client_id)
   {
      $this->_bdd->exec('DELETE FROM `clients` WHERE id = ' . $client_id);
   }

   public function count()
   {
      return $this->_bdd->query('SELECT COUNT(id) FROM `clients`')->fetchColumn();
   }

   public function get(int $info)
   {
      if (is_int($info)) {
         $req = $this->_bdd->prepare('SELECT `id`, `lastName`, `firstName`, `birthDate`, `card`, `cardNumber` FROM `clients` WHERE `id` = :id');
         $req->bindValue(':id', $info, PDO::PARAM_INT);
         $req->execute();
         return new Client($req->fetch(PDO::FETCH_ASSOC));
      }
   }

   public function getList()
   {
      $req = $this->_bdd->prepare('SELECT `id`, `lastName`, `firstName`, DATE_FORMAT(birthDate, "%e-%c-%Y") as `birthDate`, `card`, `cardNumber` FROM `clients` ORDER BY `id`');
      $req->execute();
      return $req->fetchAll(PDO::FETCH_OBJ);
   }

   public function getListLimit(int $limit = 1){
      $setLimit = 'SELECT `id`, `lastName`, `firstName`, DATE_FORMAT(birthDate, "%e-%c-%Y") as `birthDate`, `card`, `cardNumber` FROM `clients` ORDER BY `id` LIMIT '.$limit;
      $req = $this->_bdd->prepare($setLimit);
      $req->execute();
      return $req->fetchAll(PDO::FETCH_OBJ);
   }

   public function getClientsWithCard(){
      $req = $this->_bdd->prepare('SELECT `id`,`lastName`,`firstName` FROM `clients` WHERE `card` = 1 ORDER BY `id`');
      $req->execute();
      return $req->fetchAll(PDO::FETCH_OBJ);
   }

   public function filtred($column, $filter, $order){
      $set_req = 'SELECT `id`,`lastName`,`firstName` FROM `clients` WHERE '.$column.' LIKE "'.$filter.'" ORDER BY '.$order;
      $req = $this->_bdd->prepare($set_req);
      $req->execute();
      return $req->fetchAll(PDO::FETCH_OBJ);
   }

   public function update(Client $client): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `clients` SET `lastName`=:lastName,`firstName`=:firstName,`birthDate`=:birthDate,`card`=:card,`cardNumber`=:cardNumber WHERE `id` = :id');
         $req->bindValue(':id', $client->getId(), PDO::PARAM_INT);
         $req->bindValue(':lastName', $client->getLastName());
         $req->bindValue(':firstName', $client->getFirstName());
         $req->bindValue(':birthDate', $client->getBirthDate());
         $req->bindValue(':card', $client->getCard(), PDO::PARAM_INT);
         $req->bindValue(':cardNumber', $client->getCardNumber(), PDO::PARAM_INT);
         $req->execute();
         $req->closeCursor();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateLastName(Client $client): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `clients` SET `lastName` = :lastName WHERE `id` =:id');
         $req->bindValue(':id', $client->getId(), PDO::PARAM_INT);
         $req->bindValue(':lastName', $client->getLastName());
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateFirstName(Client $client): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `clients` SET `firstName` = :firstName WHERE `id` =:id');
         $req->bindValue(':id', $client->getId(), PDO::PARAM_INT);
         $req->bindValue(':firstName', $client->getFirstName());
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateBirthDate(Client $client): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `clients` SET `birthDate` = :birthDate WHERE `id` =:id');
         $req->bindValue(':id', $client->getId(), PDO::PARAM_INT);
         $req->bindValue(':birthDate', $client->getBirthDate());
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateCard(Client $client): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `clients` SET `card` = :card WHERE `id` =:id');
         $req->bindValue(':id', $client->getId(), PDO::PARAM_INT);
         $req->bindValue(':card', $client->getCard(),PDO::PARAM_INT);
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateCardNumber(Client $client): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `clients` SET `cardNumber` = :cardNumber WHERE `id` =:id');
         $req->bindValue(':id', $client->getId(), PDO::PARAM_INT);
         $req->bindValue(':cardNumber', $client->getCardNumber(),PDO::PARAM_INT);
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   private function setBdd($bdd)
   {
      $this->_bdd = $bdd;
   }
}
