<!-- Modal -->
<form action="/disposisi" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="disposisiModal{{ $file['tiket_id'] }}" tabindex="-1"
        aria-labelledby="disposisiModal{{ $file['tiket_id'] }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="disposisiModal{{ $file['tiket_id'] }}Label">Disposisi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="p_tiket_id" value="{{ $file['tiket_id'] }}">
                    <select class="form-select mb-2" aria-label="Default select example" name="p_id_pegawai_penerima">
                        <option selected>Pilih Disposisi</option>
                        @foreach ($disposisi as $d)
                            <option value="{{ $d['id_pegawai'] }}">{{ $d['nama'] }}</option>
                        @endforeach
                    </select>
                    <div class="form-floating mb-3">
                        <textarea name="p_keterangan" class="form-control" placeholder="Leave a comment here"
                            id="floatingTextarea{{ $file['id_surat'] }}" name="keterangan" style="height: 130px"></textarea>
                        <label for="floatingTextarea{{ $file['id_surat'] }}">Comments</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </div>
    </div>
</form>
