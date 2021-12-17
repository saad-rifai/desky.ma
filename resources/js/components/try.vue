<script>
export default {
    data(){
        return{

        }
    },
    methods:{
         tryRequest(){
            axios.get('try').then((response) => {
                console.log(response)

            }).catch((error) => {
                console.log(error.response.data)
            })
        }
    },
    created(){
        this.tryRequest()
    }
}
</script>