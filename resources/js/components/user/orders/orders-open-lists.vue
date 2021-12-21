<template>
    <div>
        <!-- Mobile Filter Search -->
        <div
            class="offcanvas offcanvas-start"
            tabindex="-1"
            id="filter-search"
            aria-labelledby="filter-search-label"
        >
            <div class="offcanvas-header" align="right" dir="rtl">
                <h5 class="offcanvas-title" id="filter-search-label">
                    فلتر البحث
                </h5>
                <button
                    type="button"
                    class="btn-close text-reset"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                ></button>
            </div>
            <div class="offcanvas-body" align="right" dir="rtl">
                    <form align="right">
                        <div class="mb-4">
                            <label for="searchbox" class="form-label"
                                >كلمات مفتاحية</label
                            >

                            <input
                                id="searchbox"
                                type="text"
                                class="form-control"
                                v-model="query"
                                @change="Search"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="sector" class="form-label">
                                القطاع</label
                            >

                            <select
                                id="sector"
                                v-model="sector"
                                class="form-select"
                                @change="SectorChange"
                            >
                                <option value="">جميع القطاعات</option>
                                <option value="1">الخدمات</option>
                                <option value="2">التجارة</option>
                                <option value="3">الصناعة</option>
                                <option value="4">الحرفية</option>
                            </select>
                        </div>
                        <div v-if="sector != '' && sector != null" class="mb-4">
                            <label for="activite" class="form-label">
                                النشاط</label
                            >

                            <vs-select
                                @change="Search"
                                width="100%"
                                autocomplete
                                id="activite"
                                v-model="activite"
                            >
                                <vs-select-item text="جميع النشاطات" />

                                <vs-select-item
                                    :key="index"
                                    :value="index"
                                    :text="item"
                                    v-for="(item, index) in Activites"
                                />
                            </vs-select>
                        </div>
                        <div class="mb-3">
                            <label for="activite" class="form-label">
                                مكان الانجاز</label
                            >
                            <div class="mb-3">
                                <label class="form-label">عن بعد </label>
                                <vs-switch
                                    v-model="remotely"
                                    color="success"
                                    vs-icon-off="close"
                                    vs-icon-on="check"
                                    @change="Search"
                                />
                            </div>

                            <vs-select
                                v-if="!remotely"
                                @change="Search"
                                width="100%"
                                autocomplete
                                id="city"
                                v-model="city"
                                placeholder="المدينة"
                            >
                                <vs-select-item value="" text="جميع المدن" />
                                <vs-select-item
                                    :key="index"
                                    :value="item.id"
                                    :text="item.ville"
                                    v-for="(item, index) in citiesJson"
                                />
                            </vs-select>
                        </div>
                        <div class="mb-3 mt-5">
                            <label class="form-label">الميزانية</label>
                            <vs-slider
                                step="100"
                                ticks
                                text-fixed=" درهم "
                                color="#f96a0c"
                                max="500000"
                                :min="150"
                                v-model.lazy="budget"
                                @change="Search"
                            />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="" class="form-label">مدة التنفيذ</label>
                            <vs-select
                                @change="Search"
                                width="100%"
                                v-model="time"
                            >
                                <vs-select-item value="180" text="الكل" />
                                <vs-select-item
                                    value="7"
                                    text="أقل من أسبوع واحد"
                                />
                                <vs-select-item
                                    value="14"
                                    text="أقل من أسبوعين "
                                />
                                <vs-select-item value="30" text="أقل من شهر " />
                                <vs-select-item
                                    value="60"
                                    text="أقل من شهرين "
                                />
                                <vs-select-item
                                    value="90"
                                    text="أقل من 3 أشهر "
                                />
                                <vs-select-item
                                    value="120"
                                    text="أقل من 4 أشهر "
                                />
                                <vs-select-item
                                    value="150"
                                    text="أقل من 5 أشهر "
                                />
                                <vs-select-item
                                    value="180"
                                    text="أقل من 6 أشهر "
                                />
                            </vs-select>
                        </div>
                        <div class="d-grid gap-2 mt-5">
                            <button
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"
                                @click="Search"
                                class="btn btn-primary"
                                type="button"
                            >
                                البحث
                            </button>

                            <button
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"
                                @click="reset"
                                class="btn btn-outline-primary"
                                type="button"
                            >
                                اعادة التعيين
                            </button>
                        </div>
                    </form>
            </div>
        </div>
        <!-- Mobile Filter Search -->

        <div class="container mb-5 mt-2">
            <div class="filter-mobile-toggle">
                <button
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#filter-search"
                    aria-controls="filter-search"
                    class="filter-mobile-toggle-btn"
                >
                    <i class="fas fa-sliders-h"></i>
                </button>
            </div>
            <div class="row justify-content-md-center" dir="rtl">
                <div class="col-sm col-lg-3 filter-search-web">
                    <form align="right">
                        <div class="mb-4">
                            <label for="searchbox" class="form-label"
                                >كلمات مفتاحية</label
                            >

                            <input
                                id="searchbox"
                                type="text"
                                class="form-control"
                                v-model="query"
                                @change="Search"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="sector" class="form-label">
                                القطاع</label
                            >

                            <select
                                id="sector"
                                v-model="sector"
                                class="form-select"
                                @change="SectorChange"
                            >
                                <option value="">جميع القطاعات</option>
                                <option value="1">الخدمات</option>
                                <option value="2">التجارة</option>
                                <option value="3">الصناعة</option>
                                <option value="4">الحرفية</option>
                            </select>
                        </div>
                        <div v-if="sector != '' && sector != null" class="mb-4">
                            <label for="activite" class="form-label">
                                النشاط</label
                            >

                            <vs-select
                                @change="Search"
                                width="100%"
                                autocomplete
                                id="activite"
                                v-model="activite"
                            >
                                <vs-select-item text="جميع النشاطات" />

                                <vs-select-item
                                    :key="index"
                                    :value="index"
                                    :text="item"
                                    v-for="(item, index) in Activites"
                                />
                            </vs-select>
                        </div>
                        <div class="mb-3">
                            <label for="activite" class="form-label">
                                مكان الانجاز</label
                            >
                            <div class="mb-3">
                                <label class="form-label">عن بعد </label>
                                <vs-switch
                                    v-model="remotely"
                                    color="success"
                                    vs-icon-off="close"
                                    vs-icon-on="check"
                                    @change="Search"
                                />
                            </div>

                            <vs-select
                                v-if="!remotely"
                                @change="Search"
                                width="100%"
                                autocomplete
                                id="city"
                                v-model="city"
                                placeholder="المدينة"
                            >
                                <vs-select-item value="" text="جميع المدن" />
                                <vs-select-item
                                    :key="index"
                                    :value="item.id"
                                    :text="item.ville"
                                    v-for="(item, index) in citiesJson"
                                />
                            </vs-select>
                        </div>
                        <div class="mb-3 mt-5">
                            <label class="form-label">الميزانية</label>
                            <vs-slider
                                step="100"
                                ticks
                                text-fixed=" درهم "
                                color="#f96a0c"
                                max="500000"
                                :min="150"
                                v-model.lazy="budget"
                                @change="Search"
                            />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="" class="form-label">مدة التنفيذ</label>
                            <vs-select
                                @change="Search"
                                width="100%"
                                v-model="time"
                            >
                                <vs-select-item value="180" text="الكل" />
                                <vs-select-item
                                    value="7"
                                    text="أقل من أسبوع واحد"
                                />
                                <vs-select-item
                                    value="14"
                                    text="أقل من أسبوعين "
                                />
                                <vs-select-item value="30" text="أقل من شهر " />
                                <vs-select-item
                                    value="60"
                                    text="أقل من شهرين "
                                />
                                <vs-select-item
                                    value="90"
                                    text="أقل من 3 أشهر "
                                />
                                <vs-select-item
                                    value="120"
                                    text="أقل من 4 أشهر "
                                />
                                <vs-select-item
                                    value="150"
                                    text="أقل من 5 أشهر "
                                />
                                <vs-select-item
                                    value="180"
                                    text="أقل من 6 أشهر "
                                />
                            </vs-select>
                        </div>
                        <div class="d-grid gap-2 mt-5">
                            <button
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"
                                @click="Search"
                                class="btn btn-primary"
                                type="button"
                            >
                                البحث
                            </button>

                            <button
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"
                                @click="reset"
                                class="btn btn-outline-primary"
                                type="button"
                            >
                                اعادة التعيين
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm">
                    <div
                        id="div-with-loading"
                        class="box-left card p-4 vs-con-loading__container"
                    >
                        <div
                            v-if="nodata == true"
                            class="no-data-message text-center mt-4 mb-4"
                        >
                            لاتوجد بيانات لعرضها
                        </div>
                        <div
                            v-if="stopLazyLoading != true"
                            class="lazy-load-box"
                        >
                            <div
                                v-for="index in 5"
                                :key="index"
                                class="lazy-load-ae-content"
                            >
                                <div class="row">
                                    <div class="col">
                                        <div
                                            class="lazy-load-ae load-name"
                                        ></div>
                                        <div
                                            class="lazy-load-ae down-name"
                                        ></div>
                                    </div>
                                </div>
                                <div
                                    class="lazy-load-ae load-description lazy-order"
                                ></div>
                            </div>
                        </div>

                        <div
                            class="box-article pb-3 mb-4"
                            v-for="(item, index) in listData"
                            :key="index"
                        >
                            <a :href="'/order/' + item.OID">
                                <div class="head-box-article">
                                    <div class="row text-center">
                                        <div class="col">
                                            <h1
                                                align="right"
                                                class="title-box-article"
                                            >
                                                {{ item.title }}
                                            </h1>
                                        </div>
                                        <div class="col-3">
                                            <div
                                                align="left"
                                                class="box-article-cta"
                                            >
                                                <button
                                                    align="left"
                                                    type="button"
                                                    class="btn btn-primary btn-sm bid-mobile-icon"
                                                >
                                                    قدم عرضك
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="user-info-box-article">
                                                <div
                                                    class="row"
                                                    onclick="redirectUserPage(event,11)"
                                                >
                                                    <div class="col-auto">
                                                        <div
                                                            class="user-info-box-article-avatar"
                                                        >
                                                            <img
                                                                v-if="
                                                                    item.user
                                                                        .avatar !=
                                                                        '' &&
                                                                        item
                                                                            .user
                                                                            .avatar !=
                                                                            null
                                                                "
                                                                :src="
                                                                    item.user
                                                                        .avatar
                                                                "
                                                                :alt="
                                                                    item.user
                                                                        .username
                                                                "
                                                            />
                                                            <img
                                                                src="/img/icons/avatar.png"
                                                                :alt="
                                                                    item.user
                                                                        .username
                                                                "
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="user-info-box-article-name"
                                                        >
                                                            <h5
                                                                class="user-info-box-article-name-h5"
                                                            >
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
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="user-info-box-article">
                                                <i
                                                    class="fas fa-map-marker-alt"
                                                ></i>
                                                <span
                                                    v-if="
                                                        item.place &&
                                                            item.place !=
                                                                'remotely'
                                                    "
                                                    >{{
                                                        citiesJson[item.place]
                                                            .ville
                                                    }}, المغرب</span
                                                >
                                                <span v-else>عن بعد</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="user-info-box-article">
                                                <i
                                                    class="fas fa-ticket-alt"
                                                ></i>
                                                {{ item.OffersCount }}
                                                <span
                                                    v-if="
                                                        item.OffersCount > 1 &&
                                                            item.OffersCount <
                                                                11
                                                    "
                                                    >عروض</span
                                                >
                                                <span v-else>عرض</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="body-box-article mb-3">
                                    <p
                                        class="box-article-description font-Naskh"
                                    >
                                        {{ item.description }}
                                    </p>
                                </div>
                                <div></div>
                            </a>
                        </div>
                    </div>

                    <div class="show-more-section text-center mt-5">
                        <button
                            v-if="allresponse.next_page_url != null"
                            style="margin-right: 0 !important"
                            type="button"
                            class="btn btn-primary text-center"
                            @click="ShowMore"
                        >
                            مشاهدة المزيد
                        </button>
                        <button
                            v-else
                            style="margin-right: 0 !important"
                            type="button"
                            class="btn btn-primary text-center"
                            disabled
                        >
                            نهاية النتائج
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ListCities from "../../../../../public/data/json/list-moroccan-cities.json";
import Activites1 from "../../../../../public/data/json/activite-ae-1.json";
import Activites2 from "../../../../../public/data/json/activite-ae-2.json";
export default {
    data() {
        return {
            citiesJson: ListCities,
            allresponse: [],
            listData: [],
            stopLazyLoading: false,
            nodata: false,
            query: "",
            sector: "",
            activite: null,
            city: "",
            Activites: [],
            remotely: false,
            budget: [150, 500000],
            time: 180,
            typeget: "all"
        };
    },
    methods: {
        reset() {
            this.activite = null;
            this.query = "";
            this.city = "";
            this.sector = "";
            this.remotely = false;
            this.budget = [150, 500000];
            this.time = 180;

            this.getData();
        },
        openLoadingInDiv() {
            this.$vs.loading({
                container: "#div-with-loading",
                scale: 0.6,
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv() {
            this.$vs.loading.close("#div-with-loading > .con-vs-loading");
        },
        SectorChange: function() {
            this.activite = null;
            if (this.sector == 1) {
                this.Activites = Activites2;
            } else if (
                this.sector == 2 ||
                this.sector == 3 ||
                this.sector == 4
            ) {
                this.Activites = Activites1;
            } else {
                this.Activites = [];
                this.activite_selected = [];
            }
            this.Search();
        },
        getData() {
            this.stopLazyLoading = false;
            this.typeget = "all";
            axios
                .get("/ajax/orders/all")
                .then(response => {
                    this.allresponse = response.data;
                    this.listData = this.allresponse.data;
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
                    this.stopLazyLoading = true;

                    console.error(error);
                });
        },
        ShowMore() {
            this.openLoadingInDiv();

            if (this.allresponse.next_page_url != null) {
                axios
                    .get(
                        "/ajax/orders/" +
                            this.typeget +
                            "/?page=" +
                            (parseInt(this.allresponse.current_page) + 1)
                    )
                    .then(response => {
                        this.allresponse = response.data;
                        const entries = Object.values(this.allresponse.data);

                        for (var i = 0; entries.length > i; i++) {
                            this.listData.push(entries[i]);
                        }
                        this.HideLoadingInDiv();
                    });
            } else {
                console.log(null);
            }
        },
        Search() {
            this.typeget = "search";
            this.openLoadingInDiv();
            let data = new FormData();
            if (this.query != null) {
                data.append("q", this.query);
            } else {
                data.append("q", "");
            }

            if (this.sector != null) {
                data.append("s", this.sector);
            } else {
                data.append("s", "");
            }

            if (this.activite != null) {
                data.append("a", this.activite);
            } else {
                data.append("a", "");
            }

            if (this.city != null && this.remotely != true) {
                data.append("c", this.city);
            } else if (this.remotely == true) {
                data.append("c", "remotely");
            } else {
                data.append("c", "");
            }
            data.append("b", this.budget);
            data.append("t", this.time);

            axios.post("/ajax/orders/search", data).then(response => {
                this.allresponse = response.data;
                this.listData = response.data.data;
                if (
                    this.listData == undefined ||
                    this.listData == null ||
                    this.listData == ""
                ) {
                    this.nodata = true;
                } else {
                    this.nodata = false;
                }
                this.HideLoadingInDiv();
            });
        }
    },
    created() {
        this.getData();
    }
};
</script>
