<template>
  <div dir="rtl" class="uk-child-width-expand@s uk-text-center" uk-grid>
    <div class="">
      <div
        dir="rtl"
        class="uk-card uk-card-default uk-card-body align-card-big-icon uk-text-center"
        style=""
        uk-grid
      >
        <div class="uk-width-1-1@s">
          <div class="icon-big"><i class="fas fa-hand-holding-usd"></i></div>

          <div class="content-card-info">
            <div class="uk-position-top-left uk-overlay">
              <small>
                <span uk-icon="icon:history; ratio:0.7"></span>
                هذا الشهر
              </small>
            </div>

            <p class="info-card-title">المبيعات الشهرية</p>
            <h3 dir="rtl" class="info-card-p">
              {{
                this.infos.TotalThisMonth.toLocaleString('en-US', {
                  style: 'currency',
                  currency: 'MAD',
                })
              }}
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
          <div class="icon-big"><i class="fas fa-coins"></i></div>

          <div class="content-card-info">
            <div class="uk-position-top-left uk-overlay">
              <small>
                <span uk-icon="icon:history; ratio:0.7"></span>
                هذه السنة
              </small>
            </div>

            <p class="info-card-title">مبيعات السنوية</p>
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
    <div class="">
      <a href="/devis/list">
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
                  هذا الشهر
                </small>
              </div>

              <p class="info-card-title">فواتير مستحقة</p>
              <h3 dir="rtl" class="info-card-p">
                {{
                  this.infos.TotalUnpaidThisMonth.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </h3>
            </div>
          </div>
        </div>
      </a>
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
