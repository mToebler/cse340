<?php
class Review {

   public $reviewId = 0;
   public $reviewText = '';
   public $reviewDate;
   public $invId = 0;
   public $clientId = 0;

   function __construct($rText, $iId, $cId) {
      $this->reviewText = $rText;
      $this->invId = $iId;
      $this->clientId = $cId;
      // $this->reviewDate = new DateTime();
   }
}



?>
