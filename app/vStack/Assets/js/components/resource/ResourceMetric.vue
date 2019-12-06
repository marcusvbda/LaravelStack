<template>
    <v-runtime-template :template="view" ></v-runtime-template>
</template>
<script>
import VRuntimeTemplate from "v-runtime-template"
export default {
    props : ["view","calculate_route"],
    components : {
        "v-runtime-template" : VRuntimeTemplate
    },
}
</script>