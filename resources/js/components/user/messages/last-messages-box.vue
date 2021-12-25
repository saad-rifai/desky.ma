<template>
    <div>
                        <div class="messages-users-list vs-con-loading__container" id="LastMessagesBoxLoad">


             

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
                        >
                              <a href="/messages?ref=dashboard">
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
                                                (item.to == account_number &&
                                                    item.status == 0) ||
                                                    item.status == 1
                                            "
                                            class="new-notification-badge"
                                        ></span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </li>
                        
         
                    </ul>
                </div>
    </div>
</template>
<script>
export default {
    props:['max', 'account_number'],
    data() {
        return {
            ConversationsListData: [],
            ConversationsList: [],
        }
    },
    methods: {
                openLoadingInDiv: function() {
            this.$vs.loading({
                container: "#LastMessagesBoxLoad",
                scale: 0.6,
                color: "#f96a0c"
            });
        },
        HideLoadingInDiv: function() {
            this.$vs.loading.close("#LastMessagesBoxLoad > .con-vs-loading");
        },
                getConversationsList() {

            axios
                .get("/ajax/messages/chatList/get?perPage="+this.max)
                .then(response => {
                    this.ConversationsListData = response.data.data;
                    this.ConversationsList = this.ConversationsListData.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },
    created(){
        this.getConversationsList();
    }
}
</script>