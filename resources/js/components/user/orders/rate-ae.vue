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
                            <textarea id="description" v-model="decription" class="form-control" rows="3" ></textarea>
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
export default {
    data() {
        return {
            rating: 0,
        };
    },
    methods: {
        sendRating() {}
    }
};
</script>
