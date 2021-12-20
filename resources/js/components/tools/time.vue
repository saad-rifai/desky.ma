<template>
    <div>
        {{moment(time).locale("ar-ma").format("LLLL")}}
    </div>
</template>
<script>
export default {
    props:['time', 'parameters'],
    data() {
        return {
        }
    },
}
</script>
