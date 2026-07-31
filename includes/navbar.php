    <nav class="bg-custom-teal text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-white p-2 rounded-full cursor-pointer" onclick="showSection('dashboard')">
                    <i class="fas fa-paw text-custom-teal text-2xl"></i>
                </div>
                <span class="text-2xl font-bold tracking-wider cursor-pointer" onclick="showSection('dashboard')">VetTrack</span>
            </div>
            <div class="hidden md:flex gap-8 font-medium items-center">
                <a href="#" onclick="showSection('dashboard')" class="hover:text-orange-400">Dashboard</a>
                <a href="#" onclick="showSection('registration')" class="hover:text-orange-400">Registration</a>
                <a href="#" onclick="showSection('consultation')" class="hover:text-orange-400">Consultation</a>
                <a href="#" onclick="showSection('vaccination')" class="hover:text-orange-400">Vaccination</a>

                <div class="dropdown relative">
                    <button class="flex items-center gap-2 hover:text-orange-400 transition outline-none py-2">
                        Management <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="dropdown-menu shadow-xl border border-gray-100">
                        <a href="#" onclick="showSection('retrieval')"><i class="fas fa-database mr-2 w-5"></i> Data Retrieval</a>
                        <a href="#" onclick="showSection('staff')"><i class="fas fa-users-cog mr-2 w-5"></i> Staff Management</a>
                        <a href="#" onclick="showSection('activity')"><i class="fas fa-history mr-2 w-5"></i> Activity Log</a>
                    </div>
                </div>

                <a href="#" onclick="showSection('about')" class="hover:text-orange-400">About</a>
            </div>

            <div class="relative">
                <button onclick="toggleProfileMenu()" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 p-2 rounded-full transition outline-none border border-white/20">
                    <i class="fas fa-user-circle text-2xl"></i>
                </button>
                <div id="profile-dropdown" class="dropdown-menu right-0 mt-2 shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-4 py-3 bg-gray-50 border-b">
                        <p class="text-sm font-bold text-custom-teal">Dr. Alex Reyes</p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold">Chief Administrator</p>
                    </div>
                    <a href="#"><i class="fas fa-user-edit mr-2 text-xs"></i> Edit Profile</a>
                    <a href="#" class="text-red-600 hover:bg-red-50"><i class="fas fa-sign-out-alt mr-2 text-xs"></i> Log out</a>
                </div>
            </div>
        </div>
    </nav>

