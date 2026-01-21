<!doctype html>
<html>
<head>
    <title>Admin Announcements - Telemedicine++</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/doctor/generate_report.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/patientPortal" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_appointments" class="menu-btn active">Manage Appointments</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_medicines" class="menu-btn">Manage Medicines</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_lab_tests" class="menu-btn">Lab Tests</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="<?php echo ROOT ?>/patientPortal/profile" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <h2>Generated Report by <?php echo htmlspecialchars($data['doctor_data']['d_title'] . " " . $data['doctor_data']['d_first_name'] . " " . $data['doctor_data']['d_last_name']);?></h2>
            <?php if (!empty($data['patient_data'])): ?>
                <h3>Report Information</h3>
                <form method="POST" action="<?php echo ROOT ?>/patientPortal/view_report?p_nid_no=<?php echo urlencode($data['patient_data']['p_nid_no']); ?>">
                    <div class="two-columns-info">
                        
                    </div>

                    <label for="report_content">Report Content:</label><br>
                    <textarea id="report_content" name="report_content" placeholder="<?php echo htmlspecialchars($data['report_data']['text'])?>" disabled></textarea>
                </form>
            <?php else: ?>
                <p>No patient data found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>