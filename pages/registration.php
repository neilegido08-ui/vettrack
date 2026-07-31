<!-- ============================= -->
<!-- REGISTRATION SECTION -->
<!-- ============================= -->
<section id="registration" class="section">

    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">

        <div class="bg-custom-orange p-6 text-white text-center">
            <h2 class="text-2xl font-bold uppercase">Client Registration</h2>
            <p class="text-white/80">New Client Intake Form</p>
        </div>

        <form
            id="client-reg-form"
            onsubmit="event.preventDefault(); registerClient();"
            class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6"
        >

            <div class="md:col-span-2 text-custom-teal font-bold border-b pb-2">
                Client Information
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Full Name</label>
                <input
                    type="text"
                    id="reg-name"
                    required
                    class="w-full p-3 border rounded-lg bg-gray-50"
                    placeholder="e.g., Juan Dela Cruz"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Gender</label>
                <select
                    id="reg-gender"
                    required
                    class="w-full p-3 border rounded-lg bg-gray-50"
                >
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Birthdate</label>
                <input
                    type="date"
                    id="reg-bday"
                    required
                    onchange="handleAgeCalc(this, 'reg-age')"
                    class="w-full p-3 border rounded-lg bg-gray-50"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Age</label>
                <input
                    type="number"
                    id="reg-age"
                    readonly
                    class="w-full p-3 border rounded-lg bg-gray-200"
                    placeholder="Auto-calculated"
                >
            </div>

            <div class="md:col-span-2 text-custom-teal font-bold border-b pb-2 mt-4">
                Address
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Street/Purok</label>
                <input
                    type="text"
                    id="reg-street"
                    required
                    class="w-full p-3 border rounded-lg bg-gray-50"
                    placeholder="e.g., Purok 1"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Barangay</label>
                <input
                    type="text"
                    id="reg-brgy"
                    list="brgy-list"
                    required
                    class="w-full p-3 border rounded-lg bg-gray-50"
                    placeholder="Enter Barangay"
                >
            </div>

            <div class="md:col-span-2 text-custom-teal font-bold border-b pb-2 mt-4">
                Contact Information
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Email Address</label>
                <input
                    type="email"
                    id="reg-email"
                    class="w-full p-3 border rounded-lg bg-gray-50"
                    placeholder="e.g., juan@example.com"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Phone Number</label>
                <input
                    type="text"
                    id="reg-phone"
                    class="w-full p-3 border rounded-lg bg-gray-50"
                    placeholder="e.g., 09123456789"
                >
            </div>

            <div class="md:col-span-2 mt-4">
                <button
                    type="submit"
                    class="bg-custom-teal text-white w-full py-4 rounded-lg font-bold hover:bg-teal-900 shadow-lg transition uppercase tracking-widest"
                >
                    Register Client
                </button>
            </div>

        </form>

    </div>

</section>