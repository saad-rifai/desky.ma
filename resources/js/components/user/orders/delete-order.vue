<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="delet_order_Modal"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
            dir="rtl"
        >
            <div
                class="modal-dialog modal-lg vs-con-loading__container"
                id="modal_delete_order_load"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            تنبيه
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
                            <p class="font-Naskh">
                                هل متأكد بأنك تود حذف هذا الطلب #{{ oid }}
                            </p>
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
                            id="btnsend_96r57"
                            @click="deleteOrder"
                            class="btn btn-danger btn-sm"
                        >
                            حذف
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["oid"],
    data() {
        return {};
    },
    methods: {
        openLoadingInDiv: function() {
            $("#btnsend_96r57").html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
            );
            this.$vs.loading({
                container: "#modal_delete_order_load",
                scale: 0.6,
                type: "point",
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv: function() {
            $("#btnsend_96r57").html("حذف");
            this.$vs.loading.close(
                "#modal_delete_order_load > .con-vs-loading"
            );
        },
        deleteOrder() {
            this.openLoadingInDiv();
            let data = new FormData();
            data.append("OID", this.oid);
            axios
                .post("/ajax/user/order/delete", data)
                .then(response => {
                    this.$vs.notify({
                        text: "تم حذف الطلب",
                        color: "success",
                        fixed: true,
                        icon: "check"
                    });
                    window.location.href="/MyOrders?item.deleted";
                })
                .catch(error => {
                    if (error.response.status == 401) {
                        this.$vs.notify({
                            text: "يجب تسجيل الدخول  ",
                            color: "danger",
                            fixed: true,
                            icon: "warning"
                        });
                        window.location.href =
                            "/login?redirect=" + window.location.href + "";
                    } else if (error.response.status == 403) {
                        this.$vs.notify({
                            text: error.response.data.error,
                            color: "danger",
                            fixed: true,
                            icon: "warning"
                        });
                    } else {
                        this.$vs.notify({
                            title: "خطأ في النظام",
                            text:
                                "حصل خطأ في النظام أثناء محاولة معالجة طلبك يرجى اعادة المحاولة واذا استمر معك الخطأ يرجى التواصل معنا",
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
