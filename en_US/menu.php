    <nav>
        <ul>
            <li class="divider-vertical"></li>
            <li><a href="?page=home">Home</a><img alt="home" src="icons/home.svg" /></li>
            <li class="divider-vertical"></li>
            <li><a href="?page=downloads">Archives</a><img alt="downloads" src="icons/download.svg" /></li>
            <li class="divider-vertical"></li>
            <li><a href="?page=contact">Contact</a><img alt="contact" src="icons/contact.svg" /></li>
            <li class="divider-vertical"></li>

            <div class="language">
                <a>Language</a>
                <form method="post" action="">
                    <select name="lang" onchange='this.form.submit()'>
                        <option <?=($_SESSION['lang'] == 'pt_BR')?'selected':''?> value="pt_BR">Portuguese</option>
                        <option <?=($_SESSION['lang'] == 'en_US')?'selected':''?> value="en_US">English</option>
                    </select>
                </form>
            </div>
        </ul>
    </nav>
