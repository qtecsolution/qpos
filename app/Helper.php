<?php

use App\Models\Currency;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

if (!function_exists('imageRecover')) {

    function imageRecover($path)
    {
        if ($path == null || !\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            return asset('dist/img/default-150x150.png');
        }

        $storage_link = \Illuminate\Support\Facades\Storage::url($path);

        return asset($storage_link);
    }
}

if (!function_exists('imageRecoverNull')) {

    function imageRecoverNull($path)
    {
        if ($path == null || !\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            return 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';
        }

        $storage_link = \Illuminate\Support\Facades\Storage::url($path);

        return asset($storage_link);
    }
}


if (!function_exists('docRecover')) {

    function docRecover($path)
    {
        if ($path == null || !\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            return null;
        }

        $storage_link = \Illuminate\Support\Facades\Storage::url($path);

        return asset($storage_link);
    }
}

if (!function_exists('terms')) {

    function terms()
    {
        return Page::where('status', 1)
            ->where('title', 'like', '%term%')
            ->first();
    }
}

if (!function_exists('writeConfig')) {
    function writeConfig($key, $value)
    {
        config(['system.' . $key => $value]);
        $fp = fopen(base_path() . '/config/system.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('system'), true) . ';');
        fclose($fp);

        return @$value;
    }
}

if (!function_exists('readConfig')) {
    function readConfig($key)
    {
        return @config('system.' . $key);
    }
}

if (!function_exists('assetImage')) {

    function assetImage($path)
    {
        if ($path == null || !file_exists(public_path($path))) {
            return asset('assets/images/nofav.png');
        }

        return asset($path);
    }
}

if (!function_exists('slugify')) {

    function slugify($text)
    {
        return Str::slug($text);
    }
}

if (!function_exists('snakeToTitle')) {

    function snakeToTitle($text)
    {
        return Str::title(Str::snake(Str::studly($text), ' '));
    }
}

if (!function_exists('nullImg')) {

    function nullImg()
    {
        return "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";
    }
}
if (!function_exists('currency')) {
    function currency()
    {
        return Cache::remember('default_currency', 60 * 24, function () {
            return Currency::where('active', true)->first();
        });
    }
}
