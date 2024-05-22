  // Countdown timer for redirection
  var countdownElement = document.getElementById('countdown');
  var countdown = 1;

  var timer = setInterval(function() {
      countdown--;
      countdownElement.textContent = 'Redirecting in ' + countdown + ' seconds...';
      if (countdown <= 0) {
          clearInterval(timer);
          window.location.href = 'manage_system.php';
      }
  }, 1000);