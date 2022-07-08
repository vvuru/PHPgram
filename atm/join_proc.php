<?php
    // 다른 파일에 있는 것을 마치 이쪽에 있는 것처럼 포함시켜 사용
    include_once "db/db_user.php";

    $email = $_POST["email"];
    $upw = $_POST["upw"];
    $confirm_upw = $_POST["confirm_upw"];
    $nm = $_POST["nm"];

    $param = [
        "email" => $email,
        "upw" => $upw,
        "nm" => $nm,
    ];
    
    $result = ins_user($param);
    //user_join이라는 함수를 호출
    // 프로그래밍의 = 의 의미는 오른쪽에 있는 걸 복사하여 왼쪽으로 가져온다
    // == 값이 같냐?
    // $result = user_join($param); 리턴값. 물어 보면 무조건 대답해야함
    // ㅇㅇㅇㅇㅇㅇ($param); 일하는데 답안함

    echo "result : ", $result, "<br>"; //빈칸 -> false 1 -> true
    echo "email : ", $email, "<br>";
    echo "upw : ", $upw, "<br>";
    echo "confirm_upw : ", $confirm_upw, "<br>";
    echo "nm : ", $nm, "<br>";

    header("Location: login.php");
