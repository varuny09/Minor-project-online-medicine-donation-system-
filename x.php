<?php
session_start();

// Check if $_SESSION['username'] is set
$userSignedIn = isset($_SESSION['username']);

// If there is an error in session, set $userSignedIn to false
if(!$userSignedIn) {
    $error = "Error: Unable to retrieve user session.";
}
?>

<script>
    <?php if(isset($error)): ?>
        alert('<?php echo $error; ?>');
        window.location.href = 'login_required.php'; // Redirect to login page if there's an error
    <?php else: ?>
        var userSignedIn = <?php echo $userSignedIn ? 'true' : 'false'; ?>;
        if (userSignedIn) {
            // Redirect to the donation form page
            window.location.href = 'donationform.php';
        } else {
            // Display a pop-up or alert to prompt the user to sign in
            alert('Please sign in to fill the donation form.');
            // Redirect to the login page
            window.location.href = 'login_required.php';
        }
    <?php endif; ?>
</script>