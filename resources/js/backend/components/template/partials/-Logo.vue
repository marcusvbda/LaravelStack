<template>
  <div class="sidebar-logo-container" >
    <transition name="fade">
      <a :href="logo.href" v-if="!$root.sidebarCollapse" class="sidebar-logo">
        <img v-if="logo" :src="logo.src" style="width: 110px;">
      </a>
      <a :href="smalllogo.href" v-else class="sidebar-smalllogo">
        <img v-if="logo" :src="smalllogo.src"  style="width: 30px;">
      </a>
    </transition>
  </div>
</template>

<script>
export default {
  props: ["collapse","logo","smalllogo"],
}
</script>

<style lang="scss" scoped>
  .sidebar-logo-container {
      position: relative;
      width: 100%;
      padding: 10px;
      line-height: 50px;
      background: #2b2f3a;
      text-align: center;
      overflow: hidden;
  }
</style>