<div class="pt-5">
    <div class="flex flex-col border-b-2 border-b-gray-300  pb-2">
        <div class="flex flex-col items-start justify-start px-7">
            <div class="relative">
                <button id="multiLevelDropdownButton" data-dropdown-toggle="dropdown"
                    class="px-4 pr-16 py-3  flex hover:brightness-95 items-center bg-white shadow-md rounded-3xl justify-center     "
                    type="button">
                    <x-gplus />
                    <p class="text-md font-semibold  pl-3">New</p>
                </button>
                <div id="dropdown" class="hidden z-10 !-top-14 !left-3  w-60  bg-white rounded-lg ">
                    <ul class="text-sm divide-y-2  pb-4 text-gray-700 dark:text-gray-200"
                        aria-labelledby="multiLevelDropdownButton">
                        <form action="{{ route('folder.store') }}" id="folderForm" method="POST">
                            @csrf
                            <input type="text" class="hidden" id="folderName" name="folderName">
                        </form>
                       <x-dropdowns text="New Folder" id="folderCreate" add="mt-3 mb-3">
                        <x-foldercreate />
                       </x-dropdowns>

                        <div class="">
                            <form action="{{ route('file.store') }}"
                            enctype="multipart/form-data"
                            id="fileForm" method="POST">
                                @csrf
                                <input type="file" class="hidden" id="fileName" name="fileName[]" multiple/>
                            </form>
                            <x-dropdowns text="File Upload" id="fileUpload" add="mt-4">
                                <x-folder-upload />
                            </x-dropdowns>

                            <form action="{{ route('folder.upload') }}"
                            enctype="multipart/form-data"
                            id="folderUploadForm" method="POST">
                                @csrf
                                <input type="text" name = "originalFolderName" hidden value = "" id = "originalFolderName" />
                                <input type="file" name = "folders[]" class="hidden" id="folderUpload"  webkitdirectory directory multiple/>
                            </form>

                               <x-dropdowns text="Folder Upload" id="folderUploadIcon" add="mt-2">
                                <x-foldercreate />
                               </x-dropdowns>
                        </div>

                    </ul>
                </div>
            </div>
            <!-- Dropdown menu -->

        </div>
    </div>
    <div class="flex mt-5 flex-col gap-y-2 pr-3">
        <x-sideItem text="My Drive" route="dashboard">
            <x-gdrive />
        </x-sideItem>

        <x-sideItem text="Computers">
            <x-gcomputer />

        </x-sideItem>

        <x-sideItem text="Shared with me">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-5 h-5 ">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
        </x-sideItem>

        <x-sideItem text="Recent">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

        </x-sideItem>

        <x-sideItem text="starred">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
            </svg>
        </x-sideItem>

        <x-sideItem text="Trash">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>

        </x-sideItem>

    </div>
    <div class="flex flex-col mt-2">
        <div class="">
            <x-sideItem text="Storage">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" />
                </svg>
            </x-sideItem>
        </div>
        <div class="pl-7 mt-3 flex flex-col">

            <div class="w-[90%] bg-gray-400 rounded-full h-1.5" bis_skin_checked="1">
                {{-- <div class="bg-blue-300 bg-opacity-70 h-1.5 rounded-full" style="width: 45%" bis_skin_checked="1"></div> --}}
            </div>
            <p class="text-xs text-gray-700 mt-3 font-medium">138.8 MB of 15 GB used</p>
        </div>
        <div class="pl-7 w-fit mt-3 cursor-pointer">
            <div class="px-4 py-1 rounded-lg hover:bg-gray-200 border-2 text-md text-blue-600 font-medium">
                <p>Buy storage</p>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
            document.addEventListener('DOMContentLoaded', () => {
              const folderName = document.getElementById('folderName');
              const folderForm = document.getElementById('folderForm');
              const folderCreate=  document.getElementById('folderCreate');
              const fileUpload=  document.getElementById('fileUpload');
              const fileForm=  document.getElementById('fileForm');
              const fileName=  document.getElementById('fileName');

              const folderUpload=  document.getElementById('folderUpload');
              const folderUploadForm=  document.getElementById('folderUploadForm');
              const folderUploadIcon=  document.getElementById('folderUploadIcon');
              const originalFolderName=  document.getElementById('originalFolderName');


              folderCreate.addEventListener('click',()=>{
                inputBox(folderForm,folderName);
              })

              fileUpload.addEventListener('click',()=>{
                fileName.click();
                fileName.addEventListener('change',()=>{
                    fileForm.submit();
                    });
                })


              folderUploadIcon.addEventListener('click',()=>{
                    folderUpload.click();
                    folderUpload.addEventListener('change',(e)=>{
                        // console.log(e)
                        const folder = e.target.files[0].webkitRelativePath.substring(0,e.target.files[0].webkitRelativePath.indexOf('/'));
                        originalFolderName.value = folder;
                        console.log(originalFolderName.value)

                        folderUploadForm.submit();
                    })
              })

        });
    </script>
@endpush
