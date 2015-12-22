    <nav class='menu'>
        <ul class='menu'>
            <li class='menu'>
                <a class='menu' onclick="ani('?page=home')">Início</a>
                <img class='menu' alt="home" src="icons/home.svg" />
            </li>
            <li class='menu'>
                <a class='menu' onclick="ani('?page=downloads')">Arquivos</a>
                <img class='menu' alt="downloads" src="icons/download.svg" />
            </li>
            <li class='menu'>
                <a class='menu' onclick="ani('?page=contact')">Contato</a>
                <img class='menu' alt="contact" src="icons/contact.svg" />
            </li>
            <li class='menu'>
                <a class='menu' onclick="ani('?page=tecblog')">TecBlog</a>
                <img class='menu' alt="blog" src="icons/tecblog.svg" />
            </li>
            <li class='menu'>
                <a class='menu' onclick="ani('?page=blog')">Blog</a>
                <img class='menu' alt="blog" src="icons/blog.svg" />
            </li>

            <div class="menulang">
                <a class='menulang'>Idioma</a>
                <form class='menulang' method="post" action="">
                    <select class='menulang' name="lang" onchange='this.form.submit()'>
                        <option <?=($_SESSION['lang'] == 'pt_BR')?'selected':''?> value="pt_BR">Português</option>
                        <option <?=($_SESSION['lang'] == 'en_US')?'selected':''?> value="en_US">Inglês</option>
                    </select>
                </form>
            </div>
        </ul>
    </nav>
