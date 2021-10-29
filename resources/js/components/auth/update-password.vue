<template>
  <div>
<div v-if="EMailSent" dir="rtl" class="alert alert-success" role="alert">
      <h4 class="alert-heading">تم تغيير كلمة المرور</h4>
<p>
    تمت اعادة تعيين كلمة المرور الخاصة بك بنجاح, بامكانك الأن تسحيل الدخول الى حسابك.
    </p>

  <hr>
  <a href="/login"><button type="button" class="btn btn-success">الدخول</button></a>

</div>



    <form v-else @submit.prevent="login">
      <div class="mb-3" id="loadform">
        <label class="form-label">كلمة المرور الجديدة </label>
        <input
          type="password"
          class="form-control"
          name="password"
          v-model="password"
          v-bind:class="{ 'is-invalid': errors.errors.password }"
        />
        <div class="invalid-feedback" v-if="errors.errors.password">
          {{ errors.errors.password[0] }}
        </div>
      </div>
      <div class="mb-3" id="loadform">
        <label class="form-label">تأكيد كلمة المرور الجديدة </label>
        <input
          type="password"
          class="form-control"
          name="password_confirmation"
          v-model="password_confirmation"
          v-bind:class="{ 'is-invalid': errors.errors.password_confirmation }"
        />
        <div class="invalid-feedback" v-if="errors.errors.password_confirmation">
          {{ errors.errors.password_confirmation[0] }}
        </div>
      </div>
      <div class="mb-3 mt-5 position-relative">
        <vue-recaptcha
          sitekey="6Lcs2N4cAAAAAK7Du9RE38xp5_h3Qos_sQJzwnMd"
          :loadRecaptchaScript="true"
        ></vue-recaptcha>
        <div
          class="invalid-feedback"
          style="display: block !important"
          v-if="errors.errors.g_recaptcha_response"
        >
          {{ errors.errors.g_recaptcha_response[0] }}
        </div>
      </div>

      <div class="mt-5">
        <button
          style="margin-right: 0 !important"
          type="submit"
          class="btn btn-primary"
          id="btn_submit"
        >
          اعادة تعيين
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
import VueRecaptcha from "vue-recaptcha";

export default {
  props: ["csrf", "hashtoken"],

  data() {
    return {
      errors: new Errors(),
      password: "",
      password_confirmation: "",
      csrf_token: this.csrf,
      hashToken: this.hashtoken,
      apiresponse: "",
      error401: false,
      EMailSent: false,
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
      data.append("password", this.password);
      data.append("password_confirmation", this.password_confirmation);
      data.append("csrf_token", this.csrf_token);
      data.append("hashToken", this.hashToken);
      data.append("g_recaptcha_response", $("#g-recaptcha-response").val());
      axios
        .post("/ajax/ResetPassword/reset", data)
        .then((response) => {
          this.errors = new Errors();
          this.apiresponse = response;
          this.email = response.data.email;
          this.EMailSent = true;
          this.$vs.notify({
            title: "تمت العملية بنجاح",
            text: "تم اعادة تعيين كلمة المرور الخاصة بك بنجاح, يمكنك الدخول الى حسابك الأن ",
            color: "success",
            fixed: true,
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
              fixed: true,
              icon: "warning",
            });
          }else if (error.response.status == 403) {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "غير مسموح ",
              text: "لقد انتهت صلاحية هذا الرابط, يرجى اعادة طلب تغيير كلمة المرور من جديد.",
              color: "danger",
              fixed: true,
              icon: "warning",
            });
          } 
           else {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل التحقق ",
              text: "يرجى اعادة تحميل الصفحة",
              color: "danger",
              fixed: true,
              icon: "warning",
            });
          }

          this.HideLoadingInDiv();
          window.grecaptcha.reset();
        });
    },
  },
  components: { VueRecaptcha },
};
</script>