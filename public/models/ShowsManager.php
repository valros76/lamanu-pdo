<?php
class ShowsManager
{
   private $_bdd;

   public function __construct($bdd)
   {
      $this->setBdd($bdd);
   }

   public function add(Show $show)
   {
      $req = $this->_bdd->prepare('INSERT INTO `shows`(`title`,`performer`,`date`,`showTypesId`,`firstGenresId`,`secondGenreId`,`duration`,`startTime`) VALUES(:title,:performer,:date,:showTypesId,:firstGenresId,:secondGenreId,:duration,:startTime)');
      $req->bindValue(':title', $show->getTitle());
      $req->bindValue(':performer', $show->getPerformer());
      $req->bindValue(':date', $show->getDate());
      $req->bindValue(':showTypesId', $show->getShowTypesId());
      $req->bindValue(':firstGenresId', $show->getFirstGenresId());
      $req->bindValue(':secondGenreId', $show->getSecondGenreId());
      $req->bindValue(':duration', $show->getDuration());
      $req->bindValue(':startTime', $show->getStartTime());
      $req->execute();

      $show->hydrate([
         'id' => $this->_bdd->lastInsertId()
      ]);
   }

   public function delete(int $show_id)
   {
      $this->_bdd->exec('DELETE FROM shows WHERE id = ' . $show_id);
   }

   public function count()
   {
      return $this->_bdd->query('SELECT COUNT(id) FROM shows')->fetchColumn();
   }

   public function get(int $info)
   {
      if (is_int($info)) {
         $req = $this->_bdd->prepare('SELECT `id`,`title`,`performer`,`date`,`showTypesId`,`firstGenresId`,`secondGenreId`,`duration`,`startTime` FROM `shows` WHERE `id` = :id');
         $req->bindValue(':id', $info, PDO::PARAM_INT);
         $req->execute();
         return new Showtype($req->fetch(PDO::FETCH_ASSOC));
      }
   }

   public function getList()
   {
      $req = $this->_bdd->prepare('SELECT `id`,`title`,`performer`,`date`,`showTypesId`,`firstGenresId`,`secondGenreId`,`duration`,`startTime` FROM `shows` ORDER BY `id`');
      $req->execute();
      return $req->fetchAll(PDO::FETCH_OBJ);
   }

   public function filtred($filter){
      $set_req = 'SELECT `id`,`title`,`performer`,`date`,`showTypesId`,`firstGenresId`,`secondGenreId`,`duration`,`startTime` FROM `shows` WHERE type LIKE "'.$filter.'" ORDER BY `id`';
      $req = $this->_bdd->prepare($set_req);
      $req->execute();
      return $req->fetchAll(PDO::FETCH_OBJ);
   }

   public function update(Show $show): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `shows` SET `title`=:title,`performer`=:performer,`date`=:date,`showTypesId`=:showTypesId,`firstGenresId`=:firstGenresid,`secondGenreId`=:secondGenreId,`duration`=:duration,`startTime`=:startTime WHERE `id` = :id');
         $req->bindValue(':id', $show->getId(), PDO::PARAM_INT);
         $req->bindValue(':title', $show->getTitle());
         $req->bindValue(':performer', $show->getPerformer());
         $req->bindValue(':date', $show->getDate());
         $req->bindValue(':showTypesId', $show->getShowTypesId());
         $req->bindValue(':firstGenresId', $show->getFirstGenresId());
         $req->bindValue(':secondGenreId', $show->getSecondGenreId());
         $req->bindValue(':duration', $show->getDuration());
         $req->bindValue(':startTime', $show->getStartTime());
         $req->execute();
         $req->execute();
         $req->closeCursor();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateTitle(Show $show): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `shows` SET `title` = :title WHERE `id` =:id');
         $req->bindValue(':id', $show->getId(), PDO::PARAM_INT);
         $req->bindValue(':title', $show->getTitle());
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updatePerformer(Show $show): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `shows` SET `performer` = :performer WHERE `id` =:id');
         $req->bindValue(':id', $show->getId(), PDO::PARAM_INT);
         $req->bindValue(':performer', $show->getPerformer());
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateDate(Show $show): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `shows` SET `date` = :date WHERE `id` =:id');
         $req->bindValue(':id', $show->getId(), PDO::PARAM_INT);
         $req->bindValue(':date', $show->getDate());
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateShowTypesId(Show $show): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `shows` SET `showTypesId` = :showTypesId WHERE `id` =:id');
         $req->bindValue(':id', $show->getId(), PDO::PARAM_INT);
         $req->bindValue(':showTypesId', $show->getShowTypesId(), PDO::PARAM_INT);
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateFirstGenresId(Show $show): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `shows` SET `firstGenreId` = :firstGenreId WHERE `id` =:id');
         $req->bindValue(':id', $show->getId(), PDO::PARAM_INT);
         $req->bindValue(':firstGenresId', $show->getFirstGenresId(), PDO::PARAM_INT);
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateSecondGenreId(Show $show): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `shows` SET `secondGenreId` = :secondGenreId WHERE id =:id');
         $req->bindValue(':id', $show->getId(), PDO::PARAM_INT);
         $req->bindValue(':secondGenreId', $show->getSecondGenreId(), PDO::PARAM_INT);
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateDuration(Show $show): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `shows` SET `duration` = :duration WHERE `id` =:id');
         $req->bindValue(':id', $show->getId(), PDO::PARAM_INT);
         $req->bindValue(':duration', $show->getDuration());
         $req->execute();
         return true;
      } catch (Exception $e) {
         return false;
      }
   }

   public function updateStartTime(Show $show): bool
   {
      try {
         $req = $this->_bdd->prepare('UPDATE `shows` SET `startTime` = :startTime WHERE `id` = :id');
         $req->bindValue(':id', $show->getId(), PDO::PARAM_INT);
         $req->bindValue(':startTime', $show->getStartTime());
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
