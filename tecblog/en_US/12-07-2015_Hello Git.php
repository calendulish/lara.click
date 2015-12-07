<div style="background-image: url(tecblog/media/gentoo.svg);
            background-repeat: space;">

<pre>
Since August day 12, the main Gentoo packages repository (also known as
Portage Tree) is also available via git. That surely is a major improvement.

I consider rsync a very slow method to synchronize the packages, so why
don't upgrade via git since it's now available?

To do this simply open your file /etc/portage/repos.conf/gentoo.conf
and upgrade it to something like this:
</pre>

<pre style="display: inline-block; text-align: left;">
    [DEFAULT]
    main-repo = gentoo

    [gentoo]
    location = /usr/portage
    sync-type = git
    sync-depth = 0
    sync-uri = git://github.com/gentoo-mirror/gentoo.git
    auto-sync = yes
</pre>

<pre>Some questions can appear when you see it. So I answer them:</pre>

<pre style="font-weight: bold;">1) Why use sync-depth=0?</pre>

<pre>
The reason for this is that in this way we can take advantage of delta
resolution, a feature available in the git tool. The first sincronization
can take some time due the repository size, but all future updates will
be extremely fast, because it will not have to re-download the entrie
tree of files, only the changes.
</pre>

<pre style="font-weight: bold;">2) Why you is using a github mirror?</pre>

<pre>The portage repository is available in the following locations:</pre>

<pre style="display: inline-block; text-align: left;">
    git://anongit.gentoo.org/repo/gentoo.git
    git://github.com/gentoo/gentoo.git
    git://github.com/gentoo-mirror/gentoo.git
</pre>

<pre>
But in the gentoo-mirror the cache is automatically generated every time
there is an update in the repository, exactly as it worked in the
default system. If you use one of the other two options would work as an
overlay and you would need to create the cache locally. That wate a lot
of time and then the entire operation would be useless.

After do that, simply delete the entire CONTENTS of yout folder /usr/portage
and synchronize again:
</pre>

<pre style="display: inline-block; text-align: left;">
    # rm -rf /usr/portage/{*,.*}
    # eix-sync
</pre>

<pre>This first sinchronization will take some time. After this everything
is ready to use.</pre>

</div>
