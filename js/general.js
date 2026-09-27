/*************************************MENU LOGIC****************************************/
function hamburgerClick() {
	$('#hamburgerMenu').click(function(e) {// (hide || show) menu by clicking "hamburgerMenu" icon	
		e.preventDefault();

		if( $('#hamburgerMenu').hasClass('at-show')) {
			$('#hamburgerMenu').removeClass('at-show');
			$('#menuBlock').removeClass('at-show');            
            $('#widget-block').removeClass('at-display-none');                                                         
		}
		else {
			$('#hamburgerMenu').addClass('at-show');
			$('#menuBlock').addClass('at-show');  
            $('#widget-block').addClass('at-display-none');             
		}
	});
}

function hideMenuOutclick() {
  $(document).click(function(e) {
    if( ($(e.target).closest('#menuBlock').length==0) &&
       ($(e.target).closest('#hamburgerMenu').length==0) ) {
      if( $('#hamburgerMenu').hasClass('at-show') ) {
        $('#hamburgerMenu').removeClass('at-show');
        $('#menuBlock').removeClass('at-show');
        $('#widget-block').removeClass('at-display-none');
      }
    }
  });
}

function beginJS() {
	hamburgerClick();
	hideMenuOutclick();
}

window.onload = beginJS;
/*************************************MENU LOGIC END****************************************/


/*************************************ARCHIVE LOGIC****************************************/

function toggleArchiveMenu(event) {            
    menuItem = event.currentTarget; // Get the clicked header  
    if (!menuItem.classList.contains('at-archive-menu-item-active')) {                            
        $(".at-archive-menu-item-active").removeClass("at-archive-menu-item-active");
        menuItem.classList.add('at-archive-menu-item-active');                                  
        document.querySelectorAll('.at-archive-item').forEach(el => el.classList.add('at-hide'));
        
        if (menuItem.classList.contains('at-camps')) {            
            document.querySelectorAll('.at-camp').forEach(el => el.classList.remove('at-hide'));    
        }
        if (menuItem.classList.contains('at-residencies')) {            
            document.querySelectorAll('.at-residency').forEach(el => el.classList.remove('at-hide'));  
        }        
        if (menuItem.classList.contains('at-performances')) {          
            document.querySelectorAll('.at-concert, .at-performance, .at-presentation, .at-exhibition').forEach(el => el.classList.remove('at-hide'));   
        }
        if (menuItem.classList.contains('at-allevents')) {            
            document.querySelectorAll('.at-archive-item').forEach(el => el.classList.remove('at-hide'));
        }
    }
}


function toggleContent(event) {

    // prevent toggle while selecting text
    if (window.getSelection &&
        window.getSelection().toString().length > 0) {
        return;
    }

    // ignore clicks on interactive elements
    if (event.target.closest("a, button, input, textarea, select, label")) {
        return;
    }

    const header = event.currentTarget;
    const item = header.closest(".at-archive-item");
    const content = item.querySelector(".at-archive-item-content");
    const expandedElem = document.querySelector(".at-archive-item-expanded");

    // collapse current
    if (content.style.maxHeight) {

        content.style.maxHeight = null;
        content.classList.remove("at-archive-item-expanded");

        item.classList.remove("at-white");

    } else {

        // collapse previously opened item
        if (expandedElem) {

            expandedElem.style.maxHeight = null;

            const expandedItem =
                expandedElem.closest(".at-archive-item");

            expandedItem.classList.remove("at-white");
        }

        $(".at-archive-item-expanded")
            .removeClass("at-archive-item-expanded");

        // expand current
        content.style.maxHeight =
            content.scrollHeight + "px";

        content.classList.add("at-archive-item-expanded");

        item.classList.add("at-white");
    }
}
/*************************************ARCHIVE CONTENT DISPLAY LOGIC END****************************************/

//Jelentkezés
function applyToTheCamp() {  		
	document.getElementById('popupApplicationForms').style.display='block';
    document.getElementById('page').style.overflowY='hidden';
    document.getElementById('page').style.height='500px';      
}
    
function applyToTheCampClose() {  		
	document.getElementById('popupApplicationForms').style.display='none';
    document.getElementById('page').style.overflowY='scroll';
    document.getElementById('page').style.height='auto';  
}  
