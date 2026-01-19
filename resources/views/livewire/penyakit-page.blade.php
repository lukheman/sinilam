<div>

    <x-card>

        <x-modal title="{{ $this->modalTitle }}" id="modal-form-penyakit" size="xl">

            <x-input label="Kode" model="form.kode" :description="$errors->has('form.kode') ? $errors->first('form.kode') : null" />

            <x-select label="Tipe" model="form.tipe" placeholder="Pilih Tipe">
                <option value="hama">Hama</option>
                <option value="penyakit">Penyakit</option>
            </x-select>

            <x-input label="Nama" model="form.nama" :description="$errors->has('form.nama') ? $errors->first('form.nama') : null" />

            <x-textarea label="Deskripsi" model="form.deskripsi" />
            <x-textarea label="Solusi" model="form.solusi" />

            @if ($formModalState !== 'detail')
                <x-button variant="{{ $formModalState === 'edit' ? 'warning' : 'primary' }}" class="mt-2"
                    wire:click="{{ $formModalState === 'edit' ? 'update' : 'save' }}">Simpan</x-button>
            @endif
        </x-modal>

        <x-slot:heading>
            <x-modal.trigger target="modal-form-penyakit" class="float-end" wire:click="clear">Tambah
                Data</x-modal.trigger>
        </x-slot:heading>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'penyakit' ? 'active' : '' }}" wire:click="setTab('penyakit')"
                    type="button">
                    <i class="fas fa-virus me-2"></i>Penyakit
                    <span class="badge bg-success ms-2">{{ $this->penyakit->total() }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'hama' ? 'active' : '' }}" wire:click="setTab('hama')"
                    type="button">
                    <i class="fas fa-bug me-2"></i>Hama
                    <span class="badge bg-danger ms-2">{{ $this->hama->total() }}</span>
                </button>
            </li>
        </ul>

        <!-- Tab Content: Penyakit -->
        @if ($activeTab === 'penyakit')
            <x-table :paginate="$this->penyakit">
                <x-slot:columns>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th class="text-end">Aksi</th>
                </x-slot:columns>

                <x-slot:rows>
                    @forelse ($this->penyakit as $item)
                        <tr>
                            <td>{{ $loop->index + $this->penyakit->firstItem() }}</td>
                            <td><span class="badge bg-secondary">{{ $item->kode }}</span></td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-end">
                                <x-modal.trigger target="modal-form-penyakit" variant="info" icon="eye"
                                    wire:click="detail({{ $item }})"></x-modal.trigger>
                                <x-modal.trigger target="modal-form-penyakit" variant="primary" icon="pencil"
                                    wire:click="edit({{ $item }})"></x-modal.trigger>
                                <x-button variant="danger" icon="trash" wire:click="delete({{ $item->id }})"></x-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data penyakit</td>
                        </tr>
                    @endforelse
                </x-slot:rows>
            </x-table>
        @endif

        <!-- Tab Content: Hama -->
        @if ($activeTab === 'hama')
            <x-table :paginate="$this->hama">
                <x-slot:columns>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th class="text-end">Aksi</th>
                </x-slot:columns>

                <x-slot:rows>
                    @forelse ($this->hama as $item)
                        <tr>
                            <td>{{ $loop->index + $this->hama->firstItem() }}</td>
                            <td><span class="badge bg-secondary">{{ $item->kode }}</span></td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-end">
                                <x-modal.trigger target="modal-form-penyakit" variant="info" icon="eye"
                                    wire:click="detail({{ $item }})"></x-modal.trigger>
                                <x-modal.trigger target="modal-form-penyakit" variant="primary" icon="pencil"
                                    wire:click="edit({{ $item }})"></x-modal.trigger>
                                <x-button variant="danger" icon="trash" wire:click="delete({{ $item->id }})"></x-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data hama</td>
                        </tr>
                    @endforelse
                </x-slot:rows>
            </x-table>
        @endif

    </x-card>

</div>