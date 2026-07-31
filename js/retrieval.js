/* ============================= */
/* VETTRACK - RETRIEVAL MODULE
/* ============================= */

// =============================
// STATS VIEW NAVIGATION
// =============================

function openClientRecordsView() {
    document.getElementById('retrieval-cards').classList.add('hidden');
    document.getElementById('retrieval-client-profile').classList.remove('hidden');
    document.getElementById('page-title').innerText = "Client and Pet Records";
    document.getElementById('page-subtitle').innerText = "Centralized profile view of client, pets, and medical history";
}

function closeClientRecordsView() {
    document.getElementById('retrieval-cards').classList.remove('hidden');
    document.getElementById('retrieval-client-profile').classList.add('hidden');
    document.getElementById('page-title').innerText = meta['retrieval'][0];
    document.getElementById('page-subtitle').innerText = meta['retrieval'][1];
}

function openStatsView() {
    document.getElementById('retrieval-cards').classList.add('hidden');
    document.getElementById('retrieval-reports').classList.add('hidden');
    document.getElementById('vaccine-monitoring-stats').classList.add('hidden');
    document.getElementById('retrieval-stats').classList.remove('hidden');
    document.getElementById('page-title').innerText = "Animal and Case Records";
    document.getElementById('page-subtitle').innerText = "Consultation records and case analytics";
    if(typeof applyFilters === 'function') applyFilters();
}

function closeStatsView() {
    document.getElementById('retrieval-cards').classList.remove('hidden');
    document.getElementById('retrieval-stats').classList.add('hidden');
    document.getElementById('retrieval-reports').classList.add('hidden');
    document.getElementById('page-title').innerText = meta['retrieval'][0];
    document.getElementById('page-subtitle').innerText = meta['retrieval'][1];
}

function openVaccineStatsView() {
    document.getElementById('retrieval-cards').classList.add('hidden');
    document.getElementById('retrieval-reports').classList.add('hidden');
    document.getElementById('retrieval-stats').classList.add('hidden');
    document.getElementById('vaccine-monitoring-stats').classList.remove('hidden');
    document.getElementById('page-title').innerText = "Vaccination Monitoring";
    document.getElementById('page-subtitle').innerText = "Vaccination records and immunization statistics";
    if(typeof applyVaccineFilters === 'function') applyVaccineFilters();
}

function closeVaccineStatsView() {
    document.getElementById('retrieval-cards').classList.remove('hidden');
    document.getElementById('vaccine-monitoring-stats').classList.add('hidden');
    document.getElementById('retrieval-stats').classList.add('hidden');
    document.getElementById('retrieval-reports').classList.add('hidden');
    document.getElementById('page-title').innerText = meta['retrieval'][0];
    document.getElementById('page-subtitle').innerText = meta['retrieval'][1];
}

function openReportsView() {
    document.getElementById('retrieval-cards').classList.add('hidden');
    document.getElementById('retrieval-stats').classList.add('hidden');
    document.getElementById('vaccine-monitoring-stats').classList.add('hidden');
    document.getElementById('retrieval-reports').classList.remove('hidden');
    document.getElementById('page-title').innerText = "Report Summary";
    document.getElementById('page-subtitle').innerText = "Summarized data for official monitoring and analysis";
}

function closeReportsView() {
    document.getElementById('retrieval-cards').classList.remove('hidden');
    document.getElementById('retrieval-reports').classList.add('hidden');
    document.getElementById('retrieval-stats').classList.add('hidden');
    document.getElementById('vaccine-monitoring-stats').classList.add('hidden');
    document.getElementById('page-title').innerText = meta['retrieval'][0];
    document.getElementById('page-subtitle').innerText = meta['retrieval'][1];
}

// =============================
// CONSULTATION STATS FILTERS
// =============================

function applyFilters() {
    const fBrgy = document.getElementById('filter-brgy').value.toLowerCase();
    const fSpec = document.getElementById('filter-species').value;
    const fDis = document.getElementById('filter-disease').value.toLowerCase();
    const fMonth = document.getElementById('filter-month').value;
    const fYear = document.getElementById('filter-year').value;

    const filtered = consultationRecords.filter(r => {
        const date = new Date(r.date);
        const matchesBrgy = !fBrgy || r.brgy.toLowerCase().includes(fBrgy);
        const matchesSpec = !fSpec || r.species === fSpec;
        const matchesDis = !fDis || r.disease.toLowerCase().includes(fDis);
        const matchesMonth = !fMonth || date.getMonth().toString() === fMonth;
        const matchesYear = !fYear || date.getFullYear().toString() === fYear;
        return matchesBrgy && matchesSpec && matchesDis && matchesMonth && matchesYear;
    });

    updateStatsUI(filtered);
}

function resetFilters() {
    document.getElementById('filter-brgy').value = "";
    document.getElementById('filter-species').value = "";
    document.getElementById('filter-disease').value = "";
    document.getElementById('filter-month').value = "";
    document.getElementById('filter-year').value = "";
    applyFilters();
}

function updateStatsUI(data) {
    let totalC = 0, totalNC = 0;
    let brgyMap = {}, diseaseMap = {}, speciesMap = {}, monthlyMap = {};

    data.forEach(r => {
        const c = r.consultedM + r.consultedF;
        const nc = r.notConsultedM + r.notConsultedF;
        totalC += c; totalNC += nc;

        if(!brgyMap[r.brgy]) brgyMap[r.brgy] = { Swine: 0, Cattle: 0, Goat: 0, Poultry: 0, total: 0, consulted: 0, notConsulted: 0 };
        if(brgyMap[r.brgy][r.species] !== undefined) brgyMap[r.brgy][r.species] += c;
        brgyMap[r.brgy].total += c; brgyMap[r.brgy].consulted += c; brgyMap[r.brgy].notConsulted += nc;

        if(!diseaseMap[r.disease]) diseaseMap[r.disease] = { Swine: 0, Cattle: 0, Goat: 0, Poultry: 0, total: 0 };
        if(diseaseMap[r.disease][r.species] !== undefined) diseaseMap[r.disease][r.species] += c;
        diseaseMap[r.disease].total += c;

        speciesMap[r.species] = (speciesMap[r.species] || 0) + c;
        const mKey = new Date(r.date).toLocaleString('default', { month: 'short' });
        monthlyMap[mKey] = (monthlyMap[mKey] || 0) + c;
    });

    document.getElementById('stat-total-records').innerText = data.length;
    document.getElementById('stat-total-consulted').innerText = totalC;
    document.getElementById('stat-total-not-consulted').innerText = totalNC;
    document.getElementById('stat-total-cases').innerText = totalC;

    const brgyTable = document.getElementById('table-brgy-stats');
    brgyTable.innerHTML = "";
    for (let b in brgyMap) {
        brgyTable.innerHTML += `<tr><td class="p-3 font-bold">${b}</td><td class="p-3 text-center">${brgyMap[b].Swine}</td><td class="p-3 text-center">${brgyMap[b].Cattle}</td><td class="p-3 text-center">${brgyMap[b].Goat}</td><td class="p-3 text-center">${brgyMap[b].Poultry}</td><td class="p-3 text-center font-bold bg-orange-50">${brgyMap[b].total}</td><td class="p-3 text-center">${brgyMap[b].consulted}</td><td class="p-3 text-center">${brgyMap[b].notConsulted}</td></tr>`;
    }

    const disTable = document.getElementById('table-disease-stats');
    disTable.innerHTML = "";
    for (let d in diseaseMap) {
        disTable.innerHTML += `<tr><td class="p-3 font-bold">${d}</td><td class="p-3 text-center">${diseaseMap[d].Swine}</td><td class="p-3 text-center">${diseaseMap[d].Cattle}</td><td class="p-3 text-center">${diseaseMap[d].Goat}</td><td class="p-3 text-center">${diseaseMap[d].Poultry}</td><td class="p-3 text-center font-bold bg-orange-50">${diseaseMap[d].total}</td></tr>`;
    }

    const specList = document.getElementById('list-species-stats');
    specList.innerHTML = "";
    for (let s in speciesMap) {
        specList.innerHTML += `<div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border-l-4 border-custom-teal"><span class="font-bold text-custom-teal">${s}</span><span class="font-bold text-custom-orange">${speciesMap[s]} cases</span></div>`;
    }

    const commonTable = document.getElementById('table-common-disease');
    commonTable.innerHTML = "";
    for (let b in brgyMap) {
        let brgyDis = {};
        data.filter(x => x.brgy === b).forEach(x => brgyDis[x.disease] = (brgyDis[x.disease] || 0) + (x.consultedM + x.consultedF));
        let topDis = Object.keys(brgyDis).reduce((a, b_k) => brgyDis[a] > brgyDis[b_k] ? a : b_k, "None");
        commonTable.innerHTML += `<tr><td class="p-3 font-bold">${b}</td><td class="p-3">${topDis}</td><td class="p-3 text-center font-bold text-custom-orange">${brgyDis[topDis] || 0}</td></tr>`;
    }

    updateStatsCharts(speciesMap, diseaseMap, brgyMap, monthlyMap);
}

function updateStatsCharts(spec, dis, brgy, monthly) {
    if(statsCharts.species) statsCharts.species.destroy();
    if(statsCharts.disease) statsCharts.disease.destroy();
    if(statsCharts.brgy) statsCharts.brgy.destroy();
    if(statsCharts.line) statsCharts.line.destroy();

    statsCharts.species = new Chart(document.getElementById('statsSpeciesChart'), {
        type: 'bar',
        data: { labels: Object.keys(spec), datasets: [{ label: 'Cases', data: Object.values(spec), backgroundColor: '#153e35' }] },
        options: { responsive: true, maintainAspectRatio: false }
    });

    statsCharts.disease = new Chart(document.getElementById('statsDiseaseChart'), {
        type: 'pie',
        data: { labels: Object.keys(dis), datasets: [{ data: Object.values(dis).map(d => d.total), backgroundColor: ['#f18b33', '#153e35', '#10b981', '#ef4444', '#3b82f6'] }] },
        options: { responsive: true, maintainAspectRatio: false, scales: { x: { display: false }, y: { display: false } } }
    });

    statsCharts.brgy = new Chart(document.getElementById('statsBrgyChart'), {
        type: 'bar',
        data: { labels: Object.keys(brgy), datasets: [{ label: 'Total Cases', data: Object.values(brgy).map(b => b.total), backgroundColor: '#f18b33' }] },
        options: { responsive: true, maintainAspectRatio: false, indexAxis: 'y' }
    });

    statsCharts.line = new Chart(document.getElementById('statsLineChart'), {
        type: 'line',
        data: { labels: Object.keys(monthly), datasets: [{ label: 'Visits', data: Object.values(monthly), borderColor: '#153e35', tension: 0.3, fill: true, backgroundColor: 'rgba(21, 62, 53, 0.1)' }] },
        options: { responsive: true, maintainAspectRatio: false }
    });
}

// =============================
// VACCINE STATS FILTERS
// =============================

function applyVaccineFilters() {
    const fBrgy = document.getElementById('vax-filter-brgy').value.toLowerCase();
    const fSpec = document.getElementById('vax-filter-species').value;
    const fType = document.getElementById('vax-filter-type').value.toLowerCase();
    const fMonth = document.getElementById('vax-filter-month').value;
    const fYear = document.getElementById('vax-filter-year').value;

    const filtered = vaccinationRecords.filter(r => {
        const date = new Date(r.date);
        const matchesBrgy = !fBrgy || r.brgy.toLowerCase().includes(fBrgy);
        const matchesSpec = !fSpec || r.species === fSpec;
        const matchesType = !fType || r.type.toLowerCase().includes(fType);
        const matchesMonth = !fMonth || date.getMonth().toString() === fMonth;
        const matchesYear = !fYear || date.getFullYear().toString() === fYear;
        return matchesBrgy && matchesSpec && matchesType && matchesMonth && matchesYear;
    });

    updateVaccineUI(filtered);
}

function resetVaccineFilters() {
    document.getElementById('vax-filter-brgy').value = "";
    document.getElementById('vax-filter-species').value = "";
    document.getElementById('vax-filter-type').value = "";
    document.getElementById('vax-filter-month').value = "";
    document.getElementById('vax-filter-year').value = "";
    applyVaccineFilters();
}

function updateVaccineUI(data) {
    let totalRecords = data.length;
    let totalDogs = data.filter(r => r.species === "Dog").length;
    let totalCats = data.filter(r => r.species === "Cat").length;

    document.getElementById('vax-stat-total-records').innerText = totalRecords;
    document.getElementById('vax-stat-total-animals').innerText = totalRecords;
    document.getElementById('vax-stat-total-dogs').innerText = totalDogs;
    document.getElementById('vax-stat-total-cats').innerText = totalCats;

    let brgyMap = {}, typeMap = {}, monthlyMap = {};

    data.forEach(r => {
        if(!brgyMap[r.brgy]) brgyMap[r.brgy] = { Dog: 0, Cat: 0, total: 0, types: {} };
        brgyMap[r.brgy][r.species]++;
        brgyMap[r.brgy].total++;
        brgyMap[r.brgy].types[r.type] = (brgyMap[r.brgy].types[r.type] || 0) + 1;

        if(!typeMap[r.type]) typeMap[r.type] = { Dog: 0, Cat: 0, total: 0 };
        typeMap[r.type][r.species]++;
        typeMap[r.type].total++;

        const mKey = new Date(r.date).toLocaleString('default', { month: 'short' });
        monthlyMap[mKey] = (monthlyMap[mKey] || 0) + 1;
    });

    const brgyTable = document.getElementById('table-vax-brgy-stats');
    brgyTable.innerHTML = "";
    for (let b in brgyMap) {
        brgyTable.innerHTML += `<tr><td class="p-3 font-bold">${b}</td><td class="p-3 text-center">${brgyMap[b].Dog}</td><td class="p-3 text-center">${brgyMap[b].Cat}</td><td class="p-3 text-center font-bold bg-orange-50">${brgyMap[b].total}</td></tr>`;
    }

    const typeTable = document.getElementById('table-vax-type-stats');
    typeTable.innerHTML = "";
    for (let t in typeMap) {
        typeTable.innerHTML += `<tr><td class="p-3 font-bold">${t}</td><td class="p-3 text-center">${typeMap[t].Dog}</td><td class="p-3 text-center">${typeMap[t].Cat}</td><td class="p-3 text-center font-bold bg-orange-50">${typeMap[t].total}</td></tr>`;
    }

    const commonTable = document.getElementById('table-vax-common');
    commonTable.innerHTML = "";
    for (let b in brgyMap) {
        let topType = Object.keys(brgyMap[b].types).reduce((a, b_key) => brgyMap[b].types[a] > brgyMap[b].types[b_key] ? a : b_key, "N/A");
        commonTable.innerHTML += `<tr><td class="p-3 font-bold">${b}</td><td class="p-3">${topType}</td><td class="p-3 text-center font-bold text-custom-orange">${brgyMap[b].types[topType] || 0}</td></tr>`;
    }

    updateVaccineCharts(brgyMap, typeMap, monthlyMap, totalDogs, totalCats);
}

function updateVaccineCharts(brgy, type, monthly, totalDogs, totalCats) {
    if(vaxCharts.brgy) vaxCharts.brgy.destroy();
    if(vaxCharts.type) vaxCharts.type.destroy();
    if(vaxCharts.line) vaxCharts.line.destroy();
    if(vaxCharts.species) vaxCharts.species.destroy();

    vaxCharts.brgy = new Chart(document.getElementById('vaxBrgyChart'), {
        type: 'bar',
        data: { labels: Object.keys(brgy), datasets: [{ label: 'Animals Vaccinated', data: Object.values(brgy).map(b => b.total), backgroundColor: '#153e35' }] },
        options: { responsive: true, maintainAspectRatio: false }
    });

    vaxCharts.type = new Chart(document.getElementById('vaxTypeChart'), {
        type: 'pie',
        data: { labels: Object.keys(type), datasets: [{ data: Object.values(type).map(t => t.total), backgroundColor: ['#f18b33', '#153e35', '#10b981', '#ef4444'] }] },
        options: { responsive: true, maintainAspectRatio: false, scales: { x: { display: false }, y: { display: false } } }
    });

    vaxCharts.line = new Chart(document.getElementById('vaxMonthlyChart'), {
        type: 'line',
        data: { labels: Object.keys(monthly), datasets: [{ label: 'Records', data: Object.values(monthly), borderColor: '#f18b33', fill: true, backgroundColor: 'rgba(241, 139, 51, 0.1)' }] },
        options: { responsive: true, maintainAspectRatio: false }
    });

    vaxCharts.species = new Chart(document.getElementById('vaxSpeciesChart'), {
        type: 'bar',
        data: { labels: ['Dogs', 'Cats'], datasets: [{ label: 'Total Vaccinated', data: [totalDogs, totalCats], backgroundColor: ['#153e35', '#f18b33'] }] },
        options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
    });
}

// =============================
// CLIENT PROFILE MANAGEMENT
// =============================

function renderCentralizedProfile(client) {
    document.getElementById('profile-display-area').classList.remove('hidden');
    
    document.getElementById('view-prof-name').innerText = client.name;
    document.getElementById('view-prof-id').innerText = client.id;
    document.getElementById('view-prof-bday').innerText = `${client.birthdate} (Age: ${client.age})`;
    document.getElementById('view-prof-brgy').innerText = client.barangay;
    document.getElementById('view-prof-addr').innerText = client.street || 'N/A';
    document.getElementById('view-prof-phone').innerText = client.phone || 'N/A';
    document.getElementById('view-prof-email').innerText = client.email || 'N/A';

    const petListDiv = document.getElementById('view-prof-pet-list');
    petListDiv.innerHTML = client.animals.length === 0 ? '<p class="text-xs italic text-gray-400">No registered pets found.</p>' : '';
    client.animals.forEach(pet => {
        const chip = document.createElement('div');
        chip.className = "animal-chip bg-white px-6 py-4 rounded-xl shadow-md text-sm font-bold text-custom-teal flex items-center gap-3 border hover-bg-gray-50 transition";
        chip.innerHTML = `<i class="fas fa-${pet.type.toLowerCase() === 'dog' ? 'dog' : 'cat'} text-xl text-custom-orange"></i> 
                          <div><p class="leading-none mb-1">${pet.name}</p><p class="text-[10px] text-gray-400 uppercase font-normal">${pet.type}</p></div>`;
        chip.onclick = (e) => {
            document.querySelectorAll('#view-prof-pet-list .animal-chip').forEach(c => c.classList.remove('selected'));
            chip.classList.add('selected');
            selectPetForProfile(pet);
        };
        petListDiv.appendChild(chip);
    });
    document.getElementById('pet-detail-box').classList.add('hidden');

    const consultHistoryTable = document.getElementById('table-client-consult-history');
    const history = consultationRecords.filter(r => r.clientId === client.id);
    consultHistoryTable.innerHTML = history.length === 0 ? '<tr><td colspan="4" class="p-8 text-center italic text-gray-400">No consultation records available.</td></tr>' : '';
    history.forEach(r => {
        const row = document.createElement('tr');
        row.className = "hover-bg-teal-50 cursor-pointer transition";
        row.onclick = () => {
            if(typeof viewConsultationDetail === 'function') viewConsultationDetail(r);
        };
        row.innerHTML = `
            <td class="p-4 font-bold text-custom-teal">${r.date}</td>
            <td class="p-4"><span class="bg-teal-100 text-teal-800 px-2 py-0.5 rounded text-[10px] font-bold uppercase">${r.species}</span></td>
            <td class="p-4">${r.disease}</td>
            <td class="p-4 text-xs">${r.treatment || 'N/A'}</td>
        `;
        consultHistoryTable.appendChild(row);
    });
}

function selectPetForProfile(pet) {
    selectedAnimal = pet; 
    document.getElementById('pet-detail-box').classList.remove('hidden');
    document.getElementById('p-det-name').innerText = pet.name;
    document.getElementById('p-det-type').innerText = pet.type;
    document.getElementById('p-det-sex').innerText = pet.sex || 'N/A';
    document.getElementById('p-det-age').innerText = pet.age || 'N/A';
    document.getElementById('p-det-bday').innerText = pet.birthdate || 'N/A';
    document.getElementById('p-det-color').innerText = pet.color || 'N/A';

    const vaxBody = document.getElementById('table-pet-vax-history');
    const history = vaccinationRecords.filter(v => v.petName === pet.name && v.clientId === selectedClient.id);
    vaxBody.innerHTML = history.length === 0 ? '<tr><td colspan="2" class="p-4 text-center italic text-gray-400">No vaccination records found.</td></tr>' : '';
    history.forEach(v => {
        const row = document.createElement('tr');
        row.className = "hover-bg-orange-50 cursor-pointer transition";
        row.onclick = () => {
            if(typeof viewVaccinationDetail === 'function') viewVaccinationDetail(v);
        };
        row.innerHTML = `
            <td class="p-3 border-b">${v.date}</td>
            <td class="p-3 border-b font-bold text-custom-orange">${v.type}</td>
        `;
        vaxBody.appendChild(row);
    });
}

function toggleEditClientForm() {
    const container = document.getElementById('edit-client-form-container');
    container.classList.toggle('hidden');
    if(!container.classList.contains('hidden')) {
        document.getElementById('edit-client-name').value = selectedClient.name;
        document.getElementById('edit-client-bday').value = selectedClient.birthdate;
        document.getElementById('edit-client-age').value = selectedClient.age;
        document.getElementById('edit-client-phone').value = selectedClient.phone;
        document.getElementById('edit-client-street').value = selectedClient.street;
        document.getElementById('edit-client-brgy').value = selectedClient.barangay;
        document.getElementById('edit-client-email').value = selectedClient.email;
    }
}

function saveClientEdit() {
    const oldId = selectedClient.id;
    selectedClient.name = document.getElementById('edit-client-name').value;
    selectedClient.birthdate = document.getElementById('edit-client-bday').value;
    selectedClient.age = document.getElementById('edit-client-age').value;
    selectedClient.phone = document.getElementById('edit-client-phone').value;
    selectedClient.street = document.getElementById('edit-client-street').value;
    selectedClient.barangay = document.getElementById('edit-client-brgy').value;
    selectedClient.email = document.getElementById('edit-client-email').value;
    
    // Synchronize Client Info across all Consultation Records
    consultationRecords.forEach(r => {
        if (r.clientId === oldId) {
            r.clientName = selectedClient.name;
            r.brgy = selectedClient.barangay;
        }
    });

    // Synchronize Client Info across all Vaccination Records
    vaccinationRecords.forEach(v => {
        if (v.clientId === oldId) {
            v.clientName = selectedClient.name;
            v.brgy = selectedClient.barangay;
        }
    });

    alert("Client information updated across system records!");
    toggleEditClientForm();
    renderCentralizedProfile(selectedClient);
}

function toggleEditPetForm() {
    const container = document.getElementById('edit-pet-form-container');
    container.classList.toggle('hidden');
    if(!container.classList.contains('hidden') && selectedAnimal) {
        document.getElementById('edit-pet-name-field').value = selectedAnimal.name;
        document.getElementById('edit-pet-type-field').value = selectedAnimal.type;
        document.getElementById('edit-pet-sex-field').value = selectedAnimal.sex || 'Male';
        document.getElementById('edit-pet-age-field').value = selectedAnimal.age;
        document.getElementById('edit-pet-bday-field').value = selectedAnimal.birthdate || '';
        document.getElementById('edit-pet-color-field').value = selectedAnimal.color;
    }
}

function savePetEdit() {
    const oldPetName = selectedAnimal.name;
    selectedAnimal.name = document.getElementById('edit-pet-name-field').value;
    selectedAnimal.type = document.getElementById('edit-pet-type-field').value;
    selectedAnimal.sex = document.getElementById('edit-pet-sex-field').value;
    selectedAnimal.age = document.getElementById('edit-pet-age-field').value;
    selectedAnimal.birthdate = document.getElementById('edit-pet-bday-field').value;
    selectedAnimal.color = document.getElementById('edit-pet-color-field').value;
    
    // Synchronize Pet Info across related Vaccination Records
    vaccinationRecords.forEach(v => {
        if (v.clientId === selectedClient.id && v.petName === oldPetName) {
            v.petName = selectedAnimal.name;
            v.petBirthdate = selectedAnimal.birthdate;
            v.species = selectedAnimal.type;
            v.sex = selectedAnimal.sex;
            v.age = selectedAnimal.age;
            v.color = selectedAnimal.color;
        }
    });

    alert("Pet record updated successfully across historical records!");
    toggleEditPetForm();
    renderCentralizedProfile(selectedClient);
    selectPetForProfile(selectedAnimal);
}

// =============================
// REPORT VIEW TOGGLES
// =============================

function toggleReportView(type) {
    document.getElementById('report-health-content').classList.toggle('hidden', type !== 'health');
    document.getElementById('report-vaccine-content').classList.toggle('hidden', type === 'health');
    document.getElementById('btn-health').classList.toggle('bg-custom-orange', type === 'health');
    document.getElementById('btn-health').classList.toggle('text-white', type === 'health');
    document.getElementById('btn-vaccine').classList.toggle('bg-custom-orange', type !== 'health');
    document.getElementById('btn-vaccine').classList.toggle('text-white', type !== 'health');
}

function toggleInterval(type) {
    document.getElementById('btn-monthly').classList.toggle('bg-custom-teal', type === 'monthly');
    document.getElementById('btn-yearly').classList.toggle('bg-custom-teal', type !== 'monthly');
}
