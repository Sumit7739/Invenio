const ctx = document.getElementById('verticalChart').getContext('2d');

// Data preparation: Flatten all item names and their corresponding values
const labels = [
    'BL5', 'BL6', 'BL7', 'BL9', // BL items
    'SP5', 'SP6', 'SP7', 'SP9', // SP items
    'WL5', 'WL6', 'WL7', 'WL9', // WL items
    'LD8', 'LD9', 'LD11', 'DLD', 'PP', // LD items
    '50ml', '60ml', '80ml', '100ml', '150ml', '210ml', '250ml', // Cups
    'BD5', 'BD6', 'BD7', // BD items
    'CP5', 'CP6', 'CP7', 'CP9' // CP items
];

const dataValues = [
    inventoryBLData.bl5, inventoryBLData.bl6, inventoryBLData.bl7, inventoryBLData.bl9,
    inventorySPData.sp5, inventorySPData.sp6, inventorySPData.sp7, inventorySPData.sp9,
    inventoryWLData.wl5, inventoryWLData.wl6, inventoryWLData.wl7, inventoryWLData.wl9,
    inventoryLDData.ld8, inventoryLDData.ld9, inventoryLDData.ld11, inventoryLDData.dld, inventoryLDData.pp,
    inventoryCupsData.cups50, inventoryCupsData.cups60, inventoryCupsData.cups80, inventoryCupsData.cups100, inventoryCupsData.cups150, inventoryCupsData.cups210, inventoryCupsData.cups250,
    inventoryBDData.bd5, inventoryBDData.bd6, inventoryBDData.bd7,
    inventoryCPData.cp5, inventoryCPData.cp6, inventoryCPData.cp7, inventoryCPData.cp9
];

// Generate the chart
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Inventory Data',
                data: dataValues,
                backgroundColor: [
                    '#007bff', '#007bff', '#007bff', '#007bff', // BL (blue)
                    '#28a745', '#28a745', '#28a745', '#28a745', // SP (green)
                    '#ffc107', '#ffc107', '#ffc107', '#ffc107', // WL (yellow)
                    '#dc3545', '#dc3545', '#dc3545', '#dc3545', '#dc3545', // LD (red)
                    '#6f42c1', '#6f42c1', '#6f42c1', '#6f42c1', '#6f42c1', '#6f42c1', '#6f42c1', // Cups (purple)
                    '#17a2b8', '#17a2b8', '#17a2b8', // BD (teal)
                    '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14' // CP (orange)
                ]
            }
        ]
    },
    options: {
        indexAxis: 'y', // Switch axis to make it vertical
        responsive: true,
        plugins: {
            legend: {
                display: false // No need for a legend since categories are clear
            },
            tooltip: {
                enabled: true
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantity'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Items'
                }
            }
        }
    }
});
