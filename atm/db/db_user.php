<?php
include_once "db.php";

function ins_user(&$param)
{
    $email = $param["email"];
    $upw = $param["upw"];
    $nm = $param["nm"];

    $conn = get_conn();
    $sql = "INSERT INTO t_user (email,upw,nm) VALUES ('$email','$upw','$nm')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function sel_user(&$param)
{
    $i_user = $param["i_user"];
    $email = $param["email"];

    $sql = "SELECT i_user,email,upw,nm,profile_img FROM t_user WHERE email='$email'";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return mysqli_fetch_assoc($result);
}


function sel_profile(&$param)
{
    $i_user = $param["i_user"];

    $sql = " SELECT i_user, email, nm, profile_img, intro 
           FROM t_user 
           WHERE i_user='$i_user'";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return mysqli_fetch_assoc($result);
}

function upd_upw(&$param)
{
    $i_user = $param["i_user"];
    $upw = $param["upw"];
    $new_upw = $param["new_upw"];

    $sql = "UPDATE t_user
             SET upw = '$new_upw',
                 updated_at = now()
             WHERE i_user='$i_user'";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function upd_profile(&$param)
{
    $i_user = $param["i_user"];
    $nm = $param["nm"];
    $intro = $param["intro"];

    $sql = "UPDATE t_user
             SET profile_img='{$param["profile_img"]}',
                 nm = '$nm',
                 intro = '$intro'
             WHERE i_user='$i_user'";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function del_user(&$param)

{
    $i_user = $param["i_user"];

    $sql = "DELETE
            FROM t_user
            WHERE i_user = $i_user";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}