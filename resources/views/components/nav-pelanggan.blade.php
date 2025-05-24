{{-- navbar mulai dari siniiii --}}
<div class="flex justify-between items-center pt-2 shadow-md mb-4 sticky top-0 z-40 bg-white">
    <div class="flex justify-center items-center ml-6">
        <img src="images/logoHitam.png" class="w-12 mb-4 h-auto mr-3" alt="">
        <p class="text-md font-semibold w-41 font-serif"> Sewa Kamera Bandar Lampung</p>
    </div>
    <div class="flex justify-center items-center">

        {{-- ini tombol home di navbar pelanggan --}}
        <a href="/beranda" class="mr-11">
            <svg class="w-8 h-8 rounded-md text-gray-600 hover:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
            </svg>
        </a>

        {{-- ini tombol keranjang --}}
        <a href="/keranjang" class="w-8 h-8 mr-11">
            <svg class="w-8 h-8 rounded-md text-gray-600 hover:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
            </svg>
        </a>
        
        {{-- ini tombol profil --}}
        <button id="profile-dropdown-button" data-dropdown-toggle="profile-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 rounded-lg focus:outline-none" type="button">
            <svg class="w-8 h-8 rounded-md text-gray-600 mr-6 hover:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
    <div id="profile-dropdown" class="hidden z-10 w-26 bg-white rounded divide-y divide-gray-100 shadow">
        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
            <li class="hover:bg-gray-200 max-w-screen">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="font-semibold hover:bg-gray-200 py-2 px-2 w-full text-left">Logout</button>
                </form>
            </li>
            <li class="font-semibold hover:bg-gray-200 py-2 px-2 w-full text-left">
                <a href="{{ route('profil.pelanggan') }}">
                    <div>Saya</div>
                </a>
            </li>
        </ul>
    </div>  
</div>
{{-- navbar kelar sampe siniiii --}}