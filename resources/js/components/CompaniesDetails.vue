<template>
  <div class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Information sur {{ companyData[1] }}</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            @click="close"
          ></button>
        </div>
        <div class="modal-body">
          <p>{{ companyData }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: { company: Array },
  data() {
    return {
      companyData: this.company,
      strSuccess: "",
      strError: "",
      imgPreview: null,
    };
  },

  created() {
    this.$axios.get("/sanctum/csrf-cookie").then((response) => {
      this.$axios
        .get("/api/companies/details/" + this.company[0])
        .then((response) => {
          this.companyData.push(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    });
  },
  methods: {
    close: function () {
      this.$emit("closeModal");
    },
  },
};
</script>
<style>
.modal {
  display: block !important;
}
</style>