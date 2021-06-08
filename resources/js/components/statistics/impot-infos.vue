<template>
  <div>
    <div style="position: relative;">
      <div class="uk-text-left uk-margin">
        <select
          @change="yearChange"
          v-model="year"
          class="uk-select uk-width-1-4"
          name=""
          id="selectdate"
        >
          <option v-for="(item, key) in date" :key="key" :value="item">
            {{ item }}
          </option>
        </select>
      </div>

      <div
        v-if="NotAllowdFunction"
        @click="NotAllowdFunction_not"
        class="disabled-feature uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle"
      >
        باقتك لاتسمح لك باستعمال الميزة
      </div>
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

                <p class="info-card-title">رقم العاملات</p>
                <h3 dir="rtl" class="info-card-p">
                  {{
                    this.infos.TotalThisYear.toLocaleString('en-US', {
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
              <div class="icon-big"><i class="fas fa-percent"></i></div>

              <div class="content-card-info">
                <div class="uk-position-top-left uk-overlay">
                  <small>
                    <span uk-icon="icon:history; ratio:0.7"></span>
                    هذه السنة
                  </small>
                </div>

                <p class="info-card-title">الضرائب (TVA)</p>
                <h3 dir="rtl" class="info-card-p">
                  {{
                    this.infos.TvaCost.toLocaleString('en-US', {
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
    <br />
    <br />
    <div style="position: relative;">
      <div
        v-if="NotAllowdFunctionImpot"
        @click="NotAllowdFunction_not_impot"
        class="disabled-feature uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle"
      >
        باقتك لاتسمح لك باستعمال الميزة
      </div>
      <!--div id="TabelLastFiveLoad" class=" uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle div-load"><span uk-spinner="ratio: 1.5"></span></div-->
      <div class="uk-overflow-auto">
        <table class="uk-table uk-table-striped">
          <thead>
            <tr>
              <th>الربع السنوي</th>
              <th>(TTC) رقم المعاملات</th>
              <th>الضرائب ({{infosImpot.tva}}%)</th>
              <th>الربح الصافي (HT)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td dir="rtl">1 (يناير - مارس)</td>
              <td>
                {{
                  infosImpot.Trimestriel_1_CD.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </td>
              <td>
                {{
                  infosImpot.Trimestriel_1_TAV.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </td>
              <td>{{ (infosImpot.Trimestriel_1_CD - infosImpot.Trimestriel_1_TAV).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  }) }}</td>
            </tr>
            <tr>
              <td dir="rtl">2 (أبريل - يونيو)</td>
              <td>
                {{
                  infosImpot.Trimestriel_2_CD.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </td>
              <td>
                {{
                  infosImpot.Trimestriel_2_TAV.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </td>
                 <td>{{ (infosImpot.Trimestriel_2_CD - infosImpot.Trimestriel_2_TAV).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  }) }}</td>
            </tr>
            <tr>
              <td dir="rtl">3 (يوليو - سبتمبر)</td>
              <td>
                {{
                  infosImpot.Trimestriel_3_CD.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </td>
              <td>
                {{
                  infosImpot.Trimestriel_3_TAV.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </td>
              <td>{{ (infosImpot.Trimestriel_3_CD - infosImpot.Trimestriel_3_TAV).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  }) }}</td>            </tr>
            <tr>
              <td dir="rtl">4 (أكتوبر - ديسمبر)</td>
              <td>
                {{
                  infosImpot.Trimestriel_4_CD.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </td>
                 <td>
                {{
                  infosImpot.Trimestriel_4_TAV.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </td>
              <td>{{ (infosImpot.Trimestriel_4_CD - infosImpot.Trimestriel_4_TAV).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  }) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      infos: {
        TotalThisMonth: 0,
        TotalThisYear: 150454,
        TotalUnpaidThisMonth: 0,
        TotalSales: 15570,
        TotalUnpaidThisYear: 2145,
        TotalClientsThisYear: 15,
        TvaCost: 0,

      },
      NotAllowdFunction: false,
      NotAllowdFunctionImpot: false,
      date: [],
      year: new Date().getFullYear(),
      infosImpot: {
          Trimestriel_1_CD: 0,
          Trimestriel_2_CD: 0,
          Trimestriel_3_CD: 0,
          Trimestriel_4_CD: 0,
          Trimestriel_1_TAV: 0,
          Trimestriel_2_TAV: 0,
          Trimestriel_3_TAV: 0,
          Trimestriel_4_TAV: 0,
      },
    }
  },
  methods: {
    yearChange: function () {
      this.getinfos()
      this.GetImpotInfos()
    },
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
          if (error.response.status == 402) {
            this.NotAllowdFunction = true
            this.NotAllowdFunctionImpot = true
          } else {
            this.getinfos()
          }
        })
    },
    GetImpotInfos: function () {
      $('#form-loading').css('display', 'block')
      axios
        .post('/api/v1/user/statistiques/impot/json/' + this.year + '')
        .then((response) => {
          this.infosImpot = response.data
          $('#form-loading').css('display', 'none')
        })
        .catch((error) => {
          $('#form-loading').css('display', 'none')
          if (error.response.status == 402) {
            this.NotAllowdFunctionImpot = true
          } else {
            this.GetImpotInfos()
          }
        })
    },
    //NotAllowdFunction_not_impot
    NotAllowdFunction_not_impot: function () {
      UIkit.notification({
        message:
          "باقتك لاتسمح لك باستعمال هذه الميزة يمكنك مشاهدة <a href='/tarifs?NotAllowdNotification'>الباقات</a> ",
        status: 'danger',
        pos: 'top-center',
        timeout: 5000,
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
  },
  created() {
    var currentTime = new Date()
    var max = new Date().getFullYear()
    var min = 2020

    for (var i = min; i <= max; i++) {
      this.date.push(i)
    }
    this.getinfos()
    this.GetImpotInfos()
  },
}
</script>
