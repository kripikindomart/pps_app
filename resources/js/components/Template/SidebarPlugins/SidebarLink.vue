<template>
  <router-link
    v-if="item.gate === undefined || $can(item.gate)"
    :to="item.path"
    v-slot="{ href, route, navigate, isActive, isExactActive }"
  >
    <li
      class="nav-item"
      :class="[isActive && 'active', isExactActive && 'active']"
    >
      <a :href="href" class="nav-link" @click="navigate">
        <template v-if="text">
          <i class="fa fa-circle nav-icon"></i>
          <span class="sidebar-normal">{{ item.title }}</span>
        </template>
        <template v-else>
          <i class="nav-icon fas" :class="item.icon"></i>
          <p>{{ item.title }}</p>
        </template>
      </a>
    </li>
  </router-link>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      default: () => ({
        title: undefined,
        icon: undefined,
        path: {},
        gate: undefined,
      }),
    },
    text: {
      type: Boolean,
      default: false,
    },
  },
  computed: {},
};
</script>
