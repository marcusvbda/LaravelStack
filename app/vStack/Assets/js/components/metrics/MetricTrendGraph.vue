<template>
    <div ref="content" style="display:none;">
        <div class='d-flex flex-row justify-content-between align-items-start pt-3 px-3 pb-1'>
            <div><slot></slot></div>
            <div v-if="options.length>0"><v-select size="mini" v-model='range' :optionlist="options" withoutBlank /></div>
        </div>
        <div class="d-flex flex-column justify-content-between p-1" v-loading="loading" >
            <area-chart :data="value" height="120px" ></area-chart>
        </div>
    </div>
</template>
<script>
export default {
    props : ["route","time","ranges"],
    data() {
        return {
            loaded : false,
            data : [],
            loading : false,
            range : null,
            options : [],
            value : {}
        }
    },
    async created() {
        let result = []
        let ranges = this.ranges
        let keys = Object.keys(ranges)
        for(let i in keys) result.push({name:keys[i],id:ranges[keys[i]]})
        this.options = result
        if(!this.range && result[0]) this.range = result[0].id
        this.updateData()
        setInterval(_ => {
            this.updateData()
        },this.time*1000)
    },
    watch : {
        range(val) {
            if(!this.loaded) return
            this.updateData()
        }
    },
    methods : {
        updateData() {
            this.loading = true
            this.$http.post(this.route,{range : this.range}).then( res => {
                let value = []
                let data = res.data ? res.data : {}
                let keys = Object.keys(data)
                for(let i in keys) value.push([keys[i],data[keys[i]]])
                this.value = value
                this.loading = false
                $(this.$refs.content).show()
                this.loaded = true
            }).catch(er => {
                console.log(er)
                this.loading = false
            })
        }
    }
}
</script>