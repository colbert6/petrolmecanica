<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr_comprobante {

    public function __construct()
    {
        $CI = &get_instance();
        $CI->load->library('ciqrcode');
    }

    public function crear($data_text, $name_file = 'qr_code')
    {
        $tempDir       = 'public/qr_code/';
        $fileName      = $name_file . '.jpg';
        $outerFrame    = 0;
        $pixelPerPoint = 6;
        $jpegQuality   = 150;

        $frame = QRcode::text($data_text, false, QR_ECLEVEL_M);
        $h     = count($frame);
        $w     = strlen($frame[0]);

        $imgW = $w + 2 * $outerFrame;
        $imgH = $h + 2 * $outerFrame;

        $base_image = imagecreate($imgW, $imgH);
        $col[0]     = imagecolorallocate($base_image, 255, 255, 255);
        $col[1]     = imagecolorallocate($base_image, 0, 0, 0);
        imagefill($base_image, 0, 0, $col[0]);

        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                if ($frame[$y][$x] == '1') {
                    imagesetpixel($base_image, $x + $outerFrame, $y + $outerFrame, $col[1]);
                }
            }
        }

        $target_image = imagecreate($imgW * $pixelPerPoint, $imgH * $pixelPerPoint);
        imagecopyresized(
            $target_image, $base_image,
            0, 0, 0, 0,
            $imgW * $pixelPerPoint, $imgH * $pixelPerPoint, $imgW, $imgH
        );
        imagedestroy($base_image);
        imagejpeg($target_image, $tempDir . $fileName, $jpegQuality);
        imagedestroy($target_image);

        return base64_encode(file_get_contents($tempDir . $fileName));
    }

}
