<div class="row justify-content-center mt-3">
    <div class="col-12 col-lg-10">
        @if (session()->has('message'))
            <div class="alert alert-{{ session('color') }} alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header text-bg-success">
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-light">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <span class="fw-bold">
                    Cetak Laporan {{ $data['nama'] }}
                </span>
            </div>
            <div class="card-body">
                <form action="{{ route('laporan.cetak') }}" method="post" class="text-center">
                    @csrf
                    <input type="hidden" name="type" value="{{ $data['tipe'] }}">
                    @if ($data['tipe'] == 'keluar' || $data['tipe'] == 'masuk')
                        <label for="jenis" class="fw-bold">Jenis Laporan</label>
                        <select name="jenis" id="jenis" class="form-select form-select-sm mb-3 text-center"
                            wire:model='jenislaporan'>
                            <option value="harian">Harian</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                            <option value="tanggal">Antara Tanggal</option>
                        </select>
                        @if ($jenislaporan == 'harian')
                            <label for="tanggal" class="fw-bold">Tanggal Laporan</label>
                            <input type="date" value="{{ date('Y-m-d') }}" name="tanggal" id="tanggal"
                                class="form-control form-control-sm text-center">
                        @elseif ($jenislaporan == 'bulanan')
                            <label for="bulan" class="fw-bold">Bulan Laporan</label>
                            <input type="month" value="{{ date('Y-m') }}" name="bulan" id="bulan"
                                class="form-control form-control-sm text-center">
                        @elseif ($jenislaporan == 'tahunan')
                            <label for="tahun" class="fw-bold">Tahun Laporan</label>
                            <select class="form-select form-select-sm text-center" name="tahun" id="tahun">
                                @for ($i = 0; $i < 5; $i++)
                                    <option value="{{ date('Y') - $i }}">{{ date('Y') - $i }}</option>
                                @endfor
                            </select>
                        @elseif ($jenislaporan == 'tanggal')
                            <div class="row">
                                <div class="col-12 col-lg">
                                    <label for="dari" class="fw-bold">Dari</label>
                                    <input type="date" class="form-control form-control-sm text-center"
                                        name="dari" id="dari" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-12 col-lg">
                                    <label for="sampai" class="fw-bold">Sampai</label>
                                    <input type="date" class="form-control form-control-sm text-center"
                                        name="sampai" id="sampai" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                </div>
                            </div>
                        @endif
                    @endif
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-sm btn-outline-success fw-bold">
                            Cetak Laporan {{ $data['nama'] }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('livewire-style')
    @livewireStyles
@endpush

@push('livewire-script')
    @livewireScripts
@endpush
