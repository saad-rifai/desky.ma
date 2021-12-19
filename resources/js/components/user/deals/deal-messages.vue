<template>
    <div>
        <div class="chat-tab-border-box">
            <div class="chat-head">
                <div class="row w-100 mt-1 mx-auto">
                    <div class="col">
                        <div class="row">
                 
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
                    <div class="col-auto chat-tools"></div>
                </div>
            </div>
            <div class="chat-body position-relative">
                <div>
                    <div class="chat-message-container">
                        <div class="chat-header-top">
                            <button
                                @click="NexChatMessage"
                                v-if="NextPageChat != null"
                                class="btn-read-more-chat"
                            >
                                رسائل أقدم
                            </button>
                        </div>
                        <br />
                        <br />

                        <div
                            v-for="(item, index) in messages"
                            :key="index"
                            class="message-box"
                            v-bind:class="{ send: item.to != account_number }"
                        >
                            <div
                                class="message-item"
                                v-bind:class="{ send: item.to != account_number }"
                            >
                                <div class="message-text">
                                    {{ item.message }}
                                </div>
                                <div class="message-footer">
                                    <div class="row">
                                        <div class="col-md-auto">
                                            <div class="message-time">
                                                {{ moment(item.date).locale("ar-ma").fromNow() }}
                                            </div>
                                        </div>

                                        <div
                                            class="col-md-auto"
                                            v-if="item.to != account_number"
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
export default {
    props:['oid', 'account_number'],

    data() {
        return {
            PerPage: 15,
            AllMessagesResponse: [],
            messages: [],
            chat_box_avatar: "https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/default/avatar.png",
            fullusername: null,
            IsOnline: false,
            NextPageChat: null,
            message: "",
            OrderOwenerAccountNumber: "",
        }
    },
    methods:{
        sortedChatRoomData: function() {
            this.messages.sort((a, b) => {
                return new Date(a.date) - new Date(b.date);
            });
            return this.messages;
        },
        GetMessages(){
            let data = new FormData();
            data.append("OID", this.oid);
            data.append("PerPage", this.PerPage);
            axios.post("/ajax/deal/messages", data).then((response) =>  {
                this.AllMessagesResponse = response.data;
                this.IsOnline = this.AllMessagesResponse.IsOnline;
                this.fullusername = this.AllMessagesResponse.OrderOwenerName;
                this.chat_box_avatar = this.AllMessagesResponse.OrderOwenerAvatar;
                this.OrderOwenerAccountNumber = this.AllMessagesResponse.OrderOwenerAccountNumber;

                this.NextPageChat = this.AllMessagesResponse.data.next_page_url;

                this.messages = response.data.data.data;
                    this.sortedChatRoomData();

            }).catch((error) => {
                console.log(error);
            })

        },
        sendMessage() {
            if (this.message != "") {
                this.messages.push({
                    date: new Date(),
                    message: this.message,
                    to: this.OrderOwenerAccountNumber
                });
                let data = new FormData();
                data.append("OID", this.oid);
                data.append("to", this.OrderOwenerAccountNumber);
                data.append("message", this.message);
                this.message = "";
                axios
                    .post("/ajax/project/chat/send", data)
                    .then(response => {
                        this.GetMessages();
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            this.$vs.notify({
                                text: this.errors.errors[0],
                                color: "danger",
                                position: "top-right",
                                icon: "error"
                            });
                        } else if (error.response.status == 401) {
                            this.$vs.notify({
                                text: "انتهت الجلسة",
                                color: "danger",
                                position: "top-right",
                                icon: "warning"
                            });
                            window.location.reload();
                        } else {
                            this.$vs.notify({
                                text: error.response.data.error,
                                color: "danger",
                                position: "top-right",
                                icon: "error"
                            });
                        }
                    });
            }
        },
        NexChatMessage() {
            this.PerPage += 10;
            this.GetMessages();
        },
        
    },
    created(){
        this.GetMessages();
        this.interval2 = setInterval(() => this.GetMessages(), 5000);

    }
}
</script>