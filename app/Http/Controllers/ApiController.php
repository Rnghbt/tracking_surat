<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{

    public function getDataBerkas($id_pegawai)
    {
        $api_endpoint = env('API_ENDPOINT');
        if (!session()->has('berkas')) {
            $response = Http::withHeaders([
                'id_pegawai' => $id_pegawai,
                'Content-Type' => 'multipart/form-data'
            ])->get($api_endpoint . 'list_surat.php');

            $files = $response->json()['data'];;

            session(['berkas' => $files]);
        } else {
            $files = session('berkas');
        }
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

    public function getHistory()
    {
        return $h = '[
            {
                "id": "1",
                "time": "10:30",
                "status": "Di Terima",
                "desc": "Di Terima Oleh Front Office"
            },
            {
                "id": "2",
                "time": "11:45",
                "status": "Proses",
                "desc": "Dalam Proses Verifikasi"
            },
            {
                "id": "3",
                "time": "13:20",
                "status": "Ditolak",
                "desc": "Ditolak Karena Ketidaksesuaian Dokumen"
            },
            {
                "id": "4",
                "time": "14:55",
                "status": "Selesai",
                "desc": "Proses Selesai, Dokumen Dikirim"
            },
            {
                "id": "5",
                "time": "15:40",
                "status": "Proses",
                "desc": "Sedang Dalam Tahap Verifikasi Akhir"
            }
        ]';
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
        if ($request->has('search')) {
            $search = $request->input('search');
            $files = $files->filter(function ($file) use ($search) {
                return stripos($file['nama_dokumen'], $search) !== false ||
                    stripos($file['ringkasan_dokumen'], $search) !== false ||
                    stripos($file['tiket_id'], $search) !== false ||
                    stripos($file['nama_pengirim'], $search) !== false;
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


        $h = $this->getHistory();

        $history = json_decode($h, true);

        $tags = $this->getListTags();


        $disposisi = $this->getListDisposisi($id_pegawai);

        $cards = [
            "add" => "2",
            "total" => $total_berkas,
            "open" => $open,
            "closed" => $close,
        ];

        return view('dashboard', compact('files', 'history', 'disposisi', 'tags', 'cards'));
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
                return stripos($file['nama_dokumen'], $keyword) !== false ||
                    stripos($file['ringkasan_dokumen'], $keyword) !== false ||
                    stripos($file['tiket_id'], $keyword) !== false ||
                    stripos($file['nama_pengirim'], $keyword) !== false;
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

        return json_encode($files);
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




        $data = $response->json();
        // Mengirimkan data ke JavaScript
        return view('welcome', compact('data'));
    }



    public function disposisi(Request $request)
    {
        $api_endpoint = env('API_ENDPOINT');

        $id_pegawai = 1;

        $response = Http::withHeaders([
            'Content-Type' => 'multipart/form-data; boundary=---011000010111000001101001',
        ])
            ->attach('p_tiket_id', $request->input('tiket_id'))
            ->attach('p_id_pegawai_penerima', $request->input('penerima'))
            ->attach('p_keterangan', $request->input('keterangan'))
            ->post($api_endpoint . 'add_history_disposisi.php', [
                'Id_pegawai' => $id_pegawai,
            ]);

        $data = [$request, $response->json(), $response];
        // Mengirimkan data ke JavaScript
        return view('welcome', compact('data'));
    }
}
