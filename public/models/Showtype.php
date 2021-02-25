<?php
class Showtype extends ShowtypesManager
{
   private int $_id;
   private string $_type;

   public function __construct(array $datas)
   {
      $this->hydrate($datas);
   }

   public function hydrate(array $donnees)
   {
      foreach ($donnees as $key => $value)
         $method = 'set' . ucfirst($key);
      if (method_exists($this, $method)) {
         $this->$method($value);
      }
   }

   public function getId():int{
      return $this->_id;
   }

   public function getType():string{
      return $this->_type;
   }

   public function setId(int $id){
      $this->_id = $id;
   }

   public function setType(string $type){
      $this->_type = $type;
   }
}
