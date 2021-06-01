<template>
  <div>
    <div id="modal-delete" uk-modal>
      <div dir="rtl" class="uk-modal-dialog uk-modal-body">
        <h3 class="uk-modal-title">حذف العميل رقم #{{ cid }}</h3>
        <hr>
        <p>هل أنت متأكد بأنك تود حذف العميل رقم #{{ cid }} ؟</p>
        <p class="uk-text-right" dir="ltr">
          <button
            class="uk-button uk-button-default uk-modal-close"
            type="button"
          >
            الغاء
          </button>
          <button
            class="uk-button uk-button-danger"
            @click="deleteClients(cid)"
            type="button"
          >
            حذف
          </button>
        </p>
      </div>
    </div>


    <div class="uk-flex uk-flex-wrap uk-flex-wrap-around btn-grids uk-padding-small" dir="rtl">
      <div>
        <button class="uk-dropdown-menu-orange" type="button" dir="rtl">
           <span uk-icon="icon: more-vertical"></span>
        </button>
        <div uk-dropdown="mode: click; pos: bottom-right">
          <ul class="uk-nav uk-dropdown-nav">
            <li class="uk-active">
              <a :href="'/clients/'+cid+'/'+uid+'/edit'"><span uk-icon="icon: file-edit"></span> تعديل</a>
            </li>
            <li class="uk-active">
              <a href="#modal-delete" uk-toggle
                ><span uk-icon="icon: trash"></span> حذف</a
              >
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</template>
<script>
import json from "../../../database/data.json";

export default {
  props: ["cid", "uid"],
  data() {
    return {
      status: json.devis_status,
      infos: "",
    };
  },
  methods: {

    deleteClients: function (e) {
      let data = new FormData();
      data.append("ref", window.location.href);
      data.append("token", $("meta[name=csrf-token]").attr("content"));
      data.append("cid", this.cid);
      data.append("d", "c");
      axios
        .post("/api/v1/deleteClients", data)
        .then((response) => {
          UIkit.notification({
            message: "تم  حذف العميل رقم : " + this.oid + "",
            status: "success",
            pos: "top-center",
            timeout: 5000,
          });
         window.location.replace('/clients/list');
        })
        .catch((error) => {
          UIkit.notification({
            message: "حصل خطأ ما يرجى اعادة المحاولة لاحقاََ رقم الخطأ fx0083",
            status: "danger",
            pos: "top-center",
            timeout: 5000,
          });
        });
    }

  }

};
</script>
