
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation"
         class="flex items-center justify-between">

        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm text-gray-400 bg-white border rounded-md">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-4 py-2 text-sm text-gray-700 bg-white border rounded-md hover:bg-gray-50">
                    Previous
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-4 py-2 text-sm text-gray-700 bg-white border rounded-md hover:bg-gray-50">
                    Next
                </a>
            @else
                <span class="px-4 py-2 text-sm text-gray-400 bg-white border rounded-md">
                    Next
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:items-center sm:justify-between w-full">
            <p class="text-sm text-gray-700">
                Menampilkan {{ $paginator->firstItem() }}
                sampai {{ $paginator->lastItem() }}
                dari {{ $paginator->total() }} data
            </p>

            <div class="flex gap-1">
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-2 text-sm text-gray-400 bg-white border rounded-md">
                        &laquo;
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-2 text-sm text-gray-700 bg-white border rounded-md hover:bg-gray-100">
                        &laquo;
                    </a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-3 py-2 text-sm text-gray-400">
                            {{ $element }}
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3 py-2 text-sm text-white bg-indigo-600 border border-indigo-600 rounded-md">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   class="px-3 py-2 text-sm text-gray-700 bg-white border rounded-md hover:bg-gray-100">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-2 text-sm text-gray-700 bg-white border rounded-md hover:bg-gray-100">
                        &raquo;
                    </a>
                @else
                    <span class="px-3 py-2 text-sm text-gray-400 bg-white border rounded-md">
                        &raquo;
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
