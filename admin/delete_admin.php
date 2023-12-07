<?php

// 0. Include constants.php
include('../config/constants.php');

// 1. Get the ID of the admin to be deleted
$id = $_GET['id'];

// 2. Check if the delete confirmation is received
if (isset($_GET['confirm'])) {
    if ($_GET['confirm'] === 'yes') {
        // 3. Delete the admin
        // Create SQL query to delete admin
        $sql = "DELETE FROM tbl_admin WHERE id=$id";

        // Execute query
        $res = mysqli_query($conn, $sql);

        // Check if the admin is deleted successfully
        if ($res == TRUE) {
            $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        } else {
            $_SESSION['delete'] = "<div class='failed'>Admin Deletion Failed.</div>";
        }
    }
    
    // Redirect to Manage_Admin
    header('location:' . SITEURL . 'admin/manage_admin.php');
    exit();
}

?>

<!-- Add warning message to confirm deletion -->
<script>
    function confirmDeletion() {
        var result = confirm("Are you sure you want to delete this admin?");
        if (result) {
            // If confirmed, redirect to delete with confirmation
            window.location.href = "<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>&confirm=yes";
        } else {
            // If canceled, redirect to manage_admin.php
            window.location.href = "<?php echo SITEURL; ?>admin/manage_admin.php";
        }
    }
</script>

<!-- Call the confirmation function on page load -->
<body onload="confirmDeletion();"></body>
