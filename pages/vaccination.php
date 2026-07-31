    <!-- ============================= -->
    <!-- VACCINATION SECTION -->
    <!-- ============================= -->
     <section id="vaccination" class="section">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-custom-orange p-6 text-white text-center">
                <h2 class="text-2xl font-bold uppercase">vaccination Form</h2>
                <p class="text-white-200">Search for client or register first to continue</p>
            </div>

            <div class="p-8 pb-0">
                <div class="search-container">
                    <label class="block text-sm font-bold mb-2 text-custom-teal uppercase">Search Client (ID or Name)</label>
                    <div class="flex gap-2">
                        <input type="text" id="vaccine-search" oninput="searchClient(this, 'vaccine')" class="w-full p-3 border rounded-lg bg-white focus:ring-2 focus:ring-custom-orange outline-none" placeholder="Enter Client ID or Name...">
                        <button class="bg-custom-teal text-white px-6 py-3 rounded-lg"><i class="fas fa-search"></i></button>
                    </div>
                    <div id="vaccine-search-results" class="search-results-dropdown shadow-2xl"></div>
                </div>
            </div>

            <div id="animal-selection-area" class="p-8 pb-0 hidden">
                <label class="block text-sm font-bold mb-3 text-custom-teal uppercase">Select Animal</label>
                <div id="animal-list" class="flex flex-wrap gap-3 mb-4">
                </div>
                <button onclick="toggleAddPetForm()" class="text-xs font-bold bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 transition uppercase"><i class="fas fa-plus mr-1"></i> Add Pet Record</button>
            </div>

            <div id="add-pet-form" class="hidden p-8 bg-gray-50 border-y">
                <h3 class="font-bold text-custom-teal mb-4 uppercase text-sm">New Pet Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold mb-1">Animal Name</label>
                        <input type="text" id="new-pet-name" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Type</label>
                        <select id="new-pet-type" class="w-full p-2 border rounded">
                            <option>Dog</option>
                            <option>Cat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Sex</label>
                        <select id="new-pet-sex" class="w-full p-2 border rounded">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Birthdate</label>
                        <input type="date" id="new-pet-bday" onchange="handleAgeCalc(this, 'new-pet-age')" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Age</label>
                        <input type="text" id="new-pet-age" readonly class="w-full p-2 border rounded bg-gray-200" placeholder="Auto-calculated">
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Color/Breed (Optional)</label>
                        <input type="text" id="new-pet-color" class="w-full p-2 border rounded">
                    </div>
                    <div class="flex items-end col-span-2">
                        <button onclick="saveNewPet()" class="bg-custom-teal text-white w-full py-2 rounded font-bold text-xs uppercase">Save Pet Record</button>
                    </div>
                </div>
            </div>

            <form class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6 form-locked" id="vaccine-form">
                <div class="col-span-2 text-custom-teal font-bold border-b pb-2">Client Information</div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Date of vaccination</label>
                    <input type="date" id="vaccine-input-date" class="w-full p-3 border rounded-lg bg-gray-50 focus:outline-custom-teal">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Barangay</label>
                    <input type="text" id="vaccine-brgy" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Client Name</label>
                    <input type="text" id="vaccine-name" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Client ID</label>
                    <input type="text" id="vaccine-id" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                
                <div class="col-span-2 text-custom-teal font-bold border-b pb-2 mt-4">Vaccine Details</div>
                <div class="col-span-2">
                    <label class="block text-sm font-semibold mb-2">Type of Vaccine Administered</label>
                    <input type="text" id="vaccine-input-type" list="vaccine-type-list" class="w-full p-3 border rounded-lg bg-gray-50" placeholder="e.g., Anti-Rabies, 5-in-1 Vaccine">
                </div>

                <div class="col-span-2 text-custom-teal font-bold border-b pb-2 mt-4">Animal Information</div>
                
                <div>
                    <label class="block text-sm font-semibold mb-2">Animal Name</label>
                    <input type="text" id="vaccine-pet-name" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Animal Type</label>
                    <input type="text" id="vaccine-pet-type" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Sex</label>
                    <input type="text" id="vaccine-pet-sex" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Age</label>
                    <input type="text" id="vaccine-pet-age" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Pet Birthdate</label>
                    <input type="text" id="vaccine-pet-bday" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Color/Breed</label>
                    <input type="text" id="vaccine-pet-color" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>

                <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                    <label class="block text-sm font-bold mb-2 text-custom-orange">Current Weight (kg)</label>
                    <input type="number" step="0.1" id="vaccine-pet-weight" class="w-full p-3 border rounded-lg bg-white focus:ring-2 focus:ring-custom-orange outline-none" placeholder="0.0">
                    <p class="text-[10px] mt-1 text-gray-400 italic">Note: Weight is recorded per session.</p>
                </div>

                <div class="col-span-2 pt-4">
                    <button type="button" onclick="submitVaccination()" class="bg-custom-teal text-white w-full py-4 rounded-lg font-bold hover-orange shadow-lg transition uppercase tracking-widest">Submit Form</button>
                </div>
            </form>
        </div> 
        
    </section>

