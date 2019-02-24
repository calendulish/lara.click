    <nav class='menu' id='menu'>
        <ul class='menu'>
            <li class='menu'>
                <button class='menu' onclick="toggle_dropdown('start_menu')"><?php print(_('Start')) ?></button>
                <div class="menu_content" id="start_menu">
                    <a class="menu" href="#"><img class="menu" src="icons/contact.svg" width="30"/><?php print(_('About')) ?></a>
                </div>
            </li>
            <li class='menu right'>
                <div class="clock"></div>
            </li>
            <li class='menu right'>
                <button class='menu' onclick="toggle_dropdown('language_menu')"><?php print(_('Language')) ?></button>
                <div class="menu_content right" id="language_menu">
                    <a href='<?= $CuteExplorer->make_query('lang', 'pt_BR', 'post') ?>'><?= 'pt_BR ' . _('(Portuguese)') ?></a>
                    <a href='<?= $CuteExplorer->make_query('lang', 'en_US', 'post') ?>'><?= 'en_US ' . _('(English)') ?></a>
                </div>
            </li>
        </ul>
    </nav>