<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-screen px-4 py-8 mx-auto lg:py-4 bg-white rounded-lg border border-gray-300 shadow-md mt-6">
        {{-- Error Validation --}}
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form ngisi data barang nya mulai dari siniii --}}
        <form action="{{ isset($barang) ? route('barang.update', $barang->id) : route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($barang))
                @method('PUT')
            @endif

            <div class="grid grid-cols-2 grid-rows-1 gap-4">
                <div class="mr-6">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="sm:col-span-2">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" name="nama" id="nama"
                                value="{{ old('nama', $barang->nama ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Nama barang" required autocomplete="off">
                        </div>
                        <div>
                            <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                            <select name="kategori" id="kategori"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="kamera" {{ old('kategori', $barang->kategori ?? '') == 'kamera' ? 'selected' : '' }}>kamera</option>
                                <option value="atribut" {{ old('kategori', $barang->kategori ?? '') == 'atribut' ? 'selected' : '' }}>atribut</option>
                            </select>
                        </div>
                        <div>
                            <label for="tipe" class="block mb-2 text-sm font-medium text-gray-900">Tipe</label>
                            <input type="text" name="tipe" id="tipe"
                                value="{{ old('tipe', $barang->tipe ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Tipe barang" required autocomplete="off">
                        </div>
                        <div>
                            <label for="stok" class="block mb-2 text-sm font-medium text-gray-900">Stok</label>
                            <input type="number" name="stok" id="stok"
                                value="{{ old('stok', $barang->stok ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="0" required>
                        </div>
                        <div>
                            <label for="harga_sewa_24_jam" class="block mb-2 text-sm font-medium text-gray-900">Harga/24 jam</label>
                            <input type="number" name="harga_sewa_24_jam" id="harga_sewa_24_jam" step="any"
                                value="{{ old('harga_sewa_24_jam', $barang->harga_sewa_24_jam ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="0" required>
                        </div>
                        <div>
                            <label for="harga_sewa_12_jam" class="block mb-2 text-sm font-medium text-gray-900">Harga/12 jam</label>
                            <input type="number" name="harga_sewa_12_jam" id="harga_sewa_12_jam" step="any"
                                value="{{ old('harga_sewa_12_jam', $barang->harga_sewa_12_jam ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="0" required>
                        </div>
                        <div>
                            <label for="harga_sewa_6_jam" class="block mb-2 text-sm font-medium text-gray-900">Harga/6 jam</label>
                            <input type="number" name="harga_sewa_6_jam" id="harga_sewa_6_jam" step="any"
                                value="{{ old('harga_sewa_6_jam', $barang->harga_sewa_6_jam ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="0" required>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Simpan
                        </button>
                        <a href="{{ url()->previous() }}"
                            class="text-red-600 border-2 border-red-600 hover:bg-red-600 hover:text-white font-medium rounded-lg text-sm px-5 py-2 text-center">
                            Batal
                        </a>
                    </div>
                </div>

                <div class="ml-4">
                    <div class="w-full">
                        <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900">Upload Gambar</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                            name="gambar" id="gambar" type="file" accept=".png, .jpg, .jpeg">
                        <p class="mt-1 text-sm text-gray-500 mb-2">PNG, JPG, atau JPEG.</p>

                        @if (isset($barang) && $barang->gambar)
                            <div class="mt-4">
                                <p class="text-sm text-gray-700 mb-2 font-semibold mb-4">Gambar saat ini :</p>
                                <div class="h-52 flex justify-center items-center">
                                    <img src="{{ asset($barang->gambar) }}" class="h-full w-auto rounded shadow-lg">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout-admin>
