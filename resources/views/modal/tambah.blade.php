<!-- Modal -->
{{-- <form action="/tambah-berkas" method="post" enctype="multipart/form-data">
    @csrf --}}
<div class="modal modal-lg fade " id="TambahModal" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="TambahModalLabel">Tambah Berkas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-header">
                        Informasi Dokumen
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="namaDokumen">Nama Dokumen</label>
                                <input required type="text" class="form-control" id="namaDokumen" name="namaDokumen">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="agendaDokumen">Agenda Dokumen</label>
                                <input required type="text" class="form-control" id="agendaDokumen"
                                    name="agendaDokumen">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="perihalDokumen">Perihal Dokumen</label>
                                <input required type="text" class="form-control" id="perihalDokumen"
                                    name="perihalDokumen">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="perihalDokumen">Ringkasan Dokumen</label>
                                <input required type="text" class="form-control" id="ringkasanDokumen"
                                    name="ringkasanDokumen">
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
                                <input required type="text" class="form-control" id="namaPengirim"
                                    name="namaPengirim">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggalDiterima">Tanggal Diterima</label>
                                <input required type="date" class="form-control" id="tanggalDiterima"
                                    name="tanggalDiterima">
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
                                <input required type="date" class="form-control" id="tanggalDokumen"
                                    name="tanggalDokumen">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tanggalAgenda">Tanggal Agenda</label>
                                <input required type="date" class="form-control" id="tanggalAgenda"
                                    name="tanggalAgenda">
                            </div>
                            <div class="col-md-4">
                                <label for="attachmentDocument">Attachment Document</label>
                                <input required type="file" class="form-control" id="attachmentDocument"
                                    name="attachmentDocument">
                            </div>
                            <div class="col-md-12">
                                <label for="attachmentDocument">Tags</label>
                                <input required name='p_tag' placeholder="Masukan tag" class="form-control">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="store" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- </form> --}}
<script>
    // The DOM element you wish to replace with Tagify
    var input = document.querySelector('input[name=p_tag]');

    // initialize Tagify on the above input node reference
    new Tagify(input)

    $('#store').click(function(e) {
        e.preventDefault();


        //define variable
        let namaDokumen = $('#namaDokumen').val();
        let agendaDokumen = $('#agendaDokumen').val();
        let perihalDokumen = $('#perihalDokumen').val();
        let ringkasanDokumen = $('#ringkasanDokumen').val();
        let namaPengirim = $('#namaPengirim').val();
        let tanggalDiterima = $('#tanggalDiterima').val();
        let tanggalDokumen = $('#tanggalDokumen').val();
        let tanggalAgenda = $('#tanggalAgenda').val();
        let attachmentDocument = $('#attachmentDocument').val();
        let p_tag = $('#p_tag').val();
        let token = $("meta[name='csrf-token']").attr("content");

        //ajax
        $.ajax({

            url: `/tambah-berkas`,
            type: "POST",
            cache: false,
            data: {
                "namaDokumen": namaDokumen,
                "agendaDokumen": agendaDokumen,
                "perihalDokumen": perihalDokumen,
                "ringkasanDokumen": ringkasanDokumen,
                "namaPengirim": namaPengirim,
                "tanggalDiterima": tanggalDiterima,
                "tanggalDokumen": tanggalDokumen,
                "tanggalAgenda": tanggalAgenda,
                "attachmentDocument": attachmentDocument,
                "p_tag": p_tag,
                "_token": token
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //close modal
                $('#TambahModal').modal('hide');


            },
            error: function(error) {

                if (error.responseJSON.title[0]) {

                    //show alert
                    $('#alert-title').removeClass('d-none');
                    $('#alert-title').addClass('d-block');

                    //add message to alert
                    $('#alert-title').html(error.responseJSON.title[0]);
                }

                if (error.responseJSON.content[0]) {

                    //show alert
                    $('#alert-content').removeClass('d-none');
                    $('#alert-content').addClass('d-block');

                    //add message to alert
                    $('#alert-content').html(error.responseJSON.content[0]);
                }

            }

        });

    });
</script>
