<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="./node_modules/apexcharts/dist/apexcharts.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body>
    <x-nav-pelanggan></x-nav-pelanggan>

    <div class="flex flex-col justify-center items-center mx-6 mt-4">
        <p class="text-lg font-semibold mb-6">{{ $title }} tersedia saat ini</p>
    </div>


{{-- list katalog barang mulai dari siniiiii --}}
    <div class="mx-6 mb-4 py-6 flex flex-col items-center">
        <p class="text-lg font-semibold mb-4">Properti kami</p>
        <div class="grid gap-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 mx-6">
            @foreach($barang as $index => $item)
            @if($item->stok > 0)
                <button onclick="toggleModal{{ $index }}()" type="button">
            @else
                <button onclick="stokHabisAlert()" type="button">
            @endif
                <div class=" relative bg-white rounded-lg border border-gray-200 shadow-md hover:border-1 hover:border-gray-400">
                    <div class="flex justify-center items-center">
                        <img src="{{ asset($item->gambar) }}" alt="" class="w-auto h-46 rounded-t-lg">
                    </div>
        
                    <div class="p-6 text-left">
                        <p class="text-lg font-semibold">{{ $item->nama }}</p>
                        <p class="text-md font-light mb-4">{{ $item->tipe }}</p>
                        <p class="text-1xl">Rp {{ number_format($item->harga_sewa_24_jam) }} /24 jam</p>
                        <p class="text-1xl">Rp {{ number_format($item->harga_sewa_12_jam) }} /12 jam</p>
                        <p class="text-1xl">Rp {{ number_format($item->harga_sewa_6_jam) }} /6 jam</p>
                    </div>
                    @if($item->stok == 0)
                        <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">Stok Habis</div>
                    @endif
                </div>
            </button>
            {{-- form detail barang, ini ga muncul kalo ga di klik salah satu katalog nyaa--}}
            <div id="Modal{{ $index }}" class="fixed inset-0 bg-gray-800/50 flex items-center justify-center z-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-auto relative">
                
                <!-- Tombol Close -->
                <button onclick="toggleModal{{ $index }}()" class="absolute top-2 right-2 text-gray-500 hover:text-black">
                    &times;
                </button>
                    <div class="grid grid-cols-2 grid-rows-1 gap-4 mt-6 w-186">
                        <div class="flex flex-col justify-center items-center mr-5">
                            <h3 class="text-2xl font-semibold mb-6">{{ $item->nama }}</h3>
                            <img src="{{ asset($item->gambar) }}" class="h-55 w-auto rounded shadow-lg">
                        </div>
                        <div class="flex flex-col ml-5">
                            <ul class="mb-6">
                                <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                                    <p>Harga/24 jam :</p>
                                    <p>Rp {{ number_format($item->harga_sewa_24_jam) }}</p>
                                </li>
                                <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                                    <p>Harga/12 jam :</p>
                                    <p>Rp {{ number_format($item->harga_sewa_12_jam) }}</p>
                                </li>
                                <li class="text-sm font-semibold mb-2 flex flex-row justify-between">
                                    <p>Harga/6 jam :</p>
                                    <p>Rp {{ number_format($item->harga_sewa_6_jam) }}</p>
                                </li>
                            </ul>
                            <form action="{{ route('keranjang.store') }}" method="POST">
                                @csrf
                                <div class="mb-22">
                                    <input type="hidden" name="pelanggan_id" value="{{ $user->id }}">
                                    <input type="hidden" name="barang_id" value="{{ $item->id }}">
                                    <div class="w-full mb-2 flex flex-row items-center justify-between">
                                        <label for="quantity{{ $index }}" class="block mb-2 text-sm font-medium text-gray-900">Jumlah unit :</label>
                                        <input value="1" min="1" type="number" name="jumlah" id="jumlah{{ $index }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-35" placeholder="0" required>
                                    </div>
                                    <div class="w-full flex flex-row items-center justify-between mb-2">
                                        <label for="durasi{{ $index }}" class="block mb-2 text-sm font-medium text-gray-900">Durasi :</label>
                                        <select name="durasi" id="durasi{{ $index }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-35">
                                            <option selected>6 jam</option>
                                            <option>12 jam</option>
                                            <option>24 jam</option>
                                        </select>
                                    </div>
                                    <div id="hari-container{{ $index }}" class="w-full mb-2 flex flex-row items-center justify-between" style="display: none;">
                                        <label for="hari{{ $index }}" class="block mb-2 text-sm font-medium text-gray-900">Jumlah hari :</label>
                                        <input value="1" min="1" type="number" name="hari" id="hari{{ $index }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-35" placeholder="0" required>
                                    </div>
                                </div>
                                <button type="submit" class="mt-2 w-full flex justify-center items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                                    </svg>  
                                    Masukan ke keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- form detail barang endd --}}

            {{-- skrip untuk buka detail barang yang ada tombol masuka keranjang --}}
            <script>
                function toggleModal{{ $index }}() {
                const modal = document.getElementById('Modal{{ $index }}');
                modal.classList.toggle('hidden');
                }
            </script>
            <script>
                function stokHabisAlert() {
                    alert('Stok barang ini habis. Silakan pilih barang lain.');
                }
            </script>
            {{-- skrip endd --}}

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const durasiSelect{{ $index }} = document.getElementById('durasi{{ $index }}');
                    const hariContainer{{ $index }} = document.getElementById('hari-container{{ $index }}');
                    const hariInput{{ $index }} = document.getElementById('hari{{ $index }}');
            
                    function cekDurasi{{ $index }}() {
                        if (durasiSelect{{ $index }}.value === '24 jam') {
                            hariContainer{{ $index }}.style.display = 'flex';
                            hariInput{{ $index }}.required = true;
                        } else {
                            hariContainer{{ $index }}.style.display = 'none';
                            hariInput{{ $index }}.required = false;
                        }
                    }
            
                    durasiSelect{{ $index }}.addEventListener('change', cekDurasi{{ $index }});
                    cekDurasi{{ $index }}(); // cek sekali pas buka
                });
            </script>            

            @endforeach                 
        </div>
    </div>
{{-- list katalog barang kelar sampe siniiiii --}}

    <x-footer></x-footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>
