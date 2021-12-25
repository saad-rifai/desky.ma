<template>
    <div>
        <div class="row w-100 mx-auto position-relative overflow-hidden ">
            <div
                class="col p-0 position-relative vs-con-loading__container"
                style="
    height: 600px;
"
            >
                <button
                    class="btn-icon-no-bg mb-icon-bottom"
                    type="button"
                    data-toggle="collapse"
                    data-target="#users-messages-list-collapse"
                    aria-expanded="false"
                    id="ChatListMenu"
                >
                    <i class="fas fa-comment-alt-lines"></i>
                </button>
                <div id="ChatFormLoad" class=""></div>
                <div
                    class="chat-box-not-selected position-absolute top-50 start-50 translate-middle"
                    v-if="ConversationData == null"
                >
                    <img
                        src="/img/icons/Work chat-rafiki.png"
                        alt="select convirsation"
                    />
                    <h1>قم باختيار محادثة</h1>
                    <p>حاول تحديد محادثة أو البحث عن شخص معين.</p>
                </div>
                <div v-else class="messages-chat-box" dir="rtl">
                    <div class="messages-header">
                        <div class="row">
                            <div class="col-auto chat-tools">
                                <button
                                    class="btn-icon-no-bg mb-show-chat"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#users-messages-list-collapse"
                                    aria-expanded="false"
                                >
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            <div class="col-auto ">
                                <div class="messages-user-avatar">
                                    <img
                                        v-if="
                                            ConversationData.UserInfos.avatar !=
                                                null
                                        "
                                        :src="ConversationData.UserInfos.avatar"
                                        :alt="
                                            ConversationData.UserInfos
                                                .frist_name +
                                                ConversationData.UserInfos
                                                    .last_name
                                        "
                                    />
                                    <img
                                        v-else
                                        src="/img/icons/avatar.png"
                                        :alt="
                                            ConversationData.UserInfos
                                                .frist_name +
                                                ConversationData.UserInfos
                                                    .last_name
                                        "
                                    />
                                </div>
                            </div>
                            <div class="col">
                                <div class="messages-user-infos">
                                    <h1>
                                        {{
                                            ConversationData.UserInfos.frist_name[0].toUpperCase() +
                                                ConversationData.UserInfos.frist_name.substring(
                                                    1
                                                ) +
                                                " " +
                                                ConversationData.UserInfos.last_name[0].toUpperCase() +
                                                ConversationData.UserInfos.last_name.substring(
                                                    1
                                                )
                                        }}
                                    </h1>
                                    <p
                                        class="isOnline-text"
                                        v-if="
                                            ConversationData.UserInfos.IsOnline
                                        "
                                    >
                                        متصل
                                    </p>
                                    <p class="isOnline-text" v-else>غير متصل</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-body p-2 position-relative">
                        <div class="chat-message-container">
                            <div class="chat-header-top">
                                <button
                                    @click="OldChatMessages"
                                    v-if="NextPageChat != null"
                                    class="btn-read-more-chat"
                                >
                                    رسائل أقدم
                                </button>
                            </div>
                            <br />
                            <br />
                            <div
                                v-for="(item, index) in ChatRoomData"
                                :key="index"
                                class="message-box"
                                v-bind:class="{
                                    send: item.from == account_number
                                }"
                            >
                                <div
                                    class="message-item "
                                    v-bind:class="{
                                        send: item.from == account_number
                                    }"
                                >
                                    <div class="message-text">
                                        {{ item.message }}
                                    </div>
                                    <div class="message-footer">
                                        <div class="row">
                                            <div class="col-md-auto">
                                                <div class="message-time">
                                                    {{ convertTime(item.date) }}
                                                </div>
                                            </div>

                                            <div
                                                class="col-md-auto"
                                                v-if="item.to != account_number"
                                            >
                                                <div class="message-status">
                                                    <vs-tooltip
                                                        text="تم الارسال"
                                                    >
                                                        <i
                                                            v-if="
                                                                item.status == 0
                                                            "
                                                            class="far fa-check-circle"
                                                        ></i>
                                                    </vs-tooltip>
                                                    <vs-tooltip
                                                        text="تم التوصل"
                                                    >
                                                        <i
                                                            v-if="
                                                                item.status == 1
                                                            "
                                                            class="fas fa-check-circle"
                                                        ></i>
                                                    </vs-tooltip>
                                                    <vs-tooltip
                                                        text="تمت المشاهدة"
                                                    >
                                                        <span
                                                            v-if="
                                                                item.status == 2
                                                            "
                                                            class="received-chat-icon"
                                                        >
                                                            <img
                                                                v-if="
                                                                    ConversationData
                                                                        .UserInfos
                                                                        .avatar !=
                                                                        null
                                                                "
                                                                :src="
                                                                    ConversationData
                                                                        .UserInfos
                                                                        .avatar
                                                                "
                                                                :alt="
                                                                    ConversationData
                                                                        .UserInfos
                                                                        .frist_name +
                                                                        ConversationData
                                                                            .UserInfos
                                                                            .last_name
                                                                "
                                                            />
                                                            <img
                                                                v-else
                                                                src="/img/icons/avatar.png"
                                                                :alt="
                                                                    ConversationData
                                                                        .UserInfos
                                                                        .frist_name +
                                                                        ConversationData
                                                                            .UserInfos
                                                                            .last_name
                                                                "
                                                            />
                                                        </span>
                                                    </vs-tooltip>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="messages-footer" dir="rtl">
                        <div class="row mx-auto">
                            <div class="col-auto">
                                <div>
                                    <button
                                        @click="sendMessage"
                                        class="chat-btn"
                                    >
                                        <span
                                            data-testid="send"
                                            data-icon="send"
                                            class=""
                                            ><svg
                                                viewBox="0 0 24 24"
                                                width="24"
                                                height="24"
                                                class=""
                                            >
                                                <path
                                                    fill="currentColor"
                                                    d="M1.101 21.757L23.8 12.028 1.101 2.3l.011 7.912 13.623 1.816-13.623 1.817-.011 7.912z"
                                                ></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="col">
                                <input
                                    dir="auto"
                                    type="text"
                                    class="input-text-chat"
                                    v-model="message"
                                    v-on:keyup.enter="sendMessage"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="col col-lg-4 p-0 mb-menu-users-list collapse collapse-horizontal dont-collapse-sm"
                id="users-messages-list-collapse"
            >
                <div class="messages-users-list ">
                    <button
                        type="button"
                        data-toggle="collapse"
                        data-target="#users-messages-list-collapse"
                        aria-expanded="false"
                        class="btn-close messages-users-btn-close"
                        aria-label="Close"
                    ></button>

                    <h1 class="messages-users-list-title">
                        جميع المحادثات
                    </h1>

                    <div
                        v-if="ConversationsList.length < 1"
                        class="no-data-message text-center mt-4 mb-4 col-6"
                    >
                        <img
                            src="/img/icons/Empty-bro-min.png"
                            alt="Empty-bro"
                        />
                        لاتوجد بيانات لعرضها
                    </div>
                    <ul
                        class="list-group list-group-flush messages-users-list-ul"
                        dir="rtl"
                        v-else
                    >
                        <li
                            class="list-group-item"
                            v-for="(item, index) in ConversationsList"
                            :key="index"
                            @click="
                                getConversation(item.room_id);
                                RoomIdSelected = item.room_id;
                            "
                        >
                            <div class="row">
                                <div class="col-auto">
                                    <div class="messages-user-avatar">
                                        <img
                                            v-if="item.userInfos.avatar != null"
                                            :src="item.userInfos.avatar"
                                            :alt="
                                                item.userInfos.frist_name +
                                                    item.userInfos.last_name
                                            "
                                        />
                                        <img
                                            v-else
                                            src="/img/icons/avatar.png"
                                            :alt="
                                                item.userInfos.frist_name +
                                                    item.userInfos.last_name
                                            "
                                        />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="messages-user-infos">
                                        <h1>
                                            {{
                                                item.userInfos.frist_name[0].toUpperCase() +
                                                    item.userInfos.frist_name.substring(
                                                        1
                                                    ) +
                                                    " " +
                                                    item.userInfos.last_name[0].toUpperCase() +
                                                    item.userInfos.last_name.substring(
                                                        1
                                                    )
                                            }}
                                        </h1>
                                        <p class="last-message">
                                            {{ item.message }}
                                        </p>
                                        <span
                                            v-if="
                                                item.to == account_number && (item.status == 0 || item.status == 1)"
                                            class="new-notification-badge"
                                        ></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <div class="show-more-section text-center mt-5">
                            <button
                                v-if="
                                    ConversationsListData.next_page_url != null
                                "
                                style="margin-right: 0 !important"
                                type="button"
                                class="btn btn-primary text-center"
                                @click="ShowMoreChatList"
                            >
                                مشاهدة المزيد
                            </button>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
/* Convert Time Post  Function */
const MONTH_NAMES = [
    "يناير",
    "فبراير",
    "مارس",
    "أبريل",
    "مايو",
    "يونيو",
    "يوليو",
    "أغسطس",
    "سبتمبر",
    "اكتوبر",
    "نوفمبر",
    "ديسمبر"
];

function getFormattedDate(date, prefomattedDate = false, hideYear = false) {
    const day = date.getDate();
    const month = MONTH_NAMES[date.getMonth()];
    const year = date.getFullYear();
    const hours = date.getHours();
    let minutes = date.getMinutes();

    if (minutes < 10) {
        // Adding leading zero to minutes
        minutes = `0${minutes}`;
    }

    if (prefomattedDate) {
        // Today at 10:20
        // Yesterday at 10:20
        return `${prefomattedDate} مع ${hours}:${minutes}`;
    }

    if (hideYear) {
        // 10. January at 10:20
        return `${day}. ${month} مع ${hours}:${minutes}`;
    }

    // 10. January 2017. at 10:20
    return `${day}. ${month} ${year}. مع ${hours}:${minutes}`;
}
if ($("#ChatListMenu").is(":hidden")) {
    alert("is hidden");
}
// --- Main function

/* Convert Time Post  Function */
export default {
    props: ["account_number"],
    data() {
        return {
            chatbox: false,
            chat_box_avatar: "",
            message: "",
            to: "",
            room_id: null,
            ConversationsList: [],
            ConversationsListData: [],
            ChatRoomData: [],
            fullusername: "",
            IsOnline: null,
            NextPageChat: null,
            chatCount: 10,
            ConversationData: null,
            ConversationSelected: [],
            ChatListCount: 10,
            paginate: 5,
            RoomIdSelected: "",
            convertTime: function timeAgo(dateParam) {
                if (!dateParam) {
                    return null;
                }

                const date =
                    typeof dateParam === "object"
                        ? dateParam
                        : new Date(dateParam);
                const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
                const today = new Date();
                const yesterday = new Date(today - DAY_IN_MS);
                const seconds = Math.round((today - date) / 1000);
                const minutes = Math.round(seconds / 60);
                const isToday = today.toDateString() === date.toDateString();
                const isYesterday =
                    yesterday.toDateString() === date.toDateString();
                const isThisYear = today.getFullYear() === date.getFullYear();

                if (seconds < 5) {
                    return "الأن";
                } else if (seconds <= 10) {
                    return `${seconds} ثواني مضت`;
                } else if (seconds < 60 && seconds > 10) {
                    return `${seconds} ثانية مضت`;
                } else if (seconds < 90) {
                    return "منذ دقيقة واحدة";
                } else if (minutes <= 10) {
                    return `${minutes} دقائق مضت`;
                } else if (minutes < 60 && minutes > 10) {
                    return `${minutes} دقيقة مضت`;
                } else if (isToday) {
                    return getFormattedDate(date, "اليوم"); // Today at 10:20
                } else if (isYesterday) {
                    return getFormattedDate(date, "البارحة"); // Yesterday at 10:20
                } else if (isThisYear) {
                    return getFormattedDate(date, false, true); // 10. January at 10:20
                }

                return getFormattedDate(date); // 10. January 2017. at 10:20
            }
        };
    },
    methods: {
        ShowMoreChatList() {
            if (this.ConversationsListData.next_page_url != null) {
                this.ChatListCount += 10;
                this.getConversationsList();
            }
        },
        OldChatMessages() {
            this.paginate += 10;
            this.getConversation(this.room_id);
        },
        sendMessage() {
            if (this.message != "" && this.room_id != null) {
                clearInterval(this.interval2);
                this.ChatRoomData.push({
                    date: new Date(),
                    message: this.message,
                    from: this.account_number
                });
                let data = new FormData();

                data.append("message", this.message);
                this.message = "";
                data.append("room_id", this.room_id);
                axios
                    .post("/ajax/user/message/send", data)
                    .then(response => {
                        this.getConversationMounted(this.RoomIdSelected)
                        this.interval2 = setInterval(
                            () =>
                                this.getConversationMounted(
                                    this.RoomIdSelected
                                ),
                            5000
                        );
                    })
                    .catch(error => {
                        if (error.response.status == 500) {
                            this.$vs.notify({
                                title: "خطأ في النظام",
                                text:
                                    "حصل خطأ في النظام أثناء محاولة معالجة طلبك يرجى اعادة المحاولة واذا استمر معك الخطأ يرجى التواصل معنا",
                                color: "danger",
                                fixed: true,
                                icon: "warning"
                            });
                        } else if (error.response.status == 401) {
                            this.$vs.notify({
                                text: "يجب تسجيل الدخول لتتمكن من التبليغ",
                                color: "danger",
                                fixed: true,
                                icon: "warning"
                            });
                            window.location.href =
                                "/login?redirect=" + window.location.href + "";
                        } else if (error.response.status == 422) {
                            this.$vs.notify({
                                text: error.response.data.errors.message[0],
                                color: "danger",
                                fixed: true,
                                icon: "warning"
                            });
                        } else {
                            this.$vs.notify({
                                text: error.response.data.error,
                                color: "danger",
                                fixed: true,
                                icon: "warning"
                            });
                        }
                        this.interval2 = setInterval(
                            () =>
                                this.getConversationMounted(
                                    this.RoomIdSelected
                                ),
                            5000
                        );
                    });
            }
        },
        openLoadingInDiv: function() {
            this.$vs.loading({
                container: "#ChatFormLoad",
                scale: 0.6,
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv: function() {
            this.$vs.loading.close("#ChatFormLoad > .con-vs-loading");
        },
        sortedChatRoomData: function() {
            this.ChatRoomData.sort((a, b) => {
                return new Date(a.date) - new Date(b.date);
            });
            return this.ChatRoomData;
        },
        getConversationsList() {
            axios
                .get(
                    "/ajax/messages/chatList/get?perPage=" + this.ChatListCount
                )
                .then(response => {
                    this.ConversationsListData = response.data.data;
                    this.ConversationsList = this.ConversationsListData.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getConversationMounted(id) {
            axios
                .get(
                    "/ajax/messages/conversation/get/" +
                        id +
                        "/" +
                        this.paginate
                )
                .then(response => {
                    this.ConversationData = response.data;
                    this.ConversationSelected = this.ConversationData.data;
                    this.ChatRoomData = this.ConversationSelected.data;
                    this.NextPageChat = this.ConversationSelected.next_page_url;

                    this.sortedChatRoomData();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getConversation(id) {
            var style = $("#ChatListMenu");
            if (style.css("display") == "block") {
                $("#ChatListMenu").click();
            }
            clearInterval(this.interval2);
            this.room_id = id;
            this.openLoadingInDiv();
            this.interval2 = setInterval(
                () => this.getConversationMounted(id),
                5000
            );

            axios
                .get(
                    "/ajax/messages/conversation/get/" +
                        id +
                        "/" +
                        this.paginate
                )
                .then(response => {
                    this.ConversationData = response.data;
                    this.ConversationSelected = this.ConversationData.data;
                    this.ChatRoomData = this.ConversationSelected.data;
                    this.NextPageChat = this.ConversationSelected.next_page_url;

                    this.sortedChatRoomData();
                    this.HideLoadingInDiv();
                })
                .catch(error => {
                    console.log(error);
                    this.HideLoadingInDiv();
                });
        }
    },
    created() {
          this.getConversationsList();
        this.interval1 = setInterval(() => this.getConversationsList(), 5000);
    }
};
</script>
