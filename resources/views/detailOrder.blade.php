<x-layout-admin>
    <x-slot:title>{{$title}}</x-slot:title>

{{-- satu baris data di paling atass --}}
<div class="grid grid-cols-1 grid-rows-1 gap-4 mt-4">
    <div class="col-span-1 row-span-2 p-3 bg-white rounded-lg border border-gray-200 shadow-md">
        <div>
            <p class="text-xs text-gray-500 font-semibold">Data pesanan</p>
        </div>
        <div class="overflow-x-auto mt-4">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Tanggal pesan</th>
                        <th scope="col" class="px-4 py-3">status</th>
                        <th scope="col" class="px-4 py-3">Tanggal sewa</th>
                        <th scope="col" class="px-4 py-3">jam sewa</th>
                        <th scope="col" class="px-4 py-3">Total bayar</th>
                        <th scope="col" class="px-4 py-3">Metode pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-300">
                        <td class="px-4 py-3">{{ $pesanan->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $pesanan->status_pembayaran }}</td>
                        <td class="px-4 py-3">{{ $pesanan->tanggal_sewa }}</td>
                        <td class="px-4 py-3">{{ $pesanan->jam_sewa }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($pesanan->total_bayar)}} </td>
                        <td class="px-4 py-3">{{ $pesanan->metode_bayar }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- satu baris data di paling atass end--}}

{{-- bagian yang nampilin data barang dipesan, bawah kiriii --}}
<div class="grid grid-cols-2 grid-rows-1 gap-2">
    <div class="col-span-2 row-span-1 row-start-3 p-3 bg-white rounded-lg border border-gray-200 shadow-md">
        <div>
            <p class="text-xs text-gray-500 font-semibold mb-2">Data barang dipesan</p>
        </div>
        <div class="grid grid-cols-2 grid-rows-1 gap-4">
            @foreach($pesanan->detailPesanan as $detail)
            <div class="col-span-2 p-3 bg-white rounded-lg border border-gray-200 shadow-md">   
                <div class="grid grid-cols-2 grid-rows-1 gap-2">
                    <div class="flex justify-center items-center">
                        <img src="{{ asset($detail->barang->gambar) }}" class="w-35 h auto" alt="">
                    </div>
                    <div>
                        <ul class="text-sm text-gray-500">
                            <li class="py-1">Nama : {{ $detail->barang->nama }}</li>
                            <li class="py-1">Kategori : {{ $detail->barang->kategori }}</li>
                            <li class="py-1">Durasi sewa : {{ $detail->durasi }}</li>
                            <li class="py-1">Jumlah : {{ $detail->jumlah }}</li>
                            <li class="py-1">Subtotal : Rp {{ number_format($detail->subtotal) }}</li>
                            <li class="py-1">Keterlambatan (jam) : {{ $detail->jumlah_jam_keterlambatan ?? '0'}}</li>
                            <li class="py-1">Denda : Rp {{ $detail->denda ?? '0'}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- bagian yang nampilin data barang dipesan, bawah kiriii endd--}}


    {{-- bagian data pemesan, bawah kanan --}}
    <div class="col-span-2 row-span-1 col-start-1 row-start-2 p-3 bg-white rounded-lg border border-gray-200 shadow-md">
        <div class="grid grid-cols-1 grid-rows-1 gap-4">
            <div>
                <p class="text-xs text-gray-500 font-semibold">Data pemesan</p>
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
                        <td class="px-4 py-3">{{ $pesanan->pelanggan->id }}</td>
                        <td class="px-4 py-3">{{ $pesanan->pelanggan->nama }}</td>
                        <td class="px-4 py-3">{{ $pesanan->pelanggan->email }}</td>
                        <td class="px-4 py-3">{{ $pesanan->pelanggan->alamat }}</td>
                        <td class="px-4 py-3">{{ $pesanan->pelanggan->no_hp }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- bagian data pemesan, bawah kanan --}}

</div>
    
</x-layout-admin>