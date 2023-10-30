<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class testupload extends Controller
{

    public function show()
    {
        return view('test');
    }
    public function upload(Request $request)
    {
        $id_pegawai = 1;
        $client = new Client();
        $url = "http://103.100.27.59/~lacaksurat/add_history_disposisi.php";

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'multipart/form-data; boundary=---011000010111000001101001',
                'id_pegawai' => '1',
            ],
            'multipart' => [
                [
                    'name' => 'p_tiket_id',
                    'contents' => $request->input('tiket_id')
                ],
                [
                    'name' => 'p_id_pegawai_penerima',
                    'contents' => $request->input('penerima')
                ],
                [
                    'name' => 'p_keterangan',
                    'contents' => $request->input('keterangan')
                ]
            ]
        ]);

        $data = [$response->getBody()->getContents(), $request];

        return view('welcome', compact('data'));
    }
    public function kirimDataKeEndpoint(Request $request)
    {
        $client = new Client();
        $url = "http://103.100.27.59/~lacaksurat/add_history_disposisi.php";

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'multipart/form-data; boundary=---011000010111000001101001',
                'id_pegawai' => '1',
            ],
            'multipart' => [
                [
                    'name' => 'p_tiket_id',
                    'contents' => $request->input('tiket_id')
                ],
                [
                    'name' => 'p_id_pegawai_penerima',
                    'contents' => $request->input('penerima')
                ],
                [
                    'name' => 'p_keterangan',
                    'contents' => $request->input('keterangan')
                ]
            ]
        ]);

        $responseBody = $response->getBody()->getContents();

        return $responseBody;
    }
}
