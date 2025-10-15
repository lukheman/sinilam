<!-- diagnosis Section -->

<div class="mt-5 row justify-content-center">

    <div class="col-6">

    <div wire:show="showHasil">

        <livewire:diagnosis.hasil />

    </div>

    <div wire:show="!showHasil">
        <x-card title="Diagnosis">

            <div class="mb-4">

                    @if ($currentGejala)
                <h5 class="card-title"><i class="fas fa-leaf me-2"></i> <span>{{ $currentGejala->nama }}</span></h5>
                <p class="card-text">Seberapa yakin Anda bahwa tanaman Anda mengalami gejala ini?</p>
                @error('currentCeraintyFactor')
                <p class="text-danger">Pilih tingkat keyakinan terlebih dahulu untuk melanjutkan.</p>
                @enderror

                    @endif
            </div>

                @if ($currentGejala)

            <!-- Confidence Level Buttons -->
            <div class="confidence-buttons d-flex flex-wrap justify-content-center">
                <button class="btn btn-outline-primary" wire:click="updateCurrentCertaintyFactor(1)">Sangat Yakin (100 %)</button>
                <button class="btn btn-outline-primary" wire:click="updateCurrentCertaintyFactor(0.8)">Yakin (80 %)</button>
                <button class="btn btn-outline-primary" wire:click="updateCurrentCertaintyFactor(0.7)">Cukup Yakin (70 %)</button>
                <button class="btn btn-outline-primary" wire:click="updateCurrentCertaintyFactor(0.5)">Sedikit Yakin (50 %)</button>
                <button class="btn btn-outline-primary" wire:click="updateCurrentCertaintyFactor(0.3)">Tidak Tahu (30 %)</button>
                <button class="btn btn-outline-primary" wire:click="updateCurrentCertaintyFactor(0)">Tidak (0 %)</button>
            </div>
                @else

                <p class="text-danger">Pilih tingkat keyakinan terlebih dahulu untuk melanjutkan.</p>


                @endif


            <div class="text-end">
            </div>

        </x-card>
    </div>

    </div>



</div>










