<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArrayResoruce;
use Illuminate\Support\Facades\Storage;

class QuranController extends Controller
{
    public function juz()
    {
        $data = Storage::json('in_juz.json');
        $data = collect($data)->map(function ($value) {
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

    public function detailjuz($id)
    {
        $data = Storage::json('in_juz.json');
        $data = collect($data)->filter(fn($v) => $v['data']['juz'] == $id)->first()['data'];
        return new ArrayResoruce(true, '', $data);
    }

    public function surah()
    {
        $data = Storage::json('in_surah.json');
        $data = collect($data)->map(function ($value) {
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

    public function detailsurah($id)
    {
        $data = Storage::json('in_surah.json');
        $data = collect($data)->filter(fn($v) => $v['data']['name']['transliteration']['id'] == $id)->first()['data'];
        return new ArrayResoruce(true, '', $data);
    }

    public function surahsearch($surah, $ayah){
        $data = Storage::json('in_surah.json');
        $data = collect($data)->filter(fn($v) => $v['data']['name']['transliteration']['id'] == $surah)->first()['data'];
        
        $value = $data['verses'];
        if($ayah > count($value)){
            return new ArrayResoruce(false, 'ayah tidak di temukan', null);
        }
        return new ArrayResoruce(true, '', $value[$ayah-1]);
    }

    public function doa()
    {
        $data = Storage::json('in_doa.json');
        $data = collect($data)->map(function ($value) {
            return [
                'id' => $value['judul'],
                'title' => $value['judul'],
                'sumber' => $value['source']
            ];
        });
        return new ArrayResoruce(true, '', $data);
    }
    public function detaildoa($id)
    {
        $data = Storage::json('in_doa.json');
        $data = collect($data)->filter(fn($v) => $v['id'] == $id)->first();
        return new ArrayResoruce(true, '', $data);
    }

    public function asmaul()
    {
        $data = Storage::json('in_asmaul_husnah.json');
        $data = collect($data)['data'];
        return new ArrayResoruce(true, '', $data);
    }

    public function hadist()
    {
        $data = Storage::json('hadis/hadist_list.json');
        return new ArrayResoruce(true, '', $data);
    }

    public function hadistName($name, $page)
    {

        $pages = $page?? 1;
        $data = Storage::json('hadis/' . $name . '.json');
        $dataCollection = collect($data);
        $paginatedData = $dataCollection->forPage($pages, 10);
        $totalPages = ceil($dataCollection->count() / 10);
        $response = [
            'current_page' => $pages,
            'total_page' => $totalPages,
            'data' => $paginatedData,
        ];

        return new ArrayResoruce(true, '', $response);
    }

    public function hadistsearch($name, $number)
    {
        $data = Storage::json('hadis/' . $name . '.json');
        $dataCollection = collect($data);
        $value = $dataCollection->where('number', $number);
        if(count($value) ==0){
            return new ArrayResoruce(false, 'hadis tidak di temukan', null);
        }
        return new ArrayResoruce(true, '', $value);
       
    }
}

