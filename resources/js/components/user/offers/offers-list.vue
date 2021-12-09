<template>
    <div>
        <edit-offer :oid="oid"></edit-offer>
        <button
            hidden
            id="openUpdateOrderStatusModal"
            type="button"
            data-toggle="modal"
            data-target="#modal-order-update-status"
        ></button>
        <report-popup
            about="0"
            :from_url="from_url"
            :to="reportTo"
        ></report-popup>
        <canceling-contract :oid="oid" :userid="userid"></canceling-contract>
        <!-- Modal -->
        <div
            class="modal fade"
            id="modal-accept-offer"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
            dir="rtl"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg vs-con-loading__container"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
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
                            <div class="modal-art-icon">
                                <img
                                    src="/img/icons/Consulting-bro.jpg"
                                    alt="قبول عرض مقاول ذاتي desky"
                                />
                            </div>
                            <p>
                                هل انت متأكد من أنك تود قبول هذا العرض والتعاقد
                                مع هذا المقاول الذاتي
                                <strong>{{ contract_aename }}</strong> ؟
                            </p>

                            <p>مدة العقد: {{ contract_duration }} يوم</p>
                            <p>
                                تكلفة العقد:
                                <strong>{{ contract_price }} درهم</strong>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary btn-sm"
                            data-dismiss="modal"
                            id="close-modal-btn-4587"
                        >
                            الغاء
                        </button>
                        <button
                            type="button"
                            id="btnsend"
                            @click="AcceptOffer"
                            class="btn btn-success btn-sm"
                        >
                            تأكيد
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL ACCEPT OFFER -->

        <!-- MODAL CHANGE ORDER STATUS -->
        <div
            class="modal fade"
            id="modal-order-update-status"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel124"
            aria-hidden="true"
            dir="rtl"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg vs-con-loading__container"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel124">
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
                                هل لازلت تود تلقي عروض جديدة من المقاولين
                                الذاتيين على هذه الصفقة ؟
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
        <div
            class="card mb-4 position-relative vs-con-loading__container"
            id="div-with-loading12"
        >
            <!--h1 class="card-title mb-4 mt-2" style="font-size: 16px">العروض</h1-->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link active"
                        id="home-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#offers"
                        type="button"
                        role="tab"
                        aria-controls="offers"
                        aria-selected="true"
                        @click="getNewOffer"
                    >
                        العروض ({{ listData.length }})
                    </button>
                </li>
                <li v-if="OrderCreator" class="nav-item" role="presentation">
                    <button
                        class="nav-link"
                        id="profile-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#hire"
                        type="button"
                        role="tab"
                        aria-controls="hire"
                        aria-selected="false"
                        @click="getHired"
                    >
                        الموظفون ({{ listData2.length }})
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div
                    class="tab-pane fade show active mb-3 p-3 body-card-text"
                    id="offers"
                    role="tabpanel"
                    aria-labelledby="home-tab"
                >
                    <div v-if="stopLazyLoading != true" class="lazy-load-box">
                        <div
                            v-for="index in 5"
                            :key="index"
                            class="lazy-load-ae-content"
                        >
                            <div class="row">
                                <div
                                    class="col-auto lazy-load-ae load-avatar"
                                ></div>
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
                        class="no-data-message text-center mt-4 mb-4"
                    >
                        لاتوجد عروض بعد
                    </div>
                    <div>
                        <div
                            v-for="(item, index) in listData"
                            :key="index"
                            class="box-article pb-3 mb-3"
                        >
                            <div
                                :id="item.id"
                                v-bind:class="{
                                    'box-highlight': offerget == item.id
                                }"
                            >
                                <a :href="'/@' + item.user.username">
                                    <div class="head-box-article">
                                        <div class="row text-center">
                                            <div class="col">
                                                <div class="row">
                                                    <div
                                                        class="col-auto position-relative"
                                                    >
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
                              mb-status-hide
                            "
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="متصل"
                                                        >
                                                            <span
                                                                class="visually-hidden"
                                                                >Online</span
                                                            >
                                                        </span>

                                                        <div
                                                            class="avatar-large-box-article mb-avatar-size"
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
                                                                    '/' +
                                                                        item
                                                                            .user
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
                                                            class="user-name-box-article"
                                                        >
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
                                                                </vs-tooltip>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="user-info-box-article"
                                                        >
                                                            <div class="row">
                                                                <div
                                                                    class="col-auto"
                                                                >
                                                                    <div
                                                                        class="user-info-box-article"
                                                                    >
                                                                        <vs-tooltip
                                                                            v-bind:text="
                                                                                parseFloat(
                                                                                    item.userRating
                                                                                ).toFixed(
                                                                                    1
                                                                                ) >=
                                                                                0
                                                                                    ? parseFloat(
                                                                                          item.userRating
                                                                                      ).toFixed(
                                                                                          1
                                                                                      )
                                                                                    : '0'
                                                                            "
                                                                        >
                                                                            <span
                                                                                id="rating-section"
                                                                                class="user-rating-stars"
                                                                                dir="rtl"
                                                                            >
                                                                                <i
                                                                                    v-for="n in 5"
                                                                                    :key="
                                                                                        n
                                                                                    "
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
                                                                        </vs-tooltip>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="col-auto mobile-btn-act-position"
                                            >
                                                <button
                                                    v-if="
                                                        item.Account_number ==
                                                            myaccountnumber
                                                    "
                                                    @click.prevent
                                                    type="button"
                                                    data-toggle="modal"
                                                    data-target="#modal_pr1825"
                                                    class="btn btn-outline-primary btn-sm "
                                                >
                                                    <i class="fas fa-eye"> </i>
                                                </button>
                                                <button
                                                    v-if="
                                                        item.Account_number ==
                                                            myaccountnumber &&
                                                            AllowdToEdit
                                                    "
                                                    @click.prevent
                                                    type="button"
                                                    data-toggle="modal"
                                                    data-target="#modal_kr1825"
                                                    class="btn btn-outline-primary btn-sm"
                                                >
                                                    <i class="fas fa-edit"> </i>
                                                </button>

                                                <button
                                                    v-if="
                                                        item.Account_number !=
                                                            myaccountnumber
                                                    "
                                                    class="btn btn-primary btn-sm mobile-hidden-1"
                                                >
                                                    <i
                                                        class="fas fa-envelope"
                                                    ></i>
                                                </button>
                                                <span
                                                    class="dropdown"
                                                    v-if="
                                                        item.Account_number !=
                                                            myaccountnumber
                                                    "
                                                >
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
                                                        <li>
                                                            <a
                                                                class="dropdown-item"
                                                                href="#"
                                                                >مراسلة</a
                                                            >
                                                        </li>
                                                        <li
                                                            @click="
                                                                reportTo =
                                                                    item.Account_number
                                                            "
                                                        >
                                                            <a
                                                                class="dropdown-item"
                                                                type="button"
                                                                data-toggle="modal"
                                                                data-target="#reportModal"
                                                                >التبليغ</a
                                                            >
                                                        </li>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mg-mb">
                                            <div class="col-auto">
                                                <div
                                                    class="user-info-box-article"
                                                >
                                                    <i
                                                        class="fas fa-briefcase"
                                                    ></i>
                                                    {{
                                                        item.AeAccount.job_title
                                                    }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div
                                                    class="user-info-box-article"
                                                >
                                                    <i
                                                        class="fas fa-map-marker-alt"
                                                    ></i>
                                                    المغرب, {{ item.city }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div v-if="OrderCreator" class="text-wraper-desky-mg p-2">
                                    <vs-tooltip
                                        style="width: max-content"
                                        text="التكلفة - مدة التنفيذ"
                                    >
                                        <span
                                            class="text-brand cur-p"
                                            dir="rtl"
                                        >
                                            <strong>
                                                {{ item.price }} درهم -
                                                {{ item.time }} يوم
                                            </strong>
                                        </span>
                                    </vs-tooltip>
                               <span
                                        v-if="item.status == 1"
                                        class="badge bg-warning "
                                        >موظف</span
                                    >
                                    <span
                                        v-if="item.status == 2"
                                        class="badge bg-success "
                                        >انتهى العقد</span
                                    >
                                    <span
                                        v-if="item.status == 3"
                                        class="badge bg-danger"
                                        >ملغي</span
                                    >
                                </div>
              

                                <div
                                    class="text-wraper-desky-mg"
                                    v-if="OrderCreator"
                                    id="text-wraper-desky">
                                    <p
                                        class="box-article-description font-Naskh text-wrap-line collapse TextCollapse"
                                        :id="'TextCollapse2' + index"
                                        aria-expanded="false"
                                    >
                                    {{ item.description }}
                                    </p>
                                    <a
                                        role="button"
                                        class="collapsed"
                                        data-toggle="collapse"
                                        :href="'#TextCollapse2' + index"
                                        aria-expanded="false"
                                        :aria-controls="'TextCollapse2' + index"
                                    ></a>
                                </div>

                                <div
                                    v-if="OrderCreator && item.status == 0"
                                    class="order-act-section"
                                    align="left"
                                    dir="ltr"
                                >
                                    <div class="row">
                                        <div class="col-auto">
                                            <button
                                                type="button"
                                                @click="
                                                    activePromptCheck = true;
                                                    userid =
                                                        item.user
                                                            .Account_number;
                                                    contract_aename =
                                                        item.user.frist_name[0].toUpperCase() +
                                                        item.user.frist_name.substring(
                                                            1
                                                        ) +
                                                        ' ' +
                                                        item.user.last_name[0].toUpperCase() +
                                                        item.user.last_name.substring(
                                                            1
                                                        );
                                                    contract_price = item.price;
                                                    contract_duration =
                                                        item.time;
                                                "
                                                class="btn btn-primary btn-sm"
                                                data-toggle="modal"
                                                data-target="#modal-accept-offer"
                                            >
                                                <i class="fas fa-check"></i>
                                                قبول العرض
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <button
                                                type="button"
                                                class="btn btn-outline-primary btn-sm"
                                            >
                                                <i class="fas fa-envelope"></i>
                                                مراسلة
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        v-if="listData.length > 0"
                        class="show-more-section text-center "
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
                            class="text-center end-data-btn"
                            disabled
                        >
                            نهائة النتائج
                        </button>
                    </div>
                </div>

                <div
                    class="tab-pane fade p-3 body-card-text"
                    id="hire"
                    role="tabpanel"
                    aria-labelledby="home-tab"
                    v-if="OrderCreator"
                >
                    <!-- -->
                    <div v-if="stopLazyLoading2 != true" class="lazy-load-box">
                        <div
                            v-for="index in 5"
                            :key="index"
                            class="lazy-load-ae-content"
                        >
                            <div class="row">
                                <div
                                    class="col-auto lazy-load-ae load-avatar"
                                ></div>
                                <div class="col">
                                    <div class="lazy-load-ae load-name"></div>
                                    <div class="lazy-load-ae down-name"></div>
                                </div>
                            </div>
                            <div class="lazy-load-ae load-description"></div>
                        </div>
                    </div>
                    <div
                        v-if="nodata2 == true"
                        class="no-data-message text-center mt-5 mb-4"
                    >
                        <img
                            src="/img/icons/215-SEARCH-AE.jpg"
                            alt="   لم تقم بتوظيف مقاول بعد في هذا المشروع"
                        />
                        لم تقم بتوظيف مقاول ذاتي بعد في هذا المشروع
                        <p class="font-Naskh">
                            أختر من بين العروض المقدمة على طلبك أفضل عرض وقم
                            بتوظيف مقاول أو مجموعة من المقاولين الذاتيين
                        </p>
                    </div>
                    <div
                        v-for="(item, index) in listData2"
                        :key="index"
                        class="box-article pb-3 mb-3"
                    >
                        <div
                            v-bind:class="{
                                'box-highlight': offerget2 == item.id
                            }"
                        >
                            <div class="head-box-article">
                                <div class="row text-center">
                                    <div class="col">
                                        <div class="row ">
                                            <div
                                                class="col-auto position-relative"
                                            >
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
                              rounded-circle"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="متصل">
                                                    <span
                                                        class="visually-hidden"
                                                        >Online</span>
                                                </span>
                                                <a
                                                    :href="
                                                        '/@' +
                                                            item.user.username
                                                    "
                                                >
                                                    <div
                                                        class="avatar-large-box-article mb-avatar-size"
                                                    >
                                                        <img
                                                            v-if="
                                                                item.user
                                                                    .avatar !=
                                                                    '' &&
                                                                    item.user
                                                                        .avatar !=
                                                                        null
                                                            "
                                                            :src="
                                                                '/' +
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
                                                        /></div
                                                ></a>
                                            </div>
                                            <div class="col-auto">
                                                <div
                                                    class="user-name-box-article"
                                                >
                                                    <a
                                                        :href="
                                                            '/@' +
                                                                item.user
                                                                    .username
                                                        "
                                                    >
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
                                           <div class="col-auto">
                                                    <div
                                                        class="user-info-box-article"
                                                    >
                                                        <vs-tooltip
                                                            v-bind:text="
                                                                parseFloat(
                                                                    item.userRating
                                                                ).toFixed(1) >=
                                                                0
                                                                    ? parseFloat(
                                                                          item.userRating
                                                                      ).toFixed(
                                                                          1
                                                                      )
                                                                    : '0'
                                                            "
                                                        >
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
                                                        </vs-tooltip>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mobile-btn-act-position">
                                        <div class="row">
                                            <div class="col-auto mobile-hidden-1 p-1">
                                                <button
                                                    class="btn btn-primary btn-sm"
                                                >
                                                    <i
                                                        class="fas fa-envelope"
                                                    ></i>
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
                                                        <li
                                                            @click="
                                                                userid =
                                                                    item.Account_number
                                                            "
                                                        >
                                                            <a
                                                                class="dropdown-item"
                                                                type="button"
                                                                data-toggle="modal"
                                                                data-target="#canceling-ae-contract"
                                                                >الغاء العقد</a
                                                            >
                                                        </li>
                                                        <li
                                                            @click="
                                                                reportTo =
                                                                    item.Account_number
                                                            "
                                                        >
                                                            <a
                                                                class="dropdown-item"
                                                                type="button"
                                                                data-toggle="modal"
                                                                data-target="#reportModal"
                                                                >التبليغ</a
                                                            >
                                                        </li>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mg-mb">
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <div class="row">

                                                <div class="col-auto">
                                                    <div
                                                        class="user-info-box-article"
                                                    >
                                                        <i
                                                            class="fas fa-briefcase"
                                                        ></i>
                                                        {{
                                                            item.AeAccount
                                                                .job_title
                                                        }}
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
                                            المغرب, {{ item.city }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="OrderCreator" class="mg-mb p-2">
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
                        <span
                                v-if="item.status == 1"
                                class="badge bg-warning"
                                >موظف</span
                            >
                            </div>

                            <div
                                v-if="OrderCreator"
                                id="text-wraper-desky"
                                class="text-wraper-desky-mg"
                            >
                                <p
                                    class="box-article-description font-Naskh text-wrap-line collapse TextCollapse"
                                    :id="'TextCollapse1' + index"
                                    aria-expanded="false"
                                >
                                    {{ item.description }}
                                </p>
                                <a
                                    role="button"
                                    class="collapsed"
                                    data-toggle="collapse"
                                    :href="'#TextCollapse1' + index"
                                    aria-expanded="false"
                                    :aria-controls="'TextCollapse1' + index"
                                ></a>
                            </div>
                        </div>
                    </div>

                    <div
                        v-if="listData2.length > 0"
                        class="show-more-section text-center mt-5 mb-4"
                    >
                        <button
                            v-if="
                                allresponse2.data.next_page_url &&
                                    allresponse2.data.next_page_url != null
                            "
                            style="margin-right: 0 !important"
                            type="button"
                            class="btn btn-primary text-center"
                            @click="ShowMore2"
                        >
                            مشاهدة المزيد
                        </button>
                        <button
                            v-else
                            style="margin-right: 0 !important"
                            type="button"
                            class="end-data-btn text-center"
                            disabled
                        >
                            نهائة النتائج
                        </button>
                    </div>
                    <!-- -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        "oid",
        "offerget",
        "offerget2",
        "from_url",
        "status",
        "myaccountnumber"
    ],
    data() {
        return {
            contract_aename: null,
            contract_price: null,
            contract_duration: null,
            userid: null,
            stopLazyLoading: false,
            stopLazyLoading2: false,
            allresponse: [],
            allresponse2: [],
            OrderCreator: false,
            listData2: [],
            listData: [],
            activePromptCheck: false,
            nodata: false,
            nodata2: false,
            OrderStatusCheck: false,
            reportTo: null,
            AllowdToEdit: false
        };
    },
    methods: {
        CheckIfAllowedToEdit() {
            let data = new FormData();
            data.append("OID", this.oid);
            axios
                .post("/ajax/order/offer/status", data)
                .then(response => {
                    if (response.data.status == 0) {
                        this.AllowdToEdit = true;
                    } else {
                        this.AllowdToEdit = false;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        AcceptOffer() {
            let data = new FormData();
            data.append("OID", this.oid);
            data.append("userid", this.userid);
            axios
                .post("/ajax/order/hire/user", data)
                .then(response => {
                    $("#profile-tab").click();
                    this.$vs.notify({
                        title: "تمت العملية بنجاح",
                        text: "لقد قمت بتوظيف مقاول ذاتي لتنفيذ طلبك.",
                        color: "success",
                        fixed: true,
                        icon: "check"
                    });
                    $("#close-modal-btn-4587").click();
                    if (this.status == 1) {
                        $("#openUpdateOrderStatusModal").click();
                    }
                })
                .catch(error => {
                    this.$vs.notify({
                        title: "فشلة العملية",
                        text:
                            "حدث خطأ ما أثناء محاولة تنفيذ طلبك يرجى اعادة المحاولة.",
                        color: "danger",
                        fixed: true,
                        icon: "check"
                    });
                });
        },
        OrderNextStatu() {
            let data = new FormData();
            data.append("OID", this.oid);
            data.append("s", "2");
            axios
                .post("/ajax/order/status", data)
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    this.$vs.notify({
                        title: "فشلة العملية",
                        text:
                            "حدث خطأ ما أثناء محاولة تنفيذ طلبك يرجى اعادة المحاولة.",
                        color: "danger",
                        fixed: true,
                        icon: "check"
                    });
                });
        },
        openLoadingInDiv() {
            this.$vs.loading({
                container: "#div-with-loading12",
                scale: 0.6,
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv() {
            this.$vs.loading.close("#div-with-loading12 > .con-vs-loading");
        },
        getNewOffer() {
            let data = new FormData();
            data.append("OID", this.oid);
            axios
                .post("/ajax/orders/offers/new", data)
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
                    this.stopLazyLoading = true;
                });
        },
        getHired() {
            let data = new FormData();
            data.append("OID", this.oid);
            axios
                .post("/ajax/orders/offers/hired", data)
                .then(response => {
                    this.allresponse2 = response.data;
                    this.listData2 = this.allresponse2.data.data;
                    this.OrderCreator = this.allresponse2.OrderCreator;
                    if (
                        this.listData2 == undefined ||
                        this.listData2 == null ||
                        this.listData2 == ""
                    ) {
                        this.nodata2 = true;
                    } else {
                        this.nodata2 = false;
                    }
                    this.stopLazyLoading2 = true;
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
                        "/ajax/orders/offers/new/?page=" +
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
        },
        ShowMore2() {
            this.openLoadingInDiv();
            let data = new FormData();
            data.append("OID", this.oid);
            if (this.allresponse2.data.next_page_url != null) {
                axios
                    .post(
                        "/ajax/orders/offers/hired/?page=" +
                            (parseInt(this.allresponse2.data.current_page) + 1),
                        data
                    )
                    .then(response => {
                        this.allresponse2 = response.data;
                        const entries = Object.values(
                            this.allresponse2.data.data
                        );

                        for (var i = 0; entries.length > i; i++) {
                            this.listData2.push(entries[i]);
                        }
                        this.HideLoadingInDiv();
                    });
            } else {
                console.log(null);
            }
        }
    },
    created() {
        this.getNewOffer();
        this.getHired();
        this.CheckIfAllowedToEdit();
    },
    mounted() {
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    }
};
</script>
