<template>
  <div>
    <div class="uk-margin" id="checkedsection">
      <label for="">وسيلة الدفع</label>
      <br />
      <div style="margin-top: 10px">
        <label>
          <input
            class="uk-radio"
            type="radio"
            value="method1"
            v-model="method"
            name="radio2"
          />
          الدفع نقدا عبر وكالة wafacach
          <img class="icons-radio" :src="method1" alt="" />
        </label>

        <div v-if="method == 'method1'">
          <br />
          <hr />

          <div uk-alert>يمكنك الدفع بأمان نقداََ عبر شركائنا wafacach</div>
        </div>
      </div>

      <div style="margin-top: 10px">
        <label>
          <input
            class="uk-radio"
            id="bank_radio"
            value="method2"
            v-model="method"
            type="radio"
            name="radio2"
          />
          تحويل بنكي
          <img class="icons-radio po" :src="method2" alt="" />
        </label>

        <div v-if="method == 'method2'">
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
              $root.totalprice.toLocaleString("en-US", {
                style: "currency",
                currency: "MAD",
              })
            }}
          </div>
          <div uk-alert>
            يجب ارسال المبلغ المطلوب الى الحساب وارسال وصل الأداء الى البريد
            الالكتروني التالي: support@moqawala.ma من أجل معالجة طلبكم
          </div>
        </div>
      </div>
           
         <div style="margin-top: 10px">
        <label>
          <input
            class="uk-radio"
            id="bank_radio"
            value="method3"
            v-model="method"
            type="radio"
            name="radio2"
          />
          الدفع بالبطاقة البنكية
          <img class="icons-radio po" :src="method3" alt="" />
        </label>
        <br>
        <br>

        <div v-if="method == 'method3'" class="uk-grid" uk-grid>
          <div class="uk-width-1-1@s">
                    <hr />

          <label for="">معلومات الدفع:</label>
          </div>
  
          <div class="uk-width-1-1@s">
            <label for="">الاسم على البطاقة</label>
            <input class="uk-input" placeholder="Ex: Said Mesrar">
            </div>
          <div class="uk-width-1-2@s">
            <label for="">رقم البطاقة</label>
            <input class="uk-input" placeholder="Ex: 4000000000000002">
            </div>
          <div class="uk-width-1-4@s">
            <label for="">رقم السري (CVV/CVC)</label>
            <input class="uk-input" placeholder="">
            </div>
                    <div class="uk-width-1-4@s ">
            <label for="">تاريخ انتهاء الصلاحية</label>
            <div class="uk-inline uk-flex">
    <input type="text" class="uk-input" data-paylib="expmonth" placeholder="MM" size="2">
    <input type="text" class="uk-input"  data-paylib="expyear" placeholder="YYYY" size="4">
            </div>
            </div>
          <div class="uk-width-1-1@s"> 
            السعر:
            {{
              $root.totalprice.toLocaleString("en-US", {
                style: "currency",
                currency: "MAD",
              })
            }}
          </div>

        </div>
      </div>
    </div>
    <br />
    <div>
      <button
      id="btn-submit"
      @click="paynow"
        style="width: 100%; font-size: 20px"
        class="uk-button uk-button-primary uk-button-large"
        disabled
      >
        اتمام الطلب
      </button>
    </div>
  </div>
</template>

<script>
var formatter = new Intl.NumberFormat("en-US", {
  style: "currency",
  currency: "USD",

  // These options are needed to round to whole numbers if that's what you want.
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

export default {
  data() {
    return {
      method: false,
      method1: "../../image/icon/logo-wafacash.jpg",
      method3: "../../image/icon/method-de-payment.png",
      method2: "../../image/partners/cfg-logo.svg",
      url_api: window.location.pathname,
      users: [],
      coupon: false,
      amount: "",
    };
  },
  methods: {
    loadUsers() {
      axios.post(this.url_api + "/api").then((response) => {
        this.users = response.data;
        this.amountCl();
      });
    },
    amountCl() {
      this.amount = this.users[0].amount - this.$root.coupon_cost;
      $("#btn-submit").removeAttr("disabled");

    },
    paynow(){
      alert('BINGA.MA');
    }
  },
  mounted() {
    this.loadUsers();
  },
};
</script>
