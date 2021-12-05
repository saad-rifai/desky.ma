<template>
    <div>
        <!-- MODAL CHANGE ORDER STATUS -->
        <div
            class="modal fade"
            id="canceling-ae-contract"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel124_canceling_contract"
            aria-hidden="true"
            dir="rtl"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg  "
                
            >
                <div class="modal-content vs-con-loading__container" id="modal_kr4370">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="staticBackdropLabel124_canceling_contract"
                        >
                            تنبيه
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body ">
                        <div class="mx-auto font-Naskh">
                            <div
                                class="alert alert-danger d-flex align-items-center"
                                role="alert"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="currentColor"
                                    class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                    viewBox="0 0 16 16"
                                    role="img"
                                    aria-label="Warning:"
                                >
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                                    />
                                </svg>
                                <div>
                                    يرجى التأكد من أنك قد قمت بأداء أي مستحاقات
                                    للمقاول الذاتي حسب العمل المنجز ويفضل
                                    الاتفاق مع المقاول قبل الغاء العقد لتجنب
                                    اغلاق حسابك أو أي متابعات قانونية
                                </div>
                            </div>
                            <p>
                                هل أنت متأكد بأنك تود الغاء هذا العقد ؟
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            id="close-modal-btn_kr4370"
                            data-dismiss="modal"
                            class="btn btn-secondary btn-sm"
                        >
                            التراجع
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger btn-sm"
                       
                            id="btnsend_kr4370"
                            @click="cancelContract"
                        >
                            الغاء العقد
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL CHANGE ORDER STATUS -->
    </div>
</template>
<script>
export default {
    props: ["oid", "userid"],
    data() {
        return {};
    },
    methods: {
        openLoadingInDiv: function() {
            $("#btnsend_kr4370").html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
            );
            this.$vs.loading({
                container: "#modal_kr4370",
                scale: 0.6,
                type: "point",
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv: function() {
            $("#btnsend_kr4370").html("الغاء العقد");
            this.$vs.loading.close("#modal_kr4370 > .con-vs-loading");
        },
        cancelContract() {
            this.openLoadingInDiv();
            let data = new FormData();
            data.append("OID", this.oid);
            data.append("userid", this.userid);
            axios
                .post("/ajax/user/contract/cancel", data)
                .then(response => {
                    this.$vs.notify({
                        text: "تم الغاء العقد",
                        color: "success",
                        fixed: true,
                        icon: "check"
                    });
                    $("#profile-tab").click();
                    $("#close-modal-btn_kr4370").click();
                    this.HideLoadingInDiv();
                })
                .catch(error => {
                    if (error.response.status == 401) {
                        this.$vs.notify({
                            text: "يجب تسجيل الدخول",
                            color: "danger",
                            fixed: true,
                            icon: "warning"
                        });
                        window.location.href =
                            "/login?redirect=" + window.location.href + "";
                    } else {
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
