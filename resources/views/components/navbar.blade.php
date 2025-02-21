<nav
    class="bg-white border-b border-gray-200 px-4 md:px-6 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
    <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">
            <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                aria-controls="drawer-navigation"
                class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg aria-hidden="true" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Toggle sidebar</span>
            </button>
            <a href="https://flowbite.com" class="flex items-center justify-between mr-4">
                <img src="/img/profile.png" class="mr-3 h-8 hidden md:block" alt="Task Management Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Task
                    Management</span>
            </a>
        </div>
        <div class="md:w-2/5 lg:1/2">
            <form action="{{ route('tasks.index') }}" method="GET" class="hidden md:block md:pl-2">
                <label for="topbar-search" class="sr-only">Search</label>
                <div class="relative md:w-full ">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                            </path>
                        </svg>
                    </div>
                    <input type="text" name="search" id="topbar-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#3e35d4] focus:border-[#3e35d4] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3e35d4] dark:focus:border-[#3e35d4]"
                        placeholder="Search" autocomplete="off" value="{{ request('search') }}" />
                </div>
            </form>
        </div>
        <div class="flex items-center lg:order-2">
            <button type="button" data-drawer-toggle="drawer-navigation" aria-controls="drawer-navigation"
                class="p-2 mr-1 text-gray-500 rounded-lg md:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                <span class="sr-only">Toggle search</span>
                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                    </path>
                </svg>
            </button>
            {{-- Mode --}}
            <button id="theme-toggle" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700">
                <span id="theme-toggle-light" class="hidden">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5V3m0 18v-2M7.05 7.05 5.636 5.636m12.728 12.728L16.95 16.95M5 12H3m18 0h-2M7.05 16.95l-1.414 1.414M18.364 5.636 16.95 7.05M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
                    </svg>
                </span>
                <span id="theme-toggle-dark">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 21a9 9 0 0 1-.5-17.986V3c-.354.966-.5 1.911-.5 3a9 9 0 0 0 9 9c.239 0 .254.018.488 0A9.004 9.004 0 0 1 12 21Z" />
                    </svg>
                </span>
            </button>
            {{-- Profile --}}
            <button type="button" class="inline-flex items-center mx-3 text-sm font-medium" id="user-menu-button"
                aria-expanded="false" data-dropdown-toggle="dropdown">
                <span class="sr-only">Open user menu</span>
                <span class="text-gray-800 dark:text-gray-50">{{ Auth::user()->name }}</span>
            </button>
            <!-- Dropdown menu -->
            <div class="hidden z-50 w-56 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                id="dropdown">
                <div class="py-3 px-4">
                    <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name
                        }}</span>
                    <span class="block text-sm text-gray-900 truncate dark:text-white">{{ Auth::user()->email
                        }}</span>
                </div>
                <ul aria-labelledby="dropdown">
                    <li>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" class="hover:rounded-b-xl" onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script>
        const themeToggle = document.getElementById("theme-toggle");
        const lightIcon = document.getElementById("theme-toggle-light");
        const darkIcon = document.getElementById("theme-toggle-dark");
    
        // Cek apakah user sudah menyimpan preferensi tema
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add("dark");
            darkIcon.classList.add("hidden");
            lightIcon.classList.remove("hidden");
        } else {
            document.documentElement.classList.remove("dark");
            lightIcon.classList.add("hidden");
            darkIcon.classList.remove("hidden");
        }
    
        // Toggle dark mode saat tombol ditekan
        themeToggle.addEventListener("click", () => {
            document.documentElement.classList.toggle("dark");
            if (document.documentElement.classList.contains("dark")) {
                localStorage.setItem("theme", "dark");
                darkIcon.classList.add("hidden");
                lightIcon.classList.remove("hidden");
            } else {
                localStorage.setItem("theme", "light");
                lightIcon.classList.add("hidden");
                darkIcon.classList.remove("hidden");
            }
        });
    </script>
</nav>