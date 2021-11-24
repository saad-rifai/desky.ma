<template>
  <div>
    <div id="load124" class="vs-con-loading__container">
      <div class="mb-3">
        <label for="description" class="form-label">وصف العرض</label>
        <textarea
          class="form-control"
          v-model="description"
          id="description"
          rows="5"
          v-bind:class="{ 'is-invalid': errors.errors.description }"

        ></textarea>
        <div class="invalid-feedback" v-if="errors.errors.description">
              {{ errors.errors.description[0] }}
        </div>
        <div class="form-text">صف عرضك بشكل مفصل ووضح مالذي ستقدمه بالظبط</div>
      </div>
      <div class="row">
        <div class="col-sm">
          <div class="mb-3">
            <label for="price" class="form-label">التكلفة</label>
            <div class="input-group">
              <div class="input-group-text">MAD</div>
              <input
                type="number"
                v-model="price"
                class="form-control"
                id="price"
                dir="ltr"
                v-bind:class="{ 'is-invalid': errors.errors.price }"
                
              />
            </div>
          <div class="invalid-feedback" style="display:block!important" v-if="errors.errors.price">
              {{ errors.errors.price[0] }}
        </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="mb-3">
            <label for="time" class="form-label">مدة التنفيذ</label>
            <div class="input-group">
              <div class="input-group-text">
                <i class="fas fa-stopwatch"></i>
              </div>
              <input
                type="number"
                v-model="time"
                class="form-control"
                id="time"
                dir="ltr"
                v-bind:class="{ 'is-invalid': errors.errors.time }"

              />
            </div>
          <div class="invalid-feedback" style="display:block!important" v-if="errors.errors.time">
              {{ errors.errors.time[0] }}
        </div>
          </div>
        </div>
      </div>
      <div class="mb-3 mt-3">
        <ul class="small-list-info">
          <li>لا تضع روابط خارجية، قم بالاهتمام بمعرض أعمالك بدلا منها</li>
          <li>لا تستخدم وسائل تواصل خارجية</li>
          <li><a href="#">اقرا هنا كيف تضيف عرضا مميزا على أي طلب</a></li>
        </ul>
      </div>
      <div class="mt-3">
        <button
          style="margin-right: 0 !important"
          type="button"
          class="btn btn-primary"
          id="btnload124"
          @click="SubmitOffer"
        >
          اضافة العرض
        </button>
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
  props:['oid'],
  data() {
    return {
      errors: new Errors(),
      description: "",
      time: "",
      price: "",
    };
  },
  methods: {
    openLoadingInDiv: function () {
      $("#btnload124").html(
        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
      );
      this.$vs.loading({
        container: "#load124",
        type: "point",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      $("#btnload124").html("اضافة العرض");
      this.$vs.loading.close("#load124 > .con-vs-loading");
    },

    SubmitOffer() {
      this.openLoadingInDiv();
      /* Set Data */
      let data = new FormData();
      data.append("description", this.description);
      data.append("price", this.price);
      data.append("time", this.time);
      data.append("OID", this.oid);
      /*Send Data To Server */

      axios
        .post("/ajax/user/offer/create", data)
        .then((response) => {
          this.RequestStatus = true;
          this.HideLoadingInDiv();
          this.errors = new Errors();
          this.$vs.notify({
            text: "تم اضافة عرضك بنجاح !",
            color: "success",
            position: "top-right",
            icon: "check",
          });
          window.location.replace("/order/"+this.oid+"?offer="+response.data.offer_id);
        })
        .catch((error) => {
          this.HideLoadingInDiv();
          this.errors.record(error.response.data);
          if (error.response.status == 422) {
            this.$vs.notify({
              title: "هناك خطأ ما !",
              text: "يرجى التحقق من مدخلاتك",
              color: "danger",
              position: "top-right",
              icon: "warning",
            });
          } else if (error.response.status == 400) {
            this.errors = new Errors();

            this.$vs.notify({
              title: "هناك خطأ ما !",
              text: error.response.data.error,
              color: "danger",
              position: "top-right",
              fixed: true,
              icon: "warning",
            });
          } else if (error.response.status == 401) {
            this.errors = new Errors();

            this.$vs.notify({
              text: "انتهت الجلسة",
              color: "danger",
              position: "top-right",
              fixed: true,
              icon: "warning",
            });
            window.location.reload();
          } else {
            this.errors = new Errors();

            this.$vs.notify({
              title: "هناك خطأ ما !",
              text: "حصل خطأ ما أثناء محاولة ارسال طلبك يرجى اعادة المحاولة, اذا استمر معك المشكل يرجى التواصل معنا",
              color: "danger",
              position: "top-right",
              fixed: true,
              icon: "warning",
            });
          }
        });
      /*  Send Data To Server */
    },
  },
};
</script>