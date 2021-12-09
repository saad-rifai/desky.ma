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
            <div class="col-sm">
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
            <div class="col-sm">
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
                <div class="form-text font-Naskh">أضف وصفا دقيقا ومختصرا للعمل</div>
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
                <div class="form-text font-Naskh">
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
                          <img :src="fileicon(item[0])" alt="" />
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
                  @click="SendRequest"
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
  data() {
    return {
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
        console.log(file);
        if (
          file.type == "image/jpg" ||
          file.type == "image/jpeg" ||
          file.type == "image/png"
        ) {
          return URL.createObjectURL(file);
        } else if (file.type == "application/pdf") {
          return "/img/icons/file-type/pdf.svg";
        } else {
          return "/img/icons/file-type/pdf.zip";
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
    SendRequest: function () {
      this.openLoadingInDiv();
      let data = new FormData();
      var config = {
        headers: { "Content-Type": "multipart/form-data; charset=utf-8" },
      };

      if (this.filesSelected.length > 0) {
        for (var i = 0; this.filesSelected.length > i; i++) {
          data.append("image[]", this.filesSelected[i][0]);
        }
      } else {
        data.append("image[0]", null);
      }
      data.append("title", this.title);
      data.append("description", this.description);
      data.append("sector", this.sector);
      data.append("activite", this.activite_selected);
      /*Send Data To Server */

      axios
        .post("/ajax/user/portfolio/create", data, config)
        .then((response) => {
          this.RequestStatus = true;
          this.HideLoadingInDiv();
          this.errors = new Errors();
          this.$vs.notify({
            title: "تم اضافة عملك بنجاح !",
            color: "success",
            position: "top-right",
            icon: "check",
          });
          window.location.replace("/portfolio/" + response.data.portfolio_id);
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
            this.$vs.notify({
              title: "هناك خطأ ما !",
              text: error.response.data.errors,
              color: "danger",
              position: "top-right",
              fixed: true,
              icon: "warning",
            });
          } else if (error.response.status == 401) {
            this.$vs.notify({
              text: "انتهت الجلسة",
              color: "danger",
              position: "top-right",
              fixed: true,
              icon: "warning",
            });
            window.location.reload();
          } else {
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
      /* Send Data To Server */
    },
  },
};
</script>