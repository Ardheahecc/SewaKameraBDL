<x-layout-admin>
    <x-slot:title>{{$title}}</x-slot:title>

    {{-- statistik card di bagian atas kirii --}}
    <div class="max-w-screen">
        <div class="bg-gray-200 pt-4 fixed z-50 mt-0.4 w-full">
        <div class="grid grid-cols-4 grid-rows-1 gap-2">
            <div class="p-3 px-4 bg-white border-gray-200 shadow-md rounded-lg shadow-md w-full mb-4">
                <div>
                    <p class="text-xs text-semibold">Menunggu konfirmasi</p>
                    <h1 class="text-3xl font-bold tracking-tight mb-1">{{ $jumlahPesanan }}</h1>
                </div>
            </div>
            <div class="p-3 px-4 bg-white border-gray-200 shadow-md rounded-lg shadow-md w-full mb-4">
                <div>
                    <p class="text-xs text-semibold">Penyewaan aktif</p>
                    <h1 class="text-3xl font-bold tracking-tight mb-1">{{ $jumlahPenyewaan }}</h1>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- statistik card di bagian atas kirii end--}}

    
    {{-- tabel nya mulai dari sini --}}
        <div class="mx-auto max-w-screen-xl mt-28 px-2">
            <!-- Start coding here -->
                <div class="overflow-x-auto bg-white">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">ID</th>
                                <th scope="col" class="px-4 py-3">Status Pembayaran</th>
                                <th scope="col" class="px-4 py-3">Nama Penyewa</th>
                                <th scope="col" class="px-4 py-3">Tanggal Sewa</th>
                                <th scope="col" class="px-4 py-3">Jam Sewa</th>
                                <th scope="col" class="px-4 py-3">Total Bayar</th>
                                <th scope="col" class="px-4 py-3">Metode Pembayaran</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan as $key => $item)
                            <tr class="border-b border-gray-300">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $key + 1 }}</th>
                                <td class="px-4 py-3">{{ $item->id }}</td>
                                <td class="px-4 py-3">{{ $item->status_pembayaran }}</td>
                                <td class="px-4 py-3">{{ $item->pelanggan->nama ?? 'Tidak diketahui' }}</td>
                                <td class="px-4 py-3">{{ $item->tanggal_sewa }}</td>
                                <td class="px-4 py-3">{{ $item->jam_sewa }}</td>                                
                                <td class="px-4 py-3">Rp {{ number_format($item->total_bayar)}}</td>
                                <td class="px-4 py-3">{{ $item->metode_bayar }}</td>
                                <td class="px-4 py-3">{{ $item->status_sewa }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        {{-- tabel nya mulai dari sini --}}

        </div>
</x-layout-admin>