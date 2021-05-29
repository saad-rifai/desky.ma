<template>
<div>
<div id="loading" class="form-loading"></div>
    <div class="uk-card uk-card-default uk-card-body">
      <div class="uk-text-right" dir="rtl">
        <button
          @click="CreerDevis"
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

      <br />

      <div class="uk-width-1-1@m">
                  <h2 class="uk-cart-title uk-text-left">N° {{ this.oid }}</h2>

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

          <div class="uk-width-1-2@s" dir="rtl">
            <label class="uk-text-right" dir="rtl">الحالة</label>
            <div class="uk-margin">
              <select v-model="status" class="uk-select">
                <option value="">-- تحديد --</option>
                <option
                  v-for="(statu, index) in devisStatus"
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
        @click="CreerDevis"
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
  props:['uid', 'oid'],
  data() {
    return {
      devisStatus: json.devis_status,
      p_methodsJson: json.p_method,
      errors: new Errors(),
      p_condition: '',
      p_method: '',
      pdfdevis: '',
      devis: [],
      subtotal: 0,
      total: 0,
      tva: 0,
      prtva: 1,
      avprice: '',
      invid: '',
      url_api: window.location.pathname,
      status: 0,
      remise: 0,
      remise_c: 0,
      OldDevis: []
    }
  },
  methods: {


    getout: function () {
      window.location.replace('/devis/list?ref=cancel_btn&method=js')
    },
    notificationchek: function () {
      if (this.errors.errors.items) {
        UIkit.notification({
          message: this.errors.errors.items[0],
          status: 'danger',
        })
      }
    },
    CreerDevis: function () {
      if (this.devis.length == 0) {
        this.devis.push({ article: '', price: 0, quantity: 1 })
      }
      this.updateDevis()
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
    updateDevis() {
      $('#form-loading').css('display', 'block')
      let data = new FormData()

      data.append('p_condition', this.p_condition)
      data.append('p_method', this.p_method)
      data.append('items', JSON.stringify(this.devis))
      data.append('OID', this.oid)
      data.append('remise', this.remise_c)
      data.append('status', this.status)
      axios
        .post('../../update', data)
        .then((response) => {
          
        UIkit.notification({
          message: 'تم تحديث البيانات بنجاح',
          status: 'success',
        })
          $('#form-loading').css('display', 'none')
        })
        .catch((error) => {
          this.errors.record(error.response.data)
          this.notificationchek()
          $('#form-loading').css('display', 'none')
        }).finally(() => {
    $('#form-loading').css('display', 'none')

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
    SetOldDevis: function(){

    },
    getDevisInfos: function(){
          $('#form-loading').css('display', 'block')

        axios.post('/devis/'+this.oid+'/'+this.uid+'/json')
        .then((response) => {
              $('#form-loading').css('display', 'none')

     this.OldDevis.push(JSON.parse(response.data[0].items));
            for(var i=0; JSON.parse(response.data[0].items).length > i; i++){
             this.devis.push(this.OldDevis[0][i]);
             this.remise = response.data[0].remise;
             if(response.data[0].p_condition != null){
             this.p_condition = response.data[0].p_condition;

             }if(response.data[0].p_method != null){
             this.p_method = response.data[0].p_method;

             }
             this.status = response.data[0].status;
             
             this.changedata();

            }
        }).catch((error) => {
                $('#form-loading').css('display', 'none')
                this.getDevisInfos();
            
            });
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
      this.getDevisInfos();
  },

  mounted() {
  },
}
</script>
