<?php

namespace App\Livewire;

use App\Livewire\Forms\PenyakitForm;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Penyakit;
use Livewire\WithPagination;

use App\Traits\HasNotify;
use App\Traits\WithConfirmation;

#[Title('Penyakit')]
#[Lazy]
class PenyakitPage extends Component
{

    use HasNotify;

    use WithPagination;
    use WithConfirmation;

    public PenyakitForm $form;

    public string $formModalState = 'create';

    public string $activeTab = 'penyakit';

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    #[Computed]
    public function penyakit()
    {
        return Penyakit::query()->where('tipe', 'penyakit')->paginate(10, ['*'], 'penyakitPage');
    }

    #[Computed]
    public function hama()
    {
        return Penyakit::query()->where('tipe', 'hama')->paginate(10, ['*'], 'hamaPage');
    }

    #[Computed]
    public function modalTitle(): string
    {
        if ($this->formModalState === 'create')
            return 'Tambah Data';
        if ($this->formModalState === 'edit')
            return 'Edit Data';
        if ($this->formModalState === 'detail')
            return 'Detail Data';
    }

    public function clear(): void
    {
        $this->form->reset();
        $this->formModalState = 'create';

        // Set tipe otomatis berdasarkan tab yang aktif
        $this->form->tipe = $this->activeTab;

        // Generate kode otomatis
        $this->form->kode = $this->generateKode();
    }

    /**
     * Generate kode penyakit otomatis berdasarkan kode terakhir.
     * Contoh: P01 -> P02, P1 -> P2, P09 -> P10
     */
    protected function generateKode(): string
    {
        // Ambil kode terakhir berdasarkan tipe (hama/penyakit)
        $lastPenyakit = Penyakit::query()
            ->where('tipe', $this->activeTab)
            ->orderByRaw('LENGTH(kode) DESC, kode DESC')
            ->first();

        if (!$lastPenyakit) {
            // Jika belum ada data, mulai dari P01
            return 'P01';
        }

        $lastKode = $lastPenyakit->kode;

        // Pisahkan prefix huruf dan angka
        // Contoh: P01 -> prefix = P, number = 01
        if (preg_match('/^([A-Za-z]+)(\d+)$/', $lastKode, $matches)) {
            $prefix = $matches[1];
            $number = $matches[2];
            $length = strlen($number); // Panjang digit (untuk padding)
            $nextNumber = (int) $number + 1;

            // Format dengan padding yang sama
            return $prefix . str_pad($nextNumber, $length, '0', STR_PAD_LEFT);
        }

        // Fallback jika format tidak sesuai
        return 'P01';
    }

    public function detail($penyakit): void
    {
        $this->formModalState = 'detail';

        $this->form->nama = $penyakit['nama'];
        $this->form->kode = $penyakit['kode'];
        $this->form->tipe = $penyakit['tipe'];
        $this->form->deskripsi = $penyakit['deskripsi'];
        $this->form->solusi = $penyakit['solusi'];
    }

    public function save()
    {
        $this->form->store();
        $this->dispatch('close-modal', target: 'modal-form-penyakit');
        $this->notifySuccess('Berhasil menambahkan penyakit baru');
    }

    public function edit($penyakit)
    {
        $this->formModalState = 'edit';

        $this->form->nama = $penyakit['nama'];
        $this->form->kode = $penyakit['kode'];
        $this->form->tipe = $penyakit['tipe'];
        $this->form->deskripsi = $penyakit['deskripsi'];
        $this->form->solusi = $penyakit['solusi'];

        $this->form->penyakit = Penyakit::find($penyakit['id']);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('close-modal', target: 'modal-form-penyakit');
        $this->notifySuccess('Berhasil memperbarui penyakit');
    }

    public function delete($id)
    {
        $this->form->penyakit = Penyakit::find($id);
        $this->deleteConfirmation('Yakin untuk menghapus data penyakit ini ?');
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed()
    {
        $this->notifySuccess("Berhasil menghapus penyakit: {$this->form->penyakit->kode} - {$this->form->penyakit->nama}");
        $this->form->delete();
    }


    public function render()
    {
        return view('livewire.penyakit-page');
    }
}
