<x-layout-admin>
    <x-slot:title>{{$title}}</x-slot:title>

    {{-- card statistik di bagian atas kiri --}}
    <div class="bg-gray-200 pt-4 fixed z-50 mt-0.4 w-full">
        <div class="grid grid-cols-4 grid-rows-1 gap-2">
            <div class="p-3 px-4 bg-white border-gray-200 shadow-md rounded-lg shadow-md w-full mb-4">
                <div>
                    <p class="text-xs text-semibold">Menunggu konfirmasi</p>
                    <h1 class="text-3xl font-bold tracking-tight mb-1">{{ $jumlahPesanan }}</h1>
                </div>
            </div>
        </div>
    </div>
    {{-- card statistik di bagian atas kiri end --}}

    
    {{-- tabel nya mulai dari siniii --}}
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
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
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
                                <td class="px-4 py-3 flex items-center justify-end ">
                                    <button id="apple-imac-{{ $key }}-dropdown-button" data-dropdown-toggle="apple-imac-{{ $key }}-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-{{ $key }}-dropdown" class="hidden z-10 w-26 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <form action="{{ route('pesanan.konfirmasi', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin konfirmasi pesanan ini ?, pastikan pembayaran sudah valid dan konfirmasi hanya saat penyewa sudah mengambil barang')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="pesanan_id" value="{{ $item->id }}">
                                                    <button type="submit" class="block w-full text-left py-2 px-4 hover:bg-gray-100">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('pesanan.tolak', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="pesanan_id" value="{{ $item->id }}">
                                                    <button type="submit" class="block w-full text-left py-2 px-4 hover:bg-gray-100">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <a href="{{ route('pesanan.show', $item->id) }}" class="block py-2 px-4 hover:bg-gray-100">Detail</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- tabel nya kelar sampe siniii --}}

        </div>
</x-layout-admin>