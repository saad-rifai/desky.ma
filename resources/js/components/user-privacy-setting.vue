<template>
  <div>
    <div dir="rtl" class="uk-grid-small uk-text-right" uk-grid>
      <div class="uk-width-1-1@s">
        <label for="">
          نشر الحساب في شبكة المقاول الذاتي:

          <label
            style="vertical-align: middle; margin-right: 10px"
            class="switch"
          >
            <input
              @change="savedata"
              v-model="publicProfile"
              type="checkbox"
              id="ch_auto_pay"
              value="true"
            />
            <span class="slider round"></span>
          </label>
        </label>

        <hr class="uk-divider-icon" />
      </div>

      <div class="uk-width-1-1@s">
        <label for="">
          مشاركة عرض الأسعار عبر رابط مباشر:
          <label
            style="vertical-align: middle; margin-right: 10px"
            class="switch"
          >
            <input
              @change="savedata"
              v-model="publicDevis"
              type="checkbox"
              id="ch_auto_pay"
              value="true"
            />
            <span class="slider round"></span>
          </label>
        </label>
        <hr class="uk-divider-icon" />
      </div>
      <div class="uk-width-1-1@s">
        <label for="">
          مشاركة الفاتورة عبر رابط مباشر:
          <label
            style="vertical-align: middle; margin-right: 10px"
            class="switch"
          >
            <input
              @change="savedata"
              v-model="publicFacture"
              type="checkbox"
              id="ch_auto_pay"
              value="true"
            />
            <span class="slider round"></span>
          </label>
        </label>
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
  props: ["user"],
  data() {
    return {
      errors: new Errors(),
      publicProfile: false,
      publicFacture: false,
      publicDevis: false,
      url_api: "http://" + window.location.hostname,
    };
  },
  methods: {
    savedata: function () {
      $("#form-loading").css("display", "block");
      let data = new FormData();
      data.append("pp", this.publicProfile);
      data.append("pd", this.publicDevis);
      data.append("pf", this.publicFacture);
      axios
        .post("/api/v1/user/UpdateUserPrivacy", data)
        .then((response) => {
          $("#form-loading").css("display", "none");
          UIkit.notification({
            message:
            response.data.success,
            status: "success",
            pos: "top-center",
            timeout: 2000,
          });
        })
        .catch((error) => {
          $("#form-loading").css("display", "none");
            UIkit.notification({
            message:
             error.response.data.error,
            status: "danger",
            pos: "top-center",
            timeout: 5000,
          });
        })
        .finally(() => {
          $("#form-loading").css("display", "none");
        });
    },
    getdata: function () {
      $("#form-loading").css("display", "block");

      axios
        .post("/api/v1/user/GetUserPrivacy")
        .then((response) => {
          if (response.data.public_account == 0) {
            this.publicProfile = false;
          } else {
            this.publicProfile = true;
          }
          if (response.data.public_devis == 0) {
            this.publicDevis = false;
          } else {
            this.publicDevis = true;
          }
          if (response.data.public_facture == 0) {
            this.publicFacture = false;
          } else {
            this.publicFacture = true;
          }
          $("#form-loading").css("display", "none");
        })
        .catch((error) => {
          //window.location.reload();
        });
    },
  },
  created() {
    this.getdata();
  },
};
</script>