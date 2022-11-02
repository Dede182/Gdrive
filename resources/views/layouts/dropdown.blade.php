

<div id="dropdown"
class=" absolute z-10 w-60  bg-white rounded ">
<ul class="text-sm divide-y-2  pb-7 text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
    <li class="flex items-center mt-4 pb-3  pl-4 gap-x-3">
        <x-foldercreate/>
        <a href="#"
            class="text-black">New Folder</a>
    </li>

    <div class="">
        <li class="flex items-center  pl-4 mt-2 gap-x-3 ">
            <x-folder-upload/>
            <a href="#"
                class="text-black">File upload</a>
        </li>
        <li class="flex items-center  pl-4 mt-2 gap-x-3">
            <x-foldercreate/>
            <a href="#"
                class="text-black">Folder upload</a>
        </li>
    </div>

</ul>
</div>
</div>


