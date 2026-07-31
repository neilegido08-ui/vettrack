/* ============================= */
/* VETTRACK - DASHBOARD MODULE
/* ============================= */

// =============================
// GRAPH CAROUSEL
// =============================

let currentGraphIndex = 0;
const graphLabels = ["Species Analysis", "Disease Trends", "Vax Trends", "Vaccine Distribution", "Species Vax"];

function slideGraph(direction) {
    document.getElementById(`graph-${currentGraphIndex}`).classList.remove('active');
    document.getElementById(`nav-btn-${currentGraphIndex}`).classList.add('hidden');
    currentGraphIndex = (currentGraphIndex + direction + 5) % 5;
    document.getElementById(`graph-${currentGraphIndex}`).classList.add('active');
    document.getElementById(`nav-btn-${currentGraphIndex}`).classList.remove('hidden');
    document.getElementById('current-graph-label').innerText = graphLabels[currentGraphIndex];
}

// =============================
// DASHBOARD CHART INIT
// =============================

function initCharts() {
    const colors = ['#153e35', '#f18b33', '#10b981', '#ef4444', '#3b82f6'];
    const commonOptions = { responsive: true, maintainAspectRatio: false };
    const pieOptions = { responsive: true, maintainAspectRatio: false, scales: { x: { display: false }, y: { display: false } } };

    if(document.getElementById('dashSpeciesChart')) {
        dashboardCharts.species = new Chart(document.getElementById('dashSpeciesChart'), {
            type: 'bar',
            data: { labels: ['Swine', 'Cattle', 'Goat', 'Poultry'], datasets: [{ label: 'Consultations', data: [36, 5, 9, 8], backgroundColor: '#153e35' }] },
            options: commonOptions
        });
    }

    if(document.getElementById('dashDiseaseChart')) {
        dashboardCharts.disease = new Chart(document.getElementById('dashDiseaseChart'), {
            type: 'pie',
            data: { labels: ['Diarrhea', 'Fever', 'Foot Rot', 'Respiratory'], datasets: [{ data: [34, 11, 9, 20], backgroundColor: colors }] },
            options: pieOptions
        });
    }

    if(document.getElementById('dashVaxLineChart')) {
        dashboardCharts.vaxLine = new Chart(document.getElementById('dashVaxLineChart'), {
            type: 'line',
            data: { labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'], datasets: [{ label: 'Vax Records', data: [120, 145, 480, 520, 310, 290, 340, 410, 380, 445], borderColor: '#f18b33', fill: true, backgroundColor: 'rgba(241, 139, 51, 0.1)' }] },
            options: commonOptions
        });
    }

    if(document.getElementById('dashVaxTypeChart')) {
        dashboardCharts.vaxType = new Chart(document.getElementById('dashVaxTypeChart'), {
            type: 'pie',
            data: { labels: ['Anti-Rabies', '5-in-1', 'Rhinotracheitis'], datasets: [{ data: [1727, 420, 310], backgroundColor: ['#f18b33', '#153e35', '#10b981'] }] },
            options: pieOptions
        });
    }

    if(document.getElementById('dashVaxSpeciesChart')) {
        dashboardCharts.vaxSpecies = new Chart(document.getElementById('dashVaxSpeciesChart'), {
            type: 'bar',
            data: { labels: ['Dogs', 'Cats'], datasets: [{ label: 'Total Vaccinated', data: [1245, 482], backgroundColor: ['#153e35', '#f18b33'] }] },
            options: commonOptions
        });
    }
}
