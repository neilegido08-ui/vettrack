<?php
// =============================
// VETTRACK - MAIN ENTRY POINT
// =============================
?>

<?php include 'includes/header.php'; ?>

    <!-- ============================= -->
    <!-- NAVBAR -->
    <!-- ============================= -->
    <?php include 'includes/navbar.php'; ?>

    <!-- ============================= -->
    <!-- PAGE HEADER -->
    <!-- ============================= -->
    <header class="bg-custom-teal text-white py-20 px-6">
        <div class="container mx-auto text-center">
            <h1 id="page-title" class="text-3xl md:text-4xl font-bold mb-2">Dashboard</h1>
            <p id="page-subtitle" class="text-teal-100 opacity-80">Quick glance at current system records</p>
        </div>
    </header>

    <!-- ============================= -->
    <!-- MAIN CONTENT -->
    <!-- ============================= -->
    <main class="container mx-auto px-6 -mt-10 mb-20">

        <?php include 'pages/dashboard.php'; ?>
        <?php include 'pages/registration.php'; ?>
        <?php include 'pages/consultation.php'; ?>
        <?php include 'pages/vaccination.php'; ?>
        <?php include 'pages/retrieval.php'; ?>
        <?php include 'pages/staff.php'; ?>
        <?php include 'pages/activity.php'; ?>
        <?php include 'pages/about.php'; ?>

    </main>

    <!-- ============================= -->
    <!-- FOOTER & SCRIPTS -->
    <!-- ============================= -->
    <?php include 'includes/footer.php'; ?>

