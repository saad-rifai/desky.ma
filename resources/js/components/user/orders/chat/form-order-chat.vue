<template>
  <div class="position-relative">
    <div v-if="!chatbox" class="users-messages-menu">
      <div class="messages-menu-content">
        <vs-list>
          <div
            @click="
              users_menu_chat_click(
                '/img/users/2021/8529090451-61a21c1dd5f5f.jpg'
              )
            "
          >
            <vs-list-item title="Saad Rifai" subtitle="Top Contributor">
              <template slot="avatar">
                <vs-avatar src="/img/users/2021/8529090451-61a21c1dd5f5f.jpg" />
              </template>
              <span class="list-users-message-badge">1</span>
            </vs-list-item>
          </div>
          <div
            @click="
              users_menu_chat_click(
                '/img/users/2021/7684293048-619e582db97f0.jpg'
              )
            "
          >
            <vs-list-item title="Adil Miftah" subtitle="11 Points">
              <template slot="avatar">
                <vs-avatar src="/img/users/2021/7684293048-619e582db97f0.jpg" />
              </template>
            </vs-list-item>
          </div>
          <div @click="users_menu_chat_click('')">
            <vs-list-item
              title="desky maroc"
              subtitle="l'ASMEX organise le 27 octobre 2021 à"
            >
              <template slot="avatar">
                <vs-avatar vs-text="Vuesax" />
              </template>
            </vs-list-item>
          </div>
        </vs-list>
      </div>
    </div>
    <div v-else class="chat-tab-border-box mt-2">
      <div class="chat-head">
        <div class="row w-100 mt-1 mx-auto">
          <div class="col">
            <div class="row">
              <div class="col-auto chat-tools">
                <vs-button
                  @click="chatbox = false"
                  class="btn-icon-no-bg"
                  type="filled"
                  icon="arrow_forward_ios"
                ></vs-button>
              </div>
              <div class="col-auto p-0">
                <vs-avatar size="large" :src="chat_box_avatar" />
              </div>
              <div class="col-auto mt-2 p-0">
                <h1 class="chat-box-title">Saad Rifai</h1>
                <div class="user-check-status">متصل</div>
              </div>
            </div>
          </div>
          <div class="col-auto chat-tools">
            <vs-dropdown vs-trigger-click @click.stop>
              <vs-button
                class="btn-icon-no-bg"
                type="filled"
                icon="more_vert"
              ></vs-button>
              <!-- <a href="#">Hola mundo</a> -->

              <vs-dropdown-menu>
                <vs-dropdown-item>التبليغ</vs-dropdown-item>
                <vs-dropdown-item> الغاء التوظيف </vs-dropdown-item>
              </vs-dropdown-menu>
            </vs-dropdown>
          </div>
        </div>
      </div>
      <div class="chat-body">
        <div>
          <div class="chat-message-container">
            <div class="message-box">
              <div class="message-item">
                <div class="message-text">
                  sf db ntrada wnji aji dik l3iba xno 3melti fiha
                </div>
                <div class="message-footer">
                  <div class="row">
                    <div class="col-md-auto">
                      <div class="message-time">12:25</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="message-box">
              <div class="message-item send">
                <div class="message-text">
                  hadi mz2ana banetli nas dyal encg 3andom m3a had xi
                </div>
                <div class="message-footer">
                  <div class="row">
                    <div class="col-md-auto">
                      <div class="message-time">12:25</div>
                    </div>
                    <div class="col-md-auto">
                      <div class="message-status">
                        <i class="received fas fa-check-circle"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="message-box">
              <div class="message-item">
                <div class="message-audio" id="audio-player">
                  <vue-plyr>
                    <audio controls crossorigin playsinline>
                      <source
                        src="https://greghub.github.io/green-audio-player/examples/audio/example-1.mp3"
                        type="audio/mp3"
                      />
                    </audio>
                  </vue-plyr>
                </div>
                <div class="message-footer">
                  <div class="row">
                    <div class="col-md-auto">
                      <div class="message-time">12:25</div>
                    </div>
                    <div class="col-md-auto">
                      <div class="message-status">
                        <i class="received fas fa-check-circle"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="message-box">
              <div class="message-item send">
                <div class="message-audio" id="audio-player">
                  <vue-plyr>
                    <audio controls crossorigin playsinline>
                      <source
                        src="https://greghub.github.io/green-audio-player/examples/audio/example-1.mp3"
                        type="audio/mp3"
                      />
                    </audio>
                  </vue-plyr>
                </div>
                <div class="message-footer">
                  <div class="row">
                    <div class="col-md-auto">
                      <div class="message-time">12:25</div>
                    </div>
                    <div class="col-md-auto">
                      <div class="message-status">
                        <i class="received fas fa-check-circle"></i>
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
                <span data-testid="send" data-icon="send" class=""
                  ><svg viewBox="0 0 24 24" width="24" height="24" class="">
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
  props:['oid'],
  data() {
    return {
      chatbox: false,
      chat_box_avatar: "",
      message: "",
      to: "4566682357",
      ChatList: [],
    };
  },
  methods: {
    getChatList(){
      let data = new FormData();
      data.append("OID", this.oid);
      axios
        .post("/ajax/project/chatList/get", data)
        .then((response) => {
         this.ChatList = response.data;
        });
    },
    sendMessage() {
      let data = new FormData();
      data.append("OID", this.oid);
      data.append("to", this.to);
      data.append("message", this.message);

      axios
        .post("/ajax/project/chat/send", data)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.$vs.notify({
              text: this.errors.errors[0],
              color: "danger",
              position: "top-right",
              icon: "error",
            });
          } else {
            this.$vs.notify({
              text: error.response.data.error,
              color: "danger",
              position: "top-right",
              icon: "error",
            });
          }
        });
    },
    users_menu_chat_click(avatar) {
      this.chat_box_avatar = avatar;
      this.chatbox = true;
    },

    messageTyping() {
      if (this.message != "") {
      }
    },
  },
  created() {
    this.getChatList();
  },
};
</script>

