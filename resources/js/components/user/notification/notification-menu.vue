<template>
  <div  class="position-relative">
    <button @click="UserMenuClick" hidden id="btn_UserMenuClick"></button>
          <span v-if="NotReadNotificationCount > 0 && NotReadNotificationCount < 10" class="not-bell-round">{{NotReadNotificationCount}}</span>
          <span v-if="NotReadNotificationCount >= 10" class="not-bell-round">+9</span>

    <b-dropdown    size="lg" variant="link" toggle-class="icon-dropdown" no-caret>
      <template #button-content class="btn-not-c">
        <i class="fas fa-bell"></i>
      </template>
      <div class="menu-dropdown-lg position-relative" align="right">
        <div v-if="datalist.length > 0">
        <div>
          <h5 class="menu-title-h5" style="font-size: 14px">الاشعارات</h5>

          <a
            href="#"
            class="position-absolute top-0 end-0 top-menu-link"
            style="font-size: 12px"
            >الكل</a
          >
        </div>

        <div v-for="(item, index) in datalist" :key="index" class="menu-title">
          <div class="notification-title">
            <p class="font-Naskh" v-html="item.message">
         
            </p>
          </div>
          <span class="date-not"> {{ convertTime(item.date) }}</span>
        </div>
</div>
<div v-else>
              <div
              class="no-data-message text-center mt-4 mb-4 col-6"
            >
              لاتوجد بيانات لعرضها
            </div>
</div>

      </div>
    </b-dropdown>
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
  "ديسمبر",
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
$(document).ready(function() {
  $('.icon-dropdown').on('click', function() {
    $("#btn_UserMenuClick").click();
  });
  });
export default {
  
  data() {
    return {
      datalist: [],
      NotReadNotificationCount: 0,
      sound: "",
      convertTime: function timeAgo(dateParam) {
        if (!dateParam) {
          return null;
        }

        const date =
          typeof dateParam === "object" ? dateParam : new Date(dateParam);
        const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
        const today = new Date();
        const yesterday = new Date(today - DAY_IN_MS);
        const seconds = Math.round((today - date) / 1000);
        const minutes = Math.round(seconds / 60);
        const isToday = today.toDateString() === date.toDateString();
        const isYesterday = yesterday.toDateString() === date.toDateString();
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
      },
    };
  },
  methods: {
    FaviconNot(){
          const favicon = document.getElementById("favicon");
      favicon.href = "/img/icons/favicon-not-32x32.png";
    },    
    FaviconNotHide(){
          const favicon = document.getElementById("favicon");
      favicon.href = "/img/icons/favicon-32x32.png";
    },
    playSound (sound = "https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/audio/notification.wav") {
      if(sound) {
        var audio = new Audio(sound);
        audio.play();
      }
    },
    UserMenuClick(){
      this.NotReadNotificationCount = 0;
      this.FaviconNotHide();
      axios.post("/ajax/user/menu/notification/click").catch((error) =>{
        console.log(error);
      });
      
    
    },
    getData() {
      
      axios
        .get("/ajax/user/menu/notification")
        .then((response) => {
          this.datalist = response.data.data;
          this.NotReadNotificationCount =response.data.NotReadNotification;
          if(this.NotReadNotificationCount > 0){
            this.FaviconNot();
          }
          if(response.data.NotSound){
            this.playSound();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getData();
    this.interval = setInterval(() => this.getData(), 10000);

  },

};
</script>
