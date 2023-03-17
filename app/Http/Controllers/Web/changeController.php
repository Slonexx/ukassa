<?php

namespace App\Http\Controllers\Web;

use App\Clients\KassClient;
use App\Http\Controllers\BD\getMainSettingBD;
use App\Http\Controllers\Controller;
use App\Http\Controllers\globalObjectController;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class changeController extends Controller
{
    public function getChange(Request $request, $accountId){
        $isAdmin = $request->isAdmin;

        $SettingBD = new getMainSettingBD($accountId);
        $Config = new globalObjectController();

        try {
            $ClientTIS = new KassClient($SettingBD->authtoken);
           if ($SettingBD->authtoken != null)
            $get_user = $ClientTIS->GETClient($Config->apiURL_ukassa.'auth/get_user/');
           else  return to_route('errorSetting', [
               'accountId' => $accountId,
               'isAdmin' => $isAdmin,
               'error' => "Токен приложения отсутствует, сообщите разработчикам приложения"]
           );
        } catch (BadResponseException $e){
            return to_route('errorSetting', [
                    'accountId' => $accountId,
                    'isAdmin' => $isAdmin,
                    'error' => $e->getResponse()->getBody()->getContents()]
            );
        } catch (GuzzleException $e) {
            return to_route('errorSetting', [
                    'accountId' => $accountId,
                    'isAdmin' => $isAdmin,
                    'error' => $e->getResponse()->getBody()->getContents()]
            );
        }

        $kassa = $get_user->user_kassas->kassa;

        return view('main.change', [
            'accountId' => $accountId,
            'isAdmin' => $isAdmin,

            'kassa' => $kassa,
        ]);

    }
}
