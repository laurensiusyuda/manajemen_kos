<x-guest-layout>
    <header class="sticky top-0 z-10 ">
        <div class=" bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-2xl flex flex-wrap justify-between mx-auto p-4">
                <h1 class="text-3xl font-bold text-white">Kosku</h1>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul
                        class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                        <li>
                            <a href ="{{ route('homepage') }}"
                                class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
                                aria-current="page">Homepage</a>
                        </li>
                        <li>
                            <a href="#features"
                                class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Fitur</a>
                        </li>
                        <li>
                            <a href="#booking"
                                class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Cara
                                Booking</a>
                        </li>
                        <li>
                            <a href="#listings"
                                class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Kos
                                Populer</a>
                        </li>
                        <li>
                            <a href="#testimoni"
                                class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Testimoni</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </header>

    <main>
        <section class="relative h-screen bg-cover bg-center bg-fixed dark:bg-sky-950" id="homepage"
            style="background-image: url('https://images.unsplash.com/photo-1495365200479-c4ed1d35e1aa?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=3540');"
            aria-label="Beranda pencarian kos">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-black/40"></div>
            <div x-data="{ revealed: false }" x-intersect:enter="revealed = true"
                :class="{
                    'opacity-0 translate-y-4': !revealed,
                    'opacity-100 translate-y-0': revealed
                }"
                class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6 transition-all duration-700 ease-out">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4 drop-shadow-lg">
                    Temukan Kos Impianmu
                </h1>
                <p class="text-base md:text-xl mb-10 max-w-2xl text-gray-200">
                    Cari & sewa kamar kos idaman dengan mudah, cepat, dan aman di seluruh Indonesia.
                </p>
                <form
                    class="bg-white rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 p-2 flex items-center w-full max-w-2xl">
                    <div class="px-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM10 14a4 4 0 100-8 4 4 0 000 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Masukkan nama kota, jalan, atau kampus..."
                        class="w-full bg-transparent border-none focus:ring-0 text-gray-700 px-2 py-2 placeholder-gray-400">
                    <button type="submit"
                        class="bg-blue-600 text-white font-semibold rounded-full px-6 py-2 hover:bg-blue-700 active:bg-blue-800 transition duration-300">
                        Cari
                    </button>
                </form>
            </div>
        </section>


        <section x-data="{ revealed: false }" x-intersect:enter="revealed = true" x-intersect:leave="revealed = false"
            :class="{
                'opacity-0 translate-y-4': !revealed,
                'opacity-100 translate-y-0': revealed
            }"
            class="transition-all duration-700 ease-out" id="features">
            <div x-data="carousel()" x-init="init()" class="relative overflow-hidden">
                <div x-ref="carousel" class="flex transition ease-out duration-700">

                    <div class="min-w-full min-h-[50vh] flex items-center justify-center p-4"
                        style="background: url('https://images.unsplash.com/photo-1614678223955-5ff3a3a0283a?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1287') no-repeat center center / cover">
                        <div
                            class="p-8 rounded-lg shadow-md text-center backdrop-blur-[10px] max-w-2xl dark:text-white text-white">
                            <h3 class="mt-5 text-2xl font-bold">
                                Pencarian Cepat & Akurat
                            </h3>
                            <p class="mt-5 text-lg font-medium">
                                Temukan kos berdasarkan lokasi, harga, dan fasilitas dengan filter canggih kami.
                            </p>
                        </div>
                    </div>

                    <div class="min-w-full min-h-[60vh] flex items-center justify-center p-4"
                        style="background: url('https://images.unsplash.com/photo-1745091722150-dc7aaf6eeb21?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=3387') no-repeat center center / cover">
                        <div
                            class="p-8 rounded-lg shadow-md text-center backdrop-blur-[10px] max-w-2xl dark:text-white text-white">
                            <h3 class="mt-5 text-2xl font-bold">Listing
                                Terverifikasi
                            </h3>
                            <p class="mt-5 text-lg font-medium">
                                Semua properti telah kami verifikasi untuk memastikan kenyamanan dan keamanan
                                Anda.
                            </p>
                        </div>
                    </div>

                    <div class="min-w-full min-h-[60vh] flex items-center justify-center p-4"
                        style="background: url('https://images.unsplash.com/photo-1758522484692-efa6ce38a25f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=3432') no-repeat center center / cover">
                        <div
                            class="p-8 rounded-lg shadow-md text-center backdrop-blur-[10px] max-w-2xl dark:text-white text-white">
                            <h3 class="mt-5 text-2xl font-bold">Booking Online
                                Aman
                            </h3>
                            <p class="mt-5 text-lg font-medium">
                                Pesan dan bayar kamar kos langsung dari aplikasi dengan sistem pembayaran yang
                                aman.
                            </p>
                        </div>
                    </div>
                </div>
                <button @click="prev()"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-gray-800/50 text-white p-2 rounded-full hover:bg-gray-800/80 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <path fill="currentColor" d="m5.83 9l5.58-5.58L10 2l-8 8l8 8l1.41-1.41L5.83 11H18V9z" />
                    </svg>
                </button>

                <button @click="next()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-gray-800/50 text-white p-2 rounded-full hover:bg-gray-800/80 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <path fill="currentColor" d="M2 11h12.2l-5.6 5.6L10 18l8-8l-8-8l-1.4 1.4L14.2 9H2z" />
                    </svg>
                </button>
            </div>
        </section>


        <section x-data="{ revealed: false }" x-intersect:enter="revealed = true" x-intersect:leave="revealed = false"
            :class="{
                'opacity-0 translate-y-4': !revealed,
                'opacity-100 translate-y-0': revealed
            }"
            class="transition-all duration-700 ease-out py-16 bg-white dark:bg-gray-900" id="booking">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Cara Kerja Kosku</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Cari, pilih, dan sewa dalam 3 langkah mudah.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-y-12 md:gap-x-8 items-start">
                    <div class="text-center relative md:col-span-1">
                        <div class="md:hidden absolute top-full left-1/2 -translate-x-1/2 mt-8">
                            <svg class="w-6 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 60"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    stroke-dasharray="5 5" d="M12 0 L12 50 M8 40 L12 50 L16 40"></path>
                            </svg>
                        </div>
                        <div class="text-blue-600 mb-4 text-5xl">🔍</div>
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-white">1. Temukan Kos</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Gunakan pencarian untuk menemukan
                            kos
                            sesuai lokasi & budget.</p>
                    </div>
                    <div class="hidden md:flex justify-center items-center mt-12 md:col-span-1">
                        <svg class="w-full h-8 text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 100 30" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke-dasharray="5 5" d="M0 15 L100 15 M85 5 L100 15 L85 25"></path>
                        </svg>
                    </div>
                    <div class="text-center relative md:col-span-1">
                        <div class="md:hidden absolute top-full left-1/2 -translate-x-1/2 mt-8">
                            <svg class="w-6 h-12 text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 60" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    stroke-dasharray="5 5" d="M12 0 L12 50 M8 40 L12 50 L16 40"></path>
                            </svg>
                        </div>
                        <div class="text-blue-600 mb-4 text-5xl">🏘️</div>
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-white">2. Lihat Detail</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Lihat foto, fasilitas, dan ulasan
                            penyewa sebelumnya.</p>
                    </div>
                    <div class="hidden md:flex justify-center items-center mt-12 md:col-span-1">
                        <svg class="w-full h-8 text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 100 30" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke-dasharray="5 5" d="M0 15 L100 15 M85 5 L100 15 L85 25"></path>
                        </svg>
                    </div>
                    <div class="text-center relative md:col-span-1">
                        <div class="text-blue-600 mb-4 text-5xl">💳</div>
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-white">3. Sewa Online</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Pesan langsung dan bayar aman
                            melalui
                            platform kami.</p>
                    </div>
                </div>

            </div>
        </section>


        <section x-data="{ revealed: false }" x-intersect:enter="revealed = true" x-intersect:leave="revealed = false"
            :class="{
                'opacity-0 translate-y-4': !revealed,
                'opacity-100 translate-y-0': revealed
            }"
            class="transition-all duration-700 ease-out py-16 bg-gray-50 dark:bg-gray-900" id="listings">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Kos Populer Pilihan</h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Ditemukan oleh banyak pencari kos
                        seperti
                        Anda.</p>
                </div>
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        class="bg-white dark:bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl overflow-hidden transform hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                        <img class="w-full h-56 object-cover object-center"
                            src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2070&auto=format&fit=crop"
                            alt="Kos Image">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Kos Melati Jaya
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">Jl. Mawar No. 12,
                                Setiabudi, Jakarta Selatan</p>
                            <div class="flex justify-between items-center">
                                <p class="text-lg font-bold text-blue-600 dark:text-blue-400">Rp 1.800.000 / bulan
                                </p>
                                <a href="#"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-700 transition-colors">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl overflow-hidden transform hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                        <img class="w-full h-56 object-cover object-center"
                            src="https://images.unsplash.com/photo-1581209410127-8211e90da024?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=3024"
                            alt="Kos Image">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Kos Anggrek Ceria
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">Jl. Soekarno
                                Hatta
                                No.
                                45, Bandung</p>
                            <div class="flex justify-between items-center">
                                <p class="text-lg font-bold text-blue-600 dark:text-blue-400">Rp 1.200.000 / bulan
                                </p>
                                <a href="#"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-700 transition-colors">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl overflow-hidden transform hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                        <img class="w-full h-56 object-cover object-center"
                            src="https://images.unsplash.com/photo-1719166975779-b7033a7770e0?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%D%3D&auto=format&fit=crop&q=80&w=2148"
                            alt="Kos Image">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Wisma Mahasiswa
                                UGM
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">Pogung Lor,
                                Mlati,
                                Sleman, Yogyakarta</p>
                            <div class="flex justify-between items-center">
                                <p class="text-lg font-bold text-blue-600 dark:text-blue-400">Rp 900.000 / bulan
                                </p>
                                <a href="#"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-700 transition-colors">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section x-data="{ revealed: false }" x-intersect:enter="revealed = true" x-intersect:leave="revealed = false"
            :class="{
                'opacity-0 translate-y-4': !revealed,
                'opacity-100 translate-y-0': revealed
            }"
            class="transition-all duration-700 ease-out py-16 bg-white dark:bg-gray-900" id="testimoni">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Apa Kata Mereka</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Pengalaman nyata dari penyewa di seluruh
                    Indonesia.
                </p>
            </div>
            <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 px-4">
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="italic text-gray-700 dark:text-gray-300">“Sangat membantu! Saya dapat kos dekat
                        kampus
                        dalam hitungan menit.”</p>
                    <div class="mt-4 font-semibold text-blue-600 dark:text-blue-400">– Dinda, Mahasiswi UI</div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="italic text-gray-700 dark:text-gray-300">“Verifikasi properti membuat saya lebih
                        tenang
                        sebelum booking.”</p>
                    <div class="mt-4 font-semibold text-blue-600 dark:text-blue-400">– Rudi, Karyawan Swasta</div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="italic text-gray-700 dark:text-gray-300">“Tampilan bersih dan mudah dipakai,
                        recommended
                        banget.”</p>
                    <div class="mt-4 font-semibold text-blue-600 dark:text-blue-400">– Sari, Freelancer</div>
                </div>
            </div>
        </section>


        <section x-data="{ revealed: false }" x-intersect:enter="revealed = true" x-intersect:leave="revealed = false"
            :class="{
                'opacity-0 translate-y-4': !revealed,
                'opacity-100 translate-y-0': revealed
            }"
            class="transition-all duration-700 ease-out py-16 bg-blue-600 text-white text-center">
            <h2 class="text-3xl font-bold mb-4">Mulai Cari Kos Sekarang!</h2>
            <p class="mb-6 text-lg">Gabung bersama ribuan pengguna lain dan temukan kos idamanmu hari ini.</p>
            <a href="{{ route('login') }}"
                class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">Mulai
                Sekarang</a>
        </section>
    </main>



    <footer x-data="{ revealed: false }" x-intersect:enter="revealed = true" x-intersect:leave="revealed = false"
        :class="{
            'opacity-0 translate-y-4': !revealed,
            'opacity-100 translate-y-0': revealed
        }"
        class="transition-all duration-700 ease-out bg-gray-800 dark:bg-gray-950">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400">&copy; {{ date('Y') }} Kosku. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427C2.013 14.784 2 14.43 2 12s.013-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363.416 2.427.465C9.216 2.013 9.57 2 12 2zm0 1.837c-2.391 0-2.676.009-3.624.052-.93.043-1.437.2-1.773.332-.446.173-.765.38-1.1.715-.336.336-.542.655-.715 1.1-.132.336-.289.843-.332 1.773-.043.948-.052 1.233-.052 3.624s.009 2.676.052 3.624c.043.93.2 1.437.332 1.773.173.446.38.765.715 1.1.336.336.655.542 1.1.715.336.132.843.289 1.773.332.948.043 1.233.052 3.624.052s2.676-.009 3.624-.052c.93-.043 1.437.2 1.773-.332.446.173.765.38 1.1-.715.336.336.542.655.715-1.1.132.336.289.843.332 1.773.043-.948.052-1.233.052-3.624s-.009-2.676-.052-3.624c-.043-.93-.2-1.437-.332-1.773a2.91 2.91 0 00-.715-1.1 2.91 2.91 0 00-1.1-.715c-.336-.132-.843-.289-1.773-.332-.948-.043-1.233-.052-3.624-.052zm0 3.327a4.836 4.836 0 110 9.672 4.836 4.836 0 010-9.672zm0 7.992a3.156 3.156 0 100-6.312 3.156 3.156 0 000 6.312zm4.957-8.343a1.125 1.125 0 11-2.25 0 1.125 1.125 0 012.25 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function carousel() {
            return {
                currentSlide: 0,
                slides: [],
                autoplay: true,
                autoplayInterval: null,

                init() {
                    this.slides = Array.from(this.$refs.carousel.children);
                    this.startAutoplay();
                    this.$watch('autoplay', (isAutoplaying) => {
                        if (isAutoplaying) {
                            this.startAutoplay();
                        } else {
                            this.stopAutoplay();
                        }
                    });

                    this.updateTransform();
                },

                startAutoplay() {
                    if (this.autoplayInterval) return;

                    // PERBAIKAN: Mengubah 40000 (40 detik) menjadi 4000 (4 detik)
                    this.autoplayInterval = setInterval(() => {
                        this.next();
                    }, 4000);
                },

                stopAutoplay() {
                    clearInterval(this.autoplayInterval);
                    this.autoplayInterval = null;
                },

                next() {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                    this.updateTransform();

                    if (this.autoplay) {
                        this.stopAutoplay();
                        this.startAutoplay();
                    }
                },

                prev() {
                    this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                    this.updateTransform();

                    if (this.autoplay) {
                        this.stopAutoplay();
                        this.startAutoplay();
                    }
                },

                goTo(index) {
                    this.currentSlide = index;
                    this.updateTransform();

                    if (this.autoplay) {
                        this.stopAutoplay();
                        this.startAutoplay();
                    }
                },

                updateTransform() {
                    if (this.$refs.carousel) {
                        this.$refs.carousel.style.transform = `translateX(-${this.currentSlide * 100}%)`;
                    }
                }
            }
        }
    </script>
</x-guest-layout>
