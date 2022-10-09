@props(['footer' => 'with'])
<!doctype html>
<head>
    <title>Laravel From Scratch Blog</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    {{ $script ?? null }}
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>
<body style="font-family: Open Sans, sans-serif">
    
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/" class="text-xs font-bold uppercase px-5">
                    Home
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @auth
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="text-xs font-bold uppercase px-5">Welcome, {{ auth()->user()->name }}</button>
                        </x-slot>
                        <x-dropdown-item href="{{ route('profile') }}" :active="request()->routeIs('profile')">Profile</x-dropdown-item>
                        <x-dropdown-item href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">Posts</x-dropdown-item>
                            @can('admin')
                            <x-dropdown-item href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">Users</x-dropdown-item>
                            <x-dropdown-item href="{{ route('permissions.index') }}" :active="request()->routeIs('permissions.index')">Permissions</x-dropdown-item>
                            <x-dropdown-item href="{{ route('roles.index') }}" :active="request()->routeIs('roles.index')">Roles</x-dropdown-item>
                            @endcan

                        <x-dropdown-item href="#" x-data={}
                            @click.prevent="document.querySelector('#logout-form').submit()">Log out</x-dropdown-item>
                    </x-dropdown>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        class="text-xs font-semibold text-blue-500">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('register') }}" class="text-xs font-bold uppercase">Register</a>
                    <a href="{{ route('login') }}" class="text-xs font-bold uppercase py-3 px-5">
                        Login
                    </a>
                @endauth
                <a href="#newsletter"
                    class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">Subscribe
                    for Updates</a>
            </div>
        </nav>
        {{ $slot }}
        @if($footer == 'with')
            <footer id="newsletter"
                class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
                <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
                <h5 class="text-3xl">Stay in touch with the latest posts</h5>
                <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>
    
                <div class="mt-10">
                    <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">
    
                        <form method="POST" action="{{ route('newsletter.signup') }}" class="lg:flex text-sm">
                            @csrf
                            <div class="lg:py-3 lg:px-5 flex items-center">
                                <label for="email" class="hidden lg:inline-block">
                                    <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                                </label>
                                <input id="email" type="text" name="email" placeholder="Your email address"
                                    class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                                @error('email')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <button type="submit"
                                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </footer>
        @endif
    </section>
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="fixed bottom-3   right-3 bg-blue-500 text-white py-2 px-4 rounded-xl">
            <p>{{ session('success') }}</p>
        </div>
    @endif
</body>
