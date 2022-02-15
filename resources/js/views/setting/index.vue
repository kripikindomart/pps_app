<template>
  <div class="container">
    <section class="content-header">
      <h1>{{ $can("setting_access") ? "Settings Page" : "Error Page" }}</h1>
    </section>

    <section class="content container">
      <div class="row">
        <router-view></router-view>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  name: "IndexSetting",
};
</script>