<?php
/**
 * VetTrack - Data Retrieval Page
 */
?>
    <!-- ============================= -->
    <!-- RETRIEVAL SECTION -->
    <!-- ============================= -->
    <section id="retrieval" class="section">
        <!-- Retrieval Cards -->
        <div id="retrieval-cards" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow border-l-4 border-custom-teal">
                <h3 class="font-bold mb-2 text-2xl">Animal and Case Records</h3>
                <p class="text-sm text-gray-500 mb-4">View consultation statistics, disease trends, species distribution, and analytical reports generated from submitted consultation records.</p>
                <button onclick="openStatsView()" class="text-custom-teal text-sm font-bold">View Statistics →</button>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border-l-4 border-custom-orange">
                <h3 class="font-bold mb-2 text-2xl">Vaccination Monitoring</h3>
                <p class="text-sm text-gray-500 mb-4">Monitor vaccination records, vaccination status, and vaccination statistics from submitted records across all barangays in Maasin City.</p>
                <button onclick="openVaccineStatsView()" class="text-custom-teal text-sm font-bold">View Full List →</button>
            </div>

       <div class="bg-white p-6 rounded-xl shadow border-l-4 border-custom-teal">
    <h3 class="font-bold mb-2 text-2xl">Client and Pet Records</h3>
    <p class="text-sm text-gray-500 mb-4">View registered client information, pet records, consultation and vaccination history.</p>
    <button onclick="openClientRecordsView()" class="text-custom-teal text-sm font-bold">Open Records →</button>
</div>

         <div class="bg-white p-6 rounded-xl shadow border-l-4 border-custom-orange">
    <h3 class="font-bold mb-2 text-2xl">Report Summary</h3>
    <p class="text-sm text-gray-500 mb-4">
        Generate and view consultation and vaccination reports for monitoring and analysis.
    </p>
    <button onclick="openReportsView()" class="text-custom-teal text-sm font-bold">
        View Reports →
    </button>
</div>
</div>



        <!-- Client Profile View -->
        <div id="retrieval-client-profile" class="hidden space-y-8">
          <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm">
    <button onclick="closeClientRecordsView()" class="text-custom-teal font-bold"><i class="fas fa-arrow-left mr-2"></i> Back to retrieval</button>
    <h2 class="text-xl font-bold uppercase text-custom-teal">Centralized Client Profile</h2>
</div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="search-container">
                    <label class="block text-sm font-bold mb-2 text-custom-teal uppercase">Search Client Profile (ID or Name)</label>
                    <div class="flex gap-2">
                        <input type="text" id="profile-search" oninput="searchClient(this, 'profile')" class="w-full p-3 border rounded-lg bg-white focus:ring-2 focus:ring-custom-orange outline-none" placeholder="Search Client Records...">
                        <button class="bg-custom-teal text-white px-6 py-3 rounded-lg"><i class="fas fa-search"></i></button>
                    </div>
                    <div id="profile-search-results" class="search-results-dropdown shadow-2xl"></div>
                </div>
            </div>

            <div id="profile-display-area" class="hidden space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-custom-teal">
                        <h3 class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Total Consultations</h3>
                        <p id="client-summary-consults" class="text-3xl font-bold text-custom-teal">0</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-custom-orange">
                        <h3 class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Total Vaccinations</h3>
                        <p id="client-summary-vax" class="text-3xl font-bold text-custom-orange">0</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-gray-400">
                        <h3 class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Overall Total Records</h3>
                        <p id="client-summary-total" class="text-3xl font-bold text-gray-800">0</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden relative">
                    <div class="bg-custom-teal p-4 text-white flex justify-between items-center">
                        <h3 class="font-bold uppercase tracking-wider text-sm"><i class="fas fa-id-card mr-2"></i> Client Registration Information</h3>
                        <button onclick="toggleEditClientForm()" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-xs font-bold uppercase transition"><i class="fas fa-edit mr-1"></i> Edit Info</button>
                    </div>

                    <div id="edit-client-form-container" class="hidden absolute inset-0 bg-white z-20 overflow-y-auto p-8">
                        <div class="flex justify-between items-center mb-6 border-b pb-4">
                            <h4 class="font-bold text-custom-teal uppercase">Edit Client Registration</h4>
                            <button onclick="toggleEditClientForm()" class="text-red-500 font-bold"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold mb-1">Full Name</label>
                                <input type="text" id="edit-client-name" class="w-full p-2 border rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-1">Birthdate</label>
                                <input type="date" id="edit-client-bday" onchange="handleAgeCalc(this, 'edit-client-age')" class="w-full p-2 border rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-1">Age</label>
                                <input type="number" id="edit-client-age" readonly class="w-full p-2 border rounded text-sm bg-gray-200">
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-1">Phone</label>
                                <input type="text" id="edit-client-phone" class="w-full p-2 border rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-1">Street/Purok</label>
                                <input type="text" id="edit-client-street" class="w-full p-2 border rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-1">Barangay</label>
                                <input type="text" id="edit-client-brgy" list="brgy-list" class="w-full p-2 border rounded text-sm">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-bold mb-1">Email</label>
                                <input type="email" id="edit-client-email" class="w-full p-2 border rounded text-sm">
                            </div>
                            <div class="col-span-2 mt-4">
                                <button onclick="saveClientEdit()" class="bg-custom-teal text-white w-full py-3 rounded font-bold uppercase tracking-widest text-sm">Update Client Record</button>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div><p class="text-[10px] font-bold text-gray-400 uppercase">Client Name</p><p id="view-prof-name" class="font-bold text-custom-teal text-lg">-</p></div>
                        <div><p class="text-[10px] font-bold text-gray-400 uppercase">Client ID</p><p id="view-prof-id" class="font-bold text-custom-orange text-lg">-</p></div>
                        <div><p class="text-[10px] font-bold text-gray-400 uppercase">Birthdate / Age</p><p id="view-prof-bday" class="text-sm">-</p></div>
                        <div><p class="text-[10px] font-bold text-gray-400 uppercase">Barangay</p><p id="view-prof-brgy" class="text-sm">-</p></div>
                        <div class="col-span-2"><p class="text-[10px] font-bold text-gray-400 uppercase">Address (Purok/Street)</p><p id="view-prof-addr" class="text-sm">-</p></div>
                        <div><p class="text-[10px] font-bold text-gray-400 uppercase">Phone Number</p><p id="view-prof-phone" class="text-sm">-</p></div>
                        <div><p class="text-[10px] font-bold text-gray-400 uppercase">Email Address</p><p id="view-prof-email" class="text-sm">-</p></div>
                    </div>
                </div>

               <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-custom-orange p-4 text-white flex justify-between items-center">
                        <h3 class="font-bold uppercase tracking-wider text-sm"><i class="fas fa-paw mr-2"></i> Registered Pets</h3>
                        <button onclick="exportPetRecords()" class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-3 py-2 rounded-lg uppercase transition">
                            <i class="fas fa-file-excel mr-1"></i> Export to Excel
                        </button>
                    </div>
                    <div class="p-8">
                        <p class="text-xs text-gray-400 mb-4 font-bold uppercase italic">Select a pet below to view specific vaccination records</p>
                        <div id="view-prof-pet-list" class="flex flex-wrap gap-4 mb-10">
                        </div>

                        <div id="pet-detail-box" class="hidden bg-gray-50 border border-gray-200 rounded-xl p-6 relative">
                            <div id="edit-pet-form-container" class="hidden absolute inset-0 bg-white z-20 overflow-y-auto p-6 rounded-xl border-2 border-custom-orange">
                                <div class="flex justify-between items-center mb-4 border-b pb-2">
                                    <h4 class="font-bold text-custom-orange uppercase text-sm">Edit Pet Record</h4>
                                    <button onclick="toggleEditPetForm()" class="text-red-500 font-bold text-xs"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-bold mb-1">Name</label>
                                        <input type="text" id="edit-pet-name-field" class="w-full p-2 border rounded text-xs">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold mb-1">Type</label>
                                        <select id="edit-pet-type-field" class="w-full p-2 border rounded text-xs">
                                            <option>Dog</option><option>Cat</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold mb-1">Sex</label>
                                        <select id="edit-pet-sex-field" class="w-full p-2 border rounded text-xs">
                                            <option>Male</option><option>Female</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold mb-1">Birthdate</label>
                                        <input type="date" id="edit-pet-bday-field" onchange="handleAgeCalc(this, 'edit-pet-age-field')" class="w-full p-2 border rounded text-xs">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold mb-1">Age</label>
                                        <input type="text" id="edit-pet-age-field" readonly class="w-full p-2 border rounded text-xs bg-gray-200">
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block text-[10px] font-bold mb-1">Color/Breed</label>
                                        <input type="text" id="edit-pet-color-field" class="w-full p-2 border rounded text-xs">
                                    </div>
                                    <div class="col-span-2 mt-2">
                                        <button onclick="savePetEdit()" class="bg-custom-orange text-white w-full py-2 rounded font-bold uppercase text-[10px] tracking-widest">Update Pet</button>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="font-bold text-custom-teal uppercase text-sm">Complete Pet Information</h4>
                                        <button onclick="toggleEditPetForm()" class="bg-custom-orange text-white px-4 py-2 rounded-md font-bold text-xs uppercase hover-orange transition shadow-sm">
                                            <i class="fas fa-edit mr-2"></i> Edit Pet
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div><span class="text-[10px] text-gray-400 uppercase font-bold block">Name</span><span id="p-det-name" class="font-bold">-</span></div>
                                        <div><span class="text-[10px] text-gray-400 uppercase font-bold block">Type</span><span id="p-det-type" class="font-bold">-</span></div>
                                        <div><span class="text-[10px] text-gray-400 uppercase font-bold block">Sex</span><span id="p-det-sex">-</span></div>
                                        <div><span class="text-[10px] text-gray-400 uppercase font-bold block">Age</span><span id="p-det-age">-</span></div>
                                        <div><span class="text-[10px] text-gray-400 uppercase font-bold block">Birthdate</span><span id="p-det-bday" class="font-bold">-</span></div>
                                        <div class="col-span-2"><span class="text-[10px] text-gray-400 uppercase font-bold block">Color/Breed</span><span id="p-det-color">-</span></div>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-custom-teal uppercase text-sm mb-4">Vaccination History</h4>
                                    <div class="report-table-container">
                                        <table class="w-full text-left text-xs border-collapse">
                                            <thead class="bg-custom-orange text-white sticky top-0">
                                                <tr>
                                                    <th class="p-2">Date</th>
                                                    <th class="p-2">Vaccine Type</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-pet-vax-history" class="divide-y text-gray-600"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-custom-teal p-4 text-white">
                        <h3 class="font-bold uppercase tracking-wider text-sm"><i class="fas fa-notes-medical mr-2"></i> Client Consultation History</h3>
                    </div>
                    <div class="p-8">
                        <div class="report-table-container">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead class="bg-gray-100 text-custom-teal sticky top-0 font-bold uppercase text-[10px]">
                                    <tr>
                                        <th class="p-4">Date</th>
                                        <th class="p-4">Species</th>
                                        <th class="p-4">Problem/Concern</th>
                                        <th class="p-4">Treatment / Service Provided</th>
                                    </tr>
                                </thead>
                                <tbody id="table-client-consult-history" class="divide-y text-gray-600"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vaccine Monitoring Stats -->
        <div id="vaccine-monitoring-stats" class="hidden space-y-8">
            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm">
                <button onclick="closeVaccineStatsView()" class="text-custom-teal font-bold"><i class="fas fa-arrow-left mr-2"></i> Back to retrieval</button>
                <h2 class="text-xl font-bold uppercase text-custom-teal">Statistics Dashboard</h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xs font-bold text-gray-400 uppercase mb-4 tracking-widest"><i class="fas fa-filter mr-2"></i> Data Filters</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Barangay</label>
                        <input type="text" id="vax-filter-brgy" list="brgy-list" oninput="applyVaccineFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange" placeholder="All Barangays">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Species</label>
                        <select id="vax-filter-species" onchange="applyVaccineFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange">
                            <option value="">All Species</option>
                            <option>Dog</option><option>Cat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Vaccine Type</label>
                        <input type="text" id="vax-filter-type" list="vaccine-type-list" oninput="applyVaccineFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange" placeholder="All Types">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Month</label>
                        <select id="vax-filter-month" onchange="applyVaccineFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange">
                            <option value="">All Months</option>
                            <option value="0">January</option><option value="1">February</option><option value="2">March</option><option value="3">April</option>
                            <option value="4">May</option><option value="5">June</option><option value="6">July</option><option value="7">August</option>
                            <option value="8">September</option><option value="9">October</option><option value="10">November</option><option value="11">December</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Year</label>
                        <select id="vax-filter-year" onchange="applyVaccineFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange">
                            <option value="">All Years</option>
                            <option>2023</option><option>2024</option><option>2025</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button onclick="resetVaccineFilters()" class="text-xs font-bold text-red-500 uppercase">Clear Filters</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-custom-teal p-6 rounded-xl text-white shadow-md">
                    <h4 class="text-[10px] uppercase opacity-70 font-bold mb-2">Total Vaccination Records</h4>
                    <p id="vax-stat-total-records" class="text-3xl font-bold">0</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-custom-orange">
                    <h4 class="text-[10px] uppercase text-gray-400 font-bold mb-2">Total Animals Vaccinated</h4>
                    <p id="vax-stat-total-animals" class="text-3xl font-bold text-custom-teal">0</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-gray-300">
                    <h4 class="text-[10px] uppercase text-gray-400 font-bold mb-2">Total Dogs Vaccinated</h4>
                    <p id="vax-stat-total-dogs" class="text-3xl font-bold text-custom-teal">0</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-custom-teal">
                    <h4 class="text-[10px] uppercase text-gray-400 font-bold mb-2">Total Cats Vaccinated</h4>
                    <p id="vax-stat-total-cats" class="text-3xl font-bold text-custom-teal">0</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 text-sm uppercase text-gray-500">Vaccinated Animals by Barangay</h4>
                    <div style="height: 250px;"><canvas id="vaxBrgyChart"></canvas></div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 text-sm uppercase text-gray-500">Distribution of Vaccine Types</h4>
                    <div style="height: 250px;"><canvas id="vaxTypeChart"></canvas></div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 text-sm uppercase text-gray-500">Monthly Vaccination Records</h4>
                    <div style="height: 250px;"><canvas id="vaxMonthlyChart"></canvas></div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 text-sm uppercase text-gray-500">Total Dogs and Cats Vaccinated</h4>
                    <div style="height: 250px;"><canvas id="vaxSpeciesChart"></canvas></div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 uppercase text-custom-teal tracking-wider">By Barangay</h4>
                    <div class="report-table-container">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead class="bg-custom-teal text-white sticky top-0">
                                <tr>
                                    <th class="p-3 border-r border-teal-800">Barangay</th>
                                    <th class="p-3 text-center">Dogs</th>
                                    <th class="p-3 text-center">Cats</th>
                                    <th class="p-3 text-center bg-custom-orange">Total Vaccinated</th>
                                </tr>
                            </thead>
                            <tbody id="table-vax-brgy-stats" class="divide-y"></tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h4 class="font-bold mb-4 uppercase text-custom-teal tracking-wider">Vaccine Type Statistics</h4>
                        <div class="report-table-container">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead class="bg-custom-teal text-white sticky top-0">
                                    <tr>
                                        <th class="p-3 border-r border-teal-800">Vaccine Type</th>
                                        <th class="p-3 text-center">Dogs</th>
                                        <th class="p-3 text-center">Cats</th>
                                        <th class="p-3 text-center bg-custom-orange">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="table-vax-type-stats" class="divide-y"></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h4 class="font-bold mb-4 uppercase text-custom-teal tracking-wider">Most Administered Vaccine by Barangay</h4>
                        <div class="report-table-container">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead class="bg-custom-orange text-white sticky top-0">
                                    <tr>
                                        <th class="p-3">Barangay</th>
                                        <th class="p-3">Most Administered Vaccine</th>
                                        <th class="p-3 text-center">Number Vaccinated</th>
                                    </tr>
                                </thead>
                                <tbody id="table-vax-common" class="divide-y"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="retrieval-stats" class="hidden space-y-8">
            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm">
                <button onclick="closeStatsView()" class="text-custom-teal font-bold"><i class="fas fa-arrow-left mr-2"></i> Back to retrieval</button>
                <h2 class="text-xl font-bold uppercase text-custom-teal">Statistics Dashboard</h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xs font-bold text-gray-400 uppercase mb-4 tracking-widest"><i class="fas fa-filter mr-2"></i> Data Filters</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Barangay</label>
                        <input type="text" id="filter-brgy" list="brgy-list" oninput="applyFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange" placeholder="All Barangays">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Species</label>
                        <select id="filter-species" onchange="applyFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange">
                            <option value="">All Species</option>
                            <option>Swine</option><option>Cattle</option><option>Goat</option><option>Poultry</option><option>Carabao</option><option>Dog</option><option>Cat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Disease/Problem</label>
                        <input type="text" id="filter-disease" list="disease-suggestions" oninput="applyFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange" placeholder="All Diseases">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Month</label>
                        <select id="filter-month" onchange="applyFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange">
                            <option value="">All Months</option>
                            <option value="0">January</option><option value="1">February</option><option value="2">March</option><option value="3">April</option>
                            <option value="4">May</option><option value="5">June</option><option value="6">July</option><option value="7">August</option>
                            <option value="8">September</option><option value="9">October</option><option value="10">November</option><option value="11">December</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold mb-1">Year</label>
                        <select id="filter-year" onchange="applyFilters()" class="w-full p-2 border rounded text-sm outline-none focus:ring-1 focus:ring-custom-orange">
                            <option value="">All Years</option>
                            <option>2023</option><option>2024</option><option>2025</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button onclick="resetFilters()" class="text-xs font-bold text-red-500 uppercase">Clear Filters</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-custom-teal p-6 rounded-xl text-white shadow-md">
                    <h4 class="text-[10px] uppercase opacity-70 font-bold mb-2">Total Consultation Records</h4>
                    <p id="stat-total-records" class="text-3xl font-bold">0</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-custom-orange">
                    <h4 class="text-[10px] uppercase text-gray-400 font-bold mb-2">Total Animals Consulted</h4>
                    <p id="stat-total-consulted" class="text-3xl font-bold text-custom-teal">0</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-gray-300">
                    <h4 class="text-[10px] uppercase text-gray-400 font-bold mb-2">Total Animals Not Consulted</h4>
                    <p id="stat-total-not-consulted" class="text-3xl font-bold text-custom-teal">0</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-custom-teal">
                    <h4 class="text-[10px] uppercase text-gray-400 font-bold mb-2">Total Cases Recorded</h4>
                    <p id="stat-total-cases" class="text-3xl font-bold text-custom-teal">0</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 text-sm uppercase text-gray-500">Consultation Cases by Species</h4>
                    <div style="height: 250px;"><canvas id="statsSpeciesChart"></canvas></div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 text-sm uppercase text-gray-500">Distribution of Diseases/Problems</h4>
                    <div style="height: 250px;"><canvas id="statsDiseaseChart"></canvas></div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 text-sm uppercase text-gray-500">Consultation Cases by Barangay</h4>
                    <div style="height: 250px;"><canvas id="statsBrgyChart"></canvas></div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 text-sm uppercase text-gray-500">Monthly Consultation Trends</h4>
                    <div style="height: 250px;"><canvas id="statsLineChart"></canvas></div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 uppercase text-custom-teal tracking-wider">Statistics by Barangay</h4>
                    <div class="report-table-container">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead class="bg-custom-teal text-white sticky top-0">
                                <tr>
                                    <th class="p-3 border-r border-teal-800">Barangay</th>
                                    <th class="p-3 text-center">Swine</th>
                                    <th class="p-3 text-center">Cattle</th>
                                    <th class="p-3 text-center">Goat</th>
                                    <th class="p-3 text-center">Poultry</th>
                                    <th class="p-3 text-center bg-custom-orange">Total Cases</th>
                                    <th class="p-3 text-center">Consulted</th>
                                    <th class="p-3 text-center">Not Consulted</th>
                                </tr>
                            </thead>
                            <tbody id="table-brgy-stats" class="divide-y"></tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold mb-4 uppercase text-custom-teal tracking-wider">Disease / Problem Statistics</h4>
                    <div class="report-table-container">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead class="bg-custom-teal text-white sticky top-0">
                                <tr>
                                    <th class="p-3 border-r border-teal-800">Disease/Problem</th>
                                    <th class="p-3 text-center">Swine</th>
                                    <th class="p-3 text-center">Cattle</th>
                                    <th class="p-3 text-center">Goat</th>
                                    <th class="p-3 text-center">Poultry</th>
                                    <th class="p-3 text-center bg-custom-orange">Total</th>
                                </tr>
                            </thead>
                            <tbody id="table-disease-stats" class="divide-y"></tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h4 class="font-bold mb-6 uppercase text-custom-teal tracking-wider">Species Statistics</h4>
                        <div id="list-species-stats" class="space-y-4"></div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h4 class="font-bold mb-6 uppercase text-custom-teal tracking-wider">Most Common Disease by Barangay</h4>
                        <div class="report-table-container">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead class="bg-custom-orange text-white sticky top-0">
                                    <tr>
                                        <th class="p-3">Barangay</th>
                                        <th class="p-3">Most Common Disease</th>
                                        <th class="p-3 text-center">Number of Cases</th>
                                    </tr>
                                </thead>
                                <tbody id="table-common-disease" class="divide-y"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="retrieval-reports" class="hidden space-y-8">
           <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm">
    <button onclick="closeReportsView()" class="text-custom-teal font-bold"><i class="fas fa-arrow-left mr-2"></i> Back to retrieval</button>
    <h2 class="text-xl font-bold uppercase text-custom-teal">Reports Summary</h2>
</div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8 border-b pb-6">
                    <div class="flex flex-col gap-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Select Report Type</label>
                        <div class="flex bg-gray-100 p-1 rounded-lg">
                            <button onclick="toggleReportView('health')" id="btn-health" class="px-4 py-2 rounded-md font-bold text-sm bg-custom-orange text-white transition">Animal Health Report</button>
                            <button onclick="toggleReportView('vaccine')" id="btn-vaccine" class="px-4 py-2 rounded-md font-bold text-sm text-gray-500 hover:text-custom-teal transition">Animal Vaccination Report</button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Time Interval</label>
                        <div class="flex gap-2">
                            <div class="flex bg-gray-100 p-1 rounded-lg h-fit">
                                <button onclick="toggleInterval('monthly')" id="btn-monthly" class="px-6 py-2 rounded-md font-bold text-sm bg-custom-teal text-white transition">Monthly</button>
                                <button onclick="toggleInterval('yearly')" id="btn-yearly" class="px-6 py-2 rounded-md font-bold text-sm text-gray-500 hover:text-custom-teal transition">Yearly</button>
                            </div>
                            <div id="interval-selector" class="flex gap-2">
                                <select class="p-2 border rounded-lg text-sm font-bold bg-white text-custom-teal outline-none focus:ring-2 focus:ring-custom-teal">
                                    <option>October</option>
                                    <option>January</option><option>February</option><option>March</option><option>April</option>
                                    <option>May</option><option>June</option><option>July</option><option>August</option>
                                    <option>September</option><option>November</option><option>December</option>
                                </select>
                                <select class="p-2 border rounded-lg text-sm font-bold bg-white text-custom-teal outline-none focus:ring-2 focus:ring-custom-teal">
                                    <option>2023</option><option>2024</option><option>2025</option><option>2026</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end gap-2 h-full">
                        <button class="bg-gray-200 px-4 py-2 rounded font-bold text-xs uppercase hover-bg-gray-300 transition">Download PDF</button>
                        <button class="bg-custom-teal text-white px-4 py-2 rounded font-bold text-xs uppercase hover:bg-teal-900 transition shadow-md">Export CSV</button>
                    </div>
                </div>

              <div id="report-health-content">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-custom-teal uppercase tracking-wider">Animal Health Report Summary</h3>
                        <button onclick="exportReportSummary()" class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-4 py-2 rounded-lg flex items-center gap-2">
                            <i class="fas fa-file-excel"></i>
                            <span>EXPORT TO EXCEL</span>
                        </button>
                    </div>
                    <div class="report-table-container">
                        <table class="w-full text-left text-[10px] md:text-xs whitespace-nowrap">
                            <thead class="bg-custom-teal text-white sticky top-0">
                                <tr>
                                    <th rowspan="2" class="p-2 border-r border-teal-800 align-middle">Barangay Served</th>
                                    <th colspan="11" class="p-2 text-center border-b border-teal-800">Animals Treated</th>
                                    <th rowspan="2" class="p-2 bg-custom-orange text-center align-middle">Total</th>
                                </tr>
                                <tr>
                                    <th class="p-2 text-center">Dog</th>
                                    <th class="p-2 text-center">Cat</th>
                                    <th class="p-2 text-center">Cattle</th>
                                    <th class="p-2 text-center">Carabao</th>
                                    <th class="p-2 text-center">Goat</th>
                                    <th class="p-2 text-center">Sheep</th>
                                    <th class="p-2 text-center">Swine</th>
                                    <th class="p-2 text-center">Birds</th>
                                    <th class="p-2 text-center">Poultry</th>
                                    <th class="p-2 text-center">Horse</th>
                                    <th class="p-2 text-center">Others</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" id="health-table-body"></tbody>
                            <tfoot class="bg-gray-100 font-bold sticky bottom-0 border-t-2">
                                <tr>
                                    <td class="p-2 uppercase">Grand Total</td>
                                    <td class="p-2 text-center">142</td><td class="p-2 text-center">88</td><td class="p-2 text-center">45</td><td class="p-2 text-center">12</td><td class="p-2 text-center">34</td><td class="p-2 text-center">2</td><td class="p-2 text-center">112</td><td class="p-2 text-center">8</td><td class="p-2 text-center">240</td><td class="p-2 text-center">0</td><td class="p-2 text-center">15</td>
                                    <td class="p-2 text-white bg-custom-orange text-center">640</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div id="report-vaccine-content" class="hidden">
                    <h3 class="text-xl font-bold text-custom-teal mb-4 uppercase tracking-wider">Animal Vaccination Report Summary</h3>
                    <div class="mb-4 bg-orange-50 p-3 rounded-lg border border-orange-200 inline-block">
                        <span class="text-sm font-bold text-custom-orange uppercase">Disease:</span>
                        <span class="text-sm font-bold ml-2">Anti-Rabies Campaign</span>
                    </div>
                    <div class="report-table-container">
                        <table class="w-full text-left text-[10px] md:text-xs whitespace-nowrap">
                            <thead class="bg-custom-teal text-white sticky top-0">
                                <tr>
                                    <th class="p-2 border-r border-teal-800">Barangay Served</th>
                                    <th class="p-2 text-center">No. of Dogs Vaccinated</th>
                                    <th class="p-2 text-center">No. of Cats Vaccinated</th>
                                    <th class="p-2 bg-custom-orange text-center">Grand Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" id="vaccine-table-body"></tbody>
                            <tfoot class="bg-gray-100 font-bold sticky bottom-0 border-t-2">
                                <tr>
                                    <td class="p-2 uppercase">Grand Total</td>
                                    <td class="p-2 text-center">1,245</td>
                                    <td class="p-2 text-center">482</td>
                                    <td class="p-2 text-white bg-custom-orange text-center">1,727</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>