<?php

namespace App\Http\Controllers\Telegram\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\Setting;



class SettingController extends Controller
{
    public function index () {
        return view('telegram.setting.setting', Setting::getSettings());
    }

    public function store (Request $request) {
        Setting::where('key', '!=', NULL)->delete();
        $setting = new Setting;
        foreach ($request->except('_token') as $key => $value) {
            $setting->key = $key;
            $setting->value = $request->$key;
            $setting->save();
        }
        return redirect('telegram/setting');
    }

    public function setWebHook (Request $request) {
        $result = $this->sendTelegramData('setwebhook', [
           'query' => ['url' => $request->url . '/'. \Telegram::getAccessToken()]
        ]);

        return redirect()->route('telegram.setting.index')->with('status', $result);
    }

    public function getWebHookInfo (Request $request) {
        $result = $this->sendTelegramData('getWebhookInfo');
        return redirect()->route('telegram.setting.index')->with('status', $result);
    }

    public function sendTelegramData ($route = '', $params = [], $method = 'POST') {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.telegram.org/bot' . \Telegram::getAccessToken() . '/']);
        $result = $client->request($method, $route, $params);
        return (string) $result->getBody();
    }


}
