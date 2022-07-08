<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/">Kaffein</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li v-if="isLoggedIn" class="nav-item">
            <router-link class="nav-link" to="/companies"
              >Companies</router-link
            >
          </li>
          <li v-if="isLoggedIn" class="nav-item">
            <a href="#" class="nav-link" @click="logout">Déconnexion</a>
          </li>
          <li
            v-if="!isLoggedIn"
            class="nav-item"
            :class="{ active: $route.name == 'Login' }"
          >
            <router-link class="nav-link" to="/login">Connexion</router-link>
          </li>
          <li v-if="!isLoggedIn" class="nav-item">
            <router-link class="nav-link" to="/register"
              >Crée un compte</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <router-view></router-view>
</template>
<script>
export default {
  name: "App",
  data() {
    return {
      isLoggedIn: false,
    };
  },
  created() {
    if (window.Laravel.isLoggedin) {
      this.isLoggedIn = true;
    }
  },
  methods: {
    logout(e) {
      e.preventDefault();
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post("/api/logout")
          .then((response) => {
            if (response.data.success) {
              window.location.href = "/";
            } else {
              console.log(response);
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>

<style>
.router-link-exact-active {
  color: black !important;
}
</style>