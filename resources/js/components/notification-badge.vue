<template>
    <div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            count_new_notification: 0,
        }
    },
      methods: {
    getnotifications: function () {
      let data = new FormData()
      data.append('apikey', this.apikey)
      axios.post(this.url_api + '/api/notifications/counter', data).then((response) => {
        this.notifications = response.data
      })
      setInterval(() => {
        axios
          .post(this.url_api + '/api/notifications/counter', data)
          .then((response) => {
            this.notifications = response.data
          })
      }, 25000)
    },
  },
  mounted() {
    setTimeout(() => {this.getnotifications()}, 2000);
  },
}
</script>
