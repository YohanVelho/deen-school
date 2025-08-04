<?php

use Illuminate\Support\Facades\App;
use Intervention\Image\ImageManagerStatic as Image;

if (!function_exists('resize')) {
    function resize($file, int $width = null, int $height = null)
    {
        $file = $file ?? 'default.png';
        $data = explode('.', $file);
        $ext = $data[1];

        $explode = explode('/', $data[0]);
        $name = $explode[count($explode) - 1];

        if(!in_array($ext,["jpeg","jpg","png","webp","gif","bmp"])){
            return asset('storage/' . $file);
        }

        $file = __DIR__ . '/../public/storage/' . $file;

        if (!file_exists($file))
            return asset('storage/default.png');

        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false)
            $ext = 'webp';


        list($w, $h) = getimagesize($file);

        if(!$width && !$height){
            $width = $w;
            $height = $h;
        }else if(!($width && $height)){
            if ($width) {
                if ($w < $width) {
                    $width = $w;
                }
                $height = ceil(($h / $w) * $width);
            } else {
                if ($h < $height) {
                    $height = $h;
                }
                $width = ceil(($w / $h) * $height);
            }
        }

        $name = $name . '-' . $width . '-' . $height . '.' . $ext;

        if (file_exists(__DIR__ . '/../public/storage/cache/' . $name))
            return asset('storage/cache/' . $name);

        $image = Image::make($file)->resize($width, $height);
        $image->save(__DIR__ . '/../public/storage/cache/' . $name, 80, $ext);

        return asset('storage/cache/' . $name);
    }
}


if(!function_exists('T')){
    function T(array $values, string $name)
    {
        $lang = App::getLocale();
        if(isset($values[$name.'_'.$lang]))
            return $values[$name.'_'.$lang];
        if(isset($values[$name]))
            return $values[$name];
        if(isset($values[$name.'_pt']))
            return $values[$name.'_pt'];
    }
}

if(!function_exists('is_mobile')){
    function is_mobile(){
        $devicesmobile = ['iPhone', 'Android', 'webOS', 'BlackBerry', 'iPad', 'iPod'];
        foreach ($devicesmobile as $device) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], $device) !== false) {
                return true;
            }
        }
        return false;
    }
}


if(!function_exists('slugify')){
   function slugify($text, string $divider = '-')
    {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        return $text;
    }
}


if(!function_exists('media')){
    function media(array $values, string $name, array $options = []){
        $data = explode('.', $values[$name]);
        $ext = array_pop($data);
        if(in_array($ext,["mp4","mov"])){
            return '<video class="'.($options['class'] ?? '').'" src="'.resize($values[$name], ($options['width'] ?? null), ($options['height'] ?? null)).'" alt="'.($values[$name.'_alt'] ?? '').'" muted loop playsinline autoplay '.($options['attr'] ?? '').'></video>';
        }else if($ext == 'svg'){
            return file_get_contents(__DIR__ . '/../public/storage/'.$values[$name]);
        }else{
            return '<img loading="lazy" class="'.($options['class'] ?? '').'" src="'.resize($values[$name], ($options['width'] ?? null), ($options['height'] ?? null)).'" alt="'.($values[$name.'_alt'] ?? '').'" '.($options['attr'] ?? '').' />';
        }
    }
}
