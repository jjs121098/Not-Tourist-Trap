<?php

include '../Model/TourGuide.php';

//session_start();

class GuideController
{
    private $name;
    private $country;
    private $state;
    private $tourImg = array();
    private $textDescription;
    private $tourPrice;
    private $tourStartDate;
    private $tourEndDate;
    private $tourSize;

    public function __construct($name, $country, $state, $textDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize)
    {
        $this->name = $name;
        $this->country = $country;
        $this->state = $state;
        $this->textDescription = $textDescription;
        $this->tourPrice = $tourPrice;
        $this->tourStartDate = $tourStartDate;
        $this->tourEndDate = $tourEndDate;
        $this->tourSize = $tourSize;

        for($i = 0; $i < count($tourImg); $i++)
        {
            $this->tourImg[$i] = $tourImg[$i];
        }
    }

    //function to check form
    public function submitTourForm()
    {
        //Check if any form is left empty
        if($this->name == '' || $this->country == '' || $this->state =='' || $this->tourImg == '' || $this->textDescription == '' || $this->tourPrice =='' || $this->tourSize == '')
        {
            return false;
        }
        else //pass to tourist entity
        {
            $user = new TourGuide($_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'],$_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

            //generate tour
            $check = $user->submitTour($this->name, $this->country, $this->state, $this->textDescription, $this->tourImg, $this->tourPrice, $this->tourStartDate, $this->tourEndDate, $this->tourSize);
            
            return $check;
        }   
    }

    
}

?>
