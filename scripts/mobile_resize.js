function changeclass(className, value){
    e = document.getElementsByClassName(className);
    while(e.length > 0) e[0].className = value;
};

function check_menu_size() {
    var width = window.innerWidth
    || document.documentElement.clientWidth
    || document.body.clientWidth;

    if(width < 600) {
        changeclass('menu', 'mobilemenu');
        changeclass('menuright', 'mobilemenuright');
        changeclass('langForm', 'mobilelangForm');
        changeclass('pageTitleImage', 'mobilepageTitleImage');
        changeclass('pageTitle', 'mobilepageTitle');
        changeclass('pageSubTitle', 'mobilepageSubTitle');
        changeclass('postMenu', 'mobilepostMenu');
        changeclass('post', 'mobilepost');
    } else {
        changeclass('mobilemenu', 'menu');
        changeclass('mobilemenuright', 'menuright');
        changeclass('mobilelangForm', 'langForm');
        changeclass('mobilepageTitleImage', 'pageTitleImage');
        changeclass('mobilepageTitle', 'pageTitle');
        changeclass('mobilepageSubTitle', 'pageSubTitle');
        changeclass('mobilepostMenu', 'postMenu');
        changeclass('mobilepost', 'post');
    }
}

window.addEventListener('load', function() {
    check_menu_size();
    window.addEventListener('resize', check_menu_size);
});