<template>
  <div>
    <div class="card mb-4 position-relative">
      <div id="loadform_4"></div>
      <div class="row mb-dsp-block ">
        <div
          class="col-sm col-lg-3 pt-3 pb-3 bg-brand img-fluid"
        >
             <div class="row steps-add-order__mobile mt-2">
               <div class="col">
<vs-progress :height="12" :percent="(step*20)" color="rgb(255 255 255)">success</vs-progress>

               </div>
               <div class="col-auto text-white">
                 {{step}} من 5
               </div>
             </div>
          <div class="w-100 h-100 form-steps-bg position-relative">
            <ul class="list-group list-group-flush">
              <li class="list-group-item mb-3">
                <span class="icon-list-steps active">1</span>
                العنوان
              </li>
              <li class="list-group-item mb-3">
                <span
                  class="icon-list-steps"
                  v-bind:class="{ active: step >= 2 }"
                  >2</span
                >
                التصنيف
              </li>
              <li class="list-group-item mb-3">
                <span
                  class="icon-list-steps"
                  v-bind:class="{ active: step >= 3 }"
                  >3</span
                >
                الوصف والملفات
              </li>
              <li class="list-group-item mb-3">
                <span
                  class="icon-list-steps"
                  v-bind:class="{ active: step >= 4 }"
                  >4</span
                >
                مكان الانجاز
              </li>
              <li class="list-group-item mb-3">
                <span
                  class="icon-list-steps"
                  v-bind:class="{ active: step >= 5 }"
                  >5</span
                >
                مدة التنفيذ والميزانية
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm ">
          <div class="row w-100  h-100 row-cols-1 row-cols-sm-2 row-cols-md-2 p-4" style="align-content: center !important;">
            <div v-if="step == 1" class="col w-100">
              <div class="mb-3">
                <label for="title" class="form-label">أكتب عنوان لطلبك</label>

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
                <div class="exmples-menu mt-4 font-Naskh">
                  <h3 class="ul-title">أمثلة عناوين</h3>
                  <ul>
                    <li>
                      مطلوب خياط على الثوب كتابة
                    </li>
                    <li>أبحت عن موزعين  </li>
                    <li>نبحث عن عمال بناء</li>
                    <li>أبحث عن نجار لتجهيز مدرسة</li>
                  </ul>
                </div>
              </div>
            </div>

            <div v-if="step == 2" class="col">
              <div class="mb-3">
                <label class="form-label">حدد القطاع الخاص بطلبك</label>
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
            <div v-if="step == 2" class="col">
              <div class="mb-3">
                <label class="form-label">حدد التصنيف الخاص بطلبك</label>
                <vs-select
                  width="100%"
                  autocomplete
                  class="selectExample"
                  v-bind:class="{ 'is-invalid': errors.errors.activite }"
                  v-model="activite_selected"
                >
                  <vs-select-item value="" text="بدون تحديد" />
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
                <div class="form-text font-Naskh">
                  في حال لم تعرف التخصص المطلوب يمكنك تركه فارغ
                </div>
              </div>
            </div>
            <div v-if="step == 2" class="col w-100">
              <label class="form-label">الكلمات المفتاحية</label>
              <div class="mb-3">
                <vs-chips
                  color="rgb(145, 32, 159)"
                  placeholder="ماء, كهرباء, مطور ويب, نجار, صباغ..."
                  v-model="keywords"

                >
                  <vs-chip
                    :key="chip"
                    @click="removeKey(chip)"
                    v-for="chip in keywords"
                    closable
                  >
                    {{ chip }}
                  </vs-chip>
                </vs-chips>
                <div
                  class="invalid-feedback"
                  style="display: block !important"
                  v-if="errors.errors.keywords"
                >
                  {{ errors.errors.keywords[0] }}
                </div>
              </div>
            </div>
            <div v-if="step == 3" class="col w-100">
              <div class="mb-3">
                <label for="description" class="form-label"
                  >صف طلبك بشكل مفصل ووضح مالذي توده بالظبط للحصول على أفضل
                  العروض</label
                >
                <textarea
                  v-model="description"
                  class="form-control"
                  id="description"
                  rows="5"
                  v-bind:class="{ 'is-invalid': errors.errors.description }"
                ></textarea>
                <div class="invalid-feedback" v-if="errors.errors.description">
                  {{ errors.errors.description[0] }}
                </div>
              </div>
            </div>
            <div v-if="step == 4" class="col w-100">
              <div class="mb-3">
                <label class="form-label">
                  هل يمكن تنفيذ هذا العمل عن بعد ؟</label
                >
                <br />

                <div
                  class="form-check form-check-inline"
                  v-bind:class="{ 'is-invalid': errors.errors.onlineCeck }"
                >
                  <input
                    class="form-check-input"
                    type="radio"
                    name="onlineCeck"
                    id="onlineCeck1"
                    value="1"
                    v-model="onlineCeck"
                    v-bind:class="{ 'is-invalid': errors.errors.onlineCeck }"
                  />
                  <label class="form-check-label" for="onlineCeck1">نعم</label>
                </div>
                <div
                  class="form-check form-check-inline"
                  v-bind:class="{ 'is-invalid': errors.errors.onlineCeck }"
                >
                  <input
                    class="form-check-input"
                    type="radio"
                    name="onlineCeck"
                    id="onlineCeck2"
                    value="2"
                    v-model="onlineCeck"
                    v-bind:class="{ 'is-invalid': errors.errors.onlineCeck }"
                  />
                  <label class="form-check-label" for="onlineCeck2">لا</label>
                </div>
                <div class="invalid-feedback" v-if="errors.errors.onlineCeck">
                  {{ errors.errors.onlineCeck[0] }}
                </div>
              </div>
            </div>
            <div v-if="onlineCeck == 2 && step == 4" class="col w-100">
              <div class="mb-3">
                <label class="form-label">المكان</label>
                <vs-select
                  width="100%"
                  autocomplete
                  class="selectExample"
                  v-model="place"
                  v-bind:class="{ 'is-invalid': errors.errors.place }"
                >
                  <vs-select-item
                    :key="index"
                    :value="item.id"
                    :text="item.ville"
                    v-for="(item, index) in citiesJson"
                  />
                </vs-select>
                <div class="invalid-feedback" v-if="errors.errors.place">
                  {{ errors.errors.place[0] }}
                </div>
              </div>
            </div>

            <div v-if="step == 5" class="col">
              <div class="mb-3">
                <label for="budget" class="form-label"
                  >حدد الميزانية الخاصة بك</label
                >
                <div class="input-group">
                  <div class="input-group-text">MAD</div>
                  <input
                    type="number"
                    class="form-control"
                    id="budget"
                    v-bind:class="{ 'is-invalid': errors.errors.budget }"
                    v-model="budget"
                  />
                </div>
                <div
                  class="invalid-feedback"
                  style="display: block !important"
                  v-if="errors.errors.budget"
                >
                  {{ errors.errors.budget[0] }}
                </div>
              </div>
            </div>
            <div v-if="step == 5" class="col">
              <div class="mb-3">
                <label for="time" class="form-label">
                  كم يوم تتوقع يتطلب هذا العمل ؟
                </label>

                <div class="input-group">
                  <div class="input-group-text">
                    <i class="fas fa-stopwatch"></i>
                  </div>
                  <input
                    type="number"
                    class="form-control"
                    id="time"
                    v-bind:class="{ 'is-invalid': errors.errors.time }"
                    v-model="time"
                  />
                </div>
                <div class="form-text">عدد الأيام</div>
                <div
                  class="invalid-feedback"
                  style="display: block !important"
                  v-if="errors.errors.time"
                >
                  {{ errors.errors.time[0] }}
                </div>
              </div>
            </div>
            <div class="col w-100"></div>
            <div v-if="step == 3" class="col w-100">
              <div class="mb-3">
                <vs-collapse>
                  <vs-collapse-item style="max-height: max-content;">
                    <div slot="header">هل تود القيام برفع ملفات توضيحية ؟</div>
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
                      @drop="dropfiles"
                      @click="form_file_click"
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
                        <span class="title-upload-file"
                          >اسحب الملفات الى هنا</span
                        >
                        <br />

                        <span class="text-upload-file"
                          >أو انقر للاختيار يدويا</span
                        >
                      </div>
                    </div>
                    <div class="form-text">
                      يرجى التأكد من أن الصور غير مخالفة
                      <a
                        href="/conditions#images?from=portfolio"
                        target="_blank"
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
                  </vs-collapse-item>
                </vs-collapse>
              </div>
            </div>
            <div class="col w-100">
                        <div class="act-form p-3" align="left">
            <button
              type="button"
              class="btn btn-outline-primary"
              @click="previousStep"
              :disabled="step == 1"
            >
              السابق
            </button>
            <button type="button" class="btn btn-primary" v-if="step < 5" @click="nextStep">
              التالي
            </button>
<button type="button" class="btn btn-primary" v-else @click="SendRequest">
              نشر
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
import Activites1 from "../../../../../public/data/json/activite-ae-1.json";
import Activites2 from "../../../../../public/data/json/activite-ae-2.json";
import ListCities from "../../../../../public/data/json/list-moroccan-cities.json";

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
      Activites: [],
      activite_selected: [],
      sector: 0,
      citiesJson: ListCities,
      title: "",
      description: "",
      place: null,
      onlineCeck: "",
      budget: "",
      time: "",
      filesSelected: [],
      value3: "",
      step: 1,
      keywords: [],
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
          file.type == "image/png" ||
          file.type == "image/gif" ||
          file.type == "image/svg+xml"
        ) {
          return URL.createObjectURL(file);
        } else if (file.type == "application/pdf") {
          return "/img/icons/file-type/pdf.svg";
        } else if (
          file.type == "video/x-msvideo" ||
          file.type == "video/mpeg" ||
          file.type == "video/mp4" ||
          file.type == "video/mp4"
        ) {
          return "/img/icons/file-type/mp4.svg";
        } else if (file.type == "audio/mpeg") {
          return "/img/icons/file-type/mp3.svg";
        } else if (
          file.type == "application/msword" ||
          file.type ==
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
        ) {
          return "/img/icons/file-type/word.svg";
        } else if (file.type == "application/psd") {
          return "/img/icons/file-type/psd.svg";
        } else {
          return "/img/icons/file-type/zip.svg";
        }
      },
    };
  },
  methods: {
    form_file_click(){
      $("#files-include").click();
      $(".vs-collapse-item--content").css("max-height", "max-content");
    },
    removeKey(item) {
      this.keywords.splice(this.keywords.indexOf(item), 1);
    },
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
      $("#btn_submit_4").html("اضافة الطلب");
      this.$vs.loading.close("#loadform_4 > .con-vs-loading");
    },
    nextStep: function () {
      if (this.step < 5) {
        this.step++;
      }
    },
    previousStep: function () {
      if (this.step > 1) {
        this.step--;
      }
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
          file[i].type != "video/x-msvideo" &&
          file[i].type != "application/msword" &&
          file[i].type !=
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
          file[i].type != "image/gif" &&
          file[i].type != "image/vnd.microsoft.icon" &&
          file[i].type != "application/json" &&
          file[i].type != "audio/mpeg" &&
          file[i].type != "video/mpeg" &&
          file[i].type != "application/pdf" &&
          file[i].type != "image/svg+xml" &&
          file[i].type != "text/plain" &&
          file[i].type != "application/vnd.ms-excel" &&
          file[i].type != "application/zip" &&
          file[i].type !=
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" &&
          file[i].type != "application/vnd.rar" &&
          file[i].type != "application/x-rar-compressed" &&
          file[i].type != "application/x-zip-compressed" &&
          file[i].type != "application/x-7z-compressed" &&
          file[i].type != "application/octet-stream" &&
          file[i].type != "multipart/x-zip" &&
          file[i].type != "video/mp4" &&
          file[i].type != "application/psd" &&
          file[i].type != "image/png"
        ) {
          this.$vs.notify({
            text: "هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG, GIF, SVG, AVI, DOC, DOCX, ICO, JSON, MP3, MPEG, PDF, TXT, XLS, XSLX, ZIP, RAR, MP4) *",
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
          file[i].type != "video/x-msvideo" &&
          file[i].type != "application/msword" &&
          file[i].type !=
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
          file[i].type != "image/gif" &&
          file[i].type != "image/vnd.microsoft.icon" &&
          file[i].type != "application/json" &&
          file[i].type != "audio/mpeg" &&
          file[i].type != "video/mpeg" &&
          file[i].type != "application/pdf" &&
          file[i].type != "image/svg+xml" &&
          file[i].type != "text/plain" &&
          file[i].type != "application/vnd.ms-excel" &&
          file[i].type != "application/zip" &&
          file[i].type !=
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" &&
          file[i].type != "application/vnd.rar" &&
          file[i].type != "application/x-rar-compressed" &&
          file[i].type != "application/x-zip-compressed" &&
          file[i].type != "application/x-7z-compressed" &&
          file[i].type != "application/octet-stream" &&
          file[i].type != "multipart/x-zip" &&
          file[i].type != "video/mp4" &&
          file[i].type != "application/psd" &&
          file[i].type != "image/png"
        ) {
          //       console.log("file:"+this.filesSelected);
          this.$vs.notify({
            text: "هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG, GIF, SVG, AVI, DOC, DOCX, ICO, JSON, MP3, MPEG, PDF, TXT, XLS, XSLX, ZIP, RAR, MP4) *",
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
        this.activite_selected = [];
      }
    },
    errorStep(){
if(this.errors.errors.title){
            this.step = 1;
          } if(this.errors.errors.sector || this.errors.errors.activite || this.errors.errors.keywords){
            this.step = 2;
          } if(this.errors.errors.description || this.errors.errors.image){
            this.step = 3;
            
          }if(this.errors.errors.onlineCeck || this.errors.errors.place){
            this.step = 4;
            
          } if(this.errors.errors.budget || this.errors.errors.time){
            this.step = 5;
            
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
          data.append("files_u[]", this.filesSelected[i][0]);
        }
      } else {
        data.append("files_u[0]", null);
      }
      if(this.keywords.length > 0){
      data.append("keywords", this.keywords);

      }else{
      data.append("keywords", "");

      }
      data.append("title", this.title);
      data.append("description", this.description);
      data.append("sector", this.sector);
      data.append("activite", this.activite_selected);


      data.append("budget", this.budget);
      data.append("time", this.time);
      data.append("onlineCeck", this.onlineCeck);
      if (this.onlineCeck == 2) {
        data.append("place", this.place);
      }
      /*Send Data To Server */

      axios
        .post("/ajax/user/order/create", data, config)
        .then((response) => {
          this.RequestStatus = true;
          this.HideLoadingInDiv();
          this.errors = new Errors();
          this.$vs.notify({
            text: "تم اضافة طلبك بنجاح !",
            color: "success",
            position: "top-right",
            icon: "check",
          });
          window.location.replace("/order/" + response.data.oid);
        })
        .catch((error) => {
          this.HideLoadingInDiv();

          this.errors.record(error.response.data);

          if (error.response.status == 422) {
            this.errorStep();
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
              icon: "warning",
            });
          } else if (error.response.status == 403) {
            this.$vs.notify({
              title: "فشل العملية",
              text: error.response.data.error,
              color: "danger",
              position: "top-right",
              icon: "warning",
            });
          } else if (error.response.status == 401) {
            this.$vs.notify({
              text: "انتهت الجلسة",
              color: "danger",
              position: "top-right",
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
              icon: "warning",
            });
          }
        });
      /* Send Data To Server */
    },
  },
};
</script>