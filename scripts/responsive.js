function check_size() {
    var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    var url = new URL(window.location.href);

    if(width < 670) {
        if(url.searchParams.get('mobile') != 'on') {
            update_query(['mobile'], ['mobile'], ['on']);
        }
    } else {
        if(url.searchParams.get('mobile') != 'off') {
            update_query(['mobile'], ['mobile'], ['off']);
        }
    }
}

window.addEventListener('load', check_size);
window.addEventListener('resize', check_size);