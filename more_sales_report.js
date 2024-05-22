
const labelsPY = Object.keys(inventoryPyData);
const dataPY = Object.values(inventoryPyData);

Chart.defaults.font.size = 35;
const options = {
    plugins: {
        tooltip: {
            bodyFont: {
                size: 30
            },
            titleFont: {
                size: 40
            }
        }
    }
};

const inventoryPYChartCtx = document.getElementById('inventoryPYChart').getContext('2d');
const inventoryPYChart = new Chart(inventoryPYChartCtx, {
    type: 'pie',
    data: {
        labels: labelsPY,
        datasets: [{
            label: 'Inventory PY Quantities',
            backgroundColor: [
                // 'rgba(75, 192, 192, 0.6)',  // Teal
                // 'rgba(153, 102, 255, 0.6)', // Purple
                'rgba(255, 159, 64, 0.6)',  // Orange
                // 'rgba(255, 205, 86, 0.6)', //yellow
                'rgba(201, 203, 207, 0.6)', // Grey
                // 'rgba(54, 162, 235, 0.6)',  // Blue
                // 'rgba(255, 99, 132, 0.6)'   // Red  // Yellow
            ],
            data: dataPY
        }]
    },
    options: options
});