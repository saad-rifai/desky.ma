<template>
  <div>

    <button

      @click="printLast5Years"
      id="printReport"
      class="uk-button uk-button-primary"
      type="button"
    >
      تحميل تقرير أخر 5 سنوات
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
    }
  },
  methods: {
    printLast5Years: function () {
      this.repportload = true
      $('#form-loading').css('display', 'block')
      $('#printReport').attr('disabled', 'disabled')

        let data = new FormData()
        axios
          .post('/api/v1/Statistiques/TurnoverLast5years/print/224e8s69d546x233a7841s', data, {
            responseType: 'blob',
          })
          .then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]))
            const link = document.createElement('a')
            link.href = url
            var year = new Date().getFullYear()
            link.setAttribute('download', "Chiffre d'affaires des 5 dernières années" + year + ".pdf")
            document.body.appendChild(link)
            link.click()
            $('#form-loading').css('display', 'none')
            $('#printReport').removeAttr('disabled')
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
           $('#form-loading').css('display', 'none')
               $('#printReport').removeAttr('disabled')
            }
            console.log(error)
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
}
</script>
