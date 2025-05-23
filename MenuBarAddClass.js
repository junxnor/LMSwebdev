
document.addEventListener('DOMContentLoaded', (event) => {
    const navBar = document.getElementById('navBar');
    const SideBarButton = document.getElementById('SideBarButton');
    const SideBarButtonClose = document.getElementById('SideBarButtonClose');

    SideBarButton.addEventListener('click', () => {
        console.log("Button Clicked");
        navBar.classList.toggle("open");
    });


    SideBarButtonClose.addEventListener('click', () => {
        console.log("Button Clicked");
        navBar.classList.replace("open", "close");
    });

});



