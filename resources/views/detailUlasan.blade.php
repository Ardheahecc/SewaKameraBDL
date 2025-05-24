<x-layout-admin>
    <x-slot:title>{{$title}} ID : {{ $ulasan->id }}</x-slot:title>

    {{-- bagian ulasannyyyaaa --}}
    <div class="grid grid-cols-1 grid-rows-1 gap-2">
        <div class="col-span-1 row-span-1 row-start-2 p-3 bg-white rounded-lg border border-gray-200 shadow-md">
            <div>
                <p class="text-xs text-gray-500 font-semibold mb-2">Data ulasan</p>
            </div>
            <div class="grid grid-cols-1 grid-rows-1 gap-4">
                <div class="col-span-2 p-3">   
                    <div class="grid grid-cols-1 grid-rows-1">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold mb-6">{{ $ulasan->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold text-justify">
                               {{ $ulasan->isi }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- bagian ulasannyyyaaa --}}

        
        {{-- bagian data penggunanya yang ngasih ulasan --}}
        <div class="col-span-1 row-span-1 row-start-1 p-3 bg-white rounded-lg border border-gray-200 shadow-md mt-3">
            <div class="grid grid-cols-1 grid-rows-1 gap-4">
                <div class="grid grid-cols-1 grid-rows-1 gap-4">
            <div>
                <p class="text-xs text-gray-500 font-semibold">Data pengguna</p>
            </div>
            <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">ID</th>
                        <th scope="col" class="px-4 py-3">Nama</th>
                        <th scope="col" class="px-4 py-3">Email</th>
                        <th scope="col" class="px-4 py-3">Alamat</th>
                        <th scope="col" class="px-4 py-3">No hp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-300">
                        <td class="px-4 py-3">{{ $pelanggan->id }}</td>
                        <td class="px-4 py-3">{{ $pelanggan->nama }}</td>
                        <td class="px-4 py-3">{{ $pelanggan->email }}</td>
                        <td class="px-4 py-3">{{ $pelanggan->alamat }}</td>
                        <td class="px-4 py-3">{{ $pelanggan->no_hp }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        {{-- bagian data penggunanya yang ngasih ulasan --}}

    </div>
</x-layout-admin>
