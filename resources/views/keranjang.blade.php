<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./node_modules/apexcharts/dist/apexcharts.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <title>Keranjang</title>
</head>
<body class="bg-gray-100">
    <x-nav-pelanggan></x-nav-pelanggan>

    <div class="mx-6 mb-4">
        {{-- juduuuulll halaman --}}
        <p class="text-lg font-semibold mb-4 text-center">Keranjang</p>
        <hr class="text-gray-400 mb-4 mx-11">

        {{-- cek kalo keranjang masi kosong atau engga --}}
        @if($keranjang->isEmpty())
        <div class="flex flex-col justify-center items-center">
            <img src="{{ asset('images/keranjang_kosong.png') }}" alt="" class="w-65 h-auto mb-6">
            <p class="text-lg font-semibold text-gray-400">Keranjang Anda masih kosong</p>
        </div>
        @else

        {{-- tampilan list barang yang dimasukin ke keranjang --}}
        @foreach($keranjang as $item)
        <div class="bg-white mx-21 rounded-md shadow-md border border-gray-300 flex mb-3">
            <div class="mr-2 w-45 flex justify-center items-center">

                {{-- form tombol hapuss barang dari keranjang --}}
                <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <svg class="w-6 h-6 text-red-400 hover:text-red-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </form>                  
            </div>

            <div class="w-full bg-gray-200 my-2 rounded-md">
                <ul class="mb-6 my-3 ml-4">
                    <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                        <p>Nama item : {{ $item->barang->nama }}</p>
                    </li>
                    <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                        <p>Tipe item : {{ $item->barang->tipe }}</p>
                    </li>
                    <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                        <p>Jumlah item : {{ $item->jumlah }}</p>
                    </li>
                    <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                        <p>Durasi sewa : {{ $item->durasi }}</p>
                    </li>
                    <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                        <p>Harga item untuk {{ $item->durasi }} :
                            @php
                                $durasi = $item->durasi;
                                if ($durasi == '6 jam') {
                                    $harga = $item->barang->harga_sewa_6_jam;
                                } elseif ($durasi == '12 jam') {
                                    $harga = $item->barang->harga_sewa_12_jam;
                                } else {
                                    $harga = $item->barang->harga_sewa_24_jam;
                                }
                            @endphp

                            Rp {{ number_format($harga) }}
                        </p>
                    </li>
                    @if($item->durasi === '24 jam')
                    <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                        <p>Jumlah hari : {{ $item->jumlah_hari }}</p>
                    </li>
                    @endif
                    <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                        <p>Subtotal :
                            
                            @php
                                if ($item->durasi === '6 jam') {
                                    $harga = $item->barang->harga_sewa_6_jam;
                                    $subtotal = $harga * $item->jumlah;
                                } elseif ($item->durasi === '12 jam') {
                                    $harga = $item->barang->harga_sewa_12_jam;
                                    $subtotal = $harga * $item->jumlah;
                                } else {
                                    $harga = $item->barang->harga_sewa_24_jam;
                                    $subtotal = $harga * $item->jumlah * $item->jumlah_hari;
                                }
                            @endphp

                            Rp {{ number_format($subtotal) }}</p>
                    </li>
                </ul>
            </div>
            <div class="ml-2 w-full flex justify-center items-center">
                <img src="{{ asset($item->barang->gambar) }}" class="h-35 w-auto rounded my-2">
            </div>
        </div>
        @endforeach
        @endif
    </div>


    {{-- form isi validasi pesanan mulai dari sini --}}
    @if($keranjang->isEmpty())
    @else
    <div class="bg-white mx-27 rounded-md shadow-md border border-gray-300 mb-4">
        <form action="{{ route('pesanan.store') }}" method="POST" class="flex justify-center">
            @csrf
            <div class="my-4 mx-2 w-full">
                <ul class="mx-4">
                    <li class="flex justify-between items-center mb-6">
                        <label for="tanggal_sewa">Tanggal mulai sewa :</label>
                        <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-61 p-2.5" required>
                    </li>
                    <li class="flex justify-between items-center mb-6">
                        <label for="jam_sewa">Jam mulai sewa :</label>
                        <input type="time" name="jam_sewa" id="jam_sewa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-61 p-2.5" required>
                    </li>
                    <li class="flex justify-between items-center mb-6 ">
                        <label for="metode_bayar">Metode pembayaran :</label>
                        <div class="flex">
                            <div class="flex items-center mr-4">
                                <input checked id="default-radio-1" type="radio" value="bayar online" name="metode_bayar" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900">Bayar Online</label>
                            </div>
                            <div class="flex items-center">
                                <input id="default-radio-2" type="radio" value="bayar ditempat" name="metode_bayar" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900">Bayar Ditempat</label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="my-4 mx-2 rounded-md border-1 border-gray-400 w-full flex flex-col justify-between">
                <div>
                    <ul class="m-3">
                        @foreach($keranjang as $item)
                        <li class="flex items-center justify-between mb-1">
                            <p class="text-sm">{{ $item->barang->nama }}</p>
                            <p class="text-sm font-semibold">
                                
                                @php
                                    if ($item->durasi === '6 jam') {
                                        $harga = $item->barang->harga_sewa_6_jam;
                                        $subtotal = $harga * $item->jumlah;
                                    } elseif ($item->durasi === '12 jam') {
                                        $harga = $item->barang->harga_sewa_12_jam;
                                        $subtotal = $harga * $item->jumlah;
                                    } else {
                                        $harga = $item->barang->harga_sewa_24_jam;
                                        $subtotal = $harga * $item->jumlah * $item->jumlah_hari;
                                    }
                                @endphp
                                
                                Rp {{ number_format($subtotal) }}</p>
                        </li>
                        @endforeach
                    </ul>
                    <hr class="mx-3 mb-3">
                    <div class="flex items-center justify-between mx-3 mb-4">
                        <p class="text-sm">Total bayar</p>
                        <p class="text-sm font-semibold">Rp {{ number_format($totalHarga) }}</p>
                    </div>
                </div>
                <div class="mx-3">
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Buat pesanan</button>
                </div>
            </div>
        </form>
    </div>
    @endif

    <x-footer></x-footer>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>