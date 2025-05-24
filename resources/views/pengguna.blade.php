<x-layout-admin>
    <x-slot:title>{{$title}}</x-slot:title>
    <div class="bg-gray-200 pt-4 fixed z-50 mt-0.4 w-full"></div>
    <div class="mx-auto max-w-screen-xl px-2 mt-4">
            <div class="overflow-x-auto bg-white">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">Username</th>
                            <th scope="col" class="px-4 py-3">Alamat</th>
                            <th scope="col" class="px-4 py-3">email</th>
                            <th scope="col" class="px-4 py-3">No HP</th>
                            <th scope="col" class="px-4 py-3">Tanggal daftar</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelanggan as $index => $p)
                        <tr class="border-b border-gray-300">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $index + 1 }}</th>
                            <td class="px-4 py-3">{{ $p->id }}</td>
                            <td class="px-4 py-3">{{ $p->nama }}</td>
                            <td class="px-4 py-3">{{ $p->alamat }}</td>
                            <td class="px-4 py-3">{{ $p->email }}</td>
                            <td class="px-4 py-3">{{ $p->no_hp }}</td>
                            <td class="px-4 py-3">{{ $p->created_at->format('d-m-Y') }}</td>
                            <td class="px-4 py-3 flex items-center justify-end ">
                                <button id="{{ $index }}-dropdown-button" data-dropdown-toggle="{{ $index }}-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="{{ $index }}-dropdown" class="hidden z-10 w-26 bg-white rounded divide-y divide-gray-100 shadow">
                                    <div class="py-1">
                                        <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-semibold hover:bg-gray-200 py-2 px-2 w-full text-left">Hapus</button>
                                        </form>                                    
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</x-layout-admin>
