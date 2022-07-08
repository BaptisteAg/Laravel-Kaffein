<template>
  <div class="container pt-4">
    <h2>Connexion</h2>

    <div
      v-if="error !== null"
      class="alert alert-danger alert-dismissible fade show"
      role="alert"
    >
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
      ></button>

      <strong>{{ error }}</strong>
    </div>

    <form>
      <div class="mb-3">
        <label for="email" class="form-label">Adresse mail</label>
        <input
          type="email"
          class="form-control"
          id="email"
          placeholder="nom@exemple.com"
          v-model="email"
        />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input
          type="password"
          class="form-control"
          id="password"
          placeholder="name@example.com"
          v-model="password"
        />
      </div>
      <button
        type="submit"
        @click="handleSubmit"
        class="btn btn-primary"
        :disabled="isLoading"
      >
        <span
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
          v-if="isLoading"
        ></span>
        Connexion
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      error: null,
      isLoading: false,
    };
  },

  methods: {
    handleSubmit(e) {
      e.preventDefault();
      if (this.password.length > 0) {
        this.isLoading = true;
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
          this.$axios
            .post("api/login", {
              email: this.email,
              password: this.password,
            })
            .then((response) => {
              if (response.data.success) {
                this.$router.go("/login");
              } else {
                this.error = response.data.message;
              }
              this.isLoading = false;
            })
            .catch(function (error) {
              console.error(error);
              this.isLoading = false;
            });
        });
      }
    },
  },

  beforeRouteEnter(to, from, next) {
    if (window.Laravel.isLoggedin) {
      return next("companies");
    }
    next();
  },
};
</script>