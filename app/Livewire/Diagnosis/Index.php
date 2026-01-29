<?php

namespace App\Livewire\Diagnosis;

use App\Models\Gejala;
use App\Providers\CertaintyFactorProvider;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Diagnosis')]
#[Layout('layouts.guest')]
class Index extends Component
{
    /**
     * Array untuk menyimpan certainty factor dari setiap gejala.
     * Key = gejala_id, Value = certainty factor (0 - 1)
     */
    public array $certaintyFactorUser = [];

    public $showHasil = false;

    /**
     * Tipe diagnosis yang dipilih: 'penyakit' atau 'hama'
     * Null berarti belum memilih
     */
    public ?string $selectedType = null;

    /**
     * Pilihan tingkat keyakinan user
     */
    public array $certaintyOptions = [
        '' => '-- Pilih Tingkat Keyakinan --',
        '1' => 'Sangat Yakin=1',
        '0.8' => 'Yakin=0.8',
        '0.6' => 'Cukup Yakin=0.6',
        '0.4' => 'Sedikit Yakin=0.4',
        '0' => 'Tidak=0',
    ];

    #[Computed]
    public function gejala()
    {
        if ($this->selectedType) {
            // Filter gejala berdasarkan tipe penyakit yang dipilih
            return Gejala::whereHas('penyakit', function ($query) {
                $query->where('tipe', $this->selectedType);
            })->get();
        }

        return Gejala::all();
    }

    /**
     * Inisialisasi certainty factor untuk semua gejala dengan nilai kosong
     */
    public function mount()
    {
        // Inisialisasi semua gejala dengan nilai null/kosong
        foreach ($this->gejala as $gejala) {
            $this->certaintyFactorUser[$gejala->id] = '';
        }
    }

    /**
     * Validasi dan mulai diagnosis
     */
    public function startDiagnosis()
    {
        // Filter hanya gejala yang dipilih (bukan string kosong)
        $selectedGejala = array_filter($this->certaintyFactorUser, function ($value) {
            return $value !== '' && $value !== null;
        });

        // Validasi: minimal harus ada 1 gejala yang dipilih
        if (empty($selectedGejala)) {
            $this->addError('gejala', 'Pilih minimal satu gejala untuk melakukan diagnosis.');
            return;
        }

        // Convert string ke float
        $certaintyFactors = [];
        foreach ($selectedGejala as $gejalaId => $value) {
            $certaintyFactors[$gejalaId] = (float) $value;
        }

        $diagnosa = CertaintyFactorProvider::diagnosis($certaintyFactors);
        $this->dispatch('showHasil', $diagnosa);
        $this->showHasil = true;
    }

    /**
     * Reset form dan mulai ulang diagnosis
     */
    public function resetDiagnosis()
    {
        $this->showHasil = false;
        $this->resetErrorBag();

        foreach ($this->gejala as $gejala) {
            $this->certaintyFactorUser[$gejala->id] = '';
        }
    }

    /**
     * Pilih tipe diagnosis
     */
    public function selectType(string $type): void
    {
        $this->selectedType = $type;
    }

    /**
     * Kembali ke pilihan tipe
     */
    public function backToTypeSelection(): void
    {
        $this->selectedType = null;
        $this->resetDiagnosis();
    }

    public function render()
    {
        return view('livewire.diagnosis.index');
    }
}
