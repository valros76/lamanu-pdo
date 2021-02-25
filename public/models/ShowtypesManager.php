<?php
class ShowtypesManager
{
   private $_bdd;

   public function __construct($bdd)
   {
      $this->setBdd($bdd);
   }

   public function add(Showtype $showtype)
   {
      $req = $this->_bdd->prepare('INSERT INTO `showtypes`(`type`) VALUES(:type)');
      $req->bindValue(':type', $showtype->getType());
      $req->execute();

      $showtype->hydrate([
         'id' => $this->_bdd->lastInsertId()
      ]);
   }

   public function delete(int $showtype_id)
   {
      $this->_bdd->exec('DELETE FROM `showtypes` WHERE `id` = ' . $showtype_id);
   }

   public function count()
   {
      return $this->_bdd->query('SELECT COUNT(`id`) FROM `showtypes`')->fetchColumn();
   }

   public function get(int $info)
   {
      if (is_int($info)) {
         $req = $this->_bdd->prepare('SELECT `id`, `type` FROM `showtypes` WHERE `id` = :id');
         $req->bindValue(':id', $info, PDO::PARAM_INT);
         $req->execute();
         return new Showtype($req->fetch(PDO::FETCH_ASSOC));
      }
   }

   public function getList()
   {
      $req = $this->_bdd->prepare('SELECT `id`, `type` FROM `showtypes` ORDER BY `id`');
      $req->execute();
      return $req->fetchAll(PDO::FETCH_OBJ);
   }

   public function filtred($filter){
      $set_req = 'SELECT `id`,`type` FROM `showtypes` WHERE `type` LIKE "'.$filter.'" ORDER BY `id`';
      $req = $this->_bdd->prepare($set_req);
      $req->execute();
      return $req->fetchAll(PDO::FETCH_OBJ);
   }

   public function update(Showtype $showtype): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `showtypes` SET `type`=:type WHERE `id` = :id');
         $req->bindValue(':id', $showtype->getId(), PDO::PARAM_INT);
         $req->bindValue(':type', $showtype->getType());
         $req->execute();
         $req->closeCursor();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateType(Showtype $showtype): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `showtypes` SET `type` = :type WHERE `id` =:id');
         $req->bindValue(':id', $showtype->getId(), PDO::PARAM_INT);
         $req->bindValue(':type', $showtype->getType());
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
