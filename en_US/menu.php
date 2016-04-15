<nav class='menu'>
    <ul class='menu'>
        <li class='menu'>
            <a class='menu' onclick="ani('?page=home')">Home</a>
            <img class='menu' alt="home" src="icons/home.svg" />
        </li>
        <li class='menu'>
            <a class='menu' onclick="ani('?page=downloads')">Files</a>
            <img class='menu' alt="downloads" src="icons/download.svg" />
        </li>
        <li class='menu'>
            <a class='menu' onclick="ani('?page=raspberrypi')">RaspberryPi</a>
            <img class='menu' alt="raspberrypi" src="icons/raspberrypi.svg" />
        </li>
        <li class='menu'>
            <a class='menu' onclick="ani('?page=contact')">Contact</a>
            <img class='menu' alt="contact" src="icons/contact.svg" />
        </li>
        <li class='menuright'>
            <a class='menuright'>Language</a>
            <form class='langForm' method="post">
                <select class='langForm' name="lang" onchange='this.form.submit()'>
                    <option <?=($_SESSION['lang'] == 'pt_BR')?'selected':''?> value="pt_BR">Portuguese</option>
                    <option <?=($_SESSION['lang'] == 'en_US')?'selected':''?> value="en_US">English</option>
                </select>
            </form>
        </li>
    </ul>
</nav>
