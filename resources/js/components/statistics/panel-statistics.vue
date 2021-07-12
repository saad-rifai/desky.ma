<template>
              <div class=" pt-5">
                <div class="row align-items-stretch uk-child-width-1-3@s" uk-grid>
                  <div class="c-dashboardInfo col-lg-3 col-md-6">
                    <div class="wrap">
                    <div class="icon-card-abs uk-position-center-right">
                        <span>
                            <i class="fas fa-file-invoice"></i>
                        </span>
                    </div>
                      <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">فواتير مستحقة </h4><span class="hind-font caption-12 c-dashboardInfo__count">{{
                  this.infos.TotalUnpaidThisMonth.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}</span>
                    </div>
                  </div>

                  <div class="c-dashboardInfo col-lg-3 col-md-6">
                    <div class="wrap">
                <div class="icon-card-abs uk-position-center-right">
                        <span>
                            <i class="fas fa-sack-dollar"></i>
                        </span>
                    </div>
                      <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">المبيعات السنوية </h4><span class="hind-font caption-12 c-dashboardInfo__count">{{
                this.infos.TotalThisYear.toLocaleString('en-US', {
                  style: 'currency',
                  currency: 'MAD',
                })
              }}</span>
                    </div>
                  </div>
                  <div class="c-dashboardInfo col-lg-3 col-md-6">
                    <div class="wrap">
                <div class="icon-card-abs uk-position-center-right">
                        <span>
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                    </div>
                      <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">المبيعات الشهرية

                    </h4><span class="hind-font caption-12 c-dashboardInfo__count">{{
                this.infos.TotalThisMonth.toLocaleString('en-US', {
                  style: 'currency',
                  currency: 'MAD',
                })
              }}</span>
                    </div>
                  </div>
                </div>
              </div>
</template>
<script>
export default {
  props: ['year'],
  data() {
    return {
      infos: [],
    }
  },
  methods: {
    getinfos: function () {
      $('#form-loading').css('display', 'block')
      axios
        .get('/api/v1/user/statistiques/general/json/' + this.year + '')
        .then((response) => {
          this.infos = response.data
          $('#form-loading').css('display', 'none')
        })
        .catch((error) => {
            if(error.response.status == 402){
          $('#form-loading').css('display', 'none')

         UIkit.modal("#neddpay-full").show();


            }else{
          $('#form-loading').css('display', 'none')
this.getinfos()
            }

          // console.log(error)
          //this.getinfos()
        })
    },
  },
  created() {
    this.getinfos()
  },
}
</script>
