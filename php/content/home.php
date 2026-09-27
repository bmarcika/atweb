
<div class="at-content at-padding-32 at-center at-archive-side-padding">      
    <!--a href="/images/opencall2025/KVGRS_25_PALYAZAT_VARO.pdf" target="_blank" title="KVGRS_25_PALYAZAT_VARO.pdf"><img class="at-proj-img at-hide-medium at-hide-small" src="/images/opencall2025/ezgif.com-effects.gif" style="width:100%;"></a>
    <a href="/images/opencal32 025/KVGRS_25_PALYAZAT_VARO.pdf" target="_blank" title="KVGRS_25_PALYAZAT_VARO.pdf"><img class="at-proj-img at-hide-small at-hide-large" src="/images/opencall2025/ezgif.com-effects.gif" style="width:100%;"></a>
    <a href="/images/opencall2025/KVGRS_25_PALYAZAT_VARO.pdf" target="_blank" title="KVGRS_25_PALYAZAT_VARO.pdf"><img class="at-proj-img at-hide-medium at-hide-large" src="/images/opencall2025/AT_2025_P.gif" style="width:100%;">   </a-->  
  
    <!--img class="at-proj-img at-hide-medium at-hide-small" src="/images/Tangea_2025.png" style="width:100%;">
    <img class="at-proj-img at-hide-small at-hide-large" src="/images/Tangea_2025.png" style="width:100%;">
    <img class="at-proj-img at-hide-medium at-hide-large" src="/images/Tangea_2025.png" style="width:100%;"-->       
    <img class="at-proj-img at-hide-medium at-hide-small" src="/images/logo.svg" style="max-width:500px; width:100%;">
    <img class="at-proj-img at-hide-small at-hide-large" src="/images/logo.svg" style="max-width:300px; width:100%;">
    <img class="at-proj-img at-hide-medium at-hide-large" src="/images/logo.svg" style="max-width:260px; width:100%;">    
    
</div>      

<div class="at-content at-archive-side-padding ">
    <div class="at-row"  >                       
        <div class="at-col l3 m3 s6 at-wide at-button at-hover-black at-text-uppercase at-camps at-archive-menu-item" onclick="toggleArchiveMenu(event)"><?php echo $lang['archive-menu-ws'] ?></div>
        <div class="at-col l3 m3 s6 at-wide at-button at-hover-black at-text-uppercase at-residencies at-archive-menu-item" onclick="toggleArchiveMenu(event)"><?php echo $lang['archive-menu-res'] ?></div>
        <div class="at-col l3 m3 s6 at-wide at-button at-hover-black at-text-uppercase at-performances at-archive-menu-item" onclick="toggleArchiveMenu(event)"><?php echo $lang['archive-menu-pres'] ?></div> 
        <div class="at-col l3 m3 s6 at-wide at-button at-hover-black at-text-uppercase at-archive-menu-item-active at-allevents at-archive-menu-item" onclick="toggleArchiveMenu(event)"><?php echo $lang['archive-menu-all'] ?></div>
    </div>    

    <div class="at-row" >
     <?php /* upcoming */          
    
      foreach ($upcoming as $key => $value) {
          if($upcoming[$key]['Display']==="no"){
              continue;
          }
          echo '<div class="at-pale-yellow">';          
          //echo '<div class="at-row-padding at-archive-item at-hover-light-grey at-pointer';          
          if (($upcoming[$key]['StartDate']>date('Y-m-d'))||($upcoming[$key]['EndDate']>date('Y-m-d'))){
              echo ' <div class="at-row at-archive-item ';          
                            
          }
          else{
              echo '<div class="at-row-padding at-archive-item ';                            
          }
          
          $labelsArray = explode(', ', $upcoming[$key]['Labels']);
          
          foreach ($labelsArray as $label) {
              echo ' at-'.$label;
          }
          echo '">';
          
          echo     '
          <div class="at-padding at-row at-archive-item-header at-pointer" onclick="toggleContent(event)">          
            <div class="at-col l2 m2 s4 ">'
                .$upcoming[$key]['StartDate']. '<br>'.$upcoming[$key]['EndDate'].
            '</div>
            <div class="at-col l5 m5 s8 at-right-align">'
                .$upcoming[$key]['Name'].
            '</div>     
            <div class="at-col l1 m1 " > </div>';
          
          if($upcoming[$key]['Contributors']!=$upcoming[$key]['Name']){
            echo '
            <div class="at-col l4 m4 s8 at-right at-right-align" >'
                .$upcoming[$key]['Contributors'].
            '</div>  
            <div class="at-col l1 m1 "> </div> ';
          }
          
          echo '</div>';
        
          if($upcoming[$key]['Description']!=null){
            echo '<div class="at-padding at-col l12 m12 s12 at-archive-item-content at-margin-top " ><p class="at-archive-guest-show-small " ><p>'.$upcoming[$key]['Description'].'</p></div>';
          }            
          echo '</div></div>';
          
      };
    ?> 

    <?php /* archive */
      foreach ($archive as $key => $value) { 
          if($archive[$key]['Display']==="no"){
              continue;
          }
          echo '<div class="at-light-gray">';
          //echo '<div class="at-row-padding at-archive-item at-hover-light-grey at-pointer';          
          if (($archive[$key]['StartDate']>date('Y-m-d'))||($archive[$key]['EndDate']>date('Y-m-d'))){
              echo '<div class="at-row-padding at-archive-item at-pointer ';          
                            
          }
          else{
              echo '<div class="at-row-padding at-archive-item at-pointer ';                            
          }
          
          $labelsArray = explode(', ', $archive[$key]['Labels']);
          
          foreach ($labelsArray as $label) {
              echo ' at-'.$label;
          }

          echo     '" onclick="toggleContent(event)" >            
            <div class="at-col l2 m2 s4 ">'.$archive[$key]['StartDate']. '<br>'.$archive[$key]['EndDate'].'</div>
            <div class="at-col l5 m5 s8 at-right-align">'.$archive[$key]['Name'].'</div>     
            <div class="at-col l1 m1 " > </div>';
          
          if($archive[$key]['Contributors']!=$archive[$key]['Name']){
            echo '<div class="at-col l4 m4 s8 at-archive-item-expanded at-right at-right-align" >'.$archive[$key]['Contributors'].'</div>  
            <div class="at-col l1 m1 "> </div> ';
          }
        
        
          if($archive[$key]['Description']!=null){
            echo '<div class="at-col l12 m12 s12 at-archive-item-content at-margin-top " ><p class="at-archive-guest-show-small " ><p>'.$archive[$key]['Description'].'</p></div>';
          }            
          echo '</div></div>';
          
      };
    ?> 
        
        </div>

  
</div> 

  <div class="at-container at-content at-center at-padding at-padding-32 ">    
    <div class=" at-center at-padding-16 at-padding-small" >
      <p class="at-padding-small" ><?php echo $lang['finance'] ; ?></p>
      <a href="http://www.nka.hu/" class="at-padding-small at-hover-opacity" target="_blank" title="NKA">
        <img src="/images/partners/nka_2024ff.png" alt="House" style="width:128px; ">
      </a>
    
    </div>     
  </div>    

 
