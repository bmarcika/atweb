<?php 
include "./php/config.php"; 
include "./php/header.php";

// if pageID string contains a year info at the very beginning - the first 4 character are numbers


$is_program_subpage=is_numeric(substr($_SESSION['page'], 0, 3));
if ($is_program_subpage)
    include "./php/content/application-details.php";
else
    include "./php/content/".$_SESSION['page'].".php";


include "./php/footer.php";
?>