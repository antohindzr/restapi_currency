<?php

namespace App\Http\Controllers\currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\requestModel;
use App\Models\Models\answerModel;
use App\Models\Models\fullModel;
use Illuminate\Support\Facades\Validator;

class currencyController extends Controller
{
    public function request() {
        return response()->json(requestModel::get(), 200);
    }
    public function requestSave(Request $req)
    {     
         $rules = [
          'cur'=>'required||string|min:3|max:3|regex:/(^[A-Za-z ]+$)+/',
          ];
          $validator = Validator::make($req->all(),$rules);
          if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        requestModel::create($req->all());
        
        $cur = requestModel::orderBy('id','desc')->value('cur');  

        $url = 'https://api.apilayer.com/exchangerates_data/convert';

        $options = array(
        'amount'=> 1,
        'from'=> $cur,
        'to'=> 'rub',
        'apikey' => 'eokdfqbKu7epkADr7yjBx5DMbnIxGT92' ,   );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($options));
            
       $response = curl_exec($ch);
       $data = json_decode($response, true);
       curl_close($ch);
      
          
        $result = $data      ['result'];
      
        $toTelegram="Текущий курс $cur по отношению к RUB:".$result;
        
        //echo $toTelegram;
        $token="5730101848:AAEhpZGMSIrAc6D9FzEzzYJ9g8NlJPuVLi4";
      $chatID = "-1001676777228";//"1611970875";
        file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chatID."&text=".$toTelegram);
      

      return response()->json($data, 201);
       
    }
    public function answer() {
        return response()->json(answerModel::get(), 200);
    }
    public function full() {
        return response()->json(fullModel::get(), 200);
    }
 }
