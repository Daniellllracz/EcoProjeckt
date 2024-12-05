document.addEventListener('DOMContentLoaded', function () {
    const countries = ["Norvégia", "Olaszország", "Magyarország", "Németország", "Bulgária", "Románia"];
    const data = {
        "Norvégia": { diesel: 10, gasoline: 20, electric: 50, hybrid: 20 },
        "Olaszország": { diesel: 30, gasoline: 40, electric: 10, hybrid: 20 },
        "Magyarország": { diesel: 25, gasoline: 35, electric: 15, hybrid: 25 },
        "Németország": { diesel: 20, gasoline: 30, electric: 25, hybrid: 25 },
        "Bulgária": { diesel: 40, gasoline: 40, electric: 5, hybrid: 15 },
        "Románia": { diesel: 35, gasoline: 45, electric: 8, hybrid: 12 },
    };

    const countrySelect = document.getElementById('countrySelect');
    countries.forEach(country => {
        let option = document.createElement('option');
        option.value = country;
        option.textContent = country;
        countrySelect.appendChild(option);
    });

    const ctx = document.getElementById('chart').getContext('2d');
    let chart;

    function updateChart(country) {
        const chartData = data[country];
        const labels = Object.keys(chartData);
        const values = Object.values(chartData);

        if (chart) {
            chart.destroy();
        }

        chart = new Chart(ctx, {
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

    countrySelect.addEventListener('change', (e) => {
        updateChart(e.target.value);
    });

    // Alapértelmezett diagram betöltése
    updateChart('Norvégia');
});
