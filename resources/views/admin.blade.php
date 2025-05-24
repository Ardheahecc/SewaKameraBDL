<x-layout-admin>
    <x-slot:title>{{$title}}</x-slot:title>

{{-- form untuk nambahin adminnn --}}
        <div class="py-8 px-4 mx-2 max-w-screen-xl mb-4 mt-6 lg:py-4 p-3 bg-white rounded-lg border border-gray-200 shadow-md w-ful">
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="flex justify-between">
                    <h2 class="text-xl font-bold text-gray-900">Tambahkan admin baru</h2>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200">
                        Simpan
                    </button>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="username" class="block mb-1 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Username" required="" autocomplete="off">
                    </div>
                    <div class="w-full">
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Email" required="" autocomplete="off">
                    </div>
                    <div class="w-full">
                        <label for="password" class="block mb-1 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Password" required="" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
{{-- form untuk nambahin adminnn kelar sampe sinii--}}


{{-- tabel daftar admin mulai dari siniii --}}
    <div class="mx-auto max-w-screen-xl px-2">
            <div class="overflow-x-auto bg-white">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">Username</th>
                            <th scope="col" class="px-4 py-3">email</th>
                            <th scope="col" class="px-4 py-3">Tanggal daftar</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admin as $i => $admin)
                        <tr class="border-b border-gray-300">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $i + 1 }}</th>
                            <td class="px-4 py-3">{{ $admin->id }}</td>
                            <td class="px-4 py-3">{{ $admin->username }}</td>
                            <td class="px-4 py-3">{{ $admin->email }}</td>
                            <td class="px-4 py-3">{{ $admin->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 flex items-center justify-end ">
                                <button id="{{ $i }}-dropdown-button" data-dropdown-toggle="{{ $i }}-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="{{ $i }}-dropdown" class="hidden z-10 w-26 bg-white rounded divide-y divide-gray-100 shadow">
                                    <div class="hover:bg-gray-200 max-w-screen">
                                        <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?');">
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
{{-- tabel daftar admin kelar sampee siniii --}}

</x-layout-admin>
