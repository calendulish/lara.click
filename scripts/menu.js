var menu_names = ["start_menu", "language_menu"];

function toggle_dropdown(menu_name) {
    for (i = 0; i < menu_names.length; i++) {
        menu_contents = document.getElementById(menu_names[i]);
        
        if (i == menu_names.indexOf(menu_name)) {
            menu_contents.classList.add("show");
        } else {
            menu_contents.classList.remove("show");
        }
    }
}

function close_dropdown(event) {
    if (!event.target.matches('button.menu')) {
        for (i = 0; i < menu_names.length; i++) {
            menu_contents = document.getElementById(menu_names[i]);
            
            menu_contents.classList.remove("show");
        }
    }
}

function clock() {
    var clock_element = document.getElementsByClassName('clock')[0];
    var date = new Date();
    var hour = date.getHours();
    var minutes = date.getMinutes();
    var meridiem = hour >= 12 ? 'pm' : 'am';
    
    clock_element.innerHTML = (hour % 12 ? hour : 12) + ':' + (minutes < 10 ? '0'+minutes : minutes) + ' ' + meridiem;
    
    setTimeout(clock, 1000);
}

window.addEventListener("click", close_dropdown);
window.addEventListener("load", clock);