document.addEventListener('DOMContentLoaded', function () {
    const countries = ["Norvégia", "Olaszország", "Magyarország", "Németország", "Bulgária", "Románia"];
    
    // Data for vehicle types distribution
    const vehicleData = {
        "Norvégia": { diesel: 10, gasoline: 20, electric: 50, hybrid: 20 },
        "Olaszország": { diesel: 30, gasoline: 40, electric: 10, hybrid: 20 },
        "Magyarország": { diesel: 25, gasoline: 35, electric: 15, hybrid: 25 },
        "Németország": { diesel: 20, gasoline: 30, electric: 25, hybrid: 25 },
        "Bulgária": { diesel: 40, gasoline: 40, electric: 5, hybrid: 15 },
        "Románia": { diesel: 35, gasoline: 45, electric: 8, hybrid: 12 },
    };

    // Data for fuel expenditures
    const fuelExpenditureData = {
        "Norvégia": { diesel: 50000000.00, gasoline: 40000000.00 },
        "Olaszország": { diesel: 60000000.00, gasoline: 45000000.00 },
        "Magyarország": { diesel: 35000000.00, gasoline: 32000000.00 },
        "Németország": { diesel: 70000000.00, gasoline: 60000000.00 },
        "Bulgária": { diesel: 20000000.00, gasoline: 18000000.00 },
        "Románia": { diesel: 25000000.00, gasoline: 22000000.00 },
    };

    const countrySelect = document.getElementById('countrySelect');
    countries.forEach(country => {
        let option = document.createElement('option');
        option.value = country;
        option.textContent = country;
        countrySelect.appendChild(option);
    });

    const ctx1 = document.getElementById('chart').getContext('2d');
    const ctx2 = document.getElementById('chart2').getContext('2d');
    let chart1, chart2;

    // Function to update vehicle type distribution chart
    function updateChart1(country) {
        const chartData = vehicleData[country];
        const labels = Object.keys(chartData);
        const values = Object.values(chartData);

        if (chart1) {
            chart1.destroy();
        }

        chart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Járműtípusok Megoszlása (%)',
                    data: values,
                    backgroundColor: ['#0077cc', '#ffd700', '#28a745', '#17a2b8']
                }]
            }
        });
    }

    // Function to update fuel expenditure chart
    function updateChart2(country) {
        const chartData = fuelExpenditureData[country];
        const labels = Object.keys(chartData);
        const values = Object.values(chartData);

        if (chart2) {
            chart2.destroy();
        }

        chart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Fosszilis Üzemanyag Kiadások (HUF)',
                    data: values,
                    backgroundColor: ['#dc3545', '#ffc107']
                }]
            }
        });
    }

    // Event listener for country select change
    countrySelect.addEventListener('change', (e) => {
        const selectedCountry = e.target.value;
        updateChart1(selectedCountry);
        updateChart2(selectedCountry);
    });

    // Load default charts for "Norvégia"
    updateChart1('Norvégia');
    updateChart2('Norvégia');
});
