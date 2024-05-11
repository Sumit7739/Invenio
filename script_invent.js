function toggleContainer(containerId) {
  const nameSection = document.querySelector(`#${containerId} h3:nth-child(2)`); 
  const itemsSection = document.querySelector(
    `#${containerId} h3:nth-child(3)`
  ); 

  nameSection.classList.toggle("hidden");
  itemsSection.classList.toggle("hidden");
}

let isAscending = false; 

function toggleSorting() {
  isAscending = !isAscending; 
  const sortIcon = document.getElementById("sortIcon");
  sortIcon.classList.toggle("rotate", isAscending); 

  
  const containers = document.querySelectorAll(".container");

  
  const containersArray = Array.from(containers);

  
  const sortedContainers = containersArray.sort((a, b) => {
    const dateA = new Date(a.querySelector("h3").innerText.split(" - ")[1]);
    const dateB = new Date(b.querySelector("h3").innerText.split(" - ")[1]);

    return isAscending ? dateA - dateB : dateB - dateA;
  });

  
  const dataSection = document.getElementById("dataSection");
  dataSection.innerHTML = "";

  
  sortedContainers.forEach((container) => {
    dataSection.appendChild(container);
  });
}

document.getElementById("search-btn").addEventListener("click", function () {
  const inputDate = document.getElementById("calendar").value;
  const containers = document.querySelectorAll(".container");
  const resultsSection = document.getElementById("dataSection");

  
  const inputDateFormatted = formatDate(inputDate);

  
  const filteredContainers = Array.from(containers).filter((container) => {
    const containerDate = container
      .querySelector("h3")
      .textContent.split(" - ")[1]
      .trim(); 
    return containerDate === inputDateFormatted;
  });

  
  resultsSection.innerHTML = "";

  
  if (filteredContainers.length > 0) {
    filteredContainers.forEach((container) => {
      resultsSection.appendChild(container.cloneNode(true)); 
    });
  } else {
    const noResultsMessage = document.createElement("p");
    noResultsMessage.textContent = "No data found for the selected date.";
    resultsSection.appendChild(noResultsMessage);
  }
});


function formatDate(dateString) {
  const [year, month, day] = dateString.split("-");
  return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
}
