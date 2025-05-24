<x-layout-admin>
    <x-slot:title>{{$title}}</x-slot:title>

{{-- card kecil2 warna warni di bagian atas --}}
    <div class="py-8 flex mx-auto max-w-screen-xl lg:py-1 mb-2 mt-2">
        <div class="grid gap-3 lg:grid-cols-6 md:grid-cols-3 text-white flex justify-betwen w-full">
            <div class="p-3 bg-linear-to-t from-sky-500 to-indigo-500 rounded-lg shadow-md w-full">
                @php
                    $totalKamera = $kamera->sum('stok');
                    $totalAtribut = $atribut->sum('stok');
                    $totalPelanggan = $pelanggan->count();
                @endphp
                <div>
                    <h1 class="text-3xl font-bold tracking-tight mb-1">{{ $totalKamera }}</h1>
                    <p class="text-sm">Unit Kamera Tersedia</p>
                </div>
            </div>                           
            <div class="p-3 bg-linear-to-t from-sky-500 to-indigo-500 rounded-lg shadow-md w-full">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight mb-1">{{ $totalAtribut }}</h1>
                    <p class="text-sm">Unit Atribut tersedia</p>
                </div>
            </div>                         
            <div class="p-3 bg-linear-to-t from-green-500 to-blue-500 rounded-lg shadow-md w-full">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight mb-1">{{ $jumlahPenyewaan }}</h1>
                    <p class="text-sm">Penyewaan Aktif</p>
                </div>
            </div>                                                   
            <div class="p-3 bg-linear-to-t from-green-500 to-blue-500 rounded-lg shadow-md w-full">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight mb-1">{{ $jumlahPesanan }}</h1>
                    <p class="text-sm">Menunggu Konfirmasi</p>
                </div>
            </div>
            <div class="p-3 bg-linear-to-t from-fuchsia-500 to-violet-500 rounded-lg shadow-md w-full">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight mb-1">{{ $totalPelanggan }}</h1>
                    <p class="text-sm">Pengguna layanan</p>
                </div>
            </div>                      
        </div>  
    </div>
{{-- end of card kecil2 warna warni di bagian atas --}}

    <hr class="mb-3 text-gray-300">
    {{-- hr ni cuma garis doang --}}
    

{{-- 3 tabel baris bawah mulai dari siniiii --}}
    <div class="grid grid-cols-2 grid-rows-1 gap-4 mb-4">

        <div class="col-span-1 row-span-1 col-start-1 row-start-1 p-3 bg-white rounded-lg border border-gray-200 shadow-md">
            <p class="text-xs text-gray-500 mb-3">Unit kamera tersedia</p>
            <div class="bg-white relative overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-center text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-15 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Tipe</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Harga/24 jam</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Harga/12 jam</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Harga/6 jam</th>
                                <th scope="col" class="px-6 py-3">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kamera->take(5) as $index => $item)
                            <tr class="border-b border-gray-300">
                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $index + 1 }}</th>
                                <td class="px-4 py-3">{{ $item->nama }}</td>
                                <td class="px-6 py-3">{{ $item->tipe }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($item->harga_sewa_24_jam) }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($item->harga_sewa_12_jam) }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($item->harga_sewa_6_jam) }}</td>
                                <td class="px-6 py-3">{{ $item->stok }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-2">
                    <a href="/kamera">
                        <svg class="w-6 h-6 text-blue-600 hover:text-blue-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-span-1 row-span-1 col-start-2 row-start-1 p-3 bg-white rounded-lg border border-gray-200 shadow-md">
            <p class="text-xs text-gray-500 mb-3">Unit atribut tersedia</p>
            <div class="bg-white relative overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-center text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-15 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Tipe</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Harga/24 jam</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Harga/12 jam</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Harga/6 jam</th>                                <th scope="col" class="px-6 py-3">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($atribut->take(5) as $index => $item)
                            <tr class="border-b border-gray-300">
                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $index + 1 }}</th>
                                <td class="px-4 py-3 whitespace-nowrap text-left">{{ $item->nama }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-left">{{ $item->tipe }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($item->harga_sewa_24_jam) }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($item->harga_sewa_12_jam) }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($item->harga_sewa_6_jam) }}</td>
                                <td class="px-6 py-3">{{ $item->stok }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-2">
                    <a href="/atribut">
                        <svg class="w-6 h-6 text-blue-600 hover:text-blue-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
{{-- 3 tabel baris bawah kelar di siniiii --}}
{{-- 3 tabel baris bawah mulai dari siniiii --}}
    <div class="grid grid-cols-2 grid-rows-1 gap-4">
        <div class="p-3 bg-white rounded-lg border border-gray-200 shadow-md">
            <p class="text-xs text-gray-500 mb-3">Penyewaan aktif</p>
            <div class="bg-white relative overflow-hidden">
                <div class="overflow-x-auto bg-dark">
                    <table class="w-full text-xs text-center text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-15 py-3 whitespace-nowrap">Nama Penyewa</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Tanggal Sewa</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Total Bayar</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Metode Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penyewaan->take(5) as $index => $item)
                            <tr class="border-b border-gray-300">
                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $index + 1 }}</th>
                                <td class="px-4 py-3">{{ $item->pelanggan->nama ?? 'Tidak diketahui' }}</td>
                                <td class="px-6 py-3">{{ $item->tanggal_sewa }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($item->total_bayar)}}</td>
                                <td class="px-6 py-3">{{ $item->metode_bayar }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-end mt-2">
                <a href="/sewaAktif">
                    <svg class="w-6 h-6 text-blue-600 hover:text-blue-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="col-span-1 row-span-1 col-start-1 row-start-1 p-3 bg-white rounded-lg border border-gray-200 shadow-md">
            <p class="text-xs text-gray-500 mb-3">Pesanan menunggu konfirmasi</p>
            <div class="bg-white relative overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-center text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-15 py-3 whitespace-nowrap">Nama Penyewa</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Tanggal Sewa</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Total Bayar</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Metode Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan->take(5) as $index => $item)
                            <tr class="border-b border-gray-300">
                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $index + 1 }}</th>
                                <td class="px-4 py-3">{{ $item->pelanggan->nama ?? 'Tidak diketahui' }}</td>
                                <td class="px-6 py-3">{{ $item->tanggal_sewa }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($item->total_bayar)}}</td>
                                <td class="px-6 py-3">{{ $item->metode_bayar }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-2">
                    <a href="/daftarPesanan">
                        <svg class="w-6 h-6 text-blue-600 hover:text-blue-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
{{-- 3 tabel baris bawah kelar di siniiii --}}
    
</x-layout-admin>