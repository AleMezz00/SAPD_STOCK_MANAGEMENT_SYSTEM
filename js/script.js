
var sidebarIsOpen = true;

toggleBtn.addEventListener( 'click', (event)  => {
    event.preventDefault();

    if (sidebarIsOpen){
    dashboard_sidebar.style.width = '11%';
    dashboard_sidebar.style.transition = '0.4s all';
    dashboard_content_container.style.width = '89%';
    dashboard_logo.style.fontSize = '60px';
    userImage.style.width = '60px'
    menuIcons = document.getElementsByClassName('menuText');
    for(var i=0; i<menuIcons.length ; i++){
        menuIcons[i].style.display = 'none';
    }
    
    document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'center';
    sidebarIsOpen = false;   

} else {
    dashboard_sidebar.style.width = '21%';
    dashboard_content_container.style.width = '79%';
    dashboard_logo.style.fontSize = '80px';
    userImage.style.width = '80px'
    menuIcons = document.getElementsByClassName('menuText');
    for(var i=0; i<menuIcons.length ; i++){
        menuIcons[i].style.display = 'inline-block';
    }
    
    document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'left';
   sidebarIsOpen = true;   
}
      
});

//Submenu show/hide

document.addEventListener('click', function(e){
    let clickedEl = e.target;

    if(clickedEl.classList.contains('showHideSubMenu')){
        let subMenu = clickedEl.closest('li').querySelector('.subMenus');
        let mainMenuIcon = clickedEl.closest('li').querySelector('.mainMenuIconArrow');

        //close all submenus
        let subMenus = document.querySelectorAll('.subMenus');
        subMenus.forEach((sub) => {
            if(subMenu !== sub) sub.style.display = 'none';
        });

        //call function to hide/show submenu
        showHideSubMenu(subMenu,mainMenuIcon);
    }
});

//FUNCTION to hide/show submenu
function showHideSubMenu(subMenu,mainMenuIcon){
    //check if there is submenu
    if(subMenu != null){
        if(subMenu.style.display === 'block'){
            subMenu.style.display = 'none';
            mainMenuIcon.classList.remove('fa-angle-up');
            mainMenuIcon.classList.add('fa-angle-down');
        } else {
            subMenu.style.display = 'block';
            mainMenuIcon.classList.remove('fa-angle-down');
            mainMenuIcon.classList.add('fa-angle-up');
        }
    }
}

//use selector to get the current menu or submenu

let pathArray = window.location.pathname.split( '/' );
let curFile = pathArray[pathArray.length - 1];

let curNav = document.querySelector('a[href="./'+ curFile +'"]');
curNav.classList.add('subMenuActive');

let mainNav = curNav.closest('li.liMainMenu');
mainNav.style.background = '#043976';

let subMenu = curNav.closest('.subMenus');
let mainMenuIcon = mainNav.querySelector('i.mainMenuIconArrow');

showHideSubMenu(subMenu,mainMenuIcon);

