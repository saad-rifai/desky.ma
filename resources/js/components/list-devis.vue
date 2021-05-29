<template>
  <div>
    <div id="modal-delete" uk-modal>
      <div dir="rtl" class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">حذف عرض الاسعار #{{ oidclcicked }}</h2>
        <p>هل أنت متأكد بأنك تود حذف عرض الاسعار رقم #{{ oidclcicked }} ؟</p>
        <p class="uk-text-right" dir="ltr">
          <button
            class="uk-button uk-button-default uk-modal-close"
            type="button"
          >
            الغاء
          </button>
          <button
            class="uk-button uk-button-danger uk-modal-close"
            @click="deleteDocumment(oidclcicked)"
            type="button"
          >
            حذف
          </button>
        </p>
      </div>
    </div>
    <div class="uk-grid-large" uk-grid>
      <div class="uk-margin-left uk-width-1-4@m">
        <div class="uk-card uk-card-default uk-card-body">
          <h4 class="uk-card-title uk-text-right">
            <span uk-icon="search"></span>
            البحث
          </h4>
          <hr />
          <div class="uk-margin">
            <label>رقم عرض الأسعار</label>
            <input
              class="uk-input"
              v-model="s_oid"
              type="text"
              @change="searchnow"
              placeholder=""
            />
          </div>
          <div class="uk-margin">
            <label>اسم العميل</label>
            <input
              class="uk-input"
              v-model="s_name"
              type="text"
              @change="searchnow"
              placeholder=""
            />
          </div>
          <div class="uk-margin">
            <label>البريد الالكتروني</label>
            <input
              class="uk-input"
              v-model="s_email"
              type="text"
              @change="searchnow"
              placeholder=""
            />
          </div>

          <br />
        </div>
      </div>
      <div class="uk-width-expand@m uk-card uk-card-default uk-card-body">
        <h2 class="uk-card-title">
          قائمة عروض الأسعار ({{ items }}) - الصفحة ({{ pagenow }}-
          {{ Math.ceil(pages) }})
        </h2>
        <hr />
        <div class="uk-overflow-auto">
          <table class="uk-table uk-table-striped uk-text-right">
            <thead>
              <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الالكتروني</th>
                <th>الحالة</th>
                <th>تاريخ الاضافة</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(val, index) in infos" :key="index">
                <td>{{ val.OID }}</td>
                <td>{{ val.c_name }}</td>
                <td>{{ val.c_email }}</td>
                <td>
                  <span v-if="val.status == 0" class="uk-label">جديد</span>
                  <span v-if="val.status == 1" class="uk-label uk-label-warning"
                    >في انتضار التسليم</span
                  >
                  <span v-if="val.status == 2" class="uk-label uk-label-info"
                    >تم التسليم</span
                  >
                  <span v-if="val.status == 3" class="uk-label uk-label-warning"
                    >في انتضار الدفع</span
                  >
                  <span v-if="val.status == 4" class="uk-label"> تم الدفع</span>
                  <span v-if="val.status == 5" class="uk-label uk-label-success"
                    >مكتمل</span
                  >
                  <span v-if="val.status == 6" class="uk-label uk-label-info"
                    >بدون رد</span
                  >
                  <span v-if="val.status == 7" class="uk-label uk-label-danger"
                    >ملغي
                  </span>
                </td>
                <td>{{ val.created_at }}</td>

                <td>
                  <a href="javascript:void(0)"
                    ><button @click="showdevis(val.OID)" class="act-btn-radio">
                      <i class="fas fa-eye"></i></button
                  ></a>
                  <a href="#modal-delete" uk-toggle @click="removeAct(val.OID)"
                    ><button class="act-btn-radio danger">
                      <i class="fas fa-trash-alt"></i></button
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>
          <div v-if="pages == 0" class="uk-text-center uk-position-center">
            <p class="nodatamessage">
              <i class="fas fa-info-circle"></i>
              لايوجد بيانات لعرضها
            </p>
          </div>
        </div>
        <ul v-if="pages > 1" class="uk-pagination" dir="ltr">
          <li class="uk-margin-auto-right">
            <a v-if="pagenow < pages" @click="nextpage(pagenow)">
              <span class="uk-margin-small-left" uk-pagination-previous></span>
              التالي
            </a>
          </li>

          <li>
            <a v-if="pagenow > pages" @click="previouspage(pagenow)">
              السابق
              <span class="uk-margin-small-left" uk-pagination-next></span>
            </a>
          </li>
        </ul>
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
  props: ["uid", "token_share"],
  data() {
    return {
      errors: new Errors(),
      infos: [],
      s_oid: "",
      s_name: "",
      s_email: "",
      pages: "",
      items: "",
      pagenow: 1,
      oidclcicked: "",
    };
  },
  methods: {
    deleteDocumment: function (e) {
      let data = new FormData();
      data.append("ref", window.location.href);
      data.append("token", $("meta[name=csrf-token]").attr("content"));
      data.append("oid", e);
      data.append("d", "d");
      axios
        .post("../api/v1/deleteDocumment", data)
        .then((response) => {
          UIkit.notification({
            message: "تم حذف عرض الاسعار : " + e + "",
            status: "success",
            pos: "top-center",
            timeout: 5000,
          });
          this.searchnow();
        })
        .catch((error) => {
          UIkit.notification({
            message: "حصل خطأ ما يرجى اعادة المحاولة لاحقاََ رقم الخطأ fx0029",
            status: "danger",
            pos: "top-center",
            timeout: 5000,
          });
        });
    },
    removeAct: function (e) {
      this.oidclcicked = e;
    },
    searchnow: function () {
      $("#form-loading").css("display", "block");
      const config = { apikey: "35O3VOQQJCE947HA55EGCD07VFT32XCPDPMZET5H" };

      ///////////////
      let data = new FormData();

      data.append("s_oid", this.s_oid);
      data.append("s_name", this.s_name);
      data.append("s_email", this.s_email);
      data.append("page", 0);
      data.append("search", true);
      axios
        .post("../../api/list-devis", data, config)
        .then((response) => {
          this.infos = response.data[0].data;
          this.pages = response.data.count / 10;
          this.items = response.data.count;
          this.pagenow = response.data.pagenow;

          $("#form-loading").css("display", "none");
        })
        .catch((error) => {
          this.errors.record(error.response.data);
          this.notificationchek();
          $("#form-loading").css("display", "none");
        });
    },
    showdevis: function (oid) {
      window.location.href = "" + oid + "/" + this.uid;
    },
    previouspage: function (page) {
      $("#form-loading").css("display", "block");

      if (page > 1) {
        var pagenow = page - 1;
        let data = new FormData();

        data.append("s_oid", "" + this.s_oid + "");
        data.append("s_name", "" + this.s_name + "");
        data.append("s_email", "" + this.s_email + "");
        data.append("page", "" + pagenow + "");
        data.append("search", "" + true + "");
        const config = { apikey: "35O3VOQQJCE947HA55EGCD07VFT32XCPDPMZET5H" };

        axios
          .post("../../api/list-devis", data, config)
          .then((response) => {
            this.infos = response.data[0].data;
            this.pages = response.data.count / 10;
            this.items = response.data.count;
            this.pagenow = response.data.pagenow;

            $("#form-loading").css("display", "none");
          })
          .catch((error) => {
            this.errors.record(error.response.data);
            this.notificationchek();
            $("#form-loading").css("display", "none");
          });
      } else {
        $("#form-loading").css("display", "none");
      }
    },
    nextpage: function (page) {
      $("#form-loading").css("display", "block");
      if (page < this.pages) {
        const config = {
          headers: { apikey: "35O3VOQQJCE947HA55EGCD07VFT32XCPDPMZET5H" },
        };

        var pagenow = page + 1;
        let data = new FormData();

        data.append("s_oid", this.s_oid);
        data.append("s_name", this.s_name);
        data.append("s_email", this.s_email);
        data.append("page", pagenow);
        data.append("search", true);

        axios
          .post("../../api/list-devis", data, config)
          .then((response) => {
            this.infos = response.data[0].data;
            this.pages = response.data.count / 10;
            this.items = response.data.count;
            this.pagenow = response.data.pagenow;

            $("#form-loading").css("display", "none");
          })
          .catch((error) => {
            this.errors.record(error.response.data);
            this.notificationchek();
            $("#form-loading").css("display", "none");
          });
      } else {
        $("#form-loading").css("display", "none");
      }
    },

    notificationchek: function () {
      UIkit.notification({
        message: "حصل خطأ ما يرجى اعادة تحميل الصفحة",
        status: "danger",
      });
    },
  },
  mounted() {
    $("#form-loading").css("display", "block");

    ///////////////
    const config = { apikey: "35O3VOQQJCE947HA55EGCD07VFT32XCPDPMZET5H" };

    axios
      .post("../../api/list-devis?apikey")
      .then((response) => {
        this.infos = response.data[0].data;
        this.pages = response.data.count / 10;
        this.items = response.data.count;
        this.pagenow = response.data.pagenow;

        $("#form-loading").css("display", "none");
      })
      .catch((error) => {
        this.errors.record(error.response.data);
        this.notificationchek();
        //location.reload()
        $("#form-loading").css("display", "none");
      });
  },
};
</script>
