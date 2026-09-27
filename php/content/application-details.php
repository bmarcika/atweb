<?php 
// $_SESSION['page'] is configured as the ProgramID, so we can use it for set up page content
$key = $_SESSION['page'];
// need to create a HTML structure for application
?>


<div class="at-container at-content at-center at-padding  at-padding-64 at-left-align">
  <h2 class="at-wide at-text-uppercase"><?php echo $prog[$key]['ProgramName'] ?></h2>
  <p class="at-subtitle"><?php echo $prog[$key]['Subtitle'] ?></p>  
  <div class="at-left-align at-padding-16"> 
      <p class=""><?php echo $prog[$key]['ShortDescription'] ?></p>
      <p ><span class="at-bold"><?php echo $lang['apply_whoisthisfor']?> </span><?php echo$prog[$key]['targetGroup'] ?></p>
      <p ><span class="at-bold"><?php echo $lang['apply_aimofthecall']?> </span><?php echo$prog[$key]['aimOfTheProgram'] ?></p>
      <p ><span class=""><?php echo $lang['apply_forapplication'] ?></span></p>           
  </div>  
  
  <div class="at-padding-16">
          <a <?php 
             if($prog[$key]['AvailTicket'] != 0)
             {
               echo 'onclick="applyToTheCamp()" class="at-padding at-bar-item at-button at-padding-large at-red at-fontweight-900 at-subt">' ;
             }
             else
             {
               echo 'class="at-padding at-bar-item at-button at-padding-large at-grey at-fontweight-900 at-subt" title="A tábor betelt.">';
             }
             
             echo $lang['application'] ?> </a> 
    
  </div>  

  <?php listOrganizerIntroductions($prog[$key]['ProgramID'], $org, $lang);	?>

  
  <div class="at-left-align at-padding-16"><?php echo '<b>'; printWSorCampAbout($prog[$key]['Days'],$lang); echo ':</b> '.$prog[$key]['ApplicationDetails']; ?></div>

  <div class=" at-padding-16"> 
    <div class="at-row at-black at-padding-largex" >
      <h3 class="at-left-align at-text-uppercase"><?php echo $prog[$key]['ProgramName'] ?>  </h3> 
      <div class="at-col l7 m12 s12" > 
        <div class="at-display-container at-left-align" >         
          <p><span class="at-bold"><?php echo $lang['profleader'] ?>: </span><?php listOrganizerNames($prog[$key]['ProgramID'], $org); ?><br>  
          <span class="at-bold"><?php echo $lang['date'] ?>: </span><?php printProgramDate($prog[$key]['StartDate'],$prog[$key]['EndDate']) ?><br> 
          <span class="at-bold"><?php echo $lang['length'] ?>: </span><?php echo $prog[$key]['Days'].' '.$lang['day'] ?><br> 
          <!--p><span class="at-bold"><?php echo $lang['maxnumberofparticipants'] ?>: </span><?php echo $prog[$key]['MaxParticipants'].' '.$lang['person'] ?><br>  
          <p><span class="at-bold"><?php echo $lang['minnumberofparticipants'] ?>: </span><?php echo $prog[$key]['MinParticipants'].' '.$lang['person'] ?></p-->
          <span class="at-bold"><?php echo $lang['numOfParticipants'] ?>: </span><?php echo $prog[$key]['MinParticipants'].' - '.$prog[$key]['MaxParticipants'].' '.$lang['person']  ?><br>           
            <span class="at-bold">
            <?php 
                echo $lang['normalprice'] .': </span>'. $prog[$key]['NormalPrice'].' '.$lang['huf']; 
                if($prog[$key]['StudentPrice']!= 0)
                {
                  echo '<br><span class="at-bold">'.$lang['studentprice'] .': </span>'. $prog[$key]['StudentPrice'].' '.$lang['huf']; 
                }
                $currentdate = date('Y.m.d.');
                $earlybirddate = date('Y.m.d.', strtotime($prog[$key]['StartDate']. '-3 months'));
                if( $currentdate <= $earlybirddate)
                  echo '<br><span class="at-bold">Early Bird: </span> '.$prog[$key]['EarlyBird'].' '.$lang['huf'].' (' .date('Y.m.d.', strtotime($prog[$key]['StartDate']. '-3 months')).')</p>';         
            ?>             
        </div> 
      </div>   
      <div class="at-col l5 m12 s12" >   
        <div class=" at-display-container" style="width:100%; height:100px;">
          <a <?php 
             if($prog[$key]['AvailTicket'] != '0')
             {
               echo 'onclick="applyToTheCamp()" class="at-display-middle at-padding at-button at-padding-large at-red at-fontweight-900 at-subt">' ;
             }
             else
             {
               echo 'class="at-display-middle at-padding at-button at-padding-large at-grey at-fontweight-900 at-subt" title="A tábor betelt.">';
             }
             
             echo $lang['application'] ?> </a> 
        </div>
      </div>
    </div>
    
    <div class="at-left-align at-padding-16">      
      <p><span class="at-bold"><?php echo $lang['apply_price_contains']?>: </span><?php echo $prog[$key]['priceIncludes'] ?> <br>(<?php echo $lang['priceExcludes'] ?>)</p>               
      <!--div class="at-left-align at-padding-16"><?php echo $lang['accomodation_link'].'<br>'.$lang['houserules_link']?> </div--> 
      <div class="at-left-align at-padding-16">
        <?php echo $lang['accomodation_link']?> <br>
        <?php echo $lang['safety_first']?>
      </div>     
      
      
    </div> 
    
  </div>	

  <img class="at-padding-16 at-proj-img" src="<?php  echo'/images/TIXA/'.$prog[$key]['ProgramID']; ?>.jpg" style="width:100%">  
  
<?php   
  if($prog[$key]['NKA']=='yes')  {
    echo '<div class="at-container at-content at-padding at-padding-32" style="max-width:600px">    
        <div class=" at-center at-padding-16 at-padding-small">
        <a href="http://www.nka.hu/" class="at-padding-small at-hover-opacity" target="_blank" title="NKA">
          <img src="/images/partners/nka_logo.png" alt="House" style="width:65px">
        </a>
      </div>
      <p>'.$lang['nka_finance'].'<p>      
  </div>'; 
  }; 
?>
  
  
</div>

<div id="popupApplicationForms" class="at-modal">
  <div class="at-modal-content at-animate-top at-card-4">
    <header class="at-container at-white at-center"> 
      <span onclick="applyToTheCampClose()" 
      class="at-close-x at-white at-xlarge at-display-topright">×</span>
      <!--h2 class="at-wide"><?php echo $lang['application'] ?></h2-->
    </header>
    <div class='at-modal-height'>
      <?php printAppUrlIfExists($prog[$key]['ProgramApplicationUrl'], $lang); ?>
    </div>
  </div>
</div>





