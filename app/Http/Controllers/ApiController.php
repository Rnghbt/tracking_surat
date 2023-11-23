<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{

    public function getDataBerkas($id_pegawai)
    {
        $api_endpoint = env('API_ENDPOINT');
        $response = Http::withHeaders([
            'id_pegawai' => $id_pegawai,
            'Content-Type' => 'multipart/form-data'
        ])->get($api_endpoint . 'list_surat.php');

        $files = $response->json()['data'];;
        return $files;
    }

    public function getListTags()
    {
        return $tags = [
            'Aplikasi Surat',
            'Pelacakan Surat',
            'Manajemen Surat',
            'Surat Elektronik',
            'Sistem Pelacakan Surat',
            'Pengiriman Surat',
            'Sistem Manajemen Dokumen',
            'E-surat',
            'Teknologi Kantor',
            'Manajemen Komunikasi',
            'Pengelolaan Arsip',
            'Efisiensi Kantor',
            'Sistem Pengarsipan',
            'Kemajuan Teknologi Surat',
            'Surat Digital',
            'Efisiensi Pengiriman Surat',
            'Pengiriman Surat Elektronik',
            'Surat Masuk'
        ];
    }

    public function getHistory(Request $request)
    {
        $tiket_id = $request->input('tiket_id');
        $id_pegawai = 1;
        $files = $this->getDataBerkas($id_pegawai);
        $files = collect($files);
        foreach ($files as $f) {
            if ($file['$tiket_id'] = $tiket_id) {
                $file = $f;
                break;
            }
        }

        $api_endpoint = env('API_ENDPOINT');

        $listhistory = Http::withHeaders([
            'tiket_id' => $tiket_id
        ])->post($api_endpoint . 'get_history_surat.php');

        $history = $listhistory->json()['data'];




        // return $history;
        return view('modal.history', compact('history', 'file'));
    }

    public function getListDisposisi($id_pegawai)
    {
        $api_endpoint = env('API_ENDPOINT');
        if (!session()->has('disposisi')) {
            $listDisposisi = Http::withHeaders([
                'id_pegawai' => $id_pegawai
            ])->get($api_endpoint . 'list_pegawai_disposisi.php');

            $ds = $listDisposisi->json()['data'];

            session(['disposisi' => $ds]);
        } else {
            $ds = session('disposisi');
        }


        return $ds;
    }

    /**
     * index
     *
     * @return View
     */
    public function dashboard(Request $request)
    {


        $id_pegawai = 1;
        $files = $this->getDataBerkas($id_pegawai);

        $open = 0;
        $close = 0;
        $total_berkas = 0;

        // Loop melalui array dan hitung jumlah open dan close
        foreach ($files as $f) {
            if ($f["status"] == "1") {
                $open++;
            } elseif ($f["status"] == "0") {
                $close++;
            }
        }

        // Loop melalui array dan tambahkan ke total
        foreach ($files as $nilai) {
            $total_berkas++;
        }

        $files = collect($files); // Ubah array menjadi koleksi untuk memungkinkan penggunaan paginator
        $output = '';
        // Pencarian
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $files = $files->filter(function ($file) use ($keyword) {
                $keywords = explode(' ', $keyword);

                $foundKeywords = 0;

                foreach ($keywords as $k) {
                    if (
                        stripos($file['nama_dokumen'], $k) !== false ||
                        stripos($file['ringkasan_dokumen'], $k) !== false ||
                        stripos($file['tiket_id'], $k) !== false ||
                        stripos($file['nama_pengirim'], $k) !== false
                    ) {
                        $foundKeywords++;
                    }
                }

                return $foundKeywords === count($keywords);
            });
        }

        // Pencarian
        if ($request->has('status')) {
            $status = $request->input('status');
            if ($status == 1 || $status == 0) {
                $files = $files->filter(function ($file) use ($status) {
                    return stripos($file['status'], $status) !== false;
                });
            }
        }

        $perPage = 10; // Tentukan berapa item yang ingin Anda tampilkan per halaman
        $currentPage = request()->get('page', 1); // Dapatkan nomor halaman saat ini

        $currentPageItems = $files->slice(($currentPage - 1) * $perPage, $perPage); // Ambil item untuk halaman saat ini
        $files = new LengthAwarePaginator($currentPageItems, $files->count(), $perPage, $currentPage, ['path' => request()->url()]);


        $tags = $this->getListTags();


        $disposisi = $this->getListDisposisi($id_pegawai);

        $cards = [
            "add" => "2",
            "total" => $total_berkas,
            "open" => $open,
            "closed" => $close,
        ];

        return view('dashboard', compact('files', 'disposisi', 'tags', 'cards'))->render();
    }

    public function paginate(Request $request)
    {
        $id_pegawai = 1;

        $files = $this->getDataBerkas($id_pegawai);
        $files = collect($files);

        $disposisi = $this->getListDisposisi($id_pegawai);


        $perPage = 10; // Tentukan berapa item yang ingin Anda tampilkan per halaman
        $currentPage = request()->get('page', 1); // Dapatkan nomor halaman saat ini

        $currentPageItems = $files->slice(($currentPage - 1) * $perPage, $perPage); // Ambil item untuk halaman saat ini
        $files = new LengthAwarePaginator($currentPageItems, $files->count(), $perPage, $currentPage, ['path' => request()->url()]);

        return view('berkas', compact('files', 'disposisi'))->render();
    }

    public function search(Request $request)
    {
        $id_pegawai = 1;

        $files = $this->getDataBerkas($id_pegawai);
        $files = collect($files);



        // Pencarian
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $files = $files->filter(function ($file) use ($keyword) {
                $keywords = explode(' ', $keyword);

                $foundKeywords = 0;

                foreach ($keywords as $k) {
                    if (
                        stripos($file['nama_dokumen'], $k) !== false ||
                        stripos($file['ringkasan_dokumen'], $k) !== false ||
                        stripos($file['tiket_id'], $k) !== false ||
                        stripos($file['nama_pengirim'], $k) !== false
                    ) {
                        $foundKeywords++;
                    }
                }

                return $foundKeywords === count($keywords);
            });
        }

        // Pencarian
        if ($request->has('status')) {
            $status = $request->input('status');
            if ($status == 1 || $status == 0) {
                $files = $files->filter(function ($file) use ($status) {
                    return stripos($file['status'], $status) !== false;
                });
            }
        }



        $disposisi = $this->getListDisposisi($id_pegawai);

        $perPage = 10; // Tentukan berapa item yang ingin Anda tampilkan per halaman
        $currentPage = request()->get('page', 1); // Dapatkan nomor halaman saat ini

        $currentPageItems = $files->slice(($currentPage - 1) * $perPage, $perPage); // Ambil item untuk halaman saat ini
        $files = new LengthAwarePaginator($currentPageItems, $files->count(), $perPage, $currentPage, ['path' => request()->url()]);

        return view('berkas', compact('files', 'disposisi'))->render();
    }



    public function detail(string $id): View
    {
        $id_pegawai = 1;

        $files = $this->getDataBerkas($id_pegawai);

        foreach ($files as $f) {
            if ($f['id_surat'] == $id) {
                $file = $f;
                break;
            }
        }

        $lampiran_path = null;
        $file_name = null;

        if (isset($file)) {

            if (isset(json_decode($file['lampiran'], true)['path'])) {
                $lampiran_path = json_decode($file['lampiran'], true)['path'];
            }
            $file_name = basename($lampiran_path);
        } else {
            $file = "Error file not found";
        }


        $disposisi = $this->getListDisposisi($id_pegawai);


        return view('detail', compact('file', 'file_name', 'lampiran_path', 'disposisi'));
    }


    // for POST idk

    public function upload(Request $request)
    {
        $api_endpoint = env('API_ENDPOINT');

        $id_pegawai = 1;

        $tags = $request->input('p_tag');
        // Ubah string JSON ke dalam bentuk array asosiatif
        $tagsArray = json_decode($tags, true);

        // Ambil hanya nilai 'value'
        $tagsValues = array_column($tagsArray, 'value');
        // Simpan data dari request ke variabel untuk digunakan di JavaScript


        $d = [
            'namaDokumen' => $request->input('namaDokumen'),
            'agendaDokumen' => $request->input('agendaDokumen'),
            'namaPengirim' => $request->input('namaPengirim'),
            'perihalDokumen' => $request->input('perihalDokumen'),
            'ringkasanDokumen' => $request->input('ringkasanDokumen'),
            'tanggalDiterima' => $request->input('tanggalDiterima'),
            'tanggalDokumen' => $request->input('tanggalDokumen'),
            'tanggalAgenda' => $request->input('tanggalAgenda'),
            'tags' => $tagsValues,
            'attachmentDocument' => $request->file('attachmentDocument')->getRealPath(),
            'attachmentDocumentName' => $request->input('attachmentDocument'),
        ];

        $response = Http::attach(
            'p_lampiran',
            file_get_contents($d['attachmentDocument']),
            $d['namaDokumen'] . ".pdf",
        )->post($api_endpoint . 'register_surat.php', [
            'p_nama_dokumen' => $d['namaDokumen'],
            'p_agenda' => $d['agendaDokumen'],
            'p_nama_pengirim' => $d['namaPengirim'],
            'p_perihal' => $d['perihalDokumen'],
            'p_ringkasan_dokumen' => $d['ringkasanDokumen'],
            'p_tanggal_diterima' => $d['tanggalDiterima'],
            'p_tanggal_dokumen' => $d['tanggalDokumen'],
            'p_tanggal_agenda' => $d['tanggalAgenda'],
            'p_tag' => json_encode(['tags' => $d['tags']]),
            'p_id_pegawai' => $id_pegawai,
        ]);



        if ($response->json()['code'] == 200) {
            $text = 'Berhasil!';
            $color = 'success';
        } else {
            $text = 'Gagal!';
            $color = 'danger';
        }

        return view('response', compact('text', 'color'));
    }



    public function disposisi(Request $request)
    {
        $api_endpoint = env('API_ENDPOINT');

        $id_pegawai = 1;

        $client = new Client();

        $response = $client->request('POST', 'http://103.100.27.59/~lacaksurat/add_history_disposisi.php', [
            'headers' => [
                'id_pegawai' => $id_pegawai,
                'Content-Type' => 'application/x-www-form-urlencoded', // Sesuaikan dengan tipe konten yang sesuai
            ],
            'form_params' => [
                'p_tiket_id' => $request->input('p_tiket_id'),
                'p_id_pegawai_penerima' => $request->input('p_id_pegawai_penerima'),
                'p_keterangan' => $request->input('p_keterangan')
            ]
        ]);

        $res = json_decode($response->getBody()->getContents(), true);

        if ($res['code'] == 200) {
            $text = 'Berhasil!';
            $color = 'success';
        } else {
            $text = $res['message'];
            $color = 'danger';
        }

        return view('response', compact('text', 'color'));
    }

    public function ambilSurat(Request $request)
    {
        $api_endpoint = env('API_ENDPOINT');
        $client = new Client();

        $response = $client->request('POST', 'http://103.100.27.59/~lacaksurat/add_history_by_scan.php', [
            'form_params' => [
                'p_tiket_id' => $request->input('token'),
                'p_id_pegawai_penerima' => '1',
                'p_keterangan' => $request->input('keterangan')
            ]
        ]);

        $res = json_decode($response->getBody()->getContents(), true);

        if ($res['code'] == 200) {
            $text = 'Berhasil!';
            $color = 'success';
        } else {
            $text = $res['message'];
            $color = 'danger';
        }

        return view('response', compact('text', 'color'));
    }

    public function close(Request $request)
    {
        $api_endpoint = env('API_ENDPOINT');
        $res = Http::withHeaders([
            'p_tiket_id' => $request->input('tiket_id'),
            'p_my_id_pegawai' => '1',
            'p_keterangan' => $request->input('keterangan')
        ])->post($api_endpoint . 'close_history_surat.php');

        if ($res->json()['code'] == 200) {
            $text = 'Berhasil!';
            $color = 'success';
        } else {
            $text = 'Gagal!';
            $color = 'danger';
        }

        return view('response', compact('text', 'color'));
    }
}
