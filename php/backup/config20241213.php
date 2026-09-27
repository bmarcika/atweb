<?php
    include "generalinfo.php";

    session_start();
/*
		if (!isset($_SESSION['lang']))
				$_SESSION['lang'] = "hun";
		else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
				if ($_GET['lang'] == "hun")
				  	$_SESSION['lang'] = "hun";
				else if ($_GET['lang'] == "eng")
				  	$_SESSION['lang'] = "eng";
		}
    
		if (!isset($_SESSION['lang']))
				$_SESSION['lang'] = "hun";
		else {
				if ($_GET['lang'] == "hun")
				  	$_SESSION['lang'] = "hun";
				else
				  	$_SESSION['lang'] = "eng";
		}
    */

		if (!isset($_SESSION['lang']) || $_GET['lang'] == "hun")
				$_SESSION['lang'] = "hun";
		else 
        $_SESSION['lang'] = "eng";
		

    // SET UP LANGUAGE:
		$fields="keyword, " . $_SESSION['lang'];
		$query = "SELECT $fields FROM translations";
		$result = mysqli_query($dbc, $query);
		$lang = array();
		while ($row = mysqli_fetch_assoc($result)) {
				$lang[$row['keyword']] = $row[$_SESSION['lang']];
		}

    // SET UP pageID
    if (!isset($_SESSION['pageID']) || !isset($_GET['pageID']) || $_GET['pageID'] == "home")
        $_SESSION['pageID'] = "home"; 
    else if (isset($_GET['pageID'])){
        $_SESSION['pageID'] = $_GET['pageID'];
    }

?>