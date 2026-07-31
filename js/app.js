/* ============================= */
/* VETTRACK - CORE APPLICATION
/* ============================= */

// =============================
// DATA STORE
// =============================

let registeredClients = [
    { 
        id: "VT-1001", name: "Earl Capala", birthdate: "1995-01-01", age: 29, 
        street: "Purok 5", barangay: "Panan-awan", email: "earl@example.com", phone: "09123456789",
        animals: [
            { name: "Bruno", type: "Dog", sex: "Male", birthdate: "2020-05-10", age: 3, color: "Golden Brown" },
            { name: "Mimi", type: "Cat", sex: "Female", birthdate: "2022-11-15", age: 1, color: "White/Gray" }
        ] 
    },
    { 
        id: "VT-1002", name: "Neil Egido", birthdate: "1998-05-12", age: 26, 
        street: "Abgao St.", barangay: "Abgao (Poblacion)", email: "neil@example.com", phone: "09987654321",
        animals: [
            { name: "Kitty", type: "Cat", sex: "Female", birthdate: "2021-02-20", age: 2, color: "Calico" }
        ] 
    },
    { 
        id: "VT-1003", name: "Jayson Orit", birthdate: "1997-03-22", age: 27, 
        street: "Purok 2", barangay: "San Roque", email: "jayson@example.com", phone: "09112223334",
        animals: [] 
    },
    { 
        id: "VT-1004", name: "Harv Choyins", birthdate: "1999-11-05", age: 24, 
        street: "Highway", barangay: "Mantahan (Poblacion)", email: "harv@example.com", phone: "09445556667",
        animals: [] 
    }
];

let consultationRecords = [
    { date: "2023-10-20", brgy: "Abgao (Poblacion)", clientId: "VT-1002", clientName: "Neil Egido", species: "Swine", ageGroup: "Growers", disease: "Diarrhea", consultedM: 10, consultedF: 15, notConsultedM: 2, notConsultedF: 3, treatment: "Administered electrolytes and antibiotics. Advised hygiene improvement." },
    { date: "2023-10-21", brgy: "Abgao (Poblacion)", clientId: "VT-1002", clientName: "Neil Egido", species: "Cattle", ageGroup: "Adult", disease: "Fever", consultedM: 5, consultedF: 5, notConsultedM: 0, notConsultedF: 0, treatment: "Anti-pyretic injection given." },
    { date: "2023-10-22", brgy: "Panan-awan", clientId: "VT-1001", clientName: "Earl Capala", species: "Swine", ageGroup: "Fatteners", disease: "Fever", consultedM: 6, consultedF: 6, notConsultedM: 1, notConsultedF: 1, treatment: "Oral medication provided for herd." },
    { date: "2023-09-15", brgy: "San Roque", clientId: "VT-1003", clientName: "Jayson Orit", species: "Goat", ageGroup: "Kids", disease: "Foot Rot", consultedM: 4, consultedF: 5, notConsultedM: 1, notConsultedF: 1, treatment: "Wound cleaning and topical spray." }
];

let vaccinationRecords = [
    { date: "2023-10-24", brgy: "Panan-awan", clientId: "VT-1001", clientName: "Earl Capala", petName: "Bruno", petBirthdate: "2020-05-10", species: "Dog", sex: "Male", age: 3, color: "Golden Brown", weight: "12.5", type: "Anti-Rabies" },
    { date: "2023-08-10", brgy: "Panan-awan", clientId: "VT-1001", clientName: "Earl Capala", petName: "Bruno", petBirthdate: "2020-05-10", species: "Dog", sex: "Male", age: 3, color: "Golden Brown", weight: "12.0", type: "5-in-1 Vaccine" },
    { date: "2023-10-24", brgy: "Panan-awan", clientId: "VT-1001", clientName: "Earl Capala", petName: "Mimi", petBirthdate: "2022-11-15", species: "Cat", sex: "Female", age: 1, color: "White/Gray", weight: "3.2", type: "Anti-Rabies" },
    { date: "2023-10-24", brgy: "Abgao (Poblacion)", clientId: "VT-1002", clientName: "Neil Egido", petName: "Kitty", petBirthdate: "2021-02-20", species: "Cat", sex: "Female", age: 2, color: "Calico", weight: "4.0", type: "Anti-Rabies" }
];

let selectedClient = null;
let selectedAnimal = null;
let statsCharts = {};
let vaxCharts = {};
let dashboardCharts = {};

// =============================
// BARANGAY LIST DATA
// =============================

const brgys = ["Abgao (Poblacion)", "Acasia", "Asuncion", "Bactul I", "Bactul II", "Badiang", "Bagtican", "Basak", "Bato I", "Bato II", "Batuan", "Baugo", "Bilibol", "Bogo", "Cabadiangan", "Cabulihan", "Cagnituan", "Cambooc", "Cansirong", "Canturing", "Canyuom", "Combado (Poblacion)", "Dongon", "Gawisan", "Guadalupe", "Hanginan", "Hantag", "Hinapu Daku", "Hinapu Gamay", "Ibarra", "Isagani (Pugaling)", "Laboon", "Lanao", "Libertad", "Libhu", "Lib-og", "Lonoy", "Lunas", "Mahayahay", "Malapoc Norte", "Malapoc Sur", "Mambajao (Poblacion)", "Manhilo", "Mantahan (Poblacion)", "Maria Clara", "Matin-ao", "Nasaug", "Nati", "Nonok Norte", "Nonok Sur", "Panan-awan", "Pansaan", "Pasay", "Pinaskohan", "Rizal", "San Agustin (Lundag)", "San Isidro", "San Jose", "San Rafael", "Santa Cruz", "Santo Niño", "Santa Rosa", "Santo Rosario", "Soro-soro", "Tagnipa (Poblacion)", "Tam-is", "Tawid", "Tigbawan", "Tomoy-tomoy", "Tunga-tunga (Poblacion)"];

// =============================
// UTILITY FUNCTIONS
// =============================

function calculateAge(birthDateString) {
    if (!birthDateString) return "";
    const today = new Date();
    const birthDate = new Date(birthDateString);
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age >= 0 ? age : 0;
}

function handleAgeCalc(input, targetId) {
    const age = calculateAge(input.value);
    document.getElementById(targetId).value = age;
}

// =============================
// SECTION NAVIGATION
// =============================

const meta = {
    'dashboard': ['Dashboard', 'Quick glance at current system records'],
    'registration': ['Client Registration', 'New Client Intake Form'],
    'consultation': ['Consultation Services', 'Manage and record consultation services'],
    'vaccination': ['Vaccination Services', 'Manage and record animal vaccination'],
    'retrieval': ['Data Retrieval', 'Search and analyze historical records'],
    'staff': ['Staff Management', 'Manage accounts and access levels'],
    'activity': ['System Activity Log', 'Audit trail of system actions'],
    'about': ['About the System', 'Information about VetTrack']
};

function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(sec => sec.classList.remove('active'));
    const target = document.getElementById(sectionId);
    if (target) target.classList.add('active');

    if (meta[sectionId]) {
        document.getElementById('page-title').innerText = meta[sectionId][0];
        document.getElementById('page-subtitle').innerText = meta[sectionId][1];
    }
    
    const allForms = document.querySelectorAll('form');
    allForms.forEach(f => {
        f.reset();
        if (f.id === 'consult-form' || f.id === 'vaccine-form') {
            f.classList.add('form-locked');
        }
    });

    document.querySelectorAll('.search-results-dropdown').forEach(d => {
        d.innerHTML = "";
        d.classList.remove('show');
    });
    document.querySelectorAll('input[type="text"][id$="-search"]').forEach(i => i.value = "");
    
    const animalArea = document.getElementById('animal-selection-area');
    if(animalArea) animalArea.classList.add('hidden');
    
    const petForm = document.getElementById('add-pet-form');
    if(petForm) petForm.classList.add('hidden');

    const profileArea = document.getElementById('profile-display-area');
    if(profileArea) profileArea.classList.add('hidden');

    if(sectionId === 'retrieval') {
        if(typeof closeStatsView === 'function') closeStatsView();
        if(typeof closeReportsView === 'function') closeReportsView();
        if(typeof closeVaccineStatsView === 'function') closeVaccineStatsView();
        if(typeof closeClientRecordsView === 'function') closeClientRecordsView();
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// =============================
// PROFILE MENU
// =============================

function toggleProfileMenu() { 
    document.getElementById('profile-dropdown').classList.toggle('show'); 
}

// =============================
// TOP CLIENTS RANKING
// =============================

function renderTopActiveClients() {
    const container = document.getElementById('top-clients-ranking-container');
    if(!container) return;

    let clientActivity = registeredClients.map(client => {
        const consults = consultationRecords.filter(r => r.clientId === client.id).length;
        const vax = vaccinationRecords.filter(r => r.clientId === client.id).length;
        return {
            name: client.name,
            total: consults + vax
        };
    });

    clientActivity.sort((a, b) => b.total - a.total);

    container.innerHTML = "";
    clientActivity.slice(0, 4).forEach((c, idx) => {
        container.innerHTML += `
            <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-custom-teal flex justify-between items-center card-hover">
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase">Rank ${idx + 1}</p>
                    <p class="text-sm font-bold text-custom-teal">${c.name}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-gray-400 font-bold uppercase">Total Records</p>
                    <p class="text-lg font-bold text-custom-orange">${c.total}</p>
                </div>
            </div>
        `;
    });
}

function updateClientSummary(client) {
    const consults = consultationRecords.filter(r => r.clientId === client.id).length;
    const vax = vaccinationRecords.filter(r => r.clientId === client.id).length;
    const total = consults + vax;

    document.getElementById('client-summary-consults').innerText = consults;
    document.getElementById('client-summary-vax').innerText = vax;
    document.getElementById('client-summary-total').innerText = total;
}

// =============================
// CLIENT SEARCH
// =============================

async function searchClient(input, mode) {
    const value = input.value.trim().toLowerCase();
    const resultsDiv = document.getElementById(mode + '-search-results');

    if (!resultsDiv) {
        console.error("Search results container not found.");
        return;
    }

    resultsDiv.innerHTML = "";

    if (value.length < 1) {
        resultsDiv.classList.remove("show");
        return;
    }

    try {
        const response = await fetch("/vettrack/actions/get_owners.php");
        const result = await response.json();

        if (!result.success) {
            resultsDiv.innerHTML = `
                <div class="p-4 text-sm text-red-500">
                    ${result.message || "Unable to load owners."}
                </div>
            `;
            resultsDiv.classList.add("show");
            return;
        }

        registeredClients = result.owners;

        const filtered = registeredClients.filter(client => {
            const name = String(client.name || "").toLowerCase();
            const id = String(client.id || "").toLowerCase();

            return name.includes(value) || id.includes(value);
        });

        if (filtered.length === 0) {
            resultsDiv.innerHTML = `
                <div class="p-4 text-sm text-red-500">
                    No client found.
                </div>
            `;
        } else {
            filtered.forEach(client => {
                const item = document.createElement("div");

                item.className = "search-result-item";

                item.innerHTML = `
                    <strong>${client.name}</strong>
                    <span class="text-xs text-gray-400">
                        (${client.id})
                    </span>
                `;

                item.onclick = () => selectClient(client, mode);

                resultsDiv.appendChild(item);
            });
        }

        resultsDiv.classList.add("show");

    } catch (error) {
        console.error("Client search error:", error);

        resultsDiv.innerHTML = `
            <div class="p-4 text-sm text-red-500">
                Unable to load client records.
            </div>
        `;

        resultsDiv.classList.add("show");
    }
}
function selectClient(client, mode) {
    selectedClient = client;
    const resultsDiv = document.getElementById(mode + '-search-results');
    if(resultsDiv) resultsDiv.classList.remove('show');
    
    const searchInput = document.getElementById(mode + '-search');
    if(searchInput) searchInput.value = client.name + " (" + client.id + ")";
    
    if (mode === 'profile') {
        if(typeof renderCentralizedProfile === 'function') renderCentralizedProfile(client);
        if(typeof updateClientSummary === 'function') updateClientSummary(client); 
        return;
    }

    const form = document.getElementById(mode + '-form');
    if(form) {
        form.classList.remove('form-locked');
        document.getElementById(mode + '-name').value = client.name;
        document.getElementById(mode + '-id').value = client.id;
        document.getElementById(mode + '-brgy').value = client.barangay;
    }
    if (mode === 'vaccine') { 
        document.getElementById('animal-selection-area').classList.remove('hidden'); 
        if(typeof refreshAnimalList === 'function') refreshAnimalList(); 
    }
}

// =============================
// CLIENT REGISTRATION
// =============================

async function registerClient() {
    const fullName = document.getElementById('reg-name').value.trim();
    const gender = document.getElementById('reg-gender').value;
    const street = document.getElementById('reg-street').value.trim();
    const barangay = document.getElementById('reg-brgy').value.trim();
    const email = document.getElementById('reg-email').value.trim();
    const phone = document.getElementById('reg-phone').value.trim();

    if (!fullName || !gender || !street || !barangay) {
        alert("Please complete all required fields.");
        return;
    }

    const nameParts = fullName.split(/\s+/);
    const firstname = nameParts.shift();
    const lastname = nameParts.join(" ") || "N/A";

    const formData = new FormData();
    formData.append("firstname", firstname);
    formData.append("lastname", lastname);
    formData.append("gender", gender);
    formData.append("contact_number", phone);
    formData.append("email", email);
    formData.append("address", street + ", " + barangay);

    try {
        const response = await fetch("/vettrack/actions/save_owner.php", {
            method: "POST",
            body: formData
        });

        const result = await response.json();
        console.log("PHP response:", result);

        if (!response.ok || !result.success) {
            alert("Error: " + (result.message || "Unable to save owner."));
            return;
        }

        alert("Owner saved successfully. Owner ID: " + result.owner_id);

        document.getElementById("client-reg-form").reset();
        document.getElementById("reg-age").value = "";

        showSection("dashboard");

    } catch (error) {
        console.error("Registration error:", error);
        alert("Unable to save the owner. Check the browser console.");
    }
}
// =============================
// CONSULTATION SUBMIT
// =============================

function submitConsultation() {
    const date = document.getElementById('consult-input-date').value;
    const species = document.getElementById('consult-input-species').value;
    const disease = document.getElementById('consult-input-problem').value;
    const brgy = document.getElementById('consult-brgy').value;
    const treatment = document.getElementById('consult-input-treatment').value;
    const ageGroup = document.getElementById('consult-input-agegroup').value;
    if(!date || !species || !disease || !brgy) { alert("Please fill in all fields."); return; }
    consultationRecords.push({ date, brgy, species, ageGroup, disease, clientId: selectedClient.id, clientName: selectedClient.name, treatment: treatment, consultedM: parseInt(document.getElementById('consult-input-m-c').value) || 0, consultedF: parseInt(document.getElementById('consult-input-f-c').value) || 0, notConsultedM: parseInt(document.getElementById('consult-input-m-nc').value) || 0, notConsultedF: parseInt(document.getElementById('consult-input-f-nc').value) || 0 });
    alert("Consultation Form Submitted!");
    
    if(typeof renderTopActiveClients === 'function') renderTopActiveClients();
    
    document.getElementById('consult-form').reset();
    document.getElementById('consult-form').classList.add('form-locked');
    showSection('dashboard');
}

// =============================
// VACCINATION: ANIMAL MANAGEMENT
// =============================

function refreshAnimalList() {
    const listDiv = document.getElementById('animal-list');
    listDiv.innerHTML = selectedClient.animals.length === 0 ? `<p class="text-xs italic text-red-500">No pets.</p>` : "";
    selectedClient.animals.forEach(a => {
        const chip = document.createElement('div');
        chip.className = "animal-chip bg-white px-4 py-2 rounded-full shadow-sm text-sm font-bold text-custom-teal flex items-center gap-2";
        chip.innerHTML = `<i class="fas fa-${a.type === 'Dog' ? 'dog' : 'cat'}"></i> ${a.name}`;
        chip.onclick = () => {
            selectedAnimal = a; document.querySelectorAll('.animal-chip').forEach(el => el.classList.remove('selected'));
            chip.classList.add('selected');
            ['name', 'type', 'sex', 'age', 'color', 'bday'].forEach(k => {
                const field = document.getElementById('vaccine-pet-'+k);
                if(field) field.value = a[k === 'bday' ? 'birthdate' : k] || 'N/A';
            });
        };
        listDiv.appendChild(chip);
    });
}

function toggleAddPetForm() { 
    document.getElementById('add-pet-form').classList.toggle('hidden'); 
}

async function saveNewPet() {
    if (!selectedClient || !selectedClient.owner_id) {
        alert("Please select a client first.");
        return;
    }

    const name = document.getElementById("new-pet-name").value.trim();
    const species = document.getElementById("new-pet-type").value;
    const gender = document.getElementById("new-pet-sex").value;
    const birthDate = document.getElementById("new-pet-bday").value;
    const colorBreed = document.getElementById("new-pet-color").value.trim();

    if (!name || !species) {
        alert("Pet name and type are required.");
        return;
    }

    const formData = new FormData();

    formData.append("owner_id", selectedClient.owner_id);
    formData.append("pet_name", name);
    formData.append("species", species);
    formData.append("gender", gender);
    formData.append("birth_date", birthDate);
    formData.append("color", colorBreed);
    formData.append("breed", colorBreed);

    try {
        const response = await fetch("/vettrack/actions/save_pet.php", {
            method: "POST",
            body: formData
        });

        const text = await response.text();
        console.log("save_pet.php response:", text);

        let result;

        try {
            result = JSON.parse(text);
        } catch {
            throw new Error("Invalid PHP response: " + text);
        }

        if (!response.ok || !result.success) {
            alert("Error: " + (result.message || "Unable to save pet."));
            return;
        }

        alert("Pet saved successfully. Pet ID: " + result.pet_id);

        selectedClient.animals.push({
            pet_id: result.pet_id,
            name: name,
            type: species,
            species: species,
            sex: gender,
            gender: gender,
            birthdate: birthDate,
            age: document.getElementById("new-pet-age").value,
            color: colorBreed,
            breed: colorBreed
        });

        document.getElementById("add-pet-form").classList.add("hidden");

        document.querySelectorAll(
            "#add-pet-form input, #add-pet-form select"
        ).forEach(field => {
            field.value = "";
        });

        refreshAnimalList();

    } catch (error) {
        console.error("Pet save error:", error);
        alert(error.message);
    }
}
function submitVaccination() {
    const vDate = document.getElementById('vaccine-input-date').value;
    const vType = document.getElementById('vaccine-input-type').value;
    const vWeight = document.getElementById('vaccine-pet-weight').value;
    if(!vDate || !vType) return;
    vaccinationRecords.push({ 
        date: vDate, 
        brgy: selectedClient.barangay, 
        clientId: selectedClient.id, 
        clientName: selectedClient.name,
        petName: selectedAnimal.name, 
        petBirthdate: selectedAnimal.birthdate,
        species: selectedAnimal.type, 
        sex: selectedAnimal.sex,
        age: selectedAnimal.age,
        color: selectedAnimal.color,
        weight: vWeight,
        type: vType 
    });
    alert("Vaccination record saved!");
    
    if(typeof renderTopActiveClients === 'function') renderTopActiveClients();
    
    document.getElementById('vaccine-form').reset();
    document.getElementById('vaccine-form').classList.add('form-locked');
    showSection('dashboard');
}

// =============================
// MODAL FUNCTIONS
// =============================

function viewVaccinationDetail(record) {
    const body = document.getElementById('vax-modal-body');
    body.innerHTML = `
        <div class="col-span-2 text-custom-teal font-bold border-b pb-2 mb-2 text-xs uppercase tracking-widest">Submitted Form Data</div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Date</label><p class="text-sm font-bold">${record.date}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Barangay</label><p class="text-sm font-bold">${record.brgy}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Client Name</label><p class="text-sm">${record.clientName}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Client ID</label><p class="text-sm font-bold text-custom-teal">${record.clientId}</p></div>
        <div class="col-span-2"><label class="block text-[10px] font-bold text-gray-400 uppercase">Vaccine Type</label><p class="text-lg font-bold text-custom-orange">${record.type}</p></div>
        <div class="col-span-2 text-custom-teal font-bold border-b pb-2 mt-4 text-xs uppercase tracking-widest">Animal Information</div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Animal Name</label><p class="text-sm font-bold">${record.petName}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Pet Birthdate</label><p class="text-sm font-bold text-custom-teal">${record.petBirthdate || 'N/A'}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Species</label><p class="text-sm">${record.species}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Sex</label><p class="text-sm">${record.sex}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Age</label><p class="text-sm">${record.age}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Color/Breed</label><p class="text-sm">${record.color}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Weight Recorded</label><p class="text-sm font-bold text-custom-orange">${record.weight} kg</p></div>
    `;
    document.getElementById('vax-modal').classList.add('active');
}

function viewConsultationDetail(record) {
    const body = document.getElementById('consult-modal-body');
    body.innerHTML = `
        <div class="col-span-2 text-custom-teal font-bold border-b pb-2 mb-2 text-xs uppercase tracking-widest">Client & Session Info</div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Date of Consultation</label><p class="text-sm font-bold">${record.date}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Barangay</label><p class="text-sm font-bold">${record.brgy}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Client Name</label><p class="text-sm font-bold">${record.clientName}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Client ID</label><p class="text-sm font-bold text-custom-teal">${record.clientId}</p></div>
        
        <div class="col-span-2 text-custom-teal font-bold border-b pb-2 mt-4 text-xs uppercase tracking-widest">Animal Information</div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Species</label><p class="text-sm font-bold">${record.species}</p></div>
        <div><label class="block text-[10px] font-bold text-gray-400 uppercase">Age Group</label><p class="text-sm font-bold">${record.ageGroup}</p></div>
        <div class="bg-teal-50 p-3 rounded border border-teal-100">
            <label class="block text-[10px] font-bold text-teal-600 uppercase">Total Consulted</label>
            <p class="text-xs">Male: <span class="font-bold">${record.consultedM}</span> | Female: <span class="font-bold">${record.consultedF}</span></p>
        </div>
        <div class="bg-orange-50 p-3 rounded border border-orange-100">
            <label class="block text-[10px] font-bold text-orange-600 uppercase">Total NOT Consulted</label>
            <p class="text-xs">Male: <span class="font-bold">${record.notConsultedM}</span> | Female: <span class="font-bold">${record.notConsultedF}</span></p>
        </div>
        
        <div class="col-span-2"><label class="block text-[10px] font-bold text-gray-400 uppercase">Problems / Concerns Submitted</label><p class="text-md font-bold text-red-600">${record.disease}</p></div>
        <div class="col-span-2"><label class="block text-[10px] font-bold text-gray-400 uppercase">Treatment / Services Provided</label><div class="text-sm bg-gray-50 p-4 rounded-lg border italic text-gray-700">${record.treatment || 'No treatment recorded.'}</div></div>
    `;
    document.getElementById('consult-modal').classList.add('active');
}

function closeVaxModal(e) { if(e.target.id === 'vax-modal') document.getElementById('vax-modal').classList.remove('active'); }
function closeConsultModal(e) { if(e.target.id === 'consult-modal') document.getElementById('consult-modal').classList.remove('active'); }

// =============================
// PAGE INITIALIZATION
// =============================

window.onload = () => {
    const hBody = document.getElementById('health-table-body');
    const vBody = document.getElementById('vaccine-table-body');
    const brgyDatalist = document.getElementById('brgy-list');
    
    if(brgyDatalist) {
        brgys.forEach((name) => {
            brgyDatalist.innerHTML += `<option value="${name}">`;
        });
    }

    if(hBody) {
        brgys.forEach((name, index) => {
            const mockH = [index % 5, index % 3, index % 4, 0, 0, 0, index % 6, 0, index % 10, 0, 0];
            const totalH = mockH.reduce((a, b) => a + b, 0);
            hBody.innerHTML += `<tr><td class="p-2 font-bold bg-gray-50">${name}</td><td class="p-2 text-center">${mockH[0]}</td><td class="p-2 text-center">${mockH[1]}</td><td class="p-2 text-center">${mockH[2]}</td><td class="p-2 text-center">${mockH[3]}</td><td class="p-2 text-center">${mockH[4]}</td><td class="p-2 text-center">${mockH[5]}</td><td class="p-2 text-center">${mockH[6]}</td><td class="p-2 text-center">${mockH[7]}</td><td class="p-2 text-center">${mockH[8]}</td><td class="p-2 text-center">${mockH[9]}</td><td class="p-2 text-center">${mockH[10]}</td><td class="p-2 font-bold text-center">${totalH}</td></tr>`;
        });
    }

    if(vBody) {
        brgys.forEach((name, index) => {
            const mockV = [index * 3 + 10, index + 5];
            const totalV = mockV[0] + mockV[1];
            vBody.innerHTML += `<tr><td class="p-2 font-bold bg-gray-50">${name}</td><td class="p-2 text-center">${mockV[0]}</td><td class="p-2 text-center">${mockV[1]}</td><td class="p-2 font-bold text-center">${totalV}</td></tr>`;
        });
    }

    if(typeof initCharts === 'function') initCharts();
    if(typeof renderTopActiveClients === 'function') renderTopActiveClients(); 
};
