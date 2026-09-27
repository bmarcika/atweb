 
<div class="at-container " id="programs">
  <div class="at-padding-64 at-hide-small"></div>  
  <!--h2 class="at-wide at-center"><?php echo $lang['menu_programs'] ?></h2>
  <div class="at-padding-16 at-hide-small"></div>  
  <!--p class="at-center"><i><?php echo $lang['subtitle_summer_melodies'] ?></i></p-->
  <div class="at-padding-16 at-hide-small"></div>
  <div class="at-row-padding">	
    <?php
      foreach ($prog as $key => $value) { 
        if (($prog[$key]['Form']!='rezidencia')&&($prog[$key]['Form']!='residency')&&($prog[$key]['Form']!='concert')&&($prog[$key]['Form']!='koncert')){
          echo' 

            <div class="at-col l4 m4 s12 at-margin-bottom" >
                <div class="at-display-container at-hover-pointer" >
                    <a type="submit" href="index.php?page='.$prog[$key]['ProgramID'].'" onclick="post">
                      <img class="at-proj-img" src="/images/project-avatars/new/'.$prog[$key]['ProgramID'].'.jpg" style="width:100%"> 
                    </a>
                </div>
            </div>  
            <div class="at-col l8 at-margin-right at-margin-left at-hide-small at-hide-medium at-padding" style=" height: 395px;" >
              <div class="" style="width:100%; "> 
                <div style="width:100%;">                              
                    <a type="submit" href="index.php?page='.$prog[$key]['ProgramID'].'" onclick="post"><div class="at-text-lowercase at-fontweight-900" style="font-size: 42px">'.$prog[$key]['Subtitle'] .'</div></a> 
                    <p class="">'. substr($prog[$key]['ShortDescription'], 0, 700) .'</p>                     
                  </div>
              </div>
              <div class="at-hide-middle at-display-container at-padding-8" style="width:100%;">                                                      
                  <div class=" " style="width:100%">';
                    printWSorCampLeader($prog[$key]['Days'], $lang);
                    echo  ': <b>';
                    //$prog[$key]['OrganizerName']
                    // list organizers for the corresponding ProgramID
                    listOrganizerNames($prog[$key]['ProgramID'], $org);
                    echo '</b><br>'. $lang['date'].': ';
                    printProgramDate($prog[$key]['StartDate'],$prog[$key]['EndDate']);
                    echo '<br>'.$lang['length']. ': '.$prog[$key]['Days'].' '.$lang['day']. 
                      '<br>'.$lang['maxnumberofparticipants']. ': '.$prog[$key]['MaxParticipants'].' '.$lang['person'].' // '.$prog[$key]['AvailTicket']. ' ' . $lang['avail'] . '
                  </div> 
                  <div class="at-display-right">
                  <a class="at-display-bottomright at-bar-item at-button at-padding-large at-red at-fontweight-900 at-subt" type="submit" href="index.php?page='.$prog[$key]['ProgramID'].'" onclick="post">' . $lang['moredetails'] . '</a>                
                  </div>
              </div>
            </div> 
            <div class="at-col l12 at-hide-small at-hide-medium" style=" height: 30px;"></div>

          ';		
          };
      };
  ?>        
  </div>
	
</div>

