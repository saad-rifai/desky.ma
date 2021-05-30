<template>
  <div>
    <div id="loading" class="form-loading"></div>
    <div class="uk-card uk-card-default uk-card-body">
      <div class="uk-text-right" dir="rtl">
        <button
          @click="CreerFacture"
          type="button"
          class="uk-button uk-button-primary btn-call uk-margin-top"
        >
          حفظ
        </button>

        <button
          type="button"
          @click="getout"
          class="uk-button uk-margin-top uk-button-danger btn-call"
        >
          الغاء
        </button>
      </div>
      <br />
      <div class="uk-width-1-1@m">
        <h2 class="uk-cart-title uk-text-left">N° {{ this.invid }}</h2>
        <h3 class="uk-cart-title uk-text-right">معلومات عن العميل</h3>
        <hr />
      </div>
      <div>
        <div class="form-formulaire uk-text-right" dir="rtl" uk-grid>
          <div class="uk-width-1-1@s">
            <label for="">
              البحث عن عميل موجود
            </label>
            <div class="uk-form-controls" v-clickoutside="hide">
              <div class="uk-inline uk-width-1-1">
                <span
                  class="uk-form-icon uk-form-icon-flip"
                  uk-icon="icon: search"
                ></span>
                <span
                  class="uk-form-icon uk-form-icon"
                  uk-spinner="ratio: 0.5"
                  v-if="datalistloading == true"
                ></span>
                <input
                  class="uk-input"
                  type="text"
                  @input="searchClient('n')"
                  @change="searchClient('n')"
                  @focus="CleantsListshow = true"
                  v-model="q"
                />
              </div>
              <div
                v-if="
                  CleantsListshow == true && q != '' && cleantslist.length > 0
                "
                class="data-list"
              >
                <div class="data-list-content">
                  <h4 for="">
                    <i class="fas fa-users"></i>
                    قائمة العملاء المسجلين
                  </h4>

                  <ul class="uk-list uk-list-collapse uk-list-striped">
                    <li
                      v-for="(item, index) in cleantslist"
                      :key="index"
                      @click="selectCleants(index)"
                    >
                      {{ item.c_name }}
                      <br />
                      <small>{{ item.c_email }} - {{ item.c_phone }}</small>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">
              الاسم الكامل للعميل
              <span class="red">*</span>
            </label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                v-model="c_name"
                placeholder=""
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_name">
              {{ errors.errors.c_name[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">
              رقم الهاتف
              <span class="red">*</span>
            </label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                v-model="c_phone"
                placeholder=""
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_phone">
              {{ errors.errors.c_phone[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">
              البريد الالكتروني
              <span class="red">*</span>
            </label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                name="fname"
                placeholder=""
                v-model="c_email"
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_email">
              {{ errors.errors.c_email[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">رقم التعريفي الموحد (ICE) (اختياري)</label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                v-model="c_ice"
                placeholder=""
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_ice">
              {{ errors.errors.c_ice[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">
              نوع العميل
              <span class="red">*</span>
            </label>
            <div class="uk-form-controls">
              <select v-model="c_type" class="uk-select">
                <option value=""></option>
                <option
                  v-for="(item, index) in typeClients"
                  :key="index"
                  :value="index"
                >
                  {{ item }}
                </option>
              </select>
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_type">
              {{ errors.errors.c_type[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">الدولة (اختياري)</label>
            <div class="uk-form-controls" v-clickoutside="hideCountriesList">
              <div class="uk-inline uk-width-1-1">
                <span
                  v-if="country != ''"
                  class="uk-form-icon uk-form-icon flag-icon"
                >
                  <img
                    :src="
                      'https://www.countryflags.io/' + country + '/flat/64.png'
                    "
                  />
                </span>
                <span
                  class="uk-form-icon uk-form-icon-flip"
                  uk-icon="icon:  triangle-down"
                ></span>
                <input
                  class="uk-input uk-width-1-1"
                  v-model="countryName"
                  @click="showlistCountries = true"
                />
              </div>
              <div v-if="showlistCountries == true" class="data-list">
                <div class="data-list-content">
                  <h4 for="">
                    <i class="fas fa-globe-africa"></i>
                    قائمة الدول
                  </h4>

                  <ul class="uk-list uk-list-collapse uk-list-striped">
                    <li
                      v-for="(item, index) in filteredList"
                      :key="index"
                      @click="
                        country = item.code
                        countryName = item.name
                        showlistCountries = false
                      "
                    >
                      <span class="flag-icon">
                        <img
                          :src="
                            'https://www.countryflags.io/' +
                            item.code +
                            '/flat/64.png'
                          "
                        />
                      </span>
                      {{ item.name }}
                    </li>
                    <li v-if="filteredList.length <= 0" class="uk-text-center">
                      <small>لايوجد اي بيانات</small>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="uk-text-danger" v-if="errors.errors.country">
              {{ errors.errors.country[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">المدينة (اختياري)</label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                v-model="city"
                placeholder=""
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_city">
              {{ errors.errors.c_city[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">العنوان (اختياري)</label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                v-model="adresse"
                placeholder=""
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_adresse">
              {{ errors.errors.c_adresse[0] }}
            </div>
          </div>
        </div>
      </div>

      <br />
      <div class="uk-width-1-1@m">
        <h3 class="uk-cart-title uk-text-right">معلومات عن الطلب</h3>
        <hr />
      </div>
      <div>
        <div id="fileds">
          <div
            class="form-formulaire uk-text-right"
            v-for="(devi, index) in devis"
            :key="index"
            dir="rtl"
            uk-grid
          >
            <div class="uk-width-1-1">
              <h1 class="uk-card-title uk-text-right">
                العنصر {{ index + 1 }}
              </h1>
            </div>
            <div class="uk-width-1-4@s">
              <div class="uk-form-controls">
                <label for="">
                  الخدمة أو المنتج (بالفرنسية)
                  <span class="red">*</span>
                </label>
                <input
                  class="uk-input"
                  @change="changedata"
                  v-model="devi.article"
                  type="text"
                  name="fname"
                  placeholder=""
                  value=""
                  required
                />
              </div>
            </div>
            <div class="uk-width-1-4@s">
              <div class="uk-form-controls">
                <label for="">
                  السعر
                  <span class="red">*</span>
                </label>

                <input
                  class="uk-input"
                  @change="changedata"
                  v-model="devi.price"
                  min="0"
                  type="number"
                  name="fname"
                  placeholder=""
                  value="0"
                  required
                />
              </div>
            </div>
            <div class="uk-width-1-5@s">
              <div class="uk-form-controls">
                <label for="">
                  الكمية
                  <span class="red">*</span>
                </label>
                <input
                  class="uk-input"
                  @change="changedata"
                  v-model="devi.quantity"
                  id="qty"
                  type="number"
                  min="1"
                  name="fname"
                  value="1"
                />
              </div>
            </div>
            <div class="uk-width-1-4@s">
              <div class="uk-form-controls">
                <label for="">.</label>
                <input
                  type="button"
                  @click="deleteUser(index)"
                  class="uk-input uk-button uk-button-danger"
                  value="حذف"
                />
              </div>
            </div>

            <div class="uk-width-1-1@s">
              <hr />
            </div>
          </div>
        </div>

        <div class="uk-width-1-1@s">
          <input
            type="button"
            id="addmor"
            @click="addFind"
            class="uk-input uk-button uk-button-primary uk-margin-top"
            value="المزيد"
          />
        </div>
        <div class="uk-width-1-1@s">
          <br />
          <hr />
        </div>

        <div class="uk-margin uk-grid-small uk-text-right" dir="rtl" uk-grid>
          <h2 class="uk-card-title uk-text-right uk-width-1-1@s">
            الدفع والأداء
          </h2>
          <div class="uk-width-1-1@s">
            <label>مبلغ الخصم (اختياري)</label>
            <div class="uk-margin">
              <input
                v-model="remise"
                min="0"
                @change="changedata"
                class="uk-input"
                type="number"
                placeholder="Ex: 1099.99"
              />
            </div>
          </div>
          <div class="uk-width-1-2@s" dir="rtl">
            <label class="uk-text-right" dir="rtl">
              شروط الدفع (اختياري)
            </label>
            <div class="uk-margin">
              <select class="uk-select" v-model="p_condition">
                <option value="0">بدون</option>
                <option value="1">التسبيق 10% والباقي عند الاستلام</option>
                <option value="2">التسبيق 15% والباقي عند الاستلام</option>
                <option value="3">التسبيق 20% والباقي عند الاستلام</option>
                <option value="4">التسبيق 25% والباقي عند الاستلام</option>
                <option value="5">التسبيق 30% والباقي عند الاستلام</option>
                <option value="6">التسبيق 35% والباقي عند الاستلام</option>
                <option value="7">التسبيق 40% والباقي عند الاستلام</option>
                <option value="8">التسبيق 45% والباقي عند الاستلام</option>
                <option value="9">التسبيق 50% والباقي عند الاستلام</option>
                <option value="10">التسبيق 60% والباقي عند الاستلام</option>
                <option value="11">التسبيق 70% والباقي عند الاستلام</option>
                <option value="12">التسبيق 100%</option>
              </select>
            </div>
            <div class="uk-text-danger" v-if="errors.errors.p_condition">
              {{ errors.errors.p_condition[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s" dir="rtl">
            <label class="uk-text-right" dir="rtl">
              وسيلة الدفع (اختياري)
            </label>
            <div class="uk-margin">
              <select v-model="p_method" class="uk-select">
                <option value="">-- تحديد --</option>
                <option
                  v-for="(item, index) in p_methodsJson"
                  :key="index"
                  :value="index"
                >
                  {{ item }}
                </option>
              </select>
            </div>
            <div class="uk-text-danger" v-if="errors.errors.p_method">
              {{ errors.errors.p_method[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s uk-first-column" dir="rtl">
            <label class="uk-text-right" dir="rtl">ملاحضات</label>
            <small>هذه الملاحظات ستراها انت فقط</small>
            <div class="uk-margin">
              <textarea
                name=""
                v-model="notes"
                class="uk-textarea"
                id=""
                rows="4"
              ></textarea>
            </div>
            <div class="uk-text-danger" v-if="errors.errors.notes">
              {{ errors.errors.notes[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s" dir="rtl">
            <label class="uk-text-right" dir="rtl">الحالة</label>
            <div class="uk-margin">
              <select v-model="status" class="uk-select">
                <option value="">-- تحديد --</option>
                <option
                  v-for="(statu, index) in FactureStatus"
                  :key="index"
                  :value="index"
                >
                  {{ statu }}
                </option>
              </select>
            </div>
            <div class="uk-text-danger" v-if="errors.errors.p_method">
              {{ errors.errors.p_method[0] }}
            </div>
          </div>
        </div>
      </div>
      <div class="uk-width-1-3@s uk-text-left">
        <div class="uk-text-right content-total">
          <h3 class="text-f-bloder">
            المجموع:
            {{
              this.subtotal.toLocaleString('en-US', {
                style: 'currency',
                currency: 'MAD',
              })
            }}
          </h3>
          <hr />
          <h3 v-if="remise_c > 0" class="text-f-bloder">
            الخصم:
            {{
              this.remise_c.toLocaleString('en-US', {
                style: 'currency',
                currency: 'MAD',
              })
            }}
          </h3>

          <hr v-if="remise_c > 0" />
          <h3 class="text-f-bloder">
            الضريبة(TVA):
            {{
              this.tva.toLocaleString('en-US', {
                style: 'currency',
                currency: 'MAD',
              })
            }}
          </h3>
          <hr />
          <div class="total-border">
            <h3 class="text-f-bolder-w">
              المجموع الكلي:
              {{
                this.total.toLocaleString('en-US', {
                  style: 'currency',
                  currency: 'MAD',
                })
              }}
            </h3>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="uk-text-right" dir="rtl">
      <button
        @click="CreerFacture"
        type="button"
        class="uk-button btn-call uk-button-primary uk-margin-top"
      >
        حفظ
      </button>

      <button
        @click="getout"
        type="button"
        class="uk-button uk-margin-top uk-button-danger btn-call"
      >
        الغاء
      </button>
    </div>
  </div>
</template>
<script>
import json from '../../../database/data.json'

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
  props: ['uid'],
  data() {
    return {
      showlistCountries: false,
      datalistloading: false,
      q: '',
      FactureStatus: json.facture_status,
      p_methodsJson: json.p_method,
      typeClients: json.type_clients,
      Countries: json.countries,
      errors: new Errors(),
      c_name: '',
      c_phone: '',
      c_email: '',
      c_ice: '',
      c_type: '',
      p_condition: '',
      p_method: '',
      pdfdevis: '',
      city: '',
      adresse: '',
      devis: [],
      subtotal: 0,
      total: 0,
      tva: 0,
      prtva: 1,
      avprice: '',
      invid: '',
      country: '',
      url_api: window.location.pathname,
      planinfos: [],
      notes: '',
      status: 0,
      remise: 0,
      remise_c: 0,
      cleantslist: [],
      CleantsListshow: false,
      countryName: '',
    }
  },
  methods: {
    hide: function () {
      this.CleantsListshow = false
    },
    hideCountriesList: function () {
      this.showlistCountries = false
      this.countryName = ''

      for (var i = 0; this.Countries.length > i; i++) {
        if (this.Countries[i].code == this.country) {
          this.countryName = this.Countries[i].name
        }
      }
    },
    getout: function () {
      window.location.replace('../../devis/list?ref=cancel_btn&method=js')
    },
    notificationchek: function () {
      if (this.errors.errors.items) {
        UIkit.notification({
          message: this.errors.errors.items[0],
          status: 'danger',
        })
      }
    },
    CreerFacture: function () {
      if (this.devis.length == 0) {
        this.devis.push({ article: '', price: 0, quantity: 1 })
      }
      this.loadpoints()
    },
    addInvoice: function () {
      axios
        .post('../api/v1/user/desky/facture/maxNumber')
        .then((response) => {
          if (response.data.length > 0) {
            var responseNumber = parseInt(response.data) + 1
            this.invid = responseNumber.toString().padStart(8, '0')
          } else {
            this.invid = '00000001'
          }
        })
        .catch((error) => {
          UIkit.notification({
            message:
              "حصل خطأ أثناء محاولة تكوين رقم للفاتورة <span uk-icon='icon: warning'></span>",
            status: 'danger',
          })
          this.addInvoice()
        })
    },
    addFind: function () {
      if (this.devis.length == 6) {
        UIkit.notification({
          message: "الحد الأفصى 6 عناصر <span uk-icon='icon: warning'></span>",
          status: 'danger',
        })
      } else {
        this.devis.push({ article: '', price: 0, quantity: 1 })
      }
    },
    loadpoints() {
      $('#form-loading').css('display', 'block')
      let data = new FormData()

      data.append('c_name', this.c_name)
      data.append('c_phone', this.c_phone)
      data.append('c_email', this.c_email)
      data.append('c_ice', this.c_ice)
      data.append('c_type', this.c_type)
      data.append('p_condition', this.p_condition)
      data.append('p_method', this.p_method)
      data.append('items', JSON.stringify(this.devis))
      data.append('OID', this.invid)
      data.append('remise', this.remise_c)
      data.append('status', this.status)
      data.append('notes', this.notes)
      data.append('c_country', this.country)
      data.append('c_city', this.city)
      data.append('c_adresse', this.adresse)
      axios
        .post('../api/creer_facture', data)
        .then((response) => {
          this.planinfos = response.data
          if (response.status == 220) {
            window.location.replace(
              '../../facture/' + this.invid + '/' + this.uid,
            )
          }
          $('#form-loading').css('display', 'none')
        })
        .catch((error) => {
          this.errors.record(error.response.data)
          this.notificationchek()
          $('#form-loading').css('display', 'none')
        })
        .finally(() => {
          $('#form-loading').css('display', 'none')
        })
    },
    searchClient: function (e) {
      this.datalistloading = true
      // N == le nom du client
      let data = new FormData()
      data.append('method', 'n')
      data.append('q', this.q)
      axios
        .post('../api/v1/user/desky/clients/getSearch', data)
        .then((response) => {
          this.cleantslist = response.data
          this.datalistloading = false
        })
        .catch((error) => {
          this.datalistloading = false
        })
    },
    changedata: function () {
      var articels = this.devis.length
      this.subtotal = 0

      for (var i = 0; i < articels; i++) {
        if (this.devis[i].price > 1000000) {
          this.devis[i].price = 0
          UIkit.notification({
            message: 'الحد الأقصى لمبلغ العنصر الواحد 1,000,000 درهم',
            status: 'danger',
          })
        } else if (this.devis[i].quantity > 100000) {
          this.devis[i].quantity = 0
          UIkit.notification({
            message: 'الحد الأقصى للكمية في العنصر الواحد 100,000 ',
            status: 'danger',
          })
        } else if (this.remise > 9000000) {
          UIkit.notification({
            message: 'مبلغ الخصم الأقصى 9,000,000 درهم',
            status: 'danger',
          })
        } else {
          var pricearticle = parseFloat(0 + this.devis[i].price)
          var qty = parseFloat(0 + this.devis[i].quantity)
          this.subtotal += pricearticle * qty
        }
      }

      this.tva = (this.subtotal - this.remise * this.prtva) / 100
      this.total = this.subtotal - this.remise + this.tva
      this.remise_c = parseInt(this.remise)
    },
    selectCleants: function (u) {
      this.c_name = this.cleantslist[u].c_name
      this.c_email = this.cleantslist[u].c_email
      this.c_phone = this.cleantslist[u].c_phone
      if (this.cleantslist[u].c_ice != null) {
        this.c_ice = this.cleantslist[u].c_ice
      }
      if (this.cleantslist[u].country != null) {
        this.country = this.cleantslist[u].country
      }
      if (this.cleantslist[u].adresse != null) {
        this.adresse = this.cleantslist[u].adresse
      }
      if (this.cleantslist[u].city != null) {
        this.city = this.cleantslist[u].city
      }

      this.c_type = this.cleantslist[u].c_type
      this.q = this.cleantslist[u].c_name
      this.countryName = ''
      for (var i = 0; this.Countries.length > i; i++) {
        if (this.Countries[i].code == this.cleantslist[u].country) {
          this.countryName = this.Countries[i].name
        }
      }
      this.hide()
    },
    deleteUser: function (index) {
      console.log(index)
      console.log(this.finds)
      this.devis.splice(index, 1)
      if (index === 0) this.addFind()
      this.changedata()
    },
    defocusApp() {
      this.$root.$emit('defocusApp') // emitted event
    },
  },
  created() {
    this.addInvoice()
  },
  computed: {
    filteredList() {
      return this.Countries.filter((post) => {
        return post.name.toLowerCase().includes(this.countryName.toLowerCase())
      })
    },
  },
  mounted() {
    //this.loadpoints();

    $('#form-loading').css('display', 'none')
  },
}
</script>
