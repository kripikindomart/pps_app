<template>
  <div class="sidebar">
    <slot name="content"></slot>
    <ul
      class="nav nav-pills nav-sidebar flex-column"
      data-widget="treeview"
      role="menu"
      data-accordion="false"
    >
      <slot>
        <template v-for="(item, i) in sidebarLinks">
          <sidebar-item-group
            v-if="item.children && $can(item.gate)"
            :key="`group-${i}`"
            :item="item"
          >
          </sidebar-item-group>
          <sidebar-link v-else :key="`item-${i}`" :item="item"></sidebar-link>
        </template>
      </slot>
      <li class="nav-item">
        <a href="javascript:void(0)" @click="logout" class="nav-link red">
          <i class="nav-icon fa-solid fa-arrow-right-from-bracket"></i>
          <p>Sign out</p>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: "panel.site_title",
    },

    itemColor: {
      type: String,
      default: "purple",
      validator: (value) => {
        let acceptedValues = [
          "",
          "purple",
          "azure",
          "green",
          "orange",
          "rose",
          "danger",
        ];
        return acceptedValues.indexOf(value) !== -1;
      },
    },
    sidebarLinks: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {};
  },
  computed: {
    sidebarStyle() {
      return {
        backgroundImage: `url(${this.backgroundImage})`,
      };
    },
  },
  methods: {
    logout() {
      return new Promise((resolve, reject) => {
        localStorage.removeItem("token");
        resolve();
      }).then(() => {
        axios.post("/api/logout").then(() => {
          this.$store.state.token = localStorage.getItem("token");
          this.$router.push("/login");
        });
      });
    },
  },
};
</script>

<style>
@media screen and (min-width: 991px) {
  .nav-mobile-menu {
    display: none;
  }
}
</style>
