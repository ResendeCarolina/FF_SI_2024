//através dos dados recebidos pelo ficheiro gráficos.php
//cria dois gráficos mediante a biblioteca Chart.js

fetch('../comuns/graficos.php')
    .then(response => response.json())
    .then(data => {
        console.log(data)

        //gráfico de barras para o nº total de modelos
        const carModelsCtx = document.getElementById('graficoModelos').getContext('2d');
        const carModelsData = data.modelos.map(item => item.total);
        const carModelsLabels = data.modelos.map(item => item.modelo);

        new Chart(carModelsCtx, {
            type: 'bar',
            data: {
                labels: carModelsLabels,
                datasets: [{
                    label: 'Total Cars by Model',
                    data: carModelsData,
                    backgroundColor: 'rgba(139, 0, 0, 0.5)',
                    borderColor: 'rgba(139, 0, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });

        //gráfico circular para as reservas
        const reservationsCtx = document.getElementById('graficoReservas').getContext('2d');
        const reservationsData = data.reservas.map(item => item.total);
        const reservationsLabels = data.reservas.map(item => item.utilizador);

        new Chart(reservationsCtx, {
            type: 'pie',
            data: {
                labels: reservationsLabels,
                datasets: [{
                    label: 'Reservations by User',
                    data: reservationsData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }

        });
    })
    .catch(error => console.error('Error loading data:', error));