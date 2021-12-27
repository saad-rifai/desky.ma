<template>
    <div>
        <div id="load_modal_28292710011"></div>
        <div
            class="modal fade "
            id="review_order_modal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="false"
            @click.self="ResetDecision"
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
                            @click="ResetDecision"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="card-title">Order Owner</h5>

                        <div class="mb-3">
                            <div
                                class="row row-cols-2 align-orderinfoss-center"
                            >
                                <div class="col-auto mr-2">
                                    <div class="sm-avatar">
                                        <img
                                            v-if="
                                                orderinfos.user.avatar &&
                                                    orderinfos.user.avatar !=
                                                        null
                                            "
                                            :src="orderinfos.user.avatar"
                                        />
                                        <img
                                            v-else
                                            src="/img/icons/avatar.png"
                                        />
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
                        <hr class="my-4" />

                        <h5 class="card-title">Order Infos</h5>
                        <div class="alert alert-warning" role="alert">
                            Please note: The data should not be corrected except
                            for unintentional errors or in good faith. If the
                            user violates the rules of the platform or its
                            affiliates, the request must be rejected or
                            permanently deleted.
                            <br />
                            <br />
                            Attention : Les données ne doivent pas être
                            corrigées, sauf erreur involontaire ou de bonne foi.
                            Si l'utilisateur enfreint les règles de la
                            plateforme ou de ses affiliés, la demande doit être
                            rejetée ou supprimée définitivement.
                            <br />
                            <br />
                            <p align="right" dir="rtl">
                                يرجى الانتباه: لا يجب تصحيح المعطيات الى في
                                الاخطاء الغير المقصودة أو عن حسن نية في حال خالف
                                المستخدم قواعد المنصة أو الشركات التابعة لها يجب
                                رفض أو حذق الطلب نهائياََ
                            </p>
                        </div>
                        <div class="col w-100 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input
                                id="title"
                                dir="auto"
                                class="form-control"
                                type="text"
                                v-model="orderinfos.title"
                                v-bind:class="{
                                    'is-invalid': errors.errors.title
                                }"
                            />
                            <div
                                class="invalid-feedback"
                                style="display: block !important"
                                v-if="errors.errors.title"
                            >
                                {{ errors.errors.title[0] }}
                            </div>
                        </div>
                        <div class="col w-100 mb-3">
                            <label for="Description" class="form-label"
                                >Description</label
                            >
                            <textarea
                                dir="auto"
                                id="Description"
                                name="text"
                                class="form-control"
                                v-model="orderinfos.description"
                                v-bind:class="{
                                    'is-invalid': errors.errors.description
                                }"
                            ></textarea>
                            <div
                                class="invalid-feedback"
                                style="display: block !important"
                                v-if="errors.errors.description"
                            >
                                {{ errors.errors.description[0] }}
                            </div>
                        </div>
                        <div class="row row-cols-lg-2">
                            <div class="col-sm mb-3">
                                <label class="form-label">Sector</label>
                                <vs-select
                                    v-model="orderinfos.sector"
                                    @change="SectorChange"
                                    dir="auto"
                                    class="w-100"
                                    v-bind:class="{
                                        'is-invalid': errors.errors.sector
                                    }"
                                >
                                    <vs-select-item
                                        dir="auto"
                                        value="0"
                                        text="no selection"
                                    />
                                    <vs-select-item
                                        dir="auto"
                                        value="1"
                                        text="الخدمات"
                                    />
                                    <vs-select-item
                                        dir="auto"
                                        value="2"
                                        text="التجارة"
                                    />
                                    <vs-select-item
                                        dir="auto"
                                        value="3"
                                        text="الصناعة"
                                    />
                                    <vs-select-item
                                        dir="auto"
                                        value="4"
                                        text="الحرفية"
                                    />
                                </vs-select>
                                <div
                                    class="invalid-feedback"
                                    style="display: block !important"
                                    v-if="errors.errors.sector"
                                >
                                    {{ errors.errors.sector[0] }}
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <label class="form-label">Activity</label>
                                <vs-select
                                    width="100%"
                                    autocomplete
                                    class="selectExample"
                                    v-bind:class="{
                                        'is-invalid': errors.errors.activite
                                    }"
                                    v-model="orderinfos.activite"
                                >
                                    <vs-select-item
                                        :value="undefined"
                                        text="بدون تحديد"
                                    />
                                    <vs-select-item
                                        :key="index"
                                        :value="index"
                                        :text="item"
                                        v-for="(item, index) in Activites"
                                    />
                                </vs-select>
                                <div
                                    class="invalid-feedback"
                                    style="display: block !important"
                                    v-if="errors.errors.activite"
                                >
                                    {{ errors.errors.activite[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="col-lg-6 col-xl-6 mb-3">
                                <strong>Date created:</strong>
                                {{ orderinfos.date }}
                            </div>
                            <div class="col-lg-6 col-xl-6 mb-3">
                                <strong>Country, City:</strong>
                                <span
                                    v-if="
                                        orderinfos.place &&
                                            orderinfos.place != 'remotely'
                                    "
                                    >Morocco,
                                    {{
                                        citiesJson[orderinfos.place].ville
                                    }}</span
                                ><span v-else>Remotely</span>
                            </div>
                            <div class="col-lg-6 col-xl-6 mb-3">
                                <strong>Budget:</strong>
                                {{ orderinfos.budget }} MAD
                            </div>
                            <div class="col-lg-6 col-xl-6 mb-3">
                                <strong>Time:</strong> {{ orderinfos.time }} Day
                            </div>
                            <div class="col-lg-6 col-xl-6 mb-3">
                                <strong>Keywords: </strong>
                                <span
                                    v-for="(item, index) in orderinfos.keywords"
                                    :key="index"
                                    class=" mr-2 badge badge-pill badge-secondary"
                                    >{{ item }}</span
                                ><span
                                    v-if="
                                        orderinfos.keywords == null ||
                                            orderinfos.keywords == undefined
                                    "
                                    >undefined</span
                                >
                            </div>
                        </div>
                        <h5 class="card-title">Attached files</h5>

                        <div class="review-files-list">
                            <ul class="list-group list-group-flush">
                                <li
                                    v-for="(file, index) in orderinfos.files"
                                    :key="index"
                                    class="list-group-item"
                                >
                                    <a :href="file.file_url" target="_blank">{{
                                        file.filename
                                    }}</a>
                                </li>
                                <li
                                    v-if="
                                        orderinfos.files == null ||
                                            orderinfos.files.length < 1
                                    "
                                >
                                    No files found
                                </li>
                            </ul>
                        </div>
                        <hr class="my-4" />
                        <h5 class="card-title">Actions</h5>
                        <div class="mb-3">
                            <label for="decision" class="form-label"
                                >decision</label
                            >
                            <div id="decision">
                                <ul
                                    class="list-group list-group-flush"
                                    align="left"
                                >
                                    <li class="list-group-item">
                                        <vs-radio
                                            color="success"
                                            v-model="decision"
                                            vs-value="1"
                                            v-bind:class="{
                                                'is-invalid':
                                                    errors.errors.decision
                                            }"
                                            >Accept the request</vs-radio
                                        >
                                    </li>
                                    <li class="list-group-item">
                                        <vs-radio
                                            color="warning"
                                            v-model="decision"
                                            vs-value="2"
                                            v-bind:class="{
                                                'is-invalid':
                                                    errors.errors.decision
                                            }"
                                            >Rejection of the request with the
                                            possibility of
                                            modification</vs-radio
                                        >
                                    </li>
                                    <li class="list-group-item">
                                        <vs-radio
                                            color="danger"
                                            v-model="decision"
                                            vs-value="3"
                                            v-bind:class="{
                                                'is-invalid':
                                                    errors.errors.decision
                                            }"
                                            >Delete the request
                                            permanently</vs-radio
                                        >
                                    </li>
                                </ul>
                                <div
                                    class="invalid-feedback"
                                    style="display: block !important"
                                    v-if="errors.errors.decision"
                                >
                                    {{ errors.errors.decision[0] }}
                                </div>
                            </div>
                            <div v-if="decision == 2 || decision == 3">
                                <div class="mb-3">
                                    <vs-tooltip
                                        text="The user must be informed of the reason for which this decision was taken"
                                        position="right"
                                    >
                                        <label for="reason"
                                            >Reason for decision
                                            <i
                                                class="fa fa-info-circle"
                                            ></i></label
                                    ></vs-tooltip>
                                    <textarea
                                        dir="rtl"
                                        v-bind:class="{
                                            'is-invalid': errors.errors.reason
                                        }"
                                        id="reason"
                                        v-model="reason"
                                        class="form-control"
                                        cols="30"
                                        rows="10"
                                    ></textarea>
                                    <div
                                        class="invalid-feedback"
                                        style="display: block !important"
                                        v-if="errors.errors.reason"
                                    >
                                        {{ errors.errors.reason[0] }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <vs-tooltip
                                        text="This is how the message will look to the user"
                                        position="right"
                                        ><label for="reason"
                                            >Notification preview
                                            <i
                                                class="fa fa-info-circle"
                                            ></i></label
                                    ></vs-tooltip>

                                    <div class="text-wrapper alert alert-info">
                                        <p dir="rtl" class="text-right">
                                            <strong>مراحباََ</strong>
                                            <br />
                                            <br />
                                            يؤسفنا أن نعلمك أنه قد تم
                                            <span v-if="decision == 2"
                                                >رفض طلبك</span
                                            >
                                            <span v-if="decision == 3"
                                                >حذف طلبك</span
                                            >
                                            رقم #{{ orderinfos.OID }} (<a
                                                href="#"
                                                >{{ orderinfos.title }}</a
                                            >),
                                            <br />
                                            {{ reason }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            @click="ResetDecision"
                        >
                            cancel
                        </button>
                        <button
                            :disabled="
                                decision == null ||
                                    (decision == 2 && reason == '') ||
                                    (decision == 3 && reason == '')
                            "
                            type="button"
                            class="btn btn-primary"
                            id="apply_btn_28292710011"
                            @click="Apply"
                        >
                            apply
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ListCities from "/data/json/list-moroccan-cities.json";
import Activites1 from "/data/json/activite-ae-1.json";
import Activites2 from "/data/json/activite-ae-2.json";
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
    props: ["orderinfos"],
    data() {
        return {
            errors: new Errors(),
            citiesJson: ListCities,
            Activites: [],
            Activites2: Activites2,
            Activites1: Activites1,
            decision: null,
            reason: ""
        };
    },
    methods: {
    openLoadingInDiv: function () {
      $("#apply_btn_28292710011").html(
        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading...'
      );
      this.$vs.loading({
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      $("#apply_btn_28292710011").html("apply");
      this.$vs.loading.close();
    },
        Apply(){
            this.openLoadingInDiv();
            let data = new FormData();
            data.append("OID", this.orderinfos.OID);
            data.append("title", this.orderinfos.title);
            data.append("description", this.orderinfos.description);
            data.append("sector", this.orderinfos.sector);
            data.append("activite", this.orderinfos.activite);
            data.append("decision", this.decision);
            data.append("reason", this.reason);
            axios.post("/admin/ajax/order/pending/new/decision", data).then((response) => {
            this.errors = new Errors();
            this.HideLoadingInDiv();
            this.$vs.notify({
            title: "operation accomplished successfully",
            text: "The user will be notified of this action",
            color: "success",
            icon: "check",
          });
            }).catch((error) => {
            this.HideLoadingInDiv();

          if (error.response.status == 500) {
            this.errors = new Errors();
            this.$vs.notify({
              title: "Operation failed",
              text: "An error occurred in the system, please try again. If the error persists, please contact the technical department",
              color: "danger",
              icon: "warning",
            });
          } else if (error.response.status == 401) {
            this.$vs.notify({
              title: "Session over",
              text: "You must be logged in",
              color: "danger",
              position: "top-right",
              icon: "warning",
            });
            window.location.reload();
          }else if (error.response.status == 403) {
            this.errors = new Errors();
            this.$vs.notify({
              title: "غير مسموح ",
              text: error.response.data.error,
              color: "danger",
              icon: "warning",
            });
          } 
           else if (error.response.status == 422){
            this.errors.record(error.response.data);
            this.$vs.notify({
              title: "Operation failed ",
              text: "Please check the input",
              color: "danger",
              icon: "warning",
            });
          }else {
            this.errors = new Errors();
            this.$vs.notify({
              title: "Operation failed ",
              text: "Try again",
              color: "danger",
              icon: "warning",
            });
          }
            });
        },
        ResetDecision: function() {
            this.decision = null;
            this.reason = "";
        },
        SectorChange: function() {
            //  this.orderinfos.activite = null;

            if (this.orderinfos.sector == 1) {
                this.Activites = this.Activites2;
            } else if (
                this.orderinfos.sector == 2 ||
                this.orderinfos.sector == 3 ||
                this.orderinfos.sector == 4
            ) {
                this.Activites = this.Activites1;
            } else {
                this.Activites = [];
                this.orderinfos.activite = [];
            }
        }
    },
    mounted() {
        if (this.orderinfos.sector == 1) {
            this.Activites = this.Activites2;
        } else if (
            this.orderinfos.sector == 2 ||
            this.orderinfos.sector == 3 ||
            this.orderinfos.sector == 4
        ) {
            this.Activites = this.Activites1;
        } else {
            this.Activites = [];
            this.orderinfos.activite = [];
        }
    }
};
</script>
