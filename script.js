function toggleMode() {
  const darkModeIcon = document.getElementById("darkModeIcon");

  // Toggle dark mode icon
  if (darkModeIcon.classList.contains("fa-moon")) {
    darkModeIcon.classList.remove("fa-moon");
    darkModeIcon.classList.add("fa-sun");
  } else {
    darkModeIcon.classList.remove("fa-sun");
    darkModeIcon.classList.add("fa-moon");
  }

  const container = document.querySelector(".form-container");
  container.classList.toggle("dark-mode");
}

// Function to toggle visibility of the Black Loose section
function toggleBlackLoose() {
  const blackLooseSection = document.getElementById("blackLooseSection");
  const toggleIcon = document.getElementById("toggleIcon");

  if (blackLooseSection.style.display === "none") {
    blackLooseSection.style.display = "block";
    toggleIcon.innerText = "▲";
  } else {
    blackLooseSection.style.display = "none";
    toggleIcon.innerText = "▼";
  }
}
function toggleStarPacket() {
  const starPacketSection = document.getElementById("starPacketSection");
  const toggleIcon = document.getElementById("toggleIcon");

  if (starPacketSection.style.display === "none") {
    starPacketSection.style.display = "block";
    toggleIcon.innerText = "▲";
  } else {
    starPacketSection.style.display = "none";
    toggleIcon.innerText = "▼";
  }
}
function toggleWhiteLoose() {
  const whiteLooseSection = document.getElementById("whiteLooseSection");
  const wlToggleIcon = document.getElementById("wlToggleIcon");

  if (whiteLooseSection.style.display === "none") {
    whiteLooseSection.style.display = "block";
    wlToggleIcon.innerText = "▲";
  } else {
    whiteLooseSection.style.display = "none";
    wlToggleIcon.innerText = "▼";
  }
}
function toggleLDSoma() {
  const ldSomaSection = document.getElementById("ldSomaSection");
  const ldSomaToggleIcon = document.getElementById("ldSomaToggleIcon");

  if (ldSomaSection.style.display === "none") {
    ldSomaSection.style.display = "block";
    ldSomaToggleIcon.innerText = "▲";
  } else {
    ldSomaSection.style.display = "none";
    ldSomaToggleIcon.innerText = "▼";
  }
}

function toggleCups() {
  const cupsSection = document.getElementById("cupsSection");
  const cupsToggleIcon = document.getElementById("cupsToggleIcon");

  if (cupsSection.style.display === "none") {
    cupsSection.style.display = "block";
    cupsToggleIcon.innerText = "▲";
  } else {
    cupsSection.style.display = "none";
    cupsToggleIcon.innerText = "▼";
  }
}
function toggleBlackDelhi() {
  const blackDelhiSection = document.getElementById("blackDelhiSection");
  const blackDelhiToggleIcon = document.getElementById("blackDelhiToggleIcon");

  if (blackDelhiSection.style.display === "none") {
    blackDelhiSection.style.display = "block";
    blackDelhiToggleIcon.innerText = "▲";
  } else {
    blackDelhiSection.style.display = "none";
    blackDelhiToggleIcon.innerText = "▼";
  }
}

function toggleCover() {
  const coverSection = document.getElementById("coverSection");
  const coverToggleIcon = document.getElementById("coverToggleIcon");

  if (coverSection.style.display === "none") {
    coverSection.style.display = "block";
    coverToggleIcon.innerText = "▲";
  } else {
    coverSection.style.display = "none";
    coverToggleIcon.innerText = "▼";
  }
}
