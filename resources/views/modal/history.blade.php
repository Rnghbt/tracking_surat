            @foreach ($files as $f)
                <!-- Modal -->
                <div class="modal modal-lg fade" id="historyModal{{ $f['id_surat'] }}" tabindex="-1"
                    aria-labelledby="historyModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="historyModalLabel">Histori {{ $f['nama_dokumen'] }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="events">
                                    @foreach ($history as $h)
                                        <li>
                                            <time datetime="{{ $h['time'] }}">{{ $h['time'] }}</time>
                                            <span><strong>{{ $h['status'] }}</strong> {{ $h['desc'] }}</span>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
