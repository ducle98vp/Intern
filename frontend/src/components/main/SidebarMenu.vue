<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/" class="brand-link">
      <img
        src="./../../assets/img/logo.png"
        alt="Ketoan9 Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light">Ketoan9</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img
            src="./../../assets/img/default-user.png"
            class="img-circle elevation-2"
            alt="User Image"
          />
        </div>
        <div class="info">
          <router-link to="/" class="d-block">{{ user.name }}</router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library-->

          <li class="nav-item has-treeview">
            <router-link to="/" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Dashboard</p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <router-link to="/companyinvoices" class="nav-link">
              <i class="nav-icon far fa-building"></i>
              <p>Danh sách công ty</p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <router-link to="/invoices" class="nav-link">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>Quản lý hoá đơn</p>
            </router-link>
          </li>
          <li class="nav-item has-treeview" v-if="role == 9">
            <input id="collapsible" class="toggle" type="checkbox" />
            <label for="collapsible" class="lbl-toggle nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p class=".test">Master data</p>
            </label>
            <ul
              class="collapsible-content nav nav-pills nav-sidebar flex-column"
            >
              <li class="nav-item has-treeview">
                <router-link to="/companies" class="nav-link menu-child">
                  <i class="nav-icon far fa-building"></i>
                  <p>Company</p>
                </router-link>
              </li>
              <li class="nav-item has-treeview">
                <router-link to="/users" class="nav-link menu-child">
                  <i class="nav-icon fas fa-users"></i>
                  <p>User</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview" v-if="role > 5">
            <input id="collapsible-support" class="toggle" type="checkbox" />
            <label for="collapsible-support" class="lbl-toggle nav-link">
              <i class="nav-icon fas fa-hands-helping"></i>
              <p class=".test">Support team</p>
            </label>
            <ul
              class="collapsible-content nav nav-pills nav-sidebar flex-column"
            >
              <li class="nav-item has-treeview">
                <router-link to="/sync_email_histories" class="nav-link menu-child">
                  <i class="nav-icon fas fa-exclamation"></i>
                  <p>Lịch sử đ.b hoá đơn</p>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "SidebarMenu",
  data: function () {
    return {
      isMenuOpen: false,
      displayEvent: false,
      role: "",
    };
  },
  computed: {
    ...mapGetters({
      user: "getAuthUser",
    }),
  },
  methods: {
    toogleMenu: function (event) {
      event.stopPropagation();
      event.preventDefault();
      this.isMenuOpen = !this.isMenuOpen;
    },
  },

  created() {
    this.role = localStorage.user_role;
  }
};
</script>

<style scoped>
.menu-child {
  padding-left: 40px;
}

input[type="checkbox"] {
  display: none;
}
.wrap-collabsible {
}
.lbl-toggle {
  display: block;
  font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI",
    Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
    "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 16px;
  text-align: left;
  color: #c2c7d0;
  cursor: pointer;
  border-radius: 7px;
  transition: all 0.25s ease-out;
}
.lbl-toggle::before {
  content: " ";
  display: inline-block;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-left: 5px solid currentColor;
  vertical-align: middle;
  margin-right: 0.7rem;
  transform: translateY(-2px);
  transition: transform 0.2s ease-out;
  position: absolute;
  right: 0px;
  top: 50%;
  transform: translateY(-50%);
}
.toggle:checked + .lbl-toggle::before {
  transform: rotate(90deg) translateX(-3px);
}
.collapsible-content {
  list-style: none;
  max-height: 0px;
  overflow: hidden;
  transition: max-height 0.25s ease-in-out;
}
.toggle:checked + .lbl-toggle + .collapsible-content {
  max-height: 350px;
}
.toggle:checked + .lbl-toggle {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.collapsible-content .content-inner {
  background: rgba(0, 105, 255, 0.2);
  border-bottom: 1px solid rgba(0, 105, 255, 0.45);
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  padding: 0.5rem 1rem;
}
.collapsible-content p {
  margin-bottom: 0;
}
.li-menu:hover {
  background-color: #6c757d;
}
.test:focus {
  outline-color: none;
}
</style>
