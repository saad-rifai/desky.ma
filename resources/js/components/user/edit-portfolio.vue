<template>
  <div>
    <div class="row justify-content-md-center" dir="rtl">
      <div class="col-sm">
        <div class="card p-4 mb-4 position-relative">
          <div id="loadform_4"></div>
          <h1 class="card-title mb-4 mt-2" style="font-size: 16px">
            اضافة عمل
          </h1>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
            <div class="col w-100">
              <div class="mb-3">
                <label class="form-label" for="title">عنوان العمل</label>
                <input
                  type="text"
                  class="form-control"
                  name="title"
                  id="title"
                  v-model="title"
                  v-bind:class="{ 'is-invalid': errors.errors.title }"
                />
                <div class="invalid-feedback" v-if="errors.errors.title">
                  {{ errors.errors.title[0] }}
                </div>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label class="form-label">القطاع</label>
                <select
                  v-model="sector"
                  @change="SectorChange"
                  v-bind:class="{ 'is-invalid': errors.errors.sector }"
                  class="form-select"
                >
                  <option value="">اختر</option>
                  <option value="1">الخدمات</option>
                  <option value="2">التجارة</option>
                  <option value="3">الصناعة</option>
                  <option value="4">الحرفية</option>
                </select>
                <div class="invalid-feedback" v-if="errors.errors.sector">
                  {{ errors.errors.sector[0] }}
                </div>
              </div>
            </div>
            <div class="col">
              <div class="mb-3" v-if="sector != '' && sector != null">
                <label class="form-label">التصنيف</label>

                <vs-select
                  placeholder="تحديد"
                  width="100%"
                  autocomplete
                  class="selectExample"
                  v-bind:class="{ 'is-invalid': errors.errors.activite }"
                  v-model="activite_selected"
                >
                  <vs-select-item
                    :key="index"
                    :value="index"
                    :text="item"
                    v-for="(item, index) in Activites"
                  />
                </vs-select>
                <div
                  class="invalid-feedback"
                  style="display: block !important"
                  v-if="errors.errors.activite"
                >
                  {{ errors.errors.activite[0] }}
                </div>
              </div>
            </div>
            <div class="col w-100">
              <div class="mb-3">
                <label for="description" class="form-label">وصف العمل</label>
                <textarea
                  class="form-control"
                  id="description"
                  rows="5"
                  v-model="description"
                  v-bind:class="{ 'is-invalid': errors.errors.description }"
                ></textarea>
                <div class="invalid-feedback" v-if="errors.errors.description">
                  {{ errors.errors.description[0] }}
                </div>
                <div class="form-text">أضف وصفا دقيقا ومختصرا للعمل</div>
              </div>
            </div>

            <div class="col w-100">
              <div class="mb-3">
                <label for="time" class="form-label"> صور</label>
                <!-- Upload Images Section-->
                <div
                  class="alert alert-danger"
                  v-if="errors.errors.image"
                  role="alert"
                >
                  <p>{{ errors.errors.image[0] }}</p>
                </div>

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
                  @drop="dropfiles"
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
                <div class="form-text">
                  يرجى التأكد من أن الصور غير مخالفة
                  <a href="/conditions#images?from=portfolio" target="_blank"
                    >لسياستنا</a
                  >
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
                        class="
                          badge
                          bg-success
                          position-absolute
                          bottom-0
                          end-0
                        "
                        style="margin-left: 15px; width: initial !important"
                        >{{ status[item[1]] }}</span
                      >

                      <div class="col-auto">
                        <div class="img_file_type">
                          <img :src="fileicon(item)" alt="" />
                        </div>
                      </div>
                      <div class="col-auto position-relative">
                        <div class="title_file">
                          <h3 class="file_title" v-if="item[0]">{{ item[0].name }}</h3>
                          <h3 class="file_title" v-else>{{index+1}} image</h3>
                          <br /><span v-if="item[0]" class="file_size">{{
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
                  </div>
                </div>
                <!-- Upload Images Section-->
              </div>
            </div>

            <div class="col w-100">
              <div class="mt-3">
                <button
                  style="margin-right: 0 !important"
                  type="button"
                  class="btn btn-primary"
                  id="btn_submit_4"
                  @click="SaveData"
                >
                  اضافة العمل
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Activites1 from "../../../../public/data/json/activite-ae-1.json";
import Activites2 from "../../../../public/data/json/activite-ae-2.json";
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
  props: ["portfolio_id"],
  data() {
    return {
      infos: [],
      errors: new Errors(),
      title: "",
      description: "",
      Activites: [],
      activite_selected: undefined,
      sector: 0,
      filesSelected: [],
      sizefile: function bytesToSize(bytes) {
        var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
        if (bytes == 0) return "0 Byte";
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
      },
      fileicon: function (file) {
        if(!file.server_file){
        
        if (
          file[0].type == "image/jpg" ||
          file[0].type == "image/jpeg" ||
          file[0].type == "image/png"
        ) {
          return URL.createObjectURL(file[0]);
        } else if (file[0].type == "application/pdf") {
          return "/img/icons/file-type/pdf.svg";
        } else {
          return "/img/icons/file-type/pdf.zip";
        }
      }else{
        return "/"+file.file_url
      }

      },
    };
  },
  methods: {
    openLoadingInDiv: function () {
      $("#btn_submit_4").html(
        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
      );
      this.$vs.loading({
        container: "#loadform_4",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      $("#btn_submit_4").html("اضافة العمل");
      this.$vs.loading.close("#loadform_4 > .con-vs-loading");
    },
    removefile: function (index) {
      this.filesSelected.splice(index, 1);
    },
    dropfiles: function (e) {
      $("#files-include").prop("files", e.dataTransfer.files);
      const file = e.dataTransfer.files;
      let count = file.length;
      for (var i = 0; count > i; i++) {
        if (file[i].size > 1024 * 1024) {
          this.$vs.notify({
            text: " هذا الملف أكبر من اللازم الحد الأقصى (1 MB) *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        } else if (this.filesSelected.length >= 3) {
          this.$vs.notify({
            title: "مسموح فقط بي 5 صور كحد أقصى *",
            text: "الحد الأقصى للصور المسموح برفعها 5 اذا كنت تود تغيير الصور المرجو حذف الصور الموجودة حاليا *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        } else if (
          file[i].type != "image/jpg" &&
          file[i].type != "image/jpeg" &&
          file[i].type != "image/png"
        ) {
          this.$vs.notify({
            text: "هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG) *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        } else {
          this.filesSelected.push([file[i], 0, 0]);
        }
      }
    },
    files_selected: function (e) {
      const file = e.target.files;
      let count = file.length;
      for (var i = 0; count > i; i++) {
        if (file[i].size > 1024 * 1024) {
          this.$vs.notify({
            text: " هذا الملف أكبر من اللازم الحد الأقصى (1 MB) *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        } else if (this.filesSelected.length >= 5) {
          this.$vs.notify({
            title: "مسموح فقط بي 5 صور كحد أقصى *",
            text: "الحد الأقصى للصور المسموح برفعها 5 اذا كنت تود تغيير الصور المرجو حذف الصور الموجودة حاليا *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        } else if (
          file[i].type != "image/jpg" &&
          file[i].type != "image/jpeg" &&
          file[i].type != "image/png"
        ) {
          this.$vs.notify({
            text: "هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG) *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        } else {
          this.filesSelected.push([file[i], 0, 0]);
        }
      }
    },
    SectorChange: function () {
      this.activite_selected = null;

      if (this.sector == 1) {
        this.Activites = Activites2;
      } else if (this.sector == 2 || this.sector == 3 || this.sector == 4) {
        this.Activites = Activites1;
      } else {
        this.Activites = [];
      }
    },
    getData() {
      axios
        .get("/ajax/user/request/portfolio/infos/" + this.portfolio_id)
        .then((response) => {
          this.infos = response.data;
          this.title = this.infos.title;
          this.description = this.infos.description;
          this.sector = this.infos.sector;
          this.SectorChange();
          this.activite_selected = this.infos.activite;
          var filesPaths = this.infos.files;
          /* Convert File Url To Object */
           console.log(this.infos.files);

          var x = 1;
          var id = 0;
          for (var y = 0; this.infos.files.length > y; y++) {
            this.filesSelected.push({'server_file': true, 'server_id': this.infos.files[y].server_id.server_id, 'file_url': this.infos.files[y][0]});
 
          }
        })
        .catch((error) => {
          this.$vs.notify({
            text: " حصل خطأ ما أثناء محاولة جلب البيانات يرجى اعادة المحاولة *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        });
    },
    SaveData() {
      let data = new FormData();
      if (this.filesSelected.length > 0) {
        for (var i = 0; this.filesSelected.length > i; i++) {
          if (this.filesSelected[i].server_file) {
            data.append("images_id[]", this.filesSelected[i].server_id);
          } else {
          data.append("image[]", this.filesSelected[i][0]);
            data.append("images_id[]", null);
          }
        }
      } else {
        data.append("image[0]", null);
        data.append("images_id[0]", null);
      }
      var config = {
        headers: { "Content-Type": "multipart/form-data; charset=utf-8" },
      };
      axios
        .post(
          "/ajax/user/request/portfolio/edit/" + this.portfolio_id + "/save",
          data,
          config
        )
        .then((response) => {
          console.log(response);
        });
    },
  },
  created() {
    this.getData();
  },
};
</script>