<?php

namespace application\controllers;

class FeedController extends Controller
{
    public function index()
    {
        $this->addAttribute(_JS, ["feed/index", "https://unpkg.com/swiper@8/swiper-bundle.min.js"]);
        $this->addAttribute(_CSS, ["feed/index", "https://unpkg.com/swiper@8/swiper-bundle.min.css"]);
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
                    if (move_uploaded_file($tempName, $saveDirectory . "/" . $randomFileNm));
                    $param = [
                        "ifeed" => $ifeed,
                        "img" => $randomFileNm
                    ];
                    $this->model->insFeedImg($param);
                }

                return ["result" => 1];

            case _GET:
                $page = 1;
                if (isset($_GET["page"])) {
                    $page = intval($_GET["page"]);
                }
                $startIdx = ($page - 1) * _FEED_ITEM_CNT;
                $param = [
                    "startIdx" => $startIdx,
                    "iuser" => getIuser()
                ];
                $list = $this->model->selFeedList($param);
                foreach ($list as $item) {
                    $item->imgList = $this->model->selFeedImgList($item);
                }
                return $list;
        }
    }

    public function fav()
    {
        $urlPaths = getUrlPaths();
        if (!isset($urlPaths[2])) {
            exit();
        }
        $param = [
            "ifeed" => intval($urlPaths[2]),
            "iuser" => getIuser()
        ];
        print $urlPaths[2];

        switch (getMethod()) {
            case _POST:
                return [_RESULT => $this->model->insFeedFav($param)];
            case _DELETE:
                return [_RESULT => $this->model->delFeedFav($param)];
        }
    }
}
