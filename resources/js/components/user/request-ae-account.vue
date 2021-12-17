<template>
    <div>
        <div v-if="new_request_is_allowed">
            <div class="alert primary-brand-alert">
                <div class="row mx-auto align-items-center">
                    <div class="col align-middle">
                        <p>
                            خطوات بسيطة لكي تنظم الى أكبر شبكة مقاولين ذاتيين
                            بالمغرب
                        </p>
                    </div>
                    <div class="col-auto">
                        <button
                            type="button"
                            class="btn btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop"
                        >
                            كيفية الانضمام
                        </button>
                    </div>
                </div>
            </div>
            <form id="loadform_4" @submit.prevent>
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="username" class="form-label">
                                رقم بطاقة الهوية (CIN)</label
                            >
                            <input
                                type="text"
                                v-model="cin"
                                class="form-control"
                                v-bind:class="{
                                    'is-invalid': errors.errors.cin
                                }"
                            />
                            <div
                                class="invalid-feedback"
                                v-if="errors.errors.cin"
                            >
                                {{ errors.errors.cin[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label class="form-label"
                                >تاريخ انتهاء الصلاحية</label
                            >
                            <input
                                type="date"
                                class="form-control"
                                v-model="cin_date_expiration"
                                v-bind:class="{
                                    'is-invalid':
                                        errors.errors.cin_date_expiration
                                }"
                            />
                            <div
                                class="invalid-feedback"
                                v-if="errors.errors.cin_date_expiration"
                            >
                                {{ errors.errors.cin_date_expiration[0] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="username" class="form-label">
                                الرقم التعريفي للمقاول الذاتي</label
                            >
                            <input
                                maxlength="20"
                                type="text"
                                v-model="ae_number"
                                class="form-control"
                                v-bind:class="{
                                    'is-invalid': errors.errors.ae_number
                                }"
                            />
                            <div
                                class="invalid-feedback"
                                v-if="errors.errors.ae_number"
                            >
                                {{ errors.errors.ae_number[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label class="form-label">تاريخ الانخراط</label>
                            <input
                                type="date"
                                class="form-control"
                                v-model="join_date"
                                v-bind:class="{
                                    'is-invalid': errors.errors.join_date
                                }"
                            />
                            <div
                                class="invalid-feedback"
                                v-if="errors.errors.join_date"
                            >
                                {{ errors.errors.join_date[0] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="username" class="form-label"
                                >القطاع</label
                            >
                            <select
                                v-model="sector"
                                @change="SectorChange"
                                v-bind:class="{
                                    'is-invalid': errors.errors.sector
                                }"
                                class="form-select"
                            >
                                <option value="">اختر</option>
                                <option value="1">الخدمات</option>
                                <option value="2">التجارة</option>
                                <option value="3">الصناعة</option>
                                <option value="4">الحرفية</option>
                            </select>
                            <div
                                class="invalid-feedback"
                                v-if="errors.errors.sector"
                            >
                                {{ errors.errors.sector[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label class="form-label">النشاط</label>

                            <vs-select
                            
                                width="100%"
                                autocomplete
                                class="selectExample"
                                v-bind:class="{
                                    'is-invalid': errors.errors.activite
                                }"
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
                                style="display:block!important"
                                v-if="errors.errors.activite"
                            >
                                {{ errors.errors.activite[0] }}
                            </div>
              
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="job_title"
                        >المسمى الوظيفي</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="job_title"
                        v-model="job_title"
                        v-bind:class="{ 'is-invalid': errors.errors.job_title }"
                    />
                    <div
                        class="invalid-feedback"
                        style="display:block!important"
                        v-if="errors.errors.job_title"
                    >
                        {{ errors.errors.job_title[0] }}
                    </div>
                    <div class="form-text">
    أدخل مسمى وظيفي واحد لتظهر بنتائج البحث. مثال: نجار, صباغ, جباص, أستاذ موسيقى...
                    </div>
                </div>

                <div class="w-100">
                    <div class="mb-3">
                        <label for="time" class="form-label">
                            تحميل الوثائق
                            <i
                                class="fas fa-info-circle"
                                data-toggle="tooltip"
                                title="من أجل تفعيل حسابك يلزمك رفع صورة لبطاقة الهوية الخاصة بك سارية المفعول من الأمام والخلف وكذلك تحميل صورة لبطاقة المقاول الذاتي سارية المفعول أو شهادة الانخراط في سجل المقاول الذاتي"
                            ></i
                        ></label>
                        <div class="form-text mb-3">
                            من أجل تفعيل حسابك يلزمك رفع صورة لبطاقة الهوية
                            الخاصة بك سارية المفعول من الأمام والخلف وكذلك تحميل
                            صورة لبطاقة المقاول الذاتي سارية المفعول أو شهادة
                            الانخراط في سجل المقاول الذاتي.
                        </div>
                        <div
                            class="alert alert-danger"
                            v-if="errors.errors.document_file"
                            role="alert"
                        >
                            <p>{{ errors.errors.document_file[0] }}</p>
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
                            data-types="['png','jpg']"
                            @drop="dropfiles"
                            @click="SelectFilesOpen"
                        >
                            <input
                                type="file"
                                id="files-include-254781210"
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
                                            <img
                                                :src="fileicon(item[0])"
                                                alt=""
                                            />
                                        </div>
                                    </div>
                                    <div class="col-auto position-relative">
                                        <div class="title_file">
                                            <h3 class="file_title">
                                                {{ item[0].name }}
                                            </h3>
                                            <br /><span class="file_size">{{
                                                sizefile(item[0].size)
                                            }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-bar-file mt-3">
                                    <div class="row align-items-center">
                                        <div
                                            v-if="item[1] > 0"
                                            class="col w-100"
                                        >
                                            <div class="progress">
                                                <div
                                                    class="progress-bar"
                                                    role="progressbar"
                                                    :style="
                                                        'width: ' +
                                                            item[2] +
                                                            '%'
                                                    "
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
                    </div>
                </div>
                <div class="mb-3 mt-5 position-relative">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value="true"
                            v-bind:class="{ 'is-invalid': errors.errors.terms }"
                            v-model="terms"
                            id="terms"
                        />
                        <label class="form-check-label terms-text" for="terms">
                            أقر بأن المعلومات التي قمت بادخالها والوثائق التي
                            قمت بتحميلها صحيحة وخاصة بي وكما أقر بأني أعلم انه
                            انتحال شخصية شخص أخر يعاقب عليها القانون الجنائي
                        </label>
                        <br />
                        <div
                            class="invalid-feedback mt-2"
                            style="display: block !important"
                            v-if="errors.errors.terms"
                        >
                            {{ errors.errors.terms[0] }}
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <button
                        style="margin-right: 0 !important"
                        id="btn_submit_4"
                        type="submit"
                        class="btn btn-primary"
                        @click="SendRequest"
                    >
                        ارسال
                    </button>
                </div>
            </form>
        </div>
        <div
            v-if="new_request_is_allowed == false"
            class="row row-cols-2 mx-auto text-right mb-3"
        >
            <div class="col mb-2">
                <span class="col-label-text">
                    حالة الطلب:
                </span>
                <span
                    v-html="
                        RequestStatus(checkAeRequest.request_ae_account.status)
                    "
                >
                    {{
                        RequestStatus(checkAeRequest.request_ae_account.status)
                    }}
                </span>
            </div>
            <div class="col mb-2">
                <span class="col-label-text">
                    تاريخ الطلب:
                </span>
                <span class="col-text">
                    {{
                        moment(checkAeRequest.request_ae_account.created_at)
                            .locale("ar-ma")
                            .format("LLLL")
                    }}
                </span>
            </div>
            <div
                v-if="
                    checkAeRequest.request_ae_account.status == 3 ||
                        checkAeRequest.request_ae_account.status == 4
                "
                class="col mb-2"
            >
                <span class="col-label-text">
                    سبب الرفض
                </span>
                <span class="col-text">
                    {{ checkAeRequest.request_ae_account.message }}
                </span>
            </div>

            <div class="col w-100 mb-3">
                <span class="col-label-text d-block">
                    معلومات الطلب:
                </span>
                <hr />
            </div>
            <div class="col mb-3">
                <span class="col-label-text">
                    رقم بطاقة الهوية:
                </span>
                <span class="col-text">
                    {{ checkAeRequest.request_ae_account.cin }}
                </span>
            </div>
            <div class="col mb-3">
                <span class="col-label-text">
                    رقم تعريف المقاول الذاتي:
                </span>
                <span class="col-text">
                    {{ checkAeRequest.request_ae_account.ae_number }}
                </span>
            </div>
            <div class="col mb-3">
                <span class="col-label-text">
                    القطاع:
                </span>
                <span class="col-text">
                    {{ checkAeRequest.request_ae_account.sector }}
                </span>
            </div>
            <div class="col mb-3">
                <span class="col-label-text">
                    النشاط:
                </span>
                <span class="col-text">
                    {{ checkAeRequest.request_ae_account.activite }}
                </span>
            </div>
            <div class="col mb-3">
                <span class="col-label-text">
                    المسمى الوظيفي:
                </span>
                <span class="col-text">
                    {{ checkAeRequest.request_ae_account.job_title }}
                </span>
            </div>
            <div class="col mt-3 w-100">
                <div
                    v-if="checkAeRequest.request_ae_account.status == 3"
                    class="col mb-2"
                >
                    <button
                        @click="new_request_is_allowed = true"
                        class="btn btn-primary btn-sm"
                    >
                        ارسال الطلب من جديد
                    </button>
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
            RequestStatus: false,
            Activites: [],
            activite_selected: [],
            sector: 0,
            filesSelected: [],
            terms: false,
            cin: "",
            cin_date_expiration: null,
            ae_number: "",
            join_date: null,
            job_title: "",
            checkAeRequest: null,
            account_status: null,
            new_request_is_allowed: null,
            RequestStatus: function(status) {
                switch (status) {
                    case 1:
                        return '<span class="col-text text-secondary"><i class="fas fa-hourglass-half"></i> قيد المراجعة </span>';
                        break;
                    case 2:
                        return '<span class="col-text text-success"><i class="fas fa-check"></i> تم التفعيل </span>';
                        break;
                    case 3:
                        return '<span class="col-text text-danger"><i class="fas fa-times"></i> تم رفض الطلب </span>';
                        break;
                    case 4:
                        return '<span class="col-text text-danger"><i class="fas fa-times"></i> تم رفض الطلب نهائياََ </span>';
                        break;
                    default:
                        break;
                }
            },
            sizefile: function bytesToSize(bytes) {
                var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
                if (bytes == 0) return "0 Byte";
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                return (
                    Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i]
                );
            },
            fileicon: function(file) {
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
            }
        };
    },
    methods: {
        SectorChange: function() {
            if (this.sector == 1) {
                this.Activites = Activites2;
            } else if (
                this.sector == 2 ||
                this.sector == 3 ||
                this.sector == 4
            ) {
                this.Activites = Activites1;
            } else {
                this.Activites = [];
                this.activite_selected = [];
            }
        },
        removefile: function(index) {
            this.filesSelected.splice(index, 1);
        },
        SelectFilesOpen() {
            $("#files-include-254781210").click();
        },
        dropfiles: function(e) {
            $("#files-include-254781210").prop("files", e.dataTransfer.files);
            const file = e.dataTransfer.files;
            let count = file.length;
            for (var i = 0; count > i; i++) {
                if (file[i].size > 1024 * 1024) {
                    this.$vs.notify({
                        text: " هذا الملف أكبر من اللازم الحد الأقصى (1 MB) *",
                        color: "danger",
                        position: "top-right",
                        icon: "error"
                    });
                } else if (this.filesSelected.length >= 3) {
                    this.$vs.notify({
                        title: "مسموح فقط بي 3 ملفات",
                        text:
                            "الحد الأقصى للملفات المسموح برفعها 3 اذا كنت تود تغيير الملفات المرجو حذف الملفات الموجودة حاليا *",
                        color: "danger",
                        position: "top-right",
                        icon: "error"
                    });
                } else if (
                    file[i].type != "image/jpg" &&
                    file[i].type != "image/jpeg" &&
                    file[i].type != "image/png" &&
                    file[i].type != "application/pdf"
                ) {
                    this.$vs.notify({
                        text:
                            "هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG, PDF) *",
                        color: "danger",
                        position: "top-right",
                        icon: "error"
                    });
                } else {
                    this.filesSelected.push([file[i], 0, 0]);
                }
            }
        },
        files_selected: function(e) {
            const file = e.target.files;
            let count = file.length;
            for (var i = 0; count > i; i++) {
                if (file[i].size > 1024 * 1024) {
                    this.$vs.notify({
                        text: " هذا الملف أكبر من اللازم الحد الأقصى (1 MB) *",
                        color: "danger",
                        position: "top-right",
                        icon: "error"
                    });
                } else if (this.filesSelected.length >= 3) {
                    this.$vs.notify({
                        title: "مسموح فقط بي 3 ملفات",
                        text:
                            "الحد الأقصى للملفات المسموح برفعها 3 اذا كنت تود تغيير الملفات المرجو حذف الملفات الموجودة حاليا *",
                        color: "danger",
                        position: "top-right",
                        icon: "error"
                    });
                } else if (
                    file[i].type != "image/jpg" &&
                    file[i].type != "image/jpeg" &&
                    file[i].type != "image/png" &&
                    file[i].type != "application/pdf"
                ) {
                    this.$vs.notify({
                        text:
                            "هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG, PDF) *",
                        color: "danger",
                        position: "top-right",
                        icon: "error"
                    });
                } else {
                    this.filesSelected.push([file[i], 0, 0]);
                }
            }
        },
        openLoadingInDiv: function() {
            $("#btn_submit_4").html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
            );
            this.$vs.loading({
                container: "#loadform_4",
                scale: 0.6,
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv: function() {
            $("#btn_submit_4").html("ارسال");
            this.$vs.loading.close("#loadform_4 > .con-vs-loading");
        },
        
        CheckRequestAe() {
            axios
                .get("/ajax/user/aeaccount/check")
                .then(response => {
                    this.checkAeRequest = response.data;
                    this.account_status = this.checkAeRequest.account_status;
                    if (
                        this.account_status != 2 &&
                        this.checkAeRequest.request_ae_account == null
                    ) {
                        this.new_request_is_allowed = true;
                    } else {
                        this.new_request_is_allowed = false;
                    }
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        SendRequest: function() {
            this.openLoadingInDiv();
            var config = {
                headers: {
                    "Content-Type": "multipart/form-data; charset=utf-8"
                }
            };

            let data = new FormData();
            if (this.filesSelected.length > 0) {
                for (var i = 0; this.filesSelected.length > i; i++) {
                    data.append("document_file[]", this.filesSelected[i][0]);
                }
            } else {
                data.append("document_file[0]", null);
            }
            data.append("cin", this.cin);
            data.append("cin_date_expiration", this.cin_date_expiration);
            data.append("ae_number", this.ae_number);
            data.append("join_date", this.join_date);
            data.append("sector", this.sector);
            data.append("activite", this.activite_selected);
            data.append("job_title", this.job_title);
            data.append("terms", this.terms);
            /*Send Data To Server */

            axios
                .post("/ajax/user/request/aeaccount", data, config)
                .then(response => {
                    this.RequestStatus = true;
                    this.HideLoadingInDiv();
                    this.new_request_is_allowed = false;
                    this.errors = new Errors();
                    this.CheckRequestAe();
                    this.$vs.notify({
                        title: "تم ارسال طلبك !",
                        text:
                            "سيتم اشعارك من خلال البريد الالكتروني بردنا بعد الانتهاء من مراجعة طلبك",
                        color: "success",
                        position: "top-right",
                        icon: "warning"
                    });
                })
                .catch(error => {
                    this.HideLoadingInDiv();

                    this.errors.record(error.response.data);
                    if (error.response.status == 422) {
                        this.$vs.notify({
                            title: "هناك خطأ ما !",
                            text: "يرجى التحقق من مدخلاتك",
                            color: "danger",
                            position: "top-right",
                            icon: "warning"
                        });
                    } else if (error.response.status == 401) {
                        this.$vs.notify({
                            text: "انتهت الجلسة",
                            color: "danger",
                            position: "top-right",
                            fixed: true,
                            icon: "warning"
                        });
                        window.location.reload();
                    } else if (error.response.status == 400) {
                        this.$vs.notify({
                            title: "هناك خطأ ما !",
                            text: error.response.data.errors,
                            color: "danger",
                            position: "top-right",
                            fixed: true,
                            icon: "warning"
                        });
                    } else {
                        this.$vs.notify({
                            title: "هناك خطأ ما !",
                            text:
                                "حصل خطأ ما أثناء محاولة ارسال طلبك يرجى اعادة المحاولة, اذا استمر معك المشكل يرجى التواصل معنا",
                            color: "danger",
                            position: "top-right",
                            fixed: true,
                            icon: "warning"
                        });
                    }
                });
            /* Send Data To Server */
        }
    },
    created() {
        this.CheckRequestAe();
    }
};
</script>
