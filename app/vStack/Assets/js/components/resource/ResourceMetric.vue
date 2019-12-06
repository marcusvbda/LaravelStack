<template>
    <v-runtime-template :ranges="ranges" :template="view" :time="time"></v-runtime-template>
</template>
<script>
import VRuntimeTemplate from "v-runtime-template"
export default {
    props : ["view","calculate_route","time","ranges"],
    components : {
        "v-runtime-template" : VRuntimeTemplate
    },
}
</script>