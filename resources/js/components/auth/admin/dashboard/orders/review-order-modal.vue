<template>
    <div>
        <div
            class="modal fade "
            id="review_order_modal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="false"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Review Order #{{ orderinfos.OID }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="card-title">Order Owner</h5>
                        
                        <div class="mb-3">
                            <div class="row row-cols-2 align-orderinfoss-center">
                                <div class="col-auto mr-2">
                                    <div class="sm-avatar">
                                <img v-if="orderinfos.user.avatar && orderinfos.user.avatar != null" :src="orderinfos.user.avatar">
                                <img v-else src="/img/icons/avatar.png">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a
                                        href="#"
                                        data-placement="top"
                                        data-toggle="tooltip"
                                        title="User account preview"
                                    >
                                        <p class="fs-5 fw-normal pb-0 mb-0">
                                            {{ orderinfos.user_fullname }}
                                        </p>
                                        <p class="fs-6 text-muted pb-0 mb-0">
                                            @{{ orderinfos.user.username }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                          <hr class="my-4">

                        <h5 class="card-title">Order Infos</h5>
                        <div class="alert alert-warning" role="alert">
                          Please note: The data should not be corrected except for unintentional errors or in good faith. If the user violates the rules of the platform or its affiliates, the request must be rejected or permanently deleted.
                          <br>
                          <br>
                          Attention : Les données ne doivent pas être corrigées, sauf erreur involontaire ou de bonne foi. Si l'utilisateur enfreint les règles de la plateforme ou de ses affiliés, la demande doit être rejetée ou supprimée définitivement.
                          <br>
                          <br>
                          <p align="right" dir="rtl">
                                                        يرجى الانتباه: لا يجب تصحيح المعطيات الى في الاخطاء الغير المقصودة أو عن حسن نية في حال خالف المستخدم قواعد المنصة أو الشركات التابعة لها يجب رفض أو حذق الطلب نهائياََ

                          </p>
                        </div>
                        <div class="col w-100 mb-3">
                            <input
                                dir="auto"
                                class="form-control"
                                type="text"
                                v-model="orderinfos.title"
                            />
                        </div>
                        <div class="col w-100 mb-3">
                            <textarea
                                dir="auto"
                                name="text"
                                class="form-control"
                                v-model="orderinfos.description"
                            ></textarea>
                        </div>
                        
                        <div class="row p-3">
                            <div class="col-lg-6 col-xl-6 mb-3"><strong>Date created:</strong> {{orderinfos.date}}</div>
                            <div class="col-lg-6 col-xl-6 mb-3"><strong>Sector, Activity:</strong> {{orderinfos.sector_name}},  {{orderinfos.activite_name}}</div>
                            <div class="col-lg-6 col-xl-6 mb-3"><strong>Country, City:</strong> <span v-if=" orderinfos.place && orderinfos.place != 'remotely'">Morocco, {{citiesJson[orderinfos.place].ville}}</span><span v-else>Remotely</span></div>
                            <div class="col-lg-6 col-xl-6 mb-3"><strong>Budget:</strong> {{orderinfos.budget}} MAD</div>
                            <div class="col-lg-6 col-xl-6 mb-3"><strong>Time:</strong> {{orderinfos.time}}</div>
                            <div class="col-lg-6 col-xl-6 mb-3"><strong>Keywords: </strong> <span  v-for="(item, index) in orderinfos.keywords" :key="index" class=" mr-2 badge badge-pill badge-secondary">{{item}}</span><span v-if="orderinfos.keywords == null || orderinfos.keywords == undefined">undefined</span></div>
                      
                        </div>
                        <h5 class="card-title">Attached files</h5>

                        <div class="review-files-list">
                            <ul class="list-group list-group-flush">
                                <li v-for="(file, index) in orderinfos.files" :key="index" class="list-group-item"><a :href="file.file_url" target="_blank">{{file.filename}}</a></li>
                            <li v-if="orderinfos.files == null || orderinfos.files.length < 1" >No files found</li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ListCities from "/public/data/json/list-moroccan-cities.json";

export default {
    props: ["orderinfos"],
    data() {
        return {
            citiesJson: ListCities,
            /*   order_title: this.orderinfos.title,
            order_description: this.orderinfos.description*/
        };
    }
};
</script>
