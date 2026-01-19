<?php

namespace App\Livewire;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Traits\HasNotify;
use App\Traits\WithConfirmation;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;

#[Title('Basis Pengetahuan')]
#[Lazy]
class BasisPengetahuanPage extends Component
{

    use WithPagination;
    use HasNotify;
    use WithConfirmation;

    public ?Penyakit $selectedPenyakit;
    public $namaPenyakit = '';
    public $kodePenyakit = '';

    public $modalState = 'detail';

    public ?int $selectedIdGejala = null;
    public $mb = 0;
    public $md = 0;

    /**
     * Hook yang dipanggil ketika nilai MB berubah.
     * Otomatis menghitung MD = 1 - MB.
     */
    public function updatedMb($value): void
    {
        // Cast ke float, jika kosong atau invalid jadi 0
        $mbValue = is_numeric($value) ? (float) $value : 0;

        // Memastikan mb dalam range 0-1
        $this->mb = max(0, min(1, $mbValue));

        // Otomatis hitung md agar mb + md = 1
        $this->md = round(1 - $this->mb, 5);
    }

    public function saveGejalaPenyakit()
    {
        // Validasi: pastikan gejala sudah dipilih
        if ($this->selectedIdGejala === null) {
            $this->notifyError('Silakan pilih gejala terlebih dahulu');
            return;
        }

        // selain menambahakan gejala gejala, juga memperbarui gejaa yang sudah ada
        $this->selectedPenyakit->gejala()->syncWithoutDetaching([
            $this->selectedIdGejala => [
                'mb' => $this->mb,
                'md' => $this->md,
            ]
        ]);

        $this->notifySuccess('Berhasil memperbarui gejala ke penyakit');

        // Reset form setelah berhasil
        $this->reset(['selectedIdGejala', 'mb', 'md']);
    }

    public function editGejalaPenyakit($id)
    {
        $this->selectedIdGejala = $id;
        $gejala = $this->selectedPenyakit->gejala()->find($id);
        $this->mb = $gejala->pivot->mb;
        $this->md = $gejala->pivot->md;


    }


    public function deleteGejalaPenyakit($id)
    {

        $this->selectedIdGejala = $id;
        $this->deleteConfirmation('Apakah Anda yakin ingin menghapus gejala ini dari penyakit?');
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed()
    {
        $this->selectedPenyakit->gejala()->detach($this->selectedIdGejala);
        $this->notifySuccess('Berhasil menghapus gejala dari penyakit');
    }

    public function detail($id)
    {
        $this->selectedPenyakit = Penyakit::with('gejala')->find($id);
        $this->namaPenyakit = $this->selectedPenyakit->nama;
        $this->kodePenyakit = $this->selectedPenyakit->kode;
    }

    #[Computed]
    public function penyakit()
    {
        return Penyakit::paginate(10);
    }

    #[Computed]
    public function gejala()
    {
        return Gejala::all();
    }

    #[Computed]
    public function modalTitle()
    {
        return "Gejala Penyakit $this->kodePenyakit -  $this->namaPenyakit";
    }


    public function render()
    {
        return view('livewire.basis-pengetahuan-page');
    }
}
