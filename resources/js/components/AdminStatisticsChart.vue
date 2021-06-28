<template>
  <div>
    <canvas id="planet-chart" width="400" height="180"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js';



export default {
  props:'views',
  name: 'PlanetChart',
  mounted() {
    const ctx = document.getElementById('planet-chart');
    new Chart(ctx, this.adminStatisticsChartData);
  },
  data() {
    return {
      adminStatisticsChartData: {
            type: "line",
            data: {
                searchResult: [],
                labels: ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato", "Domenica"],
                datasets: [{
                    label: "Numero di Visualizzazioni",
                    data: [0, 0, 1, 2, 3, 4, 5, 6],
                    backgroundColor: "rgba(54,73,93,.5)",
                    borderColor: "#36495d",
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                lineTension: 1,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            padding: 25
                        }
                    }]
                }
            }
          }
        }
    },
  
}
</script>
