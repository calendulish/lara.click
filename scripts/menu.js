var menu_names = ["start", "language", "disable_overlay"];

function toggle_dropdown(menu_name) {
    for (i = 0; i < menu_names.length; i++) {
        dropdown = document.getElementById(menu_names[i]);

        if(dropdown == null) {
            continue;
        }

        if (i == menu_names.indexOf(menu_name) && dropdown.style.display != "block") {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    }
}

function close_dropdown(event) {
    if (!event.target.matches('.menu button')) {
        for (i = 0; i < menu_names.length; i++) {
            dropdown = document.getElementById(menu_names[i]);

            if(dropdown == null) {
                continue;
            }

            dropdown.style.display = "none";
        }
    }
}

function clock() {
    var clock_element = document.getElementsByClassName('clock')[0];

    if(clock_element == null) {
        return;
    }

        var date = new Date();
        var hour = date.getHours();
        var minutes = date.getMinutes();
        var meridiem = hour >= 12 ? 'pm' : 'am';

        clock_element.innerHTML = (hour % 12 ? hour : 12) + ':' + (minutes < 10 ? '0'+minutes : minutes) + ' ' + meridiem;

    setTimeout(clock, 1000);
}

window.addEventListener("click", close_dropdown);
window.addEventListener("load", clock);