<a  class="flex  {{ request()->routeIs($route) ? 'bg-[rgba(191,219,254,.7)] text-blue-700' : '' }} items-center justify-start gap-x-5 px-7 py-2 rounded-tr-3xl rounded-br-3xl hover:bg-gray-200 cursor-pointer">
    {{ $slot }}
    <p class="text-xs font-medium tracking-wide">{{ $text }}</p>
</a>
