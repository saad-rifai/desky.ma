<template>
    <div>
        <div class="">
            <div id="div-with-loading_853791254" class="vs-con-loading__container">
                <div
                    v-if="nodata == true"
                    class="no-data-message text-center mt-4 mb-4"
                >
                    لاتوجد بيانات لعرضها
                </div>
                <div v-if="stopLazyLoading != true" class="lazy-load-box">
                    <div
                        v-for="index in 5"
                        :key="index"
                        class="lazy-load-ae-content"
                    >
                        <div class="row">
                            <div class="col">
                                <div class="lazy-load-ae load-name"></div>
                                <div class="lazy-load-ae down-name"></div>
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
                                    <h1 align="right" class="title-box-article">
                                        {{ item.title }}
                                    </h1>
                                </div>
                                <div class="col-3">
                                    <div align="left" class="box-article-cta">
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
                                                            item.user.avatar !=
                                                                '' &&
                                                                item.user
                                                                    .avatar !=
                                                                    null
                                                        "
                                                        :src="item.user.avatar"
                                                        :alt="
                                                            item.user.username
                                                        "
                                                    />
                                                    <img
                                                        src="/img/icons/avatar.png"
                                                        :alt="
                                                            item.user.username
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
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span
                                            v-if="
                                                item.place &&
                                                    item.place != 'remotely'
                                            "
                                            >{{ citiesJson[item.place].ville }},
                                            المغرب</span
                                        >
                                        <span v-else>عن بعد</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="user-info-box-article">
                                        <i class="fas fa-ticket-alt"></i>
                                        {{ item.OffersCount }}
                                        <span
                                            v-if="
                                                item.OffersCount > 1 &&
                                                    item.OffersCount < 11
                                            "
                                            >عروض</span
                                        >
                                        <span v-else>عرض</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body-box-article mb-3">
                            <p class="box-article-description font-Naskh">
                                {{ item.description }}
                            </p>
                        </div>
                        <div></div>
                    </a>
                </div>
            </div>

            <div class="show-more-section text-center mt-5">
                <a href="/orders?ref=dashboard"><button
                    style="margin-right: 0 !important"
                    type="button"
                    class="btn btn-primary btn-sm text-center"
                >
                    مشاهدة المزيد
                </button></a>
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
            typeget: "all",
        };
    },
    methods: {

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
    },
    created(){
        this.getData();
    }
};
</script>
