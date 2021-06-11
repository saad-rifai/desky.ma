<template>
  <div>

    <!-- Modal Search NerYou:Saad -->



    <div >

        <h2 class="uk-card-title uk-text-right" dir="rtl">
             ({{items}}) <span uk-icon="history"></span> سجل المدفوعات الصفحة ({{ pagenow }} - {{Math.ceil(pages)}})

        </h2>
        <hr />
        <div class="uk-text-left uk-margin">
            <input type="text" class="uk-input uk-width-1-3@s" @change="searchnow" v-model="s_oid" name="" placeholder="رقم الطلب" id="">
        </div>
        <div class="uk-overflow-auto uk-width-1-1" >
          <table id="tabel-responsive"  class="uk-table uk-table-striped uk-text-right">
            <thead>
              <tr>
                <th>#</th>
                <th>الطلب</th>
                <th>التكلفة</th>
                <th>الحالة</th>
                <th>تاريخ الاضافة</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(val, index) in infos" :key="index">
                <td>{{ val.OID }}</td>
                <td>{{ packs[val.pack_id]['name'] }}</td>
                <td>{{ val.amount }}</td>
                <td>
                  <span v-if="val.status == 0" class="uk-label uk-label-warning">في انتظار الدفع</span>
                  <span v-if="val.status == 1" class="uk-label uk-label-success"
                    >تم الدفع</span
                  >
                  <span v-if="val.status == 2" class="uk-label uk-label-pending"
                    >معلق</span
                  >
                  <span v-if="val.status == 3" class="uk-label uk-label-warning"
                    >معاملة مشكوك فيها</span
                  >
                  <span v-if="val.status == 4" class="uk-label uk-label-danger"> ملغي</span>
                  <span v-if="val.status == 5" class="uk-label uk-label-pending"
                    >قيد المراجعة</span
                  >

                </td>
                <td>{{ val.created_at }}</td>

                <td>
                  <a :href="'/recu/'+val.OID"
                    ><button  class="act-btn-radio">
                      <i class="fas fa-eye"></i></button
                  ></a>

                </td>
              </tr>
              <tr>
                  <td colspan="6">
                                            <div v-if="pages == 0" class="uk-text-center uk-position-center">
            <p class="nodatamessage">
              <i class="fas fa-info-circle"></i>
              لايوجد بيانات لعرضها
            </p>
          </div>
                  </td>
              </tr>
            </tbody>

          </table>

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
</template>
<script>
import json from '/database/data.json'

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
      packs: json['_2147845']['packs'],
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

    removeAct: function (e) {
      this.oidclcicked = e;
    },
    searchnow: function () {
      $("#form-loading").css("display", "block");
      const config = { apikey: "35O3VOQQJCE947HA55EGCD07VFT32XCPDPMZET5H" };

      ///////////////
      let data = new FormData();

      data.append("OID", this.s_oid);
      data.append("page", 0);
      data.append("search", true);
      axios
        .post("/api/list-recu", data, config)
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
      data.append("OID", "" +this.s_oid+ "");
        data.append("page", "" + pagenow + "");
        data.append("search", "" + true + "");
        const config = { apikey: "35O3VOQQJCE947HA55EGCD07VFT32XCPDPMZET5H" };

        axios
          .post("/api/list-recu", data, config)
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

      data.append("OID", this.s_oid);
        data.append("page", pagenow);
        data.append("search", true);

        axios
          .post("/api/list-recu", data, config)
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
      .post("/api/list-recu?apikey")
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
