<template>
<div> <button @click="sendrequest">pay</button> </div>
</template>
<script>
export default {
    data() {
     return{
    data: {
        apiVersion: "1.1",
    externalId: "012345678978",
    expirationDate: "2021-06-01T10:30:30GMT",
    amount: "199",
    buyerFirstName: "Saad",
    buyerLastName: "Rifai",
    buyerEmail: "rifaisaad3@gmail.com",
    buyerAddress: "NULL",
    buyerPhone: "06671013733",
    storeId: "4010",
    payUrl: "https://desky.ma/?ref=test",
    orderCheckSum: "1774cb608c85148bbcc544235afa14a4"
    }
     }
    },
    methods:{
        sendrequest: function(){
            let data = new FormData();
            data.append("apiVersion" , this.apiVersion);
            data.append("expirationDate" , this.expirationDate);
            data.append("amount" , this.amount);
            data.append("buyerFirstName" , this.buyerFirstName);
            const config = { headers:{
                "Content-Type": "multipart/form-data" ,
        "Authorisation": "Bearer 8a19aff55b85a436dad5cd1386db1999437"

            }}
        axios.post("../api/bingapay").then((response) => {
        console.log(response.data);

      }).catch((error) => {
          console.log(error);
      });
        }
    }
}
</script>
