<?php
session_start();

function getLoginUser()
{
    return $_SESSION[_LOGINUSER];
}

function getIuser()
{
    return getLoginUser()->iuser;
}

function getMainImgSrc()
{
    // <?=$_SESSION[_LOGINUSER]->iuser / $_SESSION[_LOGINUSER]->mainimg
    return getIuser() . "/" .  getLoginUser()->mainimg;
}
