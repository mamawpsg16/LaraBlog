<header class="max-w-xl mx-auto mt-20 text-center">
    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
        <!--  Category -->
        <div class="relative flex lg:inline-flex items-center rounded-xl">
           <x-category-dropdown />
        </div>


        <!-- Search -->
        {{-- GET CURRENTLY QUERYSTRING IN URL --}}
        {{-- request()->getQueryString --}}
        <div class="relative flex lg:inline-flex items-center rounded-xl px-3 py-2">
            <form method="GET" >
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
               <input
                 class="bg-transparent border border-gray-300 p-2 rounded-lg placeholder-black font-semibold text-sm"
                 name="search"
                 placeholder="Find something"
                 type="text"
                 value="{{ request('search') }}"
               >
            </form>
        </div>
    </div>
</header>
