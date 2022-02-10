<template>
  <div>
    <app-header v-if="isAuth"></app-header>
    <app-sidebar v-if="isAuth"></app-sidebar>
    <div :class="isAuth ? 'content-wrapper' : ''">
      <router-view></router-view>
    </div>
    <app-footer v-if="isAuth"></app-footer>
  </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";

export default {
  computed: {
    ...mapState(["token"]),
    ...mapGetters(["isAuth"]),
  },
};
</script>