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
            <div class="modal-dialog modal-lg">
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
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label"
                                    >الوصف</label
                                >
                                <textarea
                                    class="form-control"
                                    id="description"
                                    rows="4"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary btn-sm"
                            data-dismiss="modal"
                        >
                            الغاء
                        </button>
                        <button type="button" class="btn btn-primary btn-sm">
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
            subject: ""
        };
    }
};
</script>
