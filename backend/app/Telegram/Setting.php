<?php

namespace App\Telegram;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;

    public static function getSettings($key = null) {
        $settings = $key ? self::where('key', $key)->first() : self::get();
        $collection = collect();
        foreach ($settings as $setting) {
            $collection->put($setting->key, $setting->value);
        }
        return $collection;
    }
}
