<template>
  <div >

    <table class="uk-table  cart-info cart-table-moqawala uk-text-right min-p" dir="rtl">
      <tbody>
        <tr>
          <td><img class="icon-cart-info" src="/image/icon/icons8-lock-64.png" alt=""></td>
          <td class="labelcart">
              <h3 class="text-cart-info">الأمان والسرية</h3>
          </td>
        </tr>
        <tr>
          <td><img class="icon-cart-info" src="/image/icon/icons8-info-64.png" alt=""></td>
          <td class="labelcart">
              <h3 class="text-cart-info">الدعم 24/7</h3>
          </td>
        </tr>
                <tr>
          <td><img class="icon-cart-info" src="/image/icon/icons8-tick-box-64.png" alt=""></td>
          <td class="labelcart">
              <h3 class="text-cart-info">ادائي عالي</h3>
          </td>
        </tr>
      </tbody>
    </table>

  </div>
</template>
<script>
export default {

    props:['oid'],
  data() {
    return {
      url_api_coupons: "../../coupons/api/checker",
      infos: [],
      code_coupon: "",
      coupons_infos: [],
      coupon_cost: "",
      amount: 0,
      type:''
    };
  },

  methods: {
    apply_coupen: function() {
     // this.loadCoupons();
    },
  /*  loadCoupons() {
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
    },*/
    CallCheckout: function(){
this.$refs.componentOne.focus();

    },
    loadinfos: function() {

      axios.post("/api/v1/user/getCartInfos/"+this.oid+"").then((response) => {
        this.infos = response.data;
        this.amount = response.data.product_price;
        if(response.data.type == "y"){
            this.type = 'سنوي';
        }else{
            this.type = 'شهري';

        }
        $("#cartLoad_").css("display", "none");

//document.getElementsByClassName('cartLoad_').style.display = "none";


      }).catch((error) => {
          this.loadinfos();
      });
    },
  },
   created() {
    this.loadinfos();


  },
};
</script>
