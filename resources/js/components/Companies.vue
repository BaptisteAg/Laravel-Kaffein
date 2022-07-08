<template>
  <!-- Header as in the example :)  -->
  <div class="py-5 border text-center">
    <h6 class="text-center">HUBSALES by Kaffein</h6>
  </div>
  <div class="container">
    <!-- The selection filter -->
    <div class="dropdown">
      <button
        class="btn btn-secondary dropdown-toggle mt-5 mb-3"
        type="button"
        id="dropdownMenuButton1"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        Secteur d'activités
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li v-for="(filter, index) in filters" :key="index">
          <a class="dropdown-item" href="#" @click="selectFilter(filter)">
            {{ filter }}
          </a>
        </li>
        <li><hr class="dropdown-divider" /></li>
        <li>
          <a class="dropdown-item" href="#" @click="selectFilter(null)">Tout</a>
        </li>
      </ul>
    </div>

    <!-- List of companies -->
    <table class="table" :class="{ backgroundDark: isLoading }">
      <!-- Loader -->
      <div
        class="d-flex justify-content-center align-items-center"
        style="height: 30vh"
        v-if="isLoading"
      >
        <div class="spinner-grow" role="status">
          <span class="visually-hidden">Chargement...</span>
        </div>
      </div>
      <tbody>
        <tr v-for="company in filteredCompanies" :key="company.id">
          <td>{{ company.name }}</td>
          <td>{{ company.activity }}</td>
          <td>{{ company.country }}</td>
          <td>{{ company.town }}</td>
          <td class="text-center">
            <button
              type="button"
              class="btn btn-primary"
              @click="showMore(company.id)"
            >
              Voir la fiche
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <CompaniesDetails
    v-if="company"
    :company="company"
    @closeModal="company = null"
  ></CompaniesDetails>
</template>
 
<script>
import CompaniesDetails from "./CompaniesDetails.vue";

export default {
  components: {
    CompaniesDetails,
  },
  data() {
    return {
      companies: [],
      filters: [
        "Séismologue",
        "Technicien plateau",
        "Porteur de hottes",
        "Ingénieur géomètre",
      ],
      selectedFilters: null,
      isLoading: true,
      company: null,
    };
  },
  created() {
    this.$axios.get("/sanctum/csrf-cookie").then((response) => {
      this.$axios
        .get("/api/companies")
        .then((response) => {
          this.companies = response.data;
          this.isLoading = false;
        })
        .catch(function (error) {
          console.log(error);
          this.isLoading = false;
        });
    });
  },
  computed: {
    filteredCompanies() {
      if (this.selectedFilters) {
        return this.companies.filter((result) => {
          return this.selectedFilters
            .toLowerCase()
            .split(" ")
            .every((v) => result.activity.toLowerCase().includes(v));
        });
      } else {
        return this.companies;
      }
    },
  },
  methods: {
    selectFilter: function (name) {
      this.selectedFilters = name;
    },
    showMore: function (id) {
      let result = this.companies.filter((item) => item.id == id);
      this.company = Object.values(result[0]);
    },
  },
  beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/";
    }
    next();
  },
};
</script>
<style>
.backgroundDark {
  background-color: lightgray;
  min-height: 30vh;
  border-radius: 5px;
}
</style>