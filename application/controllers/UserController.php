<?php

namespace application\controllers;

// require_once "application/utils/UrlUtils.php";

class UserController extends Controller
{
    public function signin()
    {
        switch (getMethod()) {
            case _GET:
                return "user/signin.php";
            case _POST:
                $param = [
                    "email" => $_POST["email"],
                    "pw" => $_POST["pw"]
                ];
                //아이디,비번이 하나라도 없거나 틀리면 > /user/signin
                //아이디,비번이 맞다면 /feed/index
                $dbUser = $this->model->selUser($param);
                if ($dbUser === false || !password_verify($param["pw"], $dbUser->pw)) {
                    return "redirect:signin?email={$email}&err";
                }
                $dbUser->pw = null;
                $dbUser->regdt = null;
                $this->flash(_LOGINUSER, $dbUser);
                return "redirect:/feed/index";
        }
    }
    // return "user/signin.php";


    public function signup()
    {
        switch (getMethod()) {
            case _GET:
                return "user/signup.php";
            case _POST:
                $email = $_POST["email"];
                $pw = $_POST["pw"];
                $nm = $_POST["nm"];
                $param = [
                    "email" => $email,
                    "pw" => $pw,
                    "nm" => $nm
                ];

                $param["pw"] = password_hash($param["pw"], PASSWORD_BCRYPT);
                $this->model->insUser($param);
                return "redirect:signin";
        }

        // if (getMethod() === _GET) {
        //     return "user/signup.php";
        // } else if (getMethod() === _POST) {
        //     return "redirect:signin";
        // }
        // return "user/signup.php";
    }

    public function logout()
    {
        $this->flash(_LOGINUSER);
        return "redirect:/user/signin";
    }

    public function feedwin()
    {
        $iuser = isset($_GET["iuser"]) ? intval($_GET["iuser"]) : 0;
        $param = ["feediuser" => $iuser, "loginiuser" => getIuser()];
        $this->addAttribute(_DATA, $this->model->selUserProfile($param));
        $this->addAttribute(_JS, ["user/feedwin", "https://unpkg.com/swiper@8/swiper-bundle.min.js"]);
        $this->addAttribute(_CSS, ["user/feedwin", "https://unpkg.com/swiper@8/swiper-bundle.min.css"]);
        $this->addAttribute(_MAIN, $this->getView("user/feedwin.php"));
        return "template/t1.php";
    }
}
