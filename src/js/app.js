document.addEventListener('DOMContentLoaded', function(){
 
    darkMode();
    eventListeners();

})



function darkMode(){

    const prefiereDarkMode = window.matchMedia('(prefers.color.scheme: dark)');
    const botonDarkMode = document.querySelector('.dark-mode-boton');

    // prefiereDarkMode.addEventListener('change', function(){
    //     if (prefiereDarkMode.matches) {
    //         document.body.classList.add('dark-mode');
    //     } else{
    //         document.body.classList.remove('dark-mode');
    //     }
    // })
    
    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    });

}

 function eventListeners(){
     const mobileMenu = document.querySelector('.mobile-menu');

     mobileMenu.addEventListener('click', navegacionResponsive);
 }

 function navegacionResponsive(){
     const navegacion = document.querySelector('.navegacion');

     navegacion.classList.toggle('mostrar');
 }

