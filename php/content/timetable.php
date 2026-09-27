
    <div class="at-row-padding at-padding-16">	
		  <?php

      
        $type = array("rezidencia", "residency", "koncert", "concert"); 
      
				foreach ($prog as $key => $value) {   
                  
          $programname = (strlen($prog[$key]['ProgramName'])<45) ? $prog[$key]['ProgramName'] : substr($prog[$key]['ProgramName'], 0, 42) .'...';
          
          if (!in_array($prog[$key]['Form'], $type)) {
						echo'  <div>             
                <div class="at-col l3 m6 s12">
                  <div class="at-text-uppercase at-fontweight-900"><a type="submit" href="index.php?page='.$prog[$key]['ProgramID'].'" onclick="post">';
          
            printProgramDate($prog[$key]['StartDate'],$prog[$key]['EndDate']);
            
            echo '</a>
                  </div>                
                </div>  
                <div class="at-col l7 m6 at-hide-small at-subt at-text-uppercase at-fontweight-900">
                  <a  type="submit" href="index.php?page='.$prog[$key]['ProgramID'].'" onclick="post">'. $programname .' </a>      
                </div>  
                <div class="at-col s9 at-right at-hide-medium at-hide-large at-text-uppercase at-fontweight-900">             
                  <a type="submit" href="index.php?page='.$prog[$key]['ProgramID'].'" onclick="post">'. $programname .' </a>      
                </div>  

                <div class="at-col l2 at-hide-small at-hide-medium at-subt at-text-lowercase at-fontweight-900"> 
                    <a type="submit" href="index.php?page='.$prog[$key]['ProgramID'].'" onclick="post" class="at-right">'. $prog[$key]['Form'] .' </a>               
                </div>  
                </div> 
                ';	
          }
          
          else{ // ha rezidencia vagy koncert akkor nem klikkelhető
            echo'   
            <div> 
                <div class="at-col l3 m6 s12">
                  <div class="at-text-uppercase at-fontweight-900">';                
            
            printProgramDate($prog[$key]['StartDate'],$prog[$key]['EndDate']);                        
            
            echo '
              </div>                
            </div>                  
                <div class="at-col l7 m6 at-hide-small at-subt at-text-uppercase at-fontweight-900">
                  '. $programname .'       
                </div>  
                <div class="at-col s9 at-right at-hide-medium at-hide-large at-text-uppercase at-fontweight-900">     
                  '. $programname .'  
                </div>
                <div class="at-col l2 at-hide-small at-hide-medium at-subt at-text-lowercase at-fontweight-900">
                   <div class="at-right">'. $prog[$key]['Form'] .'</div>  
                </div> 
                </div> 
            ';	
            
          }
				};
		?>     
	</div>


