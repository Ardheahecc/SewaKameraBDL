<x-layout-admin>
    <x-slot:title>{{$title}}</x-slot:title>

    @if($ulasan->isEmpty())
    <div class="flex flex-col justify-center items-center w-full py-21">
        <img src="{{ asset('images/ulasanKosong.png') }}" alt="" class="w-65 h-auto mb-6">
        <p class="text-md font-semibold text-gray-400">Tidak ada ulasan dari pengguna</p>
    </div>
    @else

    {{-- cuma bentu card biasa yang di loopingg --}}
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-8 lg:px-6"> 
            <div class="grid gap-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2">
                @foreach($ulasan as $item)
                <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md">
                    <div class="flex justify-start items-center mb-5 text-gray-500">
                        <span class="text-sm">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="mb-5 font-semibold text-gray-500 text-sm">{{ Str::limit($item->isi, 65) }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <span class="font-medium text-sm">
                                {{ $item->pelanggan->nama ?? 'Anonim' }}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <form action="{{ route('ulasan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mt-2 mr-2">
                                <svg class="w-6 h-6 text-red-600 hover:text-red-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>
                            </button>
                        </form>
                        <a href="{{ route('ulasan.show', $item->id) }}" class="mt-2">
                            <svg class="w-6 h-6 text-blue-600 hover:text-blue-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach               
            </div>  
        </div>
    @endif  
</x-layout-admin>
