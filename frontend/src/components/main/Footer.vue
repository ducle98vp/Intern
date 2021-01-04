<template>
  <footer class="main-footer">
    <strong>
      Copyright &copy; {{ support_year }} - {{ current_year }}
      <a href="http://ketoan9.com">ketoan9.com</a>.
    </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <!-- <b>Version</b> 3.0.0-beta.2 -->
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
  data() {
    return {
      support_year: process.env.SUPPORT_YEAR,
      current_year: new Date().getFullYear(),
    }
  }
};
</script>

<style scoped>
</style>