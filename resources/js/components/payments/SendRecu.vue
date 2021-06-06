<template>
  <div class="uk-text-right" style="position: relative !important;">
    <div
      id="recu-upload-success"
      dir="rtl"
      class="uk-flex-top uk-text-right"
      uk-modal
    >
      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="icon_statu uk-text-center">
          <img
            style="max-width: 30%;"
            class=""
            src="/image/icon/undraw_Mail_sent_re_0ofv.svg"
          />
        </div>

        <p class="uk-text-warning uk-text-center uk-text-lead">
          تم تلقي طلبك, سيقوم فريقنا بمراجعة طلبك والرد عليك في غضون 48 ساعة كحد
          أقصى باستثناء أيام العطل الرسمية
        </p>
      </div>
    </div>
    <div v-if="CanSubmit">
      <div id="submit-recu" class="uk-text-right" dir="rtl" uk-modal>
        <div class="uk-modal-dialog">
          <button
            class="uk-modal-close-default"
            type="button"
            uk-close
          ></button>

          <div class="uk-modal-header">
            <h2 class="uk-modal-title">تنبيه !</h2>
          </div>

          <div class="uk-modal-body">
            <p>
              يرجى التأكد من أن الملف الذي رفعته هو وصل أداء لطلب رقم :
              {{ oid }} وانه قد تم تحويل مبلغ
              {{
                amount.toLocaleString('en-US', {
                  style: 'currency',
                  currency: 'MAD',
                })
              }}
              للحساب البنكي من أجل تجنب تأخير معالجة طلبك
            </p>
          </div>

          <div class="uk-modal-footer uk-text-right">
            <button
              class="uk-button uk-button-primary uk-modal-close"
              @click="submitRecu"
              type="button"
            >
              ارسال
            </button>

            <button
              class="uk-button uk-button-default uk-modal-close"
              type="button"
            >
              الغاء
            </button>
          </div>
        </div>
      </div>
      <div dir="rtl" class="uk-margin" uk-margin>
        <div
          id="filename_show"
          style="display: none;"
          class="uk-alert-primary"
          uk-alert
        >
          <p id="filename"></p>
        </div>

        <label for="">
          رفع وصل الأداء
          <small>
            ( يرجى رفع وصل أداء لهذه الطلبية من أجل تجنب تأخير معالجة طلبك)
          </small>
        </label>
        <br />
        <div class="uk-flex">
          <div uk-form-custom="target: true">
            <input type="file" id="recu" @change="upRecu" />
            <input
              class="uk-input uk-form-width-medium"
              v-bind:class="{ 'uk-form-danger': recuFileError }"
              type="text"
              placeholder="اختيار ملف"
              disabled
            />
          </div>
          <button
            id="btn-submit"
            class="uk-button uk-button-primary"
            disabled
            uk-toggle="#submit-recu"
          >
            ارسال
          </button>
        </div>
        <small v-if="recuFileError" class="uk-text-danger">
          {{ recuFileError }}
        </small>
      </div>
    </div>
    <div id="recu-status" hidden>
      <div class="uk-alert-warning" uk-alert>
        <p>تم تلقي طلبك وهو قيد المراجعة</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ['oid', 'amount'],
  data() {
    return {
      recu: '',
      recuFileError: false,
      CanSubmit: true,
    }
  },
  methods: {
    upRecu: function (e) {
      $('#form-loading').css('display', 'block')
      if (e.target.files && e.target.files[0]) {
        var reader = new FileReader()
      }
      let file = e.target.files[0]
      this.recu = file
      var geekss = e.target.files[0].name
      $('#filename').text(' تم تحديد ' + geekss)
      $('#btn-submit').removeAttr('disabled')

      $('#form-loading').css('display', 'none')
      $('#filename_show').css('display', 'block')
    },
    submitRecu: function () {
      $('#form-loading').css('display', 'block')

      let data = new FormData()
      data.append('token', $('meta[name=csrf-token]').attr('content'))
      data.append('recuFile', this.recu)
      data.append('OID', this.oid)
      axios
        .post('/api/v1/payment/UploadRecu', data)
        .then((response) => {
          this.CanSubmit = false
          //recu-status
          $('#recu-status').removeAttr('hidden')

          this.recuFileError = false
          // console.log(response)
          $('#form-loading').css('display', 'none')

          UIkit.modal('#recu-upload-success').show()
        })
        .catch((error) => {
          $('#form-loading').css('display', 'none')

          //error.response.data.errors.recuFile
          if (error.response.status == 422) {
            this.recuFileError = error.response.data.errors.recuFile[0]
            UIkit.notification({
              message: error.response.data.errors.recuFile[0],
              status: 'danger',
            })
          } else {
            UIkit.notification({
              message: error.response.data.error,
              status: 'danger',
            })
          }
          //   console.log(error.response.status);
        })
    },
  },
}
</script>
