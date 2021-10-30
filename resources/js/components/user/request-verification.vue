<template>
  <div>
    <form class="mt-3" @submit.prevent>
      <div id="loadform"></div>

      <div class="mb-3">
        <label for="username" class="form-label">نوع وثيقة التعريف</label>
        <select
          @change="file_type_change"
          name="file_type"
          v-model="file_type"
          id="file_type"
          class="form-select"
          v-bind:class="{ 'is-invalid': errors.errors.document_type }"
        >
          <option value="">اختيار</option>
          <option value="1">بطاقة الهوية</option>
          <option value="2">جواز السفر</option>
          <option value="3">بطاقة الاقامة</option>
        </select>
        <div class="invalid-feedback" v-if="errors.errors.document_type">
          {{ errors.errors.document_type[0] }}
        </div>
      </div>
      <div class="mb-3" v-if="file_type_name != '' && file_type_name != null">
        <label for="document_id" class="form-label"
          >رقم {{ file_type_name }}</label
        >
        <input
          type="text"
          class="form-control"
          id="document_id"
          v-model="document_id"
          v-bind:class="{ 'is-invalid': errors.errors.document_id }"
        />
        <div class="invalid-feedback" v-if="errors.errors.document_id">
          {{ errors.errors.document_id[0] }}
        </div>
      </div>

      <div class="col w-100">
        <div
          class="mb-3"
          v-bind:hidden="file_type_name == '' || file_type_name == null"
        >
          <label for="time" class="form-label"> ملفات توضيحية</label>
          <div
            class="alert alert-danger"
            id="form_upload_error"
            hidden
            role="alert"
          ></div>
          <div
            id="upload-files-form"
            class="upload-files-form"
            data-target="files-include"
            data-types="['png','jpg']"
          >
            <input
              type="file"
              id="files-include"
              @change="files_selected"
              name="files[]"
              multiple
              hidden
            />
            <div class="upload-files-form-content">
              <span class="icon-upload-file"
                ><img src="/img/icons/upload.png" alt=""
              /></span>
              <span class="title-upload-file">اسحب الملفات الى هنا</span>
              <br />

              <span class="text-upload-file">أو انقر للاختيار يدويا</span>
            </div>
          </div>
          <div
            v-for="(item, index) in filesSelected"
            :key="index"
            class="show-files-border mt-5 mb-5 position-relative"
          >
            <div class="show_files_content mb-5">
              <div class="row position-relative">
                <span
                  v-if="item[1] > 0"
                  class="badge bg-success position-absolute bottom-0 end-0"
                  style="margin-left: 15px; width: initial !important"
                  >{{ status[item[1]] }}</span
                >

                <div class="col-auto">
                  <div class="img_file_type">
                    <img :src="fileicon(item[0].type)" alt="" />
                  </div>
                </div>
                <div class="col-auto position-relative">
                  <div class="title_file">
                    <h3 class="file_title">{{ item[0].name }}</h3>
                    <br /><span class="file_size">{{
                      sizefile(item[0].size)
                    }}</span>
                  </div>
                </div>
              </div>
              <div class="progress-bar-file mt-3">
                <div class="row align-items-center">
                  <div v-if="item[1] > 0" class="col w-100">
                    <div class="progress">
                      <div
                        class="progress-bar"
                        role="progressbar"
                        :style="'width: ' + item[2] + '%'"
                        :aria-valuenow="item[2]"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      >
                        {{ item[2] }}%
                      </div>
                    </div>
                  </div>
                  <button
                    type="button"
                    class="btn-close position-absolute top-0 end-0"
                    aria-label="Close"
                    @click="removefile(index)"
                  ></button>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.errors+'.document_file.0'">
            test
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="fine-uploader-gallery"></div>

      <div class="mt-5">
        <button
          style="margin-right: 0 !important"
          id="btn_submit"
          type="submit"
          class="btn btn-primary"
          @click="SendRequest"
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
      file_type: "",
      file_type_name: "",
      document_id: "",
      username: this.userinfos.username,
      description: this.userinfos.description,
      type: this.userinfos.type,
      filesSelected: [],
      status: ["في انتظار", "جاري التحميل", "تم التحميل", "فشل التحميل"],
      sizefile: function bytesToSize(bytes) {
        var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
        if (bytes == 0) return "0 Byte";
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
      },
      fileicon: function (filetype) {
        if (
          filetype == "image/jpg" ||
          filetype == "image/jpeg" ||
          filetype == "image/png"
        ) {
          return "/img/icons/file-type/jpg.svg";
        } else if (filetype == "application/pdf") {
          return "/img/icons/file-type/pdf.svg";
        } else {
          return "/img/icons/file-type/pdf.zip";
        }
      },
    };
  },
  methods: {
    removefile: function (index) {
      this.filesSelected.splice(index, 1);
    },
    files_selected: function (e) {
      const file = e.target.files;
      let count = file.length;
      for (var i = 0; count > i; i++) {
        /**
         * File Parameters(file,status,progressbar)
         * File Status
         * 0 = في انتظار
         * 1 = جاري التحميل
         * 2 = تم التحميل
         * 3 = فشل التحميل
         *  */
        if (file[i].size > 1024 * 1024) {
          this.$vs.notify({
            text: " هذا الملف أكبر من اللازم الحد الأقصى (1 MB) *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        } else if (this.filesSelected.length >= 2) {
          this.$vs.notify({
            title: "مسموح فقط بملفين",
            text: "الحد الأقصى للملفات المسموح برفعها 2 اذا كنت تود تغيير الملفات المرجو حذف الملفات الموجودة حاليا *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        } else if (
          file[i].type != "image/jpg" &&
          file[i].type != "image/jpeg" &&
          file[i].type != "image/png" &&
          file[i].type != "application/pdf"
        ) {
          this.$vs.notify({
            text: "هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG, PDF) *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        } else {
          this.filesSelected.push([file[i], 0, 0]);
        }
      }
      //this.filesSelected[0].file.name = 12054;
      //console.log(this.filesSelected.length);
      /* if (file.size > 1024 * 1024) {
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
          file.type != "application/pdf" &&
          file.type != "image/png")
      ) {
        e.preventDefault();
        this.$vs.notify({
          text: "هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG, PDF)",
          color: "danger",
          position: "top-right",
          icon: "error",
        });
      } else {
        this.Uploaded_avatar = URL.createObjectURL(file);

        this.popupActivo = true;
      }*/
    },
    file_type_change: function () {
      if (this.file_type == 1) {
        this.file_type_name = "بطاقة الهوية";
      } else if (this.file_type == 2) {
        this.file_type_name = " جواز السفر";
      } else if (this.file_type == 3) {
        this.file_type_name = " بطاقة الاقامة";
      } else {
        this.file_type_name = "";
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
      $("#btn_submit").html("حفظ");
      this.$vs.loading.close("#loadform > .con-vs-loading");
    },
    SendRequest: function () {
      var config = {
        headers: { "Content-Type": "multipart/form-data" },
      };

      let data = new FormData();
      if (this.filesSelected.length > 0) {
        for (var i = 0; this.filesSelected.length > i; i++) {
      
          data.append("document_file[]", this.filesSelected[i][0]);
        }
      } else {
        data.append("document_file[0]", null);
      }
      data.append("document_type", this.file_type);
      data.append("document_id", this.document_id);

      axios
        .post("/ajax/user/request/verification", data, config)
        .then((response) => {
          this.errors = new Errors();
        })
        .catch((error) => {
          this.errors.record(error.response.data);
        });
    },
  },
};
</script>