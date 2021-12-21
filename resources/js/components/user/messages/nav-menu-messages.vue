<template>
    <div class="position-relative">
        <button hidden id="btn_UserMenuClick"></button>
  <span v-if="NotReadNotificationCount > 0 && NotReadNotificationCount < 10" class="not-bell-round">{{NotReadNotificationCount}}</span>
          <span v-if="NotReadNotificationCount >= 10" class="not-bell-round">+9</span>
        <b-dropdown
            size="lg"
            variant="link"
            toggle-class="icon-dropdown"
            no-caret
        >
            <template #button-content class="btn-not-c">
                <i class="fas fa-envelope"></i>
            </template>
            <div class="menu-dropdown-lg position-relative" align="right">
                <div>
                    <div
                        v-if="ConversationsList.length < 1"
                        class="no-data-message text-center mt-4 mb-4 col-6"
                    >
                        لاتوجد رسائل حتى الأن
                    </div>
                    <ul
                        class="list-group list-group-flush messages-users-list-ul w-100"
                        dir="rtl"
                        v-else
                    > 
                    <li
                            class="list-group-item"
                            v-for="(item, index) in ConversationsList"
                            :key="index"
                        >

                    <a href="/messages/">
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
                                        <span class="message-list-time d-block">{{moment(item.date).locale('ar-ma').fromNow()}}</span>

                                    </div>
                                </div>
                            
                            </div>
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
        </b-dropdown>
    </div>
</template>
<script>
export default {
    data() {
        return {
            ConversationsList: [],
            ChatListCount: 15,
            ConversationsListData: [],
            NotReadNotificationCount: 0
        };
    },
    methods: {
        FaviconNot() {
            const favicon = document.getElementById("favicon");
            favicon.href = "/img/icons/favicon-not-32x32.png";
        },
        FaviconNotHide() {
            const favicon = document.getElementById("favicon");
            favicon.href = "/img/icons/favicon-32x32.png";
        },
        playSound(sound = "https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/audio/notification.wav") {
            if (sound) {
                var audio = new Audio(sound);
                audio.play();
            }
        },
        getConversationsList() {
            axios
                .get(
                    "/ajax/messages/chatList/get?perPage=" + this.ChatListCount+"&NotSoundCheck=true")
                .then(response => {
                    this.ConversationsListData = response.data.data;
                    this.ConversationsList = this.ConversationsListData.data;
                    this.NotReadNotificationCount =
                        response.data.NotReadMessages;
                    if (this.NotReadNotificationCount > 0) {
                        this.FaviconNot();
                    }
                    if (response.data.NotSound) {
                        this.playSound();
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.getConversationsList();
        this.interval = setInterval(() => this.getConversationsList(), 10000);
    }
};
</script>
