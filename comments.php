<?php
function writeComment($commentsFile) {
    $data = is_file($commentsFile) ? file_get_contents($commentsFile) : null;
    $data = $data ? @json_decode($data) : array();
    $data[] = array(
        'date' => date('m-d-Y'),
        'time' => date('H:i'),
        'name' => ucwords($_POST['name']),
        'text' => $_POST['message'],
    );
    print("<script>window.addEventListener('load', function(){document.getElementById('focus').focus();});</script>");
    // Prevent duplicate comments
    if(count($data) > 1 && $data[count($data)-2]->text == $data[count($data)-1]['text']) {
        return 1;
    } else {
        if(!is_dir(dirname($commentsFile))) {
            mkdir(dirname($commentsFile));
        }
        file_put_contents($commentsFile, json_encode($data));
    }
}

function readComment($commentsFile) {
    $comments = array();
    $data = json_decode(file_get_contents($commentsFile));
    $comments = array_reverse($data);

    foreach($comments as $comment) {
        print("<div class='commentsInfo'>\n<p>".$comment->date.' por '.$comment->name."</p>\n</div>\n");
        print('<p class="commentsText">'.$comment->text."</p>\n");
    }
}
