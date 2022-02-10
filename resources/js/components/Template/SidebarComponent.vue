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
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <li v-if="$can('read outlets')">
              <router-link :to="{ name: 'outlets.data' }">Outlets</router-link>
            </li>
            <li v-if="$can('read couriers')">
              <router-link :to="{ name: 'couriers.data' }"
                >Couriers</router-link
              >
            </li>
            <li v-if="$can('read products')">
              <router-link :to="{ name: 'products.data' }"
                >Products</router-link
              >
            </li>

            <li class="nav-item">
              <router-link to="home" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </router-link>
            </li>
            <li class="nav-item" v-if="$can('read jadwal')">
              <router-link :to="{ name: 'jadwal' }" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>Jadwal</p>
              </router-link>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Layout Options
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">6</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../layout/top-nav.html" class="nav-link">
                    <i class="fa fa-circle nav-icon"></i>
                    <p>Top Navigation</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../layout/top-nav-sidebar.html" class="nav-link">
                    <i class="fa fa-circle nav-icon"></i>
                    <p>Top Navigation + Sidebar</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState("user", {
      authenticated: (state) => state.authenticated, //ME-LOAD STATE AUTHENTICATED
    }),
  },
  methods: {
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