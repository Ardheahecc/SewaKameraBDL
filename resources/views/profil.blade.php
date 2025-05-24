<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./node_modules/apexcharts/dist/apexcharts.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <title>Menu Saya</title>
</head>
<body class="bg-gray-100">
    <x-nav-pelanggan></x-nav-pelanggan>

    <div class="mx-6 mb-4">
        <p class="text-lg font-semibold mb-4 text-center">Profil Anda</p>
        <hr class="text-gray-400 mb-4 mx-11">
    </div>

    <div class="col-span-2 row-span-1 col-start-1 row-start-2 p-3 bg-white rounded-lg border border-gray-200 shadow-md mx-45 mb-4">
        <div class="grid grid-cols-1 grid-rows-1 gap-4">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama</th>
                            <th scope="col" class="px-4 py-3">Email</th>
                            <th scope="col" class="px-4 py-3">Alamat</th>
                            <th scope="col" class="px-4 py-3">No hp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-3">{{ $pelanggan->nama }}</td>
                            <td class="px-4 py-3">{{ $pelanggan->email }}</td>
                            <td class="px-4 py-3">{{ $pelanggan->alamat }}</td>
                            <td class="px-4 py-3">{{ $pelanggan->no_hp }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mx-6 mb-4">
        <p class="text-lg font-semibold mb-4 text-center">Pesanan Anda</p>
        <hr class="text-gray-400 mb-4 mx-11">
    </div>

    @if($pesanan->isEmpty())
    <div class="flex flex-col justify-center items-center w-full py-21">
        <img src="{{ asset('images/ulasanKosong.png') }}" alt="" class="w-65 h-auto mb-6">
        <p class="text-md font-semibold text-gray-400">Anda belum melakukan pemesanan</p>
    </div>
    @else
    <div class="col-span-2 row-span-1 row-start-3 p-3 bg-white rounded-lg border border-gray-200 shadow-md mx-45 mb-12">
        <div class="grid grid-cols-2 grid-rows-1 gap-4">
            @foreach($pesanan as $pesan)
                @foreach($pesan->detailPesanan as $detail)
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
                                <li class="py-1">Status : {{ $detail->pesanan->status_sewa}}</li>
                            </ul>
                        </div>
                    </div>
                     @if($detail->pesanan->status_sewa === 'menunggu konfirmasi')
                    <div>
                        <form action="{{ route('pesanan.batalkan', $detail->pesanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini ?')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="pesanan_id" value="{{ $detail->pesanan->id }}">
                            <button type="submit" class="block w-full text-center border mt-4 border-red-400 rounded-md py-2 px-4 hover:bg-red-100 text-red-600 font-semibold">
                                Batalkan Pesanan
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
    @endif

    <x-footer></x-footer>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>
