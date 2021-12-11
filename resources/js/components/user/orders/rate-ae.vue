<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="Rate_modal"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
            dir="rtl"
        >
            <div
                class="modal-dialog modal-lg vs-con-loading__container"
                id="modal-rate-load"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            تقييم
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="rating-text">{{rating}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="rating">
                            <label>
                                <input type="radio" v-model="rating" name="stars" value=1 />
                                <span class="icon">★</span>
                            </label>
                            <label>
                                <input type="radio" v-model="rating" name="stars" value=2 />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                            </label>
                            <label>
                                <input type="radio" v-model="rating" name="stars" value=3 />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                            </label>
                            <label>
                                <input type="radio" v-model="rating" name="stars" value=4 />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                            </label>
                            <label>
                                <input type="radio" v-model="rating" name="stars" value=5 />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                            </label>
                        </div>
                            </div>

                            <div class="col-auto" v-if="rating > 0">
                                <button type="button" @click="rating = 0" class="btn-close" aria-label="Close"></button>

                            </div>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="description" class="form-label">أخبر الآخرين عن رأيك</label>
                            <textarea id="description" v-bind:class="{'is-invalid': errors.errors.description}" v-model="description" class="form-control" rows="3" ></textarea>
                                                       <div
                                    class="invalid-feedback"
                                    v-if="errors.errors.description"
                                >
                                    {{ errors.errors.description[0] }}
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
                            id="btn_pr85942037"
                            @click="sendRating"
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
    props:['to', 'oid'],
    data() {
        return {
            errors: new Errors(),
            rating: 0,
            description: "",
        };
    },
    methods: {
            openLoadingInDiv: function () {
      $("#btn_pr85942037").html(
        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
      );
      this.$vs.loading({
        container: "#modal-rate-load",
        scale: 0.6,
        type: "point",
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      $("#btn_pr85942037").html("ارسال");
      this.$vs.loading.close("#modal-rate-load > .con-vs-loading");
    },
        sendRating() {
            this.openLoadingInDiv();

            let data = new FormData();
            data.append("to", this.to)
            data.append("OID", this.oid)
            data.append("rating", this.rating)
            data.append("description", this.description)
            axios.post("/ajax/user/rate", data).then((response) => {
                console.log(response);
            }).catch((error) => {
              this.errors.record(error.response.data);
                if (error.response.status == 500) {
                        this.errors.record(error.response.data);
                        this.$vs.notify({
                            title: "خطأ في النظام",
                            text:"حصل خطأ في النظام أثناء محاولة معالجة طلبك يرجى اعادة المحاولة واذا استمر معك الخطأ يرجى التواصل معنا",
                            color: "danger",
                            fixed: true,
                            icon: "warning"
                        });
                    } else if (error.response.status == 401) {
                        this.errors.record(error.response.data);
                        this.$vs.notify({
                            text: "يجب تسجيل الدخول",
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
