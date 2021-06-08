<template>

<div style="position:relative">
    <div class="uk-text-left uk-margin">
    <select @change="getinfos" v-model="year" class="uk-select uk-width-1-4" name="" id="selectdate">
        <option  v-for="(item, key) in date" :key="key" :value="item">{{item}}</option>
    </select>
    </div>

<div v-if="NotAllowdFunction" @click="NotAllowdFunction_not" class="disabled-feature uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle">
            باقتك لاتسمح لك باستعمال الميزة
          </div>
  <div dir="rtl" class="uk-child-width-1-2@s uk-text-center"   uk-grid>

    <div class="">
      <div
        dir="rtl"
        class="uk-card uk-card-default uk-card-body align-card-big-icon uk-text-center"
        style=""
        uk-grid
      >
        <div class="uk-width-1-1@s">
          <div class="icon-big"><i class="fas fa-shopping-cart"></i></div>

          <div class="content-card-info">
            <div class="uk-position-top-left uk-overlay">
              <small>
                <span uk-icon="icon:history; ratio:0.7"></span>
                هذه السنة
              </small>
            </div>

            <p class="info-card-title">المبيعات</p>
            <h3 dir="rtl" class="info-card-p">
              {{ this.infos.TotalSales }}
            </h3>
            <div class="uk-position-bottom-left uk-overlay"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="">
      <div
        dir="rtl"
        class="uk-card uk-card-default uk-card-body align-card-big-icon uk-text-center"
        style=""
        uk-grid
      >
        <div class="uk-width-1-1@s">
          <div class="icon-big"><i class="fas fa-users"></i></div>

          <div class="content-card-info">
            <div class="uk-position-top-left uk-overlay">
              <small>
                <span uk-icon="icon:history; ratio:0.7"></span>
                هذه السنة
              </small>
            </div>

            <p class="info-card-title">عملاء </p>
            <h3 dir="rtl" class="info-card-p">
              {{ this.infos.TotalClientsThisYear }}
            </h3>
          </div>
        </div>
      </div>
    </div>
    <div class="">
      <div
        dir="rtl"
        class="uk-card uk-card-default uk-card-body align-card-big-icon uk-text-center"
        style=""
        uk-grid
      >
        <div class="uk-width-1-1@s">
          <div class="icon-big"><i class="fas fa-file-invoice"></i></div>

          <div class="content-card-info">
            <div class="uk-position-top-left uk-overlay">
              <small>
                <span uk-icon="icon:history; ratio:0.7"></span>
                هذه السنة
              </small>
            </div>

            <p class="info-card-title">فواتير مستحقة</p>
            <h3 dir="rtl" class="info-card-p">
              {{
                this.infos.TotalUnpaidThisYear.toLocaleString('en-US', {
                  style: 'currency',
                  currency: 'MAD',
                })
              }}
            </h3>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div
        dir="rtl"
        class="uk-card uk-card-default uk-card-body align-card-big-icon uk-text-center"
        style=""
        uk-grid
      >
        <div class="uk-width-1-1@s">
          <div class="icon-big"><i class="fas fa-coins"></i></div>

          <div class="content-card-info">
            <div class="uk-position-top-left uk-overlay">
              <small>
                <span uk-icon="icon:history; ratio:0.7"></span>
                هذه السنة
              </small>
            </div>

            <p class="info-card-title">رقم المعاملات</p>
            <h3 dir="rtl" class="info-card-p">
              {{
                this.infos.TotalThisYear.toLocaleString('en-US', {
                  style: 'currency',
                  currency: 'MAD',
                })
              }}
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
import formDevisVue from '../form-devis.vue'
export default {

  data() {
    return {

      infos: {"TotalThisMonth": 0, "TotalThisYear": 150454, "TotalUnpaidThisMonth": 0, "TotalSales": 15570, "TotalUnpaidThisYear": 2145, "TotalClientsThisYear": 15},
       NotAllowdFunction: false,
       date: [],
       year:  new Date().getFullYear()

    }
  },
  methods: {
    getinfos: function () {
      $('#form-loading').css('display', 'block')

      axios
        .post('/api/v1/user/statistiques/general/json/' + this.year + '/SA')
        .then((response) => {
          this.infos = response.data
          $('#form-loading').css('display', 'none')
        })
        .catch((error) => {
          $('#form-loading').css('display', 'none')
          if(error.response.status == 402){
              this.NotAllowdFunction = true;


          }else{
          this.getinfos()

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
    }
  },
  created() {
      var currentTime = new Date()
       var max = new Date().getFullYear();
       var min = 2020;

for (var i = min; i<=max; i++){
   this.date.push(i)

}
    this.getinfos()
  },
}
</script>
