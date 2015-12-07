<div style="background-image: url(tecblog/media/gentoo.svg);
            background-repeat: space;">

<pre>
Desde 12 de agosto o repositório principal de pacotes do Gentoo (também
conhecido como Portage Tree) está também disponível através do git. O
que com toda certeza é um grande avanço.

Eu considero o rsync um método muito lento para sincronizar os pacotes,
então por que não atualizar via git já que agora está disponível?

Para isso basta abrir o seu arquivo /etc/portage/repos.conf/gentoo.conf
e atualizá-lo para algo parecido com isso:
</pre>

<pre style="display: inline-block; text-align: left;">
    [DEFAULT]
    main-repo = gentoo

    [gentoo]
    location = /usr/portage
    sync-type = git
    sync-depth = 0
    sync-uri = https://github.com/gentoo-mirror/gentoo.git
    auto-sync = yes
</pre>

<pre>Podem surgir algumas questões ao ver isso, então vamos responde-las:</pre>

<pre style="font-weight: bold;">1) Por que usar sync-depth=0?</pre>

<pre>
O motivo para isso é que dessa forma podemos usufruir do recurso de
resolução de deltas disponível na ferramenta git. A primeira sincronização
pode demorar um pouco devido ao tamanho do repositório, mas isso vai fazer
com que todas as próximas atualizações sejam extremamente rápidas, pois
não vai ser necessário baixar novamente toda a arvore de arquivos, apenas
as mudanças.
</pre>

<pre style="font-weight: bold;">2) Por que você está usando um mirror do github?</pre>

<pre>O repositório portage está disponível nos seguintes locais:</pre>

<pre style="display: inline-block; text-align: left;">
    git://anongit.gentoo.org/repo/gentoo.git
    git://github.com/gentoo/gentoo.git
    git://github.com/gentoo-mirror/gentoo.git
</pre>

<pre>
Mas no gentoo-mirror o cache é gerado automaticamente todas as vezes que
há alguma atualização no repositório, exatamente como funcionava no
sistema padrão. Já se você usar alguma das outras duas opções, funcionaria
como um overlay e você iria precisar criar o cache localmente. Isso
desperdiçaria muito tempo, e então toda essa operação seria inútil.

Após fazer isso, basta deletar todo O CONTEÚDO da sua pasta /usr/portage
e sincronizar novamente:
</pre>

<pre style="display: inline-block; text-align: left;">
    # rm -rf /usr/portage/{*,.*}
    # eix-sync
</pre>

<pre>Essa primeira sincronização levará algum tempo. Após isso está tudo pronto.</pre>

</div>
