<template>
  <div>
    <div id="customize-report" uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-text-right" dir="rtl">
        <h2 class="uk-modal-title">طباعة التقرير السنوي</h2>
        <hr />
        <label for="">تخصيص التقرير</label>
        <div class="uk-text-left uk-margin">
          <select
            v-model="year"
            class="uk-select uk-width-1-1"
            name=""
            id="selectdate"
          >
            <option v-for="(item, key) in date" :key="key" :value="item">
              {{ item }}
            </option>
          </select>
        </div>
        <div style="position: relative;">
          <div
            id="customizeLoad"
            class="uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle div-load"
          >
            <span uk-spinner="ratio: 1.5"></span>
            <br />
            <span class="uk-text-center" dir="rtl" v-if="repportload">
              جاري تجهيز التقرير...
            </span>
          </div>

          <div
            v-if="DisabledFeature"
            @click="NotAllowdFunction"
            class="disabled-feature uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle"
          >
            باقتك لاتسمح لك باستعمال الميزة
          </div>

          <div class="uk-margin uk-grid-small uk-child-width-1-2@s uk-grid">
            <label>
              <input
                class="uk-checkbox"
                v-model="ventes"
                type="checkbox"
                checked
              />
              المبيعات
            </label>
            <br />
            <label>
              <input
                class="uk-checkbox"
                v-model="unpaidFacture"
                type="checkbox"
                checked
              />
              فواتير مستحقة
            </label>
            <br />
            <label>
              <input class="uk-checkbox" disabled type="checkbox" checked />
              رقم المعاملات (TTC)
            </label>
            <br />
            <label>
              <input class="uk-checkbox" v-model="tva" type="checkbox" />
              الضرائب
            </label>
            <br />
            <label>
              <input
                class="uk-checkbox"
                v-model="revenu"
                type="checkbox"
                checked
              />
              الربح الصافي (HT)
            </label>
          </div>
        </div>
        <p class="uk-text-right">
          <button
            id="submitbtn"
            @click="printReport"
            class="uk-button uk-button-primary"
            type="button"
          >
            طباعة
          </button>

          <button
            class="uk-button uk-button-default uk-modal-close"
            type="button"
          >
            الغاء
          </button>
        </p>
      </div>
    </div>
    <button
      @click="GetData"
      class="uk-button uk-button-primary"
      uk-toggle="target: #customize-report"
      type="button"
    >
      تحميل التقرير السنوي
    </button>
  </div>
</template>
<script>
import json from '/database/data.json'

export default {
  data() {
    return {
      DisabledFeature: true,
      BigPack: '',
      ventes: true,
      unpaidFacture: false,
      tva: false,
      revenu: true,
      packs: json._2147845.packs,
      Features: [],
      Custumize: [],
      repportload: false,
      date: [],
      year: new Date().getFullYear(),
    }
  },
  methods: {
    printReport: function () {
      this.repportload = true
      $('#customizeLoad').css('display', 'flex')
      $('#submitbtn').attr('disabled', 'disabled')
      if (this.Features.includes('SAP')) {
        this.Custumize = {
          ventes: this.ventes,
          unpaidFacture: this.unpaidFacture,
          chiffreDaffire: this.chiffreDaffire,
          tva: this.tva,
          revenu: this.revenu,
        }
        let data = new FormData()
        data.append('customize', JSON.stringify(this.Custumize))
        axios
          .post('/api/v1/user/statistiques/print/' + this.year, data, {
            responseType: 'blob',
          })
          .then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]))
            const link = document.createElement('a')
            link.href = url
            var year = new Date().getFullYear()
            link.setAttribute(
              'download',
              'Rapport Annuel ' + this.year + '.pdf',
            )
            document.body.appendChild(link)
            link.click()
            $('#customizeLoad').css('display', 'none')
            $('#submitbtn').removeAttr('disabled')
            this.repportload = false
          })
          .catch((error) => {
            if (error.response.status == 402) {
              UIkit.notification({
                message:
                  "باقتك لاتسمح لك باستعمال هذه الميزة يمكنك مشاهدة <a href='/tarifs?NotAllowdNotification'>الباقات</a> ",
                status: 'danger',
                pos: 'top-center',
                timeout: 5000,
              })
              $('#customizeLoad').css('display', 'none')
              $('#submitbtn').removeAttr('disabled')
            } else {
              window.location.replace()
            }
            //  console.log(error)
          })
      } else {
        let data = new FormData()
        axios
          .post('/api/v1/user/statistiques/print/' + this.year, data, {
            responseType: 'blob',
          })
          .then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]))
            const link = document.createElement('a')
            link.href = url
            //var year = new Date().getFullYear()
            link.setAttribute(
              'download',
              'Rapport Annuel ' + this.year + '.pdf',
            )
            document.body.appendChild(link)
            link.click()
            $('#customizeLoad').css('display', 'none')
            $('#submitbtn').removeAttr('disabled')
            this.repportload = false
          })
          .catch((error) => {
            if (error.response.status == 402) {
              UIkit.notification({
                message:
                  "باقتك لاتسمح لك باستعمال هذه الميزة يمكنك مشاهدة <a href='/tarifs?NotAllowdNotification'>الباقات</a> ",
                status: 'danger',
                pos: 'top-center',
                timeout: 5000,
              })
              $('#customizeLoad').css('display', 'none')
              $('#submitbtn').removeAttr('disabled')
            }
            // console.log(error)
          })
      }
    },
    GetData: function () {
      $('#customizeLoad').css('display', 'flex')
      axios
        .get('/api/v1/user/CheckSubscriptions')
        .then((response) => {
          this.BigPack = response.data.BigPack

          if (this.BigPack != null) {
            this.Features = this.packs[this.BigPack]['properties']
            if (this.Features.includes('SAP')) {
              this.DisabledFeature = false
            } else {
              this.DisabledFeature = true
            }
          } else {
            this.DisabledFeature = true
            $('#customizeLoad').css('display', 'none')
          }

          $('#customizeLoad').css('display', 'none')
        })
        .catch((error) => {
          this.GetData()
        })
    },

    NotAllowdFunction: function () {
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
  },
}
</script>
