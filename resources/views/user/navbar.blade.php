<nav class="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 backdrop-blur-md bg-opacity-95 fixed w-full z-30 top-0 start-0 border-b border-purple-500/20 shadow-lg shadow-purple-500/10">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-6 py-4">
        <!-- Logo and Brand -->
        <a href="https://flowbite.com/" class="flex items-center space-x-4 rtl:space-x-reverse group">
            <div class="relative">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-10 w-10 transition-transform duration-300 group-hover:rotate-12" alt="Pojok Film Logo">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full blur-md opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
            </div>
                <span class="text-gray-900 text-3xl font-black" style="-webkit-text-stroke: 1.5px white;">
                Pojok Film
                </span>
        </a>

        <!-- Mobile Menu Button -->
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-3 w-12 h-12 justify-center text-sm text-purple-200 rounded-xl md:hidden hover:bg-purple-800/50 focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition-all duration-300 border border-purple-500/30 hover:border-purple-400/50"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-purple-500/30 rounded-2xl bg-slate-800/50 backdrop-blur-sm md:space-x-2 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="{{ route('home') }}"                   
                        class="block py-3 px-6 text-white bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl shadow-lg shadow-purple-500/25 font-semibold transition-all duration-300 hover:shadow-purple-500/40 hover:scale-105"
                        aria-current="page"
                        class="block py-3 px-6 text-purple-100 rounded-xl hover:bg-gradient-to-r hover:from-purple-600/20 hover:to-pink-600/20 hover:text-white transition-all duration-300 hover:scale-105 border border-transparent hover:border-purple-400/30"
                        >Beranda</a>
                </li>
                <li class="relative">
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"                      
                        class="flex items-center justify-between py-3 px-6 text-white bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl shadow-lg shadow-purple-500/25 font-semibold transition-all duration-300 hover:shadow-purple-500/40 hover:scale-105 w-full md:w-auto"
                        aria-current="page"
                        class="flex items-center justify-between w-full py-3 px-6 text-purple-100 rounded-xl hover:bg-gradient-to-r hover:from-purple-600/20 hover:to-pink-600/20 hover:text-white transition-all duration-300 hover:scale-105 md:w-auto border border-transparent hover:border-purple-400/30"
                        >
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            Profil
                        </span>
                        <svg class="w-3 h-3 ms-2 transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar"
                        class="z-20 hidden absolute top-full mt-2 font-normal bg-slate-800/95 backdrop-blur-md divide-y divide-purple-500/20 rounded-xl shadow-2xl shadow-purple-500/20 w-56 border border-purple-500/30">
                        <ul class="py-3 text-sm" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="{{ route('profile.index') }}"
                                    class="flex items-center px-5 py-3 text-purple-100 hover:bg-gradient-to-r hover:from-purple-600/30 hover:to-pink-600/30 hover:text-white transition-all duration-300 rounded-lg mx-2">
                                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                                    </svg>
                                    Lihat Profil
                                </a>
                            </li>
                            <li class="border-t border-purple-500/20 mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-5 py-3 text-red-300 hover:bg-red-600/20 hover:text-red-200 transition-all duration-300 rounded-lg mx-2">
                                        <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownButton = document.getElementById('dropdownNavbarLink');
        const dropdownMenu = document.getElementById('dropdownNavbar');
        const dropdownArrow = dropdownButton.querySelector('svg:last-child');

        dropdownButton.addEventListener('click', function(e) {
            e.preventDefault();
            dropdownMenu.classList.toggle('hidden');
            dropdownArrow.classList.toggle('rotate-180');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
                dropdownArrow.classList.remove('rotate-180');
            }
        });

        // Close dropdown when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                dropdownMenu.classList.add('hidden');
                dropdownArrow.classList.remove('rotate-180');
            }
        });
    });
</script>