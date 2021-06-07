<template>
  <div style="position: relative;" >
        <div id="chartGenelareLoad" class=" uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle div-load"><span uk-spinner="ratio: 1.5"></span></div>

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
      $('#chartGenelareLoad').css('display', 'flex')
      axios
        .post('/api/v1/user/statistiques/generale/json/line' + this.year)
        .then((response) => {
          this.data = response.data
          this.draw()
          $('#chartGenelareLoad').css('display', 'none')
        })
        .catch((error) => {
          $('#chartGenelareLoad').css('display', 'none')
          this.getdata()
        })
    },
    draw: function () {
      var ctx = document.getElementById('myChart').getContext('2d')
      var dataFirst = {
    label: "Car A - Speed (mph)",
    data: this.data,
    lineTension: 0,
    fill: false,
    borderColor: 'red'
  };

var dataSecond = {
    label: "Car B - Speed (mph)",
    data: [20, 15, 60, 60, 65, 30, 70],
    lineTension: 0,
    fill: false,
  borderColor: 'blue'
  };

      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          datasets: [dataSecond, dataFirst],
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
