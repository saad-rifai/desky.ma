<template>
    <div>
        <!-- Modal -->
        <div id="delivery_load_page"></div>
        <div
            class="modal fade"
            id="deliveryModal"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
            dir="rtl"
        >
            <div
                class="modal-dialog modal-lg vs-con-loading__container"
                id="modal-delivery-load"
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
                            <div
                                class="row row-cols-1 mx-auto text-center mt-3 mb-3"
                            >
                                <div class="col w-100">
                                    <div class="icon-large-top">
                                        <img
                                            style="max-width: 100px"
                                            src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/info.png"
                                            alt="تنبيه"
                                        />
                                    </div>
                                </div>
                                <div class="col w-100 mt-3">
                                    <p class="text-icon">
                                        هل انت متأكد أنك تود تسليم هذا الطلب.
                                        <span
                                            class="d-block font-Naskh text-secondary"
                                        >
                                            يرجى التأكد من أنك انجزت كل ماهو
                                            مطلوب منك وكان متفقا عليه
                                        </span>
                                    </p>
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
                            data-dismiss="modal"
                            @click="delivery"
                            class="btn btn-primary btn-sm"
                        >
                            تسليم
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        <report-popup about="1" :from_url="from_url"></report-popup>
        <div class="dropdown">
            <button
                class="btn btn-primary btn-sm dropdown-toggle"
                type="button"
                :id="oid"
                data-toggle="dropdown"
                aria-expanded="false"
            >
                الاجرائات <i class="fas fa-caret-down"></i>
            </button>
            <ul class="dropdown-menu" :aria-labelledby="oid">
                <li v-if="status == 1">
                    <a
                        class="dropdown-item"
                        type="button"
                        data-toggle="modal"
                        data-target="#deliveryModal"
                        ><i class="fas fa-truck"></i> تسليم الطلب</a
                    >
                </li>
                <li>
                    <a
                        class="dropdown-item"
                        type="button"
                        data-toggle="modal"
                        data-target="#reportModal"
                    >
                        <i class="fas fa-flag"></i> تبليغ</a
                    >
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props: ["oid", "from_url", "status"],
    data() {
        return {};
    },
    methods: {
        openLoadingInDiv() {
            this.$vs.loading({
                container: "#delivery_load_page",
                type: "point",
                scale: 0.6,
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv() {
            this.$vs.loading.close("#delivery_load_page > .con-vs-loading");
        },
        delivery() {
            if (this.status == 1) {
                this.openLoadingInDiv();
                let data = new FormData();
                data.append("OID", this.oid);
                axios
                    .post("/ajax/deal/delivery", data)
                    .then(response => {
                        this.$vs.notify({
                            text: "تمت العملية بنجاح !",
                            color: "success",
                            position: "top-right",
                            icon: "check"
                        });
                        window.location.reload();

                        this.HideLoadingInDiv();
                    })
                    .catch(error => {
                        this.HideLoadingInDiv();
                        if (error.response.status == 400) {
                            this.$vs.notify({
                                title: "لايمكن تحديث هذا الطلب",
                                text: error.response.data.error,
                                color: "danger",
                                position: "top-right",
                                fixed: true,
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
                        } else {
                            this.$vs.notify({
                                title: "هناك خطأ ما !",
                                text:
                                    "حصل خطأ ما أثناء محاولة معالجة طلبك يرجى اعادة المحاولة, اذا استمر معك المشكل يرجى التواصل معنا",
                                color: "danger",
                                position: "top-right",
                                fixed: true,
                                icon: "warning"
                            });
                        }
                    });
            }
        }
    }
};
</script>
