<template>
  <div>
    <button
      dir="rtl"
      style="padding: 10px;"
      class="uk-button uk-float-left user-menu-bar"
      type="button"
      @click="bell_open"
    >
      <span class="bell-icon"><i class="fas fa-bell"></i></span>
      <span v-if="notifications.highlight > 0" class="uk-badge bell-not">
        {{ notifications.highlight }}
      </span>
    </button>
    <div uk-dropdown="mode: click" class="scroll" style="max-height: 470px; overflow-y: auto;">
      <div v-if="notifications[0] && notifications[0].length > 0">
        <div v-for="(val, index) in notifications[0]" :key="index">
          <div class="bell-not-content ">
            <div class="bell-head uk-inline uk-flex">
              <div class="content-text-bell">
                <h1>{{ val.subject }}</h1>
                <p>
                  {{ val.message }}
                </p>
              </div>
            </div>

            <div class="bell-not-footer">
              <p class="date-note">
                <i class="fas fa-clock"></i>
                {{ time_ago(new Date(val.created_at)) }}
              </p>
            </div>
          </div>
          <hr />
        </div>
      </div>
      <div v-else>
        <div class="bell-not-content">
          <p class="no-not-msg">لايوجد اشعارات بعد لعرضها</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      notifications: [],
      url_api: 'http://' + window.location.hostname,
      apikey: this.$root.apikey,
      audioURL: '/assest/audio/notification.wav',
      title: document.title,
      time_ago: function (time) {
        switch (typeof time) {
          case 'number':
            break
          case 'string':
            time = +new Date(time)
            break
          case 'object':
            if (time.constructor === Date) time = time.getTime()
            break
          default:
            time = +new Date()
        }
        var time_formats = [
          [60, 'ثانية', 1], // 60
          [120, ' منذ دقيقة واحدة ', 'تبقي دقيقة واحدة'], // 60*2
          [3600, 'دقيقة', 60], // 60*60, 60
          [7200, 'منذ ساعة', 'بعد ساعة'], // 60*60*2
          [86400, 'ساعات', 3600], // 60*60*24, 60*60
          [172800, 'أمس', 'غدا'], // 60*60*24*2
          [604800, 'ايام', 86400], // 60*60*24*7, 60*60*24
          [1209600, 'الاسبوع الماضى', 'الاسبوع المقبل'], // 60*60*24*7*4*2
          [2419200, 'اسابيع', 604800], // 60*60*24*7*4, 60*60*24*7
          [4838400, 'الشهر الماضي', 'الشهر المقبل'], // 60*60*24*7*4*2
          [29030400, 'أشهر', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
          [58060800, 'العام الماضي', 'العام القادم'], // 60*60*24*7*4*12*2
          [2903040000, 'سنوات', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
          [5806080000, 'القرن الماضي', 'القرن القادم'], // 60*60*24*7*4*12*100*2
          [58060800000, 'قرون', 2903040000], // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
        ]
        var seconds = (+new Date() - time) / 1000,
          token = 'مرة',
          list_choice = 1

        if (seconds == 0) {
          return 'الآن'
        }
        if (seconds < 0) {
          seconds = Math.abs(seconds)
          token = 'من الان'
          list_choice = 2
        }
        var i = 0,
          format
        while ((format = time_formats[i++]))
          if (seconds < format[0]) {
            if (typeof format[2] == 'string') return format[list_choice]
            else
              return (
                Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token
              )
          }
        return time
      },
    }
  },
  methods: {
    playSound: function () {
      const audio = new Audio(this.audioURL)
      audio.play()
    },
    getnotifications: function () {
      let data = new FormData()
      data.append('apikey', this.apikey)
      axios.post(this.url_api + '/api/notifications', data).then((response) => {
        this.notifications = response.data
        if (response.data.highlight > 0) {
          document.title = '(' + response.data.highlight + ') ' + this.title
        }
        if (response.data.soundPush > 0) {
          this.playSound()
        }
      })
      setInterval(() => {
        axios
          .post(this.url_api + '/api/notifications', data)
          .then((response) => {
            this.notifications = response.data
            if (response.data.highlight > 0) {
              document.title = '(' + response.data.highlight + ') ' + this.title
            }
            if (response.data.soundPush > 0) {
              this.playSound()
            }
          })
      }, 25000)
    },
    bell_open: function () {
    // Notification.requestPermission();
      let data = new FormData()
      data.append('highlight', true)
      axios.post(this.url_api + '/api/notifications', data).then((response) => {
        this.notifications = response.data
                document.title = this.title;

      })
    },
  },

  mounted() {
    setTimeout(() => {
      this.getnotifications()
    }, 2000)

  },
}
</script>
