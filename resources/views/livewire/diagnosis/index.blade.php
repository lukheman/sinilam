<!-- Diagnosis Section -->

<div class="mt-5 row justify-content-center">

    <div class="col-lg-8 col-md-10 col-12">

        <div wire:show="showHasil">
            <livewire:diagnosis.hasil />
        </div>

        <div wire:show="!showHasil">
            <x-card title="Diagnosis Penyakit Tanaman">

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
                    <button class="btn btn-outline-secondary" wire:click="resetDiagnosis">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                    <button class="btn btn-primary" wire:click="startDiagnosis">
                        <i class="fas fa-stethoscope me-2"></i>Mulai Diagnosis
                    </button>
                </div>

            </x-card>
        </div>

    </div>

</div>