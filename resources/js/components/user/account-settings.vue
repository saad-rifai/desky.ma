<template>
  <div>
    <!-- Modal dialog -->
    <div
      class="modal fade"
      dir="rtl"
      id="CeckSubmit"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">تنبيه !</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
          <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
    <p style="font-size:14px">        هل أنت متأكد من أنك تود اجراء تعديل على معلومات حسابك ؟ نظرا لان
            حسابك موثق وفي حال قمت يتعديل معلوماتك سيتعين عليك القيام بطلب جديد
            لتوثيق حسابك</p>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              الغاء
            </button>
            <button type="button" class="btn btn-primary" @click="UpdateAccount" data-dismiss="modal">حفظ التغييرات</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal dialog -->
    <!-- Modal -->
    <!-- Button trigger modal -->
    <div class="centerx">
      <vs-popup
        class="holamundo"
        dir="rtl"
        title="رفع الصورة الشخصية"
        :active.sync="popupActivo"
      >
        <div class="cropper-wrapper-ov">
          <cropper
            class="cropper"
            stencil-component="circle-stencil"
            :src="Uploaded_avatar"
            :debounce="false"
            :stencil-props="{
              aspectRatio: 1,
            }"
            ref="cropper"
            @change="change"
          />
        </div>
        <br />
        <button class="btn btn-primary" @click="AvatarChanged">حفظ</button>
      </vs-popup>
    </div>
    <form @submit.prevent>
      <div id="loadform_2"></div>

      <div class="row row-cols-sm-2">
        <div class="col w-100 mt-3 mb-3">
          <div class="row mr-auto ml-auto">
            <div class="col-auto mx-auto">
              <input
                type="file"
                id="avatar"
                @change="onFileChange"
                accept="image/png, image/jpg, image/jpeg"
                hidden
              />
              <div
                style="width: 100px; height: 100px"
                @click="ChooseAvatar"
                class="avatar-large-box-article position-relative"
              >
                <div class="img-background"></div>
                <div
                  class="
                    image-icon
                    position-absolute
                    top-50
                    start-50
                    translate-middle
                  "
                >
                  <i class="material-icons">camera_alt</i>
                </div>
                <img
                  v-if="
                    (User_avatar != null) &
                    (User_avatar != '') &
                    (User_avatar != '/null')
                  "
                  :src="User_avatar"
                  alt=""
                />
                <img v-else src="/img/icons/avatar.png" alt="" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm w-100">
          <div
            class="alert alert-warning"
            v-if="
              userinfos.verified_account != null &&
              userinfos.verified_account != ''
            "
            role="alert"
          >
            معلومات حسابك موثّقة، إذا قمت بتعديلها ستحتاج إلى إعادة التوثيق مرة
            أخرى.
          </div>
        </div>
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

            <vs-tooltip dir="rtl" text="لايمكنك تغيير البريد الالكتروني">
              <input
                type="email"
                disabled
                class="form-control"
                :value="User__email"
                v-bind:class="{ 'is-invalid': errors.errors.User__email }"
              />
            </vs-tooltip>
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
        <div class="col-sm">
          <div class="mb-3">
            <label class="form-label">تاريخ الازدياد</label>
            <input
              type="date"
              class="form-control"
              v-bind:class="{ 'is-invalid': errors.errors.User__date_of_birth }"
              v-model="User__date_of_birth"
            />

            <div
              class="invalid-feedback"
              v-if="errors.errors.User__date_of_birth"
            >
              {{ errors.errors.User__date_of_birth[0] }}
            </div>
          </div>
        </div>
      </div>

      <div class="mb-3 mt-3">
        <label class="form-label mb-3"> الجنس</label>
        <br />
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            id="gender"
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
        <div
          class="invalid-feedback"
          style="display: block !important"
          v-if="errors.errors.User__gender"
        >
          {{ errors.errors.User__gender[0] }}
        </div>
      </div>

      <div class="mt-5">
        <button
          style="margin-right: 0 !important"
          id="btn_submit_2"
          class="btn btn-primary"
          @click="openAlert"
        >
          حفظ
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
import { Cropper, CircleStencil } from "vue-advanced-cropper";

import ListCities from "../../../../public/data/json/list-moroccan-cities.json";
import 'vue-advanced-cropper/dist/style.css';

export default {
  props: ["userinfos"],
  data() {
    return {
      errors: new Errors(),
      citiesJson: ListCities,
      User__fname: this.userinfos.frist_name,
      stat: this.userinfos.verified_account,
      User__lname: this.userinfos.last_name,
      User__email: this.userinfos.email,
      User__phone: this.userinfos.phone_number,
      User__cities: this.userinfos.city,
      User__gender: this.userinfos.gender,
      User__date_of_birth: this.userinfos.date_of_birth,
      User_avatar: this.userinfos.avatar,
      Uploaded_avatar: "",
      apiresponse: "",
      apierror: "",
      popupActivo: false,
    };
  },
  methods: {
    change({ coordinates, canvas }) {
      console.log(coordinates, canvas);
    },
    openAlert: function () {
      if (this.stat > 0) {
        var myModal = new bootstrap.Modal(
          document.getElementById("CeckSubmit")
        );
        myModal.show();
      } else {
        this.UpdateAccount();
      }
    },
    onFileChange(e) {
      const file = e.target.files[0];
      if (file.size > 1024 * 1024) {
        e.preventDefault();
        this.$vs.notify({
          text: "هذا الملف أكبر من اللازم الحد الأقصى (1 MB)",
          color: "danger",
          position: "top-right",
          icon: "error",
        });
      } else if (
        !file ||
        (file.type != "image/jpg" &&
          file.type != "image/jpeg" &&
          file.type != "image/png")
      ) {
        e.preventDefault();
        this.$vs.notify({
          text: "هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG)",
          color: "danger",
          position: "top-right",
          icon: "error",
        });
      } else {
        this.Uploaded_avatar = URL.createObjectURL(file);

        this.popupActivo = true;
      }
    },
    AvatarChanged: function () {
      this.openLoadingInDiv();

      const { coordinates, canvas } = this.$refs.cropper.getResult();
      const form = new FormData();

      canvas.toBlob((blob) => {
        form.append("avatar", blob);
        // You can use axios, superagent and other libraries instead here

        axios
          .post("/ajax/user/update/avatar", form)
          .then((response) => {
            this.$vs.notify({
              text: response.data.success,
              color: "success",
              position: "top-right",
              icon: "check_box",
            });
            this.User_avatar = canvas.toDataURL();
            this.HideLoadingInDiv();
          })
          .catch((error) => {
            this.errors.record(error.response.data);
            if (error.response.status == 422) {
              this.$vs.notify({
                text: this.errors.errors.avatar[0],
                color: "danger",
                position: "top-right",
                icon: "error",
              });
              this.HideLoadingInDiv();
            } else {
              this.$vs.notify({
                text: "فشل تحديث الصورة الشخصية يرجى اعادة المحاولة fx0500124",
                color: "danger",
                position: "top-right",
                icon: "error",
              });
              this.HideLoadingInDiv();
            }
          });
      }, "image/jpeg");
      this.popupActivo = false;
    },
    ChooseAvatar: function () {
      $("#avatar").click();
    },

    openLoadingInDiv: function () {
      $("#btn_submit_2").html(
        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
      );
      this.$vs.loading({
        container: "#loadform_2",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      $("#btn_submit_2").html("حفظ");
      this.$vs.loading.close("#loadform_2 > .con-vs-loading");
    },
    UpdateAccount: function () {
      this.openLoadingInDiv();
      let data = new FormData();
      data.append("User__fname", this.User__fname);
      data.append("User__lname", this.User__lname);
      //data.append("User__email", this.User__email);
      data.append("User__phone", this.User__phone);
      data.append("User__cities", this.User__cities);
      data.append("User__gender", this.User__gender);

      data.append("User__date_of_birth", this.User__date_of_birth);

      axios
        .post("/ajax/user/update/account", data)
        .then((response) => {
          this.errors = new Errors();
          this.$vs.notify({
            text: "تم الحفظ بنجاح !",
            color: "success",
            position: "top-right",
            icon: "check",
          });
          this.HideLoadingInDiv();
        })
        .catch((error) => {
          this.errors.record(error.response.data);
          if (error.response.status == 500) {
            this.$vs.notify({
              text: "حصل خطأ ما اثناء محاولة حفظ البيانات يرجى اعادة المحاولة",
              color: "danger",
              position: "top-right",
              icon: "warning",
            });
          } else {
            this.$vs.notify({
              title: "فشل حفظ البيانات",
              text: "يرجى التحقق من المدخلات",
              color: "danger",
              position: "top-right",
              icon: "warning",
            });
          }

          this.HideLoadingInDiv();
        });
    },
  },
  components: { Cropper, CircleStencil },
};
</script>