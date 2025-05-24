<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <link rel="stylesheet" href="./node_modules/apexcharts/dist/apexcharts.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body>

  {{-- bagian paling atas, bekgron gambar kamera --}}
    <div class=" bg-cover mb-5 text-white flex justify-between" style="background-image: url('/images/bannerWelcome.png'); height: 400px">
        <div>
            <p class="text-5xl font-semibold ml-6 p-2 max-w-135 shadow-xl leading-16 mb-2 font-serif">Sewa Kamera Bandar Lampung</p>
            <p class="text-2xl p-2 ml-6 max-w-155">Temukan berbagai pilihan kamera terbaik untuk abadikan momen spesialmu dengan mudah dan terpercaya.</p>
        </div>
        <div class="flex flex-col items-center justify-center max-w-screen-xl mr-56">
          {{-- tombol daftar ama login disinii --}}
            <button  onclick="toggleModal()" type="button" class=" text-black bg-yellow-300 hover:bg-black hover:text-yellow-300 hover:border-2 hover:border-yellow-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-66 py-2.5 mb-6">Daftar</button>
            <button  onclick="toggleModal2()" type="button" class="text-black bg-yellow-300 hover:bg-black hover:text-yellow-300 hover:border-2 hover:border-yellow-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-66 py-2.5 mb-6">Login</button>
        </div>
    </div>
  {{-- bagian paling atas, bekgron gambar kamera --}}

    <hr class="text-gray-400 mx-15 mb-5">

    {{-- bagian katalog produk --}}
    <div class="mb-5">
        <div class="mx-6 flex flex-col items-center">
            <p class="text-lg font-semibold mb-4">Properti kami</p>
            <div class="grid gap-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 mx-6">
                @foreach($barang as $item)
                <article class="bg-white rounded-lg border border-gray-200 shadow-md">
                    <div class="flex justify-center items-center">
                        <img src="{{ asset($item->gambar) }}" alt="" class="w-auto h-46 rounded-t-lg">
                    </div>
        
                    <div class="p-6">
                        <p class="text-lg font-semibold">{{ $item->nama }}</p>
                        <p class="text-md font-light mb-4">{{ $item->tipe }}</p>
                        <p class="text-md">Rp {{ number_format($item->harga_sewa_24_jam) }} /24 jam</p>
                        <p class="text-md">Rp {{ number_format($item->harga_sewa_12_jam) }} /12 jam</p>
                        <p class="text-md">Rp {{ number_format($item->harga_sewa_6_jam) }} /6 jam</p>
                    </div>
                </article>
                @endforeach                 
            </div>
        </div>
    </div>
    {{-- bagian katalog produk end--}}


    {{-- bagian sop --}}
    <hr class="text-gray-400 mx-15 mb-6">

    <div class="mx-12 mb-4">
      <p class="text-lg font-semibold mb-4">Syarat dan Ketentuan Penyewaan</p>
      <ul class="list-decimal mx-11 font-serif">
        <li>
          <p class="text-md mb-2">Menyerahkan minimal 2 identitas yang masih BERLAKU, seperti KTP, KK, SIM, Ijazah, KTM, Kartu Pelajar</p>
        </li>
        <li>
          <p class="text-md mb-2">Bersedia mengisi surat pernyataan peminjaman kamera</p>
        </li>
        <li>
          <p class="text-md mb-2">Pembayaran dilakukan di awal peminjaman</p>
        </li>
        <li>
          <p class="text-md mb-2">Segala kehilangan dan kerusakan ditanggung oleh penyewa</p>
        </li>
        <li>
          <p class="text-md mb-2">Kamera wajib dicek saat pengambilan dan pengembalian</p>
        </li>
        <li>
          <p class="text-md mb-2">Pengembalian kamera harus tepat waktu, apabila terlambat maka akan dikenakan denda sebesar Rp 15.000/jam</p>
        </li>
      </ul>
    </div>
    <hr class="text-gray-400 mx-15 mb-6">
    {{-- bagian sop --}}



    <x-footer></x-footer>


{{-- 2 form di bawah ini hidden, cuma bakal muncul pas tombol daftar atau login yang diatas tadi dipencet --}}


{{-- form registrasiiiii --}}
    <div id="registerModal" class="fixed inset-0 bg-gray-800/50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-165 relative">
          
          <!-- Tombol Close -->
          <button onclick="toggleModal()" class="absolute top-2 right-2 text-gray-500 hover:text-black">
            &times;
          </button>
      
          <h2 class="text-2xl font-semibold mb-4">Registrasi Pengguna</h2>
          <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="flex flex-row justify-center max-w-screen">
              <div class="mr-4 w-full">
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                  <input type="text" name="nama" class="w-full border rounded px-3 py-2" required autocomplete="off">
                </div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                  <input type="email" name="email" class="w-full border rounded px-3 py-2" required autocomplete="off">
                </div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                  <input type="password" name="password" class="w-full border rounded px-3 py-2" required autocomplete="off">
                </div>
              </div>
              <div class="ml-4 w-full">
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">No Hp</label>
                  <input type="number" name="no_hp" class="w-full border rounded px-3 py-2" required autocomplete="off">
                </div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                  <input type="text" name="alamat" class="w-full border rounded px-3 py-2" required autocomplete="off">
                </div>
              </div>
            </div>
            <button type="submit" class="text-black bg-yellow-300 hover:bg-black hover:text-yellow-300 hover:border-2 hover:border-yellow-300 px-4 py-2 rounded-md w-full">
              Daftar
            </button>
          </form>
        </div>
      </div>
{{-- form registrasiiiii kelar disini--}}

{{-- form loginnn --}}
    <div id="loginModal" class="fixed inset-0 bg-gray-800/50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
          
          <!-- Tombol Close -->
          <button onclick="toggleModal2()" class="absolute top-2 right-2 text-gray-500 hover:text-black">
            &times;
          </button>
      
          <h2 class="text-2xl font-semibold mb-4">Login Pengguna</h2>
          @if ($errors->any())
              <div class="text-red-500 text-sm mb-4">
                  @foreach ($errors->all() as $error)
                      <p>{{ $error }}</p>
                  @endforeach
              </div>
          @endif
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
              <input type="text" name="nama" class="w-full border rounded px-3 py-2" required autocomplete="off">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <input type="password" name="password" class="w-full border rounded px-3 py-2" required autocomplete="off">
            </div>
            <button type="submit" class="text-black bg-yellow-300 hover:bg-black hover:text-yellow-300 hover:border-2 hover:border-yellow-300 px-4 py-2 rounded-md w-full">
              Login
            </button>
          </form>
        </div>
      </div>
{{-- form loginnn kelar disini--}}



    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script>
        function toggleModal() {
          const modal = document.getElementById('registerModal');
          modal.classList.toggle('hidden');
        }
        function toggleModal2() {
          const modal = document.getElementById('loginModal');
          modal.classList.toggle('hidden');
        }
    </script>
</body>
</html>
