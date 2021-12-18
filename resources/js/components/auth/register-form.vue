<template>
  <div>
    <form @submit.prevent="register">
      <div class="row row-cols-sm-2" id="loadform">
        <div class="col-sm">
          <div class="mb-3">
            <label class="form-label">الاسم الشخصي</label>
            <input
              type="text"
              class="form-control"
              v-model="User__fname"
              v-bind:class="{ 'is-invalid': errors.errors.User__fname }"
            />
            <div class="invalid-feedback" v-if="errors.errors.User__fname">
              {{ errors.errors.User__fname[0] }}
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="mb-3">
            <label class="form-label">الاسم العائلي</label>
            <input
              type="text"
              class="form-control"
              v-model="User__lname"
              v-bind:class="{ 'is-invalid': errors.errors.User__lname }"
            />
            <div class="invalid-feedback" v-if="errors.errors.User__lname">
              {{ errors.errors.User__lname[0] }}
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="mb-3">
            <label class="form-label">البريد الالكتروني</label>
            <input
              type="email"
              class="form-control"
              v-model="User__email"
              v-bind:class="{ 'is-invalid': errors.errors.User__email }"
            />
            <div class="invalid-feedback" v-if="errors.errors.User__email">
              {{ errors.errors.User__email[0] }}
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input
              type="tel"
              class="form-control"
              v-bind:class="{ 'is-invalid': errors.errors.User__phone }"
              id="numberphone"
              pattern="\d{10}"
              title="Please enter exactly 10 digits"
              maxlength="10"
              dir="ltr"
              v-model="User__phone"
            />
            <div class="invalid-feedback" v-if="errors.errors.User__phone">
              {{ errors.errors.User__phone[0] }}
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="mb-3">
            <label class="form-label">الدولة</label>
            <vs-tooltip dir="rtl" text="منصة deksy متوفرة حاليا فقط في المغرب">
              <select disabled class="form-select" name="state">
                <option value="MA" selected>المغرب</option>
              </select>
            </vs-tooltip>
          </div>
        </div>
        <div class="col-sm">
          <div class="mb-3">
            <label class="form-label">المدينة</label>

            <vs-select
              width="100%"
              autocomplete
              class="selectExample"
              v-model="User__cities"
              v-bind:class="{ 'is-invalid': errors.errors.User__cities }"
            >
              <vs-select-item
                :key="index"
                :value="item.id"
                :text="item.ville"
                v-for="(item, index) in citiesJson"
              />
            </vs-select>

            <div class="invalid-feedback" v-if="errors.errors.User__cities">
              {{ errors.errors.User__cities[0] }}
            </div>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label"> كلمة السر</label>
        <div class="position-relative">
          <input
            type="password"
            v-bind:class="{ 'is-invalid': errors.errors.User__password }"
            v-model="User__password"
            class="form-control"
            name="password"
            placeholder=""
            id="password"
          />
          <span class="icon-input-btn" @click="PasswordShowFn">
            <i class="far fa-eye"></i>
          </span>
        </div>
        <div class="invalid-feedback" v-if="errors.errors.User__password">
          {{ errors.errors.User__password[0] }}
        </div>
      </div>
      <div class="mb-3 mt-3">
        <label class="form-label mb-3"> الجنس</label>
        <br />
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            id="gender1"
            type="radio"
            name="gender1"
            v-bind:class="{ 'is-invalid': errors.errors.User__gender }"
            v-model="User__gender"
            value="1"
          />
          <label
            class="form-check-label"
            v-bind:class="{ 'is-invalid': errors.errors.User__gender }"
            for="gender1"
            >ذكر</label
          >
        </div>
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            name="gender"
            id="gender2"
            v-bind:class="{ 'is-invalid': errors.errors.User__gender }"
            v-model="User__gender"
            value="2"
          />
          <label
            class="form-check-label"
            v-bind:class="{ 'is-invalid': errors.errors.User__gender }"
            for="gender2"
            >انثى</label
          >
        </div>
        <div class="invalid-feedback" v-if="errors.errors.User__gender">
          {{ errors.errors.User__gender[0] }}
        </div>
      </div>
      <div class="mb-5 mt-3">
        <label
          class="form-label mb-3"
          v-bind:class="{ 'is-invalid': errors.errors.User__type }"
        >
          هل انت مقاول ذاتي ؟</label
        >
        <br />
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            name="type"
            id="type1"
            v-model="User__type"
            value="1"
            v-bind:class="{ 'is-invalid': errors.errors.User__type }"
          />
          <label
            class="form-check-label"
            for="type1"
            v-bind:class="{ 'is-invalid': errors.errors.User__type }"
            >نعم</label
          >
        </div>
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            name="type"
            id="type2"
            v-bind:class="{ 'is-invalid': errors.errors.User__type }"
            v-model="User__type"
            value="2"
          />
          <label
            class="form-check-label"
            for="type2"
            v-bind:class="{ 'is-invalid': errors.errors.User__type }"
            >لا</label
          >
        </div>
        <div class="invalid-feedback" v-if="errors.errors.User__type">
          {{ errors.errors.User__type[0] }}
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

      <div class="mb-3 mt-5 position-relative">
        <div class="form-check">
          <input
            class="form-check-input"
            type="checkbox"
            value="true"
            v-bind:class="{ 'is-invalid': errors.errors.terms }"
            v-model="terms"
            id="terms"
          />
          <label class="form-check-label terms-text font-Naskh" for="terms">
            لقد قرأت <a href="#">شروط الاستخدام</a> و
            <a href="#">سياسة الخصوصية</a> وأوافق عليها
            <br>
            عند الإشارة إلى حماية البيانات الشخصية. وفقا للقانون 09-08، لديك الحق في الوصول، والتصحيح والمعارضة على معالجة بياناتك الشخصية.


          </label>
          <br />
          <div
            class="invalid-feedback mt-2"
            style="display: block !important"
            v-if="errors.errors.terms"
          >
            {{ errors.errors.terms[0] }}
          </div>
        </div>
      </div>
      <div class="mt-5">
        <button
          style="margin-right: 0 !important"
          id="btn_submit"
          type="submit"
          class="btn btn-primary w-100"
        >
          انشاء حساب
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

import ListCities from "../../../../public/data/json/list-moroccan-cities.json";
export default {
  data() {
    return {
      errors: new Errors(),
      citiesJson: ListCities,
      User__fname: "",
      User__lname: "",
      User__email: "",
      User__phone: "",
      User__cities: "",
      User__gender: "",
      User__type: "",
      User__password: "",
      terms: false,
      apiresponse: "",
      apierror: "",
      PasswordShow: false,
    };
  },
  methods: {
    PasswordShowFn: function () {
      if (this.PasswordShow == true) {
        this.PasswordShow = false;
        $(".icon-input-btn").html('<i class="far fa-eye" ></i>');
        $("#password").prop("type", "password");
      } else {
        this.PasswordShow = true;
        $(".icon-input-btn").html('<i class="far fa-eye-slash"></i>');
        $("#password").prop("type", "text");
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
    register: function () {
      this.openLoadingInDiv();
      let data = new FormData();
      data.append("User__fname", this.User__fname);
      data.append("User__lname", this.User__lname);
      data.append("User__email", this.User__email);
      data.append("User__phone", this.User__phone);
      data.append("User__cities", this.User__cities);
      data.append("User__gender", this.User__gender);
      data.append("User__type", this.User__type);
      data.append("User__password", this.User__password);
      data.append("terms", this.terms);
      data.append("g_recaptcha_response", $("#g-recaptcha-response").val());
      axios
        .post("ajax/new/user", data)
        .then((response) => {
          this.errors = new Errors();
          this.apiresponse = response.headers;
          this.$vs.notify({
            title: "تم انشاء حسابك !",
            text: "تم انشاء حسابك بنجاح سيتم تحويلك الأن",
            color: "success",
            fixed: true,
            icon: "check",
          });
        window.location.replace("/login?s_token="+this.apiresponse.s_token);
     //  window.location.reload();
          this.HideLoadingInDiv();
        })
        .catch((error) => {
          if (error.response.status == 500) {
            this.$vs.notify({
              title: "فشل انشاء الحساب ",
              text: "حصل خطأ في النظام أثناء محاولة انشاء الحساب يرجى اعادة المحاولة واذا استمر معك الخطأ يرجى التواصل معنا",
              color: "danger",
              icon: "warning",
            });
          } else {
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "فشل انشاء الحساب ",
              text: "يرجى التحقق من المدخلات",
              color: "danger",
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