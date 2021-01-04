<template>
  <div class="server">
    <span>{{message}}</span>
  </div>
</template>

<script>
export default {
  props: ["message"],
}
</script>

<style scoped>
  .server {
    position: relative;
    line-height: 82.5vh;
    width: 100%;
    text-align: center;
  }
  span {
    position: absolute;
    font-size: 100px;
    transform: translate(-50%, 0%);
  }
</style>