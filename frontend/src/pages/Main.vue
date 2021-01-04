<template>
  <div class="wrapper">
    <Header></Header>
    <SidebarMenu></SidebarMenu>
    
    <div class="content-wrapper">
      <router-view></router-view>
    </div>

    <Footer></Footer>
    <Loading></Loading>
    <NotificationList/>

    <aside class="control-sidebar control-sidebar-dark"></aside>
    <div id="sidebar-overlay" v-on:click="toggleMenuSidebar"></div>
  </div>
</template>

<script>
import NotificationList from './../components/main/NotificationList.vue'
import Header from "./../components/main/Header";
import SidebarMenu from "./../components/main/SidebarMenu";
import Footer from "./../components/main/Footer";
import Loading from "./../components/main/Loading";

export default {
  name: "Main",
  components: {
    NotificationList,
    Header,
    SidebarMenu,
    Footer,
    Loading
  },
  methods: {
    toggleMenuSidebar: function() {
      if (document.body.classList.contains("sidebar-open")) {
        document.body.classList.remove("sidebar-open");
        document.body.classList.add("sidebar-collapse");
      } else if (document.body.classList.contains("sidebar-collapse")) {
        document.body.classList.remove("sidebar-collapse");
        document.body.classList.add("sidebar-open");
      }
    },
  },
  created: function() {
  },
};
</script>

<style scoped>
  .content-wrapper {
    padding-right: 7.5px;
    padding-left: 7.5px;
    overflow: hidden;
  }
</style>