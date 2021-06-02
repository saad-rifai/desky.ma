<template>
  <div style="position: relative;" >
    <div
      id="chartLoad"
      class="uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle div-load"
    >
      <div class="div-load-content">
        <div uk-spinner="ratio: 1.5"></div>
      </div>
    </div>
    <canvas id="myChart" width="400" height="175"></canvas>
  </div>
</template>
<script>
export default {
  props: ['year'],
  data() {
    return {
      data: [],
    }
  },
  methods: {
    getdata: function () {
      $('#chartLoad').css('display', 'block')
      axios
        .post('/api/v1/user/statistiques/ventes/json/' + this.year)
        .then((response) => {
          this.data = response.data
          this.draw()
          $('#chartLoad').css('display', 'none')
        })
        .catch((error) => {
          $('#chartLoad').css('display', 'none')
          this.getdata()
        })
    },
    draw: function () {
      var ctx = document.getElementById('myChart').getContext('2d')
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {

          datasets: [
            {
              label: 'المبيعات الشهرية',
              data: this.data,
              fill: true,

              backgroundColor: ['#f78b034a'],
              borderColor: ['rgba(247, 139, 3, 1)'],
              borderWidth: 2,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },

          },
        },
      })
    },
  },
  created() {
    this.getdata()
  },
}
</script>
