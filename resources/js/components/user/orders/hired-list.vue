<template>
    <div>
        <button hidden id="profile-tab" @click="getHired"></button>
        <canceling-contract :oid="oid" :userid="userid"></canceling-contract>
        <rate-ae></rate-ae>
        <!-- -->
        <div v-if="stopLazyLoading != true" class="lazy-load-box">
            <div v-for="index in 5" :key="index" class="lazy-load-ae-content">
                <div class="row">
                    <div class="col-auto lazy-load-ae load-avatar"></div>
                    <div class="col">
                        <div class="lazy-load-ae load-name"></div>
                        <div class="lazy-load-ae down-name"></div>
                    </div>
                </div>
                <div class="lazy-load-ae load-description"></div>
            </div>
        </div>
        <div
            v-if="nodata == true"
            class="no-data-message text-center mt-5 mb-4"
        >
            <img
                src="/img/icons/215-SEARCH-AE.jpg"
                alt="   لم تقم بتوظيف مقاول بعد في هذا المشروع"
            />
            لم تقم بتوظيف مقاول ذاتي بعد في هذا المشروع
            <p class="font-Naskh">
                أختر من بين العروض المقدمة على طلبك أفضل عرض وقم بتوظيف مقاول أو
                مجموعة من المقاولين الذاتيين
            </p>
        </div>
        <div>
        <div
            v-for="(item, index) in listData"
            :key="index"
            class="box-article pb-3 mb-3"
        >
            <div>
                <div class="head-box-article">
                    <div class="row text-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-auto position-relative">
                                    <span
                                        v-if="item.isOnline"
                                        class="
                              position-absolute
                              bottom-0
                              start-100
                              translate-middle
                              p-2
                              bg-success
                              online-status
                              Search-status-user
                              border border-light
                              rounded-circle
                            "
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="متصل"
                                    >
                                        <span class="visually-hidden"
                                            >Online</span
                                        >
                                    </span>
                                    <a :href="'/@' + item.user.username">
                                        <div class="avatar-large-box-article">
                                            <img
                                                v-if="
                                                    item.user.avatar != '' &&
                                                        item.user.avatar != null
                                                "
                                                :src="'/' + item.user.avatar"
                                                :alt="item.user.username"
                                            />
                                            <img
                                                src="/img/icons/avatar.png"
                                                :alt="item.user.username"
                                            /></div
                                    ></a>
                                </div>
                                <div class="col-auto">
                                    <div class="user-name-box-article">
                                        <a :href="'/@' + item.user.username">
                                            <h4>
                                                {{
                                                    item.user.frist_name[0].toUpperCase() +
                                                        item.user.frist_name.substring(
                                                            1
                                                        )
                                                }}
                                                {{
                                                    item.user.last_name[0].toUpperCase() +
                                                        item.user.last_name.substring(
                                                            1
                                                        )
                                                }}
                                                <vs-tooltip
                                                    style="display: initial !important"
                                                    text="حساب مقاول ذاتي تم التحقق منه"
                                                >
                                                    <span
                                                        v-if="
                                                            item.verified_account ==
                                                                2
                                                        "
                                                        style="margin-right: 0px !important"
                                                        class="
                                    verified-icon verified-2
                                    mt-2
                                    text-icon
                                  "
                                                        dir="rtl"
                                                    ></span>
                                                </vs-tooltip>
                                                <vs-tooltip
                                                    style="display: initial !important"
                                                    text="حساب تم التحقق منه"
                                                >
                                                    <span
                                                        v-if="
                                                            item.verified_account ==
                                                                1
                                                        "
                                                        style="margin-right: 0px !important"
                                                        class="
                                    verified-icon verified-1
                                    mt-2
                                    text-icon
                                  "
                                                        dir="rtl"
                                                    ></span>
                                                </vs-tooltip></h4
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto mobile-hidden-1">
                            <div class="row">
                                <div class="col-auto p-1">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                                <div class="col-auto p-1 ">
                                    <span class="dropdown">
                                                    <button
                                                        class="btn btn-outline-primary btn-sm"
                                                        id="menu_user"
                                                        data-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >
                                                        <i
                                                            class="fas fa-ellipsis-v"
                                                        ></i>
                                                    </button>
                                                    <ul
                                                        class="dropdown-menu"
                                                        aria-labelledby="menu_user"
                                                    >
                                                        <li @click="userid = item.Account_number">
                                                            <a
                                                                class="dropdown-item"
                                                                type="button"
                                                                data-toggle="modal"
                                                                data-target="#canceling-ae-contract"
                                                                >الغاء العقد</a
                                                            >
                                                        </li>
                          
                                                    </ul>
                                                </span>
                       
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mr-65 mmt-35">
                        <div class="col-auto">
                            <div class="user-info-box-article">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                           
                                                <span
                                                    id="rating-section"
                                                    class="user-rating-stars"
                                                    dir="rtl"
                                                >
                                                    <i
                                                        v-for="n in 5"
                                                        :key="n"
                                                        :class="
                                                            n <=
                                                            parseInt(
                                                                item.userRating
                                                            )
                                                                ? 'fas fa-star'
                                                                : 'far fa-star'
                                                        "
                                                    ></i>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <i class="fas fa-briefcase"></i>
                                            {{ item.AeAccount.job_title }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="user-info-box-article">
                                <i class="fas fa-map-marker-alt"></i>
                                المغرب, {{ item.city }}
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="OrderCreator" class="mr-65 p-2">
                    <vs-tooltip
                        style="width: max-content"
                        text="التكلفة - مدة التنفيذ"
                    >
                        <span class="text-brand cur-p" dir="rtl"
                            ><strong
                                >{{ item.price }} درهم -
                                {{ item.time }} يوم</strong
                            ></span
                        >
                    </vs-tooltip>
                </div>
                <span v-if="item.status == 1" class="badge bg-warning mr-65"
                    >موظف</span
                >
                <div class="mr-65" id="text-wraper-desky" >
                    <p
                        class="box-article-description font-Naskh text-wrap-line collapse TextCollapse"
                   :id="'TextCollapse'+index" aria-expanded="false">
                        {{ item.description }}
                    </p>
                      <a role="button" class="collapsed" data-toggle="collapse" :href="'#TextCollapse'+index" aria-expanded="false" :aria-controls="'TextCollapse'+index"></a>
                </div>
                <div v-if="item.NeedRating" class="mt-3" align="left">
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#Rate_modal"
                ><i class="fas fa-star"></i> تقييم</button>

                </div>
            </div>
        </div>
        </div>



        <div
            v-if="listData.length > 0"
            class="show-more-section text-center"
        >
            <button
                v-if="
                    allresponse.data.next_page_url &&
                        allresponse.data.next_page_url != null
                "
                style="margin-right: 0 !important"
                type="button"
                class="btn btn-primary text-center"
                @click="ShowMore"
            >
                مشاهدة المزيد
            </button>
            <button
            hidden
                v-else
                style="margin-right: 0 !important"
                type="button"
                class=" end-data-btn text-center"
                disabled
            >
                نهائة النتائج
            </button>
        </div>

        <!-- -->
    </div>
</template>
<script>
export default {
    props: ["oid", "status"],
    data() {
        return {
            stopLazyLoading: false,
            allresponse: [],
            nodata: false,
            listData: [],
            OrderCreator: false,
            userid: null

        };
    },
    methods: {
        getHired() {
            let data = new FormData();
            data.append("OID", this.oid);
            axios
                .post("/ajax/orders/offers/hired", data)
                .then(response => {
                    this.allresponse = response.data;
                    this.listData = this.allresponse.data.data;
                    this.OrderCreator = this.allresponse.OrderCreator;
                    if (
                        this.listData == undefined ||
                        this.listData == null ||
                        this.listData == ""
                    ) {
                        this.nodata = true;
                    } else {
                        this.nodata = false;
                    }
                    this.stopLazyLoading = true;
                })
                .catch(error => {
                    console.log(error);
                    this.stopLazyLoading2 = true;
                });
        },
        ShowMore() {
            this.openLoadingInDiv();
            let data = new FormData();
            data.append("OID", this.oid);
            if (this.allresponse.data.next_page_url != null) {
                axios
                    .post(
                        "/ajax/orders/offers/hired/?page=" +
                            (parseInt(this.allresponse.data.current_page) + 1),
                        data
                    )
                    .then(response => {
                        this.allresponse = response.data;
                        const entries = Object.values(
                            this.allresponse.data.data
                        );

                        for (var i = 0; entries.length > i; i++) {
                            this.listData.push(entries[i]);
                        }
                        this.HideLoadingInDiv();
                    });
            } else {
                console.log(null);
            }
        }
    },
    created() {
        this.getHired();
    },
    mounted() {

    }
};
</script>
