<template>
  <div class="container pt-4">
    <h2>Crée un compte</h2>

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
        <label for="name" class="form-label">Nom</label>
        <input
          type="name"
          class="form-control"
          id="name"
          placeholder="Kaffein"
          v-model="name"
        />
      </div>
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
          placeholder="****"
          v-model="password"
        />
      </div>
      <button type="submit" @click="handleSubmit" class="btn btn-primary">
        Crée un compte
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      error: null,
    };
  },

  methods: {
    handleSubmit(e) {
      e.preventDefault();
      if (this.password.length > 0) {
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
          this.$axios
            .post("api/register", {
              name: this.name,
              email: this.email,
              password: this.password,
            })
            .then((response) => {
              if (response.data.success) {
                window.location.href = "/login";
              } else {
                this.error = response.data.message;
              }
            })
            .catch(function (error) {
              console.error(error);
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
