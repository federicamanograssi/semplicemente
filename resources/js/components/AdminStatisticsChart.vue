<template>
  <div>
    <canvas id="planet-chart" width="400" height="180"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js';
import adminStatisticsChartData from '../statistic-data.js';


export default {
  name: 'PlanetChart',
  data() {
    return {
      adminStatisticsChartData: adminStatisticsChartData
    }
  },
  mounted() {
    const ctx = document.getElementById('planet-chart');
    new Chart(ctx, this.adminStatisticsChartData);
  }
}
</script>
