<template>
    <div :class="`col-md-${metric.width} col-sm-12 mb-3`" style="color: #7c858e;">
        <div class="card d-flex flex-column justify-content-between p-3 h-100 h-100">
            <div class="d-flex align-items-center" v-if="metric.title || metric.subtitle">
                <div class="w-100 h-100">
                    <div class="d-flex flex-row justify-content-between align-items-center mb-2">
                        <b v-html="metric.title"></b>
                        <b v-html="metric.subtitle"></b>
                    </div>
                </div>
            </div>
            <v-runtime-template :template="`<span>${metric.content}</span>`" />
        </div>
    </div>
</template>
<script>
import VRuntimeTemplate from "v-runtime-template"
export default {
    props:["metric"],
    mounted() {
        // console.log(this.metric)
    },
    components : {
        "v-runtime-template" : VRuntimeTemplate
    },
}
</script>