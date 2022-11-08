@extends('layouts.master')
@section('content')
    <main class="w-[full] pb-10">
        <div class="flex flex-col w-full ">
            {{-- header --}}
            <div class="flex justify-between border-b-2 w-full  items-center py-3 pl-4">
                <div class="flex">
                    <div class="flex items-baseline gap-x-4 cursor-pointer">
                        <p class="font-medium">My Drive</p>
                        <img src={{ asset('images/downward-arrow.png') }} class="h-3 w-3 -rotate-90 object-cover" />
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ $folder->folderName }}</p>
                    </div>
                </div>
                {{-- new file create --}}

                <form action="{{ route('file.store') }}" id = "formInput" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" multiple   name="fileName[]" class="hidden" id = "fileInput">
                    <input type="number" class = "hidden" name = "id" value = "{{ $folder->id }}">
                </form>
                <form action="{{ route('file.store') }}" id="formInput" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" multiple name="fileName[]" class="hidden" id="fileInput">
                    <input type="number" class="hidden" name="id">
                </form>
                <div class="flex gap-x-4">
                    <div class="" id = "fileCreateBtn">
                        <x-foldercreate/>
                    </div>
                    <div class="flex " id="fileCreateBtn">
                        <div class="flex gap-x-2">
                            <button id="trashBtn">
                                <img src="{{ asset('images/png/recycle-bin.png') }}" class="w-5 h-5" />
                            </button>


                            <form id="mainForm" method="POST" class="hidden">
                                @csrf
                            </form>
                            <form id="deleteForm" method="POST" class="hidden">
                                @csrf
                                @method('delete')
                            </form>
                        {{-- drop down button --}}
                        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                            class="
                        focus:bg-slate-200 rounded-[100%] py-1 px-1
                        "
                            type="button">
                            <img src="{{ asset('images/png/menu.png') }}" class="w-5 h-5" />
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownDivider"
                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                            data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                            bis_skin_checked="1"
                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 9.90099px, 0px);">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDividerButton">
                                <x-dropdowns text="Copy" id="copy" add="mt-2">
                                    <img src="{{ asset('images/png/copy.png') }}" class="w-4 h-4" alt="">
                                </x-dropdowns>
                        </div>
                        </div>

                    </div>

                </div>

            </div>
            {{-- header end --}}
            @if(count($folder->files) >= 1)



                {{-- file section start --}}

                <div class="flex flex-col pl-5 pt-3">
                    <div class="font-medium">
                        <p>Files</p>
                    </div>

                    <div class="flex flex-wrap gap-x-8 gap-y-5 pl-10 mt-5">
                        @forelse ($folder->files as $file)
                            <div class="relative">
                                 <button
                                class="w-60 h-60 border fileSelect flex flex-col items-center text-xs font-medium  rounded-md group">
                                <input type="checkbox" name="files[]" class="hidden" form="mainForm"
                                    value="{{ $file->id }}">
                                <div class="h-[85%] border w-full flex overflow-hidden items-center justify-center">
                                    <a class="venobox my-image-links " id="veno">
                                        <img src="{{ asset('images/png/002-pdf.png') }}"
                                            class="w-14 indicate h-14 mr-4 object-cover text-gray-500 "
                                            id="{{ $file->filePath }}" alt="" />
                                    </a>
                                </div>
                                <div class="flex items-center pl-3 h-[15%] w-full">

                                    <img src="{{ asset('images/png/002-pdf.png') }}" id="{{ $file->fileName }}"
                                        class="w-4 h-4 mr-4 indicates text-gray-500 " alt="" />


                                    <p class="tracking-tighter">{{ Str::limit($file->fileName ,20,'...')}}</p>
                                </div>
                            </button>
                            <form action = "{{ route('download',$file->id) }}"
                                class="absolute bottom-0 right-2"
                                method="GET">
                                @csrf
                                <button>
                                    <img src = "{{ asset('images/png/download.png') }}" class="w-5 h-5"/>
                                </button>
                            </form>
                            </div>

                        @empty
                            <p>There is no files yet</p>
                        @endforelse
                    </div>

                </div>
            @else
                <div class="flex flex-col items-center pt-16 col w-full">
                    <div class="">
                        <lottie-player src="{{ asset('images/25943-nodata.json') }}" background="transparent"
                            speed="1" style="width: 400px; height: 400px;" loop autoplay></lottie-player>
                    </div>
                    <p class="font-Bebas font-2xl">There is no Files or Folder here</p>
                </div>
            @endif

            {{-- file section end --}}
        </div>
    </main>
@endsection



@push('script')
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        const fileInput = document.getElementById('fileInput');
        const formInput = document.getElementById('formInput');
        const fileCreateBtn = document.getElementById('fileCreateBtn');

        fileCreateBtn.addEventListener('click',()=>{
            fileInput.click();
            fileInput.addEventListener('change',()=>{
                formInput.submit();
            })
        })

        const iconimages = document.querySelectorAll('.indicates');
            const images = document.querySelectorAll('.indicate');

            const fileSelect = document.querySelectorAll('.fileSelect');
            const fileCreate = document.getElementById('fileCreateBtn');
            const formshow = document.getElementById('formshow');
            const trashBtn = document.getElementById('trashBtn');
            const fileDelete = document.getElementById('fileDelete');
            const veno = document.getElementById('veno');
            const mainForm = document.getElementById('mainForm');
             const copy = document.getElementById('copy');
             const deleteForm = document.getElementById('deleteForm');



            // for file actions
            fileSelect.forEach((file, index) => {
                const input = file.children[0]
                const bgdiv = file.children[2];
                file.addEventListener('click', (e) => {
                    fileCreate.style.display = "inline"

                    stats = input.checked
                    input.checked = !stats

                    if (input.checked) {
                        bgdiv.style.background = "#808080";
                    } else {
                        bgdiv.style.background = "#fff";
                    }

                    console.log(input.checked)
                    trashBtn.addEventListener('click', () => {
                        deleteForm.setAttribute('action','{{ route('bulkDelete',["delete" => "soft"] )}}')
                        input.setAttribute('form','deleteForm');
                        deleteForm.submit();
                    })
                    copy.addEventListener('click', () => {
                        mainForm.setAttribute('action','{{ route('bulkCopy') }}')
                        input.setAttribute('form','mainForm');
                        mainForm.submit();
                    })
                })

            })
            // Icons image distinguished based on extension
            iconimages.forEach((image, index) => {
                name = image.id;

                regex = new RegExp('[^.]+$');
                extension = name.match(regex);
                extension = extension[0];
                switch (extension) {
                    case 'mp4':
                        image.src = "{{ asset('images/png/004-video.png') }}"
                        break;
                    case 'png':
                    case 'jpg':
                        image.src = "{{ asset('images/png/image.png') }}"
                        break;
                    case 'txt':
                        image.src = "{{ asset('images/png/txt-file.png') }}"
                        break;
                    case 'zip':
                        image.src = "{{ asset('images/png/zip.png') }}"
                        break;
                    case 'rar':
                        image.src = "{{ asset('images/png/rar.png') }}"
                        break;
                    default:
                        image.src = "{{ asset('images/png/google-docs.png') }}"
                        break;
                }

            });

            images.forEach((image, index) => {
                name = image.id;
                console.log(name);
                regex = new RegExp('[^.]+$');
                extension = name.match(regex);
                extension = extension[0];
                switch (extension) {
                    case 'mp4':
                        image.src = "{{ asset('images/png/004-video.png') }}"
                        break;
                    case 'png':
                    case 'jpg':
                        image.src = `{{ asset('storage/' . '${image.id}') }}`
                        image.parentElement.setAttribute('href',
                            `{{ asset('storage/' . '${image.id}') }}`)
                        image.style.height = "95%"
                        image.style.width = "100%"
                        image.style.objectFit = "cover"
                        image.parentElement.style.padding = "0px 10px"

                        break;
                    case 'txt':
                        image.src = "{{ asset('images/png/txt-file.png') }}"
                        break;
                    case 'zip':
                        image.src = "{{ asset('images/png/zip.png') }}"
                        break;
                    case 'rar':
                        image.src = "{{ asset('images/png/rar.png') }}"
                        break;
                    default:
                        image.src = "{{ asset('images/png/google-docs.png') }}"
                        break;
                }

            });
    })


    </script>
@endpush
