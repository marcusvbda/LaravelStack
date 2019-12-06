<template>
    <div>
        <div class='d-flex flex-row justify-content-between align-items-start'>
            <div><slot></slot></div>
            <div v-if="options.length>0"><v-select size="mini" v-model='range' :optionlist="options" withoutBlank /></div>
        </div>
        <div class="d-flex flex-column justify-content-between" ref="content" style="display:none;">
            <h2 v-loading="loading">{{value}}</h2>
            <div class="mt-3">
                <span v-html="trend"></span>
            </div>
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
            comparison : 0,
            value : 0
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
    computed : {
        trend() {
            let percent = this.getTrendPercent()
            if(Number(percent)==0) return "<div class='d-flex align-items-center'><h5>Sem Alteração</h5></div>"
            if(Number(this.value)<Number(this.comparison)) return `<div class='d-flex align-items-center'><h5>${percent}%<span class='el-icon-bottom-left text-danger ml-2'></span></h5></div>`
            return `<div class='d-flex align-items-center'><h5>${percent}%<span class='el-icon-top-right text-success ml-2'></span></h5></div>`
        }
    },
    watch : {
        range(val) {
            if(!this.loaded) return
            this.updateData()
        }
    },
    methods : {
        getTrendPercent() {
            let comparison = Number(this.comparison)
            let value = comparison-Number(this.value)
            if(value<=0) return value*-1
            let result = ((value*100)/comparison)
            if(result<0) result*=-1
            return result.toFixed(2).replace(/[.,]00$/, "")
        },
        updateData() {
            this.loading = true
            this.$http.post(this.route,{range : this.range}).then( res => {
                this.value = res.data.value ? res.data.value : 0
                this.comparison = res.data.average ? res.data.average : 0
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