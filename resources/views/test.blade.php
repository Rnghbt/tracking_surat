<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/test" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="tiket" id="berkas">
        <input type="text" name="penerima" id="berkas">
        <input type="text" name="keterangan" id="berkas">
        <button type="submit" class="btn btn-primary ms-auto">Submit</button>
    </form>
    <form action="/test" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card mb-4">
            <div class="card-header">
                Informasi Dokumen
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="namaDokumen">Nama Dokumen</label>
                        <input type="text" class="form-control" id="namaDokumen" name="namaDokumen">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="agendaDokumen">Agenda Dokumen</label>
                        <input type="text" class="form-control" id="agendaDokumen" name="agendaDokumen">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="perihalDokumen">Perihal Dokumen</label>
                        <input type="text" class="form-control" id="perihalDokumen" name="perihalDokumen">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="perihalDokumen">Ringkasan Dokumen</label>
                        <input type="text" class="form-control" id="ringkasanDokumen" name="ringkasanDokumen">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Informasi Pengirim
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="namaPengirim">Nama Pengirim</label>
                        <input type="text" class="form-control" id="namaPengirim" name="namaPengirim">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggalDiterima">Tanggal Diterima</label>
                        <input type="date" class="form-control" id="tanggalDiterima" name="tanggalDiterima">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Informasi Tambahan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tanggalDokumen">Tanggal Dokumen</label>
                        <input type="date" class="form-control" id="tanggalDokumen" name="tanggalDokumen">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tanggalAgenda">Tanggal Agenda</label>
                        <input type="date" class="form-control" id="tanggalAgenda" name="tanggalAgenda">
                    </div>
                    <div class="col-md-4">
                        <label for="attachmentDocument">Attachment Document</label>
                        <input type="file" class="form-control" id="attachmentDocument" name="berkas">
                    </div>
                    <div class="col-md-12">
                        <label for="attachmentDocument">Tags</label>
                        <input name='p_tag' placeholder="Masukan tag" class="form-control">

                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <div class="p-1">
                <button type="submit" class="btn btn-primary ms-auto">Submit</button>
            </div>
        </div>

    </form>
</body>

</html>
