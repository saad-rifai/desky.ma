<template>
    <div class="position-relative">
        <div v-if="!chatbox" class="users-messages-menu">
            <div v-if="ChatList.length > 0" class="messages-menu-content">
                <vs-list>
                    <div
                        v-for="(item, index) in ChatList"
                        :key="index"
                        @click="
                            users_menu_chat_click(
                                avatarLink(item.FromInfo.avatar),
                                item.Account_number,
                                (Fullname =
                                    item.FromInfo.frist_name[0].toUpperCase() +
                                    item.FromInfo.frist_name.substring(1) +
                                    ' ' +
                                    item.FromInfo.last_name[0].toUpperCase() +
                                    item.FromInfo.last_name.substring(1))
                            )
                        "
                    >
                        <vs-list-item
                            :title="
                                item.FromInfo.frist_name[0].toUpperCase() +
                                    item.FromInfo.frist_name.substring(1) +
                                    ' ' +
                                    item.FromInfo.last_name[0].toUpperCase() +
                                    item.FromInfo.last_name.substring(1)
                            "
                            :subtitle="item.LastMessage"
                        >
                            <template slot="avatar">
                                <vs-avatar
                                    size="large"
                                    :src="avatarLink(item.FromInfo.avatar)"
                                />
                                <span
                                    v-if="item.IsOnline == true"
                                    class="isOnlineBadgVuesax"
                                ></span>
                            </template>
                            <span
                                class="list-users-message-badge"
                                v-if="item.NewMessages > 0"
                                >{{ item.NewMessages }}</span
                            >
                        </vs-list-item>
                    </div>
                </vs-list>
            </div>
            <div v-else>
        <div class="no-data-message text-center mt-5 mb-4">
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
        </div>
        </div>
        <div v-else class="chat-tab-border-box mt-2">
            <div class="chat-head">
                <div class="row w-100 mt-1 mx-auto">
                    <div class="col">
                        <div class="row">
                            <div class="col-auto chat-tools">
                                <vs-button
                                    @click="backToList"
                                    class="btn-icon-no-bg"
                                    type="filled"
                                    icon="arrow_forward_ios"
                                ></vs-button>
                            </div>
                            <div class="col-auto p-0">
                                <vs-avatar
                                    size="large"
                                    :src="chat_box_avatar"
                                />
                            </div>
                            <div class="col-auto mt-2 p-0">
                                <h1 class="chat-box-title">
                                    {{ fullusername }}
                                </h1>
                                <div
                                    class="user-check-status"
                                    v-if="IsOnline == true"
                                >
                                    متصل
                                </div>
                                <div
                                    class="user-check-status"
                                    v-if="IsOnline == false"
                                >
                                    غير متصل
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto chat-tools">
         
                    </div>
                </div>
            </div>
            <div class="chat-body position-relative">
                <div>
                    <div class="chat-message-container">
                        <div class="chat-header-top">
                            <button @click="NexChatMessage" v-if="NextPageChat != null" class="btn-read-more-chat">رسائل أقدم</button>
                        </div>
                        <br>
                        <br>

                        <div
                            v-for="(item, index) in ChatRoomData"
                            :key="index"
                            class="message-box"
                            v-bind:class="{ send: item.to == to }"
                        >
                            <div
                                class="message-item"
                                v-bind:class="{ send: item.to == to }"
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
                                            v-if="item.to == to"
                                        >
                                            <div class="message-status">
                                                <vs-tooltip text="تم الارسال">
                                                    <i
                                                        v-if="item.status == 0"
                                                        class="far fa-check-circle"
                                                    ></i>
                                                </vs-tooltip>
                                                <vs-tooltip text="تم التوصل">
                                                    <i
                                                        v-if="item.status == 1"
                                                        class="fas fa-check-circle"
                                                    ></i>
                                                </vs-tooltip>
                                                <vs-tooltip text="تمت المشاهدة">
                                                    <span
                                                        v-if="item.status == 2"
                                                        class="received-chat-icon"
                                                        ><img
                                                            :src="
                                                                chat_box_avatar
                                                            "
                                                            alt=""
                                                    /></span>
                                                </vs-tooltip>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chat-footer">
                <div class="row">
                    <div class="col-auto">
                        <div>
                            <button @click="sendMessage" class="chat-btn">
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
                        <div>
                            <input
                                dir="auto"
                                v-model="message"
                                v-on:keyup.enter="sendMessage"
                                type="text"
                                class="input-text-chat"
                            />
                        </div>
                    </div>
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

// --- Main function

/* Convert Time Post  Function */
export default {
    props: ["oid"],
    data() {
        return {
            chatbox: false,
            chat_box_avatar: "",
            message: "",
            to: "",
            ChatList: [],
            ChatRoomData: [],
            fullusername: "",
            IsOnline: null,
            NextPageChat: null,
            chatCount: 10,
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
        NexChatMessage(){
            this.chatCount+=10;
            this.getChatRoom();
        },
        backToList() {
            this.chatbox = false;
            clearInterval(this.interval2);
        },
        sortedChatRoomData: function() {
            this.ChatRoomData.sort((a, b) => {
                return new Date(a.date) - new Date(b.date);
            });
            return this.ChatRoomData;
        },
        avatarLink(link) {
            if (link != "" && link != null) {
                return "/" + link;
            } else {
                return "/img/icons/avatar.png";
            }
        },
        getChatList() {
            let data = new FormData();
            data.append("OID", this.oid);
            axios.post("/ajax/project/chatList/get", data).then(response => {
                this.ChatList = response.data.data;
            });
        },
        sendMessage() {
            this.ChatRoomData.push({
                date: new Date(),
                message: this.message,
                to: this.to
            });
            let data = new FormData();
            data.append("OID", this.oid);
            data.append("to", this.to);
            data.append("message", this.message);
            this.message = "";
            axios
                .post("/ajax/project/chat/send", data)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.$vs.notify({
                            text: this.errors.errors[0],
                            color: "danger",
                            position: "top-right",
                            icon: "error"
                        });
                    } else {
                        this.$vs.notify({
                            text: error.response.data.error,
                            color: "danger",
                            position: "top-right",
                            icon: "error"
                        });
                    }
                });
        },
        getChatRoom() {
            let data = new FormData();
            data.append("OID", this.oid);
            data.append("to", this.to);
            data.append("count", this.chatCount)
            axios
                .post("/ajax/project/chatroom/get", data)
                .then(response => {
                    this.ChatRoomData = response.data.data.data;
                    this.NextPageChat = response.data.data.next_page_url;
                    this.IsOnline = response.data.IsOnline;

                    this.sortedChatRoomData();
                })
                .catch(error => {
                    console.log(error);
                });
        },
     
        users_menu_chat_click(avatar, to, fullname) {
            this.IsOnline = null;
            this.to = to;
            this.fullusername = fullname;
            if (this.to != "") {
                this.interval2 = setInterval(() => this.getChatRoom(), 5000);
            }
            this.ChatRoomData = [];
            this.chat_box_avatar = avatar;
            this.chatbox = true;
            let data = new FormData();
            data.append("OID", this.oid);
            data.append("to", this.to);
            data.append("count", this.chatCount);
            axios
                .post("/ajax/project/chatroom/get", data)
                .then(response => {
                    this.ChatRoomData = response.data.data.data;
                    this.NextPageChat = response.data.data.next_page_url;
                    this.IsOnline = response.data.IsOnline;

                    this.sortedChatRoomData();
                })
                .catch(error => {
                    console.log(error);
                });
        },

        messageTyping() {
            if (this.message != "") {
            }
        }
    },
    created() {
        this.getChatList();
        this.interval1 = setInterval(() => this.getChatList(), 5000);
    }
};
</script>
