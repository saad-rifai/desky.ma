<template>
    <div>
        <div class="row w-100 mx-auto position-relative overflow-hidden">
            <div
                class="col p-0 position-relative "
                style="
    height: 559px;
"
            >
                <button
                    class="btn-icon-no-bg mb-icon-bottom"
                    type="button"
                    data-toggle="collapse"
                    data-target="#users-messages-list-collapse"
                    aria-expanded="false"
                >
                    <i class="fas fa-comment-alt-lines"></i>
                </button>

                <div
                    class="chat-box-not-selected position-absolute top-50 start-50 translate-middle"
                >
                    <img
                        src="/img/icons/Work chat-rafiki.png"
                        alt="select convirsation"
                    />
                    <h1>قم باختيار محادثة</h1>
                    <p>حاول تحديد محادثة أو البحث عن شخص معين.</p>
                </div>
                <div hidden class="messages-chat-box" dir="rtl">
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
                                        src="/img/users/portfolios/2021/7684293048/7684293048-618bb9e70057b.jpg"
                                        alt=""
                                    />
                                </div>
                            </div>
                            <div class="col">
                                <div class="messages-user-infos">
                                    <h1>Saad Rifai</h1>
                                    <p class="isOnline-text">متصل</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-body p-2 position-relative">
                        <div class="message-box">
                            <div class="message-item">
                                <div class="message-text">
                                    test test test
                                </div>
                                <div class="message-footer">
                                    <div class="row">
                                        <div class="col-md-auto">
                                            <div class="message-time">
                                                10:00
                                            </div>
                                        </div>

                                        <div class="col-md-auto">
                                            <div class="message-status">
                                                <vs-tooltip text="تم الارسال">
                                                    <i
                                                        class="far fa-check-circle"
                                                    ></i>
                                                </vs-tooltip>
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
                                    <button class="chat-btn">
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
                        v-if="ConversationsList.length < 0"
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
                                    item.userInfos.frist_name.substring(1) +
                                    ' ' +
                                    item.userInfos.last_name[0].toUpperCase() +
                                    item.userInfos.last_name.substring(1)
                                            }}
                                        </h1>
                                        <p class="last-message">
                                            {{ item.message }}
                                        </p>
                                        <span v-if="item.status == 0 || item.status == 1 " class="new-notification-badge"></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            chatbox: false,
            chat_box_avatar: "",
            message: "",
            to: "",
            ConversationsList: [],
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
        getConversationsList() {
            axios
                .get("/ajax/messages/chatList/get")
                .then(response => {
                    this.ConversationsList = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    created() {
        this.getConversationsList();
        this.interval1 = setInterval(() => this.getConversationsList(), 5000);

    }
};
</script>
