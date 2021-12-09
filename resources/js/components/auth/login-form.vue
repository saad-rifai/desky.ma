<template>
  <div>
    <form @submit.prevent="login">
      <div class="mb-3" id="loadform">
        <label class="form-label">البريد الالكتروني</label>
        <input
          type="text"
          class="form-control"
          name="username"
          v-model="email"
          v-bind:class="{ 'is-invalid': errors.errors.email }"
        />
<div class="invalid-feedback" v-if="errors.errors.email">
{{errors.errors.email[0]}}
</div>
      </div>
      <div class="mb-3">
        <label class="form-label">كلمة السر</label>

        <div class="position-relative">
        <input
          type="password"
          class="form-control"
          name="password"
          id="password"
          v-model="password"
          v-bind:class="{ 'is-invalid': errors.errors.password }"
        />
        <span class="icon-input-btn" @click="PasswordShowFn"> <i class="far fa-eye"></i> </span>
        </div>
        <div class="invalid-feedback" style="display:block !important" v-if="errors.errors.password">
{{errors.errors.password[0]}}
</div>
        <a href="/reset" class="fg-pass font-Naskh">نسيت كلمة السر</a>
      </div>
      <!--div class="mb-3 mt-5 position-relative">
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
      </div-->
      <div class="mb-3">
        <div class="form-check">
          <input
            class="form-check-input"
            type="checkbox"
            v-model="remember"
            id="flexCheckDefault"
          />
          <label class="form-check-label font-Naskh" for="flexCheckDefault">
            تذكرني
          </label>
        </div>
      </div>
      <div class="mt-5">
        <button
          style="margin-right: 0 !important"
          type="submit"
          class="btn btn-primary w-100"
          id="btn_submit"
        >
          الدخول
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
      email: "",
      password: "",
      remember: "",
      csrf_token: this.csrf,
      apiresponse: "",
      error401: false,
      PasswordShow: false,
    };
  },
  methods: {
    PasswordShowFn: function(){
      if(this.PasswordShow == true){
        this.PasswordShow = false;
        $('.icon-input-btn').html('<i class="far fa-eye" ></i>');
        $('#password').prop('type', 'password');

      }else{
        this.PasswordShow = true;
        $('.icon-input-btn').html('<i class="far fa-eye-slash"></i>');
        $('#password').prop('type', 'text');

      }
    },
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
      $("#btn_submit").html("التسجيل");
      this.$vs.loading.close("#loadform > .con-vs-loading");
    },

    login: function () {
      this.openLoadingInDiv();
      let data = new FormData();
      data.append("email", this.email);
      data.append("password", this.password);
      data.append("remember", this.remember);
      data.append("csrf_token", this.csrf_token);
     // data.append("g_recaptcha_response", $("#g-recaptcha-response").val());
      axios
        .post("ajax/login/user", data)
        .then((response) => {
          this.errors = new Errors();
          this.apiresponse = response;
          this.$vs.notify({
            title: "تم تسجيل الدخول بنجاح !",
            text: "تم تسجيل الدخول الى حسابك بنجاح سيتم تحويلك الأن",
            color: "success",
            fixed: true,
            icon: "check",
          });
           window.location.reload();
 
          this.HideLoadingInDiv();
        })
        .catch((error) => {
          if (error.response.status == 500) {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل تسجيل الدخول",
              text: "حصل خطأ في النظام أثناء محاولة تسجيل الدخول الى حسابك يرجى اعادة المحاولة واذا استمر معك الخطأ يرجى التواصل معنا",
              color: "danger",
              fixed: true,
              icon: "warning",
            });
          } else if(error.response.status == 401) {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل تسجيل الدخول ",
              text: "البريد الالكتروني أو كلمة السر التي أدخلت غير متطابقة",
              color: "danger",
              fixed: true,
              icon: "warning",
            });
          }else{
          this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل تسجيل الدخول ",
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