<template>
    <div class='d-flex flex-row justify-content-between align-items-center' v-loading="loading">
        <div v-html="legend" style="font-size:11px;"></div>
        <div>
            <pie-chart :data="data" :legend='false' :donut='true' 
            :colors="colors"
            height='100px' width='100px'></pie-chart>
        </div>
    </div>
</template>
<script>
export default {
    props : ["route"],
    data() {
        return {
            data : [],
            loading : false
        }
    },
    computed : {
        colors() {
            let colors = []
            let keys = Object.keys(this.data)
            for (let i in keys) colors.push("#"+this.intToRGB(this.hashCode(keys[i])))
            return colors
        },
        legend() {
            let colors = this.colors
            let data = this.data
            let text = "<div class='d-flex flex-column'>"
            let keys = Object.keys(data)
            for(let i in keys)
            {
                text += `<div class="d-flex align-items-center">
                            <div class="mr-2" style="background-color:${colors[i]};height: 12px;width: 25px;margin-top: 2px;"></div>
                            <div>${keys[i]} : ${data[keys[i]]}</div>
                        </div>`
            }
            text+="</div>"
            return text
        },
    },
    mounted() {
        this.initData()
    },
    methods : {
        hashCode(str) { 
            var hash = 0
            for (var i = 0; i < str.length; i++) hash = str.charCodeAt(i) + ((hash << 5) - hash)
            return hash
        },
        intToRGB(i){
            var c = (i & 0x00FFFFFF).toString(16).toUpperCase()
            return "00000".substring(0, 6 - c.length) + c
        },
        initData() {
            this.loading = true
            this.$http.post(this.route,{}).then( res => {
                this.data = res.data
                this.loading = false
            }).catch(er => {
                console.log(er)
                this.loading = false
            })
        }
    }
}
</script>