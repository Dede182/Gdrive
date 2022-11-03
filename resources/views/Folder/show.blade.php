@extends('layouts.master')
@section('content')
    <main class="w-[full] pb-10">
        <div class="flex flex-col w-full ">
            {{-- header --}}
            <div class="flex border-b-2 w-full  items-center py-3 pl-4">
                <div class="flex items-baseline gap-x-4 cursor-pointer">
                    <p class="font-medium">My Drive</p>
                    <img src={{ asset('images/downward-arrow.png') }} class="h-3 w-3 -rotate-90 object-cover" />
                </div>
                <div class="ml-3">
                    <p class="font-medium">{{ $folder->folderName }}</p>
                </div>
            </div>
            {{-- header end --}}
            {{-- file section start --}}

            <div class="flex flex-col pl-5 pt-3">
                <div class="font-medium">
                    <p>Files</p>
                </div>

                <div class="flex flex-wrap gap-x-8 gap-y-5 pl-10 mt-5">
                    @forelse ($folder->files as $file)

                        <button
                            class="w-60 h-60 border flex flex-col items-center text-xs font-medium  rounded-md group">

                            <div class="h-[85%] border w-full flex items-center justify-center">
                                <img src="{{ asset('images/png/002-pdf.png') }}"
                                id = "{{ $file->fileName }}"
                                class="w-14 h-14 mr-4 indicate text-gray-500 " alt=""/>
                            </div>
                            <div class="flex items-center pl-3 h-[15%]  group-hover:bg-gray-300 w-full">
                                <img src="{{ asset('images/png/002-pdf.png') }}"
                                id = "{{ $file->fileName }}"
                                class="w-4 h-4 mr-4 indicate text-gray-500 " alt=""/>
                                <p class="tracking-tighter">{{ $file->fileName }}</p>


                            </div>
                        </button>

                    @empty
                    <div class="w-full flex justify-center item-center">

                        <div class="flex flex-col">
                            <p class="font-medium text-lg">This Folder is empty</p>
                        </div>

                    </div>
                    @endforelse
                </div>

            </div>

            {{-- file section end --}}
        </div>
    </main>
@endsection



@push('script')
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const images = document.querySelectorAll('.indicate');
        images.forEach((image,index) => {
            name = image.id;

            regex = new RegExp('[^.]+$');
            extension = name.match(regex);
            extension = extension[0];
            switch(extension){
                case 'mp4' :
                image.src = "{{ asset('images/png/004-video.png') }}"
                break;
                case 'png':
                case 'jpg':
                    image.src =  "{{ asset('images/png/image.png') }}"
                break;
                case 'txt' :
                image.src =  "{{ asset('images/png/txt-file.png') }}"
                break;
                case 'zip' :
                image.src =  "{{ asset('images/png/zip.png') }}"
                break;
                case 'rar' :
                image.src =  "{{ asset('images/png/rar.png') }}"
                break;
                default:
                image.src =  "{{ asset('images/png/google-docs.png') }}"
            }

        });

    })
    </script>
@endpush
