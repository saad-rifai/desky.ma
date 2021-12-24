<template>
  <div>
<div v-if="EMailSent" dir="rtl" class="alert alert-success" role="alert">
    تم ارسالة رسالة اعادة تعيين كلمة المرور الى بريدك الالكتروني <span dir="ltr">{{email}}</span>، يرجى اتباع التعليمات لاستعادة كلمة المرور الخاصة بك.
</div>


    <form v-else @submit.prevent="login">
      <div class="mb-3" id="loadform">
        <label class="form-label">البريد الالكتروني أو الاسم المستخدم</label>
        <input
          type="text"
          class="form-control"
          name="username"
          v-model="username"
          v-bind:class="{ 'is-invalid': errors.errors.username }"
        />
        <div class="invalid-feedback" v-if="errors.errors.username">
          {{ errors.errors.username[0] }}
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
          class="btn btn-primary w-100"
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
  props: ["csrf"],

  data() {
    return {
      errors: new Errors(),
      username: "",
      csrf_token: this.csrf,
      apiresponse: "",
      error401: false,
      PasswordShow: false,
      EMailSent: false,
      email: ""
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
      data.append("username", this.username);
      data.append("csrf_token", this.csrf_token);
      data.append("g_recaptcha_response", $("#g-recaptcha-response").val());
      axios
        .post("ajax/reset/user/password", data)
        .then((response) => {
          this.errors = new Errors();
          this.apiresponse = response;
          this.email = response.data.email;
          this.EMailSent = true;
          this.$vs.notify({
            title: "تم الارسال",
            text: "تم ارسال رسالة اعادة تعيين كلمة المرور الى بريدك الالكتروني ",
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
          } else if (error.response.status == 401) {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل التحقق ",
              text: "البريد الالكتروني أو اسم المستخدم غير متطابق",
              color: "danger",
              fixed: true,
              icon: "warning",
            });
          }else if (error.response.status == 403) {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "غير مسموح ",
              text: "لقد تجاوزت الحد المسموح به لاعادة تعيين كلمة المرور يرجى المحاولة لاحقا بعد 3 ساعات",
              color: "danger",
              fixed: true,
              icon: "warning",
            });
          } 
           else {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل التحقق ",
              text: "يرجى التحقق من المدخلات",
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