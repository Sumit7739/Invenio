  // Define labels arrays
  const labelsBL = ['bl5', 'bl6', 'bl7', 'bl9'];
  const labelsSP = ['sp5', 'sp6', 'sp7', 'sp9'];
  const labelsWL = ['wl5', 'wl6', 'wl7', 'wl9'];
  const labelsLD = ['ld8', 'ld9', 'ld11', 'dld', 'pp'];
  const labelsCups = ['cups50', 'cups60', 'cups80', 'cups100', 'cups150', 'cups210', 'cups250'];
  const labelsBD = ['bd5', 'bd6', 'bd7'];
  const labelsCP = ['cp5', 'cp6', 'cp7', 'cp9'];

  Chart.defaults.font.size = 35;
  const options = {
      // Other chart options
      plugins: {
          tooltip: {
              bodyFont: {
                  size: 30 // Increase tooltip body font size (default is 12)
              },
              titleFont: {
                  size: 40 // Increase tooltip title font size (default is 16)
              }
          }
      }
  };

  const inventoryBLChartCtx = document.getElementById('inventoryBLChart').getContext('2d');
  const inventoryBLChart = new Chart(inventoryBLChartCtx, {
      type: 'pie',
      data: {
          labels: labelsBL,
          datasets: [{
              label: 'Inventory BL Quantities',
              backgroundColor: [
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 206, 86, 0.6)',
                  'rgba(75, 192, 192, 0.6)'
              ],
              data: Object.values(inventoryBLData)
          }]
      },
      options: options // Use the defined options object here
  });

  // Repeat for all other charts using the same options object

  const inventorySPChartCtx = document.getElementById('inventorySPChart').getContext('2d');
  const inventorySPChart = new Chart(inventorySPChartCtx, {
      type: 'pie',
      data: {
          labels: labelsSP,
          datasets: [{
              label: 'Inventory SP Quantities',
              backgroundColor: [
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 206, 86, 0.6)',
                  'rgba(75, 192, 192, 0.6)'
              ],
              data: Object.values(inventorySPData)
          }]
      }
  });

  const inventoryWLChartCtx = document.getElementById('inventoryWLChart').getContext('2d');
  const inventoryWLChart = new Chart(inventoryWLChartCtx, {
      type: 'pie',
      data: {
          labels: labelsWL,
          datasets: [{
              label: 'Inventory WL Quantities',
              backgroundColor: [
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 206, 86, 0.6)',
                  'rgba(75, 192, 192, 0.6)'
              ],
              data: Object.values(inventoryWLData)
          }]
      }
  });

  const inventoryLDChartCtx = document.getElementById('inventoryLDChart').getContext('2d');
  const inventoryLDChart = new Chart(inventoryLDChartCtx, {
      type: 'pie',
      data: {
          labels: labelsLD,
          datasets: [{
              label: 'Inventory LD Quantities',
              backgroundColor: [
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 206, 86, 0.6)',
                  'rgba(75, 192, 192, 0.6)'
              ],
              data: Object.values(inventoryLDData)
          }]
      }
  });

  const inventoryCupsChartCtx = document.getElementById('inventoryCupsChart').getContext('2d');
  const inventoryCupsChart = new Chart(inventoryCupsChartCtx, {
      type: 'pie',
      data: {
          labels: labelsCups,
          datasets: [{
              label: 'Inventory Cups Quantities',
              backgroundColor: [
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 206, 86, 0.6)',
                  'rgba(75, 192, 192, 0.6)'
              ],
              data: Object.values(inventoryCupsData)
          }]
      }
  });

  const inventoryBDChartCtx = document.getElementById('inventoryBDChart').getContext('2d');
  const inventoryBDChart = new Chart(inventoryBDChartCtx, {
      type: 'pie',
      data: {
          labels: labelsBD,
          datasets: [{
              label: 'Inventory BD Quantities',
              backgroundColor: [
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 206, 86, 0.6)',
                  'rgba(75, 192, 192, 0.6)'
              ],
              data: Object.values(inventoryBDData)
          }]
      }
  });

  const inventoryCPChartCtx = document.getElementById('inventoryCPChart').getContext('2d');
  const inventoryCPChart = new Chart(inventoryCPChartCtx, {
      type: 'pie',
      data: {
          labels: labelsCP,
          datasets: [{
              label: 'Inventory CP Quantities',
              backgroundColor: [
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 206, 86, 0.6)',
                  'rgba(75, 192, 192, 0.6)'
              ],
              data: Object.values(inventoryCPData)
          }]
      }
  });