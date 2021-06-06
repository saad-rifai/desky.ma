<template>
  <div>
    <div class="uk-margin">
        <label for="">الباقة:</label>
      <select dir="rtl" @change="CartUpdate" class="uk-select" v-model="pack_id">
          <option v-for="(item, index) in packs" :key="index" :value="index"> {{item.name}} ({{item.points}} عرض اسعار / فاتورة)</option>
      </select>
    </div>
        <div class="uk-margin">
        <label for="">نوع الاشتراك:</label>
      <select @change="CartUpdate" class="uk-select" v-model="type">
          <option value="m">اشتراك شهري</option>
          <option value="y">اشتراك سنوي</option>
      </select>
    </div>
    <div>
        <label for=""></label>
    </div>
    <h4 class="uk-card-title uk-text-right">الدفع و الأداء</h4>
    <hr class="uk-divider-icon" />
    <div class="uk-margin" id="checkedsection">
      <label for="">وسيلة الدفع</label>
      <br />
      <div style="margin-top: 10px;">
        <label>
          <input
            class="uk-radio"
            type="radio"
            value="1"
            v-model="method"
            name="radio2"
            @change="methodChange()"
          />
          الدفع نقدا عبر وكالة wafacach

          <img class="icons-radio" :src="method1" alt="" />
          <small
            uk-tooltip="title: يتم تفعيل باقتك بشكل فوري وتلقائي فور ادائك للمبلغ عبر احدى وكالات وافاكاش; pos: left"
          >
            (تفعيل فوري )
          </small>
        </label>

        <div v-if="method == '1'">
          <br />
          <hr />

          <div uk-alert>يمكنك الدفع بأمان نقداََ عبر شركائنا wafacach</div>
        </div>
      </div>

      <div style="margin-top: 10px;">
        <label>
          <input
            class="uk-radio"
            id="bank_radio"
            value="2"
            v-model="method"
            type="radio"
            name="radio2"
            @change="methodChange()"
          />
          تحويل بنكي
          <img class="icons-radio po" :src="method2" alt="" />
          <small
            uk-tooltip="title: عند اختيارك الدفع عبر تحويل بنكي  قد يستغرق معالجة طلبك وتفعيل باقتك 48 ساعة; pos: left"
          >
            (قد يستغرق 48h)
          </small>
        </label>

        <div v-if="method == '2'">
          <br />
          <hr />

          <label for="">معلومات الدفع:</label>
          <br />
          <div>رقم الحساب (RIB): {{ $root.RIB_BANK }}</div>
          <div>اسم الحساب: {{ $root.BANK_HOLDER }}</div>
          <div>البنك: {{ $root.BANK_NAME }}</div>
          <div>
            السعر:
            {{
              $root.totalprice.toLocaleString('en-US', {
                style: 'currency',
                currency: 'MAD',
              })
            }}
          </div>

        </div>
      </div>
    </div>
    <br />
    <table class="uk-table cart-table-moqawala uk-text-right min-p" dir="rtl">
      <tbody>
        <tr>
          <td>تكلفة الخدمة:</td>
          <td class="labelcart">
            <span v-if="numberload" uk-spinner></span>

            <span v-else>
              {{
                amount.toLocaleString('en-US', {
                  style: 'currency',
                  currency: 'MAD',
                })
              }}
            </span>
          </td>
        </tr>
        <tr>
          <td>
            رسوم إجرائية:
            <span
              uk-icon="icon:info"
              uk-tooltip="title: يتم فرض هذه الرسوم من قبل بوابات الدفع مثل Binga, Visa, Mastercard, CMI; pos: left"
            ></span>
          </td>
          <td class="labelcart">
            <span v-if="numberload" uk-spinner></span>
            <span v-else>
              {{
                service_cost.toLocaleString('en-US', {
                  style: 'currency',
                  currency: 'MAD',
                })
              }}
            </span>
          </td>
        </tr>

        <tr>
          <td>
            <h4>المجموع:</h4>
          </td>
          <td class="">
            <h4 class="labelcart_green">
              <span v-if="numberload" uk-spinner></span>
              <span v-else>
                {{
                  total.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'MAD',
                  })
                }}
              </span>

              <br />
            </h4>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="">
            <small>السعر شامل الضريبة (TVA)</small>
          </td>
        </tr>
      </tbody>
    </table>
    <br />
    <div>
      <button
        id="btn-submit"
        @click="paynow"
        style="width: 100%; font-size: 20px;"
        class="uk-button uk-button-primary uk-button-large"
        disabled
      >
        اتمام الطلب
      </button>
    </div>
  </div>
</template>

<script>
import json from '../../../database/data.json'

var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',

  // These options are needed to round to whole numbers if that's what you want.
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
})

export default {
  props: ['oid'],

  data() {
    return {
      packs: json._2147845.packs,
      method: false,
      method1: '../../image/icon/logo-wafacash.jpg',
      method3: '../../image/icon/method-de-payment.png',
      method2: '../../image/partners/cfg-logo.svg',
      url_api: window.location.pathname,
      users: [],
      pack_id: '',
      numberload: true,
      coupon: false,
      amount: '0',
      service_cost: 0,
      total: 0,
      infos: [],
      type: ''
    }
  },
  methods: {
    methodChange: function () {
      this.numberload = true
      if (this.method == '1') {
        this.service_cost = (this.amount * 3.5) / 100 + this.service_cost
        this.service_cost = this.service_cost + (this.service_cost*20/100)
        this.total = this.amount + this.service_cost
        this.numberload = false
        $('#btn-submit').removeAttr('disabled')
      } else if (this.method == '2') {
        this.service_cost = 0
        this.total = this.amount
        this.numberload = false
        $('#btn-submit').removeAttr('disabled')
      } else {
        $('#btn-submit').attr('disabled', 'disabled')
      }
    },
    CartUpdate: function(){
       this.numberload = true;
        $('#btn-submit').attr('disabled', 'disabled')
        let data = new FormData()
        data.append('PK_ID', this.pack_id)
        data.append('type', this.type)
        data.append('OID', this.oid)
        axios.post('/api/v1/user/updateCart', data).then((response) => {
            this.loadinfos();
          UIkit.notification({
            message: "تم تحديث الطلب ",
            status: "success",
            pos: "top-center",
            timeout: 5000,
          });
        }).catch((error) => {
            console.log(error);
        });


    },
    loadinfos: function () {
      axios
        .post('/api/v1/user/getCartInfos/' + this.oid + '')
        .then((response) => {
          this.infos = response.data
          this.amount = response.data.product_price
          this.total = this.amount + this.service_cost
          this.pack_id = response.data.pack_id;
          this.type = response.data.type;
          this.numberload = false
          if(this.method != false){
         $('#btn-submit').removeAttr('disabled')

          }
          //document.getElementsByClassName('cartLoad_').style.display = "none";
        })
        .catch((error) => {
          this.loadinfos()
        })
    },

    paynow: function () {
   $('#payment-loading').css('display', 'block')
        $('#btn-submit').attr('disabled', 'disabled')

      let data = new FormData();
      data.append('m' , this.method);
      data.append('OID', this.oid)
      data.append('token', $('meta[name=csrf-token]').attr('content'))
      axios.post('/api/v1/user/PaymentProcessing', data).then((response) => {
          window.location.replace('/recu/'+this.oid);


      }).catch((error) => {
          UIkit.notification({
        message:'حصل خطأ ما يرجى اعادة المحاولة اذا استمر المشكل معك يرجى التواصل معنا عبر support@desky.ma',
        status: "danger",
      });
      })
    },
  },
  created() {
    this.loadinfos()
  },
}
</script>
