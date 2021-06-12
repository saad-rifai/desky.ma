<template>
  <div>
    <div
      class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding"
    >
      <div id="ae-info" uk-modal dir="rtl">
        <div class="uk-modal-dialog uk-modal-body">
          <h2 class="uk-modal-title">كيف أجلب هذه المعلومات</h2>
          <p>
            يمكنك ايجاد هذه المعلومات في شهادة التسجيل في السجل الوطني للمقاول
            الذاتي أو في الموقع الالكتروني الخاص بالمقاول الذاتي
          </p>
          <div class="img-modal">
            <img src="/../image/icon/ae-info.png" alt="" />
          </div>
          <p class="uk-text-right">
            <button
              class="uk-button uk-button-default uk-modal-close"
              type="button"
            >
              حسناََ
            </button>
          </p>
        </div>
      </div>
      <div id="rib-info" uk-modal dir="rtl">
        <div class="uk-modal-dialog uk-modal-body">
          <h2 class="uk-modal-title">كيف أجلب هذه المعلومات</h2>
          <p>
            يمكنك اجاد رقم التعريف البنكي (RIB) في ورقة التعريف البنكي أو من
            خلال التطبيق الالكتروني في حال لم تتمكن من اجاده يمكنك الاتصال
            بوكالتك البنكية لتزويدك به
          </p>
          <div class="img-modal">
            <img src="/../image/infos/rib.jpg" alt="" />
          </div>
          <p class="uk-text-right">
            <button
              class="uk-button uk-button-default uk-modal-close"
              type="button"
            >
              حسناََ
            </button>
          </p>
        </div>
      </div>
      <h2 class="uk-card-title uk-text-center">
        نحتاج القليل من المعلومات منك
      </h2>
      <hr class="uk-divider-icon" />

      <form
        dir="rtl"
        method="POST"
        @submit.prevent="submitform"
        class="uk-grid-small"
        uk-grid
      >
        <div class="uk-width-1-1@s">
          <h2 class="uk-card-title uk-text-right">تخصيص النماذج</h2>
        </div>
        <input type="hidden" name="ref_alg" value="" />
        <div class="uk-width-1-1@s">
          <label for="">الشعار (اختياري)</label>
          <div class="js-upload uk-placeholder uk-text-center">
            <span uk-icon="icon: cloud-upload"></span>
            <span class="uk-text-middle">الحجم الأقصى للملف 70KB</span>
            <div uk-form-custom>
              <input
                type="file"
                id="logo_change"
                accept=".png, .jpg, .jpeg"
                @change="uplogo"
              />
              <span class="uk-link">اختيار الشعار</span>
            </div>
          </div>
          <div
            style="display: none;"
            class="uk-alert-primary"
            id="border_file"
            uk-alert
          >
            <a class="uk-alert-close" uk-close></a>
            <p id="filename_logo"></p>
          </div>
          <div class="border-show-image" id="preview-border">
            <div class="border-preview">
              <span class="">
                المعاينة
                <i class="fa fa-eye"></i>
              </span>
            </div>
            <img
              src=""
              id="preview-image"
              class="logo-image uk-position-center"
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.logo">
            {{ errors.get('logo') }}
          </div>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
           المهنة (اختياري)
          </label>
          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              name="fname"
              placeholder="مثال: artisan traditionnel, Concepteur de site Web"
              value=""
              v-model="slogan"
              v-bind:class="{ 'uk-form-danger': errors.errors.slogan }"
            />
            <small>بالأحرف الفرنسية</small>
          </div>

          <div class="uk-text-danger" v-if="errors.errors.slogan">
            {{ errors.get("slogan") }}
          </div>

        </div>

        <div class="uk-width-1-1@s">
          <hr class="uk-divider-icon" />

          <h2 class="uk-card-title uk-text-right">معلومات مهنية</h2>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            القطاع
            <span class="red">*</span>
          </label>
          <div class="uk-form-controls">
            <select
              data-live-search="1"
              data-container="#top"
              v-model="sector"
              data-width="100%"
              id="Secteur_855097"
              class="uk-select"
              name="AeActivite[855097][secteur]"
            >
              <option value="">- - - - - - - - - - - - - - -</option>
              <option value="1">الصناعة</option>
              <!-- 0.5% -->
              <option value="2">الخدمات</option>
              <!-- 1% -->
              <option value="3">التجارة</option>
              <!-- 0.5% -->
              <option value="4">الصناعة التقليدية</option>
              <!-- 0.5% -->
            </select>
          </div>
          <div class="uk-text-danger" v-if="errors.errors.sector">
            {{ errors.get('sector') }}
          </div>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            رقم التعريف الضريبي (IF)
            <span class="red">*</span>
            <a href="#ae-info" uk-icon="icon: info" uk-toggle></a>
          </label>
          <div class="uk-form-controls">
            <input
              class="uk-input"
              name="email"
              type="text"
              v-model="u_if"
              placeholder=""
              value=""
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.u_if">
            {{ errors.get('u_if') }}
          </div>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            رقم الضريبة المهنية (TP)
            <span class="red">*</span>
            <a href="#ae-info" uk-icon="icon: info" uk-toggle></a>
          </label>

          <div class="uk-form-controls">
            <input
              class="uk-input"
              name="phonenumb"
              type="text"
              placeholder=""
              value=""
              v-model="u_tp"
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.u_tp">
            {{ errors.get('u_tp') }}
          </div>
        </div>

        <div class="uk-width-1-2@s">
          <label for="">
            رقم التعريف الموحد للمقاول الذتي
            <span class="red">*</span>
            <a href="#ae-info" uk-icon="icon: info" uk-toggle></a>
          </label>

          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              name="company"
              value=""
              v-model="ice"
              placeholder=""
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.ice">
            {{ errors.get('ice') }}
          </div>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            البريد الالكتروني الخاص بالعمل
            <span class="red">*</span>
          </label>

          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              v-model="b_email"
              name="company"
              value=""
              placeholder=""
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.b_email">
            {{ errors.get('b_email') }}
          </div>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            رقم الهاتف الخاص بالعمل
            <span class="red">*</span>
          </label>
          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              name="company"
              value=""
              v-model="b_phone"
              placeholder=""
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.b_phone">
            {{ errors.get('b_phone') }}
          </div>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            رقم بطاقة الهوية (CNI)
            <span class="red">*</span>
          </label>

          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              name="company"
              value=""
              v-model="cni"
              placeholder="KB00000"
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.cni">
            {{ errors.get('cni') }}
          </div>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">الموقع الالكتروني (اختياري)</label>

          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              name="company"
              value=""
              v-model="siteweb"
              placeholder=""
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.siteweb">
            {{ errors.get('siteweb') }}
          </div>
        </div>
        <div class="uk-width-1-1@s">
          <h3 class="uk-card-title">المعلومات البنكية</h3>
          <p class="small-info">
            يتم عرض هذه البيانات في عرض الأسعار والفواتير من أجل استلام مدفوعاتك
          </p>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            اسم البنك بالفرنسة
            <span class="red">*</span>
          </label>

          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              name="company"
              value=""
              v-model="bank_name"
              placeholder="مثال: CIH BANK"
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.bank_name">
            {{ errors.get('bank_name') }}
          </div>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            اسم الحساب البنكي بالفرنسة
            <span class="red">*</span>
          </label>

          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              name="company"
              value=""
              v-model="bank_account_name"
              placeholder="مثال: Saad Rifai"
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.bank_account_name">
            {{ errors.get('bank_account_name') }}
          </div>
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            رقم تعريف الحساب (RIB)
            <span class="red">*</span>
            <a href="#rib-info" uk-icon="icon: info" uk-toggle></a>
          </label>

          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              name="company"
              value=""
              v-model="bank_rib"
              placeholder="مثال: 474182828379014288997015"
            />
          </div>
          <div class="uk-text-danger" v-if="errors.errors.bank_rib">
            {{ errors.get('bank_rib') }}
          </div>
        </div>
                <div class="uk-width-1-2@s">
          <label for="">
           العنوان (اختياري)
          </label>

          <div class="uk-form-controls">
            <input
              class="uk-input"
              type="text"
              name="company"
              value=""
              v-model="adresse"
              placeholder="Mandar Jamile B50 Etage N°4 - tanger 90000 "
            />
            <small>بالأحرف الفرنسية</small>
          </div>
          <div class="uk-text-danger" v-if="errors.errors.adresse">
            {{ errors.get("adresse") }}
          </div>
        </div>
        <div class="uk-width-1-1@s">
          <label>صف نفسك (اختياري)</label>
          <div class="uk-margin">
            <textarea
              class="uk-textarea"

              rows="5"
              placeholder=""
              v-model="description"
            ></textarea>
            <div class="uk-text-danger" v-if="errors.errors.description">
              {{ errors.get('description') }}
            </div>
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
          <button class="uk-button uk-button-primary btn-call">حفظ</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
var n = 0
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
  props: ['user', 'recaptcha'],
  data() {
    return {
      errors: new Errors(),
      logofile: '',
      slogan: '',
      brandcolor: '#f78b03',
      sector: '',
      u_if: '',
      u_tp: '',
      ice: '',
      b_email: this.user.email,
      b_phone: this.user.phonenumb,
      siteweb: '',
      bank_name: '',
      bank_account_name: '',
      bank_rib: '',
      cni: '',
      recaptcha_response: '',
      description: '',
      description_count: 0,
            adresse:"",

    }
  },
  methods: {
    count_description: function () {
      this.description_count = this.description.length
    },
    uplogo: function (e) {
      $('#form-loading').css('display', 'block')
      if (e.target.files && e.target.files[0]) {
        var reader = new FileReader()

        reader.onload = function (e) {
          $('#preview-image').attr('src', e.target.result)
        }

        reader.readAsDataURL(e.target.files[0])
        $('#preview-border').css('display', 'block')
      }
      let file = e.target.files[0]
      this.logofile = file
      var geekss = e.target.files[0].name
      $('#border_file').css('display', 'block')
      $('#filename_logo').text(' تم تحديد ' + geekss)
      $('#form-loading').css('display', 'none')
    },
    submitform: function () {
      $('#form-loading').css('display', 'block')
      this.recaptcha_response = document.getElementById(
        'g-recaptcha-response',
      ).value
      let data = new FormData()

      data.append('logo', this.logofile)
      data.append('slogan', this.slogan)
      data.append('brand_color', this.brandcolor)
      data.append('sector', this.sector)
      data.append('u_if', this.u_if)
      data.append('u_tp', this.u_tp)
      data.append('ice', this.ice)
      data.append('b_email', this.b_email)
      data.append('b_phone', this.b_phone)
      data.append('siteweb', this.siteweb)
      data.append('bank_name', this.bank_name)
      data.append('bank_account_name', this.bank_account_name)
      data.append('bank_rib', this.bank_rib)
      data.append('cni', this.cni)
      data.append('recaptcha_token', this.recaptcha_response)
      data.append('description', this.description)
          data.append("adresse", this.adresse);

      const config = { headers: { 'Content-Type': 'multipart/form-data' } }
      axios
        .post('../api/creer/desky/user', data, config)
        .then((response) => {
                        if(this.errors.errors){
                this.errors.errors = "";
            }
          $('#form-loading').css('display', 'none')
          UIkit.notification({
            message: 'تم حفظ البيانات',
            status: 'success',
            pos: 'top-center',
            timeout: 5000,
          })
          location.reload()
        })
        .catch((error) => {
          this.errors.record(error.response.data)
          grecaptcha.reset()
          this.CaptchaCallback()
          $('#form-loading').css('display', 'none')
          UIkit.notification({
            message:
              "يرجى التحقق من المدخلات <span uk-icon='icon: warning'></span>",
            status: 'danger',
            pos: 'top-center',
            timeout: 5000,
          })
        })
        .finally(() => {
          grecaptcha.reset()
          this.CaptchaCallback()
          $('#form-loading').css('display', 'none')
        })
    },
    logoupload: function () {
      // this.logo_url = $("#logo_change").val().replace(/.*(\/|\\)/, '');
    },
    CaptchaCallback: function () {
      this.$nextTick(function () {
        grecaptcha.render('recaptcha-main')
      })
    },
  },
  mounted() {
    this.CaptchaCallback()
  },
}
</script>
