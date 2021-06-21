<?php


class viewApplicationController
{

private $DB;

    public function __construct(){
    $this->DB = new Dao();
    }


public function viewAllApplications(){
    $result="";
    try{
        $receiveApplcation = $this->DB->receiveApplcation($_SESSION['email']);
        $name = $this->DB->receiveNameUser($_SESSION['email']);
        foreach ($receiveApplcation as $application){
            $result.$this->viewApplication($application['name'], $application['subject'], $application['description'], $name, $_SESSION['email'], $application['id']);
        }
    }
    catch (Exception $ex){
        echo $ex->getMessage();
    }
}


public function viewApplication($applicationName, $subject, $description, $userName, $email, $applicationId)
   {
       session_start();
       echo '
               <div class="col">
                   <div  class="card shadow-sm">
                       <svg class="bd-placeholder-img card-img-top" width="100%" height="20" xmlns="http://www.w3.org/2000/svg" role="img"
                            aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                           <title>Placeholder</title>                   
                           <strong style="font-size: 20px;" class="text-muted">'.$applicationId.'</strong>
                   </svg>
                       <div class="card-body">
                       <p class="card-text"><strong>'.$subject.'</strong></p>
                           <p class="card-text">'.$description.'</p>
                           <div class="d-flex justify-content-between align-items-center">
                           <div>
                                <text> Автор: '.$userName.'<br>email:'. $email.'</text> 
                           </div>
                               <div>
                                   <button type="button" onclick="location.href = \'templates/viewApplication.php?applicationId='.$applicationId.'\';"  class="btn btn-em btn-outline-secondary">Просмотреть</button>
                         
                               </div>
                               
                               
                               
                           </div>
                       </div>
                   </div>
               </div>';
   }


}



?>


