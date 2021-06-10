<template>
  <div>
    <div v-if="!HideForm" class="uk-grid-small uk-text-right" dir="rtl" uk-grid>
      <div class="uk-width-1-2@s">
        <input
          v-model="fname"
          class="uk-input"
          type="text"
          placeholder="الاسم الأول"
        />
       <div class="uk-text-danger" v-if="errors.errors.fname">
          {{ errors.get('fname') }}
        </div>          </div>
      <div class="uk-width-1-2@s">
        <input
          v-model="lname"
          class="uk-input"
          type="text"
          placeholder="الاسم الاخير"
        />
       <div class="uk-text-danger" v-if="errors.errors.lname">
          {{ errors.get('lname') }}
        </div>      </div>
      <div class="uk-width-1-1">
        <input
          v-model="email"
          class="uk-input"
          type="text"
          placeholder="البريد الالكتروني"
        />
       <div class="uk-text-danger" v-if="errors.errors.email">
          {{ errors.get('email') }}
        </div>
      </div>

      <div class="uk-width-1-2@s">
        <select v-model="category" name="" class="uk-select" id="">
          <option value="">التصنيف</option>
          <option value="0">عميل</option>
          <option value="1">صحافي</option>
          <option value="2">مستثمر</option>
          <option value="3">أخر</option>
        </select>
       <div class="uk-text-danger" v-if="errors.errors.category">
          {{ errors.get('category') }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <input
          class="uk-input"
          type="number"
          v-model="phone"
          placeholder="رقم الهاتف (اختياري)"
        />
       <div class="uk-text-danger" v-if="errors.errors.phone">
          {{ errors.get('phone') }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <input
          v-model="subject"
          class="uk-input"
          type="text"
          placeholder="الموضوع"
        />
       <div class="uk-text-danger" v-if="errors.errors.subject">
          {{ errors.get('subject') }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <textarea
          v-model="message"
          name=""
          class="uk-textarea"
          cols="30"
          placeholder="الرسالة"
          rows="6"
        ></textarea>
        <br />
        <div class="uk-text-danger" v-if="errors.errors.message">
          {{ errors.get('message') }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <div
          class="g-recaptcha"
          id="recaptcha-main"
          :data-sitekey="recaptcha"
        ></div>
        <div class="uk-text-danger" v-if="errors.errors.recaptcha_token">
          {{ errors.get('recaptcha_token') }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <button
          @click="submitform"
          type="submit"
          class="uk-button uk-button-primary"
        >
          ارسال
        </button>
      </div>
    </div>
    <div v-else>
      <div class="uk-alert-success uk-text-right" uk-alert>
        <p>تم تلقي رسالتك سوف نرد عليك في أقرب وقت.</p>
      </div>
    </div>
  </div>
</template>
<script>
class Errors {
  constructor() {
    this.errors = {}
  }
  get(filed) {
    if (this.errors[filed]) {
      return this.errors[filed][0]
    }
  }
  record(errors) {
    this.errors = errors.errors
  }
}
export default {
  props: ['recaptcha', 'csrf'],

  data() {
    return {
      errors: new Errors(),

      recaptcha_response: '',
      fname: '',
      lname: '',
      category: '',
      phone: '',
      email: '',
      subject: '',
      message: '',
      HideForm: false,
    }
  },
  methods: {
    CaptchaCallback: function () {
      this.$nextTick(function () {
        grecaptcha.render('recaptcha-main')
      })
    },
    submitform: function () {
      $('#form-loading').css('display', 'block')
      this.recaptcha_response = document.getElementById(
        'g-recaptcha-response',
      ).value
      let data = new FormData()
      data.append('fname', this.fname)
      data.append('lname', this.lname)
      data.append('category', this.category)
      data.append('phone', this.phone)
      data.append('email', this.email)
      data.append('subject', this.subject)
      data.append('message', this.message)
      data.append('recaptcha_token', this.recaptcha_response)
      axios
        .post('/api/v1/SendMessage', data)
        .then((response) => {
          this.HideForm = true
          $('#form-loading').css('display', 'none')
          UIkit.notification({
            message: 'تم تلقي رسالتك',
            status: 'success',
            pos: 'top-center',
            timeout: 5000,
          })
        })
        .catch((error) => {
          $('#form-loading').css('display', 'none')

          this.errors.record(error.response.data)
          UIkit.notification({
            message:
              "<span uk-icon='icon: warning'></span> يرجى التحقق من المدخلات ",
            status: 'danger',
            pos: 'top-center',
            timeout: 5000,
          })
          grecaptcha.reset()
          this.CaptchaCallback()
        })
    },
  },
}
</script>
