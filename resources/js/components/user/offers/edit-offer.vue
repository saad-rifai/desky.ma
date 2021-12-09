<template>
    <div>
        <!-- MODAL CHANGE UPDATE OFFER -->
        <div
            class="modal fade"
            id="modal_kr1825"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabe8039415_edit_offer"
            aria-hidden="true"
            dir="rtl"
            v-if="AllowdToEdit"
        >
            <div class="modal-dialog modal-dialog-centered modal-lg  ">
                <div
                    class="modal-content vs-con-loading__container"
                    align="right"
                    id="modal_kr1825_load"
                >
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="staticBackdropLabe8039415_edit_offer"
                        >
                            تعديل العرض
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body ">
                        <div class="mx-auto">
                            <div class="mb-3">
                                <label for="description" class="form-label"
                                    >وصف العرض</label
                                >
                                <textarea
                                    class="form-control"
                                    v-model="description"
                                    id="description"
                                    rows="5"
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
                                <div class="form-text">
                                    صف عرضك بشكل مفصل ووضح مالذي ستقدمه بالظبط
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="price" class="form-label"
                                            >التكلفة</label
                                        >
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                MAD
                                            </div>
                                            <input
                                                type="number"
                                                v-model="price"
                                                class="form-control"
                                                id="price"
                                                dir="ltr"
                                                v-bind:class="{
                                                    'is-invalid':
                                                        errors.errors.price
                                                }"
                                            />
                                        </div>
                                        <div
                                            class="invalid-feedback"
                                            style="display:block!important"
                                            v-if="errors.errors.price"
                                        >
                                            {{ errors.errors.price[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="time" class="form-label"
                                            >مدة التنفيذ</label
                                        >
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fas fa-stopwatch"></i>
                                            </div>
                                            <input
                                                type="number"
                                                v-model="time"
                                                class="form-control"
                                                id="time"
                                                dir="ltr"
                                                v-bind:class="{
                                                    'is-invalid':
                                                        errors.errors.time
                                                }"
                                            />
                                        </div>
                                        <div
                                            class="invalid-feedback"
                                            style="display:block!important"
                                            v-if="errors.errors.time"
                                        >
                                            {{ errors.errors.time[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <ul class="small-list-info">
                                    <li>
                                        لا تضع روابط خارجية، قم بالاهتمام بمعرض
                                        أعمالك بدلا منها
                                    </li>
                                    <li>لا تستخدم وسائل تواصل خارجية</li>
                                    <li>
                                        <a href="#"
                                            >اقرا هنا كيف تضيف عرضا مميزا على أي
                                            طلب</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            id="close-modal-btn_kr1825"
                            data-dismiss="modal"
                            class="btn btn-secondary btn-sm"
                        >
                            الغاء
                        </button>
                        <button
                            type="button"
                            class="btn btn-success btn-sm"
                            id="btnsend_kr1825"
                            @click="updateOffer"
                        >
                            تعديل
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL CHANGE UPDATE OFFER -->

        <!-- MODAL PREVIEW OFFER -->
        <div
            class="modal fade"
            id="modal_pr1825"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabe8039415_preview_offer"
            aria-hidden="true"
            dir="rtl"
        >
            <div class="modal-dialog modal-dialog-centered modal-lg  ">
                <div
                    class="modal-content vs-con-loading__container"
                    align="right"
                    id="modal_pr1825_load"
                >
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="staticBackdropLabe8039415_edit_offer"
                        >
                            معاينة عرضي
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body ">
                        <div class="row p-3">
                            <div class="col-sm">
                                <label class="form-label">التكلفة: </label>
                                <h5>{{ offerData.price }} درهم</h5>
                            </div>
                            <div class="col-sm">
                                <label class="form-label">مدة التنفيذ: </label>
                                <h5>{{ offerData.time }} يوم</h5>
                            </div>
                            <div class="col col-lg-1 w-100">
                                <label class="form-label">الوصف: </label>
                                <p class="font-Naskh">
                                    {{ offerData.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            v-if="AllowdToEdit"
                            type="button"
                            data-toggle="modal"
                            data-target="#modal_kr1825"
                            class="btn btn-outline-primary btn-sm"
                        >
                            تعديل
                        </button>
                        <button
                            type="button"
                            id="close-modal-btn_pr1825"
                            data-dismiss="modal"
                            class="btn btn-secondary btn-sm"
                        >
                            اغلاق
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL PREVIEW OFFER -->
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
    props: ["oid"],
    data() {
        return {
            AllowdToEdit: false,
            errors: new Errors(),
            description: "",
            time: "",
            price: "",
            offerData: [],
            offer_id: null
        };
    },
    methods: {
        returnFalse() {
            return false;
        },
        CheckIfAllowedToEdit() {
            axios
                .get("/ajax/order/" + this.oid + "/myoffer/")
                .then(response => {
                    this.offerData = response.data.data;
                    if (this.offerData.status == "0") {
                        this.AllowdToEdit = true;
                        this.description = this.offerData.description;
                        this.time = this.offerData.time;
                        this.price = this.offerData.price;
                        this.offer_id = this.offerData.id;
                    } else {
                        this.AllowdToEdit = false;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        openLoadingInDiv() {
            $("#btnsend_kr1825").html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
            );
            this.$vs.loading({
                container: "#modal_kr1825_load",
                scale: 0.6,
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv() {
            $("#btnsend_kr1825").html("تعديل");

            this.$vs.loading.close("#modal_kr1825_load > .con-vs-loading");
        },
        updateOffer() {
            this.openLoadingInDiv();
            let data = new FormData();
            data.append("description", this.description);
            data.append("time", parseInt(this.time));
            data.append("price", parseFloat(this.price));
            data.append("OID", this.oid);
            data.append("offer_id", this.offer_id);
            axios
                .post("/ajax/order/offer/update", data)
                .then(response => {
                    this.HideLoadingInDiv();
                    this.$vs.notify({
                        text: "تم تحديث عرضك بنجاح !",
                        color: "success",
                        position: "top-right",
                        icon: "check"
                    });
                    window.location.replace(
                        "/order/" +
                            this.oid +
                            "?offer=" +
                            response.data.offer_id
                    );
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
                    } else if (error.response.status == 400) {
                        this.errors = new Errors();

                        this.$vs.notify({
                            title: "هناك خطأ ما !",
                            text: error.response.data.error,
                            color: "danger",
                            position: "top-right",
                            fixed: true,
                            icon: "warning"
                        });
                    } else if (error.response.status == 401) {
                        this.errors = new Errors();

                        this.$vs.notify({
                            text: "انتهت الجلسة",
                            color: "danger",
                            position: "top-right",
                            fixed: true,
                            icon: "warning"
                        });
                        window.location.reload();
                    } else {
                        this.errors = new Errors();

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
        }
    },
    created() {
        this.CheckIfAllowedToEdit();
    }
};
</script>
