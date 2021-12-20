<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="NewMessageModal"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
            dir="rtl"
        >
            <div
                class="modal-dialog modal-lg vs-con-loading__container"
                id="modal-NewMessage-load"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            ارسال رسالة
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
                                <label for="description" class="form-label"
                                    >الرسالة</label
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
                                    <div id="description" class="form-text">يمنع ارسال وسائل تواصل خارجية مثل رقم الهاتف أو البريد الالكتروني...</div>

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
                            id="close-modal-btn-5454654"
                        >
                            الغاء
                        </button>
                        <button
                            type="button"
                            id="btnsend19524"
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
    props:['to'],
    data() {
        return {
            errors: new Errors(),
            message: "",
            responseRequest: null,
        };
    },
    methods:{
    openLoadingInDiv: function () {
      $("#btnsend19524").html(
        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
      );
      this.$vs.loading({
        container: "#modal-NewMessage-load",
        scale: 0.6,
        type: "point",
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      $("#btnsend19524").html("ارسال");
      this.$vs.loading.close("#modal-NewMessage-load > .con-vs-loading");
    },
        SendMessage(){
            if(this.message != ""){
                this.openLoadingInDiv();
                let data = new FormData();
                data.append('to', this.to);
                data.append('message', this.message);
                axios.post('/ajax/user/new/message', data).then((response) => {
                    
                    this.responseRequest = response.data.success;
                    $("#close-modal-btn-5454654").click();
                    this.HideLoadingInDiv();
                    this.$vs.notify({
                            title:"تم ارسال رسالتك",
                            text: "<a href='/messages?id="+this.to+"'><button type='button' class='btn btn-outline-light btn-sm'>مشاهدة الرسالة</button></a>",
                            color: "success",
                            fixed: true,
                            icon: "check"
                        });
                }).catch((error) => {
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
    }
};
</script>
