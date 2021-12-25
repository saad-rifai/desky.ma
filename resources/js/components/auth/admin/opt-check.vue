<template>
  <div>



    <form @submit.prevent="login">
      <div class="mb-3" id="loadform">
        <label class="form-label">رمز التحقق OTP</label>
        <input
          type="text"
          class="form-control"
          name="otp"
          v-model="otp"
          v-bind:class="{ 'is-invalid': errors.errors.otp }"
        />
        <div class="invalid-feedback" v-if="errors.errors.otp">
          {{ errors.errors.otp[0] }}
        </div>
      </div>



      <div class="mt-5">
        <button
          style="margin-right: 0 !important"
          type="submit"
          class="btn btn-primary w-100"
          id="btn_submit"
        >
        تحقق
        </button>
      </div>
    </form>
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
  props: ["csrf"],

  data() {
    return {
      errors: new Errors(),
      otp: "",
      csrf_token: this.csrf,
      apiresponse: "",
      error401: false,
      PasswordShow: false,
      EMailSent: false,
      email: "",
    
    };
  },
  methods: {
    openLoadingInDiv: function () {
      $("#btn_submit").html(
        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
      );
      this.$vs.loading({
        container: "#loadform",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      $("#btn_submit").html("اعادة التعيين");
      this.$vs.loading.close("#loadform > .con-vs-loading");
    },

    login: function () {
      this.openLoadingInDiv();
      let data = new FormData();
      data.append("username", this.otp);
      data.append("csrf_token", this.csrf_token);
      axios
        .post("/admin/auth/check/otp", data)
        .then((response) => {
          this.errors = new Errors();
          this.$vs.notify({
            text: "تم التحقق بنجاح",
            color: "success",
            icon: "check",
          });
          // window.location.reload();
          this.HideLoadingInDiv();
        })
        .catch((error) => {
          if (error.response.status == 500) {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل التحقق",
              text: "حصل خطأ ما في النظام, يرجى اعادة المحاولة واذا استمر معك الخطأ يرجى التواصل معنا",
              color: "danger",
              icon: "warning",
            });
          } else if (error.response.status == 401) {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل التحقق ",
              text: "رمز OTP خاطئ",
              color: "danger",
              icon: "warning",
            });
          }else if (error.response.status == 403) {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "غير مسموح ",
              text: error.response.data.error,
              color: "danger",
              icon: "warning",
            });
          } 
           else {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل التحقق ",
              text: "يرجى التحقق من المدخلات",
              color: "danger",
              icon: "warning",
            });
          }

          this.HideLoadingInDiv();
        });
    },
  },
};

</script>