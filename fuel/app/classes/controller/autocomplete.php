<?php

    $key = $_POST['param1'];
    $max_list = 4;
    if($key){
        $bind_param = Util_Ngram::build($key);
        $bind_param = Util_Ngram::query($bind_param);
        $query = "SELECT * FROM question WHERE MATCH(title_ngram) AGAINST(+:key IN BOOLEAN MODE)" .
            "UNION " .
            "SELECT q.* FROM question q INNER JOIN question_tag t ON q.id = t.question_id WHERE MATCH(t.tag_ngram) AGAINST(+:key IN BOOLEAN MODE)" .
            "UNION " .
            "SELECT * FROM question WHERE MATCH(body_ngram) AGAINST(+:key IN BOOLEAN MODE)" .
            "LIMIT " . $max_list . " " .
            "OFFSET " . $max_list-1;
    }
    foreach($query as $culumn){
        echo json_encode($culumn);
    
    }
?>
