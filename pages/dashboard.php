    <!-- ============================= -->
    <!-- DASHBOARD SECTION -->
    <!-- ============================= -->
    <section id="dashboard" class="section active">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-custom-orange card-hover">
                <i class="fas fa-stethoscope text-3xl text-custom-teal mb-4"></i>
                <h3 class="text-gray-500 text-sm font-bold uppercase">Today's Consultations</h3>
                <p class="text-3xl font-bold text-custom-teal">14</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-custom-teal card-hover">
                <i class="fas fa-syringe text-3xl text-custom-teal mb-4"></i>
                <h3 class="text-gray-500 text-sm font-bold uppercase">Vaccinations Today</h3>
                <p class="text-3xl font-bold text-custom-teal">32</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-custom-orange card-hover">
                <i class="fas fa-map-marker-alt text-3xl text-custom-teal mb-4"></i>
                <h3 class="text-gray-500 text-sm font-bold uppercase">Active Barangays</h3>
                <p class="text-3xl font-bold text-custom-teal">6</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-custom-teal card-hover">
                <i class="fas fa-users text-3xl text-custom-teal mb-4"></i>
                <h3 class="text-gray-500 text-sm font-bold uppercase">Active Staff</h3>
                <p class="text-3xl font-bold text-custom-teal">4</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-10">
            <div class="bg-white p-8 rounded-xl shadow-md">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <i class="fas fa-chart-line text-custom-orange"></i> Quick Analysis
                    </h2>
                    <div class="flex items-center gap-3">
                        <div id="graph-btn-container">
                            <button id="nav-btn-0" onclick="showSection('retrieval'); openStatsView();" class="bg-custom-teal text-white text-[10px] font-bold px-3 py-2.5 rounded-md hover:bg-teal-900 transition uppercase tracking-tighter">Species Analysis <i class="fas fa-arrow-right ml-1"></i></button>
                            <button id="nav-btn-1" onclick="showSection('retrieval'); openStatsView();" class="hidden bg-custom-teal text-white text-[10px] font-bold px-3 py-2.5 rounded-md hover:bg-teal-900 transition uppercase tracking-tighter">Disease Trends <i class="fas fa-arrow-right ml-1"></i></button>
                            <button id="nav-btn-2" onclick="showSection('retrieval'); openVaccineStatsView();" class="hidden bg-custom-teal text-white text-[10px] font-bold px-3 py-2.5 rounded-md hover:bg-teal-900 transition uppercase tracking-tighter">Vax Trends <i class="fas fa-arrow-right ml-1"></i></button>
                            <button id="nav-btn-3" onclick="showSection('retrieval'); openVaccineStatsView();" class="hidden bg-custom-teal text-white text-[10px] font-bold px-3 py-2.5 rounded-md hover:bg-teal-900 transition uppercase tracking-tighter">Vaccine Distribution <i class="fas fa-arrow-right ml-1"></i></button>
                            <button id="nav-btn-4" onclick="showSection('retrieval'); openVaccineStatsView();" class="hidden bg-custom-teal text-white text-[10px] font-bold px-3 py-2.5 rounded-md hover:bg-teal-900 transition uppercase tracking-tighter">Species Vax <i class="fas fa-arrow-right ml-1"></i></button>
                        </div>

                        <div class="flex items-center gap-3 bg-gray-100 px-3 py-1.5 rounded-full">
                            <button onclick="slideGraph(-1)" class="text-gray-400 hover:text-custom-teal transition"><i class="fas fa-chevron-left"></i></button>
                            <span id="current-graph-label" class="text-[10px] font-bold uppercase tracking-widest text-custom-teal min-w-[100px] text-center">Species Stats</span>
                            <button onclick="slideGraph(1)" class="text-gray-400 hover:text-custom-teal transition"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                
                <div id="graph-0" class="graph-view active relative cursor-pointer" onclick="showSection('retrieval'); openStatsView();">
                    <canvas id="dashSpeciesChart"></canvas>
                </div>
                <div id="graph-1" class="graph-view relative cursor-pointer" onclick="showSection('retrieval'); openStatsView();">
                    <canvas id="dashDiseaseChart"></canvas>
                </div>
                <div id="graph-2" class="graph-view relative cursor-pointer" onclick="showSection('retrieval'); openVaccineStatsView();">
                    <canvas id="dashVaxLineChart"></canvas>
                </div>
                <div id="graph-3" class="graph-view relative cursor-pointer" onclick="showSection('retrieval'); openVaccineStatsView();">
                    <canvas id="dashVaxTypeChart"></canvas>
                </div>
                <div id="graph-4" class="graph-view relative cursor-pointer" onclick="showSection('retrieval'); openVaccineStatsView();">
                    <canvas id="dashVaxSpeciesChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-md">
                <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                    <i class="fas fa-tasks text-custom-orange"></i> Recent Activity
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded border-l-2 border-green-500">
                        <div class="text-xs font-bold text-gray-400 w-16">02:30 PM</div>
                        <p class="text-sm">New consultation record added in <strong>Panan-awan</strong></p>
                    </div>
                    <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded border-l-2 border-blue-500">
                        <div class="text-xs font-bold text-gray-400 w-16">01:15 PM</div>
                        <p class="text-sm">Vaccination form submitted by <strong>Maria Santos</strong></p>
                    </div>
                    <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded border-l-2 border-orange-500">
                        <div class="text-xs font-bold text-gray-400 w-16">09:00 AM</div>
                        <p class="text-sm">New staff account created for <strong>Lucas Mendez</strong></p>
                    </div>
                    <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded border-l-2 border-red-500">
                        <div class="text-xs font-bold text-gray-400 w-16">Yesterday</div>
                        <p class="text-sm">Animal Vaccination Yearly Report for 2025 – <strong>CSV File</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-md mt-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <i class="fas fa-clipboard-list text-custom-orange"></i> Top Active Clients
                </h2>
                <button onclick="showSection('retrieval'); openClientRecordsView();" class="bg-custom-teal text-white text-[10px] font-bold px-4 py-2 rounded-lg hover:bg-teal-900 transition uppercase tracking-widest shadow-sm">View All Records <i class="fas fa-external-link-alt ml-2"></i></button>
            </div>
            <div id="top-clients-ranking-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            </div>
        </div>
    </section>

