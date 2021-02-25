<?php
class Client extends ClientsManager
{
   private int $_id;
   private string $_lastName;
   private string $_firstName;
   private $_birthDate;
   private int $_card;
   private int $_cardNumber;

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

   public function getLastName():string{
      return $this->_lastName;
   }

   public function getFirstName():string{
      return $this->_firstName;
   }

   public function getBirthDate(){
      return $this->_birthDate;
   }

   public function getCard():int{
      return $this->_card;
   }

   public function getCardNumber():int{
      return $this->_cardNumber;
   }

   public function setId(int $id){
      $this->_id = $id;
   }

   public function setLastName(string $lastname){
      $this->_lastName = $lastname;
   }

   public function setFirstName(string $firstname){
      $this->_firstName = $firstname;
   }

   public function setBirthDate($birthdate){
      $birthdate = trim($birthdate);
      str_replace(',', '-', $birthdate);
      str_replace('|', '-', $birthdate);
      str_replace(';', '-', $birthdate);
      str_replace('/', '-', $birthdate);
      str_replace(' ', '-', $birthdate);
      list($y, $m, $d) = array_pad(explode('-', $birthdate, 3), 3, 0);
      if(ctype_digit("$y$m$d") == true && checkdate($m, $d, $y) == true){
         $this->_birthDate = $birthdate;
      }
   }

   public function setCard(int $card){
      $this->_card = $card;
   }

   public function setCardNumber(int $cardnumber){
      $this->_cardNumber = $cardnumber;
   }
}
