<!-- ============================= -->
    <!-- VACCINATION DETAIL MODAL -->
    <!-- ============================= -->

    <div id="vax-modal" class="modal-overlay" onclick="closeVaxModal(event)">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-custom-orange p-4 text-white flex justify-between items-center">
                <h3 class="font-bold uppercase tracking-wider text-sm"><i class="fas fa-syringe mr-2"></i> Vaccination Record Details</h3>
                <button onclick="document.getElementById('vax-modal').classList.remove('active')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
            </div>
            <div id="vax-modal-body" class="p-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            </div>
            <div class="p-4 bg-gray-50 flex justify-end">
                <button onclick="document.getElementById('vax-modal').classList.remove('active')" class="bg-custom-teal text-white px-6 py-2 rounded-lg font-bold uppercase text-xs">Close</button>
            </div>
        </div>
    </div>

    <!-- ============================= -->
    <!-- CONSULTATION DETAIL MODAL -->
    <!-- ============================= -->
    <div id="consult-modal" class="modal-overlay" onclick="closeConsultModal(event)">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-custom-teal p-4 text-white flex justify-between items-center">
                <h3 class="font-bold uppercase tracking-wider text-sm"><i class="fas fa-stethoscope mr-2"></i> Consultation Record Details</h3>
                <button onclick="document.getElementById('consult-modal').classList.remove('active')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
            </div>
            <div id="consult-modal-body" class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            </div>
            <div class="p-4 bg-gray-50 flex justify-end">
                <button onclick="document.getElementById('consult-modal').classList.remove('active')" class="bg-custom-teal text-white px-6 py-2 rounded-lg font-bold uppercase text-xs">Close</button>
            </div>
        </div>
    </div>

    <!-- ============================= -->
    <!-- FOOTER -->
    <!-- ============================= -->
    <footer class="bg-custom-teal text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <div class="flex justify-center gap-6 mb-6 opacity-40 text-xl">
                <i class="fas fa-paw"></i>
                <i class="fas fa-shield-cat"></i>
                <i class="fas fa-shield-dog"></i>
            </div>
            <p class="text-xs opacity-60">&copy; 2023 VetTrack Management System. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- ============================= -->
    <!-- JAVASCRIPT FILES -->
    <!-- ============================= -->
 <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script src="/vettrack/js/app.js"></script>
<script src="/vettrack/js/chart.js"></script>
<script src="/vettrack/js/search.js"></script>
<script src="/vettrack/js/dashboard.js"></script>
<script src="/vettrack/js/registration.js"></script>
<script src="/vettrack/js/consultation.js"></script>
<script src="/vettrack/js/vaccination.js"></script>
<script src="/vettrack/js/retrieval.js"></script>
</body>
</html>