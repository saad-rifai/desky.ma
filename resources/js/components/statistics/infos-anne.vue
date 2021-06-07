<template>
  <div dir="rtl" class="uk-child-width-1-2@s uk-text-center" uk-grid>
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

            <p class="info-card-title">عملاء جدد</p>
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
          $('#form-loading').css('display', 'none')

          // console.log(error)
          this.getinfos()
        })
    },
  },
  created() {
    this.getinfos()
  },
}
</script>
