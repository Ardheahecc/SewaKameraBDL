<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Statistik card yang nunjukin jumlah atribut tersedia dan disewa -->
    <div class="bg-gray-200 pt-4 fixed z-50 mt-0.4 w-full">
        <div class="grid grid-cols-4 gap-2">
            <div class="p-3 px-4 bg-white border-gray-200 shadow-md rounded-lg w-full mb-4">
                <p class="text-xs font-semibold">Unit kamera tersedia</p>
                <h1 class="text-3xl font-bold tracking-tight mb-1">{{ $atributTersedia }}</h1>
            </div>
            <div class="p-3 px-4 bg-white border-gray-200 shadow-md rounded-lg w-full mb-4">
                <p class="text-xs font-semibold">Unit kamera disewa</p>
                <h1 class="text-3xl font-bold tracking-tight mb-1">0</h1>
            </div>
        </div>

        <!-- Tombol Tambah unitttt-->
        <div class="flex pb-2">
            <a href="{{ route('barang.store') }}">
                <button class="flex items-center text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">
                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 010 2h-5v5a1 1 0 01-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                    Tambah Unit
                </button>
            </a>
        </div>
    </div>

    <!-- Tabel unitt atribut mulai dari siniii -->
    <div class="mx-auto max-w-screen-xl mt-40 px-2">
        <div class="overflow-x-auto bg-white">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Tipe</th>
                        <th class="px-4 py-3">Harga/24 jam</th>
                        <th class="px-4 py-3">Harga/12 jam</th>
                        <th class="px-4 py-3">Harga/6 jam</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Stok</th>
                        <th class="sr-only">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang as $index => $item)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $item->id }}</td>
                            <td class="px-4 py-3">
                                @if($item->gambar)
                                    <img src="{{ asset($item->gambar) }}" class="w-20 h-auto rounded" alt="gambar">
                                @else
                                    <span class="text-gray-400 italic">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $item->nama }}</td>
                            <td class="px-4 py-3">{{ $item->tipe }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($item->harga_sewa_24_jam) }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($item->harga_sewa_12_jam) }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($item->harga_sewa_6_jam) }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-xs {{ $item->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->stok > 0 ? 'Tersedia' : 'Kosong' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $item->stok }}</td>
                            <td class="px-4 py-3 flex items-center justify-end ">
                                <button id="{{ $index }}-dropdown-button" data-dropdown-toggle="{{ $index }}-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="{{ $index }}-dropdown" class="hidden z-50 w-26 bg-white rounded divide-y shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                        <li>
                                            <a href="{{ route('barang.edit', $item->id) }}" class="font-semibold">
                                                <div class="hover:bg-gray-200 py-2 px-2">Edit</div>
                                            </a>
                                        </li>
                                        <li class="hover:bg-gray-200 max-w-screen">
                                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-semibold hover:bg-gray-200 py-2 px-2 w-full text-left">Hapus</button>
                                            </form>                                    
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Tabel unitt atribut kelar sampe siniii -->

</x-layout-admin>
