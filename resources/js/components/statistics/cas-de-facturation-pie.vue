<template>
  <div style="position: relative;" >
        <div id="pieload" class=" uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle div-load"><span uk-spinner="ratio: 1.5"></span></div>

    <canvas id="cas-de-facturation-pie" width="400" height="185"></canvas>
    <div v-if="max <  1" class="uk-text-center uk-margin uk-position-center">
        <p>
            لايوجد بيانات
        </p>
    </div>
  </div>
</template>
<script>
export default {
  props: ['year'],
  data() {
    return {
      data: [],
      max: 0,
    }
  },
  methods: {
    getdata: function () {
      $('#pieload').css('display', 'flex')
      axios
        .post('/api/v1/user/statistiques/CasDeFacturation/json/' + this.year)
        .then((response) => {
          this.data = response.data
          this.max =  Math.max.apply(Math, this.data)
          this.draw()
          $('#pieload').css('display', 'none')
        })
        .catch((error) => {
          $('#pieload').css('display', 'none')
          console.log(error.response);
          this.getdata()
        })
    },
    draw: function () {
      var ctx = document.getElementById('cas-de-facturation-pie').getContext('2d')
      ctx.height = 332;

      var xValues = [
       "جديد",
       "في انتضار التسليم",
       "تم التسليم",
       "في انتضار الدفع",
       "تم الدفع",
       "مكتمل",
       "بدون رد",
       "ملغي"
        ];
var yValues = this.data;
var barColors = [
  "rgba(247, 139, 3, 1)",
  "#eb3b5a",
  "#f7b731",
  "#4b7bec",
  "#fc5c65",
  "#20bf6b",
  "#0fb9b1",
  "#45aaf2",
];

new Chart("cas-de-facturation-pie", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
              backgroundColor: ['#f78b034a', '#fa56618f', '#f7df0399', '#1e87f099', '#27ae6096', '#f3a68378', '#778bebb3', '#e15f41a6'],
              borderColor: ['rgba(247, 139, 3, 1)', '#fa5661', '#f7df03', '#1e87f0', '#27ae60', '#f3a683', '#778beb', '#e15f41'],
              borderWidth: 2,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});

    },
  },
  created() {
   this.getdata()

  },
}
</script>
