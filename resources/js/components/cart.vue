<template>
  <div>
    <table class="uk-table cart-table-moqawala uk-text-right min-p" dir="rtl">
      <tbody>
        <tr>
          <td>الخدمة:</td>
          <td class="labelcart">{{ infos[1] }}</td>
        </tr>
        <tr>
          <td>تكلفة الخدمة:</td>
          <td class="labelcart">
            {{
              infos[0].amount.toLocaleString("en-US", {
                style: "currency",
                currency: "MAD",
              })
            }}
          </td>
        </tr>
        <tr v-if="coupons_infos[0]">
          <td>خصم "{{ coupons_infos[0].name }}" :</td>
          <td class="labelcart_green" dir="rtl">
            -{{ coupons_infos[0].percentage }}%
          </td>
        </tr>
        <tr>
          <td>
            <h4>التكلفة الكلية:</h4>
          </td>
          <td class="">
            <h4 class="labelcart_green">
              <span>{{
                $root.totalprice.toLocaleString("en-US", {
                  style: "currency",
                  currency: "MAD",
                })
              }}</span>

              
              <br />
            </h4>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="">
            <small>السعر شامل الضريبة (TVA) </small>
          </td>
        </tr>
      </tbody>
    </table>
    <div>
      <div class="uk-text-right uk-text-danger" v-if="errors.errors.code">
        {{ errors.get("code") }}
      </div>

      <div class="uk-flex uk-text-center">
        <div class="uk-flex-first">
          <button @click="apply_coupen" class="uk-button uk-button-primary">
            تطبيق
          </button>
        </div>

        <div dir="rtl" class="uk-flex-first" style="width: 100%">
          <input
            v-bind:class="{ 'uk-form-danger': errors.errors.code }"
            class="uk-input"
            v-model="code_coupon"
            type="text"
            placeholder="كوبون التخفيض"
          />
        </div>
      </div>

      <div
        class="uk-text-right uk-text-success"
        dir="rtl"
        v-if="coupons_infos[0]"
      >
        تم تطبيق رمز الكوبون
      </div>
    </div>
  </div>
</template>
<script>
class Errors {
  constructor() {
    this.errors = {};
  }
  get(filed) {
    if (this.errors[filed]) {
      return this.errors[filed][0];
    }
  }
  record(errors) {
    this.errors = errors.errors;
  }
}
export default {
  data() {
    return {
      url_api: window.location.pathname,
      url_api_coupons: "../../coupons/api/checker",
      infos: [],
      code_coupon: "",
      coupons_infos: [],
      coupon_cost: "",
      amount: "",
      errors: new Errors(),
    };
  },
  methods: {
    apply_coupen() {
      this.loadCoupons();
    },
    loadCoupons() {
      let api_key = new FormData();
      api_key.append("api_key", "35O3VOQQJCE947HA55EGCD07VFT32XCPDPMZET5H");
      api_key.append("code", this.code_coupon);
      api_key.append("OID", this.infos[0].OID);
      axios
        .post(this.url_api_coupons, api_key)
        .then((response) => {
          this.errors.errors = "";
          this.coupons_infos = response.data;
          this.coupon_cost =
            (this.infos[0].amount * this.coupons_infos[0].percentage) / 100;
          this.amount = this.infos[0].amount - this.coupon_cost;
          this.$root.coupon_cost = this.coupon_cost;
          this.$root.totalprice = this.infos[0].amount - this.coupon_cost;
        })
        .catch((error) => this.errors.record(error.response.data));
    },
    loadinfos() {
      axios.post(this.url_api + "/api").then((response) => {
        this.infos = response.data;
        this.$root.infos = response.data;
            this.$root.totalprice = this.infos[0].amount;

      });
    },
  },
  mounted() {
    this.loadinfos();
  },
};
</script>
