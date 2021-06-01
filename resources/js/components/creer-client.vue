<template>
<div>
<div id="loading" class="form-loading"></div>
    <div class="uk-card uk-card-default uk-card-body">
      <div class="uk-text-right" dir="rtl">
        <button
          @click="createClient"
          type="button"
          class="uk-button uk-button-primary btn-call uk-margin-top">
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
            <div class="uk-form-controls" >
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
            <label for="" >الدولة (اختياري)</label>
            <div class="uk-form-controls" v-clickoutside="hideCountriesList">
<div class="uk-inline uk-width-1-1">
<span v-if="country != ''" class="uk-form-icon uk-form-icon flag-icon"> <img :src="'https://www.countryflags.io/'+country+'/flat/64.png'"></span>
<span  class="uk-form-icon uk-form-icon-flip " uk-icon="icon:  triangle-down"></span>
  <input class="uk-input uk-width-1-1" @change="searchCountry"
 v-model="countryName" @click="showlistCountries = true">
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

                      @click="country = item.code; countryName = item.name; showlistCountries = false"
                    >
                  <span class="flag-icon"><img :src="'https://www.countryflags.io/'+item.code+'/flat/64.png'"></span> {{ item.name }}

                    </li>
                    <li v-if="filteredList.length <= 0 " class="uk-text-center"> <small>لايوجد اي بيانات</small> </li>

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
          <div class="uk-width-1-2@s uk-first-column" dir="rtl">
            <label class="uk-text-right" dir="rtl">ملاحضات</label>
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
    </div>
    <br />
    <div class="uk-text-right" dir="rtl">
      <button
        @click="createClient"
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
  props:['uid'],
  data() {
    return {
    showlistCountries: false,
    datalistloading: false,
      q: '',
      typeClients: json.type_clients,
      Countries: json.countries,
      errors: new Errors(),
      c_name: '',
      c_phone: '',
      c_email: '',
      c_ice: '',
      c_type: '',
      city: '',
      adresse: '',
      invid: '',
      country: '',
      url_api: window.location.pathname,
      notes: '',
      status: 0,
      countryName: ''
    }
  },
  methods: {

    getout: function () {
      window.location.replace('/clients/list?ref=cancel_btn&method=js')
    },


    addCID: function () {

      axios.post('/api/v1/user/desky/clients/maxNumber').then((response) => {
          if(response.data.length > 0){
var responseNumber = parseInt(response.data)+1;
this.invid = responseNumber.toString().padStart(8, "0");
          }else{
            this.invid = '00000001'
          }


      }).catch((error) => {
                  UIkit.notification({
          message: "حصل خطأ اثناء محاولة انشاء عميل يرجى اعادة المحاولة <span uk-icon='icon: warning'></span>",
          status: 'danger',
        });
  this.addCID();
      });
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
    createClient() {
      $('#form-loading').css('display', 'block')
      let data = new FormData()

      data.append('c_name', this.c_name)
      data.append('c_phone', this.c_phone)
      data.append('c_email', this.c_email)
      data.append('c_ice', this.c_ice)
      data.append('c_type', this.c_type)
      data.append('CID', this.invid)
      data.append('notes', this.notes)
      data.append('c_country', this.country)
      data.append('c_city', this.city)
      data.append('c_adresse', this.adresse)
      axios
        .post('/api/v1/user/desky/creer/Clients', data)
        .then((response) => {
          this.planinfos = response.data
          if (response.status == 220) {
            window.location.replace('/clients/' + this.invid+'/'+this.uid)
          }
          $('#form-loading').css('display', 'none')
        })
        .catch((error) => {
          this.errors.record(error.response.data)
          if (error.response.status == 500) {
                  UIkit.notification({
          message: error.response.data.message,
          status: 'danger',
        })
          }
          $('#form-loading').css('display', 'none')
        });
    },


    hideCountriesList: function(){
        this.showlistCountries = false
        this.countryName = '';

        for(var i=0; this.Countries.length > i; i++){
          if(this.Countries[i].code == this.country){
              this.countryName = this.Countries[i].name;
          }
      }
    },


    searchCountry: function(){
              return this.Countries.filter(post => {
        return post.name.toLowerCase().includes(this.countryName.toLowerCase())
      })
    }
  },
  created() {
this.addCID();
  },
computed:{

    filteredList() {
      return this.Countries.filter(post => {
        return post.name.toLowerCase().includes(this.countryName.toLowerCase())
      })
    }
},
  mounted() {
    $('#form-loading').css('display', 'none')
  },
}
</script>
