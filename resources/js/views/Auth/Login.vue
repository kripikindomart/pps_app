<!-- HTML SECTION -->
<template>
  <div class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <router-link :to="{ name: 'home' }"
          ><strong>PPS</strong>-App</router-link
        >
      </div>
      <div class="card">
        <div class="card body login-card-body">
          <p class="login-card-msg">Sign in to start your session</p>

          <div class="input-group mb-3" :class="{ 'has-error': errors.email }">
            <input
              type="email"
              class="form-control"
              placeholder="Email"
              v-model="data.email"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <p class="text-danger" v-if="errors.email">
            {{ errors.email[0] }}
          </p>

          <div
            class="input-group mb-3"
            :class="{ 'has-error': errors.password }"
          >
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              v-model="data.password"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p class="text-danger" v-if="errors.password">
            {{ errors.password[0] }}
          </p>

          <div class="alert alert-danger" v-if="errors.invalid">
            {{ errors.invalid }}
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="icheck-primary">
                <label>
                  <input
                    class="checkbox"
                    type="checkbox"
                    v-model="data.remember_me"
                  />
                  Remember Me
                </label>
              </div>
            </div>
            <div class="col-xs-4">
              <button
                type="submit"
                class="btn btn-primary btn-block btn-flat"
                @click.prevent="postLogin"
              >
                Login
              </button>
            </div>
          </div>

          <a href="#">I forgot my password</a><br />
        </div>
      </div>
    </div>
  </div>
</template>

<!-- JAVASCRIPT SECTION -->
<script>
import { mapActions, mapMutations, mapGetters, mapState } from "vuex";
export default {
  data() {
    return {
      data: {
        email: "",
        password: "",
        remember_me: false,
      },
    };
  },
  //SEBELUM COMPONENT DI-RENDER
  created() {
    if (this.isAuth) {
      this.$router.push({ name: "home" });
    }
  },
  computed: {
    ...mapGetters(["isAuth"]), //MENGAMBIL GETTERS isAuth DARI VUEX
    ...mapState(["errors"]),
  },
  methods: {
    ...mapActions("auth", ["submit"]),
    ...mapMutations(["CLEAR_ERRORS"]),
    ...mapActions("user", ["getUserLogin"]),
    postLogin() {
      this.submit(this.data).then(() => {
        if (this.isAuth) {
          this.CLEAR_ERRORS();
          this.$router.push({ name: "home" });
        }
      });
    },
  },
  destroyed() {
    if (!this.isAuth) {
      this.getUserLogin();
    }
  },
};
</script>