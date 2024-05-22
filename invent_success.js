 // Countdown timer for redirection
 var countdownElement = document.getElementById('countdown');
 var countdown = 3;
 var timer = setInterval(function() {
     countdown--;
     countdownElement.textContent = 'Redirecting in ' + countdown + ' seconds...';
 }, 1000);

 setTimeout(function() {
     window.location.href = 'inventory_data.php?id=<?php echo $itemId; ?>';
 }, 3000);