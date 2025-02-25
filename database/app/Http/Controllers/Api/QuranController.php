<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArrayResoruce;
use Illuminate\Support\Facades\Storage;

class QuranController extends Controller
{
   public function juz(){
    $data = Storage::json('in_juz.json');
    $data = collect($data)->map(function($value) {
       $value = $value['data'];
        return [
            'juz' => $value['juz'],
            'juzStartInfo' => $value['juzStartInfo'],
            'juzEndInfo' => $value['juzEndInfo'],
            'totalVerses' => $value['totalVerses']
        ];
    });
    return new ArrayResoruce(true, '', $data);
   }

   public function detailjuz($id){
    $data = Storage::json('in_juz.json');
    $data = collect($data)->filter(fn($v)=> $v['data']['juz']==$id)->first()['data'];
    return new ArrayResoruce(true, '', $data);
   }

   public function surah(){
    $data = Storage::json('in_surah.json');
    $data = collect($data)->map(function($value) {
       $value = $value['data'];
        return [
            'name' => $value['name'],
            'number' => $value['number'],
            'numberOfVerses' => $value['numberOfVerses'],
            'revelation' => $value['revelation']
        ];
    });
    return new ArrayResoruce(true, '', $data);
   }

   public function detailsurah($id){
    $data = Storage::json('in_surah.json');
    $data = collect($data)->filter(fn($v)=> $v['data']['name']['transliteration']['id']==$id)->first()['data'];
    return new ArrayResoruce(true, '', $data);
   }

   public function doa(){
    $data = Storage::json('in_doa.json');
    $data = collect($data)->map(function($value) {
        return [
            'id' =>$value['id'],
            'title' => $value['title'],
        ];
    });
    return new ArrayResoruce(true, '', $data);
   }
   public function detaildoa($id){
    $data = Storage::json('in_doa.json');
    $data = collect($data)->filter(fn($v)=> $v['id']==$id)->first();
    return new ArrayResoruce(true, '', $data);
   }

   public function asmaul(){
    $data = Storage::json('in_asmaul_husnah.json');
    $data = collect($data)['data'];
    return new ArrayResoruce(true, '', $data);
   }
}
