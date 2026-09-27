<div class="at-top" >
  <div class="at-bar at-white at-wide at-content" style="height: 64px"> 
    <div class="at-content">    
      <a href="javascript:void(0)" id="hamburgerMenu" class="at-left-first-bar-item at-button at-largexx"  title="Menu"><i class="fa fa-bars"></i></a> 
      <a href="index.php?lang=<?php printLanguage();  ?>&page=<?php echo $_SESSION['page']; ?>" class="at-bar-item  at-right-last-bar-item at-button at-right at-largexx at-text-uppercase"  title="Switch Language"><?php echo $lang['lang'] ?>
      </a>
      <!--a href="/index.php" class="at-bar-item at-button at-large at-right" title="Home"><i class="fa fa-home"></i></a-->
      <!--a href="https://www.tiktok.com/@kovagoors_alkototabor" target="_blank" class=" at-bar-item at-button at-large" title="Tiktok"><img src="/images/tiktok.png" width="22" height="22"></a--> 
      <!--a href="/index.php" class="at-bar-item at-button at-large at-right" title="Home"><img src="/images/logo.svg" width="48" height="48"></a-->
      
      
      <div class="">
        <!--a href="https://www.youtube.com/@alkototaborkovagoors9954" target="_blank" class=" at-bar-item at-button at-large" title="Youtube"><i class="fa fa-youtube-play"></i></a-->
        <a href="https://www.instagram.com/kovagoors_alkototabor/" target="_blank" class=" at-bar-item at-button at-largexx" title="Instagam"><i class="fa fa-instagram"></i></a>
        <a href="https://www.facebook.com/pg/kovagoorsalkototabor/events/" target="_blank" class="at-bar-item at-button at-largexx" title="Facebook"><i class="fa fa-facebook-f"></i></a>
        <a href="https://www.kovagoorsalkototabor.hu" class="at-bar-item at-button at-largexx" title="Home"><i class="fa fa-home"></i></a>
          
        <!--a href="https://www.tiktok.com/@kovagoors_alkototabor" target="_blank" class=" at-bar-item at-button at-large" title="Tiktok"><img src="/images/tiktok.png" width="22" height="22"></a-->      
      </div> 
    </div>  
    <div id="menuBlock" class="at-content at-bar-block at-big-menu-block at-white at-hide at-top">               
      <a href="/index.php?page=contact" class="at-bar-item at-button at-padding-large-menu at-wide"><?php echo $lang['menu_contact'] ?></a>        
      <a href="/index.php?page=residency" class="at-bar-item at-button at-padding-large-menu at-wide"><?php echo $lang['menu_residency'] ?></a>         
      <a href="/index.php?page=association" class="at-bar-item at-button at-padding-large-menu at-wide"><?php echo $lang['menu_association'] ?></a>      
      <a href="/index.php?page=house-story" class="  at-bar-item at-button at-padding-large-menu at-wide"><?php echo $lang['menu_the_story'] ?></a>
      <a href="/index.php?page=press" class=" at-bar-item at-button at-padding-large-menu at-wide"><?php echo $lang['menu_press'] ?></a>
      <a href="/index.php?page=accomodation" class="at-bar-item at-button at-padding-large-menu at-wide"><?php echo $lang['menu_accomodation'] ?></a-->
      <a href="/index.php?page=stats" class="at-bar-item at-button at-padding-large-menu at-wide"><?php echo ($_SESSION['lang'] === 'eng' ? 'STATS' : 'ADATOK') ?></a>
      <a href="/index.php?page=faq" class="at-margin-bottom at-menu-margin-bottom  at-bar-item at-button at-padding-large-menu at-wide"><?php echo $lang['menu_faq'] ?></a>    
    </div>
  </div>
</div>
