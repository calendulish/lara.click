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
            <a class='menu' onclick="ani('?page=contact')">Contact</a>
            <img class='menu' alt="contact" src="icons/contact.svg" />
        </li>
        <li class='menu'>
            <a class='menu' onclick="ani('?page=tecblog')">TecBlog</a>
            <img class='menu' alt="blog" src="icons/tecblog.svg" />
        </li>

        <div class="menulang">
            <a class='menulang'>Language</a>
            <form class='menulang' method="post" action="">
                <select class='menulang' name="lang" onchange='this.form.submit()'>
                    <option <?=($_SESSION['lang'] == 'pt_BR')?'selected':''?> value="pt_BR">Portuguese</option>
                    <option <?=($_SESSION['lang'] == 'en_US')?'selected':''?> value="en_US">English</option>
                </select>
            </form>
        </div>
    </ul>
</nav>
