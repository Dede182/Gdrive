@extends('layouts.master')
@section('content')
    <main class="w-[full]">
        <div class="flex flex-col w-full ">
            {{-- header --}}
            <div class="flex border-b-2 w-full  items-center py-3 pl-4">
                <div class="flex items-baseline gap-x-4 cursor-pointer">
                    <p class="font-medium">My Drive</p>
                    <img src={{ asset('images/downward-arrow.png') }} class="h-3 w-3 object-cover" />

                </div>
            </div>
            {{-- header end --}}


            {{-- folder section start --}}

            <div class="flex flex-col pl-5 pt-3">

                <div class="font-medium">
                    <p>Folders</p>
                </div>

                <div class="flex flex-wrap gap-x-8 gap-y-5 pl-5 mt-5">

                    @forelse ($user->folders as $folder)
                        <button
                            class="w-60 h-10 border flex items-center text-xs font-medium pl-3 rounded-md
                    focus:bg-blue-300 focus:text-blue-800 focus:border-2 focus:border-blue-400">
                            <img src="{{ asset('images/folder.svg') }}" class="w-5 h-5 mr-4 text-gray-500" alt="">
                            <p class="tracking-tighter">{{ $folder->folderName }}</p>
                        </button>

                    @empty
                    @endforelse
                </div>
            </div>

            {{-- folder section end --}}


            {{-- file section start --}}

            <div class="flex flex-col pl-5 pt-3">
                <img src="https://picsum.photos/id/2/200/300" class="w-20 h-20"/>
                <div class="font-medium">
                    <p>Folders</p>
                </div>

                <div class="flex flex-wrap gap-x-8 gap-y-5 pl-5 mt-5">
                    @forelse ($user->gfile as $file)

                        <button
                            class="w-60 h-60 border flex flex-col items-center text-xs font-medium  rounded-md group">

                            <div class="h-[85%] border w-full flex items-center justify-center">
                                <img src="{{ asset('images/png/002-pdf.png') }}" class="w-14 h-14 mr-4 text-gray-500 " alt=""/>
                            </div>
                            <div class="flex items-center pl-3 h-[15%]  group-hover:bg-gray-300 w-full">
                                <img src="{{ asset('images/png/002-pdf.png') }}" class="w-4 h-4 mr-4 text-gray-500 " alt=""/>
                                <p class="tracking-tighter">{{ $file->fileName }}</p>


                            </div>
                        </button>

                    @empty
                    @endforelse
                </div>

            </div>

            {{-- file section end --}}
        </div>
    </main>
@endsection
