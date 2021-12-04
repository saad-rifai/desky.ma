<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="reportModal"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
            dir="rtl"
        >
            <div class="modal-dialog modal-lg vs-con-loading__container" id="modal-report-load">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            التبليغ
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="form-group mb-3">
                                <label for="subject" class="form-label"
                                    >الموضوع</label
                                >
                                <vs-select
                                    width="100%"
                                    class="selectExample"
                                    id="subject"
                                    label="اختر"
                                    v-model="subject"
                                    v-bind:class="{
                                        'is-invalid': errors.errors.category
                                    }"
                                >
                                    <vs-select-item
                                        value="0"
                                        text="هذا المحتوى لم يعجبني"
                                    />
                                    <vs-select-item
                                        value="1"
                                        text="هذا المحتوى يخالف شروط استخدام desky"
                                    />
                                    <vs-select-item
                                        value="2"
                                        text="هذا المحتوى مزعج، متكرر أو سبام"
                                    />
                                </vs-select>
                                <div
                                    class="invalid-feedback"
                                    v-if="errors.errors.category"
                                >
                                    {{ errors.errors.category[0] }}
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label"
                                    >الوصف</label
                                >
                                <textarea
                                    class="form-control"
                                    id="description"
                                    rows="4"
                                    v-model="description"
                                    placeholder="25 حرف على الأقل"
                                    v-bind:class="{
                                        'is-invalid': errors.errors.description
                                    }"
                                ></textarea>
                                <div
                                    class="invalid-feedback"
                                    v-if="errors.errors.description"
                                >
                                    {{ errors.errors.description[0] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary btn-sm"
                            data-dismiss="modal"
                            id="close-modal-btn"
                        >
                            الغاء
                        </button>
                        <button
                            type="button"
                            id="btnsend"
                            @click="sendReport"
                            class="btn btn-primary btn-sm"
                        >
                            ارسال
                        </button>
                    </div>
                </div>
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
    props: ["to", "from_url", "about"],
    data() {
        return {
            errors: new Errors(),
            subject: "",
            description: ""
        };
    },
    methods: {
    openLoadingInDiv: function () {
      $("#btnsend").html(
        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
      );
      this.$vs.loading({
        container: "#modal-report-load",
        scale: 0.6,
        type: "point",
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      $("#btnsend").html("ارسال");
      this.$vs.loading.close("#modal-report-load > .con-vs-loading");
    },
        sendReport() {
            this.openLoadingInDiv();
            let data = new FormData();
            data.append("to", this.to);
            data.append("from_url", this.from_url);
            data.append("about", this.about);
            data.append("category", this.subject);
            data.append("description", this.description);
            axios
                .post("/ajax/support/report", data)
                .then(response => {
                    this.$vs.notify({
                        text: "تم تسجيل شكواك",
                        color: "success",
                        fixed: true,
                        icon: "check"
                    });
                    $("#close-modal-btn").click();
                    this.errors = new Errors();
                    this.subject = "";
                    this.description = "";
                    this.HideLoadingInDiv();

                })
                .catch(error => {
                    if (error.response.status == 500) {
                        this.errors.record(error.response.data);
                        this.$vs.notify({
                            title: "خطأ في النظام",
                            text:
                                "حصل خطأ في النظام أثناء محاولة معالجة طلبك يرجى اعادة المحاولة واذا استمر معك الخطأ يرجى التواصل معنا",
                            color: "danger",
                            fixed: true,
                            icon: "warning"
                        });
                    } else if (error.response.status == 401) {
                        this.errors.record(error.response.data);
                        this.$vs.notify({
                            text: "يجب تسجيل الدخول لتتمكن من التبليغ",
                            color: "danger",
                            fixed: true,
                            icon: "warning"
                        });
                        window.location.href="/login?redirect="+window.location.href+"";
                    }  else if (error.response.status == 422) {
                        this.errors.record(error.response.data);
                        this.$vs.notify({
                            text: "تحقق من المدخلات",
                            color: "danger",
                            fixed: true,
                            icon: "warning"
                        });
                    } else {
                        this.errors.record(error.response.data);
                        this.$vs.notify({
                            text: error.response.data.error,
                            color: "danger",
                            fixed: true,
                            icon: "warning"
                        });
                    }
                    this.HideLoadingInDiv();

                });
        }
    }
};
</script>
