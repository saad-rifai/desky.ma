<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="NewTicketModal"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
            dir="rtl"
        >
            <div
                class="modal-dialog modal-lg vs-con-loading__container"
                id="modal-NewTicket-load"
            >
                <div class="modal-content" align="right">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            انشاء تذكرة
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
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group mb-3">
                                        <label for="subject" class="form-label"
                                            >التصنيف</label
                                        >
                                        <vs-select
                                            width="100%"
                                            class="selectExample"
                                            id="subject"
                                            v-model="category"
                                            v-bind:class="{
                                                'is-invalid':
                                                    errors.errors.category
                                            }"
                                        >
                                            <vs-select-item
                                                value="0"
                                                text="حساب المقاول الذاتي"
                                            />
                                            <vs-select-item
                                                value="1"
                                                text="حساب العميل (صاحب شركة أو مؤسسة)"
                                            />
                                            <vs-select-item
                                                value="2"
                                                text="التبليغ عن خطأ أو مشكلة"
                                            />
                                            <vs-select-item
                                                value="3"
                                                text="التبليغ عن اسائة استخدام"
                                            />
                                            <vs-select-item
                                                value="4"
                                                text="أخر"
                                            />
                                        </vs-select>
                                        <div
                                            class="invalid-feedback"
                                            v-if="errors.errors.category"
                                        >
                                            {{ errors.errors.category[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group mb-3">
                                        <label for="subject" class="form-label"
                                            >الموضوع</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-bind:class="{
                                                'is-invalid':
                                                    errors.errors.subject
                                            }"
                                            v-model="subject"
                                        />
                                        <div
                                            class="invalid-feedback"
                                            v-if="errors.errors.subject"
                                        >
                                            {{ errors.errors.subject[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description" class="form-label"
                                    >صف المشكل</label
                                >
                                <textarea
                                    class="form-control"
                                    id="description"
                                    rows="4"
                                    v-model="message"
                                    placeholder=""
                                    v-bind:class="{
                                        'is-invalid': errors.errors.message
                                    }"
                                ></textarea>

                                <div
                                    class="invalid-feedback"
                                    v-if="errors.errors.message"
                                >
                                    {{ errors.errors.message[0] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary btn-sm"
                            data-dismiss="modal"
                            id="close-modal-btn-RT855130200"
                        >
                            الغاء
                        </button>
                        <button
                            type="button"
                            id="btnsend_RT855130200"
                            :disabled="message == ''"
                            @click="SendMessage"
                            class="btn btn-primary btn-sm"
                        >
                            ارسال
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
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
    data() {
        return {
            errors: new Errors(),
            subject: "",
            message: "",
            category: ""
        };
    },
    methods: {
        openLoadingInDiv: function() {
            $("#btnsend_RT855130200").html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
            );
            this.$vs.loading({
                container: "#modal-NewTicket-load",
                scale: 0.6,
                type: "point",
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv: function() {
            $("#btnsend_RT855130200").html("ارسال");
            this.$vs.loading.close("#modal-NewTicket-load > .con-vs-loading");
        },
        SendMessage() {
            if(this.message != ""){
                this.openLoadingInDiv();
                let data = new FormData();
                data.append('category', this.category);
                data.append('subject', this.subject);
                data.append('message', this.message);
                axios.post("/ajax/help-center/new/ticket", data).then((response) =>{
                    this.$vs.notify({
                        text: response.data.success,
                        color: "success",
                        fixed: true,
                        icon: "check"
                    });
                    $("#close-modal-btn-RT855130200").click();
                    this.errors = new Errors();
                    this.subject = "";
                    this.message = "";
                    this.category = "";
                    this.HideLoadingInDiv();
                        window.location.href="/dashboard?newTicket=true";
                }).catch(error => {
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
                            text: "يجب تسجيل الدخول لتتمكن من انشاء تذكرة",
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
    }
};
</script>
