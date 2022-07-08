<?php
    include_once "db.php";

    function ins_board($param){ // write_proc.php 에 있는 $param에 접근
        $i_user = $param["i_user"]; // 변수명이 똑같아서 똑같은 값 갖고있는 아니라는것 인지 Q
        $question = $param["question"];

        $sql =
        "   INSERT INTO t_board (i_user, question)
            VALUES ($i_user, '$question')
        "; // 정수형 '' 안붙임
        
        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    function sel_board_list1(&$param){ // main_1.php 에 있는 $param에 접근
        $i_user = $param["i_user"];
        
        $sql =
        "   SELECT A.i_board, A.question, A.answer, A.ans_at, B.profile_img, B.nm, B.intro
            FROM t_board A
            INNER JOIN t_user B
            ON A.i_user=B.i_user
            WHERE answer IS not NULL AND B.i_user = $i_user
            ORDER BY i_board
            DESC
        ";

        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    function sel_board_list2(&$param){ // main_1.php 에 있는 $param에 접근
        $i_user = $param["i_user"];
        
        $sql =
        "   SELECT A.question, A.que_at, A.i_board
            FROM t_board A
            INNER JOIN t_user B
            ON A.i_user=B.i_user
            WHERE answer IS NULL AND B.i_user = $i_user
            ORDER BY i_board
            DESC;
        ";
        
        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    function sel_question($param){
        $i_board = $param["i_board"];

        // $question = $param["question"];
        // $que_at = $param["que_at"];
        // $profile_img = $param["profile_img"];
        // $nm = $param["nm"];
        // $ans_at = $param["ans_at"];
        // $created_at = $param["created_at"];
        // $answer = $param["answer"];
        // $i_user = $param["i_user"];

        $sql =
        "   SELECT A.question, A.que_at, B.profile_img, B.nm, A.ans_at, B.created_at, A.answer, B.i_user
            FROM t_board A
            INNER JOIN t_user B
            ON A.i_user=B.i_user
            WHERE A.i_board = ${i_board}
        ";

        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return mysqli_fetch_assoc($result); // 쿼리문으로 나온 결과를 한줄씩 배열로 넣어주는 함수!
    }

    function sel_board($param){
        $i_board = $param["i_board"];

        // $question = $param["question"];
        // $que_at = $param["que_at"];
        // $profile_img = $param["profile_img"];
        // $nm = $param["nm"];
        // $ans_at = $param["ans_at"];
        // $created_at = $param["created_at"];
        // $answer = $param["answer"];
        // $i_user = $param["i_user"];

        $sql =
        "   SELECT A.question, A.que_at, B.profile_img, B.nm, A.ans_at, B.created_at, A.answer, B.i_user
            FROM t_board A
            INNER JOIN t_user B
            ON A.i_user=B.i_user
            WHERE A.i_board = ${i_board}
        ";

        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return mysqli_fetch_assoc($result); // 쿼리문으로 나온 결과를 한줄씩 배열로 넣어주는 함수!
    }


    function upd_board(&$param){
        $i_board = $param["i_board"];
        $i_user = $param["i_user"];
        $answer = $param["answer"];

        $sql =
        "   UPDATE t_board
            SET answer='$answer'
            WHERE i_board = ${i_board}
            AND i_user = ${i_user}
        ";


// $sql ="UPDATE t_board
// SET answer='$answer', ansmod_at=now()
// WHERE i_board = $i_board
// AND i_user = $i_user"; // 다른사람이 수정x

        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }



    function del_board(&$param){ // del.php 에 있는 $param에 접근
        $i_board = $param["i_board"];
        $i_user = $param["i_user"];

        $sql =
        "   DELETE FROM t_board
            WHERE i_board = $i_board
            AND i_user = $i_user
        ";

        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }