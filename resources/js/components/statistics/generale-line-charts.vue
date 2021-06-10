<template>
  <div style="position: relative;" >
                <div
            v-if="NotAllowdFunction"
            @click="NotAllowdFunction_not"
            class="disabled-feature uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle"
          >
            باقتك لاتسمح لك باستعمال الميزة
          </div>

        <div id="chartGenelareLoad" class=" uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle div-load"><span uk-spinner="ratio: 1.5"></span></div>

    <canvas id="myChart" width="400" height="175"></canvas>
  </div>
</template>
<script>
export default {
  data() {
    return {
      data: [],
      NotAllowdFunction: false,
      year: new Date().getFullYear(),
    }
  },
  methods: {
    getdata: function () {
      $('#chartGenelareLoad').css('display', 'flex')
      axios
        .post('/api/v1/user/statistiques/line/json/' + this.year)
        .then((response) => {
            this.NotAllowdFunction = false;
          this.data = response.data
          this.draw()
          $('#chartGenelareLoad').css('display', 'none')
        })
        .catch((error) => {
          if(error.response.status == 402){
              this.draw_preview();
              this.NotAllowdFunction = true;
      $('#chartGenelareLoad').css('display', 'none')

          }else{
          this.getdata()

          }
        })
    },
        NotAllowdFunction_not: function () {
      UIkit.notification({
        message:
          "باقتك لاتسمح لك باستعمال هذه الميزة يمكنك مشاهدة <a href='/tarifs?NotAllowdNotification'>الباقات</a> ",
        status: 'danger',
        pos: 'top-center',
        timeout: 5000,
      })
    },
    draw: function () {
      var ctx = document.getElementById('myChart').getContext('2d')

      var Ventes = {
    label: "عدد المبيعات",
    data: this.data[0],
    lineTension: 0,
    fill: false,
    borderColor: 'rgb(255, 99, 132)',
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderWidth: 1

  };

var ChiffreDaffire = {


    label: " رقم المعاملات بالدرهم",
    data: this.data[1],
    lineTension: 1,
    fill: false,
  borderColor: '#f98a13',
  backgroundColor: 'rgba(255, 159, 64, 0.2)',
borderWidth: 1

  };
  var Unpaid = {


    label: "فواتير مستحقة بالدرهم",
    data: this.data[2],
    lineTension: 1,
    fill: false,
  borderColor: 'rgb(54, 162, 235)',
  backgroundColor: 'rgba(54, 162, 235, 0.2)',
borderWidth: 1

  };

      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {

          datasets: [ChiffreDaffire, Ventes, Unpaid],
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
    draw_preview: function () {
      var ctx = document.getElementById('myChart').getContext('2d')

      var Ventes = {
    label: "عدد المبيعات",
    data: ['12','52', '21', '74', '32', '14'],
    lineTension: 0,
    fill: false,
    borderColor: 'rgb(255, 99, 132)',
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderWidth: 1

  };

var ChiffreDaffire = {


    label: " رقم المعاملات بالدرهم",
    data: ['12','52', '21', '24', '32', '14'],
    lineTension: 1,
    fill: false,
  borderColor: '#f98a13',
  backgroundColor: 'rgba(255, 159, 64, 0.2)',
borderWidth: 1

  };
  var Unpaid = {


    label: "فواتير مستحقة بالدرهم",
    data: ['12','02', '21', '74', '32', '14'],
    lineTension: 1,
    fill: false,
  borderColor: 'rgb(54, 162, 235)',
  backgroundColor: 'rgba(54, 162, 235, 0.2)',
borderWidth: 1

  };

      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {

          datasets: [ChiffreDaffire, Ventes, Unpaid],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },

          },
        },
      })
    }
  },
  created() {

    this.getdata()
  },
}
</script>
