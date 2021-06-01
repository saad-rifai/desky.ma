<template>
  <div>
    <div id="modal-delete" uk-modal>
      <div dir="rtl" class="uk-modal-dialog uk-modal-body">
        <h3 class="uk-modal-title">حذف فاتورة رقم #{{ oid }}</h3>
        <hr>
        <p>هل أنت متأكد بأنك تود حذف فاتورة رقم #{{ oid }} ؟</p>
        <p class="uk-text-right" dir="ltr">
          <button
            class="uk-button uk-button-default uk-modal-close"
            type="button"
          >
            الغاء
          </button>
          <button
            class="uk-button uk-button-danger"
            @click="deleteDocumment(oid)"
            type="button"
          >
            حذف
          </button>
        </p>
      </div>
    </div>

    <div id="modal-share" uk-modal>
      <div dir="rtl" class="uk-modal-dialog uk-modal-body">
        <h3 class="uk-modal-title">مشاركة عرض الأسعار #{{ oid }}</h3>
        <hr>
        <div v-if="privacy.length > 0 &&  privacy[0].public_facture == 0" class="uk-alert-primary" uk-alert>
          <p >

            انت لم تفعل خيار مشاركة الفواتير لن يتمكن أحد من غيرك مشاهدة الفواتير الخاصة بك من خلال الرابط المباشر
            <br />
            <br />
            ماذا أفعل ؟ يمكنك من خلال حسابي/
            <a href="#" class="uk-link">اعدادات الخصوصية</a> تفعيل خاصية مشاركة
           فاتورة عبر رابط مباشر
          </p>
        </div>
        <div class="uk-margin" v-if="privacy.length > 0 &&  privacy[0].public_facture == 1">
          <a href="javascript:void(0)" @click="whatsapp_share" class="uk-icon-button uk-margin-small-right"><i class="fab fa-whatsapp"></i></a>
          <a :href="'mailto:?subject=عرض أسعار رقم #'+ oid +'&amp;body=مرحبا! هذا الرابط لمعاينة عرض الأسعار الخاص بك <br>' + share_link"  class="uk-icon-button uk-margin-small-right"><i class="fab fa-facebook"></i></a>

        </div>
        <label for="">رابط المشاركة:</label>
        <div class="uk-inline uk-width-1-1">
          <a
            id="ShowPass"
            @click="CopyLink"
            class="uk-form-icon uk-form-icon-flip"
          >
            <i class="fas fa-copy"></i>
          </a>
          <input
            class="uk-input"
            v-model="share_link"
            id="share_lnk"
            type="text"
            placeholder=""
            value=""
            disabled="false"
          />
        </div>
        <p class="uk-text-right" dir="ltr">

          <button
            class="uk-button uk-button-primary uk-modal-close"

            type="button"
          >
            اغلق
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
              <a target="_blank" :href="'../../print/facture/'+oid+'/'+uid"
                ><span uk-icon="icon:  file-pdf"></span> تصدير ملف PDF</a
              >
            </li>
            <li class="uk-active">
              <a href="#"
                ><span uk-icon="icon: link"></span> تحويل الى فاتورة
              </a>
            </li>
            <li class="uk-active">
              <a :href="'/facture/'+oid+'/'+uid+'/edit'"><span uk-icon="icon: file-edit"></span> تعديل</a>
            </li>
            <li class="uk-active">
              <a href="#modal-delete" uk-toggle
                ><span uk-icon="icon: trash"></span> حذف</a
              >
            </li>
          </ul>
        </div>
      </div>
      <div>
        <button
          v-bind:class="{
            'uk-dropdown-menu-primary': infos.status == 0,
            'uk-dropdown-menu-pending': infos.status == 1,
            'uk-dropdown-menu-sample': infos.status == 2 || infos.status == 6,
            'uk-dropdown-menu-white': infos.status == 3,
            'uk-dropdown-menu-orange': infos.status == 4,
            'uk-dropdown-menu-success': infos.status == 5,
            'uk-dropdown-menu-danger': infos.status == 7,
          }"
          type="button"
          dir="rtl"
        >
          {{ status[infos.status] }} <span uk-icon="icon: triangle-down"></span>
        </button>
        <div uk-dropdown="mode: click; pos: bottom-right">
          <ul class="uk-nav uk-dropdown-nav">
            <li
              v-for="(item, index) in status"
              :key="index"
              @click="changeStatus(index)"
              class="uk-active"
            >
              <a href="javascript:void(0)"><span></span> {{ item }}</a>
            </li>
          </ul>
        </div>
      </div>
      <div>
        <button
          class="uk-button btn-share"
          uk-toggle="target: #modal-share" @click="check_privacy"
          type="button"
          dir="rtl"
        >
          <i class="fas fa-share-alt"></i>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import json from "../../../database/data.json";

export default {
  props: ["oid", "resp", "uid"],
  data() {
    return {
      share_link: '',
      status: json.devis_status,
      infos: "",
      privacy: []
    };
  },
  methods: {
    whatsapp_share: function(){
            window.open('https://api.whatsapp.com/send?text' +this.share_link);

    },
    check_privacy: function(){
//api/v1/user/GetUserPrivacy
    $('#form-loading').css('display', 'block')
    axios.post('/api/v1/user/GetUserPrivacy').then((response) => {
      this.privacy = [response.data];

      $('#form-loading').css('display', 'none')

    }).catch((error) => {
   this.check_privacy();
      $('#form-loading').css('display', 'none')

    });

    },
    CopyLink: function (e) {
      let CodeToCopy = document.querySelector("#share_lnk");
      $("#share_lnk").removeAttr("disabled");

      CodeToCopy.select();
      document.execCommand("copy");
      UIkit.notification({
        message: "تم نسخ رابط المشاركة",
        status: "success",
        pos: "top-center",
        timeout: 5000,
      });
      $("#share_lnk").attr("disabled", "disabled");
    },
    deleteDocumment: function (e) {
      let data = new FormData();
      data.append("ref", window.location.href);
      data.append("token", $("meta[name=csrf-token]").attr("content"));
      data.append("oid", this.oid);
      data.append("d", "f");
      axios
        .post("/api/v1/deleteDocumment", data)
        .then((response) => {
          UIkit.notification({
            message: "تم حذف عرض الاسعار : " + this.oid + "",
            status: "success",
            pos: "top-center",
            timeout: 5000,
          });
         window.location.replace('/facture/list');
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
    changeStatus: function (e) {
      let data = new FormData();
      data.append("ref", window.location.href);
      data.append("token", $("meta[name=csrf-token]").attr("content"));
      data.append("oid", this.oid);
      data.append("d", "f");
      data.append("ns", e);
      axios
        .post("/api/v1/UpdateOfDocument/status", data)
        .then((response) => {
          this.infos.status = e;
          UIkit.notification({
            message: "تم تحديث الحالة",
            status: "success",
            pos: "top-center",
            timeout: 5000,
          });
        })
        .catch((error) => {
          UIkit.notification({
            message: error.data.error,
            status: "danger",
            pos: "top-center",
            timeout: 5000,
          });
        });
    },
    getDocumentStatus: function () {
      let data = new FormData();
      data.append("ref", window.location.href);
      data.append("_token", $("meta[name=csrf-token]").attr("content"));
      data.append("oid", this.oid);
      data.append("d", "f");
      axios
        .post("/api/v1/getOfDocument/status", data)
        .then((response) => {
          this.infos = response.data[0];
          this.share_link = window.location.href.replace('facture', 'print/facture')+"/"+this.infos.token_share;
        })
        .catch((error) => {
         this.getDocumentStatus();
        });
    },
  },
  created() {
    this.getDocumentStatus();
  },
};
</script>
