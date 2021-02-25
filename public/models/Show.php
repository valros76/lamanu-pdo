<?php
class Show extends ShowsManager
{
   private int $_id;
   private string $_title;
   private string $_performer;
   private $_date;
   private int $_showTypesId;
   private int $_firstGenresId;
   private int $_secondGenreId;
   private $_duration;
   private $_startTime;

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

   public function getTitle():string{
      return $this->_title;
   }

   public function getPerformer():string{
      return $this->_performer;
   }

   public function getDate(){
      return $this->_date;
   }

   public function getShowTypesId():int{
      return $this->_showTypesId;
   }

   public function getFirstGenresId():int{
      return $this->_firstGenresId;
   }

   public function getSecondGenreId():int{
      return $this->_secondGenreId;
   }

   public function getDuration(){
      return $this->_duration;
   }

   public function getStartTime(){
      return $this->_startTime;
   }

   public function setId(int $id){
      $this->_id = $id;
   }
   
   public function setTitle(string $title){
      $this->_title = $title;
   }

   public function setPerformer(string $performer){
      $this->_performer = $performer;
   }

   public function setDate($date){
      $date = trim($date);
      str_replace(',', '-', $date);
      str_replace('|', '-', $date);
      str_replace(';', '-', $date);
      str_replace('/', '-', $date);
      str_replace(' ', '-', $date);
      list($y, $m, $d) = array_pad(explode('-', $date, 3), 3, 0);
      if(ctype_digit("$y$m$d") == true && checkdate($m, $d, $y) == true){
         $this->_date = $date;
      }
   }

   public function setShowTypesId(int $showTypesId){
      $this->_showTypesId = $showTypesId;
   }

   public function setFirstGenresId(int $firstGenresId){
      $this->_firstGenresId = $firstGenresId;
   }

   public function setSecondGenreId(int $secondGenreId){
      $this->_secondGenreId = $secondGenreId;
   }

   public function setDuration($duration){
      $date = trim($duration);
      str_replace(',', ':', $duration);
      str_replace('|', ':', $duration);
      str_replace(';', ':', $duration);
      str_replace('/', ':', $duration);
      str_replace(' ', ':', $duration);
      $this->_duration = $duration;
   }

   public function setStartTime($startTime){
      $date = trim($startTime);
      str_replace(',', ':', $startTime);
      str_replace('|', ':', $startTime);
      str_replace(';', ':', $startTime);
      str_replace('/', ':', $startTime);
      str_replace(' ', ':', $startTime);
      $this->_startTime = $startTime;
   }

}
