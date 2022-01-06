<template>
  <div>
    <form class="mt-3" @submit.prevent="UpdateProfile">
        <div id="loadform"></div>
      <div class="mb-3">
        <label class="form-label">نوع الحساب</label>
        <br />
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            checked
            type="radio"
            name="type"
            id="type2"
            value="2"
            v-model="type"
            v-bind:class="{ 'is-invalid': errors.errors.type }"
          />
          <label class="form-check-label" for="type2">حساب العميل</label>
        </div>
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            name="type"
            id="type1"
            value="1"
            v-model="type"
            v-bind:class="{ 'is-invalid': errors.errors.type }"
          />
          <label class="form-check-label" for="type1"
            >حساب المقاول الذاتي</label
          >
        </div>
        <div class="invalid-feedback" style="display:block!important;" v-if="errors.errors.type">
          {{ errors.errors.type[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">اسم المستخدم</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1">@</span>
          <input
            type="text"
            id="username"
            name="username"
            class="form-control"
            v-model="username"
            v-bind:class="{ 'is-invalid': errors.errors.username }"

          />
        <div class="invalid-feedback" v-if="errors.errors.username">
          {{ errors.errors.username[0] }}
        </div>
        </div>

        <div class="form-text">
          يجب أن يكون اسم المستخدم فريدا ومكونا من الأرقام والحروف فقط
        </div>

      </div>
      <div class="mb-3">
        <label for="description" class="form-label">النبذة التعريفية</label>
        <textarea
          class="form-control"
          id="description"
          rows="4"
          v-model="description"
            v-bind:class="{ 'is-invalid': errors.errors.description }"
        ></textarea>
        <div class="invalid-feedback" v-if="errors.errors.description">
          {{ errors.errors.description[0] }}
        </div>
      </div>
      <div class="mt-5">
        <button
          style="margin-right: 0 !important"
          id="btn_submit"
          type="submit"
          class="btn btn-primary"
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
export default {
  props: ["userinfos"],
  data() {
    return {
      errors: new Errors(),

      username: this.userinfos.username,
      description: this.userinfos.description,
      type: this.userinfos.type,
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
      $("#btn_submit").html("حفظ");
      this.$vs.loading.close("#loadform > .con-vs-loading");
    },
    UpdateProfile: function () {
      this.openLoadingInDiv();
      let data = new FormData();
      data.append("username", this.username.toLowerCase());
      data.append("type", this.type);
      if (this.description == null) {
        data.append("description", "");
      } else {
        data.append("description", this.description);
      }
      data.append("type", this.type);
      axios
        .post("/ajax/user/update/profile", data)
        .then((response) => {
          this.errors = new Errors();
          this.apiresponse = response;
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
            this.HideLoadingInDiv();
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
};
</script>