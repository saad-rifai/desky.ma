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
            <div class="modal-dialog modal-dialog-centered modal-lg vs-con-loading__container">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel124_canceling_contract">
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
                        <div class="mx-auto text-center font-Naskh">
                            <p>
                                هل أنت متأكد بأنك تود الغاء هذا العقد

                                
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            data-dismiss="modal"
                            id="close-modal-btn"
                            @click="OrderNextStatu"
                        >
                            لا
                        </button>
                        <button
                            type="button"
                            id="close-modal-btn"
                            data-dismiss="modal"
                            class="btn btn-secondary btn-sm"
                        >
                            نعم
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL CHANGE ORDER STATUS -->
    </div>
</template>