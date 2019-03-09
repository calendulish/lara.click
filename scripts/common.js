function update_query(remove = [], add = [], value = []) {
    var url = new URL(window.location.href);

    for(i = 0; i < remove.length; i++) {
        url.searchParams.delete(remove[i]);
    }

    for(i = 0; i < add.length; i++) {
        url.searchParams.append(add[i], value[i]);
    }

    window.location.href = url.href;
}

function home() {
    update_query(['program', 'page']);
}