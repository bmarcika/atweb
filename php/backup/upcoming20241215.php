<?php 
    include "generalinfo.php";     

		// query a joined organizers and programs table
    $query = "SELECT * FROM organizers INNER JOIN programs 
    ON organizers.OrganizerID = programs.OrganizerID 
    WHERE organizers.Ready='yes' 
    AND programs.Ready='yes' 
    AND programs.StartDate > NOW() 
    ORDER BY programs.StartDate";

		$result = mysqli_query($dbc, $query);
		$orgprog = array();

    if (($_SESSION['lang'])=="eng")
        while ($row = mysqli_fetch_assoc($result)) { 
            $orgprog[$row['ProgramID']] = array (
                "OrganizerID" => $row['OrganizerID'],
                "OrganizerName" => $row['OrganizerName'],
                "Ready" => $row['Ready'],
                "Introduction" => $row['IntroductionEng'],
                "Profession" => $row['ProfessionEng'],
                "Institute" => $row['InstituteEng'],
                "Homepage" => $row['Homepage'],
                "ProgramID" => $row['ProgramID'],
                "PublicDate" => $row['PublicDate'],
                "ProgramName" => $row['ProgramNameEng'],
                "TopicArea" => $row['TopicAreaEng'],
                "Subtitle" => $row['SubtitleEng'],
                "ShortDescription" => $row['ShortDescriptionEng'],
                "ApplicationDetails" => $row['ApplicationDetailsEng'],
                "ArchiveText" => $row['ArchiveTextEng'],
                "Location" => $row['Location'],
                "StartTime" => $row['StartTime'],
                "StartDate" => $row['StartDate'],
                "EndDate" => $row['EndDate'],
                "Days" => $row['Days'],
                "MinParticipants" => $row['MinParticipants'],
                "MaxParticipants" => $row['MaxParticipants'],
                "AvailableTicket" => $row['AvailableTicket'],
                "EarlyBird" => $row['EarlyBird'],
                "NormalPrice" => $row['NormalPrice']
          );
        }
    else
    while ($row = mysqli_fetch_assoc($result)) { 
        $orgprog[$row['ProgramID']] = array (
            "OrganizerID" => $row['OrganizerID'],
            "OrganizerName" => $row['OrganizerName'],
            "Ready" => $row['Ready'],
            "Introduction" => $row['IntroductionHun'],
            "Profession" => $row['ProfessionHun'],
            "Institute" => $row['InstituteHun'],
            "Homepage" => $row['Homepage'],
            "ProgramID" => $row['ProgramID'],
            "PublicDate" => $row['PublicDate'],
            "ProgramName" => $row['ProgramNameHun'],
            "TopicArea" => $row['TopicAreaHun'],
            "Subtitle" => $row['SubtitleHun'],
            "ShortDescription" => $row['ShortDescriptionHun'],
            "ApplicationDetails" => $row['ApplicationDetailsHun'],
            "ArchiveText" => $row['ArchiveTextHun'],
            "Location" => $row['Location'],
            "StartTime" => $row['StartTime'],
            "StartDate" => $row['StartDate'],
            "EndDate" => $row['EndDate'],
            "Days" => $row['Days'],
            "MinParticipants" => $row['MinParticipants'],
            "MaxParticipants" => $row['MaxParticipants'],
            "AvailableTicket" => $row['AvailableTicket'],
            "EarlyBird" => $row['EarlyBird'],
            "NormalPrice" => $row['NormalPrice']
        );
    }
?>
<div class=" at-hide-large at-padding-32"></div>  
<div class="at-container at-container-proj at-padding-64 " >
    <div class="at-padding-16">
      <div class="at-row-padding ">
	
		<?php
				foreach ($orgprog as $key => $value) { 				
						echo'         
						              
								<div class="at-col l5 m6 s6 at-margin-bottom-upcoming" >
										<div class="at-display-container at-hover-pointer" >
												<a>   
													<img class="at-proj-img at-circle" src="/images/project-avatars/'.$orgprog[$key]['ProgramID'].'.jpg" style="width:100%">                          
													<div class="at-display-topleft at-black at-padding-medium at-mediumx at-hide-small">'. $orgprog[$key]['ProgramName'] .'</div>                   													
                          <div class="at-display-bottommiddle at-text-white at-padding-medium at-mediumx at-program-date at-hide-small">'. str_replace('-', '.', $orgprog[$key]['StartDate']);
                          if (isset($orgprog[$key]['EndDate']) && $orgprog[$key]['EndDate'] != $orgprog[$key]['StartDate'])
                              echo ' - ' . str_replace('-', '.', substr($orgprog[$key]['EndDate'], -5)). '.';
                          else 
                              echo '.';
                          echo '</div>   
                          <div class="at-display-bottommiddle at-text-white at-padding-medium at-mediumx at-program-date at-hide-large at-hide-medium">'. str_replace('-', '.', $orgprog[$key]['StartDate']);
                          if (isset($orgprog[$key]['EndDate']) && $orgprog[$key]['EndDate'] != $orgprog[$key]['StartDate'])
                              echo ' - ' . str_replace('-', '.', substr($orgprog[$key]['EndDate'], -5)). '.';
                          else 
                              echo '.';
                          echo '</div>  
												</a>
										</div>
								</div>  
								<div class="at-col l7 m6 s6 at-margin-bottom-upcoming " >
										<div class="at-display-container " style="width:100%; height:227px;"> 
												<div style="width:100%; height:200px;">                    
                          <div class=" " >
                            <h3>'.$orgprog[$key]['Subtitle'] .'</h3> <p class="at-hide-small">
                            '. substr($orgprog[$key]['ShortDescription'], 0, 700) .'</p>
                            <div class="at-display-right at-padding at-bar-item at-button at-padding-large at-red at-hide-medium at-hide-large" >' . $lang['moredetails'] . '</div>
                            </div>  
                          

												</div>
										</div>
                    <div class="at-display-container at-hide-small " style="width:100%; height:200px;"> 
												<div style="width:100%; height:200px;">                    
                          <div class=" " >                           
                            <div class=" at-display-left at-italic " style="width:100%">'.$orgprog[$key]['MaxParticipants'].' '.$lang['person'].', '.$orgprog[$key]['Days'].' '.$lang['day'].', '. str_replace('-', '.', $orgprog[$key]['StartDate']);
                            if (isset($orgprog[$key]['EndDate']) && $orgprog[$key]['EndDate'] != $orgprog[$key]['StartDate'])
                                echo ' - ' . str_replace('-', '.', substr($orgprog[$key]['EndDate'], -5)). '.';
                            else 
                                echo '.';
                            echo '<br>Early Bird: ' . $orgprog[$key]['EarlyBird'] . ' HUF / '. date('Y.m.d.', strtotime($orgprog[$key]['StartDate']. '-3 months')) .' <br>'.$lang['normalprice'].': ' . $orgprog[$key]['NormalPrice'] . ' HUF</div>
                          <div class="at-display-right at-padding at-bar-item at-button at-padding-large at-red" >' . $lang['moredetails'] . '</div>

												</div>
										</div>
                    </div>
                    
								</div> 
							';		
				};
		?>
    </div>
	</div>
</div>

