    <!-- ============================= -->
    <!-- CONSULTATION SECTION -->
    <!-- ============================= -->
    <section id="consultation" class="section">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-custom-orange p-6 text-white text-center">
                <h2 class="text-2xl font-bold uppercase">Consultation Form</h2>
                <p class="text-white-200">Search for client or register first to continue</p>
            </div>

            <div class="p-8 pb-0">
                <div class="search-container">
                    <label class="block text-sm font-bold mb-2 text-custom-teal uppercase">Search Client (ID or Name)</label>
                    <div class="flex gap-2">
                        <input type="text" id="consult-search" oninput="searchClient(this, 'consult')" class="w-full p-3 border rounded-lg bg-white focus:ring-2 focus:ring-custom-orange outline-none" placeholder="Enter Client ID or Name...">
                        <button class="bg-custom-teal text-white px-6 py-3 rounded-lg"><i class="fas fa-search"></i></button>
                    </div>
                    <div id="consult-search-results" class="search-results-dropdown shadow-2xl"></div>
                </div>
            </div>

            <form class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6 form-locked" id="consult-form">
                <div class="col-span-2 text-custom-teal font-bold border-b pb-2">Client Information</div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Date of Consultation</label>
                    <input type="date" id="consult-input-date" class="w-full p-3 border rounded-lg bg-gray-50 focus:outline-custom-teal">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Barangay</label>
                    <input type="text" id="consult-brgy" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Client Name</label>
                    <input type="text" id="consult-name" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Client ID</label>
                    <input type="text" id="consult-id" readonly class="w-full p-3 border rounded-lg bg-gray-200">
                </div>

                <div class="col-span-2 text-custom-teal font-bold border-b pb-2 mt-4">Animal Information</div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Species</label>
                    <select id="consult-input-species" class="w-full p-3 border rounded-lg bg-gray-50">
                        <option value="">Select Species</option>
                        <option>Swine</option><option>Cattle</option><option>Goat</option><option>Poultry</option><option>Carabao</option><option>Dog</option><option>Cat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Age Group / Age Range</label>
                    <input type="text" id="consult-input-agegroup" class="w-full p-3 border rounded-lg bg-gray-50" placeholder="e.g. Piglets, Growers, or 2-3 months">
                </div>
                
                <div class="p-4 bg-teal-100 rounded-lg">
                    <label class="block text-sm font-bold mb-2">Number Consulted</label>
                    <div class="flex gap-2">
                        <input type="number" id="consult-input-m-c" placeholder="Male" class="w-1/2 p-2 border rounded">
                        <input type="number" id="consult-input-f-c" placeholder="Female" class="w-1/2 p-2 border rounded">
                    </div>
                </div>
                <div class="p-4 bg-orange-100 rounded-lg">
                    <label class="block text-sm font-bold mb-2">Number NOT Consulted</label>
                    <div class="flex gap-2">
                        <input type="number" id="consult-input-m-nc" placeholder="Male" class="w-1/2 p-2 border rounded">
                        <input type="number" id="consult-input-f-nc" placeholder="Female" class="w-1/2 p-2 border rounded">
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-semibold mb-2">Problems/Concerns</label>
                    <input type="text" id="consult-input-problem" list="disease-suggestions" class="w-full p-3 border rounded-lg bg-gray-50" placeholder="e.g., Fever, Diarrhea, Foot Rot">
                    <datalist id="disease-suggestions">
                        <option value="Fever"><option value="Diarrhea"><option value="Foot Rot"><option value="Respiratory Infection"><option value="Skin Mange">
                    </datalist>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-semibold mb-2">Treatment/Services Given</label>
                    <textarea rows="3" id="consult-input-treatment" class="w-full p-3 border rounded-lg bg-gray-50" placeholder="List medications, procedures, or advice provided..."></textarea>
                </div>
                <div class="col-span-2">
                    <button type="button" onclick="submitConsultation()" class="bg-custom-teal text-white w-full py-4 rounded-lg font-bold hover-orange shadow-lg transition uppercase tracking-widest">Submit Form</button>
                </div>
            </form>
        </div>
    </section>

