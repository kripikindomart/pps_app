<template>
  <div>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img
          src="/img/logo.png"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img
              src="/img/profile.png"
              class="img-circle elevation-2"
              alt="User Image"
            />
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ authenticated.name }}</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input
              class="form-control form-control-sidebar"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <div class="mt-2" :class="{ 'nav-open': $sidebar.showSidebar }">
          <side-bar :sidebarLinks="sidebarLinks"> </side-bar>
        </div>
        <!-- <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <li class="nav-item">
              <router-link to="home" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </router-link>
            </li>

            <li class="nav-item">
              <a href="javascript:void(0)" @click="logout" class="nav-link red">
                <i class="nav-icon fa-solid fa-arrow-right-from-bracket"></i>
                <p>Sign out</p>
              </a>
            </li>
          </ul>
        </nav> -->
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      sidebarLinks: [
        {
          title: "Dashboard",
          icon: "fa-tachometer-alt",
          path: { name: "home" },
        },
        {
          title: "Settings",
          icon: "fa-cog",
          path: { name: "setting" },
          gate: "setting_access",
          children: [
            {
              title: "Permission",
              icon: "perm_data_setting",
              path: { name: "role.permissions" },
              gate: "permission-read",
            },
            {
              title: "Role",
              icon: "group",
              path: { name: "role" },
              gate: "role-read",
            },
            {
              title: "User",
              icon: "person",
              path: { name: "users.index" },
              gate: "user-read",
            },
          ],
        },
        {
          title: "cruds.contactManagement.title",
          icon: "import_contacts",
          path: { name: "contact_management" },
          gate: "contact_management_access",
          children: [
            {
              title: "cruds.contactCompany.title",
              icon: "fas fa-building",
              path: { name: "contact_companies.index" },
              gate: "contact_company_access",
            },
            {
              title: "cruds.contactContact.title",
              icon: "fas fa-user-plus",
              path: { name: "contact_contacts.index" },
              gate: "contact_contact_access",
            },
          ],
        },
        {
          title: "cruds.transaction.title",
          icon: "table_view",
          path: { name: "transactions.index" },
          gate: "transaction_access",
        },
      ],
    };
  },
  computed: {
    ...mapState("user", {
      authenticated: (state) => state.authenticated, //ME-LOAD STATE AUTHENTICATED
    }),
  },
  methods: {
    toggleSidebar() {
      this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
    },
    //KETIKA TOMBOL LOGOUT DITEKAN, FUNGSI INI DIJALANKAN
    logout() {
      return new Promise((resolve, reject) => {
        localStorage.removeItem("token"); //MENGHAPUS TOKEN DARI LOCALSTORAGE
        resolve();
      }).then(() => {
        //MEMPERBAHARUI STATE TOKEN
        this.$store.state.token = localStorage.getItem("token");
        this.$router.push("/login"); //REDIRECT KE PAGE LOGIN
      });
    },
  },
};
</script>