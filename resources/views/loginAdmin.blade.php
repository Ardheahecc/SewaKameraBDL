<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>

  {{-- login doang, simple --}}

    <div class="grid grid-cols-2 grid-rows-1 gap-4 mt-14">
        <div class="col-span-2">    
            <div class="grid grid-cols-2 grid-rows-1 gap-4 p-2 bg-blue-900 rounded-lg">
                <div class="bg-blue-900 flex flex-col items-center justify-center">
                    <img src="/images/logoPutih.png" alt="" class="w-35 h-auto mb-2">
                    <p class="text-lg font-semibold font-serif text-center max-w-46 text-white">Sewa Kamera Bandar Lampung</p>
                </div>
                <div class="bg-white rounded-lg">
                    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-106 lg:py-0">
                        <div class="w-full md:mt-0 sm:max-w-md xl:p-0 ">
                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                @if ($errors->any())
                                    <div class="text-red-500 text-sm mb-4">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <form class="space-y-4 md:space-y-6" action="{{ route('admin.login') }}" method="POST">
                                    @csrf
                                    <div>
                                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="username" required="" autocomplete="off">
                                    </div>
                                    <div>
                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " required="" autocomplete="off">
                                    </div>
                                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center">
        <p class="text-gray-400">
            Project Implementasi dan Evaluasi SI, Smt 6.
        </p>
    </div>

    
    
</x-layout>
