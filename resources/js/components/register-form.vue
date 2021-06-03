<template>
  <div>
    <form
      dir="rtl"
      @submit.prevent="submitform"
      method="POST"
      class="uk-grid-small"
      uk-grid
    >
      <input type="hidden" name="_token" :value="csrf" />

      <!--input type="hidden" name="ref_alg" value="{{ $_GET['ref'] ?? '' }}" /-->
      <div class="uk-width-1-1@s">
        <label for="">
          نوع الحساب
          <span class="red">*</span>
        </label>
        <br />
        <div class="uk-text-center uk-grid-small" uk-grid>
          <button
            @click="typeaccount(1)"
            id="b1"
            type="button"
            class="uk-button uk-width-1-2@s btn-radio"
          >
            <i class="fas fa-user-tie"></i>
            &nbsp; حساب مقاول ذاتي
          </button>
          <button
            @click="typeaccount(2)"
            id="b2"
            type="button"
            class="uk-button uk-width-1-2@s btn-radio"
          >
            <i class="fas fa-search"></i>
            &nbsp; باحث عن مقاول
          </button>
        </div>
        <input hidden type="radio" value="1" id="typeaccount1" />
        <input hidden type="radio" value="2" id="typeaccount2" />
        <div class="uk-text-danger" v-if="errors.errors.typeaccount">
          {{ errors.get("typeaccount") }}
        </div>
      </div>

      <div class="uk-width-1-2@s">
        <label for="">
          الاسم الأول
          <span class="red">*</span>
        </label>
        <div class="uk-form-controls">
          <input
            class="uk-input"
            type="text"
            v-model="fname"
            placeholder=""
            value=""
            v-bind:class="{ 'uk-form-danger': errors.errors.fname }"
            required
          />
        </div>
        <div class="uk-text-danger" v-if="errors.errors.fname">
          {{ errors.get("fname") }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <label for="">
          الاسم الأخير
          <span class="red">*</span>
        </label>

        <div class="uk-form-controls">
          <input
            class="uk-input"
            v-model="lname"
            type="text"
            placeholder=""
            value=""
            required
            v-bind:class="{ 'uk-form-danger': errors.errors.lname }"
          />
        </div>
        <div class="uk-text-danger" v-if="errors.errors.lname">
          {{ errors.get("lname") }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <label for="">
          البريد الالكتروني
          <span class="red">*</span>
        </label>
        <div class="uk-form-controls">
          <input
            class="uk-input"
            v-model="email"
            type="email"
            name="email"
            placeholder=""
            value=""
            required
            v-bind:class="{ 'uk-form-danger': errors.errors.email }"
          />
        </div>
        <div class="uk-text-danger" v-if="errors.errors.email">
          {{ errors.get("email") }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <label for="">
          رقم الهاتف
          <span class="red">*</span>
        </label>

        <div class="uk-form-controls">
          <input
            class="uk-input"
            v-model="phonenumb"
            type="text"
            placeholder=""
            value=""
            required
            v-bind:class="{ 'uk-form-danger': errors.errors.phonenumb }"
          />
        </div>
        <div class="uk-text-danger" v-if="errors.errors.phonenumb">
          {{ errors.get("phonenumb") }}
        </div>
      </div>

      <div class="uk-width-1-2@s">
        <label for="">الشركة (اختياري)</label>

        <div class="uk-form-controls">
          <input
            class="uk-input"
            type="text"
            v-model="company"
            value=""
            placeholder=""
            v-bind:class="{ 'uk-form-danger': errors.errors.company }"
          />
        </div>
        <div class="uk-text-danger" v-if="errors.errors.company">
          {{ errors.get("company") }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <label for="">
          الدولة
          <span class="red">*</span>
        </label>
        <div class="uk-form-controls">
          <select
            v-model="country"
            class="uk-select"
            id="form-stacked-select"
            required
            v-bind:class="{ 'uk-form-danger': errors.errors.country }"
          >
            <option value="">-- اختيار --</option>
            <optgroup for="" label="المغرب">
              <option value="MA"><strong>المغرب</strong></option>
            </optgroup>
            <option
              v-for="(countrie, index) in countries"
              :key="index"
              :value="countrie.code"
            >
              {{ countrie.name }}
            </option>
          </select>
        </div>
        <div class="uk-text-danger" v-if="errors.errors.country">
          {{ errors.get("country") }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <label for="">
          المدينة
          <span class="red">*</span>
        </label>
        <div class="uk-form-controls">
          <input
            class="uk-input"
            v-model="city"
            type="text"
            placeholder=""
            value=""
            required
            v-bind:class="{ 'uk-form-danger': errors.errors.city }"
          />
        </div>
        <div class="uk-text-danger" v-if="errors.errors.city">
          {{ errors.get("city") }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <label for="">
          كلمة المرور
          <span class="red">*</span>
        </label>
        <br />

        <div class="uk-inline uk-width-1-1">
          <a
            id="ShowPass"
            @click="showpass"
            class="uk-form-icon uk-form-icon-flip"
          >
            <i class="fas fa-eye"></i>
          </a>
          <input
            class="uk-input"
            v-model="password"
            id="pass"
            name="password"
            type="password"
            placeholder=""
            value=""
            required

            v-bind:class="{ 'uk-form-danger': errors.errors.password }"
          />
        </div>

        <br />
        <div  class="uk-text-danger" v-if="errors.errors.password">
          {{ errors.get("password") }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <div class="g-recaptcha" id="recaptcha-main" :data-sitekey="recaptcha"></div>
        <div class="uk-text-danger" v-if="errors.errors.recaptcha_token">
          {{ errors.get("recaptcha_token") }}
        </div>
      </div>
      <div class="uk-width-1-1">
        <label>
          <input class="uk-checkbox" type="checkbox" v-model="terms" required />
          أقر بأني اطلعت وقد وافقت على
          <a href="#">شروط الاستخدام</a>
          و
          <a href="#">سياية الخصوصية</a>
        </label>
        <br />
        <small>
          عند الإشارة إلى حماية البيانات الشخصية. وفقا للقانون 09-08، لديك الحق
          في الوصول، والتصحيح والمعارضة على معالجة بياناتك الشخصية.
        </small>
      </div>
      <div class="uk-width-1-1@s">
        <button type="submit" class="uk-button uk-button-primary">
          انشاء حساب
        </button>
      </div>
      <div class="uk-width-1-1@s uk-text-center">
        <p>
          لديك حساب بالفعل ؟
          <a href="login?ref=false">سجل الدخول</a>
        </p>
      </div>
    </form>
  </div>
</template>
<script>
import json from "../../../database/data.json";
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
$("#ShowPass").click(function () {});
export default {
  props: ["recaptcha", "csrf", "app_url"],

  data() {
    return {
      errors: new Errors(),
      countries: json.countries,
      fname: "",
      lname: "",
      email: "",
      phonenumb: "",
      company: "",
      country: "",
      city: "",
      password: "",
      terms: false,
      typeaccountid: "",
      recaptcha_response: "",
      response: [],
    };
  },
  methods: {
CaptchaCallback: function(){
 this.$nextTick(function () {
    grecaptcha.render('recaptcha-main');
})

    },
    showpass: function () {
      if ("password" == $("#pass").attr("type")) {
        $("#pass").prop("type", "text");
      } else {
        $("#pass").prop("type", "password");
      }
    },
    typeaccount: function (e) {
      if (e == 1) {
        this.typeaccountid = 0;
        $("#b1").css("background-color", "#f78b03");
        $("#b1").css("color", "#fff");
        $("#b2").css("background-color", "#e4e4e4");
        $("#b2").css("color", "#666666");
        $("#typeaccount2").attr("checked", false);
        $("#typeaccount1").attr("checked", true);
      }
      if (e == 2) {
        this.typeaccountid = 1;
        $("#b2").css("background-color", "#f78b03");
        $("#b2").css("color", "#fff");
        $("#b1").css("color", "#666666");
        $("#b1").css("background-color", "#e4e4e4");
        $("#typeaccount1").attr("checked", false);
        $("#typeaccount2").attr("checked", true);
      }
    },
    submitform: function () {
      if (this.terms == true) {
        this.recaptcha_response = document.getElementById(
          "g-recaptcha-response"
        ).value;

        $("#form-loading").css("display", "block");
        let data = new FormData();
        data.append("recaptcha_token", this.recaptcha_response);

        data.append("fname", this.fname);
        data.append("lname", this.lname);
        data.append("email", this.email);
        data.append("phonenumb", this.phonenumb);
        data.append("company", this.company);
        data.append("country", this.country);
        data.append("city", this.city);
        data.append("password", this.password);
        data.append("typeaccount", this.typeaccountid);
        data.append("_token", this.csrf);
        data.append("recaptcha_token", this.recaptcha_response);

        axios
          .post("../auth/register", data)
          .then((response) => {
            $("#form-loading").css("display", "none");
            UIkit.notification({
              message: "تم حفظ البيانات",
              status: "success",
              pos: "top-center",
              timeout: 5000,
            });
            if(response.data.ref == false){
              window.location.replace('http://'+this.app_url+'/setcookie?s_token='+response.data.token)
            }else{
              window.location.replace('http://'+this.app_url+'/setcookie?s_token='+response.data.token+'&ref='+response.data.ref)

            }
          })
          .catch((error) => {
            $("#form-loading").css("display", "none");

            this.errors.record(error.response.data);
            UIkit.notification({
              message:
                "<span uk-icon='icon: warning'></span> يرجى التحقق من المدخلات ",
              status: "danger",
              pos: "top-center",
              timeout: 5000,
            });
            grecaptcha.reset();
             this.CaptchaCallback();
          })
          .finally(() => {
            grecaptcha.reset();
             this.CaptchaCallback();
            $("#form-loading").css("display", "none");
          });
      } else {
        UIkit.notification({
          message:
            "<span uk-icon='icon: warning'></span> يجب الموافقة على شروط الاستخدام وسياسة الخصوصية ",
          status: "danger",
          pos: "top-center",
          timeout: 50000,
        });
      }
    },

  },
  mounted(){

        this.CaptchaCallback();


  }
};
</script>
