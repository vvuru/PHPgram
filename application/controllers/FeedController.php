<?php

namespace application\controllers;

class FeedController extends Controller
{
    public function index()
    {
        $this->addAttribute(_JS, ["feed/index"]);
        $this->addAttribute(_MAIN, $this->getView("feed/index.php"));
        return "template/t1.php";

        return "feed/index.php";
    }

    public function rest()
    {
        switch (getMethod()) {
            case _POST:
                if (!is_array($_FILES) || !isset($_FILES["imgs"])) {
                    return ["result" => 0];
                }
                $iuser = getIuser();
                $param = [
                    "location" => $_POST["location"],
                    "ctnt" => $_POST["ctnt"],
                    "iuser" => $iuser
                ];

                $ifeed = $this->model->insFeed($param);

                foreach ($_FILES["imgs"]["name"] as $key => $originalFileNm) {
                    $saveDirectory = _IMG_PATH . "/feed/" . $ifeed;
                    if (!is_dir($saveDirectory)) {
                        mkdir($saveDirectory, 0777, true);
                    }
                    $tempName = $_FILES["imgs"]["tmp_name"][$key];
                    $randomFileNm = getRandomFileNm($originalFileNm);
                    if (move_uploaded_file($tempName, $saveDirectory . "/test." . $randomFileNm));
                    $param = [
                        "ifeed" => $ifeed,
                        "img" => $randomFileNm
                    ];
                    $this->model->insFeedImg($param);
                }

                // return ["result" => $ifeed];
        }
    }
}
