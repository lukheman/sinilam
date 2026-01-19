<!-- Diagnosis Section -->

<div class="mt-5 row justify-content-center">

    <div class="col-lg-8 col-md-10 col-12">

        <div wire:show="showHasil">
            <livewire:diagnosis.hasil />
        </div>

        {{-- Tampilan Pilihan Tipe Diagnosis --}}
        @if (!$selectedType && !$showHasil)
            <div class="text-center mb-4">
                <h2 class="section-title">Pilih Jenis Diagnosis</h2>
                <p class="text-muted">Silakan pilih jenis masalah yang ingin Anda diagnosis pada tanaman kelapa sawit.</p>
            </div>

            <div class="row g-4 justify-content-center">
                {{-- Card Penyakit --}}
                <div class="col-md-6">
                    <div class="card h-100 text-center" style="cursor: pointer; transition: all 0.3s ease;"
                        wire:click="selectType('penyakit')"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.15)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.05)';">
                        <div class="card-body py-5">
                            <div class="mb-4">
                                <i class="fas fa-virus text-danger" style="font-size: 4rem;"></i>
                            </div>
                            <h3 class="card-title mb-3">Penyakit</h3>
                            <p class="card-text text-muted">
                                Diagnosis penyakit pada tanaman kelapa sawit seperti Ganoderma, Tajuk, dan lainnya.
                            </p>
                            <button class="btn btn-outline-danger mt-3">
                                <i class="fas fa-arrow-right me-2"></i>Pilih Penyakit
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Card Hama --}}
                <div class="col-md-6">
                    <div class="card h-100 text-center" style="cursor: pointer; transition: all 0.3s ease;"
                        wire:click="selectType('hama')"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.15)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.05)';">
                        <div class="card-body py-5">
                            <div class="mb-4">
                                <i class="fas fa-bug text-warning" style="font-size: 4rem;"></i>
                            </div>
                            <h3 class="card-title mb-3">Hama</h3>
                            <p class="card-text text-muted">
                                Diagnosis hama pada tanaman kelapa sawit seperti ulat, kumbang, dan serangga lainnya.
                            </p>
                            <button class="btn btn-outline-warning mt-3">
                                <i class="fas fa-arrow-right me-2"></i>Pilih Hama
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form Diagnosis (tampil setelah pilih tipe) --}}
        @if ($selectedType && !$showHasil)
            <x-card title="Diagnosis {{ $selectedType === 'penyakit' ? 'Penyakit' : 'Hama' }} Tanaman">

                <p class="text-muted mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    Pilih tingkat keyakinan Anda untuk setiap gejala yang dialami tanaman.
                    Anda tidak perlu mengisi semua gejala, cukup yang relevan saja.
                </p>

                @error('gejala')
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                    </div>
                @enderror

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">Kode</th>
                                <th style="width: 40%">Gejala</th>
                                <th style="width: 45%">Tingkat Keyakinan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->gejala as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="badge bg-secondary">{{ $item->kode }}</span></td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <select class="form-select form-select-sm"
                                            wire:model="certaintyFactorUser.{{ $item->id }}">
                                            @foreach ($certaintyOptions as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-outline-secondary" wire:click="backToTypeSelection">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </button>
                    <div>
                        <button class="btn btn-outline-secondary me-2" wire:click="resetDiagnosis">
                            <i class="fas fa-redo me-2"></i>Reset
                        </button>
                        <button class="btn btn-primary" wire:click="startDiagnosis">
                            <i class="fas fa-stethoscope me-2"></i>Mulai Diagnosis
                        </button>
                    </div>
                </div>

            </x-card>
        @endif

    </div>

</div>