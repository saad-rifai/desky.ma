<template>
  <div>
    <div class="form-border wd-80 uk-text-right">
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
            <span class="uk-text-middle">الحجم الأقصى للملف 80KB</span>
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
          <div
            v-if="logourl != '' && logourl != null"
            style="display: block;"
            class="border-show-image"
            id="preview-border"
          >
            <div class="border-preview">
              <span class="">
                <i class="fa fa-eye"></i>
                المعاينة
              </span>
            </div>
            <img
              :src="'../' + logourl"
              id="preview-image"
              class="logo-image uk-position-center"
            />
            <div @click="removeLogo" class="delete-border-btn">
              <span>حذف</span>
            </div>
          </div>
          <div class="uk-text-danger" v-if="errors.errors.logo">
            {{ errors.get('logo') }}
          </div>
          <hr />
        </div>
        <div class="uk-width-1-1@s">
          <label for="">قالب عروض الأسعار (devis)</label>

          <div class="uk-margin">
            <div class="uk-grid-small" uk-grid>
              <div
                v-for="(item, index) in devis_models"
                :key="index"
                class="uk-width-1-2@s"
              >
                <div class="model-view" @click="modelcheck(index)">
                  <img
                    :src="'/image/models/devis/' + item.preview_image"
                    :alt="item.name + ' - Desky.ma - ' + item.date"
                  />
                  <div
                    :id="index"
                    class="title-model-view uk-position-bottom"
                    v-bind:class="{ selected: index == userinfos.model_devis }"
                  >
                    {{ item.name }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr />
        </div>
        <div class="uk-width-1-1@s">
          <label for="">قالب الفواتير</label>
          <div class="uk-margin">
            <div class="uk-grid-small" uk-grid>
              <div
                v-for="(item, index) in factures_models"
                :key="index"
                class="uk-width-1-2@s"
              >
                <div class="model-view" @click="modelfactureCheck(index)">
                  <img
                    :src="'/image/models/factures/' + item.preview_image"
                    :alt="item.name + ' - Desky.ma - ' + item.date"
                  />
                  <div
                    :id="'f' + index"
                    class="title-model-view uk-position-bottom"
                    v-bind:class="{
                      selected: index == userinfos.model_facture,
                    }"
                  >
                    {{ item.name }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr />
        </div>
        <div class="uk-width-1-2@s">
          <label for="">
            المهنة (اختياري)
            <span class="red">*</span>
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
            {{ errors.get('slogan') }}
          </div>
        </div>
        <div class="uk-width-1-4@s">
          <label for="">
            لون النماذج
            <span class="red">*</span>
          </label>
          <div class="uk-form-controls">
            <label for="">
              اختيار لون:
              <input
                class="uk-input color-input"
                lang="ar"
                type="color"
                name="fname"
                placeholder="مثال: Full Stack developper"
                value="#f78b03"
                v-model="brandcolor"
                required
              />
            </label>
          </div>
          <datalist id="brandcolor">
            <option value="#f78b03"></option>
            <option value="#f30f5c"></option>
            <option value="#03a9f4"></option>
            <option value="#ff5722"></option>
          </datalist>
          <div class="uk-text-danger" v-if="errors.errors.brandcolor">
            {{ errors.get('brandcolor') }}
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
              <option value="0">الصناعة</option>
              <!-- 0.5% -->
              <option value="1">الخدمات</option>
              <!-- 1% -->
              <option value="2">التجارة</option>
              <!-- 0.5% -->
              <option value="3">الصناعة التقليدية</option>
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
              disabled
            />
            <small>
              لايمكنك تغيير هذه المعلومات
              <span
                uk-icon="icon: info; ratio:0.7"
                uk-tooltip="title: تمنع سياستنا تغيير المعلومات المهنية في حال كانت المعلومات خاطئة يجرى التواصل معنا عبر support@desky.ma"
              ></span>
            </small>
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
              disabled
            />
          </div>
          <small>
            لايمكنك تغيير هذه المعلومات
            <span
              uk-icon="icon: info; ratio:0.7"
              uk-tooltip="title: تمنع سياستنا تغيير المعلومات المهنية في حال كانت المعلومات خاطئة يجرى التواصل معنا عبر support@desky.ma"
            ></span>
          </small>

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
              disabled
            />
            <small>
              لايمكنك تغيير هذه المعلومات
              <span
                uk-icon="icon: info; ratio:0.7"
                uk-tooltip="title: تمنع سياستنا تغيير المعلومات المهنية في حال كانت المعلومات خاطئة يجرى التواصل معنا عبر support@desky.ma"
              ></span>
            </small>
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
              disabled
            />
            <small>
              لايمكنك تغيير هذه المعلومات
              <span
                uk-icon="icon: info; ratio:0.7"
                uk-tooltip="title: تمنع سياستنا تغيير المعلومات المهنية في حال كانت المعلومات خاطئة يجرى التواصل معنا عبر support@desky.ma"
              ></span>
            </small>
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
              placeholder="مثال: CFG BANK"
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
              placeholder="مثال: mohammed nasiri"
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
            {{ errors.get('adresse') }}
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
          <button class="uk-button uk-button-primary btn-call">حفظ</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import json from '../../../database/data.json'

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
  props: ['user'],
  data() {
    return {
      errors: new Errors(),
      devis_models: json.devis_template,
      factures_models: json.facture_template,
      logofile: '',
      logourl: '',
      slogan: '',
      brandcolor: '#f78b03',
      sector: '',
      u_if: '',
      u_tp: '',
      ice: '',
      adresse: '',
      b_email: this.user.email,
      b_phone: this.user.phonenumb,
      siteweb: '',
      bank_name: '',
      bank_account_name: '',
      bank_rib: '',
      cni: '',
      description: '',
      description_count: 0,
      userinfos: [],
      modelsCount: 2,
      modelDevis: 0,
      modelfacture: 0,
      removeLogoFile: false,
    }
  },
  methods: {
    count_description: function () {
      this.description_count = this.description.length
    },
    removeLogo: function () {
      this.logofile = ''
      this.logourl = ''
      this.removeLogo = true
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
      } else {
        $('#form-loading').css('display', 'none')
      }
      let file = e.target.files[0]
      this.logofile = file
      var geekss = e.target.files[0].name
      $('#border_file').css('display', 'block')
      $('#filename_logo').text(' تم تحديد ' + geekss)
      $('#form-loading').css('display', 'none')
    },
    getuserdata: function () {
      $('#form-loading').css('display', 'block')
      axios
        .post('../api/get/desky/user')
        .then((response) => {
          this.userinfos = response.data
          this.cni = this.userinfos.cni
          this.logourl = this.userinfos.logo
          this.bank_account_name = this.userinfos.compte_bank_username
          this.bank_name = this.userinfos.compte_bank_name
          this.bank_rib = this.userinfos.compte_bank_rib
          this.brandcolor = this.userinfos.brandcolor
          this.ice = this.userinfos.ice
          this.u_if = this.userinfos.if
          this.u_tp = this.userinfos.tp
          //this.slogan = this.userinfos.slogon;
          this.sector = this.userinfos.sector
          this.modelDevis = this.userinfos.model_devis
          // Slogan
          if (this.userinfos.slogon == null) {
            this.slogan = ''
          } else {
            this.slogan = this.userinfos.slogon
          }

          if (this.userinfos.description == null) {
            this.description = ''
          } else {
            this.description = this.userinfos.description
          }
          if (this.userinfos.adresse == null) {
            this.adresse = ''
          } else {
            this.adresse = this.userinfos.adresse
          }
          if (this.userinfos.siteweb == null) {
            this.siteweb = ''
          } else {
            this.siteweb = this.userinfos.siteweb
          }
          $('#form-loading').css('display', 'none')
        })
        .catch((error) => {
          $('#form-loading').css('display', 'none')
          UIkit.notification({
            message: "تعذر جلب البيانات <span uk-icon='icon: warning'></span>",
            status: 'danger',
            pos: 'top-center',
            timeout: 5000,
          })
          window.location.reload()
        })
        .finally(() => {
          $('#form-loading').css('display', 'none')
        })
    },
    modelfactureCheck: function (e) {
      var c = this.modelfacture
      $('#f' + e).addClass('selected')
      this.modelfacture = e
      for (var i = 0; c >= i; i++) {
        if (i != e) {
          $('#f' + i).removeClass('selected')
        }
      }
    },
    modelcheck: function (e) {
      var c = this.modelDevis
      $('#' + e).addClass('selected')
      this.modelDevis = e
      for (var i = 0; c >= i; i++) {
        if (i != e) {
          $('#' + i).removeClass('selected')
        }
      }
    },
    submitform: function () {
      $('#form-loading').css('display', 'block')

      let data = new FormData()
      if (this.logofile == '' && this.removeLogo == true) {
        data.append('removeLogo', true)
      }

      data.append('logo', this.logofile)
      data.append('slogan', this.slogan)
      data.append('brand_color', this.brandcolor)
      data.append('sector', this.sector)
      data.append('u_if', this.userinfos.if)
      data.append('u_tp', this.userinfos.tp)
      data.append('ice', this.userinfos.ice)
      data.append('b_email', this.b_email)
      data.append('b_phone', this.b_phone)
      data.append('siteweb', this.siteweb)
      data.append('bank_name', this.bank_name)
      data.append('bank_account_name', this.bank_account_name)
      data.append('bank_rib', this.bank_rib)
      data.append('cni', this.userinfos.cni)
      data.append('description', this.description)
      data.append('model_devis', this.modelDevis)
      data.append('model_facute', this.modelfacture)
      data.append('adresse', this.adresse)
      let config = {
        headers: { 'Content-Type': 'multipart/form-data' },
      }
      axios
        .post('../api/update/desky/user', data, config)
        .then((response) => {
          if (this.errors.errors) {
            this.errors.errors = ''
          }
          $('#form-loading').css('display', 'none')
          UIkit.notification({
            message: 'تم حفظ البيانات',
            status: 'success',
            pos: 'top-center',
            timeout: 5000,
          })
        })
        .catch((error) => {
          this.errors.record(error.response.data)
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
          $('#form-loading').css('display', 'none')
        })
    },
    logoupload: function () {
      // this.logo_url = $("#logo_change").val().replace(/.*(\/|\\)/, '');
    },
  },
  created() {
    this.getuserdata()
  },
  mounted() {},
}
</script>
