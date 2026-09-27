 
<div class="at-container at-padding-64">
  <div class="at-padding-16">
    <div class="at-row-padding">	
		  <?php
				foreach ($prog as $key => $value) { 				
						echo' 
              <div class="at-col l12 m12 s12 at-margin-bottom"  >
                  <div class="at-display-container at-hover-pointer"  >
                      <a type="submit" href="index.php?page='.$prog[$key]['ProgramID'].'" onclick="post" >
                        <img class="at-proj-img" src="/images/fb-covers/'.$prog[$key]['ProgramID'].'.jpg" style="width:100%" >   
                        <div class="at-display-top" style="width:100%; height:100%; background:repeating-radial-gradient(black, black 5px, white 5px,  white 10px);"></div>
                        <h1 class="at-black at-padding-medium at-display-topleft at-text-whiteat-program-date">'. $prog[$key]['ProgramName'] .'</h1>  
                        <!--div class="at-display-topright at-margin-top-36 at-margin-right-48 at-padding at-mediumx at-text-white at-text-shadow at-largex"><h1>';
                        listOrganizerNamesBr($prog[$key]['ProgramID'], $org);
                        echo '</h1></div-->  
                        <div class="at-display-bottomright at-padding-medium at-text-white at-text-shadow at-largex"><h1>';
                        printProgramDate($prog[$key]['StartDate'],$prog[$key]['EndDate']);
                        echo '</h1></div>  
                      </a>
                  </div>
              </div>  
              
            ';		
				};
		?>        
    </div>
	</div>
</div>

