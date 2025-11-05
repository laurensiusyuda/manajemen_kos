<div>
    <div>
        <header class="bg-white dark:bg-gray-800 shadow-sm">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div>
                        <nav class="text-sm font-medium text-gray-500" aria-label="Breadcrumb">
                            <ol class="list-none p-0 inline-flex">
                                <li class="flex items-center">
                                    <a href="{{ route('admin.properti') }}" wire:navigate
                                        class="text-blue-600 hover:text-blue-800 hover:underline">
                                        Properti Saya
                                    </a>
                                </li>
                                <li class="flex items-center mx-2">
                                    <span class="text-gray-400">/</span>
                                </li>
                                <li class="text-gray-700 dark:text-gray-300">
                                    Kelola Unit
                                </li>
                            </ol>
                        </nav>
                        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mt-1">
                            {{ $properti->name }}
                        </h1>
                        <p class="text-sm text-gray-600 mt-2">{{ $properti->address }}</p>
                    </div>
                    <button wire:click="create"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Unit Baru
                    </button>
                </div>
            </div>
        </header>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session()->has('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse ($units as $unit)
                        @php
                            $isAvailable = $unit->status == \App\UnitStatus::AVAILABLE;
                            $isOccupied = $unit->status == \App\UnitStatus::OCCUPIED;
                        @endphp
                        <div
                            class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg transform transition-all hover:scale-[1.02]">
                            <div @class([
                                'p-4 text-sm font-bold uppercase',
                                'bg-green-100 text-green-800' => $isAvailable,
                                'bg-yellow-100 text-yellow-800' => $isOccupied,
                            ])>
                                {{ Str::title($unit->status->value) }}
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold dark:text-white text-gray-900 mb-2">
                                    {{ $unit->name }}
                                </h3>
                                <p class="text-blue-600 dark:text-blue-400 font-semibold text-lg mb-4">
                                    Rp {{ number_format($unit->price, 0, ',', '.') }} / bulan
                                </p>
                                <div class="border-t pt-4 flex space-x-3">
                                    <button wire:click="edit({{ $unit->id }})"
                                        class="text-sm text-gray-500 hover:text-gray-700">Edit</button>
                                    <button wire:click="confirmDelete({{ $unit->id }})"
                                        class="text-sm text-red-500 hover:text-red-700
                                      @if ($unit->status == \App\UnitStatus::OCCUPIED) opacity-50 cursor-not-allowed @endif"
                                        @if ($unit->status == \App\UnitStatus::OCCUPIED) disabled @endif>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="md:col-span-2 lg:col-span-4">
                            <div
                                class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
                                <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">Belum Ada Unit
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Anda belum menambahkan unit/kamar untuk properti
                                    ini.
                                </p>
                                <div class="mt-6">
                                    <button wire:click="create"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 ...">
                                        Tambah Unit Pertama Anda
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        @if ($showModal)
            <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <form wire:submit.prevent="{{ $unit_id ? 'update' : 'store' }}">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        {{ $unit_id ? 'Edit Unit' : 'Tambah Unit Baru' }}
                                    </h3>
                                    <div class="mt-4 space-y-4">
                                        <div>
                                            <label for="unitName" class="block text-sm font-medium text-gray-700">Nama
                                                Unit
                                                (cth: Kamar 101)</label>
                                            <input type="text" wire:model.defer="unitName" id="unitName"
                                                class="mt-1 text-black block w-full border-gray-800 rounded-md shadow-sm ...">
                                            @error('unitName')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="unitPrice" class="block text-sm font-medium text-gray-700">Harga
                                                Sewa (per bulan)</label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                                </div>
                                                <input type="number" wire:model.defer="unitPrice" id="unitPrice"
                                                    class="mt-1 text-black block w-full pl-7 pr-12 border-gray-800 rounded-md shadow-sm ...">
                                            </div>
                                            @error('unitPrice')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="unitStatus"
                                                class="block text-sm font-medium text-gray-700">Status</label>
                                            <select wire:model.defer="unitStatus" id="unitStatus"
                                                class="mt-1 text-black block w-full border-gray-800 rounded-md shadow-sm ...">
                                                <option value="{{ \App\UnitStatus::AVAILABLE->value }}">Tersedia
                                                </option>
                                                <option value="{{ \App\UnitStatus::OCCUPIED->value }}">Ditempati
                                                </option>
                                            </select>
                                            @error('unitStatus')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- @if (!$unit_id || ($unit_id && $unitStatus == \App\UnitStatus::AVAILABLE))
                                            <div>
                                                <label for="unitStatus"
                                                    class="block text-sm font-medium text-gray-700">Status</label>
                                                <select wire:model.defer="unitStatus" id="unitStatus"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm ...">
                                                    <option value="{{ \App\UnitStatus::AVAILABLE->value }}">Tersedia
                                                    </option>
                                                    <option value="{{ \App\UnitStatus::OCCUPIED->value }}">Ditempati
                                                    </option>
                                                </select>
                                                @error('unitStatus')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @else
                                            <div class="p-3 bg-yellow-100 text-yellow-800 rounded-md">
                                                <p class="text-sm font-medium">Status "Ditempati" tidak bisa diubah dari
                                                    sini. Anda harus meng-edit data Penyewa.</p>
                                            </div>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" wire:loading.attr="disabled"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 ... sm:ml-3 sm:w-auto sm:text-sm">
                                    <span wire:loading.remove wire:target="store, update">Simpan</span>
                                    <span wire:loading wire:target="store, update">Menyimpan...</span>
                                </button>
                                <button wire:click="closeModal" type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 ... sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if ($showDeleteModal)
            <div class="fixed z-20 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Unit</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Apakah Anda yakin ingin menghapus unit ini? Tindakan ini tidak dapat
                                            dibatalkan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click="delete" wire:loading.attr="disabled" type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                <span wire:loading.remove wire:target="delete">Hapus</span>
                                <span wire:loading wire:target="delete">Menghapus...</span>
                            </button>
                            <button wire:click="closeModal" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
