<div>
    <div>
        <header class="bg-white dark:bg-gray-800 shadow-sm"">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 ">
                    Penyewa
                </h1>
                <button wire:click="create"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    Tambah Penyewa Baru
                </button>
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
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4">
                    <input type="text" wire:model.live="search"
                        placeholder="Cari berdasarkan nama, email, atau no. telepon..."
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div class="bg-white  rounded-lg shadow-md dark:bg-gray-800">
                    <h3 class="text-lg font-semibold text-gray-900  p-6 border-b border-gray-200 dark:text-gray-400">
                        Daftar Penyewa</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Properti
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Unit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        No. Telepon
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tgl Masuk
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($tenants as $tenant)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $tenant->user->name ?? 'N/A' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $tenant->unit->property->name ?? 'N/A' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $tenant->unit->name ?? 'N/A' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $tenant->user->email ?? 'N/A' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $tenant->phone_number ?? 'N/A' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $tenant->move_in_date ? \Carbon\Carbon::parse($tenant->move_in_date)->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button wire:click="edit({{ $tenant->id }})"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200 font-medium">Edit</button>
                                            <button wire:click="confirmDelete({{ $tenant->id }})"
                                                class="ml-4 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200 font-medium">Hapus</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-center">
                                            Tidak ada data penyewa ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if ($showModal)
            <div class="fixed z-10 inset-0 w-screen h-screen flex items-center justify-center  overflow-y-auto"
                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                    wire:click="closeModal">
                </div>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form wire:submit.prevent="{{ $tenant_id ? 'update' : 'store' }}">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    {{ $tenant_id ? 'Edit Penyewa' : 'Tambah Penyewa Baru' }}
                                </h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label for="selectedProperty"
                                            class="block text-sm font-medium text-gray-700">Properti
                                        </label>
                                        <select wire:model.live="selectedProperty"
                                            id="selectedProperty"class="mt-1 w-full rounded-md border-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-black">
                                            <option value="">
                                                Pilih Properti
                                            </option>
                                            @foreach ($propertiList as $id => $name)
                                                <option value="{{ $id }}">
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="selectedUnit" class="block text-sm font-medium text-gray-700 ">Unit
                                            (Kamar) Tersedia
                                        </label>
                                        <div wire:loading wire:target="updatedSelectedProperty"
                                            class="text-sm text-gray-500 dark:text-gray-400">Memuat unit...</div>
                                        <select wire:model.defer="selectedUnit"
                                            id="selectedUnit"class="mt-1 w-full rounded-md border-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-black">
                                            @if (empty($unitList))
                                                disabled
                                            @endif wire:loading.remove>
                                            <option value="">Pilih Unit</option>
                                            @foreach ($unitList as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="fullName" class="block text-sm font-medium text-gray-700">Nama
                                            Lengkap
                                        </label>
                                        <input type="text" wire:model.defer="fullName" id="fullName"
                                            class="mt-1 w-full rounded-md border-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-black">
                                        @error('fullName')
                                            <span>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        </label>
                                        <input type="email" wire:model.defer="email"
                                            class="mt-1 w-full rounded-md border-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-black">
                                        @error('email')
                                            <span>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password"
                                            class="block text-sm font-medium text-gray-700 ">Password</label>
                                        <input type="password" wire:model.defer="password" id="password"
                                            class="mt-1 block w-full rounded-md border-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-black"
                                            placeholder="{{ $tenant_id ? '(Biarkan kosong jika tidak berubah)' : '' }}">
                                        @error('password')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="phoneNumber"
                                            class="block text-sm font-medium text-gray-700 ">Nomor
                                            Telepon</label>
                                        <input type="text" wire:model.defer="phoneNumber" id="phoneNumber"
                                            class="mt-1 block w-full rounded-md border-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-black">
                                        @error('phoneNumber')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="moveInDate"
                                            class="block text-sm font-medium text-gray-700 ">Tanggal
                                            Masuk</label>
                                        <input type="date" wire:model.defer="moveInDate" id="moveInDate"
                                            class="mt-1 w-full rounded-md border-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-black">
                                        @error('moveInDate')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" wire:loading.attr="disabled"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                <span wire:loading.remove wire:target="store, update">Simpan Penyewa</span>
                                <span wire:loading wire:target="store, update">Menyimpan...</span>
                            </button>
                            <button wire:click="closeModal" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300  shadow-sm px-4 py-2 bg-white text-base font-medium text-black  hover:bg-gray-50  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @if ($showDeleteModal)
            <div class="fixed z-20 inset-0 w-screen h-screen flex items-center justify-center  overflow-y-auto"
                aria-labelledby="modal-title-delete" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                    wire:click="closeModal">
                </div>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100  sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.876c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 " id="modal-title-delete">
                                    Hapus Penyewa
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Apakah Anda yakin ingin menghapus penyewa ini? Data yang sudah dihapus tidak
                                        dapat dikembalikan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50  px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="delete" wire:loading.attr="disabled"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            <span wire:loading.remove wire:target="delete">Hapus</span>
                            <span wire:loading wire:target="delete">Menghapus...</span>
                        </button>
                        <button wire:click="closeModal" type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700  hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
