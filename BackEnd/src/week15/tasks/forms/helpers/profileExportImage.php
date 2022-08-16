<?php
require_once './../configs/dirs.php';
define('EXPORT_TMPL_NAME_PNG', 'userProfileTmpl.png');
define('USER_PROFILES_DIR', UPLOAD_DIR_FULL . '/user_profiles/');
define('FONT', FONTS_DIR_FULL . '/Lato-Black.ttf');

function createProfileAsPNG($userInfo, $photoPath) {
    $imgMarginLeft = 35;
    $nameSX = 435;
    $nameSY = 95;
    $langsSX = 530;
    $langsSY = 179;
    $addInfoSX = 435;
    $addInfoSY = 300;
    $scaleX = 330;
    $scaleY = 440;

    $userInfo['fullname'] = $userInfo['name'] . ' ' . $userInfo['lastname'];
    $userInfo['coding_langs'] = implode(',   ', $userInfo['coding_lang']); 

    $userPhotoName = basename($photoPath);
    $ext = pathinfo($userPhotoName, PATHINFO_EXTENSION);

    $bckIm = imagecreatefrompng(IMAGES_DIR_FULL . '/' . EXPORT_TMPL_NAME_PNG);
    $bckImSizeX = imagesx($bckIm);
    $bckImSizeY = imagesy($bckIm);

    if ($ext === 'png') {
        $userImage = imagecreatefrompng(UPLOAD_DIR_FULL . '/profile_photos/' . $userPhotoName);
    } elseif ($ext === 'jpg' || $ext === 'jpeg') {
        $userImage = imagecreatefromjpeg(UPLOAD_DIR_FULL . '/profile_photos/' . $userPhotoName);
    }

   
    $userImage = imagescale($userImage, $scaleX);
    $userImageSizeX = imagesx($userImage);
    $userImageSizeY = imagesy($userImage);

    imagefilter($userImage, IMG_FILTER_GRAYSCALE);

    $colorForText = imageColorAllocate($bckIm, 64, 64, 64);

    imagettftext($bckIm, 20, 0, $nameSX, $nameSY, $colorForText, FONT, $userInfo['fullname']);
    imagettftext($bckIm, 14, 0, $langsSX, $langsSY, $colorForText, FONT, $userInfo['coding_langs']);
    imagettftext($bckIm, 12, 0, $addInfoSX, $addInfoSY, $colorForText, FONT, wordwrap($userInfo['additional_info']));

    imagecopy($bckIm, $userImage, $imgMarginLeft, ($bckImSizeY - $userImageSizeY) / 2, 0, 0, $userImageSizeX, $userImageSizeY);

    imagettftext($bckIm, 20, 0, $nameSX, $nameSY, $colorForText, FONT, $userInfo['fullname']);
    imagettftext($bckIm, 14, 0, $langsSX, $langsSY, $colorForText, FONT, $userInfo['coding_langs']);
    imagettftext($bckIm, 12, 0, $addInfoSX, $addInfoSY, $colorForText, FONT, wordwrap($userInfo['additional_info']));

    imagepng($bckIm, USER_PROFILES_DIR . $userPhotoName);
    imagedestroy($bckIm);
    imagedestroy($userImage);

    return sprintf('..%s/user_profiles/%s', UPLOAD_DIR, $userPhotoName);
}