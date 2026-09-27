<?php
    $dbHost = getenv('ATDB_HOST') ?: 'localhost';
    $dbUser = getenv('ATDB_USER') ?: 'atdb';
    $dbName = getenv('ATDB_NAME') ?: 'atdb';
    $dbPassword = getenv('ATDB_PASSWORD');

    if ($dbPassword === false) {
        http_response_code(500);
        exit('Database configuration is missing.');
    }

    $dbc = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
    if (!$dbc) {
        http_response_code(500);
        exit('Database connection failed.');
    }

    mysqli_set_charset($dbc, 'utf8mb4');

    session_start();

    // SET UP LANGUAGE:
		if (!isset($_SESSION['lang']))
				$_SESSION['lang'] = "hun";
		else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
				if ($_GET['lang'] == "hun")
				  	$_SESSION['lang'] = "hun";
				else if ($_GET['lang'] == "eng")
				  	$_SESSION['lang'] = "eng";
		}
	 
		$fields="keyword, " . $_SESSION['lang'];
		$query_trans = "SELECT $fields FROM translations";
		$result = mysqli_query($dbc, $query_trans);
		$lang = array();
		while ($row = mysqli_fetch_assoc($result)) {
				$lang[$row['keyword']] = $row[$_SESSION['lang']];
		}

    // SET UP PROGRAMS VARIABLE CONTENT
    /*$query = "SELECT * FROM organizers INNER JOIN programs 
    ON organizers.OrganizerID = programs.OrganizerID 
    WHERE programs.Ready='yes' 
    AND programs.StartDate > NOW() 
    ORDER BY programs.StartDate";*/

    // program table query
    //AND programs.EndDate >= CURDATE() 

    //$query_prog = "SELECT * FROM programs 
    //WHERE programs.Ready='yes'     
    // ORDER BY programs.StartDate";

    $query_prog = "SELECT * FROM programs     
    ORDER BY programs.StartDate";

    $result = mysqli_query($dbc, $query_prog);
    $prog = array();

    if (($_SESSION['lang'])=="eng")
        while ($row = mysqli_fetch_assoc($result)) { 
            $prog[$row['ProgramID']] = array (
                "Ready" => $row['Ready'],
                "ProgramID" => $row['ProgramID'],
                "ProgramName" => $row['ProgramNameEng'],
                "Subtitle" => $row['SubtitleEng'],
                "Form" => $row['FormEng'],
                "ShortDescription" => $row['ShortDescriptionEng'],
                "ApplicationDetails" => $row['ApplicationDetailsEng'],
                "targetGroup" => $row['targetGroupEng'],
                "aimOfTheProgram" => $row['aimOfTheProgramEng'], 
                "priceIncludes" => $row['priceIncludesEng'], 
                "StartTime" => $row['StartTime'],
                "StartDate" => $row['StartDate'],
                "EndDate" => $row['EndDate'],
                "Days" => $row['Days'],
                "MinParticipants" => $row['MinParticipants'],
                "MaxParticipants" => $row['MaxParticipants'], 
                "AvailTicket" => $row['AvailTicket'],                
                "EarlyBird" => $row['EarlyBird'],
                "NormalPrice" => $row['NormalPrice'],
                "StudentPrice" => $row['StudentPrice'],
                "NKA" => $row['NKA'],
                "ProgramApplicationUrl" => $row['ProgramApplicationUrl']
           
          );
        }
    else
        while ($row = mysqli_fetch_assoc($result)) { 
          $prog[$row['ProgramID']] = array (
              "Ready" => $row['Ready'],
              "ProgramID" => $row['ProgramID'],
              "ProgramName" => $row['ProgramNameHun'],
              "Subtitle" => $row['SubtitleHun'],
              "Form" => $row['FormHun'],
              "ShortDescription" => $row['ShortDescriptionHun'],
              "ApplicationDetails" => $row['ApplicationDetailsHun'],
              "targetGroup" => $row['targetGroupHun'],
              "aimOfTheProgram" => $row['aimOfTheProgramHun'],   
              "priceIncludes" => $row['priceIncludesHun'],          
              "StartTime" => $row['StartTime'],
              "StartDate" => $row['StartDate'],
              "EndDate" => $row['EndDate'],
              "Days" => $row['Days'],
              "MinParticipants" => $row['MinParticipants'],
              "MaxParticipants" => $row['MaxParticipants'],
              "AvailTicket" => $row['AvailTicket'],       
              "EarlyBird" => $row['EarlyBird'],
              "NormalPrice" => $row['NormalPrice'],
              "StudentPrice" => $row['StudentPrice'],
              "NKA" => $row['NKA'],
              "ProgramApplicationUrl" => $row['ProgramApplicationUrl']           
          );
      }

    // organizers table query with corresponding programID (there will be multiple lines with OrganizersID an ProgramID)
    $query_org = "SELECT * FROM organizers INNER JOIN progorgsjunction 
    ON organizers.OrganizerID = progorgsjunction.OrganizerID";

    $result = mysqli_query($dbc, $query_org);
    $org = array();

    if (($_SESSION['lang'])=="eng")
        while ($row = mysqli_fetch_assoc($result)) { 
            $org[$row['JunctionID']] = array (
                "ProgramID" => $row['ProgramID'],
                "OrganizerID" => $row['OrganizerID'],
                "OrganizerName" => $row['OrganizerNameEng'],                
                "Introduction" => $row['IntroductionEng'],
                "Profession" => $row['ProfessionEng'],
                "Institute" => $row['InstituteEng'],
                "Homepage" => $row['Homepage']                         
          );
        }
    else
        while ($row = mysqli_fetch_assoc($result)) { 
            $org[$row['JunctionID']] = array (            
                "ProgramID" => $row['ProgramID'],
                "OrganizerID" => $row['OrganizerID'],
                "OrganizerName" => $row['OrganizerNameHun'],            
                "Introduction" => $row['IntroductionHun'],
                "Profession" => $row['ProfessionHun'],
                "Institute" => $row['InstituteHun'],
                "Homepage" => $row['Homepage']                     
            );
        }

    $query_archive = "SELECT * FROM archive
    WHERE archive.StartDate < NOW()     
    AND (archive.EndDate < NOW() OR archive.EndDate IS NULL)
    ORDER BY archive.StartDate DESC";

    $result = mysqli_query($dbc, $query_archive);
    $archive = array();


    if (($_SESSION['lang'])=="eng")
        while ($row = mysqli_fetch_assoc($result)) { 
            $archive[$row['ConcertID']] = array (
                "ConcertID" => $row['ConcertID'],
                "StartDate" => $row['StartDate'],
                "EndDate" => $row['EndDate'],
                "Name" => $row['NameEng'],                
                "Contributors" => $row['ContributorsEng'],
                "Description" => $row['DescriptionEng'],
                "Labels" => $row['Labels'],
                "Display" => $row['Display']                     
          );
        }
    else
        while ($row = mysqli_fetch_assoc($result)) { 
            $archive[$row['ConcertID']] = array (
                "ConcertID" => $row['ConcertID'],
                "StartDate" => $row['StartDate'],
                "EndDate" => $row['EndDate'],
                "Name" => $row['NameHun'],                
                "Contributors" => $row['ContributorsHun'],
                "Description" => $row['DescriptionHun'],
                "Labels" => $row['Labels'],
                "Display" => $row['Display']   
            );
        }


    $query_upcoming= "SELECT * FROM archive
    WHERE archive.StartDate > NOW() 
    OR archive.EndDate > NOW()
    ORDER BY archive.StartDate ASC";

    $result = mysqli_query($dbc, $query_upcoming);
    $upcoming = array();


    if (($_SESSION['lang'])=="eng")
        while ($row = mysqli_fetch_assoc($result)) { 
            $upcoming[$row['ConcertID']] = array (
                "ConcertID" => $row['ConcertID'],
                "StartDate" => $row['StartDate'],
                "EndDate" => $row['EndDate'],
                "Name" => $row['NameEng'],                
                "Contributors" => $row['ContributorsEng'],
                "Description" => $row['DescriptionEng'],
                "Labels" => $row['Labels'],
                "Display" => $row['Display']                    
          );
        }
    else
        while ($row = mysqli_fetch_assoc($result)) { 
            $upcoming[$row['ConcertID']] = array (
                "ConcertID" => $row['ConcertID'],
                "StartDate" => $row['StartDate'],
                "EndDate" => $row['EndDate'],
                "Name" => $row['NameHun'],                
                "Contributors" => $row['ContributorsHun'],
                "Description" => $row['DescriptionHun'],
                "Labels" => $row['Labels'],
                "Display" => $row['Display']
            );
        }




/*FUNCTION DECLARATION BLOCK*/
/***************************/

    // SET UP page session to have subpages
    if (!isset($_GET['page']))
        $_SESSION['page'] = "home";
    else
        $_SESSION['page'] = $_GET['page'];
    
    // USED AT NAVBAR
    function printLanguage() {
        if (!isset($_SESSION['lang']) || (isset($_SESSION['lang']) && $_SESSION['lang'] != "eng"))
            echo "eng";
        else 
            echo "hun";
    }

    // USED AT UPCOMING and APPLICATION-DETAILS
    function printProgramDate($startDate,$endDate) {
        echo str_replace('-', '.', $startDate);
        if (isset($endDate) && $endDate != $startDate)
            echo ' - ' . str_replace('-', '.', substr($endDate, -5)). '.';
        else 
            echo '.';
    }

    // USED AT UPCOMING and APPLICATION-DETAILS
    function printWSorCampLeader($numDays, $lang) {
        if ($numDays < 4)
            echo $lang['workshopleader'];
        else 
            echo $lang['campleader'];
    }

    // APPLICATION-DETAILS
    function printWSorCampAbout($numDays, $lang) {
        if ($numDays < 4)
            echo $lang['apply_aboutthews'];
        else 
            echo $lang['apply_aboutthecamp'];
    }

    // APPLICATION-DETAILS
    function printAppUrlIfExists($url, $lang) {      
        if(strlen(trim($url)) > 0)
            echo '<iframe src="'.$url.'" width="100%" height="350px" frameborder="0" marginheight="0" marginwidth="0">'.$lang['loading'].'…</iframe>';        
        else
            echo '<h3 class="at-center">'.$lang['apply_comming_soon'].'</h3>';
    }

    function listOrganizerNames($ProgramID, $org){
        $first = true;
        foreach ($org as $key => $value){
            if ($org[$key]['ProgramID'] == $ProgramID){
                if ($first == true)
                    $first = false;
                else 
                    echo ', ';          
                echo $org[$key]['OrganizerName'];
            }          
        }      
    }



    function listOrganizerNamesBr($ProgramID, $org){
        $first = true;
        foreach ($org as $key => $value){
            if ($org[$key]['ProgramID'] == $ProgramID){
              if ($first == true)
                  $first = false;
              else 
                  echo '<br> ';          
              echo $org[$key]['OrganizerName'];
            }          
        }      
    }
  

    function listOrganizerIntroductions($ProgramID, $org, $lang){
        $first = true;
        foreach ($org as $key => $value){
            if ($org[$key]['ProgramID'] == $ProgramID){
                if ($first == true)
                    $first = false;
                else 
                    echo ' ';          
                echo ' 
                    <div class="at-row at-padding-32">    
                      <div class="at-col l4 m5 s12" >
                        <div class="at-display-container at-hover-pointer at-padding-16" > 
                         <a href="'.$org[$key]['Homepage'].'" target="blank">
                          <img class="at-proj-img " src="/images/organizers/'.$org[$key]['OrganizerID'].'.jpg" style="width:100%">                          
                          <h3 class="at-display-bottomright at-padding-medium at-text-white at-text-shadow at-largex ">'. $org[$key]['OrganizerName'] .'</h3>
                          </a>
                        </div>
                      </div>
                      <div class="at-col l7 m7 s12 " >
                        <div class="at-display-container at-margin-left-64"> 
                          <div style="width:100%; ">
                            <h3 class="at-left-align at-text-lowercase">'. $lang['profleader'].'</h3> 
                            <div class="at-italic at-text-grey at-left-align" >   '. substr($org[$key]['Introduction'], 0, 1000) .'</div>                      
                          </div>
                        </div>
                      </div>   
                    </div>
                  ';
            }          
        }      
    }


    /*function printImagePath($programID) {        
        $imagepath ='\\images\\project-avatars\\'.$programID.'.jpg';  
        $exists = file_exists(dirname(__FILE__) . '/..' . $imagepath);     
        
        if($exists)
            echo '/images/project-avatars/'.$programID.'.jpg';        
        else 
            echo'/images/project-avatars/'.$programID.'.png';  
    }*/
    


?>