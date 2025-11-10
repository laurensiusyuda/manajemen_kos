    <div>
        <div>
            <header class="bg-white dark:bg-gray-800 shadow-sm"">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 ">
                        Dashboard Saya
                    </h1>

                </div>
            </header>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white  p-6 rounded-lg shadow-md dark:bg-gray-800">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Kamar Tersedia</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ count($jumlahKamarTersedia) }} /
                                {{ count($jumlahKamarTotal) }}</p>
                        </div>
                        <div class="bg-white  p-6 rounded-lg shadow-md dark:bg-gray-800">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Kamar Tersewa</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ count($jumlahKamarTersewa) }} /
                                {{ count($jumlahKamarTotal) }}</p>
                        </div>
                        <div class="bg-white  p-6 rounded-lg shadow-md dark:bg-gray-800">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Properti</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ count($jumlahProperti) }}
                            </p>
                        </div>
                        <div class="bg-white  p-6 rounded-lg shadow-md dark:bg-gray-800">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Penyewa</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ count($jumlahPenyewa) }}
                            </p>
                        </div>
                        {{-- <div class="bg-white dark:bg-gray-800  p-6 rounded-lg shadow-md">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendapatan Bulan Ini</h3>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">Rp 12.500.000</p>
                    </div> --}}
                        {{-- <div class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tagihan Lunas</h3>
                        <p class="mt-2 text-3xl font-bold text-green-600">7</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Menunggu Konfirmasi</h3>
                        <p class="mt-2 text-3xl font-bold text-yellow-600">1</p>
                    </div> --}}
                    </div>
                    <div class="mt-8 bg-white  rounded-lg shadow-md dark:bg-gray-800">
                        <h3
                            class="text-lg font-semibold text-gray-900  p-6 border-b border-gray-200 dark:text-gray-400">
                            List Kamar Tersedia
                        </h3>
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($kamarTersediabyUnit as $kamar)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $kamar->properti_name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $kamar->properti_address }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $kamar->unit_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100"
                                            x-data="{ price: {{ $kamar->unit_price }} }">
                                            <span
                                                x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price)"></span>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $kamar->unit_status }}
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-8 bg-white  rounded-lg shadow-md dark:bg-gray-800">
                        <h3
                            class="text-lg font-semibold text-gray-900  p-6 border-b border-gray-200 dark:text-gray-400">
                            List Kamar Tersewa
                        </h3>
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($kamarTersewabyUnit as $kamar)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $kamar->properti_name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $kamar->properti_address }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $kamar->unit_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100"
                                            x-data="{ price: {{ $kamar->unit_price }} }">
                                            <span
                                                x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price)"></span>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $kamar->unit_status }}
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
